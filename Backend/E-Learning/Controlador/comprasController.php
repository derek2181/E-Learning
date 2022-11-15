<?php

require_once Constants::PROJECT_PATH_INCLUDE . "Controlador/template.controller.php";

require_once  Constants::PROJECT_PATH_INCLUDE . 'DAO/Compras_DAO.php';
require_once  Constants::PROJECT_PATH_INCLUDE . 'DAO/Cursos_DAO.php';
require_once  Constants::PROJECT_PATH_INCLUDE . 'DAO/CursCat_DAO.php';

require_once Constants::PROJECT_PATH_INCLUDE . 'Modelo/Compras_Model.php';
require_once Constants::PROJECT_PATH_INCLUDE . 'Modelo/Cursos_Model.php';
require_once Constants::PROJECT_PATH_INCLUDE . 'Modelo/CursCat_Model.php';

require_once Constants::PROJECT_PATH_INCLUDE . "Utils/action.php";
require_once Constants::PROJECT_PATH_INCLUDE . "Utils/General.php";

class ComprasController extends Controller
{

    //CONTROLLER ROUTE
    public const ROUTE = "compras";

    //ACTIONS ROUTING
    public const MOSTRAR_COMPRA = "detalles";
    public const MOSTRAR_MIS_CURSOS_COMPRDOS = "mis-compras";
    public const CARGAR_MIS_CURSOS = "cargar-mis-compras";

    public const REALIZAR_COMPRA = "realizarcompra";
    public const REALIZAR_COMPRA_TARJETA="realizarcompratarjeta";
    public const REALIZAR_COMPRA_GRATIS = "realizar-compra-gratis";

    public const IMPRIMIR_DIPLOMA = "diploma";

    public const EDITAR_COMPRA = "editarcompra";
    public const DELETE_COMPRA = "deletecompra";



    public $actions;

    public function __construct()
    {
        // parent::__construct($pathName);

        $this->actions = array(
            self::MOSTRAR_COMPRA => new Action(null, "detalles"),
            self::MOSTRAR_MIS_CURSOS_COMPRDOS => new Action("mostrarMisCursosComprados", null),
            self::CARGAR_MIS_CURSOS => new Action(null, "cargarMisCursos"),
            self::REALIZAR_COMPRA => new Action(null, "realizarCompra"),
            self::REALIZAR_COMPRA_GRATIS => new Action(null, "realizarCompraGratis"),
            self::IMPRIMIR_DIPLOMA => new Action(null, "imprimirDiploma"),
            self::EDITAR_COMPRA => new Action(null, "editarCompra"),
            self::DELETE_COMPRA => new Action(null, "deleteCompra"),
            self::REALIZAR_COMPRA_TARJETA => new Action(null,"realizarCompraTarjeta"),
            "ajax" => new Action(null, "Ajax")
        );
    }

    public function ShowContent($paths)
    {
        //Determine wich method call TO A SPECIFIC ACTION SENDED IT IN THE URL
        Action::ValidateActionsPath($paths, $this);
    }


    public function detalles($paths)
    {
        $validacionesGenerales = new Validaciones();
        try {
            if (General::isTipoRol(Rol::Estudiante) == false) {
                throw new Exception(ErrorMessages::SoloUsuariosEstudiantePueden . "comprar cursos");
            }

            if (!isset($_POST["curso"])) {
                throw new Exception(ErrorMessages::IdCursoNoDefinido);
            }

            $IdCurso = htmlspecialchars(addslashes($_POST["curso"]), ENT_QUOTES);
            if (General::isInteger($IdCurso) == false) {
                throw new Exception(ErrorMessages::IdCursoNoEsNumero);
            }

            if (!isset($_POST["costo"])) {
                throw new Exception(ErrorMessages::CostoCursoNoDefinido);
            }

            $costoCurso = htmlspecialchars(addslashes($_POST["costo"]), ENT_QUOTES);
            if (General::isPositiveNumber($IdCurso) == false) {
                throw new Exception(ErrorMessages::CostoCursoNoEsNumeroPositivo);
            }
           

            $cursoComprar = new Cursos_Model();
            $cursoComprar->setIdCurso($IdCurso);
            $cursoComprar->setCostoCurso($costoCurso);

            include Constants::PROJECT_PATH_INCLUDE . "Vista/Pages/Usuarios/payment.php";
        } 
        catch (Exception $e) {
            if ($e->getMessage() != "")
                $validacionesGenerales->setMensajeError($e->getMessage());

            include Constants::PROJECT_PATH_INCLUDE . "Vista/Pages/error.php";
        }
    }
    public function mostrarMisCursosComprados($paths)
    {
        $validacionesGenerales = new Validaciones();
        try {
            if (General::isTipoRol(Rol::Estudiante) == false){
                throw new Exception(ErrorMessages::SoloUsuariosEstudiantePueden . "ver sus cursos comprados");
            }

            //MIS COMPRAS COMO ESTUDIANTE
            $IdUsuarioActivo = General::getIdUsuarioActivo();
            $NumeroCursoPaginacion = 0;

            $argumentosCursos = new Cursos_Model();
            $argumentosCursos->getCompraCurso()->setUsuarioComprador($IdUsuarioActivo);
            $argumentosCursos->setNumeroCursoPaginacion($NumeroCursoPaginacion);
            $listaMisCursosComprados = Cursos_DAO::getCursos("MisCursosComprados", $argumentosCursos);

            $listaTodosMisCursosComprados = Cursos_DAO::getCursos("TodosMisCursosComprados", $argumentosCursos);

            $cantidadDeCursosActivos = 0;
            foreach ($listaTodosMisCursosComprados as $iCursoComprado) {

                if ($iCursoComprado->getEstadoCurso() == 1) {
                    $cantidadDeCursosActivos++;
                }
            }

            include Constants::PROJECT_PATH_INCLUDE . "Vista/Pages/Cursos/history.php";
        }
        catch (Exception $e) {
            if ($e->getMessage() != "")
                $validacionesGenerales->setMensajeError($e->getMessage());
    
            include Constants::PROJECT_PATH_INCLUDE . "Vista/Pages/error.php";
        }
    }

