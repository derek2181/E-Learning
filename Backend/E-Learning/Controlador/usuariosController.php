<?php

require_once Constants::PROJECT_PATH_INCLUDE . "Controlador/template.controller.php";


require_once  Constants::PROJECT_PATH_INCLUDE . 'DAO/Usuarios_DAO.php';
require_once  Constants::PROJECT_PATH_INCLUDE . 'DAO/UsuRol_DAO.php';
require_once  Constants::PROJECT_PATH_INCLUDE . 'DAO/Roles_DAO.php';

require_once Constants::PROJECT_PATH_INCLUDE . "Modelo/Usuarios_Model.php";
require_once Constants::PROJECT_PATH_INCLUDE . "Modelo/UsuRol_Model.php";
require_once Constants::PROJECT_PATH_INCLUDE . "Modelo/Roles_Model.php";

require_once Constants::PROJECT_PATH_INCLUDE . "Utils/action.php";
require_once Constants::PROJECT_PATH_INCLUDE . "Utils/General.php";
require_once Constants::PROJECT_PATH_INCLUDE . "Utils/File.php";
require_once Constants::PROJECT_PATH_INCLUDE . 'Vista/API/Facebook/php-graph-sdk-5.0.0/src/Facebook/autoload.php';


class UsuariosController extends Controller
{

    private const ImagenDefaultUser = Constants::PROJECT_PATH . "Imagenes/profile.jpg";

    private function conseguirUsuarioPorCorreoPassword($CorreoUsuario, $PasswordUsuario)
    {
        $argumentosUsuario = new Usuarios_Model();
        $argumentosUsuario->setCorreoUsuario($CorreoUsuario);
        $argumentosUsuario->setPasswordUsuario($PasswordUsuario);

        $listaUsuarios = Usuarios_DAO::getUsuarios("UsuarioByCorreoPw", $argumentosUsuario);

        return $listaUsuarios;
    }

    private function conseguirUsuarioPorCorreoPasswordFacebook($CorreoUsuario, $PasswordUsuario)
    {
        $argumentosUsuario = new Usuarios_Model();
        $argumentosUsuario->setCorreoUsuario($CorreoUsuario);
        $argumentosUsuario->setPasswordUsuario($PasswordUsuario);

        $listaUsuarios = Usuarios_DAO::getUsuarios("UsuarioByCorreoPwFacebook", $argumentosUsuario);

        return $listaUsuarios;
    }
    private function conseguirUsuarioPorCorreo($CorreoUsuario)
    {
        $argumentosUsuario = new Usuarios_Model();
        $argumentosUsuario->setCorreoUsuario($CorreoUsuario);

        $listaUsuarios = Usuarios_DAO::getUsuarios("UsuarioByCorreo", $argumentosUsuario);

        return $listaUsuarios;
    }

    //CONTROLLER ROUTE
    public const ROUTE = "cuenta";

    //ACTIONS ROUTING
    public const MOSTRAR_USUARIO = "perfil";
    public const CREAR_USUARIO = "crearusuario";
    public const LOGEAR_USUARIO = "login";
    public const CERRAR_SESION = "cerrarsesion";
    public const EDITAR_CONTRASENA = "editarcontrasena";

    public const EDITAR_USUARIO = "editarusuario";
    public const DELETE_USUARIO = "deleteusuario";
    public  const VALIDACION_EMAIL = "validacionemail";
    public const FACEBOOK_LOGIN = "facebooklogin";
    public const SELECCION_ROL = "seleccionarrol";

    public $actions;

