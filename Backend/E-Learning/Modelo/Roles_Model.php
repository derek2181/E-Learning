<?php

class Roles_Model{
    private $IdRol;
    private $TipoRol;

    public function __construct(){
        
    }

    public static function createRoles($IdRol, $TipoRol){
        $instance = new self();
        $instance->setIdRol($IdRol);
        $instance->setTipoRol($TipoRol);

        return $instance;
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

    public function getTipoRol()
    {
        return $this->TipoRol;
    }

    public function setTipoRol($TipoRol)
    {
        $this->TipoRol = $TipoRol;

        return $this;
    }
}

?>