<?php namespace Configuracion;

class Idiomas
{
    private $array;

    public function cargar($nombreArchivo, $carpeta = SIGLAS_LENGUAJE)
    {
        $archivo = "app/Idiomas/$carpeta/$nombreArchivo.php";

        if (is_readable($archivo)) {
            $this->array = include($archivo);
        } else {
            echo Error::mostrarError("No se pudo cargar '$carpeta/$nombreArchivo.php'");
            die;
        }
    }

    public function obtener($valor)
    {
        if (!empty($this->array[$valor])) {
            return $this->array[$valor];
        } else {
            return $valor;
        }
    }

    public static function mostrar($valor, $nombreArchivo, $carpeta = SIGLAS_LENGUAJE)
    {
        $archivo = "app/Idiomas/$carpeta/$nombreArchivo.php";

        if (is_readable($archivo)) {
            $array = include($archivo);
        } else {
            echo Error::mostrarError("No se pudo cargar '$carpeta/$nombreArchivo.php'");
            die;
        }

        if (!empty($array[$valor])) {
            return $array[$valor];
        } else {
            return $valor;
        }
    }
}
