<?php namespace Controladores\Usuarios;

use Configuracion\Controlador,
    Configuracion\Sesiones,
    Configuracion\Url,
    Configuracion\Vistas;


class Inicio extends Controlador{

    public function __construct()
    {
        parent::__construct();
        if(!Sesiones::obtenerValor('logueadoUsuario')){
            Url::redirigir('Login');
        }
        $this->idioma->cargar('admin/inicio');
    }

    public function index(){
        $data['titulo'] = 'Bienvenido Usuario';

        Vistas::mostrarPlantilla('encabezado', $data, 'usuarios');
        Vistas::mostrar('usuarios/inicio', $data);
        Vistas::mostrarPlantilla('piedepagina', $data, 'usuarios');
    }



}