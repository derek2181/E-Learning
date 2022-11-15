<?php

class Compras_Model {
    private $UsuarioComprador;
    private $CursoComprado;
    private $FechaCreacionCompra;
    private $ProgresoCursoComprado;
    private $Pago;
    private $FormaDePago;
    private $FechaUltimaVisualizacion;
    private $FechaCompletado;
    private $NombreCompletoUsuarioComprador;

    private $NivelCursoComprado;

    public function __construct(){
        
    }

    public static function createCompras($UsuarioComprador, $CursoComprado,$ProgresoCursoComprado,
    $FormaDePago = null,$Pago = null, $FechaCreacionCompra = null, $FechaUltimaVisualizacion = null, $FechaCompletado = null, $NombreCompletoUsuarioComprador = null, $NivelCursoComprado = null){
        $instance = new self();
        $instance->setUsuarioComprador($UsuarioComprador);
        $instance->setCursoComprado($CursoComprado);
        $instance->setProgresoCursoComprado($ProgresoCursoComprado);
        $instance->setFormaDePago($FormaDePago);
        $instance->setPago($Pago);
        $instance->setFechaCreacionCompra($FechaCreacionCompra);
        $instance->setFechaUltimaVisualizacion($FechaUltimaVisualizacion);
        $instance->setFechaCompletado($FechaCompletado);
        $instance->setNombreCompletoUsuarioComprador($NombreCompletoUsuarioComprador);
        $instance->setNivelCursoComprado($NivelCursoComprado);
        return $instance;
    }

   

    public function setPago($Pago){
        $this->Pago=$Pago;
    }
    public function getPago(){
        return $this->Pago;
    }
    public function getPagoConFormato(){
        return number_format((float)$this->Pago, 2, '.', ',');
    }

    public function getUsuarioComprador()
    {
        return $this->UsuarioComprador;
    }

    public function setUsuarioComprador($UsuarioComprador)
    {
        $this->UsuarioComprador = $UsuarioComprador;
    }

    public function getCursoComprado()
    {
        return $this->CursoComprado;
    }

    public function setCursoComprado($CursoComprado)
    {
        $this->CursoComprado = $CursoComprado;
    }

    public function getFechaCreacionCompra()
    {
        return $this->FechaCreacionCompra;
    }

    public function setFechaCreacionCompra($FechaCreacionCompra)
    {
        $this->FechaCreacionCompra = $FechaCreacionCompra;
    }

    public function getFechaCreacionConFormatoCompra()
    {
        setlocale(LC_ALL, "es_ES@euro", "es_ES", "esp");

        $date = $this->FechaCreacionCompra;

        $date = strtotime($date);


        $myFormatDate = strftime('%e/%b/%Y', $date);
        
        return strtoupper($myFormatDate);
    }

    public function getProgresoCursoComprado()
    {
        return $this->ProgresoCursoComprado;
    }

    public function setProgresoCursoComprado($ProgresoCursoComprado)
    {
        $this->ProgresoCursoComprado = $ProgresoCursoComprado;
    }

    public function getFormaDePago(){
        return $this->FormaDePago;
    }

    public function setFormaDePago($FormaDePago){
        $this->FormaDePago=$FormaDePago;
   
    }

    public function getFechaUltimaVisualizacion()
    {
        return $this->FechaUltimaVisualizacion;
    }

    public function getFechaUltimaVisualizacionConFormatoCompra()
    {
        setlocale(LC_ALL, "es_ES@euro", "es_ES", "esp");

        $date = $this->FechaUltimaVisualizacion;

        $date = strtotime($date);


        $myFormatDate = strftime('%e/%b/%Y', $date);
        
        return strtoupper($myFormatDate);
    }

    public function setFechaUltimaVisualizacion($FechaUltimaVisualizacion)
    {
        $this->FechaUltimaVisualizacion = $FechaUltimaVisualizacion;

        return $this;
    }

    public function getFechaCompletado()
    {
        return $this->FechaCompletado;
    }

    public function getFechaCompletadoConFormatoCompra()
    {
        setlocale(LC_ALL, "es_ES@euro", "es_ES", "esp");

        $date = $this->FechaCompletado;

        $date = strtotime($date);


        $myFormatDate = strftime('%e/%b/%Y', $date);
        
        return strtoupper($myFormatDate);
    }

    public function setFechaCompletado($FechaCompletado)
    {
        $this->FechaCompletado = $FechaCompletado;

        return $this;
    }

    public function getNombreCompletoUsuarioComprador()
    {
        return $this->NombreCompletoUsuarioComprador;
    }

    public function setNombreCompletoUsuarioComprador($NombreCompletoUsuarioComprador)
    {
        $this->NombreCompletoUsuarioComprador = $NombreCompletoUsuarioComprador;

        return $this;
    }

    public function getNivelCursoComprado()
    {
        return $this->NivelCursoComprado;
    }

    public function setNivelCursoComprado($NivelCursoComprado)
    {
        $this->NivelCursoComprado = $NivelCursoComprado;

        return $this;
    }

}

?>