<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
  <link rel="stylesheet" href="<?php echo Constants::VIEWS_PATH?>plugins/css/tokenize/tokenize2.min.css">
  <link rel="stylesheet" href="<?php echo Constants::VIEWS_PATH?>plugins/css/jqueryUI/jquery-ui.css">
  <link rel="stylesheet" href="<?php echo Constants::VIEWS_PATH?>css/main.css">
  <title>Edit</title>
</head>

<body>
  <div class="container-fluid p-0">
    <main>

      <div class="row mb-5 ">
        <div class="col-12 landing-image">
          <!-- <img src="<?php echo Constants::VIEWS_PATH?>images/categoryBackground.jpg" class="w-100  "  style="height:700px" alt=""> -->
        </div>
      </div>
      <div class="container-fluid bg-light p-5 ">
        <div class="row">
          <div class="col-12 col-lg-3">
            <div class="row sticky-top bg-white text-dark m-4 " style="border-radius: 30px; z-index: 0;">
              <div class="col-12 p-5 position-sticky   ">

                <div class="row mb-3">
                  <div class="col-12 d-flex justify-content-between">
                    <h3>
                      Búsqueda avanzada
                    </h3>

                  </div>

                </div>

                <div class="row ">
                  <div class="col-12 ">
                    <form class="" action="<?php echo Template::Route(CursosController::ROUTE, CursosController::BUSQUEDA_AVANZADA_CURSOS); ?>" method="POST">
                      <div class="row mb-3">
                        <div class="col-12 d-flex">
                          <input class="form-control" name="titulo-curso" type="search" placeholder="Buscar categoria" value="<?php echo $argumentosCursos->getTituloCurso(); ?>" aria-label="Search">

                        </div>

                      </div>
                      <div class="row">
                        <div class="col-12">
                          <label class="mb-2 fs-5 fw-5" for="category_select">Categoria</label>
                          <select placeholder="" class="form-select mb-2" name="id-categoria" id="category_search" multiple>

                            <?php
                            foreach ($listaCategorias as $iCategoria) :
                            ?>
                              <option value="<?php echo $iCategoria->getIdCategoria(); ?>" <?php if ($argumentosCursos->getCategoriaFiltro() == $iCategoria->getIdCategoria()) {
                                                                                              echo "selected";
                                                                                            }
                                                                                            ?>><?php echo $iCategoria->getTituloCategoria(); ?></option>
                            <?php
                            endforeach;
                            ?>
                          </select>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-12 mb-2">
                          <label class="mb-2 fs-5 fw-5" for="user_search">Nombre Completo Usuario</label>

                          <input name="nombre-usuario" type="text" class="form-control" value="<?php echo $argumentosCursos->getNombreCompletoUsuario(); ?>">
                      
                          <!-- 
                          <select placeholder="asdads" class="form-select mb-2" name="correo-usuario" id="user_search" multiple>

                            <option value="1">1</option>
                            <option value="32">2</option>
                            <option value="3">3</option>
                            <option value="">4</option>
                          </select>
                           -->
                        </div>
                      </div>

                      <div class="row mb-3">
                        <h3>Fecha</h3>
                        <div class="col-12">
                          <label class="mb-2 fs-5 fw-5 me-2" for="fecha_inicio">Desde</label>
                          <input name="fecha-desde" type="date" class="form-control" value="<?php echo $argumentosCursos->getFechaDesdeCreacionCurso(); ?>">
                          <!-- <input name="fechaInicio" type="text" class="form-control" id="fecha_inicio"> -->
                        </div>

                      </div>

                      <div class="row mb-3">

                        <div class="col-12">
                          <label class="mb-2 fs-5 fw-5 me-2" for="fecha_fin">Hasta</label>
                          <input name="fecha-hasta" type="date" class="form-control" value="<?php echo $argumentosCursos->getFechaHastaCreacionCurso(); ?>">
                          <!-- <input name="fechaFin" type="text" class="form-control" id="fecha_fin"> -->
                        </div>

                      </div>
                      <div class="row">
                        <div class="col-12">
                          <button class="btn btn-form-color text-white w-100" type="submit">Buscar</button>
                        </div>

                      </div>


                    </form>
                  </div>
                </div>



              </div>
            </div>
          </div>

          <div class="col-12 col-lg-9">
            <!-- <div class="row mb-3">
              <div class="col-12">
                <h1>
                  <?php
                  // echo $categoriaElegida->getTituloCategoria(); 
                  ?>
                </h1>

              </div>
              <p class="text-break">
                <?php
                // echo $categoriaElegida->getDescripcionCategoria(); 
                ?>
              </p>
            </div> 


            <div class="row">
              <h3>Cursos de 
                <span>
                <?php
                //  echo $categoriaElegida->getTituloCategoria(); 
                ?>
                </span>
              </h3>
            </div> -->


            <div class="row ">

              <div class="col-12">

                <div class="row pt-3 d-flex justify-content-left">
                   <?php if(sizeof($listaCursosBusquedaAvanzada)!=0 ) :?>
                   
                  <?php foreach ($listaCursosBusquedaAvanzada as $iCursoBA) : ?>
                    <div class="card shadow-lg  m-2 pt-3 p text-cut container-curso" style="width: 18rem;">
                      <img src="data:image/jpeg; base64, <?php echo $iCursoBA->getImagenCurso(); ?>" class="card-img-top img-thumbnail custom-img-card" alt="...">
                      <div class="card-body">
                        <h5 class="card-title text-cut"><?php
                                                        echo $iCursoBA->getTituloCurso(); ?></h5>
                        <h5 href="#" class="tutor-name mb-3 text-cut">
                          <i class="fas fa-graduation-cap"></i>
                          <?php
                          echo $iCursoBA->getNombreCompletoUsuarioCreador(); ?>
                          <i class="fas fa-graduation-cap"></i>
                        </h5>

                        <?php
                        if ($iCursoBA->getPorcentajeCalificacionRedondeado() >= 0) : ?>
                          <p class="text-break text-wrap">Al <?php echo $iCursoBA->getPorcentajeCalificacionRedondeado(); ?>% de las personas les gustó <i class="fas fa-thumbs-up"></i></p>
                          <div class="progress mt-3">
                            <div class="progress-bar bg-success" role="progressbar" style="width: <?php echo $iCursoBA->getPorcentajeCalificacionRedondeado(); ?>%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                            <div class="progress-bar bg-danger" role="progressbar" style="width: <?php echo 100 - $iCursoBA->getPorcentajeCalificacionRedondeado(); ?>%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                          </div>
                        <?php
                        else : ?>
                          <p class="text-break text-wrap">Este curso aun no tiene ningún voto</p>
                          <div class="progress mt-3">
                            <div class="progress-bar" role="progressbar" style="width: 0%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                          </div>
                        <?php
                        endif; ?>

                        <div class="row mt-4 ">
                          <?php if ($iCursoBA->getCostoCurso() == 0) : ?>
                            <span class="badge rounded-pill bg-success ms-1 mt-1 mb-2">Gratis</span>
                          <?php else : ?>
                            <h5 class="text-cut">MX$<?php echo $iCursoBA->getCostoCursoConFormato(); ?></h5>
                          <?php endif ?>

                        </div>
                        <div class="row">
                          <a href="<?php echo Template::Route(CursosController::ROUTE, CursosController::MOSTRAR_CURSO . "/" . $iCursoBA->getIdCurso()); ?>" class="btn btn-form-color  p-2 ">Comprar ahora</a>
                        </div>
                      </div>
                    </div>

                  <?php endforeach; ?>
                  <?php  else :?>
                    
                    <div class="d-flex justify-content-center align-items-center" style="height:500px">
                    <h1><i class="fas fa-frown"></i> No hemos podido encontrar un curso que coincida con tu busqueda</h1>

                    </div>

                  <?php endif?>
                </div>


              </div>

            </div>
            <?php if(sizeof($listaCursosBusquedaAvanzada)!=0 ) :?>
            <div class="row mt-3">
              <div class="col-12 d-flex justify-content-center">
                <button id="id-button-ver-mas" class="btn btn-success btn-lg" value="<?php echo count($listaCursosBusquedaAvanzada); ?>">Ver más</button>
                <input type="hidden" id="id-categoria" value="<?php echo $argumentosCursos->getCategoriaFiltro(); ?>">
                <input type="hidden" id="nombre-usuario" value="<?php echo $argumentosCursos->getNombreCompletoUsuario(); ?>">
                <input type="hidden" id="titulo-curso" value="<?php echo $argumentosCursos->getTituloCurso(); ?>">
                <input type="hidden" id="fecha-desde" value="<?php echo $argumentosCursos->getFechaDesdeCreacionCurso(); ?>">
                <input type="hidden" id="fecha-hasta" value="<?php echo $argumentosCursos->getFechaHastaCreacionCurso(); ?>">
              </div>
            </div>
            <?php endif?>
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
      © 2021 Copyright<br>
              Luis Angel Daniel Sánchez<br>
              Derek Jafet Cortes Madriz<br>
      
    </div>
    <!-- Copyright -->
  </footer>

  <?php
  function Scripts()
  {
    include Constants::PROJECT_PATH_INCLUDE . "Vista/Pages/Cursos/Scripts/busqueda.Scripts.php";
  }
  ?>



</body>

</html>