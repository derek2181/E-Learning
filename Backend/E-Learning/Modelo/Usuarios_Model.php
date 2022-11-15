<?php
class Usuarios_Model{
    private $IdUsuario;
    private $NombreUsuario;
    private $ApellidoPaternoUsuario;
    private $ApellidoMaternoUsuario;
    private $GeneroUsuario;
    private $FechaNacimientoUsuario;
    private $ImagenPerfilUsuario;
    private $CorreoUsuario;
    private $PasswordUsuario;
    private $FechaCreacionUsuario;
    private $EstadoUsuario;
    private $IdRol;
    private $TipoRol;

    public function __construct(){
        
    }

    public static function createUsuario($IdUsuario, $NombreUsuario, $ApellidoPaternoUsuario, $ApellidoMaternoUsuario, $GeneroUsuario, $FechaNacimientoUsuario, 
                                        $ImagenPerfilUsuario, $CorreoUsuario, $PasswordUsuario, $FechaCreacionUsuario, $EstadoUsuario, $IdRol, $TipoRol = null){
        $instance = new self();
        $instance->setIdUsuario($IdUsuario);
        $instance->setNombreUsuario($NombreUsuario);
        $instance->setApellidoPaternoUsuario($ApellidoPaternoUsuario);
        $instance->setApellidoMaternoUsuario($ApellidoMaternoUsuario);
        $instance->setGeneroUsuario($GeneroUsuario);
        $instance->setFechaNacimientoUsuario($FechaNacimientoUsuario);
        $instance->setImagenPerfilUsuario($ImagenPerfilUsuario);
        $instance->setCorreoUsuario($CorreoUsuario);
        $instance->setPasswordUsuario($PasswordUsuario);
        $instance->setFechaCreacionUsuario($FechaCreacionUsuario);
        $instance->setEstadoUsuario($EstadoUsuario);
        $instance->setIdRol($IdRol);
        $instance->setTipoRol($TipoRol);

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

   
    public function getNombreUsuario()
    {
        return $this->NombreUsuario;
    }

   
    public function setNombreUsuario($NombreUsuario)
    {
        $this->NombreUsuario = $NombreUsuario;

        return $this;
    }

    
    public function getApellidoPaternoUsuario()
    {
        return $this->ApellidoPaternoUsuario;
    }

    public function setApellidoPaternoUsuario($ApellidoPaternoUsuario)
    {
        $this->ApellidoPaternoUsuario = $ApellidoPaternoUsuario;

        return $this;
    }

   
    public function getApellidoMaternoUsuario()
    {
        return $this->ApellidoMaternoUsuario;
    }

   
    public function setApellidoMaternoUsuario($ApellidoMaternoUsuario)
    {
        $this->ApellidoMaternoUsuario = $ApellidoMaternoUsuario;

        return $this;
    }

    public function getNombreCompletoUsuario(){
        return $this->NombreUsuario . " " . $this->ApellidoPaternoUsuario;
    }
    
    public function getGeneroUsuario()
    {
        return $this->GeneroUsuario;
    }

    public function isGeneroUsuarioEqualTo($GeneroUsuario)
    {
        return $this->GeneroUsuario == $GeneroUsuario;
    }

    public function setGeneroUsuario($GeneroUsuario)
    {
        $this->GeneroUsuario = $GeneroUsuario;

        return $this;
    }

    public function getFechaNacimientoUsuario()
    {
        return $this->FechaNacimientoUsuario;
    }

   
    public function setFechaNacimientoUsuario($FechaNacimientoUsuario)
    {
        $this->FechaNacimientoUsuario = $FechaNacimientoUsuario;

        return $this;
    }

   
    public function getImagenPerfilUsuario()
    {
        return $this->ImagenPerfilUsuario;
    }


    public function setImagenPerfilUsuario($ImagenPerfilUsuario)
    {
        $this->ImagenPerfilUsuario = $ImagenPerfilUsuario;

        return $this;
    }

    public function getCorreoUsuario()
    {
        return $this->CorreoUsuario;
    }

  
    public function setCorreoUsuario($CorreoUsuario)
    {
        $this->CorreoUsuario = $CorreoUsuario;

        return $this;
    }
    public function getPasswordUsuario()
    {
        return $this->PasswordUsuario;
    }

    public function setPasswordUsuario($PasswordUsuario)
    {
        $this->PasswordUsuario = $PasswordUsuario;

        return $this;
    }

    public function getFechaCreacionUsuario()
    {
        return $this->FechaCreacionUsuario;
    }

    public function setFechaCreacionUsuario($FechaCreacionUsuario)
    {
        $this->FechaCreacionUsuario = $FechaCreacionUsuario;

        return $this;
    }

    public function getEstadoUsuario()
    {
        return $this->EstadoUsuario;
    }

    public function setEstadoUsuario($EstadoUsuario)
    {
        $this->EstadoUsuario = $EstadoUsuario;

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