<?php
namespace Configuracion;

class Configuracion
{
    public function __construct()
    {
        define('DIR', 'http://localhost/');
        define('CONTROLADOR_INICIAL', 'welcome');
        define('METODO_INICIAL', 'index');
        define('PLANTILLA', 'default');
        define('SIGLAS_LENGUAJE', 'es');

        define('DB_TYPE', 'mysql');
        define('DB_HOST', 'localhost');
        define('DB_NAME', 'framework');
        define('DB_USER', 'root');
        define('DB_PASS', 'wi140679');
        define('PREFIX', 'BCO_');

        /**
         * Se recomienda utilizar un 'prefix'
         * para poder especificar que tablas utilizarán con este framework
         * sin modificar las que actualmente se usen.
         */
        define('SESSION_PREFIX', 'BCO_');

        /**
         * Para definir el titulo de la web a todas las páginas
         * Luego pueden utilizar $data['titulo'] = 'Nombre pagina';
         * y el titulo se visualizará: "Nombre pagina - TITULO_WEB
         */
        define('TITULO_WEB', 'Sistemas BCO');
        define('EMAIL_DEFAULT', 'info@sistemasbco.com.ar');

        Sesiones::iniciar();
    }
}
