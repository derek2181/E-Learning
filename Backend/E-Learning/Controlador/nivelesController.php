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



class NivelController extends Controller
{


    private function reArrayFiles(&$file_post)
    {

        $file_ary = array();
        $file_count = count($file_post['name']);
        $file_keys = array_keys($file_post);

        for ($i = 0; $i < $file_count; $i++) {
            foreach ($file_keys as $key) {
                $file_ary[$i][$key] = $file_post[$key][$i];
            }
        }

        return $file_ary;
    }

    //CONTROLLER ROUTE
    public const ROUTE = "niveles";

    //ACTIONS ROUTING
    public const MOSTRAR_NIVEL = "detalles";
    public const CREAR_NIVEL = "crearnivel";

    public const EDITAR_NIVEL = "editarnivel";
    public const DELETE_NIVEL = "deletenivel";


    public $actions;

    public function __construct()
    {
        // parent::__construct($pathName);

        $this->actions = array(
            self::MOSTRAR_NIVEL => new Action("mostrarNivel", null),
            self::CREAR_NIVEL => new Action(null, "crearNivel"),
            self::EDITAR_NIVEL => new Action(null, "editarNivel"),
            self::DELETE_NIVEL => new Action(null, "deleteNivel"),
            "ajax" => new Action(null, "Ajax")
        );
    }

    public function ShowContent($paths)
    {
        //Determine wich method call TO A SPECIFIC ACTION SENDED IT IN THE URL
        Action::ValidateActionsPath($paths, $this);
    }

    public function mostrarNivel($paths)
    {
    }

    public function crearNivel($paths)
    {
       
    }


    public function editarNivel($paths)
    {
    }

    public function deleteNivel($paths)
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
