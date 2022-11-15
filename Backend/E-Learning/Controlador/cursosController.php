<?php

require_once Constants::PROJECT_PATH_INCLUDE . "Controlador/template.controller.php";

require_once  Constants::PROJECT_PATH_INCLUDE . 'DAO/Cursos_DAO.php';
require_once  Constants::PROJECT_PATH_INCLUDE . 'DAO/Categorias_DAO.php';
require_once  Constants::PROJECT_PATH_INCLUDE . 'DAO/CursCat_DAO.php';
require_once  Constants::PROJECT_PATH_INCLUDE . 'DAO/Niveles_DAO.php';

require_once Constants::PROJECT_PATH_INCLUDE . 'Modelo/Cursos_Model.php';
require_once Constants::PROJECT_PATH_INCLUDE . 'Modelo/Categorias_Model.php';
require_once Constants::PROJECT_PATH_INCLUDE . 'Modelo/CursCat_Model.php';
require_once Constants::PROJECT_PATH_INCLUDE . 'Modelo/Niveles_Model.php';

require_once Constants::PROJECT_PATH_INCLUDE . "Utils/action.php";
require_once Constants::PROJECT_PATH_INCLUDE . "Utils/General.php";
require_once Constants::PROJECT_PATH_INCLUDE . "Utils/Validaciones.php";
require_once Constants::PROJECT_PATH_INCLUDE . "Utils/ErrorMessages.php";

class CursosController extends Controller
{

    //CONTROLLER ROUTE
    public const ROUTE = "cursos";

    //ACTIONS ROUTING
    public const MOSTRAR_CURSO = "detalles";
    public const MOSTRAR_MIS_CURSO = "mis-cursos-creados";

    public const CARGAR_CURSOS = "cargar-cursos";
    public const CREAR_CURSO = "crearcurso";
    public const ALUMNOS_CURSO = "alumnos-curso";

    public const EDITAR_CURSO = "editarcurso";
    public const EDITAR = "realizaredicion";
    public const NIVELES_DEL_CURSO = "niveles";
    public const FINALIZAR_NIVEL_CURSO = "finalizar-nivel";
    public const BUSQUEDA_AVANZADA_CURSOS = "busqueda-avanzada";
    public const DELETE_CURSO = "deletecurso";
    public const VALIDAR_EXTENSION = "validarextension";
    public const CONSEGUIR_CURSO = "conseguir-curso";
    public const API_CURSOS = "api-cursos";

    public $actions;

    public function __construct()
    {
        // parent::__construct($pathName);

        $this->actions = array(
            self::MOSTRAR_CURSO => new Action("mostrarCurso", null),
            self::MOSTRAR_MIS_CURSO => new Action("mostrarMisCurso", null),
            self::CARGAR_CURSOS => new Action(null, "cargarCursos"),
            self::CREAR_CURSO => new Action("verPaginaCrearCurso", "crearCurso"),
            self::EDITAR_CURSO => new Action(null, "editarCurso"),
            self::EDITAR => new Action(null, "realizarEdicion"),
            self::VALIDAR_EXTENSION => new Action(null, "validarExtension"),
            self::NIVELES_DEL_CURSO => new Action("verPaginaNivelesDelCurso", null),
            self::FINALIZAR_NIVEL_CURSO => new Action(null, "finalizarNivel"),
            self::BUSQUEDA_AVANZADA_CURSOS => new Action("verPaginaBusquedaAvanzadaCursos", "ingresarParametrosBusquedaAvanzada"),
            self::DELETE_CURSO => new Action(null, "deleteCurso"),
            self::ALUMNOS_CURSO => new Action("ShowStudentsCourse", "MostrarMasCursos"),
            self::CONSEGUIR_CURSO => new Action(null, "conseguirCalificacion"),
            self::API_CURSOS => new Action("API_Cursos", null),

        );
    }


    public function validarExtension($paths)
    {

        ob_end_clean();
        $extensiones = explode(",", $_POST["extensiones"]);
        $filename = $_POST["name"];
        //$type=$_POST["type"];
        $resultado = General::validarPorExtensiones($extensiones, $filename);
        //$filename = $_FILES['video_file']['name'];
        if ($resultado) {
            echo json_encode(true);
        } else {
            echo json_encode(false);
        }
        die();
    }


