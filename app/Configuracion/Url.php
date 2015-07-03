<?php namespace Configuracion;

class Url
{
    public static function redirigir($url = null, $fullpath = false)
    {
        if ($fullpath == false) {
            $url = DIR . $url;
        }

        header('Location: '.$url);
        exit;
    }

    public static function carpetaPlantillas($custom = false)
    {
        if ($custom == true) {
            return DIR.'app/Plantillas/'.$custom.'/';
        } else {
            return DIR.'app/Plantillas/'.PLANTILLA.'/';
        }
    }
}
