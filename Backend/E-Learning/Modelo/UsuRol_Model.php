<?php

class UsuRol_Model{
    private $IdUsuario;
    private $IdRol;

    public function __construct(){
        
    }

    public static function createUsuRol($IdUsuario, $IdRol){
        $instance = new self();
        $instance->setIdUsuario($IdUsuario);
        $instance->setIdRol($IdRol);
        
        return $instance;
    }

   
    public function getIdUsuario()
    {
        return $this->IdUsuario;
    }

    public function setIdUsuario($IdUsuario)
    {
        $this->IdUsuario = $IdUsuario;

        return $this;
    }

    public function getIdRol()
    {
        return $this->IdRol;
    }

    public function setIdRol($IdRol)
    {
        $this->IdRol = $IdRol;

        return $this;
    }
}

?>