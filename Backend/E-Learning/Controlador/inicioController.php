<?php

require_once Constants::PROJECT_PATH_INCLUDE . "Controlador/template.controller.php";

require_once  Constants::PROJECT_PATH_INCLUDE . 'DAO/Cursos_DAO.php';
require_once  Constants::PROJECT_PATH_INCLUDE . 'DAO/CursCat_DAO.php';

require_once Constants::PROJECT_PATH_INCLUDE . 'Modelo/Cursos_Model.php';
require_once Constants::PROJECT_PATH_INCLUDE . 'Modelo/CursCat_Model.php';

require_once Constants::PROJECT_PATH_INCLUDE . "Utils/action.php";
require_once Constants::PROJECT_PATH_INCLUDE . "Utils/General.php";

require_once Constants::PROJECT_PATH_INCLUDE . "Modelo/Categorias_Model.php";
require_once Constants::PROJECT_PATH_INCLUDE . "DAO/Categorias_DAO.php";

class InicioController extends Controller
{
    // CONTROLLER ROUTE
    public const ROUTE = "inicio";

    //ACTIONS ROUTE
    public const INDEX = "index";

   

    public $actions;

    public function __construct()
    {
        //parent::__construct($pathName);
        $this->actions = array(
        self::INDEX => new Action("Index", null));
    }

    public function ShowContent($paths)
    {
        //Determine wich method call
        Action::ValidateActionsPath($paths, $this);
    }
  
    public function Index($paths)
    {

        $listaCursosCalificados = null;
        $listaCursosVendidos = null;
        $listaCursosRecientes = null;

        $argumentosCurso = new Cursos_Model();
        $listaCategorias = new  Categorias_Model();


        $listaCursosSeguirViendo = null;
        $IdUsuarioActivo = -1;       

        if (General::isSetUsuarioActivo() && General::isTipoRol(Rol::Estudiante)){
            $IdUsuarioActivo = General::getIdUsuarioActivo();
            $argumentosCurso->getCompraCurso()->setUsuarioComprador($IdUsuarioActivo);
            $argumentosCurso->setNumeroCursoPaginacion(0);
            $argumentosCurso->setIdRolUsuario(General::getRolUsuarioActivo());
            $listaCursosSeguirViendo = Cursos_DAO::getCursos("MisCursosComprados", $argumentosCurso);

        }

        // if (General::isTipoRol(Rol::Escuela)) {
        //     $argumentosCurso->setUsuarioCreador($IdUsuarioActivo);
        // }

        $listaCategorias=Categorias_DAO::getCategorias("PrimerasDiez",new Categorias_Model() );




        $listaCursosCalificados = Cursos_DAO::getCursos("CursosMayorCalificados", $argumentosCurso);
        $listaCursosVendidos = Cursos_DAO::getCursos("CursosMasVendidos", $argumentosCurso);
        $listaCursosRecientes = Cursos_DAO::getCursos("CursosMasRecientes", $argumentosCurso);

        include Constants::PROJECT_PATH_INCLUDE . "Vista/Pages/Inicio/index.php";
    }
}
