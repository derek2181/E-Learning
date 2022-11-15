<?php

include Constants::PROJECT_PATH_INCLUDE . "Vista/plugins/js/getid3/getid3.php";

class Niveles_Model{
    private $IdNivel;
    private $TituloNivel;

    private $PathVideoNivel;
    private $ContenidoNivel;
    private $PathPDFNivel;
    private $NivelGratis;

    private $FechaCreacionNivel;
    private $EstadoNivel;
    private $CursoImpartido;

    private $ProgresoNivel;

    public function __construct(){
        
    }

    public static function createNiveles($IdNivel, $TituloNivel, $PathVideoNivel, $ContenidoNivel, $PathPDFNivel, 
                                        $NivelGratis, $FechaCreacionNivel, $EstadoNivel, $CursoImpartido, $ProgresoNivel = null){
        $instance = new self();
        $instance->setIdNivel($IdNivel);
        $instance->setTituloNivel($TituloNivel);
        $instance->setPathVideoNivel($PathVideoNivel);
        $instance->setContenidoNivel($ContenidoNivel);
        $instance->setPathPDFNivel($PathPDFNivel);
        $instance->setNivelGratis($NivelGratis);
        $instance->setFechaCreacionNivel($FechaCreacionNivel);
        $instance->setEstadoNivel($EstadoNivel);
        $instance->setCursoImpartido($CursoImpartido);
        $instance->setProgresoNivel($ProgresoNivel);
        
        return $instance;
    }

    
    public function getIdNivel()
    {
        return $this->IdNivel;
    }

    public function setIdNivel($IdNivel)
    {
        $this->IdNivel = $IdNivel;

        return $this;
    }

    public function getTituloNivel()
    {
        return $this->TituloNivel;
    }

    public function setTituloNivel($TituloNivel)
    {
        $this->TituloNivel = $TituloNivel;

        return $this;
    }

    public function getPathVideoNivel()
    {
        return $this->PathVideoNivel;
    }

    public function setPathVideoNivel($PathVideoNivel)
    {
        $this->PathVideoNivel = $PathVideoNivel;

        return $this;
    }

    public function getCantMinutosVideo()
    {
        // include_once('pathto/getid3.php');

        if ($this->PathVideoNivel != null) {
            $getID3 = new getID3;
            $file = $getID3->analyze($_SERVER["DOCUMENT_ROOT"] . $this->PathVideoNivel);
            
            return $file['playtime_string'];
        }
        else 
            return null;
    }

    public function getContenidoNivel()
    {
        return $this->ContenidoNivel;
    }

    public function setContenidoNivel($ContenidoNivel)
    {
        $this->ContenidoNivel = $ContenidoNivel;

        return $this;
    }

    public function getPathPDFNivel()
    {
        return $this->PathPDFNivel;
    }

    public function setPathPDFNivel($PathPDFNivel)
    {
        $this->PathPDFNivel = $PathPDFNivel;

        return $this;
    }

    public function getNivelGratis()
    {
        return $this->NivelGratis;
    }

    public function setNivelGratis($NivelGratis)
    {
        $this->NivelGratis = $NivelGratis;

        return $this;
    }
    public function getFechaCreacionNivel()
    {
        return $this->FechaCreacionNivel;
    }

    public function setFechaCreacionNivel($FechaCreacionNivel)
    {
        $this->FechaCreacionNivel = $FechaCreacionNivel;

        return $this;
    }

    public function getEstadoNivel()
    {
        return $this->EstadoNivel;
    }

    public function setEstadoNivel($EstadoNivel)
    {
        $this->EstadoNivel = $EstadoNivel;

        return $this;
    }

    public function getCursoImpartido()
    {
        return $this->CursoImpartido;
    }

    public function setCursoImpartido($CursoImpartido)
    {
        $this->CursoImpartido = $CursoImpartido;

        return $this;
    }

    public function getProgresoNivel()
    {
            return $this->ProgresoNivel;
    }

    public function setProgresoNivel($ProgresoNivel)
    {
        $this->ProgresoNivel = $ProgresoNivel;

        return $this;
    }
}
