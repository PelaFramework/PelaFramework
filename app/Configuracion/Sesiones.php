<?php namespace Configuracion;

class Sesiones
{
    private static $sesionIniciada = false;

    public static function iniciar()
    {
        if (self::$sesionIniciada == false) {
            session_start();
            self::$sesionIniciada = true;
        }
    }

    public static function establecer($clave, $valor = false)
    {
        if (is_array($clave) && $valor === false) {
            foreach ($clave as $name => $valor) {
                $_SESSION[SESSION_PREFIX.$name] = $valor;
            }
        } else {
            $_SESSION[SESSION_PREFIX.$clave] = $valor;
        }
    }

    public static function extraerValor($clave)
    {
        $valor = $_SESSION[SESSION_PREFIX.$clave];
        unset($_SESSION[SESSION_PREFIX.$clave]);
        return $valor;
    }

    public static function obtenerValor($clave, $secondkey = false)
    {
        if ($secondkey == true) {
            if (isset($_SESSION[SESSION_PREFIX.$clave][$secondkey])) {
                return $_SESSION[SESSION_PREFIX.$clave][$secondkey];
            }
        } else {
            if (isset($_SESSION[SESSION_PREFIX.$clave])) {
                return $_SESSION[SESSION_PREFIX.$clave];
            }
        }
        return false;
    }

    public static function idSesion()
    {
        return session_id();
    }

    public static function mostrarSesion()
    {
        return $_SESSION;
    }

    public static function terminarSesion($clave = '')
    {
        if (self::$sesionIniciada == true) {
            if (empty($clave)) {
                session_unset();
                session_destroy();
            } else {
                unset($_SESSION[SESSION_PREFIX.$clave]);
            }
        }
    }
}
