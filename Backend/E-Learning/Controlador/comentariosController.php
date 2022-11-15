<?php

require_once Constants::PROJECT_PATH_INCLUDE . "Controlador/template.controller.php";

require_once  Constants::PROJECT_PATH_INCLUDE . 'DAO/Comentarios_DAO.php';
require_once Constants::PROJECT_PATH_INCLUDE . 'Modelo/Comentarios_Model.php';

require_once Constants::PROJECT_PATH_INCLUDE . "Utils/action.php";
require_once Constants::PROJECT_PATH_INCLUDE . "Utils/General.php";



class ComentariosController extends Controller
{

    //CONTROLLER ROUTE
    public const ROUTE = "comentarios";

    //ACTIONS ROUTING
    public const MOSTRAR_COMENTARIO = "comentario";
    public const CREAR_COMENTARIO = "crearcomentario";

    public const EDITAR_COMENTARIO = "editarcomentario";
    public const DELETE_COMENTARIO = "deletecomentario";
    public const CARGAR_COMENTARIOS = "cargar-comentarios";

    public $actions;

    public function __construct()
    {
        // parent::__construct($pathName);

        $this->actions = array(
            self::MOSTRAR_COMENTARIO => new Action("mostrarComentario", null),
            self::CREAR_COMENTARIO => new Action(null, "crearComentario"),
            self::EDITAR_COMENTARIO => new Action(null, "editarComentario"),
            self::DELETE_COMENTARIO => new Action(null, "deleteComentario"),
            self::CARGAR_COMENTARIOS => new Action(null, "cargarComentarios"),
            "ajax" => new Action(null, "Ajax")
        );
    }

    public function ShowContent($paths)
    {
        //Determine wich method call TO A SPECIFIC ACTION SENDED IT IN THE URL
        Action::ValidateActionsPath($paths, $this);
    }


    public function mostrarComentario($paths)
    {
    }

    public function crearComentario($paths)
    {
        ob_end_clean();

        $UsuarioComento = General::getIdUsuarioActivo();;
        

        $CursoComentado = htmlspecialchars(addslashes($_POST["IdCurso"]), ENT_QUOTES);

        $DescripcionComentario = htmlspecialchars(addslashes($_POST["comment"]), ENT_QUOTES);

        $argumentosComentario = Comentarios_Model::createComentarios(
            null,
            $UsuarioComento,
            $CursoComentado,
            $DescripcionComentario,
            null,
            null
        );

        $validarCursoComentado = Comentarios_DAO::getComentarios("ComentarioReciente", $argumentosComentario);

        if ($validarCursoComentado == null) {
            if (count($validarCursoComentado) == 0) {
                $rowsAffectted = Comentarios_DAO::insertUpdateDeleteComentarios("I", $argumentosComentario);

                $comentarioAgregado = Comentarios_DAO::getComentarios("ComentarioReciente", $argumentosComentario);
                $jsonInfo = json_encode($comentarioAgregado[0]);
                echo $jsonInfo;
            } else {
                //TODO: VALIDAR QUE AQUI CUANDO HAYA INGRESADO UN CURSO, RETORNE ERROR CORRECTAMENTE Y MANDE MENSAJE DE QUE NO SE PUEDE INGRESAR COMENTARIO
                echo "ERROR";
            }
        } else {
            //TODO: VALIDAR QUE AQUI CUANDO HAYA INGRESADO UN CURSO, RETORNE ERROR CORRECTAMENTE Y MANDE MENSAJE DE QUE NO SE PUEDE INGRESAR COMENTARIO
            echo "ERROR";
        }



        die();
    }


    public function editarComentario($paths)
    {
        ob_end_clean();

        $IdComentario = htmlspecialchars(addslashes($_POST["IdComentario"]), ENT_QUOTES);
        $DescripcionComentario = htmlspecialchars(addslashes($_POST["comment"]), ENT_QUOTES);

        $argumentosComentario = Comentarios_Model::createComentarios(
            $IdComentario,
            null,
            null,
            $DescripcionComentario,
            null,
            null
        );


        $rowsAffectted = Comentarios_DAO::insertUpdateDeleteComentarios("EditarComentario", $argumentosComentario);

        $comentarioAgregado = Comentarios_DAO::getComentarios("S", $argumentosComentario);
        $jsonInfo = json_encode($comentarioAgregado[0]);
        echo $jsonInfo;



        die();
    }

    public function deleteComentario($paths)
    {
        ob_end_clean();

        $IdComentario = htmlspecialchars(addslashes($_POST["IdComentario"]), ENT_QUOTES);
        $estadoComentario = 0;

        $argumentosComentario = Comentarios_Model::createComentarios(
            $IdComentario,
            null,
            null,
            null,
            null,
            $estadoComentario
        );

        $rowsAffectted = Comentarios_DAO::insertUpdateDeleteComentarios("BorrarComentario", $argumentosComentario);

        $jsonInfo = json_encode($argumentosComentario);
        echo $jsonInfo;
        
        die();
    }

    public function cargarComentarios($paths)
    {
        ob_end_clean();

        $numeroComentario = $_POST["numeroComentario"];
        $IdCurso = $_POST["IdCurso"];

        $argumentosComentario = new Comentarios_Model();
        $argumentosComentario->setCursoComentado($IdCurso);
        $argumentosComentario->setNumeroComentarioPaginacion($numeroComentario);
        $argumentosComentario->setUsuarioComento(General::getIdUsuarioActivo());

        $listaComentariosCurso = Comentarios_DAO::getComentarios("ComentariosPrincipalesCurso", $argumentosComentario);


        $jsonInfo = json_encode($listaComentariosCurso);
        echo $jsonInfo;


        die();
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