    //Terminar las validaciones de extension aqui
    public function realizarEdicion($paths)
    {
        $validacionesGenerales = new Validaciones();

        try {
            $TituloCurso = htmlspecialchars(addslashes($_POST["title"]), ENT_QUOTES);

            $DescripcionCurso = htmlspecialchars(addslashes($_POST["description"]), ENT_QUOTES);

            $CostoCurso = $_POST["course-price"];

            $ImagenCurso = null;
            $ImagenCursoPath = File::getImage($_FILES["file-curso-imagen"]);

            if ($ImagenCursoPath != null) {
                $data = file_get_contents($ImagenCursoPath);
                $ImagenCurso = base64_encode($data);

                File::unsetImage($ImagenCursoPath);
            }

            $IdUsuarioCreadorCurso = General::getIdUsuarioActivo();


            $IdCurso = $_POST["idCurso"];


            $level_title = $_POST["level-title"];
            $level_free = null;

            if (isset($_POST["level-free"])) {
                $level_free = $_POST["level-free"];


                if (sizeof($level_title) == sizeof($level_free)) {
                    $CostoCurso = 0;
                }
            }

            $argumentosCurso = Cursos_Model::createCurso(
                $IdCurso,
                $TituloCurso,
                $DescripcionCurso,
                $ImagenCurso,
                $CostoCurso,
                null,
                null,
                $IdUsuarioCreadorCurso
            );


            $categoriasCurso = $_POST['category-select'];



            $rowsAffectted = Cursos_DAO::insertUpdateDeleteCursos("U", $argumentosCurso);




            foreach ($categoriasCurso as $CategoriaElegida) {
                $argumentosCursCat = CursCat_Model::createCursCat($IdCurso, $CategoriaElegida);

                $rowsAffectted = CursCat_DAO::insertUpdateDeleteCursCat("I", $argumentosCursCat);
            }


            $level_content = $_POST["level-content"];

            //TODO: AVANCE PONER AQUI EL NOMBRE CORRECTO DEL CAMPO NIVEL GRATIS

            $level_ids = $_POST["level-id"];
            $file_video = null;
            $file_video = self::reArrayFiles($_FILES['file-nivel-video']);

            $file_pdf = null;
            $file_pdf = self::reArrayFiles($_FILES['file-nivel-pdf']);
            $indexCheckbox = 0;

            foreach ($level_title as $key => $n) {
                $TituloNivel = null;
                $PathVideoNivel = null;
                $ContenidoNivel = null;
                $PathPDFNivel = null;
                $CursoImpartido = null;
                $idNivel = null;
                $NivelGratis = 0;
                $idNivel = $level_ids[$key];
                $TituloNivel = $n;

                if ($file_video[$key]["size"] != 0) {
                    $name_file = uniqid('videoNivel_') . "_" . $file_video[$key]["name"];
                    $type_file = $file_video[$key]["type"];
                    $size_file = $file_video[$key]["size"];

                    $carpeta_guardar_archivo = $_SERVER["DOCUMENT_ROOT"] . Constants::PROJECT_PATH_VIDEOS;
                    $carpeta_DB = Constants::PROJECT_PATH_VIDEOS;

                    move_uploaded_file($file_video[$key]["tmp_name"], $carpeta_guardar_archivo . $name_file);

                    $PathVideoNivel = $carpeta_DB . $name_file;
                }


                $ContenidoNivel = filter_var(htmlspecialchars($level_content[$key], FILTER_SANITIZE_STRING));

                if ($file_pdf[$key]["size"] != 0) {
                    $name_file = uniqid('pdfNivel_') . "_" . $file_pdf[$key]["name"];
                    $type_file = $file_pdf[$key]["type"];
                    $size_file = $file_pdf[$key]["size"];

                    $carpeta_guardar_archivo = $_SERVER["DOCUMENT_ROOT"] . Constants::PROJECT_PATH_FILES;
                    $carpeta_DB = Constants::PROJECT_PATH_FILES;

                    move_uploaded_file($file_pdf[$key]["tmp_name"], $carpeta_guardar_archivo . $name_file);

                    $PathPDFNivel = $carpeta_DB . $name_file;
                }
                

                if (isset($_POST["level-free"])) {
                    if (sizeof($level_title) != sizeof($level_free)) {
                        if (sizeof($level_free) > $indexCheckbox) {
                            if ($level_free[$indexCheckbox] == $key) {
                                $NivelGratis = 1;
                                $indexCheckbox += 1;
                            } else {
                                $NivelGratis = 0;
                            }
                        }
                    } else {
                        $NivelGratis = 0;
                    }
                }

                if ($CostoCurso == 0) {
                    $NivelGratis = 0;
                }

                $CursoImpartido = $IdCurso;

                $argumentosNivel = Niveles_Model::createNiveles(
                    $idNivel,
                    $TituloNivel,
                    $PathVideoNivel,
                    $ContenidoNivel,
                    $PathPDFNivel,
                    $NivelGratis,
                    null,
                    null,
                    $CursoImpartido
                );

                $rowsAffectted = Niveles_DAO::insertUpdateDeleteNiveles("U", $argumentosNivel);
            }

            header("Location: " . Constants::ROOT_PATH . CursosController::ROUTE . "/" . CursosController::MOSTRAR_CURSO . "/" . $IdCurso);
        } catch (Exception $e) {
            if ($e->getMessage() != "")
            $validacionesGenerales->setMensajeError($e->getMessage());

            include Constants::PROJECT_PATH_INCLUDE . "Vista/Pages/error.php";
        }
    }
    public function editarCurso($paths)
    {


        try {
            if (General::isTipoRol(Rol::Escuela) == false) {
                throw new Exception(ErrorMessages::SoloUsuariosEscuelaPueden . "editar un curso");
            }

            if (!isset($_POST["idCurso"])) {
                throw new Exception(ErrorMessages::IdCursoNoDefinido);
            }

            #region Obtener curso
            $IdCurso = htmlspecialchars(addslashes($_POST["idCurso"]), ENT_QUOTES);
            if (General::isInteger($IdCurso) == false) {
                throw new Exception(ErrorMessages::IdCursoNoEsNumero);
            }


            $IdUsuarioActivo = General::getIdUsuarioActivo();


            $argumentosCursos = new Cursos_Model();
            $argumentosCursos->setIdCurso($IdCurso);
            $argumentosCursos->setUsuarioCreador($IdUsuarioActivo);

            $cursoElegido = null;

            $listaCurso = Cursos_DAO::getCursos("MiCursoCreado", $argumentosCursos);
            if ($listaCurso == null) {
                throw new Exception(ErrorMessages::CursoNoExisteONoDisponible);
            }
            $cursoElegido = $listaCurso[0];
            #endregion



            #region Obtener categorias niveles
            $argumentosCategorias = new Categorias_Model();
            $argumentosCategorias->setCursosRelacionados($cursoElegido->getIdCurso());
            $listaCategoriasDelCurso = Categorias_DAO::getCategorias("CategoriasDelCurso", $argumentosCategorias);

            $argumentosNiveles = new Niveles_Model();
            $argumentosNiveles->setCursoImpartido($cursoElegido->getIdCurso());
            $listaNivelesDelCurso = Niveles_DAO::getNiveles("NivelesDelCurso", $argumentosNiveles);

            $filenamee = basename('/path/to/file.ext');
            $argumentosCategorias = new Categorias_Model();
            $listaCategorias = Categorias_DAO::getCategorias("X", $argumentosCategorias);
            #endregion

            include Constants::PROJECT_PATH_INCLUDE . "Vista/Pages/Cursos/editCourse.php";
        } catch (Exception $e) {
            if ($e->getMessage() != "")
                $validacionesGenerales->setMensajeError($e->getMessage());

            include Constants::PROJECT_PATH_INCLUDE . "Vista/Pages/error.php";
        }
    }
    public function ShowContent($paths)
    {
        //Determine wich method call TO A SPECIFIC ACTION SENDED IT IN THE URL
        Action::ValidateActionsPath($paths, $this);
    }

