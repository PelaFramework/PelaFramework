<?php namespace Controladores;

use Configuracion\Controlador,
    Configuracion\Vistas,
    Configuracion\Sesiones,
    Configuracion\Url;

class Login extends Controlador{

    public function __construct(){

                parent::__construct();
        $this->idioma->cargar('Login');
            }

    public function ingresar(){

        if(Sesiones::obtenerValor('logueadoAdmin')){
            Url::redirigir('Admin');
        }
        if(Sesiones::obtenerValor('logueadoUsuario')){
            Url::redirigir('Usuarios');
        }
        $modelo = new \Modelos\Login();

        $data['titulo'] = $this->idioma->obtener('titulo');


        if(isset($_POST['submit'])){

            $usuario = $_POST['usuario'];
            $password = $_POST['password'];
            $consultaModelo = $modelo->getHash($_POST['usuario']);

            if($password == $consultaModelo['password'] && $password==!null){
             if($consultaModelo['rol'] == 2){
                    Sesiones::establecer('logueadoAdmin', true);
                    Sesiones::establecer('IdUsuariosWeb', $modelo->getId($usuario));
                    Sesiones::establecer('UsuarioEmail', $usuario);

                    $data = array('UltimoIngreso' => date('Y-m-d G:i:s'));
                    $where = array('IdUsuariosWeb' => $modelo->getId($usuario));
                    $modelo->update($data, $where);

                    Url::redirigir('Admin');
                } else {
                    Sesiones::establecer('logueadoUsuario', true);
                    Url::redirigir('Usuarios');
                }
            } else {
               $error[]= $this->idioma->obtener('error_login');
            }

        }
        Vistas::mostrarPlantilla('encabezado', $data, 'login');
        Vistas::mostrar('login', $data, $error);
        Vistas::mostrarPlantilla('piedepagina', $data, 'login');
    }

    public function desconectar(){
        Sesiones::terminarSesion();
        Url::redirigir('Login');

    }

}
