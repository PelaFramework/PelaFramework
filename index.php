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

Rutas::any('Login', 'Controladores\Login@ingresar');
Rutas::any('Logout', 'Controladores\Login@desconectar');

Rutas::any('Admin', 'Controladores\Admin\Inicio@index');
Rutas::any('Admin/Consorcios', 'Controladores\Admin\Consorcios@index');
Rutas::any('Admin/Consorcios/Agregar', 'Controladores\Admin\Consorcios@agregar');
Rutas::any('Admin/Consorcios/Editar/(:num)', 'Controladores\Admin\Consorcios@editar');
Rutas::any('Admin/Consorcios/Eliminar/(:num)', 'Controladores\Admin\Consorcios@eliminar');
Rutas::any('Admin/Consorcios/Eliminar/(:num)', 'Controladores\Admin\Consorcios@eliminar');

Rutas::any('Usuarios', 'Controladores\Usuarios\Inicio@index');

Rutas::error('Configuracion\Error@index');
Rutas::$rutaAlternativa = false;
Rutas::ejecutar();
