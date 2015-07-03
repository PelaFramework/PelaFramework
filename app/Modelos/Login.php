<?php namespace Modelos;

use Configuracion\Modelo;

class Login extends Modelo{

    public function getHash($usuario){
        $data = $this->db->select("SELECT password,rol FROM ".PREFIX."UsuariosWeb WHERE UsuarioEmail = :usuario", array(':usuario' => $usuario));
        return array('password'=>$data[0]->password, 'rol'=>$data[0]->rol);
    }

    public function getId($usuario){
        $data = $this->db->select("SELECT IdUsuariosWeb FROM ".PREFIX."UsuariosWeb WHERE UsuarioEmail = :usuario", array(':usuario' => $usuario));
        return $data[0]->IdUsuariosWeb;
    }

    public function update($data, $where){
        $this->db->update(PREFIX."UsuariosWeb",$data,$where);
    }
}
