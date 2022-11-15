<?php
class Cursos_Model implements JsonSerializable{
    private $IdCurso;
    private $TituloCurso;
    private $DescripcionCurso;
    private $ImagenCurso;
    private $CostoCurso;
    private $FechaCreacionCurso;
    private $EstadoCurso;
    private $UsuarioCreador;
    private $NombreCompletoUsuarioEstudiante;

    private $NombreCompletoUsuarioCreador;
    private $ImagenPerfilUsuarioCreador;

    private $PorcentajeCalificacion;

    private $NumeroCursoPaginacion;

    private $NombreCompletoUsuario;
    private $CategoriaFiltro;

    private $FechaDesdeCreacionCurso;
    private $FechaHastaCreacionCurso;

    private $compraCurso;

    private $IdRolUsuario;
    private $NivelPromedio;
    private $CantidadAlumnos;
    private $TotalIngresos;
    private $IngresosPayPal;
    private $IngresosTarjeta;

    



    public function __construct(){
        $this->compraCurso = new Compras_Model();
    }

    public static function createCurso($IdCurso, $TituloCurso, $DescripcionCurso, $ImagenCurso, $CostoCurso, $FechaCreacionCurso, $EstadoCurso, $UsuarioCreador, 
                                        $NombreCompletoUsuarioCreador = null, $ImagenPerfilUsuarioCreador = null, 
                                        $PorcentajeCalificacion = null, 
                                        $NumeroCursoPaginacion = null,
                                        $NombreCompletoUsuario = null,
                                        $CategoriaFiltro = null,
                                        $FechaDesdeCreacionCurso = null,
                                        $FechaHastaCreacionCurso = null,
                                        $compraCurso = null,
                                        $IdRolUsuario = null,
                                        $NivelPromedio=null,
                                        $CantidadAlumnos=null,
                                        $TotalIngresos=null,
                                        $IngresosPayPal=null,
                                        $IngresosTarjeta=null,
                                        $NombreCompletoUsuarioEstudiante=null){
        $instance = new self();
        $instance->setIdCurso($IdCurso);
        $instance->setTituloCurso($TituloCurso);
        $instance->setDescripcionCurso($DescripcionCurso);
        $instance->setImagenCurso($ImagenCurso);
        $instance->setCostoCurso($CostoCurso);
        $instance->setFechaCreacionCurso($FechaCreacionCurso);
        $instance->setEstadoCurso($EstadoCurso);
        $instance->setUsuarioCreador($UsuarioCreador);
        $instance->setNombreCompletoUsuarioCreador($NombreCompletoUsuarioCreador);
        $instance->setImagenPerfilUsuarioCreador($ImagenPerfilUsuarioCreador);
        $instance->setPorcentajeCalificacion($PorcentajeCalificacion);
        $instance->setNumeroCursoPaginacion($NumeroCursoPaginacion);
        $instance->setNombreCompletoUsuario($NombreCompletoUsuario);
        $instance->setCategoriaFiltro($CategoriaFiltro);
        $instance->setFechaDesdeCreacionCurso($FechaDesdeCreacionCurso);
        $instance->setFechaHastaCreacionCurso($FechaHastaCreacionCurso);
        $instance->setCompraCurso($compraCurso);
        $instance->setIdRolUsuario($IdRolUsuario);
        $instance->setNivelPromedio($NivelPromedio);
        $instance->setCantidadAlumnos($CantidadAlumnos);
        $instance->setTotalIngresos($TotalIngresos);

        $instance->setIngresosPayPal($IngresosPayPal);
        $instance->setIngresosTarjeta($IngresosTarjeta);
        $instance->setNombreCompletoUsuarioEstudiante($NombreCompletoUsuarioEstudiante);
        return $instance;
    }

    
    public function jsonSerialize() {

        return array(
            'IdCurso' => $this->IdCurso,
            'TituloCurso' => $this->TituloCurso,
            'DescripcionCurso' => $this->DescripcionCurso,
            'ImagenCurso' => $this->ImagenCurso,
            'CostoCurso' => $this->CostoCurso,
            'FechaCreacionCurso' => $this->FechaCreacionCurso,
            'EstadoCurso' => $this->EstadoCurso,
            'UsuarioCreador' => $this->UsuarioCreador,
            'NombreCompletoUsuarioCreador' => $this->NombreCompletoUsuarioCreador,
            'ImagenPerfilUsuarioCreador' => $this->ImagenPerfilUsuarioCreador,
            'PorcentajeCalificacion' => $this->getPorcentajeCalificacionRedondeado(),
            'NumeroCursoPaginacion' => $this->NumeroCursoPaginacion,
            'NombreCompletoUsuario' => $this->NombreCompletoUsuario,
            'CategoriaFiltro' => $this->CategoriaFiltro,
            'FechaDesdeCreacionCurso' => $this->FechaDesdeCreacionCurso,
            'FechaHastaCreacionCurso' => $this->FechaHastaCreacionCurso,
            'ProgresoCursoComprado' => $this->compraCurso==null ? null : $this->compraCurso->getProgresoCursoComprado(),
            'CantidadAlumnos' => $this->getCantidadAlumnos(),
            "TotalIngresos"=> $this->getTotalIngresosConFormato()
       );
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

    public function getTituloCurso()
    {
        return $this->TituloCurso;
    }

    public function setTituloCurso($TituloCurso)
    {
        $this->TituloCurso = $TituloCurso;

        return $this;
    }

    public function getDescripcionCurso()
    {
        return $this->DescripcionCurso;
    }

    public function setDescripcionCurso($DescripcionCurso)
    {
        $this->DescripcionCurso = $DescripcionCurso;

        return $this;
    }

    public function getImagenCurso()
    {
        return $this->ImagenCurso;
    }

    public function setImagenCurso($ImagenCurso)
    {
        $this->ImagenCurso = $ImagenCurso;

        return $this;
    }

    public function getCostoCurso()
    {
        return $this->CostoCurso;
    }

    public function getCostoCursoConFormato()
    {
        return number_format((float)$this->CostoCurso, 2, '.', ',');
    }

    public function setCostoCurso($CostoCurso)
    {
        $this->CostoCurso = $CostoCurso;

        return $this;
    }
    
    public function getFechaCreacionCurso()
    {
        return $this->FechaCreacionCurso;
    }

    public function setFechaCreacionCurso($FechaCreacionCurso)
    {
        $this->FechaCreacionCurso = $FechaCreacionCurso;

        return $this;
    }

    public function getEstadoCurso()
    {
        return $this->EstadoCurso;
    }

    public function setEstadoCurso($EstadoCurso)
    {
        $this->EstadoCurso = $EstadoCurso;

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


    public function getNombreCompletoUsuarioCreador()
    {
        return $this->NombreCompletoUsuarioCreador;
    }

    public function setNombreCompletoUsuarioCreador($NombreCompletoUsuarioCreador)
    {
        $this->NombreCompletoUsuarioCreador = $NombreCompletoUsuarioCreador;

        return $this;
    }

    
    public function getImagenPerfilUsuarioCreador()
    {
        return $this->ImagenPerfilUsuarioCreador;
    }

    public function setImagenPerfilUsuarioCreador($ImagenPerfilUsuarioCreador)
    {
        $this->ImagenPerfilUsuarioCreador = $ImagenPerfilUsuarioCreador;

        return $this;
    }

    public function getPorcentajeCalificacion()
    {
        return $this->PorcentajeCalificacion;
    }
    
    public function getPorcentajeCalificacionRedondeado()
    {
        return round($this->PorcentajeCalificacion);
    }

    public function setPorcentajeCalificacion($PorcentajeCalificacion)
    {
        $this->PorcentajeCalificacion = $PorcentajeCalificacion;

        return $this;
    }

    public function getNumeroCursoPaginacion()
    {
        return $this->NumeroCursoPaginacion;
    }

    public function setNumeroCursoPaginacion($NumeroCursoPaginacion)
    {
        $this->NumeroCursoPaginacion = $NumeroCursoPaginacion;

        return $this;
    }

    public function getNombreCompletoUsuario()
    {
        return $this->NombreCompletoUsuario;
    }

    public function setNombreCompletoUsuario($NombreCompletoUsuario)
    {
        $this->NombreCompletoUsuario = $NombreCompletoUsuario;

        return $this;
    }

    public function getCategoriaFiltro()
    {
        return $this->CategoriaFiltro;
    }

    public function setCategoriaFiltro($CategoriaFiltro)
    {
        $this->CategoriaFiltro = $CategoriaFiltro;

        return $this;
    }

    public function getFechaDesdeCreacionCurso()
    {
        return $this->FechaDesdeCreacionCurso;
    }

    public function setFechaDesdeCreacionCurso($FechaDesdeCreacionCurso)
    {
        $this->FechaDesdeCreacionCurso = $FechaDesdeCreacionCurso;

        return $this;
    }

    public function getFechaHastaCreacionCurso()
    {
        return $this->FechaHastaCreacionCurso;
    }

    public function setFechaHastaCreacionCurso($FechaHastaCreacionCurso)
    {
        $this->FechaHastaCreacionCurso = $FechaHastaCreacionCurso;

        return $this;
    }

    public function getCompraCurso()
    {
        return $this->compraCurso;
    }

    public function setCompraCurso($compraCurso)
    {
        $this->compraCurso = $compraCurso;

        return $this;
    }


    public function getIdRolUsuario()
    {
        return $this->IdRolUsuario;
    }

    public function setIdRolUsuario($IdRolUsuario)
    {
        $this->IdRolUsuario = $IdRolUsuario;

        return $this;
    }

    public function getNivelPromedio()
    {
        return $this->NivelPromedio;
    }

    public function setNivelPromedio($NivelPromedio)
    {
        $this->NivelPromedio = $NivelPromedio;

        return $this;
    }
    public function setCantidadAlumnos($CantidadAlumnos)
    {
        $this->CantidadAlumnos = $CantidadAlumnos;

        return $this;
    }
    public function getCantidadAlumnos()
    {
        return $this->CantidadAlumnos;
    }



    public function setTotalIngresos($TotalIngresos)
    {
        $this->TotalIngresos = $TotalIngresos;

        return $this;
    }
    public function getTotalIngresos()
    {
        return $this->TotalIngresos;
    }
    public function getTotalIngresosConFormato()
    {
        return number_format((float)$this->TotalIngresos, 2, '.', ',');
    }
   
   public function getIngresosPayPal()
   {
       return $this->IngresosPayPal;
   }
   public function getIngresosPayPalConFormato()
   {
       return number_format((float)$this->IngresosPayPal, 2, '.', ',');
   }

   public function setIngresosPayPal($IngresosPayPal)
   {
       $this->IngresosPayPal = $IngresosPayPal;

       return $this;
   }

  
   public function getIngresosTarjeta()
   {
       return $this->IngresosTarjeta;
   }
   public function getIngresosTarjetaConFormato()
   {
       return number_format((float)$this->IngresosTarjeta, 2, '.', ',');
   }

  
   public function setIngresosTarjeta($IngresosTarjeta)
   {
       $this->IngresosTarjeta = $IngresosTarjeta;

       return $this;
   }

   
   public function getNombreCompletoUsuarioEstudiante()
   {
       return $this->NombreCompletoUsuarioEstudiante;
   }

  
   public function setNombreCompletoUsuarioEstudiante($NombreCompletoUsuarioEstudiante)
   {
       $this->NombreCompletoUsuarioEstudiante = $NombreCompletoUsuarioEstudiante;

       return $this;
   }


}

?>