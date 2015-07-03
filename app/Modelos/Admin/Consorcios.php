<?php namespace Modelos\Admin;

use Configuracion\Modelo;

class Consorcios extends Modelo{

    public function obtenerConsorcios(){
        return $this->db->select("SELECT * FROM ".PREFIX."Consorcios ORDER BY IdConsorcio");
    }

    public function obtenerConsorcio($idConsorcio){
        return $this->db->select("SELECT * FROM ".PREFIX."Consorcios WHERE IdConsorcio = :idConsorcio", array(':idConsorcio' => $idConsorcio));
    }

    public function insertarConsorcio($data){
        return $this->db->insert(PREFIX."Consorcios", $data);
    }

    public function actualizarConsorcio($data, $where){
        return $this->db->insert(PREFIX."Consorcios", $data, $where);
    }

    public function eliminarConsorcio($where){
        return $this->db->delete(PREFIX."Consorcios", $where);
    }
}