    public function MostrarMasCursos($paths)
    {
        ob_end_clean();


        $IdUsuarioActivo = General::getIdUsuarioActivo();

        $argumentosCursos = new Cursos_Model();
        $argumentosCursos->setUsuarioCreador($IdUsuarioActivo);

        $NumeroCursoPaginacion = (int)$_POST["paginacion"];;

        $argumentosCursos->setNumeroCursoPaginacion($NumeroCursoPaginacion);
        $listaMisCursosCreados = Cursos_DAO::getCursos("MisCursosCreados", $argumentosCursos);

        $json = json_encode($listaMisCursosCreados);
        echo json_encode($listaMisCursosCreados);
        //TODO cargar mas comentarios aqui
        die();
    }


    public function mostrarCurso($paths)
    {
        $validacionesGenerales = new Validaciones();
        try {
            #region Validar Paths
            if (!isset($paths[2])) {
                throw new Exception(ErrorMessages::IdCursoNoDefinido);
            }

            $IdCurso = htmlspecialchars(addslashes($paths[2]), ENT_QUOTES);
            if (General::isInteger($IdCurso) == false) {
                throw new Exception(ErrorMessages::IdCursoNoEsNumero);
            }
            #endregion

            #region Obtener curso
            $IdUsuarioActivo = null;

            if (General::isTipoRol(Rol::Estudiante)) {
                $IdUsuarioActivo = General::getIdUsuarioActivo();
            }

            $argumentosCursos = new Cursos_Model();
            $argumentosCursos->setIdCurso($IdCurso);
            $argumentosCursos->getCompraCurso()->setUsuarioComprador($IdUsuarioActivo);

            $listaCurso = Cursos_DAO::getCursos("BuscarCurso", $argumentosCursos);

            if ($listaCurso == null) {
                throw new Exception(ErrorMessages::CursoNoExisteONoDisponible);
            }

            $cursoElegido = $listaCurso[0];
            #endregion

            #region Hacer Validaciones
            $validacionesGenerales = new Validaciones();
            $validacionesGenerales->validarCursoElegido($cursoElegido);

            if ($validacionesGenerales->getUsuarioPuedeVerPaginaCurso() == false) {
                throw new Exception();
            }
            #endregion

            #region Obtener niveles, categorias y comentarios
            $argumentosCategorias = new Categorias_Model();
            $argumentosCategorias->setCursosRelacionados($cursoElegido->getIdCurso());
            $listaCategoriasDelCurso = Categorias_DAO::getCategorias("CategoriasDelCurso", $argumentosCategorias);


            $argumentosNiveles = new Niveles_Model();
            $argumentosNiveles->setCursoImpartido($cursoElegido->getIdCurso());
            $listaNivelesDelCurso = Niveles_DAO::getNiveles("NivelesDelCurso", $argumentosNiveles);


            $argumentosComentario = new Comentarios_Model();
            $argumentosComentario->setCursoComentado($IdCurso);
            $argumentosComentario->setNumeroComentarioPaginacion(0);
            $argumentosComentario->setUsuarioComento(General::getIdUsuarioActivo());
            $listaComentariosCurso = Comentarios_DAO::getComentarios("ComentariosPrincipalesCurso", $argumentosComentario);


            $listaComentariosUsuarioCurso = Comentarios_DAO::getComentarios("ComentarioReciente", $argumentosComentario);
            $comentarioUsuarioCurso = null;
            if ($listaComentariosUsuarioCurso != null) {
                $comentarioUsuarioCurso = $listaComentariosUsuarioCurso[0];
            }


            $argumentosCalificacion = new Calificaciones_Model();
            $argumentosCalificacion->setCursoCalificado($IdCurso);
            $argumentosCalificacion->setUsuarioCalifico(General::getIdUsuarioActivo());
            $calificacionCurso = Calificaciones_DAO::getCalificaciones("BuscarCalificacion", $argumentosCalificacion);

            $votoCalificacion = -1;
            if ($calificacionCurso != null)
                $votoCalificacion = $calificacionCurso[0]->getUtilidadCalificacion();

            #endregion

            include Constants::PROJECT_PATH_INCLUDE . "Vista/Pages/Cursos/curso.php";
        } catch (Exception $e) {
            if ($e->getMessage() != "")
                $validacionesGenerales->setMensajeError($e->getMessage());

            include Constants::PROJECT_PATH_INCLUDE . "Vista/Pages/error.php";
        }
    }

