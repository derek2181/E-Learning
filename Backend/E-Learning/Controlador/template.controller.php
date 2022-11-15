<?php
require_once Constants::PROJECT_PATH_INCLUDE . "Controlador/controller.php";
require_once Constants::PROJECT_PATH_INCLUDE . "Controlador/inicioController.php";
require_once Constants::PROJECT_PATH_INCLUDE . "Controlador/usuariosController.php";
require_once Constants::PROJECT_PATH_INCLUDE . "Controlador/cursosController.php";
require_once Constants::PROJECT_PATH_INCLUDE . "Controlador/categoriasController.php";
require_once Constants::PROJECT_PATH_INCLUDE . "Controlador/comprasController.php";
require_once Constants::PROJECT_PATH_INCLUDE . "Controlador/mensajesController.php";
require_once Constants::PROJECT_PATH_INCLUDE . "Controlador/comentariosController.php";
require_once Constants::PROJECT_PATH_INCLUDE . "Controlador/calificacionesController.php";





class Template {
    private $controllers;
    //It must come from the DB
    // public const WEB_SITE = "https://localhost";
    // public const ROOT_PATH = "/bdm/";

    // public const PROJECT_PATH = "/bdm/Backend/E-Learning/";
    // public const VIEWS_PATH = self::PROJECT_PATH . "Vista/";
    // public const PROJECT_PATH_IMAGES_TEMP = self::PROJECT_PATH . "Files/Imagenes_Temp/";
    // public const PROJECT_PATH_VIDEOS = self::PROJECT_PATH . "Files/Videos/";
    // public const PROJECT_PATH_FILES = self::PROJECT_PATH . "Files/PDF/";

    // public const PROJECT_PATH_INCLUDE = "Backend/E-Learning/";

    public function __construct(){
        $this->InitializeControllers();
    }
    
    public function InitializeControllers(){
        //AQUI IRAN TODOS LOS CONTROLADORES
        $this->controllers = array(InicioController::ROUTE => new InicioController(),
                                    UsuariosController::ROUTE=> new UsuariosController(),
                                    CursosController::ROUTE=> new CursosController(),
                                    CategoriasController::ROUTE=> new CategoriasController(),
                                    ComprasController::ROUTE=> new ComprasController(),
                                    MensajesController::ROUTE=> new MensajesController(),
                                    ComentariosController::ROUTE=> new ComentariosController(),
                                    CalificacionesController::ROUTE=> new CalificacionesController(),
                                    ComprasController::ROUTE=> new ComprasController()
                                );

    }

    public function ShowTemplate(){
        include Constants::PROJECT_PATH_INCLUDE . "Vista/main-template.php";
    }

    //Determinar que controlador se va a usar para cada pagina 
    public function DeterminePage(){
        Controller::ValidateControllersPath($this->controllers);
    }

    public function CallScripts(){
        if(function_exists("Scripts")){
            call_user_func("Scripts");
        }
    }
    
   

    public static function Route($controller, $action){
        $route = Constants::ROOT_PATH;
        if($action != null)
            $route = Constants::ROOT_PATH.$controller."/".$action;
        else
            $route = Constants::ROOT_PATH.$controller;
        return $route;
    }
    
   
}


