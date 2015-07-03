<?php namespace Controladores;

use Configuracion\Vistas;
use Configuracion\Controlador;

class Inicio extends Controlador{

    public function __construct()
    {
        parent::__construct();
        $this->idioma->cargar('Inicio');
    }

    public function index()
    {
        $data['titulo'] = $this->idioma->obtener('inicio_titulo');
        $data['inicio_mensaje'] = $this->idioma->obtener('inicio_mensaje');

        Vistas::mostrarPlantilla('encabezado', $data);
        Vistas::mostrar('inicio/inicio', $data);
        Vistas::mostrarPlantilla('piedepagina', $data);
    }

    public function subPagina()
    {
        $data['titulo'] = $this->idioma->obtener('subpagina_titulo');
        $data['subpagina_mensaje'] = $this->idioma->obtener('subpagina_mensaje');

        Vistas::mostrarPlantilla('encabezado', $data);
        Vistas::mostrar('inicio/subpagina', $data);
        Vistas::mostrarPlantilla('piedepagina', $data);
    }
}
