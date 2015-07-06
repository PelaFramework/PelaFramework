<?php
    require 'vendor/autoload.php';

if (!is_readable('app/Configuracion/Configuracion.php')) {
    die('No se encontró el archivo Configuracion.php en la carpeta app/Configuracion.');
}

new Configuracion\Configuracion();
use Configuracion\Rutas;

Rutas::any('', 'Controladores\Inicio@index');
Rutas::any('index', 'Controladores\Inicio@index');
Rutas::any('Home', 'Controladores\Inicio@index');
Rutas::any('SubPagina', 'Controladores\Inicio@subPagina');

Rutas::error('Configuracion\Error@index');
Rutas::$rutaAlternativa = false;
Rutas::ejecutar();