    public function __construct()
    {
        // parent::__construct($pathName);

        $this->actions = array(
            self::CREAR_USUARIO => new Action("verPaginaRegistro", "crearUsuario"),
            self::LOGEAR_USUARIO => new Action("verPaginaLogin", "loginUsuario"),
            self::CERRAR_SESION => new Action("cerrarSesion", null),
            self::FACEBOOK_LOGIN => new Action("facebookLogin", null),
            self::SELECCION_ROL => new Action("seleccionarRol", "IngresarUsuarioFacebook"),
            self::MOSTRAR_USUARIO => new Action("mostrarUsuario", null),
            self::EDITAR_USUARIO => new Action(null, "editarUsuario"),
            self::DELETE_USUARIO => new Action(null, "deleteUsuario"),
            self::VALIDACION_EMAIL => new Action(null, "validacionEmail"),
            self::EDITAR_CONTRASENA => new Action(null, "editarcontrasena"),
            "ajax" => new Action(null, "Ajax")
        );
    }

    public function ShowContent($paths)
    {
        //Determine wich method call TO A SPECIFIC ACTION SENDED IT IN THE URL
        Action::ValidateActionsPath($paths, $this);
    }

    public function validacionEmail($paths)
    {
        ob_end_clean();

        $email = $_POST["email"];

        $listaUsuarios = self::conseguirUsuarioPorCorreo($email);

        if ($listaUsuarios != null) {
            echo json_encode("<i class='fas fa-exclamation-circle'></i> Este correo ya esta en uso");
        } else {
            echo json_encode("true");
        }

        die();
    }

    public function verPaginaRegistro($paths)
    {
        self::eliminarSession();
        $rolesUsuario = UsuariosController::getRolesUsuario();
        include Constants::PROJECT_PATH_INCLUDE . "Vista/Pages/Usuarios/register.php";
    }

    public function crearUsuario($paths)
    {

        $NombreUsuario = htmlspecialchars(addslashes($_POST["name"]), ENT_QUOTES);
        $ApellidoPaternoUsuario = htmlspecialchars(addslashes($_POST["firstlastname"]), ENT_QUOTES);
        $ApellidoMaternoUsuario = htmlspecialchars(addslashes($_POST["secondlastname"]), ENT_QUOTES);

        $GeneroUsuario = null;
        if (isset($_POST["gender"])) {
            $GeneroUsuario = $_REQUEST['gender'];
        }

        $FechaNacimientoUsuario = htmlspecialchars(addslashes($_POST["birthday"]), ENT_QUOTES);


        $CorreoUsuario = htmlspecialchars(addslashes($_POST["email"]), ENT_QUOTES);
        $PasswordUsuario = htmlspecialchars(addslashes($_POST["password"]), ENT_QUOTES);

        $ImagenPerfilUsuarioPath = $_SERVER["DOCUMENT_ROOT"] . self::ImagenDefaultUser;

        $data = file_get_contents($ImagenPerfilUsuarioPath);
        $ImagenPerfilUsuario = base64_encode($data);


        $argumentosUsuario = Usuarios_Model::createUsuario(
            null,
            $NombreUsuario,
            $ApellidoPaternoUsuario,
            $ApellidoMaternoUsuario,
            $GeneroUsuario,
            $FechaNacimientoUsuario,
            $ImagenPerfilUsuario,
            $CorreoUsuario,
            $PasswordUsuario,
            null,
            null,
            null
        );


        $rowsAffectted = Usuarios_DAO::insertUpdateDeleteUsuarios("I", $argumentosUsuario);

        $listaUsuarios = self::conseguirUsuarioPorCorreoPassword($CorreoUsuario, $PasswordUsuario);

        $IdUsuario = $listaUsuarios[0]->getIdUsuario();

        if (!empty($_POST['rolUsuario'])) {

            foreach ($_POST['rolUsuario'] as $RolElegido) {
                $argumentosRolUsu = UsuRol_Model::createUsuRol($IdUsuario, $RolElegido);

                UsuRol_DAO::insertUpdateDeleteUsuRol("I", $argumentosRolUsu);
            }
        }


        header("Location: " . Constants::ROOT_PATH . self::ROUTE . "/" . self::LOGEAR_USUARIO);

        //}

    }

