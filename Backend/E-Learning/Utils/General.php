<?php

abstract class Rol
{
    const Escuela = 1;
    const Estudiante = 2;
}

class General
{

    const LOAD_IMAGE = false; 
    public function __construct()
    {
    }

    static public function startSession()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    }


    static public function getCookieCorreo()
    {
        $CorreoUsuario = null;
        if (isset($_COOKIE["CorreoUsuario"])) {
            $CorreoUsuario = $_COOKIE["CorreoUsuario"];
        }
        return $CorreoUsuario;
    }

    static public function setCookieCorreo($CorreoUsuario)
    {
        setcookie ("CorreoUsuario", $CorreoUsuario, time()+604800);
    }


    static public function getUsuarioLoggeadoFacebook()
    {
        self::startSession();
        $UsuarioLoggeado = null;
        if (isset($_SESSION["UsuarioLoggeadoFacebook"])) {
            $UsuarioLoggeado = $_SESSION["UsuarioLoggeadoFacebook"];
        }
        return $UsuarioLoggeado;
    }


    static public function setUsuarioLoggeadoFacebook($isUsuioLoggeadoFB)
    {
        self::startSession();
        $_SESSION["UsuarioLoggeadoFacebook"] = $isUsuioLoggeadoFB;
    }


    static public function getUsuarioIncorrectoEnLogin()
    {
        self::startSession();
        $UsuarioIncorrectoEnLogin = null;
        if (isset($_SESSION["UsuarioIncorrectoEnLogin"])) {
            $UsuarioIncorrectoEnLogin = $_SESSION["UsuarioIncorrectoEnLogin"];
        }
        return $UsuarioIncorrectoEnLogin;
    }


    static public function setUsuarioIncorrectoEnLogin($UsuarioIncorrectoEnLogin)
    {
        self::startSession();
        $_SESSION["UsuarioIncorrectoEnLogin"] = $UsuarioIncorrectoEnLogin;
    }

    static public function getPerfilEditadoCorrectamente()
    {
        self::startSession();
        $perfilEditadoCorrectamente = null;
        if (isset($_SESSION["perfilEditadoCorrectamente"])) {
            $perfilEditadoCorrectamente = $_SESSION["perfilEditadoCorrectamente"];
        }
        return $perfilEditadoCorrectamente;
    }
    static public function getContraEditadoCorrectamente()
    {
        self::startSession();
        $contraEditadoCorrectamente = null;
        if (isset($_SESSION["contraEditadoCorrectamente"])) {
            $contraEditadoCorrectamente = $_SESSION["contraEditadoCorrectamente"];
        }
        return $contraEditadoCorrectamente;
    }
    static public function setPerfilEditadoCorrectamente($perfilEditadoCorrectamente)
    {
        self::startSession();
        $_SESSION["perfilEditadoCorrectamente"] = $perfilEditadoCorrectamente;
    }

    static public function setContrasenaEditadaCorrectamente($contraEditadoCorrectamente){
        self::startSession();
        $_SESSION["contraEditadoCorrectamente"] = $contraEditadoCorrectamente;
    }

    static public function isTipoRol($TipoRol)
    {
        self::startSession();
        $isTipoRol = false;
        if (isset($_SESSION["IdUsuarioActivo"]) && isset($_SESSION["RolUsuarioActivo"])) {
            if ($_SESSION["RolUsuarioActivo"] == $TipoRol) {
                $isTipoRol = true;
            }
        }
        return $isTipoRol;
    }
static public function validarPorExtensiones($extensiones,$filename){
    $ext = pathinfo($filename, PATHINFO_EXTENSION);
    if (!in_array($ext, $extensiones)) {
        return false;
    }else{
        return true;
    }
}
    static public function isUsuarioActivo($UsuarioActivo)
    {
        self::startSession();
        $isUsuarioActivo = false;
        if (isset($_SESSION["IdUsuarioActivo"]) && isset($_SESSION["RolUsuarioActivo"])) {
            if ($_SESSION["IdUsuarioActivo"] == $UsuarioActivo) {
                $isUsuarioActivo = true;
            }
        }
        return $isUsuarioActivo;
    }

    static public function getIdUsuarioActivo()
    {
        self::startSession();
        $IdUsuarioActivo = -1;
        if (isset($_SESSION["IdUsuarioActivo"]) && isset($_SESSION["RolUsuarioActivo"])) {
            $IdUsuarioActivo = $_SESSION["IdUsuarioActivo"];
        }
        return $IdUsuarioActivo;
    }


    static public function getRolUsuarioActivo()
    {
        self::startSession();
        $RolUsuarioActivo = -1;
        if (isset($_SESSION["IdUsuarioActivo"]) && isset($_SESSION["RolUsuarioActivo"])) {
            $RolUsuarioActivo = $_SESSION["RolUsuarioActivo"];
        }
        return $RolUsuarioActivo;
    }

    static public function setIdUsuarioActivo($IdUsuarioActivo)
    {
        self::startSession();
        $_SESSION["IdUsuarioActivo"] = $IdUsuarioActivo;
    }


    static public function setRolUsuarioActivo($RolUsuarioActivo)
    {
        self::startSession();
        $_SESSION["RolUsuarioActivo"] = $RolUsuarioActivo;
    }

    static public function isSetUsuarioActivo()
    {
        self::startSession();
        $isSetUsuarioActivo = false;
        if (isset($_SESSION["IdUsuarioActivo"]) && isset($_SESSION["RolUsuarioActivo"])) {
            $isSetUsuarioActivo = true;
        }
        return $isSetUsuarioActivo;
    }

    static public function isExistingRow($row, $rowName)
    {
        $Field = null;
        if (isset($row[$rowName]))
            $Field = $row[$rowName];
        return $Field;
    }


    static public function isInteger($number){
        return !is_int($number) ? (ctype_digit($number)) : true;
    }

    static public function isPositiveNumber($number){
        if (is_numeric($number)){
            if ($number >= 0){
                return true;
            }
        }
        return false;
    }
}
