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


    <main>

      <div class="row mb-5 ">
        <div class="col-12 landing-image">
          <!-- <img src="<?php echo Constants::VIEWS_PATH?>images/categoryBackground.jpg" class="w-100  "  style="height:700px" alt=""> -->
        </div>
      </div>
      <div class="container bg-light p-5 ">

        <div class="row mb-3">
          <div class="col-12">
            <h1>Tus cursos</h1>

          </div>
        </div>
        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
          <li class="nav-item me-2" role="presentation">
            <button class="btn btn-active-color" id="courseInfo" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true">Cursos</button>
          </li>
          <li class="nav-item" role="presentation">
            <button class="btn btn-inactive-color " id="courseLevels" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">Historial de cursos</button>
          </li>

        </ul>
        <div class="tab-content" id="pills-tabContent">
          <div class="tab-pane fade show active " id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">

            <?php if ($listaMisCursosComprados != null) : ?>
              
              <h3>Haz comprado <strong><?php echo $cantidadDeCursosActivos; ?></strong> cursos. ¡Sigue asi!</h3>
            <?php else : ?>
              <h3>No haz comprado ningún curso, regresar a la página de inicio</h3>
            <?php endif; ?>

            <div class="row">
              <?php foreach ($listaMisCursosComprados as $iCursoSeguirViendo) : ?>
                <div class="card m-2 pt-3 shadow-lg container-curso" style="width: 18rem;">
                  <img src="data:image/jpeg; base64, <?php echo $iCursoSeguirViendo->getImagenCurso(); ?>" class="card-img-top img-thumbnail custom-img-card" alt="...">
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
              <?php endforeach; ?>

            </div>

            <div class="row">
              <div class="col-12 justify-content-center d-flex">
                <button id="id-button-ver-mas" class="btn btn-success btn-lg mt-4" value="<?php echo count($listaMisCursosComprados); ?>"> Ver más</button>
              </div>
            </div>

          </div>
          <div class="tab-pane fade " id="pills-profile" style="max-height:600px; min-height: 400px; overflow-y: scroll;" role="tabpanel" aria-labelledby="pills-profile-tab">
               
          <?php if(sizeof($listaTodosMisCursosComprados)!=0): ?>

  
            <table class="table table-striped table-hove table-bordered">
              <thead>
                <tr>
                  <th scope="col">Nombre</th>
                  <th scope="col">Progreso</th>
                  <th scope="col">Fecha de compra</th>
                  <th scope="col">Última visualizacion</th>
                  <th scope="col">Completado</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($listaTodosMisCursosComprados as $iCursoDetalles) : ?>
                  <tr>
                    <th scope="row">
                      <?php echo $iCursoDetalles->getTituloCurso(); ?> 
                    <?php if($iCursoDetalles->getEstadoCurso() == 0): ?>
                      <a class="popover-dismiss ms-1" tabindex="0" data-bs-toggle="popover" data-bs-trigger="hover " data-bs-content="Este curso fue dado de baja"> <i class="fas fa-exclamation-circle text-danger"></i> </span></a>

                     
                    <?php endif?>
                  </th>
                    <td><?php echo $iCursoDetalles->getCompraCurso()->getProgresoCursoComprado(); ?>%</td>
                    <td><?php echo $iCursoDetalles->getCompraCurso()->getFechaCreacionConFormatoCompra(); ?></td>

                    <td>
                      <?php
                      if ($iCursoDetalles->getCompraCurso()->getFechaUltimaVisualizacion() != null)
                        echo $iCursoDetalles->getCompraCurso()->getFechaUltimaVisualizacionConFormatoCompra();
                      else
                        echo "------";
                      ?>
                    </td>

                    <td class="d-flex">
                      <?php
                      if ($iCursoDetalles->getCompraCurso()->getFechaCompletado() != null)
                        echo $iCursoDetalles->getCompraCurso()->getFechaCompletadoConFormatoCompra();
                      else
                        echo "------";
                      ?>
                      <?php if ($iCursoDetalles->getCompraCurso()->getProgresoCursoComprado() == 100) : ?>
                        <form  onclick="this.form.target='_blank';return true;" class="ms-2" action="<?php echo Template::Route(ComprasController::ROUTE, ComprasController::IMPRIMIR_DIPLOMA); ?>" method="POST">
                          <input type="hidden" name="CursoComprado" value="<?php echo $iCursoDetalles->getCompraCurso()->getCursoComprado(); ?>">
                          <button type="submit" class="btn btn-primary btn-sm">
                          <i class="fas fa-file-pdf"> </i> Crear diploma
                          </button>
                        </form>
                      <?php endif; ?>
                    </td>
                  </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
            <?php else: ?>
              <div class="d-flex justify-content-center align-items-center" style="height:300px">

  
             <h1>No haz comprado cursos aún</h1>   
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
    include Constants::PROJECT_PATH_INCLUDE . "Vista/Pages/Cursos/Scripts/history.Scripts.php";
  }
  ?>


</body>

</html>