    public function IngresarUsuarioFacebook($paths)
    {

        $RolElegido = $_POST["Rol"];


        $argumentosUsuario = $_SESSION["userFacebook"];

        $rowsAffectted = Usuarios_DAO::insertUpdateDeleteUsuarios("I", $argumentosUsuario);

        $listaUsuarios = self::conseguirUsuarioPorCorreoPasswordFacebook($argumentosUsuario->getCorreoUsuario(), null);
        $IdUsuario = $listaUsuarios[0]->getIdUsuario();
        $argumentosRolUsu = UsuRol_Model::createUsuRol($IdUsuario, $RolElegido);

        UsuRol_DAO::insertUpdateDeleteUsuRol("I", $argumentosRolUsu);



        $usuarioActivo = $listaUsuarios[0];

        General::setIdUsuarioActivo($IdUsuario);
        General::setRolUsuarioActivo($RolElegido);

        General::setUsuarioLoggeadoFacebook(true);

        header("Location: " . Constants::ROOT_PATH . InicioController::ROUTE . "/" . InicioController::INDEX);
    }
    public function seleccionarRol($paths)
    {



        include Constants::PROJECT_PATH_INCLUDE . "Vista/Pages/Usuarios/RolSelection.php";
    }

    public function facebookLogin()
    {
        General::startSession();
        $uri = parse_url($_SERVER["REQUEST_URI"]);
        $uriQuery = "";
        parse_str($uri["query"], $uriQuery);

        $_GET["code"] = $uriQuery["code"];
        $_GET["state"] = $uriQuery["state"];
        $fb = new \Facebook\Facebook([
            'app_id'      => '2691811787791878',
            'app_secret'     => '99b70787e5d9ca75bb02666bf8f31778',
            'default_graph_version'  => 'v2.5'
        ]);

        $helper = $fb->getRedirectLoginHelper();


        try {
            $accessToken = $helper->getAccessToken();
        } catch (Facebook\Exceptions\FacebookResponseException $e) {
            // Cuando Graph devuelve un error
            echo 'Graph returned an error: ' . $e->getMessage();
            exit;
        } catch (Facebook\Exceptions\FacebookSDKException $e) {
            // Cuando la validación falla 
            echo 'Facebook SDK returned an error: ' . $e->getMessage();
            exit;
        }
        //$error= $helper->getLastReponse();
        if (!isset($accessToken)) {
            if ($helper->getError()) {
                header('HTTP/1.0 401 Unauthorized');
                echo "Error: " . $helper->getError() . "\n";
                echo "Error Code: " . $helper->getErrorCode() . "\n";
                echo "Error Reason: " . $helper->getErrorReason() . "\n";
                echo "Error Description: " . $helper->getErrorDescription() . "\n";
            } else {
                header('HTTP/1.0 400 Bad Request');
                //echo var_dump($fb); 
            }
            //echo  $accessToken ;
            exit;
        }

        // Login directo 
        //  echo '<h3>Acceso Token</h3>'; 
        // var_dump($accessToken->getValue()); 

        // Controlador de cliente de OAuth 2.0, para gestionar los accesos
        $oAuth2Client = $fb->getOAuth2Client();

        $tokenMetadata = $oAuth2Client->debugToken($accessToken);
        // echo '<h3>Metadata</h3>'; 
        // var_dump($tokenMetadata); 

        $tokenMetadata->validateExpiration();

        if (!$accessToken->isLongLived()) {
            // Cambiando uno de corta duración a una de larga duración
            try {
                $accessToken = $oAuth2Client->getLongLivedAccessToken($accessToken);
            } catch (Facebook\Exceptions\FacebookSDKException $e) {
                //echo "<p>Error getting long-lived access token: " . $helper->getMessage() . "</p>"; 
                exit;
            }
            //  echo '<h3>Long-lived</h3>'; 
            //var_dump($accessToken->getValue()); 
        }

        $_SESSION['fb_access_token'] = (string) $accessToken;

        if (isset($_SESSION['fb_access_token'])) {
            try {
                $fb->setDefaultAccessToken($_SESSION['fb_access_token']);
                $res = $fb->get('me?fields=id,name,first_name,birthday,email,gender,last_name,middle_name,picture');
                $user = $res->getGraphUser();
                // $pictureFb=$user->getField('picture');
                // $date=$user->getField('birthday');
                // $name=$user->getField('name');
                // $gender=$user->getField('gender') == "male" ? "Hombre" : "Mujer";
                // $email=$user->getField('email');
                // $first_name=$user->getField('first_name');
                // $last_name=$user->getField('last_name');
                // $id=$user->getField('id');
                // $pictureURL=$pictureFb["url"];
                // $realdate=$date->format('Y/m/d');

                $imageURI = $user->getField('picture')["url"];


                $img = 'fbImage.png';
                // Function to write image into file
                $pathImage = File::getImageFacebook($imageURI);

                $data = file_get_contents($pathImage);
                $ImagenPerfilUsuario = base64_encode($data);
        
                File::unsetImage($pathImage);



                $argumentosUsuario = Usuarios_Model::createUsuario(
                    null,
                    $user->getField('first_name'),
                    $user->getField('last_name'),
                    null,
                    $user->getField('gender') == "male" ? "Hombre" : ($user->getField('gender') == "female" ? "Mujer" : "Otro"),
                    $user->getField('birthday')->format('Y/m/d'),
                    $ImagenPerfilUsuario,
                    $user->getField('email'),
                    null,
                    null,
                    null,
                    null,
                    1
                );



                $listUsuarios = self::conseguirUsuarioPorCorreoPasswordFacebook($argumentosUsuario->getCorreoUsuario(), null);
                $_SESSION["userFacebook"] = $argumentosUsuario;

                if (sizeof($listUsuarios) == 0) {

                    header("Location: " . Constants::ROOT_PATH . UsuariosController::ROUTE . "/" . UsuariosController::SELECCION_ROL);
                } else {

                    $rowsAffectted = Usuarios_DAO::insertUpdateDeleteUsuarios("U", $argumentosUsuario);
                    $listUsuariosWithRol = Usuarios_DAO::getUsuarios("UsuarioByIdUsuario", $listUsuarios[0]);
                    
                    $IdUsuario = $listUsuariosWithRol[0]->getIdUsuario();
                    $IdRol = $listUsuariosWithRol[0]->getIdRol();
                    General::setIdUsuarioActivo($IdUsuario);
                    General::setRolUsuarioActivo($IdRol);

                    General::setUsuarioLoggeadoFacebook(true);
                    header("Location: " . Constants::ROOT_PATH . InicioController::ROUTE . "/" . InicioController::INDEX);
                }

                // include Constants::PROJECT_PATH_INCLUDE . "Vista/Pages/Usuarios/RolSelection.php";
            } catch (Exception $e) {
                $error = $e; // Esto es no
            }
        }
    }



