<?php

require_once Constants::PROJECT_PATH_INCLUDE . "Controlador/template.controller.php";

require_once  Constants::PROJECT_PATH_INCLUDE . 'DAO/Mensajes_DAO.php';
require_once Constants::PROJECT_PATH_INCLUDE . 'Modelo/Mensajes_Model.php';

require_once Constants::PROJECT_PATH_INCLUDE . "Utils/action.php";

class MensajesController extends Controller
{

    //CONTROLLER ROUTE
    public const ROUTE = "mensajes";

    //ACTIONS ROUTING
    public const MOSTRAR_MENSAJES = "mis-mensajes";
    public const CREAR_MENSAJE = "crearmensaje";

    public const EDITAR_MENSAJE = "editarmensaje";
    public const DELETE_MENSAJE = "deletemensaje";
    public const FILTRO_MEMSAJES="filtro";
    public $actions;

    public function __construct()
    {
        // parent::__construct($pathName);

        $this->actions = array(
            self::MOSTRAR_MENSAJES => new Action("mostrarMensajes", null),
            self::FILTRO_MEMSAJES=> new Action(null,"Filtro"),
            self::CREAR_MENSAJE => new Action(null, "crearMensajes"),
            self::EDITAR_MENSAJE => new Action(null, "editarMensajes"),
            self::DELETE_MENSAJE => new Action(null, "deleteMensajes"),
            "ajax" => new Action(null, "Ajax")
        );
    }

    public function ShowContent($paths)
    {
        //Determine wich method call TO A SPECIFIC ACTION SENDED IT IN THE URL
        Action::ValidateActionsPath($paths, $this);
    }

    public function Filtro($paths){
        ob_end_clean();
        $filtro=$_POST["busqueda"];

        $validacionesGenerales = new Validaciones();
            

            $IdUsuarioActivo = General::getIdUsuarioActivo();

            $argumentosBandejaMensajes = new Mensajes_Model();
            $argumentosBandejaMensajes->setUsuarioEnvia($IdUsuarioActivo);
            $argumentosBandejaMensajes->setFiltroBandeja($filtro);
            $listaBandejaMensajes = Mensajes_DAO::getMensajes("FiltroBandeja", $argumentosBandejaMensajes);

            $usuarioRemitente = null;
            $usuarioActivo = UsuariosController::getUsuarioActivo();
                $json = json_encode(array('bandeja' =>$listaBandejaMensajes,"idUsuario"=>$IdUsuarioActivo));
            echo $json;
            

           
        
      
        die();
    }

    
    public function mostrarMensajes($paths)
    {
        $validacionesGenerales = new Validaciones();
        try {
            if (General::isSetUsuarioActivo() == false) {
                throw new Exception(ErrorMessages::SoloUsuariosRegistradosPueden."ver sus mensajes");
            }

            $IdUsuarioActivo = General::getIdUsuarioActivo();

            $argumentosBandejaMensajes = new Mensajes_Model();
            $argumentosBandejaMensajes->setUsuarioEnvia($IdUsuarioActivo);
            $listaBandejaMensajes = Mensajes_DAO::getMensajes("BandejaMensajes", $argumentosBandejaMensajes);

            $usuarioRemitente = null;
            $usuarioActivo = UsuariosController::getUsuarioActivo();

            if (isset($paths[2])) {
                if ($IdUsuarioActivo != $paths[2]) {

                    $IdUsuarioRemitente = $paths[2];

                    $argumentosUsuario = new Usuarios_Model();
                    $argumentosUsuario->setIdUsuario($IdUsuarioRemitente);
                    $listaUsuarioRemitente = Usuarios_DAO::getUsuarios("UsuarioByIdUsuario", $argumentosUsuario);

                    $argumentosMensajesConversacion = new Mensajes_Model();
                    $argumentosMensajesConversacion->setUsuarioEnvia($IdUsuarioActivo);
                    $argumentosMensajesConversacion->setUsuarioRecibe($IdUsuarioRemitente);
                    $listaMensajesConversacion = Mensajes_DAO::getMensajes("MensajesConversacion", $argumentosMensajesConversacion);

                    if ($listaUsuarioRemitente != null) {
                        $usuarioRemitente = $listaUsuarioRemitente[0];
                    } else {
                        self::redireccionarMensajesIndex();
                    }
                } else {
                    self::redireccionarMensajesIndex();
                }
            }

            include Constants::PROJECT_PATH_INCLUDE . "Vista/Pages/Mensajes/chat.php";
        } 
        catch (Exception $e) {
            if ($e->getMessage() != "")
                $validacionesGenerales->setMensajeError($e->getMessage());

            include Constants::PROJECT_PATH_INCLUDE . "Vista/Pages/error.php";
        }
    }

    private function redireccionarMensajesIndex()
    {
        header("Location: " . Constants::ROOT_PATH . MensajesController::ROUTE . "/" . MensajesController::MOSTRAR_MENSAJES);
    }


    public function crearMensajes($paths)
    {
        $descripcionMensaje = htmlspecialchars(addslashes($_POST["descripcion"]), ENT_QUOTES);
        $usuarioRecibeMensaje = htmlspecialchars(addslashes($_POST["usuario-recibe"]), ENT_QUOTES);

        $usuarioEnviaMensaje = General::getIdUsuarioActivo();;
        

        $argumentosMensaje = Mensajes_Model::createMensajes(null, $usuarioEnviaMensaje, $usuarioRecibeMensaje, $descripcionMensaje, null, null);

        $rowsAffectted = Mensajes_DAO::insertUpdateDeleteMensajes("I", $argumentosMensaje);

        header("Location: " . Constants::ROOT_PATH . self::ROUTE . "/" . self::MOSTRAR_MENSAJES . "/" . $usuarioRecibeMensaje);
    }


    public function editarMensajes($paths)
    {
    }

    public function deleteMensajes($paths)
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
