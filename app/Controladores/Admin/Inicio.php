<?php namespace Controladores\Admin;

use Configuracion\Controlador,
    Configuracion\Vistas,
    Configuracion\Sesiones,
    Configuracion\Url;


class Inicio extends Controlador{

    public function __construct()
    {
        parent::__construct();
        if(!Sesiones::obtenerValor('logueadoAdmin')){
            Url::redirigir('Login');
           }

        $this->idioma->cargar('admin/inicio');
    }

    public function index(){
        $id = Sesiones::obtenerValor('UsuarioEmail');
        $data['id'] = $id;
        $data['titulo'] = 'Bienvenido '.$id;

        Vistas::mostrarPlantilla('encabezado', $data, 'admin');
        Vistas::mostrar('admin/inicio', $data);
        Vistas::mostrarPlantilla('piedepagina', $data, 'admin');
    }
}