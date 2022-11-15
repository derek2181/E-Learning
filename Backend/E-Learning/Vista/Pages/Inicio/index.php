<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
  <link rel="stylesheet" href="<?php echo Constants::VIEWS_PATH ?>plugins/css/OwlCarousel/owl.carousel.min.css">
  <link rel="stylesheet" href="<?php echo Constants::VIEWS_PATH ?>plugins/css/OwlCarousel/owl.theme.default.min.css">
  <link rel="stylesheet" href="<?php echo Constants::VIEWS_PATH ?>css/widthme.css">
  <link rel="stylesheet" href="<?php echo Constants::VIEWS_PATH ?>css/navbar.css">
  <link rel="stylesheet" href="<?php echo Constants::VIEWS_PATH ?>css/main.css">
</head>

<body>


  <div class="container-fluid p-0">

    <!-- <div class="position-absolute bottom-0 flex-d mx-auto  ">
    <a class="btn btn-secondary" href="">Iniciar sesion</a>
    <a class="btn btn-secondary">Registrarse</a>
        </div> -->

    <div class="container-fluid my-jumbotron-background">
      <div class="jumbotron container-fluid w-100 w-md-75 w-lg-75 w-xl-75 pb-5  ">
        <h1 class="display-4 pt-5 text-center">Bienvenido a E-Learning!</h1>
        <p class="lead text-center">El lugar donde aprenderás sin necesidad de salir de casa</p>
        <hr class="my-4">
        <?php if (General::isSetUsuarioActivo() == false) : ?>
          <p class="text-center">Empieza a tomar cursos en este momento!</p>
          <p class="lead d-flex  justify-content-center">
            <a class="btn  button-continue-watching btn-lg d-flex w-sm-50 justify-content-center" href="<?php echo Template::Route(UsuariosController::ROUTE, UsuariosController::CREAR_USUARIO); ?>">Registrarse</a>
          </p>
        <?php endif; ?>
      </div>
    </div>

    <div class="container-fluid p-0">

      <div class="row gx-0">

        <div class="col-12 col-lg-9 px-2 ps-lg-5">
          <div class="row gx-0 ">


            <?php if ($listaCursosSeguirViendo != null) : ?>
              <h2 class="pt-5">Seguir viendo</h2>
              <?php if (sizeof($listaCursosSeguirViendo) != 0) :  ?>
                <div class="col-12">

                  <div class="row gx-0 pt-3 d-flex justify-content-left">

                    <?php
                    foreach ($listaCursosSeguirViendo as $iCursoSeguirViendo) :
                    ?>
                      <div class="card m-2 pt-3 shadow-lg " style="width: 18rem;">
                        <img class="card-img-top img-thumbnail custom-img-card" alt="..." src="data:image/jpeg; base64, <?php echo $iCursoSeguirViendo->getImagenCurso(); ?>">
                        <div class="card-body">
                          <h5 class="card-title "><?php echo $iCursoSeguirViendo->getTituloCurso(); ?></h5>
                          <h5 href="#" class="tutor-name mb-3 text-cut"><i class="fas fa-graduation-cap"></i><?php echo $iCursoSeguirViendo->getNombreCompletoUsuarioCreador(); ?><i class="fas fa-graduation-cap"></i></h5>
                          <div class="progress mt-3">
                            <div class="progress-bar btn-form-color  " role="progressbar" style="width: <?php echo $iCursoSeguirViendo->getCompraCurso()->getProgresoCursoComprado(); ?>%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>

                          </div>
                          <h5 class="progress-bar-text mb-4">Tu progreso: <span><?php echo $iCursoSeguirViendo->getCompraCurso()->getProgresoCursoComprado(); ?>%</span></h5>
                          <a href="<?php echo Template::Route(CursosController::ROUTE, CursosController::MOSTRAR_CURSO . "/" . $iCursoSeguirViendo->getIdCurso()); ?>" class="btn btn-dark w-100 button-continue-watching">Continuar viendo</a>
                        </div>
                      </div>
                    <?php
                    endforeach;
                    ?>


                  </div>
                </div>
              <?php else : ?>

                <h1>Aún no haz comprado ningún curso</h1>

              <?php endif ?>

            <?php endif ?>

          </div>
          <div class="row gx-0 ">

            <div class="col-12">
              <h2 class="pt-5">
                Cursos Mejor Calificados
              </h2>
              <div class="row gx-0 pt-3 d-flex">
                <?php if (sizeof($listaCursosCalificados) != 0) :  ?>
                  <div class="owl-carousel owl-theme">

                    <?php
                    foreach ($listaCursosCalificados as $iCursoCalificado) :
                    ?>
                      <div class="item">
                        <div class="card shadow-lg  m-2 pt-3 p text-cut " style="width: 18rem;">
                          <img class="card-img-top img-thumbnail custom-img-card" alt="..." src="data:image/jpeg; base64, <?php echo $iCursoCalificado->getImagenCurso(); ?>">
                          <div class="card-body">
                            <h5 class="card-title text-cut"><?php echo $iCursoCalificado->getTituloCurso(); ?></h5>
                            <h5 href="#" class="tutor-name mb-3 text-cut"><i class="fas fa-graduation-cap"></i><?php echo $iCursoCalificado->getNombreCompletoUsuarioCreador(); ?><i class="fas fa-graduation-cap"></i></h5>


                            <?php if ($iCursoCalificado->getPorcentajeCalificacionRedondeado() >= 0) : ?>
                              <p class="text-break text-wrap">Al <?php echo $iCursoCalificado->getPorcentajeCalificacionRedondeado(); ?>% de las personas que compraron este curso les gustó <i class="fas fa-thumbs-up"></i></p>
                              <div class="progress">
                                <div class="progress-bar bg-success" role="progressbar" style="width: <?php echo $iCursoCalificado->getPorcentajeCalificacionRedondeado(); ?>%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                                <div class="progress-bar bg-danger" role="progressbar" style="width: <?php echo 100 - $iCursoCalificado->getPorcentajeCalificacionRedondeado(); ?>%" aria-valuenow="<?php echo $iCursoCalificado->getPorcentajeCalificacion(); ?>" aria-valuemin="0" aria-valuemax="100"></div>

                              </div>
                            <?php else : ?>
                              <p class="text-break text-wrap">Este curso aun no tiene ningún voto</p>
                              <div class="progress ">
                                <div class="progress-bar bg-success" role="progressbar" style="width: 0%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                              </div>
                            <?php endif ?>


                            <div class="row gx-0 mt-4 ">
                              <?php if ($iCursoCalificado->getCostoCurso() == 0) : ?>
                                <h5 class="text-cut"><strong class="text-success">MX$GRATIS</strong></h5>
                              <?php else : ?>
                                <h5 class="text-cut">MX$<?php echo $iCursoCalificado->getCostoCursoConFormato(); ?></h5>
                              <?php endif ?>


                            </div>
                            <div class="row gx-0">

                              <a href="<?php echo Template::Route(CursosController::ROUTE, CursosController::MOSTRAR_CURSO . "/" . $iCursoCalificado->getIdCurso()); ?>" class="btn btn-form-color p-2 strechted">Ver detalles</a>
                            </div>
                          </div>
                        </div>
                      </div>
                    <?php
                    endforeach;
                    ?>


                  </div>
                <?php else : ?>

                  <h1>Aún no hay cursos disponibles</h1>

                <?php endif ?>
              </div>
            </div>
          </div>
          <div class="row gx-0 ">

            <div class="col-12">
              <h2 class="pt-5">
                Cursos Mas Vendidos
              </h2>
              <div class="row gx-0 pt-3 d-flex">
                <?php if (sizeof($listaCursosVendidos) != 0) :  ?>
                  <div class="owl-carousel owl-theme">

                    <?php
                    foreach ($listaCursosVendidos as $iCursoVendido) :
                    ?>
                      <div class="item">
                        <div class="card shadow-lg  m-2 pt-3 p text-cut " style="width: 18rem;">
                          <img class="card-img-top img-thumbnail custom-img-card" alt="..." src="data:image/jpeg; base64, <?php echo $iCursoVendido->getImagenCurso(); ?>">
                          <div class="card-body">
                            <h5 class="card-title text-cut"><?php echo $iCursoVendido->getTituloCurso(); ?></h5>
                            <h5 href="#" class="tutor-name mb-3 text-cut"><i class="fas fa-graduation-cap"></i><?php echo $iCursoVendido->getNombreCompletoUsuarioCreador(); ?><i class="fas fa-graduation-cap"></i></h5>

                            <?php if ($iCursoVendido->getPorcentajeCalificacionRedondeado() >= 0) : ?>
                              <p class="text-break text-wrap">Al <?php echo $iCursoVendido->getPorcentajeCalificacionRedondeado(); ?>% de las personas que compraron este curso les gustó <i class="fas fa-thumbs-up"></i></p>
                              <div class="progress">
                                <div class="progress-bar bg-success" role="progressbar" style="width: <?php echo $iCursoVendido->getPorcentajeCalificacionRedondeado(); ?>%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                                <div class="progress-bar bg-danger" role="progressbar" style="width: <?php echo 100 - $iCursoVendido->getPorcentajeCalificacionRedondeado(); ?>%" aria-valuenow="<?php echo $iCursoCalificado->getPorcentajeCalificacion(); ?>" aria-valuemin="0" aria-valuemax="100"></div>

                              </div>
                            <?php else : ?>
                              <p class="text-break text-wrap">Este curso aun no tiene ningún voto</p>
                              <div class="progress ">
                                <div class="progress-bar bg-success" role="progressbar" style="width: 0%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                              </div>
                            <?php endif ?>

                            <div class="row gx-0 mt-4 ">

                              <?php if ($iCursoVendido->getCostoCurso() == 0) : ?>
                                <h5 class="text-cut"><strong class="text-success">MX$GRATIS</strong></h5>
                              <?php else : ?>
                                <h5 class="text-cut">MX$<?php echo $iCursoVendido->getCostoCursoConFormato(); ?></h5>
                              <?php endif ?>

                            </div>
                            <div class="row gx-0">
                              <a href="<?php echo Template::Route(CursosController::ROUTE, CursosController::MOSTRAR_CURSO . "/" . $iCursoVendido->getIdCurso()); ?>" class="btn btn-form-color p-2 strechted">Ver detalles</a>
                            </div>
                          </div>
                        </div>
                      </div>
                    <?php
                    endforeach;
                    ?>

                  </div>
                <?php else : ?>

                  <h1>Aún no hay cursos disponibles</h1>

                <?php endif ?>
              </div>

            </div>

          </div>

          <div class="row gx-0 ">

            <div class="col-12">
              <h2 class="pt-5">
                Cursos Recientes
              </h2>
              <div class="row gx-0 p-3 d-flex justify-content-evenly">
                <?php if (sizeof($listaCursosRecientes) != 0) :  ?>
                  <div class="owl-carousel owl-theme ">

                    <?php
                    foreach ($listaCursosRecientes as $iCursoReciente) :
                    ?>
                      <div class="item">
                        <div class="card shadow-lg  m-2 pt-3 p text-cut " style="width: 18rem;">
                          <img class="card-img-top img-thumbnail custom-img-card" alt="..." src="data:image/jpeg; base64, <?php echo $iCursoReciente->getImagenCurso(); ?>">
                          <div class="card-body">
                            <h5 class="card-title text-cut"><?php echo $iCursoReciente->getTituloCurso(); ?></h5>
                            <!-- TODO: PARA QUE SIRVE UN HREF EN EL H5? -->
                            <h5 href="#" class="tutor-name mb-3 text-cut"><i class="fas fa-graduation-cap"></i><?php echo $iCursoReciente->getNombreCompletoUsuarioCreador(); ?><i class="fas fa-graduation-cap"></i></h5>

                            <?php if ($iCursoReciente->getPorcentajeCalificacionRedondeado() >= 0) : ?>
                              <p class="text-break text-wrap">Al <?php echo $iCursoReciente->getPorcentajeCalificacionRedondeado(); ?>% de las personas que compraron este curso les gustó <i class="fas fa-thumbs-up"></i></p>
                              <div class="progress">
                                <div class="progress-bar bg-success" role="progressbar" style="width: <?php echo $iCursoReciente->getPorcentajeCalificacionRedondeado(); ?>%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                                <div class="progress-bar bg-danger" role="progressbar" style="width: <?php echo 100 - $iCursoReciente->getPorcentajeCalificacionRedondeado(); ?>%" aria-valuenow="<?php echo $iCursoCalificado->getPorcentajeCalificacion(); ?>" aria-valuemin="0" aria-valuemax="100"></div>

                              </div>
                            <?php else : ?>
                              <p class="text-break text-wrap">Este curso aun no tiene ningún voto</p>
                              <div class="progress ">
                                <div class="progress-bar bg-success" role="progressbar" style="width: 0%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                              </div>
                            <?php endif ?>

                            <div class="row gx-0 mt-4 ">

                              <?php if ($iCursoReciente->getCostoCurso() == 0) : ?>
                                <h5 class="text-cut"><strong class="text-success">MX$GRATIS</strong></h5>
                              <?php else : ?>
                                <h5 class="text-cut">MX$<?php echo $iCursoReciente->getCostoCursoConFormato(); ?></h5>
                              <?php endif ?>
                            </div>
                            <div class="row gx-0">
                              <a href="<?php echo Template::Route(CursosController::ROUTE, CursosController::MOSTRAR_CURSO . "/" . $iCursoReciente->getIdCurso()); ?>" class="btn btn-form-color p-2 strechted">Ver detalles</a>
                            </div>
                          </div>
                        </div>
                      </div>
                    <?php
                    endforeach;
                    ?>

                  </div>
                <?php else : ?>

                  <h1>Aún no hay cursos disponibles</h1>

                <?php endif ?>
              </div>
            </div>

          </div>

        </div>
        <div class="col-12 col-lg-3 order-last ">
          <div class="row gx-0 sticky-top bg-light text-dark m-4 " style="border-radius: 30px;">
            <div class="col-12 p-5 position-sticky   ">

              <div class="row gx-0 mb-3">
                <div class="col-12 d-flex justify-content-between">
                  <h3>
                    Categorias
                  </h3>
                  <h3><i class="fas fa-list"></i></h3>
                </div>

              </div>

              <div class="row gx-0">
                <div class="col-12 ">
                  <form class="d-flex">
                    <input id="categoryFilter" class="form-control me-2" type="search" placeholder="Buscar categoria" aria-label="Search">
                  </form>
                </div>
              </div>
              <div id="pillsContainer">

                <?php
                foreach ($listaCategorias as $iCategoria) :
                ?>
                  <a class="popover-dismiss" href="<?php echo Template::Route(CursosController::ROUTE, CursosController::BUSQUEDA_AVANZADA_CURSOS . "/id-categoria--" . $iCategoria->getIdCategoria()); ?>" tabindex="0" data-bs-toggle="popover" data-bs-trigger="hover " data-bs-content="<?php echo $iCategoria->getDescripcionCategoria()  ?>"><span class="badge rounded-pill category-pill-color  m-2"><?php echo $iCategoria->getTituloCategoria() ?></span></a>
                <?php
                endforeach;
                ?>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="mt-5">

        <section class="">
          <!-- Footer -->
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
            <!-- Copyright -->
            <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2);">
              © 2021 Copyright<br>
              Luis Angel Daniel Sánchez<br>
              Derek Jafet Cortes Madriz<br>

            </div>
            <!-- Copyright -->
          </footer>
          <!-- Footer -->
        </section>
      </div>
    </div>




    <?php

    function Scripts()
    {
      include Constants::PROJECT_PATH_INCLUDE . "Vista/Pages/Inicio/Scripts/index.Scripts.php";
    }
    ?>

</body>

</html>