    public function verPaginaLogin($paths)
    {
        self::eliminarSession();
        $rolesUsuario = UsuariosController::getRolesUsuario();

        $fb = new \Facebook\Facebook([
            'app_id'      => '2691811787791878',
            'app_secret'     => '99b70787e5d9ca75bb02666bf8f31778',
            'default_graph_version'  => 'v2.5'
        ]);

        $helper = $fb->getRedirectLoginHelper();

        $permissions = ['email']; // Generar permisos opcionales
        $loginUrl = $helper->getLoginUrl(Constants::WEB_SITE . Constants::ROOT_PATH . 'cuenta/facebookLogin', $permissions);

        /* Aquí el enlace a la página de login Facebook*/



        include Constants::PROJECT_PATH_INCLUDE . "Vista/Pages/Usuarios/login.php";
    }

    public function loginUsuario($paths)
    {

        //$UsernameUsuario = htmlspecialchars(addslashes($_POST["username"]), ENT_QUOTES); YA NO SE OCUPA

        $CorreoUsuario = htmlspecialchars(addslashes($_POST["email"]), ENT_QUOTES);
        $PasswordUsuario = htmlspecialchars(addslashes($_POST["password"]), ENT_QUOTES);

        $RolElegido = null;
        if (isset($_POST['rolUsuario'])) {
            $RolElegido = $_POST["rolUsuario"];
        }

        $argumentosUsuario = new Usuarios_Model();
        $argumentosUsuario->setCorreoUsuario($CorreoUsuario);
        $argumentosUsuario->setPasswordUsuario($PasswordUsuario);
        $argumentosUsuario->setIdRol($RolElegido);

        $listaUsuarios = Usuarios_DAO::getUsuarios("Login", $argumentosUsuario);

        General::setCookieCorreo($CorreoUsuario);

        if ($listaUsuarios == null) {
            header("Location: " . Constants::ROOT_PATH . self::ROUTE . "/" . self::LOGEAR_USUARIO);
            General::setUsuarioIncorrectoEnLogin(true);
            General::setUsuarioLoggeadoFacebook(null);
        } else {
            //TODO: POR QUE SETTEAMOS EL USUARIO CON NULL?
            General::setUsuarioIncorrectoEnLogin(null);

            $usuarioActivo = $listaUsuarios[0];

            General::setIdUsuarioActivo($usuarioActivo->getIdUsuario());
            General::setRolUsuarioActivo($RolElegido);


            header("Location: " . Constants::ROOT_PATH . InicioController::ROUTE . "/" . InicioController::INDEX);
        }
    }

