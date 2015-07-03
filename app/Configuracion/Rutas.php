<?php namespace Configuracion;

class Rutas
{
    public static $rutaAlternativa = true;
    public static $detener = true;
    public static $rutas = array();
    public static $metodos = array();
    public static $respuesta = array();
    public static $errorRespuesta;
    public static $tipoVariable = array(
        ':any' => '[^/]+',
        ':num' => '[0-9]+',
        ':all' => '.*'
    );

    public static function __callstatic($metodo, $parametros)
    {
        $uri = dirname($_SERVER['PHP_SELF']).'/'.$parametros[0];
        $callback = $parametros[1];

        array_push(self::$rutas, $uri);
        array_push(self::$metodos, strtoupper($metodo));
        array_push(self::$respuesta, $callback);
    }

    public static function error($callback)
    {
        self::$errorRespuesta = $callback;
    }

    public static function detenerAlEncontrarCoincidencia($flag = true)
    {
        self::$detener = $flag;
    }

    public static function invocarObjeto($callback, $matched = null, $msg = null)
    {
        $last = explode('/', $callback);
        $last = end($last);
        $segments = explode('@', $last);
        $controller = new $segments[0]($msg);

        if ($matched == null) {
            $controller->$segments[1]();
        } else {
            call_user_func_array(array($controller, $segments[1]), $matched);
        }
    }

    public static function rutaAlternativaDefecto()
    {
        $uri = parse_url($_SERVER['QUERY_STRING'], PHP_URL_PATH);
        $uri = trim($uri, ' /');
        $uri = ($amp = strpos($uri, '&')) !== false ? substr($uri, 0, $amp) : $uri;

        $parts = explode('/', $uri);

        $controller = array_shift($parts);
        $controller = $controller ? $controller : CONTROLADOR_INICIAL;

        $metodo = array_shift($parts);
        $metodo = $metodo ? $metodo : METODO_INICIAL;

        $args = !empty($parts) ? $parts : array();

        // Check for file
        if (!file_exists("App/Controladores/$controller.php")) {
            return false;
        }

        $controller = ucwords($controller);
        $controller = "\Controladores\\$controller";
        $c = new $controller;

        if (method_exists($c, $metodo)) {
            $c->$metodo($args);
            //found method so stop
            return true;
        }

        return false;
    }

    public static function ejecutar()
    {
        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $metodo = $_SERVER['REQUEST_METHOD'];
        $searches = array_keys(static::$tipoVariable);
        $replaces = array_values(static::$tipoVariable);

        self::$rutas = str_replace('//', '/', self::$rutas);

        $found_route = false;

        $query = '';
        $q_arr = array();
        if (strpos($uri, '&') > 0) {
            $query = substr($uri, strpos($uri, '&') + 1);
            $uri = substr($uri, 0, strpos($uri, '&'));
            $q_arr = explode('&', $query);
            foreach ($q_arr as $q) {
                $qobj = explode('=', $q);
                $q_arr[] = array($qobj[0] => $qobj[1]);
                if (!isset($_GET[$qobj[0]])) {
                    $_GET[$qobj[0]] = $qobj[1];
                }
            }
        }

        if (in_array($uri, self::$rutas)) {
            $route_pos = array_keys(self::$rutas, $uri);

            // foreach route position
            foreach ($route_pos as $route) {
                if (self::$metodos[$route] == $metodo || self::$metodos[$route] == 'ANY') {
                    $found_route = true;

                    if (!is_object(self::$respuesta[$route])) {
                        self::invocarObjeto(self::$respuesta[$route]);
                        if (self::$detener) {
                            return;
                        }
                    } else {
                        call_user_func(self::$respuesta[$route]);
                        if (self::$detener) {
                            return;
                        }
                    }
                }

            }

        } else {
            $pos = 0;
            foreach (self::$rutas as $route) {
                $route = str_replace('//', '/', $route);

                if (strpos($route, ':') !== false) {
                    $route = str_replace($searches, $replaces, $route);
                }

                if (preg_match('#^' . $route . '$#', $uri, $matched)) {
                    if (self::$metodos[$pos] == $metodo || self::$metodos[$pos] == 'ANY') {
                        $found_route = true;

                        array_shift($matched);

                        if (!is_object(self::$respuesta[$pos])) {
                            self::invocarObjeto(self::$respuesta[$pos], $matched);
                            if (self::$detener) {
                                return;
                            }
                        } else {
                            call_user_func_array(self::$respuesta[$pos], $matched);
                            if (self::$detener) {
                                return;
                            }
                        }
                    }
                }
                $pos++;
            }
        }

        if (self::$rutaAlternativa) {
            $found_route = self::rutaAlternativaDefecto();
        }

        if (!$found_route) {
            if (!self::$errorRespuesta) {
                self::$errorRespuesta = function () {
                    header("{$_SERVER['SERVER_PROTOCOL']} 404 ERROR");

                    $data['titulo'] = '404';
                    $data['error'] = "Oops! No se pudo encontrar la pagina..";

                    Vistas::mostrarPlantilla('encabezado', $data);
                    Vistas::mostrar('Error/404', $data);
                    Vistas::mostrarPlantilla('piedepagina', $data);
                };
            }

            if (!is_object(self::$errorRespuesta)) {
                self::invocarObjeto(self::$errorRespuesta, null, 'No se pudo encontrar la ruta.');
                if (self::$detener) {
                    return;
                }
            } else {
                call_user_func(self::$errorRespuesta);
                if (self::$detener) {
                    return;
                }
            }
        }
    }
}
