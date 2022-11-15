<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700&display=swap" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">

  <link rel="stylesheet" href="<?php echo Constants::VIEWS_PATH?>css/widthme.css">
  <link rel="stylesheet" href="<?php echo Constants::VIEWS_PATH?>plugins/css/aksfileupload/aksFileUpload.css">
  <link href="https://vjs.zencdn.net/7.14.3/video-js.css" rel="stylesheet" />
  <link rel="stylesheet" href="<?php echo Constants::VIEWS_PATH?>plugins/css/tokenize/tokenize2.min.css">
  <!-- <link rel="stylesheet" href="<?php echo Constants::VIEWS_PATH?>plugins/css/Summernote/summernote.css"> -->
  <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
  <link rel="stylesheet" href="<?php echo Constants::VIEWS_PATH?>css/main.css">
</head>

<body>
  <div class="container-fluid p-0">

    <main class="container-fluid bg-light ">

      <div class="row d-flex">
        <div class="col-12 col-lg-9  p-0">
          <h3 class="bg-dark text-white p-3 text-wrap">Nivel: <?php echo $nivelElegido->getTituloNivel(); ?></h3 class="bg-dark">

          <video class="video-js" data-setup='{"fluid": true}' controls preload="auto" width="100%" height="650px" data-setup="{}" controls muted id-nivel="<?php echo $nivelElegido->getIdNivel(); ?>" id-curso="<?php echo $nivelElegido->getCursoImpartido(); ?>" progess="<?php echo $nivelElegido->getProgresoNivel(); ?>">
            <source muted="true" src="<?php echo $nivelElegido->getPathVideoNivel(); ?>" type="video/mp4">

            Tu navegador no puede mostrar este video
          </video>
        </div>

        <div class="col-12 col-lg-3  " style="height:650px; overflow-y: scroll;">

          <?php foreach ($listaNivelesDelCurso as $i => $iNivelCurso) : ?>

            <div class="row bg-white p-3 border border-1 ">

              <div class="col-8 ">
                <h5 class="mb-0" style="font-size: 1rem;">Nivel <span><?php echo $i + 1; ?></span>: <?php echo $iNivelCurso->getTituloNivel(); ?></h5>
                <!-- TODO: COMO CONSEGUIR EL TAMAÑO DEL VIDEO SEGUN SU PATH -->
                <p style="font-size: 0.9rem;"><?php echo $iNivelCurso->getCantMinutosVideo(); ?> Min</p>
              </div>

              <?php if ($validacionesGenerales->getUsuarioPuedeVerNiveles() || ($iNivelCurso->getNivelGratis() == 1 && $validacionesGenerales->isUsuarioEscuela() == false)) :  ?>
                <div class="col-4 d-flex align-items-center justify-content-center">
                  <a href="<?php echo Template::Route(CursosController::ROUTE, CursosController::NIVELES_DEL_CURSO . "/" . $iNivelCurso->getCursoImpartido() . "/" . $iNivelCurso->getIdNivel()); ?>" class="btn btn-dark" style="font-size: 1.1rem;">Ver video</a>
                </div>
              <?php elseif ($validacionesGenerales->getUsuarioPuedeComprarCurso()) : ?>
                <div class="col-4 d-flex align-items-center justify-content-center">
                  <form action="<?php echo Template::Route(ComprasController::ROUTE, ComprasController::MOSTRAR_COMPRA); ?>" method="POST">
                    <input type="hidden" name="curso" value="<?php echo $cursoElegido->getIdCurso();  ?>">
                    <input type="hidden" name="costo" value="<?php echo $cursoElegido->getCostoCurso(); ?>">
                    <button class="btn btn-primary">Comprar curso</button>
                  </form>

                  <!-- <a href="<?php
                                // echo Template::Route(CursosController::ROUTE, CursosController::NIVELES_DEL_CURSO . "/" . $iNivelCurso->getCursoImpartido() . "/" . $iNivelCurso->getIdNivel()); 
                                ?>" class="btn btn-dark" style="font-size: 1.1rem;">Video bloqueado hasta comprar curso</a> -->
                </div>
              <?php endif ?>

            </div>

          <?php endforeach ?>


        </div>

        <div class="row">

          <div class="col-12 col-lg-9">
            <div class="p-4">


              <div class="row">
                <div class="col-12 order-last order-lg-first col-lg-6">
                  <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                    <li class="nav-item" role="presentation">
                      <button class="btn btn-active-color me-2" id="courseInfo" data-bs-toggle="pill" data-bs-target="#pills-preview" type="button" role="tab" aria-controls="pills-home" aria-selected="true">Vista previa</button>
                    </li>
                    <li class="nav-item" role="presentation">
                      <button class="btn btn-inactive-color " id="courseDocument" data-bs-toggle="pill" data-bs-target="#pills-material" type="button" role="tab" aria-controls="pills-contact" aria-selected="false">Documento de apoyo</button>
                    </li>

                  </ul>
                </div>

                <div class="col-12 col-lg-6 d-flex justify-content-end">
                  <h5 class="text-right"><?php echo $cursoElegido->getNombreCompletoUsuarioCreador(); ?>
                    <a href="<?php echo Template::Route(MensajesController::ROUTE, MensajesController::MOSTRAR_MENSAJES . "/" . $cursoElegido->getUsuarioCreador()); ?>" class="">
                      <i class="fas fa-envelope "></i>
                    </a>
                  </h5>
                </div>
              </div>

              <hr>
              <div class="tab-content" id="pills-tabContent">

                <div class="tab-pane fade show active" id="pills-preview" role="tabpanel" aria-labelledby="pills-preview-tab">
                  <?php if ($nivelElegido->getContenidoNivel() != "") : ?>
                    <?php echo html_entity_decode($nivelElegido->getContenidoNivel(), ENT_COMPAT, 'UTF-8'); ?>
                  <?php else : ?>

                  <?php endif; ?>
                </div>

                <div class="tab-pane fade" id="pills-material" role="tabpanel" aria-labelledby="pills-material-tab">

                  <?php if ($nivelElegido->getPathPDFNivel() != "") : ?>

                    <div class="row">

                      <div class="col-12 d-flex flex-column justify-content-center align-items-center">
                        <a target="_blank" class="btn btn-form-color my-4" href="<?php echo $nivelElegido->getPathPDFNivel(); ?>">Abrir en el navegador</a>
                        <iframe src="<?php echo $nivelElegido->getPathPDFNivel(); ?>" width="100%" height="800px">


                        </iframe>
                      </div>

                    </div>
                  <?php else : ?>

                  <?php endif; ?>



                </div>
              </div>

            </div>

          </div>

        </div>




        <!--  -->
    </main>
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



  </div>


  <?php
  function Scripts()
  {
    include Constants::PROJECT_PATH_INCLUDE . "Vista/Pages/Cursos/Scripts/viewCourse.Scripts.php";
  }
  ?>


</body>

</html>