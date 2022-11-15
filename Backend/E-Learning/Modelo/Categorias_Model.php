<?php
class Categorias_Model implements JsonSerializable {
    private $IdCategoria;
    private $TituloCategoria;
    private $DescripcionCategoria;
    private $FechaCreacionCategoria;
    private $EstadoCategoria;
    private $UsuarioCreador;
    private $CursosRelacionados;

    public function __construct(){
        
    }

    public static function createCategorias($IdCategoria, $TituloCategoria, $DescripcionCategoria, 
                                            $FechaCreacionCategoria, $EstadoCategoria, $UsuarioCreador, 
                                            $CursosRelacionados = null){
        $instance = new self();
        $instance->setIdCategoria($IdCategoria);
        $instance->setTituloCategoria($TituloCategoria);
        $instance->setDescripcionCategoria($DescripcionCategoria);
        $instance->setFechaCreacionCategoria($FechaCreacionCategoria);
        $instance->setEstadoCategoria($EstadoCategoria);
        $instance->setUsuarioCreador($UsuarioCreador);

        $instance->setCursosRelacionados($CursosRelacionados);

        return $instance;
    }

    public function jsonSerialize() {
           
        return array(
            'TituloCategoria' => $this->TituloCategoria,
            'DescripcionCategoria'=>$this->DescripcionCategoria,
            'IdCategoria' => $this->IdCategoria,
       );
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

    public function getTituloCategoria()
    {
        return $this->TituloCategoria;
    }

    public function setTituloCategoria($TituloCategoria)
    {
        $this->TituloCategoria = $TituloCategoria;

        return $this;
    }

    public function getDescripcionCategoria()
    {
        return $this->DescripcionCategoria;
    }

    public function setDescripcionCategoria($DescripcionCategoria)
    {
        $this->DescripcionCategoria = $DescripcionCategoria;

        return $this;
    }


    public function getFechaCreacionCategoria()
    {
        return $this->FechaCreacionCategoria;
    }

    public function setFechaCreacionCategoria($FechaCreacionCategoria)
    {
        $this->FechaCreacionCategoria = $FechaCreacionCategoria;

        return $this;
    }

    public function getEstadoCategoria()
    {
        return $this->EstadoCategoria;
    }

    public function setEstadoCategoria($EstadoCategoria)
    {
        $this->EstadoCategoria = $EstadoCategoria;

        return $this;
    }

    public function getUsuarioCreador()
    {
        return $this->UsuarioCreador;
    }

    public function setUsuarioCreador($UsuarioCreador)
    {
        $this->UsuarioCreador = $UsuarioCreador;

        return $this;
    }

    public function getCursosRelacionados()
    {
        return $this->CursosRelacionados;
    }

    public function setCursosRelacionados($CursosRelacionados)
    {
        $this->CursosRelacionados = $CursosRelacionados;

        return $this;
    }


}

?>