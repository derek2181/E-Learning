<?php

class CursCat_Model{
    private $IdCurso;
    private $IdCategoria;

    public function __construct(){
        
    }

    public static function createCursCat($IdCurso, $IdCategoria){
        $instance = new self();
        $instance->setIdCurso($IdCurso);
        $instance->setIdCategoria($IdCategoria);

        return $instance;
    }

    public function getIdCurso()
    {
        return $this->IdCurso;
    }

    public function setIdCurso($IdCurso)
    {
        $this->IdCurso = $IdCurso;

        return $this;
    }

    public function getIdCategoria()
    {
        return $this->IdCategoria;
    }

    public function setIdCategoria($IdCategoria)
    {
        $this->IdCategoria = $IdCategoria;

        return $this;
    }

}

?>