    public function mostrarMisCurso($paths)
    {
        $validacionesGenerales = new Validaciones();
        try {
            if (General::isTipoRol(Rol::Escuela) == false) {
                throw new Exception(ErrorMessages::SoloUsuariosEscuelaPueden . "ver sus ventas");
            }
            //MIS VENTADOS COMO ESCUELA
            $IdUsuarioActivo = General::getIdUsuarioActivo();
            $NumeroCursoPaginacion = 0;

            $argumentosCursos = new Cursos_Model();
            $argumentosCursos->setUsuarioCreador($IdUsuarioActivo);
            $argumentosCursos->setNumeroCursoPaginacion($NumeroCursoPaginacion);

            $listaMisCursosCreados = Cursos_DAO::getCursos("MisCursosCreados", $argumentosCursos);

            $listaTodosMisCursosCreados = Cursos_DAO::getCursos("TodosMisCursosCreados", $argumentosCursos);

            $ingresosMetodosDePago = Cursos_DAO::getCursos("IngresosPorPago", $argumentosCursos);
            include Constants::PROJECT_PATH_INCLUDE . "Vista/Pages/Cursos/sells.php";
        } catch (Exception $e) {
            if ($e->getMessage() != "")
                $validacionesGenerales->setMensajeError($e->getMessage());

            include Constants::PROJECT_PATH_INCLUDE . "Vista/Pages/error.php";
        }
    }


    public function verPaginaCrearCurso($paths)
    {
        $validacionesGenerales = new Validaciones();
        try {
            if (General::isTipoRol(Rol::Escuela) == false) {
                throw new Exception(ErrorMessages::SoloUsuariosEscuelaPueden . "crear un curso");
            }

            $argumentosCategorias = new Categorias_Model();
            $listaCategorias = Categorias_DAO::getCategorias("X", $argumentosCategorias);

            include Constants::PROJECT_PATH_INCLUDE . "Vista/Pages/Cursos/addCourse.php";
        } catch (Exception $e) {
            if ($e->getMessage() != "")
                $validacionesGenerales->setMensajeError($e->getMessage());

            include Constants::PROJECT_PATH_INCLUDE . "Vista/Pages/error.php";
        }
    }

