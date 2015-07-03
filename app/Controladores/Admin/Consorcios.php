<?php namespace Controladores\Admin;

use Configuracion\Controlador,
    Configuracion\Sesiones,
    Configuracion\Url,
    Configuracion\Vistas;

class Consorcios extends Controlador{

    private $_modelo;

    public function __construct(){
        parent::__construct();
        if(!Sesiones::obtenerValor('logueadoAdmin')){
            Url::redirigir('Login');
        }
        $this->_modelo = new \Modelos\Admin\Consorcios();
    }

    public function index()
    {
        $id = Sesiones::obtenerValor('UsuarioEmail');
        $data['id'] = $id;
        $data['titulo'] = 'Consorcios';
        $data['consorcios'] = $this->_modelo->obtenerConsorcios();

        Vistas::mostrarPlantilla('encabezado', $data, 'admin');
        Vistas::mostrar('admin/consorcios/consorcios', $data);
        Vistas::mostrarPlantilla('piedepagina', $data, 'admin');
    }

    public function agregar()
    {
        $id = Sesiones::obtenerValor('UsuarioEmail');
        $data['id'] = $id;
        $data['titulo'] = 'Agregar nuevo consorcio';

        Vistas::mostrarPlantilla('encabezado', $data, 'admin');
        Vistas::mostrar('admin/consorcios/agregarconsorcio', $data);
        Vistas::mostrarPlantilla('piedepagina', $data, 'admin');
    }

    public function editar($idConsorcio)
    {
        $id = Sesiones::obtenerValor('UsuarioEmail');
        $data['id'] = $id;
        $data['titulo'] = 'Editar consorcio';

        Vistas::mostrarPlantilla('encabezado', $data, 'admin');
        Vistas::mostrar('admin/consorcios/editarconsorcio', $data);
        Vistas::mostrarPlantilla('piedepagina', $data, 'admin');
    }

    public function eliminar($idConsorcio)
    {
        $id = Sesiones::obtenerValor('UsuarioEmail');
        $data['id'] = $id;
        $data['titulo'] = 'Eliminar consorcio';

        Vistas::mostrarPlantilla('encabezado', $data, 'admin');
        Vistas::mostrar('admin/consorcios/eliminarconsorcio', $data);
        Vistas::mostrarPlantilla('piedepagina', $data, 'admin');
    }
}