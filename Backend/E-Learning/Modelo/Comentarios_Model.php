<?php

class Comentarios_Model implements JsonSerializable
{
    private $IdComentario;
    private $UsuarioComento;
    private $CursoComentado;
    private $DescripcionComentario;
    private $FechaCreacionComentario;
    private $EstadoComentario;

    private $NombreCompletoUsuarioComento;
    private $ImagenPerfilUsuarioComento;

    private $NumeroComentarioPaginacion;

    public function __construct()
    {
    }

    public static function createComentarios(
        $IdComentario,
        $UsuarioComento,
        $CursoComentado,
        $DescripcionComentario,
        $FechaCreacionComentario,
        $EstadoComentario,
        $NombreCompletoUsuarioComento = null,
        $ImagenPerfilUsuarioComento = null,
        $NumeroComentarioPaginacion = null
    ) {
        $instance = new self();
        $instance->setIdComentario($IdComentario);
        $instance->setUsuarioComento($UsuarioComento);
        $instance->setCursoComentado($CursoComentado);
        $instance->setDescripcionComentario($DescripcionComentario);
        $instance->setFechaCreacionComentario($FechaCreacionComentario);
        $instance->setEstadoComentario($EstadoComentario);

        $instance->setNombreCompletoUsuarioComento($NombreCompletoUsuarioComento);
        $instance->setImagenPerfilUsuarioComento($ImagenPerfilUsuarioComento);
        $instance->setNumeroComentarioPaginacion($NumeroComentarioPaginacion);

        return $instance;
    }

    public function jsonSerialize() {
           
        return array(
            'IdComentario' => $this->IdComentario,
            'UsuarioComento' => $this->UsuarioComento,
            'CursoComentado' => $this->CursoComentado,
            'DescripcionComentario' => $this->DescripcionComentario,
            'FechaCreacionComentario' => $this->getFechaCreacionConFormatoComentario(),
            'EstadoComentario' => $this->EstadoComentario,
            'NombreCompletoUsuarioComento' => $this->NombreCompletoUsuarioComento,
            'ImagenPerfilUsuarioComento' => $this->ImagenPerfilUsuarioComento,
            'NumeroComentarioPaginacion' => $this->NumeroComentarioPaginacion,
       );
    }

    public function getIdComentario()
    {
        return $this->IdComentario;
    }

    public function setIdComentario($IdComentario)
    {
        $this->IdComentario = $IdComentario;

        return $this;
    }

    public function getUsuarioComento()
    {
        return $this->UsuarioComento;
    }

    public function setUsuarioComento($UsuarioComento)
    {
        $this->UsuarioComento = $UsuarioComento;

        return $this;
    }

    public function getCursoComentado()
    {
        return $this->CursoComentado;
    }

    public function setCursoComentado($CursoComentado)
    {
        $this->CursoComentado = $CursoComentado;

        return $this;
    }

    public function getDescripcionComentario()
    {
        return $this->DescripcionComentario;
    }

    public function setDescripcionComentario($DescripcionComentario)
    {
        $this->DescripcionComentario = $DescripcionComentario;

        return $this;
    }

    public function getFechaCreacionComentario()
    {
        return $this->FechaCreacionComentario;
    }

    public function setFechaCreacionComentario($FechaCreacionComentario)
    {
        $this->FechaCreacionComentario = $FechaCreacionComentario;

        return $this;
    }

    public function getFechaCreacionConFormatoComentario()
    {
        setlocale(LC_ALL, "es_ES@euro", "es_ES", "esp");

        $date = $this->FechaCreacionComentario;

        $date = strtotime($date);


        $myFormatDate = strftime('%e/%b/%Y', $date);
        
        return strtoupper($myFormatDate);
    }

    public function getEstadoComentario()
    {
        return $this->EstadoComentario;
    }

    public function setEstadoComentario($EstadoComentario)
    {
        $this->EstadoComentario = $EstadoComentario;

        return $this;
    }


    public function getNombreCompletoUsuarioComento()
    {
        return $this->NombreCompletoUsuarioComento;
    }

    public function setNombreCompletoUsuarioComento($NombreCompletoUsuarioComento)
    {
        $this->NombreCompletoUsuarioComento = $NombreCompletoUsuarioComento;

        return $this;
    }

    public function getImagenPerfilUsuarioComento()
    {
        return $this->ImagenPerfilUsuarioComento;
    }

    public function setImagenPerfilUsuarioComento($ImagenPerfilUsuarioComento)
    {
        $this->ImagenPerfilUsuarioComento = $ImagenPerfilUsuarioComento;

        return $this;
    }

    public function getNumeroComentarioPaginacion()
    {
        return $this->NumeroComentarioPaginacion;
    }

    public function setNumeroComentarioPaginacion($NumeroComentarioPaginacion)
    {
        $this->NumeroComentarioPaginacion = $NumeroComentarioPaginacion;

        return $this;
    }
}
?>