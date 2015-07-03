<?php namespace Configuracion;
use Helpers\Database;

abstract class Modelo
{
    protected $db;

    public function __construct()
    {
        $this->db = Database::get();
    }
}
