<?php namespace Configuracion;

abstract class Controlador
{
    public $vista;
    public $idioma;

    public function __construct()
    {
        $this->vista = new Vistas();
        $this->idioma = new Idiomas();
    }
}