    public function crearCurso($paths)
    {
        $TituloCurso = htmlspecialchars(addslashes($_POST["title"]), ENT_QUOTES);

        $DescripcionCurso = htmlspecialchars(addslashes($_POST["description"]), ENT_QUOTES);

        $CostoCurso = $_POST["course-price"];


        $ImagenCurso = null;
        $ImagenCursoPath = File::getImage($_FILES["file-curso-imagen"]);

        if ($ImagenCursoPath != null) {
            $data = file_get_contents($ImagenCursoPath);
            $ImagenCurso = base64_encode($data);

            File::unsetImage($ImagenCursoPath);
        }

        $IdUsuarioCreadorCurso = General::getIdUsuarioActivo();;


        $argumentosCurso = Cursos_Model::createCurso(
            null,
            $TituloCurso,
            $DescripcionCurso,
            $ImagenCurso,
            $CostoCurso,
            null,
            null,
            $IdUsuarioCreadorCurso
        );


        $categoriasCurso = $_POST['category-select'];


        $rowsAffectted = Cursos_DAO::insertUpdateDeleteCursos("I", $argumentosCurso);

        $listaCursos = Cursos_DAO::getCursos("CursosByUsuarioCreador", $argumentosCurso);
        $IdCurso = $listaCursos[0]->getIdCurso();


        foreach ($categoriasCurso as $CategoriaElegida) {
            $argumentosCursCat = CursCat_Model::createCursCat($IdCurso, $CategoriaElegida);

            $rowsAffectted = CursCat_DAO::insertUpdateDeleteCursCat("I", $argumentosCursCat);
        }


        $level_title = $_POST["level-title"];
        $level_content = $_POST["level-content"];

        
        $level_free = null;

        if (isset($_POST["level-free"])) {
            $level_free = $_POST["level-free"];


            if (sizeof($level_title) == sizeof($level_free)) {
                $CostoCurso = 0;
            }
        }

        $file_video = null;
        $file_video = self::reArrayFiles($_FILES['file-nivel-video']);

        $file_pdf = null;
        $file_pdf = self::reArrayFiles($_FILES['file-nivel-pdf']);
        $indexCheckbox = 0;

        foreach ($level_title as $key => $n) {
            $TituloNivel = null;
            $PathVideoNivel = null;
            $ContenidoNivel = null;
            $PathPDFNivel = null;
            $CursoImpartido = null;
            $NivelGratis = 0;
            $TituloNivel = $n;

            if ($file_video[$key]["size"] != 0) {
                $name_file = uniqid('videoNivel_') . "_" . $file_video[$key]["name"];
                $type_file = $file_video[$key]["type"];
                $size_file = $file_video[$key]["size"];

                $carpeta_guardar_archivo = $_SERVER["DOCUMENT_ROOT"] . Constants::PROJECT_PATH_VIDEOS;
                $carpeta_DB = Constants::PROJECT_PATH_VIDEOS;

                move_uploaded_file($file_video[$key]["tmp_name"], $carpeta_guardar_archivo . $name_file);

                $PathVideoNivel = $carpeta_DB . $name_file;
            }


            $ContenidoNivel = filter_var(htmlspecialchars($level_content[$key], FILTER_SANITIZE_STRING));

            if ($file_pdf[$key]["size"] != 0) {
                $name_file = uniqid('pdfNivel_') . "_" . $file_pdf[$key]["name"];
                $type_file = $file_pdf[$key]["type"];
                $size_file = $file_pdf[$key]["size"];

                $carpeta_guardar_archivo = $_SERVER["DOCUMENT_ROOT"] . Constants::PROJECT_PATH_FILES;
                $carpeta_DB = Constants::PROJECT_PATH_FILES;

                move_uploaded_file($file_pdf[$key]["tmp_name"], $carpeta_guardar_archivo . $name_file);

                $PathPDFNivel = $carpeta_DB . $name_file;
            }

            if (isset($_POST["level-free"])) {
                if (sizeof($level_title) != sizeof($level_free)) {
                    if (sizeof($level_free) > $indexCheckbox) {
                        if ($level_free[$indexCheckbox] == $key) {
                            $NivelGratis = 1;
                            $indexCheckbox += 1;
                        } else {
                            $NivelGratis = 0;
                        }
                    }
                } else {
                    $NivelGratis = 0;
                }
            }

            if ($CostoCurso == 0) {
                $NivelGratis = 0;
            }
            
            $CursoImpartido = $IdCurso;

            $argumentosNivel = Niveles_Model::createNiveles(
                null,
                $TituloNivel,
                $PathVideoNivel,
                $ContenidoNivel,
                $PathPDFNivel,
                $NivelGratis,
                null,
                null,
                $CursoImpartido
            );

            $rowsAffectted = Niveles_DAO::insertUpdateDeleteNiveles("I", $argumentosNivel);
        }

        header("Location: " . Constants::ROOT_PATH . CursosController::ROUTE . "/" . CursosController::MOSTRAR_CURSO . "/" . $IdCurso);
    }







    public function verPaginaNivelesDelCurso($paths)
    {
        $validacionesGenerales = new Validaciones();
        try {

            #region Validar Paths
            if (!isset($paths[2])) {
                throw new Exception(ErrorMessages::IdCursoNoDefinido);
            }

            $IdCurso = htmlspecialchars(addslashes($paths[2]), ENT_QUOTES);
            if (General::isInteger($IdCurso) == false) {
                throw new Exception(ErrorMessages::IdCursoNoEsNumero);
            }

            if (!isset($paths[3])) {
                throw new Exception(ErrorMessages::IdNivelNoDefinido);
            }

            $IdNivel = htmlspecialchars(addslashes($paths[3]), ENT_QUOTES);
            if (General::isInteger($IdNivel) == false) {
                throw new Exception(ErrorMessages::IdNivelNoEsNumero);
            }
            #endregion

            #region Obtener curso y nivel elegido

            $IdUsuarioActivo = null;
            if (General::isTipoRol(Rol::Estudiante)) {
                $IdUsuarioActivo = General::getIdUsuarioActivo();
            }

            $argumentosCursos = new Cursos_Model();
            $argumentosCursos->setIdCurso($IdCurso);
            $argumentosCursos->getCompraCurso()->setUsuarioComprador($IdUsuarioActivo);


            $cursoElegido = null;
            $listaCurso = Cursos_DAO::getCursos("BuscarCurso", $argumentosCursos);
            if ($listaCurso == null) {
                throw new Exception(ErrorMessages::CursoNoExisteONoDisponible);
            }
            $cursoElegido = $listaCurso[0];

            $argumentosNivel = new Niveles_Model();
            $argumentosNivel->setIdNivel($IdNivel);
            $argumentosNivel->setCursoImpartido($IdCurso);

            $nivelElegido = null;
            $listaNivelElegido = Niveles_DAO::getNiveles("NivelDesplegado", $argumentosNivel);

            if ($listaNivelElegido == null) {
                throw new Exception(ErrorMessages::NivelNoExisteONoDisponible);
            }
            $nivelElegido =  $listaNivelElegido[0];

            #endregion


            #region Validaciones en pagina
            $validacionesGenerales->validarNivelCursoElegido($cursoElegido, $nivelElegido);

            if ($validacionesGenerales->getUsuarioPuedeVerPaginaNivel() == false) {
                throw new Exception();
            }

            #endregion

            #region Obtener niveles del curso
            $argumentosNivel = new Niveles_Model();
            $argumentosNivel->setCursoImpartido($IdCurso);

            $listaNivelesDelCurso = Niveles_DAO::getNiveles("NivelesDelCurso", $argumentosNivel);
            #endregion

            #region Actualizar utlima visualizacion de curso comprado
            if ($validacionesGenerales->isCursoComprado($cursoElegido) == true) {
                $argumentosCompra = new Compras_Model();
                $argumentosCompra->setCursoComprado($IdCurso);
                $argumentosCompra->setUsuarioComprador($IdUsuarioActivo);

                $rowsAffected = Compras_DAO::insertUpdateDeleteCompras("UpdateFechaUltimaVisualizacion", $argumentosCompra);
            }
            #endregion

            include Constants::PROJECT_PATH_INCLUDE . "Vista/Pages/Cursos/viewCourse.php";
        } catch (Exception $e) {
            if ($e->getMessage() != "")
                $validacionesGenerales->setMensajeError($e->getMessage());

            include Constants::PROJECT_PATH_INCLUDE . "Vista/Pages/error.php";
        }
    }