    public function cerrarSesion()
    {
        self::eliminarSession();

        header("Location: " . Constants::ROOT_PATH . InicioController::ROUTE . "/" . InicioController::INDEX);
    }

    public function mostrarUsuario($paths)
    {
        $validacionesGenerales = new Validaciones();

        try {
            if (General::isSetUsuarioActivo() == false) {
                throw new Exception(ErrorMessages::UsuarioNoRegistrado);
            }

            $IdUsuario = General::getIdUsuarioActivo();

            $argumentosUsuario = new Usuarios_Model();
            $argumentosUsuario->setIdUsuario($IdUsuario);

            $listaUsuarios = Usuarios_DAO::getUsuarios("S", $argumentosUsuario);

            $usuarioActivo = $listaUsuarios[0];

            $perfilEditadoCorrectamente = General::getPerfilEditadoCorrectamente();
            $contrasenaEditadaCorrectamente = General::getContraEditadoCorrectamente();
            General::setPerfilEditadoCorrectamente(null);
            General::setContrasenaEditadaCorrectamente(null);
            include Constants::PROJECT_PATH_INCLUDE . "Vista/Pages/Usuarios/edit.php";
        } catch (Exception $e) {
            if ($e->getMessage() != "")
                $validacionesGenerales->setMensajeError($e->getMessage());

            include Constants::PROJECT_PATH_INCLUDE . "Vista/Pages/error.php";
        }
    }
    public function editarContrasena($paths)
    {
        $IdUsuario = General::getIdUsuarioActivo();

        $actualPassword = $_POST["actualPassword"];
        $newPassword = $_POST["newPassword"];

        $argumentosUsuario = new Usuarios_Model();
        $argumentosUsuario->setIdUsuario($IdUsuario);
        $argumentosUsuario->setPasswordUsuario($actualPassword);

        $listaUsuarios = Usuarios_DAO::getUsuarios("ValidarContrasenaCorrecta", $argumentosUsuario);

        if ($listaUsuarios != null) {
            $argumentosUsuario->setPasswordUsuario($newPassword);
            General::setPerfilEditadoCorrectamente(true);
            General::setContrasenaEditadaCorrectamente(false);
            $rowsAffectted = Usuarios_DAO::insertUpdateDeleteUsuarios("U", $argumentosUsuario);
        } else {
            General::setContrasenaEditadaCorrectamente(true);
        }

        header("Location: " . Constants::ROOT_PATH . self::ROUTE . "/" . self::MOSTRAR_USUARIO);
    }
    public function editarUsuario($paths)
    {

        // if (    isset(  $_POST["EditarDatos"]  )   ){

        $IdUsuario = General::getIdUsuarioActivo();
        $NombreUsuario = htmlspecialchars(addslashes($_POST["name"]), ENT_QUOTES);
        $ApellidoPaternoUsuario = htmlspecialchars(addslashes($_POST["firstlastname"]), ENT_QUOTES);
        $ApellidoMaternoUsuario = htmlspecialchars(addslashes($_POST["secondlastname"]), ENT_QUOTES);
        $GeneroUsuario = null;
        if (isset($_POST["gender"])) {
            $GeneroUsuario = $_REQUEST['gender'];
        }

        $FechaNacimientoUsuario = htmlspecialchars(addslashes($_POST["birthday"]), ENT_QUOTES);

        $ImagenPerfilUsuario = null;
        $ImagenPerfilUsuarioPath = File::getImage($_FILES["file-image-user"]);

        if ($ImagenPerfilUsuarioPath != null) {
            $data = file_get_contents($ImagenPerfilUsuarioPath);
            $ImagenPerfilUsuario = base64_encode($data);

            File::unsetImage($ImagenPerfilUsuarioPath);
        }
        
        $argumentosUsuario = Usuarios_Model::createUsuario(
            $IdUsuario,
            $NombreUsuario,
            $ApellidoPaternoUsuario,
            $ApellidoMaternoUsuario,
            $GeneroUsuario,
            $FechaNacimientoUsuario,
            $ImagenPerfilUsuario,
            null,
            null,
            null,
            null,
            null
        );

        $rowsAffectted = Usuarios_DAO::insertUpdateDeleteUsuarios("U", $argumentosUsuario);

        General::startSession();

        General::setPerfilEditadoCorrectamente(true);

        header("Location: " . Constants::ROOT_PATH . self::ROUTE . "/" . self::MOSTRAR_USUARIO);
    }

