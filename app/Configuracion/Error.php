<?php namespace Configuracion;

class Error extends Controlador
{
    private $error = null;

    public function __construct($error)
    {
        parent::__construct();
        $this->error = $error;
    }

    public function index()
    {
        header("HTTP/1.0 404 ERROR");

        $data['titulo'] = '404';
        $data['error'] = $this->error;

        Vistas::mostrarPlantilla('encabezado', $data);
        Vistas::mostrar('error/404', $data);
        Vistas::mostrarPlantilla('piedepagina', $data);
    }

    public static function mostrarError($error, $class = 'alert alert-danger')
    {
        if (is_array($error)) {
            foreach ($error as $error)
            {
                $fila.= "<div class='$class'>$error</div>";
            }
            return $fila;
        } else {
            if (isset($error)) {
                return "<div class='$class'>$error</div>";
            }
        }
    }
}
