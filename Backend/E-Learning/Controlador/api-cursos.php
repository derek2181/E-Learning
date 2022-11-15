<?php


require_once  '../DAO/Cursos_DAO.php';
require_once '../Modelo/Cursos_Model.php';
require_once '../Modelo/Compras_Model.php';

require_once "../Utils/Validaciones.php";


ob_end_clean();

$validacionesGenerales = new Validaciones();

try {
    if (!isset($_GET["parametro"])) {
        throw new Exception("ERROR: No ingreso ningun parametro para buscar cursos, las opcines disponibles 1 = Cursos Mayor Calificados, 2 = Cursos Mas Vendidos, 3 = Cursos Mas Recientes");
    } else {
        $parametroBusqueda =$_GET["parametro"];
    }

    $query = null;

    switch ($parametroBusqueda) {
        case 1:
            $query = "CursosMayorCalificados";
            break;

        case 2:
            $query = "CursosMasVendidos";
            break;

        case 3:
            $query = "CursosMasRecientes";
            break;
        default:
            throw new Exception("ERROR: El parametro ingresado no coincide con las opcines disponibles 1 = Cursos Mayor Calificados, 2 = Cursos Mas Vendidos, 3 = Cursos Mas Recientes");
            break;
    }

    $listaCursos = null;

    $argumentosCurso = new Cursos_Model();

    $listaCursosCalificados = Cursos_DAO::getCursos($query, $argumentosCurso);


    $jsonInfo = json_encode($listaCursosCalificados);

} catch (Exception $e) {
    if ($e->getMessage() != "")
        $validacionesGenerales->setMensajeError($e->getMessage());

    $jsonInfo = '{"status": "' . $validacionesGenerales->getMensajeError() . '"}';
}


echo $jsonInfo;


die();