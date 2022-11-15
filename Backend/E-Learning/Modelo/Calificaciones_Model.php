<?php

class Calificaciones_Model{
    private $UsuarioCalifico;
    private $CursoCalificado;
    private $UtilidadCalificacion;
    private $FechaCreacionCalificacion;
    private $EstadoCalificacion;

    public function __construct(){
        
    }

    public static function createCalificaciones($UsuarioCalifico, $CursoCalificado, $UtilidadCalificacion, $FechaCreacionCalificacion, $EstadoCalificacion){
        $instance = new self();
        $instance->setUsuarioCalifico($UsuarioCalifico);
        $instance->setCursoCalificado($CursoCalificado);
        $instance->setUtilidadCalificacion($UtilidadCalificacion);
        $instance->setFechaCreacionCalificacion($FechaCreacionCalificacion);
        $instance->setEstadoCalificacion($EstadoCalificacion);

        return $instance;
    }

    public function getUsuarioCalifico()
    {
        return $this->UsuarioCalifico;
    }

    public function setUsuarioCalifico($UsuarioCalifico)
    {
        $this->UsuarioCalifico = $UsuarioCalifico;

        return $this;
    }

    public function getCursoCalificado()
    {
        return $this->CursoCalificado;
    }

    public function setCursoCalificado($CursoCalificado)
    {
        $this->CursoCalificado = $CursoCalificado;

        return $this;
    }

    public function getUtilidadCalificacion()
    {
        return $this->UtilidadCalificacion;
    }

    public function setUtilidadCalificacion($UtilidadCalificacion)
    {
        $this->UtilidadCalificacion = $UtilidadCalificacion;

        return $this;
    }

    public function getFechaCreacionCalificacion()
    {
        return $this->FechaCreacionCalificacion;
    }

    public function setFechaCreacionCalificacion($FechaCreacionCalificacion)
    {
        $this->FechaCreacionCalificacion = $FechaCreacionCalificacion;

        return $this;
    }

    public function getEstadoCalificacion()
    {
        return $this->EstadoCalificacion;
    }

    public function setEstadoCalificacion($EstadoCalificacion)
    {
        $this->EstadoCalificacion = $EstadoCalificacion;

        return $this;
    }
}

?>