    public function finalizarNivel($paths)
    {
        ob_end_clean();

        if (General::isTipoRol(Rol::Estudiante)) {
            $IdNivel = $_POST["IdNivel"];
            $IdCurso = $_POST["IdCurso"];
            $ProgressNivel = $_POST["ProgressNivel"];

            if ($ProgressNivel != -1) {
                $IdUsuarioActivo = General::getIdUsuarioActivo();

                $argumentosCompra = new Compras_Model();
                $argumentosCompra->setNivelCursoComprado($IdNivel);
                $argumentosCompra->setCursoComprado($IdCurso);
                $argumentosCompra->setProgresoCursoComprado($ProgressNivel);
                $argumentosCompra->setUsuarioComprador($IdUsuarioActivo);

                $rowsAffected = Compras_DAO::insertUpdateDeleteCompras("UpdateProgresoComprado", $argumentosCompra);

                $jsonInfo = '{"Mensaje": "Exito"}';
                echo $jsonInfo;
            } else {
                $jsonInfo = '{"Mensaje": "El Nivel visto es un nivel gratis, por lo que no se puede actualizar una compra del progreso del Curso"}';
                echo $jsonInfo;
            }
        } else {
            $jsonInfo = '{"Mensaje": "Error al actualizar compra progreso del Curso"}';
            echo $jsonInfo;
        }

        die();
    }


    public function ingresarParametrosBusquedaAvanzada($paths)
    {
        $unwanted_array = array(
            'Š' => 'S', 'š' => 's', 'Ž' => 'Z', 'ž' => 'z', 'À' => 'A', 'Á' => 'A', 'Â' => 'A', 'Ã' => 'A', 'Ä' => 'A', 'Å' => 'A', 'Æ' => 'A', 'Ç' => 'C', 'È' => 'E', 'É' => 'E',
            'Ê' => 'E', 'Ë' => 'E', 'Ì' => 'I', 'Í' => 'I', 'Î' => 'I', 'Ï' => 'I', 'Ñ' => 'N', 'Ò' => 'O', 'Ó' => 'O', 'Ô' => 'O', 'Õ' => 'O', 'Ö' => 'O', 'Ø' => 'O', 'Ù' => 'U',
            'Ú' => 'U', 'Û' => 'U', 'Ü' => 'U', 'Ý' => 'Y', 'Þ' => 'B', 'ß' => 'Ss', 'à' => 'a', 'á' => 'a', 'â' => 'a', 'ã' => 'a', 'ä' => 'a', 'å' => 'a', 'æ' => 'a', 'ç' => 'c',
            'è' => 'e', 'é' => 'e', 'ê' => 'e', 'ë' => 'e', 'ì' => 'i', 'í' => 'i', 'î' => 'i', 'ï' => 'i', 'ð' => 'o', 'ñ' => 'n', 'ò' => 'o', 'ó' => 'o', 'ô' => 'o', 'õ' => 'o',
            'ö' => 'o', 'ø' => 'o', 'ù' => 'u', 'ú' => 'u', 'û' => 'u', 'ý' => 'y', 'þ' => 'b', 'ÿ' => 'y'
        );

        $IdCategoria = "";
        $NombreUsuario = "";
        $TituloCurso = "";
        $FechaDesde = "";
        $FechaHasta = "";

        if (isset($_POST["id-categoria"])) {
            if ($_POST["id-categoria"] != "")
                $IdCategoria = "/id-categoria--" . htmlspecialchars(addslashes($_POST["id-categoria"]), ENT_QUOTES);
        }
        if (isset($_POST["nombre-usuario"])) {
            if ($_POST["nombre-usuario"] != "") {
                $NombreUsuarioSinFormato = htmlspecialchars(addslashes($_POST["nombre-usuario"]), ENT_QUOTES);
                $NombreUsuarioConFormato = str_replace(" ", "_", $NombreUsuarioSinFormato);

                $NombreUsuarioConFormato = strtr($NombreUsuarioConFormato, $unwanted_array);
                $NombreUsuario = "/nombre-usuario--" . $NombreUsuarioConFormato;
            }
        }
        if (isset($_POST["titulo-curso"])) {
            if ($_POST["titulo-curso"] != "") {
                $TituloCursoSinFormato = htmlspecialchars(addslashes($_POST["titulo-curso"]), ENT_QUOTES);
                $TituloCursoConFormato = str_replace(" ", "_", $TituloCursoSinFormato);

                $TituloCursoConFormato = strtr($TituloCursoConFormato, $unwanted_array);
                $TituloCurso = "/titulo-curso--" . $TituloCursoConFormato;
            }
        }
        if (isset($_POST["fecha-desde"])) {
            if ($_POST["fecha-desde"] != "")
                $FechaDesde = "/fecha-desde--" . htmlspecialchars(addslashes($_POST["fecha-desde"]), ENT_QUOTES);
        }
        if (isset($_POST["fecha-hasta"])) {
            if ($_POST["fecha-hasta"] != "")
                $FechaHasta = "/fecha-hasta--" . htmlspecialchars(addslashes($_POST["fecha-hasta"]), ENT_QUOTES);
        }

        header("Location: " . Constants::ROOT_PATH . CursosController::ROUTE . "/" . CursosController::BUSQUEDA_AVANZADA_CURSOS .
            $IdCategoria . $NombreUsuario . $TituloCurso . $FechaDesde . $FechaHasta);
    }