    public function cargarMisCursos($paths)
    {
        ob_end_clean();

        $NumeroCursoPaginacion = $_POST["numeroCurso"];

        $IdUsuarioActivo = General::getIdUsuarioActivo();;
        $RolUsuarioActivo = General::getRolUsuarioActivo();


        $argumentosCursos = new Cursos_Model();

        $argumentosCursos->getCompraCurso()->setUsuarioComprador($IdUsuarioActivo);
        $argumentosCursos->setIdRolUsuario($RolUsuarioActivo);
        $argumentosCursos->setNumeroCursoPaginacion($NumeroCursoPaginacion);

        $listaMisCursosComprados = Cursos_DAO::getCursos("MisCursosComprados", $argumentosCursos);

        $jsonInfo = json_encode($listaMisCursosComprados);
        echo $jsonInfo;

        die();
    }


    public function realizarCompra($paths)
    {

        ob_end_clean();

        $data = $_POST["datos"];
        $UsuarioComprador = General::getIdUsuarioActivo();
        //     $CursoComprado = htmlspecialchars(addslashes($_POST["CursoComprado"]), ENT_QUOTES);
        // .purchase_units[0].amount.value

        $CursoComprado = $_POST["idcurso"];;

        // TODO: QUITAR HARDCODEO PARA QUE SEA DINAMICO SEGUN LA BD, PAYPAL = 1, TARJETA = 2
        $FormaDePago = 1;


        //Valores duumies en lo que lo hago

        $costo = $data["purchase_units"][0]["amount"]["value"];
        // $FechaCreacionCompra=$data["create_time"];
        // $CodigoPostal = $data["purchase_units"][0]["shipping"]["address"]["postal_code"];
        // $idTransaccion = $data["id"];
        // $Direccion = $data["purchase_units"][0]["shipping"]["address"]["address_line_1"];

        $argumentosCompras = Compras_Model::createCompras(
            $UsuarioComprador,
            $CursoComprado,
            null,
            $FormaDePago,
            $costo
        );
        // echo json_encode($_POST)
        $rowsAffectted = Compras_DAO::insertUpdateDeleteCompras("I", $argumentosCompras);
        $jsonInfo = json_encode($argumentosCompras);
        echo $jsonInfo;

        
        die();
    }
    public function realizarCompraTarjeta($paths)
    {
        ob_end_clean();

        $costo = $_POST["price"];
        $UsuarioComprador = General::getIdUsuarioActivo();

        $CursoComprado = $_POST["idcurso"];;
        $FormaDePago = 2;

        $argumentosCompras = Compras_Model::createCompras(
            $UsuarioComprador,
            $CursoComprado,
            null,
            $FormaDePago,
            $costo
        );
        // echo json_encode($_POST)
        $rowsAffectted = Compras_DAO::insertUpdateDeleteCompras("I", $argumentosCompras);
        $jsonInfo = json_encode($argumentosCompras);
        echo $jsonInfo;
        
        die();
    }
    public function realizarCompraGratis($paths)
    {
        ob_end_clean();

        $UsuarioComprador = General::getIdUsuarioActivo();
        $CursoComprado = $_POST["idcurso"];


        // TODO: QUITAR HARDCODEO PARA QUE SEA DINAMICO SEGUN LA BD, GRATIS = 3
        $FormaDePago = 3;
        // TODO: ESTA BIEN SETTEAR EL COSTO A 0 PESOS
        $costo = 0;

        $argumentosCompras = Compras_Model::createCompras(
            $UsuarioComprador,
            $CursoComprado,
            null,
            $FormaDePago,
            $costo
        );

        $rowsAffectted = Compras_DAO::insertUpdateDeleteCompras("I", $argumentosCompras);

        $jsonInfo = json_encode($argumentosCompras);
        echo $jsonInfo;
        die();
    }

    public function imprimirDiploma($paths)
    {
        $CursoComprado = $_POST["CursoComprado"];
        $UsuarioComprador = General::getIdUsuarioActivo();
        
        $argumentosDiplomaCurso = new Cursos_Model();
        $argumentosDiplomaCurso->setIdCurso($CursoComprado);
        $argumentosDiplomaCurso->getCompraCurso()->setUsuarioComprador($UsuarioComprador);
        $listaDiplomaCurso = Cursos_DAO::getCursos("BuscarDiploma", $argumentosDiplomaCurso);

        $datosDiplomaCurso = $listaDiplomaCurso[0];

        include Constants::PROJECT_PATH_INCLUDE . "Vista/Pages/Cursos/diploma.php";
    }

    public function editarCompra($paths)
    {
    }

    public function deleteCompra($paths)
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
