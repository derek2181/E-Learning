<?php

require_once Constants::PROJECT_PATH_INCLUDE . "Controlador/template.controller.php";

require_once  Constants::PROJECT_PATH_INCLUDE . 'DAO/Cursos_DAO.php';
require_once  Constants::PROJECT_PATH_INCLUDE . 'DAO/CursCat_DAO.php';
require_once  Constants::PROJECT_PATH_INCLUDE . 'DAO/Niveles_DAO.php';

require_once Constants::PROJECT_PATH_INCLUDE . 'Modelo/Cursos_Model.php';
require_once Constants::PROJECT_PATH_INCLUDE . 'Modelo/CursCat_Model.php';
require_once Constants::PROJECT_PATH_INCLUDE . 'Modelo/Niveles_Model.php';

require_once Constants::PROJECT_PATH_INCLUDE . "Utils/action.php";
require_once Constants::PROJECT_PATH_INCLUDE . "Utils/General.php";



class CategoriasController extends Controller
{

    //CONTROLLER ROUTE
    public const ROUTE = "categorias";

    //ACTIONS ROUTING
    public const MOSTRAR_CATEGORIAS = "mostrarcategorias";
    public const CREAR_CATEGORIAS = "crearcategorias";

    public const EDITAR_CATEGORIAS = "editarcategorias";
    public const DELETE_CATEGORIAS = "deletecategorias";

    
    public $actions;

    public function __construct()
    {
        // parent::__construct($pathName);

        $this->actions = array(
            self::MOSTRAR_CATEGORIAS => new Action(null,"mostrarCategorias"),
            self::CREAR_CATEGORIAS => new Action(null, "crearCategorias"),
            self::EDITAR_CATEGORIAS => new Action(null, "editarCategorias"),
            self::DELETE_CATEGORIAS => new Action(null, "deleteCategorias"),
            "ajax" => new Action(null, "Ajax")
        );
    }

    public function ShowContent($paths)
    {
        //Determine wich method call TO A SPECIFIC ACTION SENDED IT IN THE URL
        Action::ValidateActionsPath($paths, $this);
    }


    public function mostrarCategorias($paths)
    {
        ob_end_clean();
      
         $filtro=$_POST["busqueda"];

      $listaCategorias=Categorias_DAO::getCategorias("Filtro", Categorias_Model::createCategorias(null,$filtro,null,null, null, null, null));
        $jsonInfo= json_encode($listaCategorias);
        
        echo $jsonInfo;
        die();
    }

    public function crearCategorias($paths)
    {
        ob_end_clean();


        $TituloCategoria = htmlspecialchars(addslashes($_POST["tituloCategoria"]), ENT_QUOTES);
        $DescripcionCategoria = htmlspecialchars(addslashes($_POST["descripcionCategoria"]), ENT_QUOTES);
        $UsuarioCreador = general::getIdUsuarioActivo();
           
        $argumentosCategoria = Categorias_Model::createCategorias(null, $TituloCategoria, $DescripcionCategoria, null, null, $UsuarioCreador, null);
    
        $categoria = Categorias_DAO::insertUpdateDeleteCategorias("I", $argumentosCategoria);
        
       
        $jsonInfo = json_encode($categoria);
        echo $jsonInfo;
        
        die();
    }


    public function editarCategorias($paths)
    {
    }

    public function deleteCategorias($paths)
    {
    }

    public function Ajax($paths)
    {
        ob_end_clean();


        // $name = $_POST["name"];
        // $age = $_POST["age"];

        $respuesta = array("prueba" => "hola");
        echo json_encode($_POST);
        die();
    }

}