    public function verPaginaBusquedaAvanzadaCursos($paths)
    {
        $argumentosCursos = new Cursos_Model();


        $IdCategoria = null;
        $NombreCompletoUsuario = null;
        $TituloCurso = null;
        $FechaDesde = null;
        $FechaHasta = null;

        if (isset($paths["id-categoria"]))
            $IdCategoria = htmlspecialchars(addslashes($paths["id-categoria"]), ENT_QUOTES);

        if (isset($paths["nombre-usuario"])) {
            $NombreUsuarioSinFormato = htmlspecialchars(addslashes($paths["nombre-usuario"]), ENT_QUOTES);
            $NombreUsuarioConFormato = str_replace("_", " ", $NombreUsuarioSinFormato);
            $NombreCompletoUsuario = ucwords(strtolower($NombreUsuarioConFormato));
        }

        if (isset($paths["titulo-curso"])) {
            $TituloCursoSinFormato = htmlspecialchars(addslashes($paths["titulo-curso"]), ENT_QUOTES);
            $TituloCursoConFormato = str_replace("_", " ", $TituloCursoSinFormato);
            $TituloCurso = ucwords(strtolower($TituloCursoConFormato));
        }

        if (isset($paths["fecha-desde"]))
            $FechaDesde = htmlspecialchars(addslashes($paths["fecha-desde"]), ENT_QUOTES);

        if (isset($paths["fecha-hasta"]))
            $FechaHasta = htmlspecialchars(addslashes($paths["fecha-hasta"]), ENT_QUOTES);




        $argumentosCursos->setCategoriaFiltro($IdCategoria);
        $argumentosCursos->setNombreCompletoUsuario($NombreCompletoUsuario);
        $argumentosCursos->setTituloCurso($TituloCurso);
        $argumentosCursos->setFechaDesdeCreacionCurso($FechaDesde);
        $argumentosCursos->setFechaHastaCreacionCurso($FechaHasta);
        $argumentosCursos->setNumeroCursoPaginacion(0);

        $listaCursosBusquedaAvanzada = Cursos_DAO::getCursos("BusquedaAvanzada", $argumentosCursos);

        $argumentosCategorias = new Categorias_Model();
        $listaCategorias = Categorias_DAO::getCategorias("X", $argumentosCategorias);

        include Constants::PROJECT_PATH_INCLUDE . "Vista/Pages/Cursos/busqueda.php";
    }



    public function deleteCurso($paths)
    {
        ob_end_clean();
        $idCurso = $_POST["idCurso"];
        $argumentosCurso = Cursos_Model::createCurso(
            $idCurso,
            null,
            null,
            null,
            null,
            null,
            null,
            null
        );

        $rowsAffectted = Cursos_DAO::insertUpdateDeleteCursos("D", $argumentosCurso);

        $json = json_encode($argumentosCurso);
        echo "Exito";

        //TODO NOSE PORQUE NO JALA EL AJAX CHECAR
        die();
    }

    function reArrayFiles(&$file_post)
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
    public function ShowStudentsCourse($paths)
    {
        $validacionesGenerales = new Validaciones();
        try {
            if (General::isTipoRol(Rol::Escuela) == false) {
                throw new Exception(ErrorMessages::SoloUsuariosEscuelaPueden . "ver sus ventas");
            }

            if (!isset($paths[2])) {
                throw new Exception(ErrorMessages::IdCursoNoDefinido);
            }

            $IdCurso = htmlspecialchars(addslashes($paths[2]), ENT_QUOTES);
            if (General::isInteger($IdCurso) == false) {
                throw new Exception(ErrorMessages::IdCursoNoEsNumero);
            }

            $IdUsuarioActivo = General::getIdUsuarioActivo();

            $argumentosCursos = new Cursos_Model();
            $argumentosCursos->setIdCurso($IdCurso);
            $argumentosCursos->setUsuarioCreador($IdUsuarioActivo);

            $cursoElegido = null;
            $listaCursos = Cursos_DAO::getCursos("MiCursoCreado", $argumentosCursos);
            if ($listaCursos == null) {
                throw new Exception(ErrorMessages::CursoNoExisteONoDisponible);
            }
            $cursoElegido = $listaCursos[0];

            $listStudents = Cursos_DAO::getCursos("StudentsByCourse", $argumentosCursos);

            $TotalIngresos = null;
            foreach ($listStudents as $student) {
                $TotalIngresos += $student->getCompraCurso()->getPago();
            }

            include Constants::PROJECT_PATH_INCLUDE . "Vista/Pages/Cursos/courseStudents.php";
        } catch (Exception $e) {
            if ($e->getMessage() != "")
                $validacionesGenerales->setMensajeError($e->getMessage());

            include Constants::PROJECT_PATH_INCLUDE . "Vista/Pages/error.php";
        }
    }

