<?php

require_once Constants::PROJECT_PATH_INCLUDE . "Controlador/template.controller.php";

require_once  Constants::PROJECT_PATH_INCLUDE . 'DAO/Calificaciones_DAO.php';
require_once Constants::PROJECT_PATH_INCLUDE . 'Modelo/Calificaciones_Model.php';

require_once Constants::PROJECT_PATH_INCLUDE . "Utils/action.php";
require_once Constants::PROJECT_PATH_INCLUDE . "Utils/General.php";



class CalificacionesController extends Controller
{

    //CONTROLLER ROUTE
    public const ROUTE = "calificaciones";

    //ACTIONS ROUTING
    public const MOSTRAR_CALIFICACION = "calificacion";
    public const CREAR_CALIFICACION = "crearcalificacion";

    public const EDITAR_CALIFICACION = "editarcalificacion";
    public const DELETE_CALIFICACION = "deletecalificacion";

    public $actions;

    public function __construct()
    {
        // parent::__construct($pathName);

        $this->actions = array(
            self::MOSTRAR_CALIFICACION => new Action("mostrarCalificacion", null),
            self::CREAR_CALIFICACION => new Action(null, "crearCalificacion"),
            self::EDITAR_CALIFICACION => new Action(null, "editarCalificacion"),
            self::DELETE_CALIFICACION => new Action(null, "deleteCalificacion"),
            "ajax" => new Action(null, "Ajax")
        );
    }

    public function ShowContent($paths)
    {
        //Determine wich method call TO A SPECIFIC ACTION SENDED IT IN THE URL
        Action::ValidateActionsPath($paths, $this);
    }

    public function mostrarCalificacion($paths)
    {
    }

    public function crearCalificacion($paths)
    {
        ob_end_clean();

        $UsuarioComento = General::getIdUsuarioActivo();


        $CursoComentado = htmlspecialchars(addslashes($_POST["IdCurso"]), ENT_QUOTES);

        $votoCalificacion = htmlspecialchars(addslashes($_POST["votoCalifcacion"]), ENT_QUOTES);



        $argumentosCalificacion = Calificaciones_Model::createCalificaciones(
            $UsuarioComento,
            $CursoComentado,
            $votoCalificacion,
            null,
            null
        );

        $CalifiacionExiste = Calificaciones_DAO::getCalificaciones("BuscarCalificacion", $argumentosCalificacion);

        if ($CalifiacionExiste == null) {
            $rowsAffectted = Calificaciones_DAO::insertUpdateDeleteCalificaciones("I", $argumentosCalificacion);
        } else {

            if ($CalifiacionExiste[0]->getUtilidadCalificacion() == 1) {
                if ($votoCalificacion == 1) {
                    // BORAR VOTO
                    $rowsAffectted = Calificaciones_DAO::insertUpdateDeleteCalificaciones("D", $argumentosCalificacion);
                } else if ($votoCalificacion == 0) {
                    // UPDATEAR VOTO
                    $rowsAffectted = Calificaciones_DAO::insertUpdateDeleteCalificaciones("U", $argumentosCalificacion);
                }
            } else if ($CalifiacionExiste[0]->getUtilidadCalificacion() == 0) {
                if ($votoCalificacion == 0) {
                    // BORAR VOTO
                    $rowsAffectted = Calificaciones_DAO::insertUpdateDeleteCalificaciones("D", $argumentosCalificacion);
                } else if ($votoCalificacion == 1) {
                    // UPDATEAR VOTO
                    $rowsAffectted = Calificaciones_DAO::insertUpdateDeleteCalificaciones("U", $argumentosCalificacion);
                }
            }
        }

        $respuesta = array("Mensaje" => "Exito");
        echo json_encode($_POST);

        die();
    }


    public function editarCalificacion($paths)
    {
    }

    public function deleteCalificacion($paths)
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