    public function deleteUsuario($paths)
    {
        $IdUsuario = General::getIdUsuarioActivo();

        $argumentosUsuario = new Usuarios_Model();
        $argumentosUsuario->setIdUsuario($IdUsuario);

        $listaUsuarios = Usuarios_DAO::getUsuarios("D", $argumentosUsuario);

        header("Location: " . Constants::ROOT_PATH . self::ROUTE . "/" . self::CERRAR_SESION);

        // $idToDelete = $_POST["deleteId"];

        // $result = UserModel::DeleteUserById($idToDelete);

        // if($result){
        //     header("Location: /semiframework/".self::ROUTE."/".self::SHOW_ALL_USERS);
        //     die();
        // } else {
        //     include "views/error.php";
        // }

    }

    static public function getUsuarioActivo()
    {
        $usuarioActivo = null;


        if (General::isSetUsuarioActivo() == true) {
            $IdUsuario = General::getIdUsuarioActivo();
            $IdRol = General::getRolUsuarioActivo();

            $argumentosUsuario = new Usuarios_Model();
            $argumentosUsuario->setIdUsuario($IdUsuario);
            $argumentosUsuario->setIdRol($IdRol);

            $listaUsuarios = Usuarios_DAO::getUsuarios("UsuarioByIdUsuarioIdRol", $argumentosUsuario);
            $usuarioActivo = $listaUsuarios[0];
        }

        return $usuarioActivo;
    }


    static public function getRolesUsuario()
    {
        $argumentosRol = new Roles_Model();
        $listaRoles = Roles_DAO::getRoles("X", $argumentosRol);
        return $listaRoles;
    }

    private function eliminarSession()
    {
        General::setIdUsuarioActivo(null);
        General::setRolUsuarioActivo(null);
        General::setUsuarioLoggeadoFacebook(null);
        $_SESSION["userFacebook"] = null;
        $_SESSION['fb_access_token'] = null;
    }
}