    public function cargarCursos($paths)
    {
        ob_end_clean();

        $IdCategoria = null;
        $NombreCompletoUsuario = null;
        $TituloCurso = null;
        $FechaDesde = null;
        $FechaHasta = null;

        $numeroCurso = $_POST["numeroCurso"];

        if (isset($_POST["id-categoria"])) {
            if ($_POST["id-categoria"] != "")
                $IdCategoria = htmlspecialchars(addslashes($_POST["id-categoria"]), ENT_QUOTES);
        }
        if (isset($_POST["nombre-usuario"])) {
            if ($_POST["nombre-usuario"] != "")
                $NombreCompletoUsuario = htmlspecialchars(addslashes($_POST["nombre-usuario"]), ENT_QUOTES);
        }
        if (isset($_POST["titulo-curso"])) {
            if ($_POST["titulo-curso"] != "")
                $TituloCurso = htmlspecialchars(addslashes($_POST["titulo-curso"]), ENT_QUOTES);
        }
        if (isset($_POST["fecha-desde"])) {
            if ($_POST["fecha-desde"] != "")
                $FechaDesde = htmlspecialchars(addslashes($_POST["fecha-desde"]), ENT_QUOTES);
        }
        if (isset($_POST["fecha-hasta"])) {
            if ($_POST["fecha-hasta"] != "")
                $FechaHasta = htmlspecialchars(addslashes($_POST["fecha-hasta"]), ENT_QUOTES);
        }

        $argumentosCursos = new Cursos_Model();

        $argumentosCursos->setCategoriaFiltro($IdCategoria);
        $argumentosCursos->setNombreCompletoUsuario($NombreCompletoUsuario);
        $argumentosCursos->setTituloCurso($TituloCurso);
        $argumentosCursos->setFechaDesdeCreacionCurso($FechaDesde);
        $argumentosCursos->setFechaHastaCreacionCurso($FechaHasta);


        $argumentosCursos->setNumeroCursoPaginacion($numeroCurso); //Podemos testear pasando de parametro 0

        $listaCursosBusquedaAvanzada = Cursos_DAO::getCursos("BusquedaAvanzada", $argumentosCursos);

        $jsonInfo = json_encode($listaCursosBusquedaAvanzada);
        echo $jsonInfo;

        die();
    }

    public function conseguirCalificacion()
    {
        ob_end_clean();

        $IdCurso = $_POST["IdCurso"];

        $IdUsuarioActivo = null;

        if (General::isTipoRol(Rol::Estudiante)) {
            $IdUsuarioActivo = General::getIdUsuarioActivo();
        }

        $argumentosCursos = new Cursos_Model();
        $argumentosCursos->setIdCurso($IdCurso);
        $argumentosCursos->getCompraCurso()->setUsuarioComprador($IdUsuarioActivo);

        $listaCurso = Cursos_DAO::getCursos("BuscarCurso", $argumentosCursos);

        $cursoElegido = $listaCurso[0];


        $jsonInfo = json_encode($cursoElegido);
        echo $jsonInfo;

        die();
    }

    public function Ajax($paths)
    {
        ob_end_clean();


        die();
    }



    public function API_Cursos($paths)
    {
        ob_end_clean();

        $validacionesGenerales = new Validaciones();

        try {
            if (!isset($paths[2])) {
                throw new Exception("ERROR: No ingreso ningun parametro para buscar cursos, las opcines disponibles 1 = Cursos Mayor Calificados, 2 = Cursos Mas Vendidos, 3 = Cursos Mas Recientes");
            } else {
                $parametroBusqueda = $paths[2];
            }

            $query = null;

            switch ($parametroBusqueda) {
                case 1:
                    $query = "CursosMayorCalificados";
                    $jsonInfo = '{"Opcion": "Cursos Mayor Calificados",';
                    break;

                case 2:
                    $query = "CursosMasVendidos";
                    $jsonInfo = '{"Opcion": "Cursos Mas Vendidos",';
                    break;

                case 3:
                    $query = "CursosMasRecientes";
                    $jsonInfo = '{"Opcion": "Cursos Mas Recientes",';
                    break;
                default:
                    throw new Exception("ERROR: El parametro ingresado no coincide con las opcines disponibles 1 = Cursos Mayor Calificados, 2 = Cursos Mas Vendidos, 3 = Cursos Mas Recientes");
                    break;
            }

            $listaCursos = null;

            $argumentosCurso = new Cursos_Model();

            $listaCursosCalificados = Cursos_DAO::getCursos($query, $argumentosCurso);


            $jsonInfo = $jsonInfo . '"data":' . json_encode($listaCursosCalificados);

            $jsonInfo = $jsonInfo . "}";
        } catch (Exception $e) {
            if ($e->getMessage() != "")
                $validacionesGenerales->setMensajeError($e->getMessage());

            $jsonInfo = '{"status": "' . $validacionesGenerales->getMensajeError() . '"}';
        }


        echo $jsonInfo;

        die();
    }
}
