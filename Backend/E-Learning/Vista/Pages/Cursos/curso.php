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
  <link rel="stylesheet" href="<?php echo Constants::VIEWS_PATH?>plugins/css/tokenize/tokenize2.min.css">
  <!-- <link rel="stylesheet" href="<?php echo Constants::VIEWS_PATH?>plugins/css/Summernote/summernote.css"> -->
  <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
  <link rel="stylesheet" href="<?php echo Constants::VIEWS_PATH?>css/main.css">
</head>

<body>
  <div id="courseID" data-courseid="<?php echo $cursoElegido->getIdCurso() ?>"></div>
  <div class="container-fluid p-0">

    <!-- <div class="position-absolute bottom-0 flex-d mx-auto  ">
    <a class="btn btn-secondary" href="">Iniciar sesion</a>
    <a class="btn btn-secondary">Registrarse</a>
        </div> -->

    <main class="container bg-light">
      <div class="row">

        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Se ha agregado tu curso a tu biblioteca</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <h1 class="display-1 text-success text-center"><i class="fas fa-check-circle"></i></h1>
                <h1 class="text-center">Curso conseguido exitosamente</h1>
              </div>
              <div class="modal-footer">

              </div>
            </div>
          </div>
        </div>

        <div class="col-12 col-lg-8 order-last order-lg-first  p-0 br-0">

          <?php
          if ($comentarioUsuarioCurso != null) : ?>

            <div class="modal fade" id="modal-eliminar-Curso" style="padding-right: 0px !important; padding-left: 0px !important;" tabindex="-1" aria-labelledby="modal-eliminar-Curso" aria-hidden="true">
              <div class="modal-dialog">
                <form id="form-eliminar-curso" action="sells.html" method="POST">
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      <h5 class="modal-title" id="texto-modal">¿Estás seguro de dar de baja el comentario "<?php echo $comentarioUsuarioCurso->getDescripcionComentario() ?>"?</h5>
                    </div>
                    <div class="modal-footer">
                      <button type="button" id="eliminarComentario" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                      <button type="button" class="btn btn-danger" id="button-modal-delete" value="<?php echo $comentarioUsuarioCurso->getIdComentario(); ?>">Eliminar</button>
                    </div>
                  </div>

                </form>
              </div>
            </div>
          <?php endif; ?>
          <!-- ZONA DE INFORMACION DEL CURSO -->
          <div class="row mb-2 gx-0">
            <div class="col-12">
              <img class="img-fluid img-thumbnail " style="height:500px; width:900px;" src="data:image/jpeg; base64, <?php echo $cursoElegido->getImagenCurso(); ?>" alt="...">
            </div>
          </div>
          <div class="row mb-4 gx-0">
            <div class="col-12 pt-2">

              <div class="container px-3">
                <h4>Categorias</h4>
                <div class="mb-3">

                  <?php foreach ($listaCategoriasDelCurso as $iCategoriaCurso) : ?>

                    <a class="popover-dismiss" href="<?php echo Template::Route(CursosController::ROUTE, CursosController::BUSQUEDA_AVANZADA_CURSOS . "/id-categoria--" . $iCategoriaCurso->getIdCategoria()); ?>" tabindex="0" data-bs-toggle="popover" data-bs-trigger="hover " data-bs-content="<?php echo $iCategoriaCurso->getDescripcionCategoria()  ?>"><span class="badge rounded-pill category-pill-color  m-2"><?php echo $iCategoriaCurso->getTituloCategoria() ?></span></a>

                  <?php endforeach ?>
                </div>

                <div>

                  <?php if ($cursoElegido->getPorcentajeCalificacionRedondeado() >= 0) : ?>
                    <div id="container-label-likes">
                      <h4 id="label-likes" class="fw-normal">
                        Al <span class="fw-bolder"><?php echo $cursoElegido->getPorcentajeCalificacionRedondeado(); ?>%</span> de las personas le gustó este curso
                      </h4>
                    </div>
                    <div class="progress ">

                      <div id="barra-likes" class="progress-bar bg-success" role="progressbar" style="width: <?php echo $cursoElegido->getPorcentajeCalificacionRedondeado(); ?>%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                      <div id="barra-dislikes" class="progress-bar bg-danger" role="progressbar" style="width: <?php echo 100 - $cursoElegido->getPorcentajeCalificacionRedondeado(); ?>%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>

                    </div>
                  <?php else : ?>
                    <div id="container-label-likes">
                      <h4 id="label-likes" class="fw-normal">Este curso aun no tiene ningún voto</h4>
                    </div>
                    <div class="progress ">
                      <div id="barra-likes" class="progress-bar bg-success" role="progressbar" style="width: 0%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                      <div id="barra-dislikes" class="progress-bar bg-danger" role="progressbar" style="width: 0%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                  <?php endif ?>



                </div>




                <hr>
              </div>



              <div class="row gx-0">

                <div class="container">
                  <ul class="nav nav-pills mb-3 p-3" id="pills-tab" role="tablist">
                    <li class="nav-item" role="presentation">
                      <button id="courseLevels" class="btn btn-active-color mb-2">Niveles</button>
                    </li>
                    <li class="nav-item" role="presentation">
                      <button id="courseReviews" class="btn btn-inactive-color ms-2">Reseñas</button>
                    </li>

                  </ul>
                </div>

                <div class="tab-content" id="pills-tabContent">


                  <div class="container">

                    <div class="tab-pane show active" id="pills-levels">

                      <div class="row  gx-0">

                        <?php
                        foreach ($listaNivelesDelCurso as $i => $iNivelCurso) :
                        ?>
                          <div class="col-12 bg-white mb-3">
                            <div class="row gx-0 p-4">

                              <?php if ($validacionesGenerales->getUsuarioPuedeVerNiveles() || ($iNivelCurso->getNivelGratis() == 1 && $validacionesGenerales->isUsuarioEscuela() == false)) : ?>
                                <div class="col-9 d-flex align-items-center">
                                  <h4 class="m-0 d-flex">Nivel #<?php echo $i + 1 . " - " . $iNivelCurso->getTituloNivel(); ?></h4>
                                  <?php if ($iNivelCurso->getNivelGratis() == 1) : ?>
                                    <span class="badge rounded-pill bg-success ms-1 ">Gratis</span>
                                  <?php endif ?>

                                </div>
                                <div class="col-3 d-flex align-items-center justify-content-end">
                                  <a href="<?php
                                            echo Template::Route(CursosController::ROUTE, CursosController::NIVELES_DEL_CURSO . "/" . $iNivelCurso->getCursoImpartido() . "/" . $iNivelCurso->getIdNivel());
                                            ?>" class="btn  btn-form-color">Ver nivel</a>
                                </div>
                              <?php else : ?>
                                <div class="col-9 d-flex align-items-center">
                                  <h4 class="m-0 d-flex">Nivel #<?php echo $i + 1 . " - " . $iNivelCurso->getTituloNivel(); ?></h4>
                                </div>
                              <?php endif; ?>


                            </div>

                          </div>
                        <?php
                        endforeach
                        ?>

                      </div>

                    </div>



                    <div class="tab-pane" id="pills-reviews">
                      <!-- AQUI VA LO DE LA PILL DE REVIEWS -->
                      <div id="contenedor-general-comentarios">

                        <?php if ($validacionesGenerales->getUsuarioPuedeInteractuarCurso()) : ?>
                          <div class="row gx-0">

                            <div class="col-12 mb-3">

                              <div class="row  gx-0 my-2" id="container-calificacion">

                                <div class="col-8">
                                  <h3 class="">Deja tu reseña del curso</h3>
                                </div>
                                <div class="col-4 d-flex" id="container-calificaciones">
                                  <h3 class="me-2">¿Te gustó el curso?</h3>

                                  <input type="radio" class="btn-check" name="option" class="required" value="like" id="option1">

                                  <label id="like-button" class="btn btn-light me-2 <?php if ($votoCalificacion == 1) echo "liked" ?>" for="option1"><i class="fas fa-thumbs-up"></i></label>

                                  <input type="radio" class="btn-check" name="option" value="dislike" id="option2">
                                  <label id="dislike-button" class="btn btn-light <?php if ($votoCalificacion == 0) echo "disliked" ?>" for="option2"><i class="fas fa-thumbs-down"></i></label>

                                  <!-- <input type="hidden" id="id-curso" name="id-curso" value="<?php
                                                                                                  // echo $cursoElegido->getIdCurso(); 
                                                                                                  ?>"> -->

                                </div>
                              </div>
                              <?php if ($validacionesGenerales->getUsuarioPuedeComentarCurso()) : ?>
                                <div id="container-escribir-comentario">

                                  <div class="form-floating mb-2">
                                    <!-- <input type="hidden" name="id-curso" value="<?php
                                                                                      // echo $cursoElegido->getIdCurso(); 
                                                                                      ?>"> -->

                                    <textarea name="comment" class="form-control" placeholder="Leave a comment here" id="descripcion-comentario"></textarea>
                                    <label for="floatingTextarea">Reseña</label>
                                  </div>
                                  <div id="error-container" class="d-flex flex-column">
                                  </div>

                                  <div class="row gx-0">
                                    <div class="col-12 d-flex justify-content-center">
                                      <button id="button-enviar-comentario" class="btn btn-form-color btn-lg fs-5">Enviar</button>
                                    </div>
                                  </div>
                                </div>
                              <?php endif; ?>
                            </div>

                          </div>

                        <?php endif; ?>


                        <div id="seccion-comentarios">

                          <?php if ($comentarioUsuarioCurso != null) : ?>
                            <div class="row  gx-0 bg-white mb-3 container-comentario" id="container-comentario-<?php echo $comentarioUsuarioCurso->getIdComentario(); ?>">

                              <div class="col-12  p-3 ">
                                <div class="row gx-0">
                                  <div class="col-12 col-lg-10">
                                    <img src="data:image/jpeg; base64, <?php echo $comentarioUsuarioCurso->getImagenPerfilUsuarioComento() ?>" style="border-radius:100%; height:50px; width:50px" alt="">
                                    <span class="ms-2 text-break fw-bold"><?php echo $comentarioUsuarioCurso->getNombreCompletoUsuarioComento(); ?></span>
                                  </div>

                                  <div class="col-12 col-lg-2">
                                    <span class="fw-light"><?php echo $comentarioUsuarioCurso->getFechaCreacionConFormatoComentario(); ?></span>
                                    <?php if ($validacionesGenerales->getUsuarioPuedeInteractuarCurso()) : ?>
                                      <div id="id-button-edit-delete">
                                        <button class="button-editar-comentario btn btn-success d-inline" value="<?php echo $comentarioUsuarioCurso->getIdComentario(); ?>"><i class="fas fa-edit"></i></button>
                                        <button class="button-borrar-comentario btn btn-danger d-inline" value="<?php echo $comentarioUsuarioCurso->getIdComentario(); ?>" data-bs-toggle="modal" data-bs-target="#modal-eliminar-Curso"><i class="fas fa-trash-alt"></i></button>
                                      </div>
                                    <?php endif; ?>
                                  </div>
                                </div>
                              </div>

                              <div class="col-12" id="container-texto-comentario-<?php echo $comentarioUsuarioCurso->getIdComentario(); ?>">
                                <p class="fw-light text-break text-wrap" id="texto-comentario-<?php echo $comentarioUsuarioCurso->getIdComentario(); ?>">
                                  <?php echo $comentarioUsuarioCurso->getDescripcionComentario(); ?>
                                </p>
                              </div>
                            </div>
                          <?php endif ?>


                          <?php
                          if ($listaComentariosCurso != null) : ?>

                            <?php foreach ($listaComentariosCurso as $indexCurso => $iComentarioCurso) : ?>
                              <div class="row bg-white mb-3 container-comentario" id="container-comentario-<?php echo $iComentarioCurso->getIdComentario(); ?>">

                                <div class="col-12  p-3 ">

                                  <div class="row ">
                                    <div class="col-12 col-lg-10">
                                      <img src="data:image/jpeg; base64, <?php echo $iComentarioCurso->getImagenPerfilUsuarioComento() ?>" style="border-radius:100%; height:50px; width:50px" alt="">
                                      <span class="ms-2 text-break fw-bold"><?php echo $iComentarioCurso->getNombreCompletoUsuarioComento(); ?></span>
                                    </div>

                                    <div class="col-12 col-lg-2">
                                      <span class="fw-light"><?php echo $iComentarioCurso->getFechaCreacionConFormatoComentario(); ?></span>
                                    </div>

                                  </div>
                                </div>

                                <div class="col-12" id="container-texto-comentario-<?php echo $iComentarioCurso->getIdComentario(); ?>">

                                  <p class="fw-light text-break text-wrap" id="texto-comentario-<?php echo $iComentarioCurso->getIdComentario(); ?>">
                                    <?php echo $iComentarioCurso->getDescripcionComentario(); ?>
                                  </p>
                                </div>

                              </div>
                            <?php endforeach; ?>




                            <!-- TODO: PARA QUE SE USA ESTE INPUT HIDDEN? -->
                            <!-- <input type="hidden" id="id-curso" name="id-curso" value="<?php
                                                                                            // echo $cursoElegido->getIdCurso(); 
                                                                                            ?>"> -->

                            <div class="row gx-0">
                              <div class="col-12 d-flex justify-content-center">
                                <button class="btn btn-success" id="id-count-messages" value="<?php echo count($listaComentariosCurso); ?>">Cargar más</button>

                                <!-- TODO: PARECE QUE CON courseid YA NO SE OCUPA ESTE INPUT -->
                                <!-- <input type="hidden" id="id-curso" name="id-curso" value="<?php
                                                                                                // echo $cursoElegido->getIdCurso(); 
                                                                                                ?>"> -->
                              </div>
                            </div>
                          <?php endif; ?>


                        </div>

                      </div>
                    </div>


                  </div>

                </div>
              </div>


            </div>

          </div>


        </div>
        <div class="col-12 col-lg-4  mt-5 mb-5">
          <div class="row mb-1 ">
            <div class="col-12 ">

              <h3><?php echo $cursoElegido->getTituloCurso(); ?></h3>

            </div>
            <div class="row mb-3">
              <span>
                Hecho por:
                <a class="btn btn-form-color btn-sm ms-1 fs-6" href="<?php echo Template::Route(MensajesController::ROUTE, MensajesController::MOSTRAR_MENSAJES . "/" . $cursoElegido->getUsuarioCreador()); ?>">
                  <i class="far fa-envelope "></i> <?php echo $cursoElegido->getNombreCompletoUsuarioCreador(); ?>
                </a>
              </span>

            </div>
            <div style="overflow:hidden" class="row">
              <h4>Descripción</h4>
              <p><?php echo $cursoElegido->getDescripcionCurso(); ?></p>
            </div>

            <div class="row">
              <?php if ($cursoElegido->getCostoCurso() == 0) : ?>
                <div class="col-8 d-flex align-items-center ">
                  <span class="badge rounded-pill bg-success ms-1 mt-1 mb-2">Gratis</span>
                </div>
                <?php if ($validacionesGenerales->getUsuarioPuedeComprarCurso() == true) : ?>
                  <div class="col-4 d-flex justify-content-center ">
                    <!-- <form action="<?php
                                        // echo Template::Route(ComprasController::ROUTE, ComprasController::MOSTRAR_COMPRA); 
                                        ?>" method="POST"> -->
                    <!-- <input type="hidden" name="curso" value="<?php
                                                                  // echo $cursoElegido->getIdCurso();  
                                                                  ?>"> -->
                    <!-- <input type="hidden" name="costo" value="<?php
                                                                  // echo $cursoElegido->getCostoCurso(); 
                                                                  ?>"> -->


                    <div></div>
                    <button id="conseguir-curso" type="submit" class="btn btn-form-color">Conseguir curso</button>
                    <!-- </form> -->

                  </div>
                <?php endif; ?>
              <?php else : ?>
                <div class="col-8 d-flex align-items-center ">
                  <h5 class="text-success"> <i class="fas fa-money-bill"></i> MX$<?php echo $cursoElegido->getCostoCursoConFormato(); ?></h5>
                </div>
                <?php if ($validacionesGenerales->getUsuarioPuedeComprarCurso() == true) : ?>
                  <div class="col-4 d-flex justify-content-center ">
                    <form action="<?php echo Template::Route(ComprasController::ROUTE, ComprasController::MOSTRAR_COMPRA); ?>" method="POST">
                      <input type="hidden" name="curso" value="<?php echo $cursoElegido->getIdCurso();  ?>">
                      <input type="hidden" name="costo" value="<?php echo $cursoElegido->getCostoCurso(); ?>">
                      <button type="submit" class="btn btn-form-color">Comprar</button>
                    </form>

                  </div>
                <?php endif; ?>
              <?php endif ?>
            </div>


          </div>
        </div>
      </div>
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

  </div>



  <?php
  function Scripts()
  {
    include Constants::PROJECT_PATH_INCLUDE . "Vista/Pages/Cursos/Scripts/curso.Scripts.php";
  }
  ?>


</body>

</html>