<?php namespace Configuracion;

class Vistas
{
    private static $listaEncabezado = array();

    public static function mostrar($nombreArchivo, $data = false, $error = false)
    {
        if (!headers_sent()) {
            foreach (self::$listaEncabezado as $encabezado) {
                header($encabezado, true);
            }
        }
        require "app/Vistas/$nombreArchivo.php";
    }

    public static function correrPlugin($nombreArchivo, $data = false, $error = false)
    {
        if (!headers_sent()) {
            foreach (self::$listaEncabezado as $encabezado) {
                header($encabezado, true);
            }
        }
        require "app/Plugins/$nombreArchivo.php";
    }

    public static function mostrarPlantilla($nombreArchivo, $data = false, $nombreCarpeta = false)
    {
        if (!headers_sent()) {
            foreach (self::$listaEncabezado as $encabezado) {
                header($encabezado, true);
            }
        }

        if ($nombreCarpeta === false) {
            require "app/Plantillas/".PLANTILLA."/$nombreArchivo.php";
        } else {
            require "app/Plantillas/$nombreCarpeta/$nombreArchivo.php";
        }
    }

    public function agregarEncabezado($encabezado)
    {
        self::$listaEncabezado[] = $encabezado;
    }

    public function agregarListaEncabezado($listaEncabezado = array())
    {
        foreach ($listaEncabezado as $encabezado) {
            $this->agregarEncabezado($encabezado);
        }
    }
}
