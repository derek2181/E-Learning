<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    <link rel="stylesheet" href="<?php echo Constants::VIEWS_PATH?>css/main.css">
    <title>Edit</title>
</head>

<body>
    <div class="container-fluid p-0">
        <div id="contenedor-general-comentarios">
            <!-- Modal -->
            <div class="modal fade" id="ModalElminado" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle"><i class="fas fa-exclamation-triangle text-warning"></i> Advertencia</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <p>Tu curso no podrá estar disponible en la pagina de nuevo</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Volver</button>
                            <button type="button" id="modal-delete-course" value="" data-dismiss="modal" class="btn btn-danger delete-course">Eliminar curso</button>
                        </div>
                    </div>
                </div>
            </div>

            <main>

                <div class="row mb-5 ">
                    <div class="col-12 landing-image p-0">
                        <!-- <img src="../images/categoryBackground.jpg" class="w-100  "  style="height:700px" alt=""> -->
                    </div>
                </div>
                <div class="container bg-light p-5 ">

                    <div class="row mb-3">
                        <div class="col-12">
                            <h1>Tus cursos</h1>

                        </div>
                    </div>
                    <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="btn btn-active-color me-2" id="courseInfo" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true">Cursos</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="btn btn-inactive-color" id="courseLevels" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">Detalles de cursos</button>
                        </li>

                    </ul>

                    <h3>Ingresos</h3>
                    <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade show active " id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                            <?php if (sizeof($listaTodosMisCursosCreados) != 0) : ?>
                                <div class="row">

                                    <div class="col-12" style="max-height: 500px; overflow-y: scroll;">
                                        <table class="table table-striped table-hove table-bordered mb-5 text-center">
                                            <thead>
                                                <tr>
                                                    <th scope="col">Nombre</th>
                                                    <th scope="col">Cantidad de alumnos</th>
                                                    <th scope="col">Nivel promedio</th>
                                                    <th scope="col">Total de ingresos</th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($listaTodosMisCursosCreados  as $i => $iCurso) : ?>
                                                    <tr>
                                                        <th scope="row"><a href="<?php echo Template::Route(CursosController::ROUTE, CursosController::ALUMNOS_CURSO) . "/" . $iCurso->getIdCurso(); ?> " class="link-dark"><?php echo $iCurso->getTituloCurso() ?></a></th>
                                                        <td><?php echo (int)$iCurso->getCantidadAlumnos() ?></td>
                                                        <td><?php echo $iCurso->getNivelPromedio()?>%</td>

                                                        <td>MX$<?php echo $iCurso->getTotalIngresosConFormato() ?></td>
                                                    </tr>

                                                <?php endforeach ?>
                                            </tbody>
                                        </table>
                                    </div>

                                </div>


                                <hr>
                                <div class="row">

                                    <div class="col-12 d-flex flex-column align-items-center">


                                        <div class="container">

                                            <div class="row">
                                                <div class="col-12 col-lg-6">
                                                    <h3 class="text-center">Ingresos totales</h3>
                                                    <input type="hidden" id="paypalPayment" data-paypal="<?php echo $ingresosMetodosDePago[0]->getIngresosPayPal() ?>">
                                                    <input type="hidden" id="cardPayment" data-tarjeta="<?php echo $ingresosMetodosDePago[0]->getIngresosTarjeta() ?>">
                                                    <input type="hidden" id="courseStudents" data-students='<?php echo json_encode($listaTodosMisCursosCreados); ?>'>
                                                    <h4 class="text-center">MX$<?php echo $ingresosMetodosDePago[0]->getTotalIngresosConFormato(); ?></h4>
                                                    <canvas class="m-0" id="formaDePago" height="600px" width="175px"></canvas>
                                                </div>
                                                <div class="col-12 col-lg-6">
                                                    <h3 class="text-center">Estudiantes por curso</h3>

                                                    <canvas id="students" height="600px" width="600px"></canvas>

                                                </div>
                                            </div>

                                        </div>

                                    </div>

                                </div>
                            <?php else : ?>

                                <div class="d-flex justify-content-center align-items-center" style="height:500px">
                                    <h1>Aún no cuentas con cursos</h1>
                                </div>

                            <?php endif ?>
                        </div>
                        <div class="tab-pane fade " id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">

                            <div id="cursos_tarjetas" class="row mb-2">
                                <?php if (sizeof($listaMisCursosCreados) != 0) : ?>
                                    <?php foreach ($listaMisCursosCreados as $i => $iCurso) : ?>
                                        <div class="container-curso card m-2 pt-3 shadow-lg card-course-<?php echo $iCurso->getIdCurso(); ?> " style="width: 18rem;">
                                            <img src="data:image/jpeg; base64, <?php echo $iCurso->getImagenCurso() ?>" class="card-img-top img-thumbnail custom-img-card" alt="...">
                                            <div class="card-body">
                                                <h5 class="card-title text-cut"><?php echo $iCurso->getTituloCurso() ?></h5>
                                                <h5><strong>MX$<?php echo $iCurso->getTotalIngresosConFormato() ?> </strong> recaudado.</h5>
                                                <div class="row">
                                                    <div class="col-7 ">
                                                        <a href="<?php echo Template::Route(CursosController::ROUTE, CursosController::MOSTRAR_CURSO) . "/" . $iCurso->getIdCurso(); ?>" class="btn btn-dark w-100 button-continue-watching">Ver
                                                            detalles</a>
                                                    </div>
                                                    <?php if($iCurso->getEstadoCurso() != 0): ?>
                                                        
                                                    <div class="col-5 d-flex justify-content-between" id ="button-editar-borrar-<?php echo $iCurso->getIdCurso();?>">

                                                        <div class="col-2 d-flex justify-content-center me-1 ">
                                                            <form method="POST" action="<?php echo Template::Route(CursosController::ROUTE, CursosController::EDITAR_CURSO); ?>">
                                                                <input type="hidden" name="idCurso" value="<?php echo $iCurso->getIdCurso(); ?>">
                                                                <button type="submit" class="btn btn-success"><i class="fas fa-edit"></i></button>
                                                            </form>

                                                        </div>
                                                        <div class="col-2 d-flex justify-content-center">

                                                            <button type="button" class="button-eliminar-curso btn btn-danger" value="<?php echo $iCurso->getIdCurso();?>" data-toggle="modal" data-target="#ModalElminado"><i class="fas fa-trash-alt"></i></button>


                                                        </div>

                                                    </div>
                                                    <?php else : ?>
                                                        <div class="col-5 ">
                                                        <span class="text-danger fs-6"> <i class='fas fa-exclamation-circle pe-1'></i>Curso eliminado</span>

                                                        </div>

                                                    <?php endif?>
                                                </div>
                                            </div>
                                        </div>







                                    <?php endforeach ?>
                                <?php else : ?>
                                    <div class="d-flex justify-content-center align-items-center" style="height:500px">
                                        <h1>Aún no cuentas con cursos</h1>
                                    </div>


                                <?php endif ?>
                                <!-- TODO Hacer la tabla de estudiantes cuando das click en curso  -->
                            </div>

                            <div class="row">
                                <div class="col-12 d-flex justify-content-center"></div>
                                <input type="hidden" value="<?php echo sizeof($listaMisCursosCreados); ?>" id="NumeroCursoPaginacion">
                                <button id="CargarMasCursos" class="btn btn-success btn-lg">
                                    Ver mas
                                </button>
                            </div>
                        </div>

                    </div>
                </div>
        </div>
    </div>

    </main>

    </div>

    <footer class="text-center text-white" style="background-color: #0d0d0e;">
        <!-- Grid container -->
        <div class="container p-4 pb-0">
            <!-- Section: CTA -->
            <section class="">
                <p class="d-flex justify-content-center align-items-center">
                    <span class="me-3">Volver arriba</span>
                    <a class="btn btn-outline-light btn-rounded" href="#">
                        <i class="fas fa-arrow-up"></i>
                    </a>
                </p>
            </section>
            <!-- Section: CTA -->
        </div>
        <!-- Grid container -->

        <!-- Copyright -->
        <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2);">
            © 2020 Copyright:
            <a class="text-white" href="https://mdbootstrap.com/">MDBootstrap.com</a>
        </div>
        <!-- Copyright -->
    </footer>



    <!-- MODAL PARA CONFIRMAR ELIMINADO -->



    <?php
    function Scripts()
    {
        include Constants::PROJECT_PATH_INCLUDE . "Vista/Pages/Cursos/Scripts/sells.Scripts.php";
    }
    ?>

</body>

</html>