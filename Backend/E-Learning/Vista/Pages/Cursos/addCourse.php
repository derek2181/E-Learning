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
  <div class="container-fluid p-0">

    <!-- <div class="position-absolute bottom-0 flex-d mx-auto  ">
    <a class="btn btn-secondary" href="">Iniciar sesion</a>
    <a class="btn btn-secondary">Registrarse</a>
        </div> -->

    <div class="container my-5 " style="background:rgba(230, 230, 230, 0.109)">
      <!-- <h1 class="text-center pt-2 mb-4" >Añadir curso</h1> -->

      <div class="row d-flex align-items-start">
        <div class="col-12 col-lg-3  p-3 d-flex justify-content-center  mt-2 sticky-top">
          <div class="btn-group-vertical w-100">
            <button id="courseInfo" class="btn btn-active-color  w-100 mb-2">Datos generales</button>
            <button id="courseLevels" class="btn btn-inactive-color">Niveles</button>
          </div>
        </div>
        <div class="col-12 col-lg-9">


          <div class="row">

            <div class="col-12">
              <div class="container">
                <form id="crear-Curso-Niveles"  
                <?php 
                echo Template::Route(CursosController::ROUTE, CursosController::CREAR_CURSO);?>
                method="POST" enctype="multipart/form-data">
                  <div id="courseInfoContainer" class="row ">
                    <h1 class="text-center">Añadir curso</h1>
                    <hr>
                    <div class="input-group mb-3">
                      <input type="text" placeholder="Titulo del curso" class="form-control w-100 mb-2" id="inputEmail4" name="title">
                    </div>



                    <!-- <div class="input-group mb-3">
                      <div class="input-group-text">$MX</div>
                      <input type="text" class="form-control" placeholder="Costo del curso completo" id="InputCostoCurso">
                    </div> -->

                    <div class="input-group mb-4">

                      <textarea class="form-control w-100 mb-2" placeholder="Descripción del curso" id="floatingTextarea" name ="description"></textarea>


                    </div>
                    <div class="input-group mb-3">
                      <div class="input-group-text">$MX</div>
                      <input type="text" class="InputCostoCurso form-control" placeholder="Costo del curso"
                        id="InputCostoCurso" name="course-price">
                    </div>
                    <!-- <div class="input-group  mb-4 "> -->
                    <div>


                      <label class="mb-2 fs-5 fw-5" for="category_select">Categoria</label>
                      <select placeholder="a" class="form-select mb-2" name="category-select[]" id="category_select" multiple>

                        <?php
                        foreach ($listaCategorias as $iCategoria) :
                        ?>
                          <option value="<?php echo $iCategoria->getIdCategoria(); ?>"><?php echo $iCategoria->getTituloCategoria(); ?></option>
                        <?php
                        endforeach;
                        ?>
                        <!-- 
                        <option value="1">1</option>
                        <option value="32">2</option>
                        <option value="3">3</option>
                        <option value="">4</option> -->
                      </select>
                      <h5 class="fs-6">O agrega una categoria nueva</h5>
                      <button type="button" class="btn btn-form-color" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        Agregar categoria
                      </button>
                    </div>



                    <!-- </div> -->
                    <div class="d-flex justify-content-center flex-column mb-4">
                      <h4 class="text-center mb-4 mt-4">Portada del curso</h4>
                      <!-- <aks-file-upload></aks-file-upload> -->
                      <label id="selected-image" for="image-course" class="w-100 bg-primary text-white text-center btn-form-color  p-5  fs-4" style="border:1px dashed white; cursor: pointer;">Haz click para insertar una imagen <img class="img-fluid" id="imagetag"></label>

                      <input type="file" class="d-none"  id="image-course" name="file-curso-imagen">
          
                      <!-- <p id="file" type="json">Nombre del archivo</p> -->
                    </div>
                    <hr>


                  </div>
                  <div id="levelsCointainer" style="background:rgba(231, 231, 231, 0.322);" class="row">




                    <div id="level-father" class="pt-3">
                      <h2 class="text-center">Añadir nivel</h2>



                      <div id="level1" class="my-5 py-2">

                        <div class="container">
                          <h4 class="my-3">Nivel #<span class="levelNumber">1</span></h4>
                          <div class="input-group mb-3">
                            <input type="text" placeholder="Titulo del nivel" class="form-control w-100"  name="level-title[]">
                          </div>

                          <input type="checkbox" class="btn-check checkbox-isfree" id='btncheck1' autocomplete="off" name="level-free[]">
                          <label class="btn btn-outline-success free-checkbox" for="btncheck1">Marcar como nivel gratis</label>


                          <!-- <input type="checkbox" class="btn-check checkbox-isfree" id="btncheck1" autocomplete="off" name="level-free">
                          <label class="btn btn-outline-success" for="btncheck1">Marcar como nivel gratis</label> -->
                        </div>





                        <div class="container" id ="contenedor-summernote">
                          <h4 class="my-3">
                            Vista previa del nivel
                          </h4>
                          <textarea class="mb-2 summernote" name="level-content[]"></textarea>                         
                          

                        </div>

                        <div class="container my-3">
                          <h4 class="my-4">
                            Video del nivel
                          </h4>

                          <!-- <video-level-1></video-level-1> -->
                          <input type="file" class="form-control" name="file-nivel-video[]">
                        </div>

                        <div class="container my-3">
                          <h4 class="my-4">
                            PDF del nivel
                          </h4>

                          <input id="pdf-file" type="file" class="form-control" name="file-nivel-pdf[]">
                        </div>

                        <hr>
                      </div>
                    </div>

                    <div class="container d-flex justify-content-center mb-3">
                      <button type="button" id="addLevelButton" class="btn btn-success rounded"><i class="fas fa-plus-circle me-2"></i>Añadir nivel</button>

                    </div>


                  </div>
                  <div class="row mb-4">
                    <button id="submit-form" type="submit" class="btn btn-form-color" form="crear-Curso-Niveles">Agregar curso</button>
                  </div>
                </form>
              </div>

            </div>

          </div>

        </div>
      </div>
    </div>

    <!-- MODAL -->


    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">

        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Agregar categoria</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
            <div class="modal-body">
              <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Nombre de categoria</label>
                <input type="text" class="form-control mb-2" id="agregarNombreCategoria" aria-describedby="agregarNombreCategoria" name="category-title">
                <label class="text-danger" id="error-name-container"></label>
              </div>
              <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Descripción</label>
                <textarea class="form-control mb-2" cols="15" rows="10" id="agregarDescCategoria" aria-describedby="agregarDescCategoria" name="category-description"></textarea>
                <label class="text-danger" id="error-description-container"></label>
                          
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
              <button type="submit" id="createCategory" class="btn btn-primary" form="form-crear-categoria">Guardar categoria</button>
            </div>
        </div>
      </div>
    </div>
    <!-- MODAL -->
<!-- Modal -->
              <div class="modal fade" id="ModalCourseFree" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle"><i class="fas fa-exclamation-triangle text-warning"></i> ¡Oops!</h5>
                        <button type="button" class="close close-free-modal" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>Hemos notado que todos tus niveles son gratis, el valor de tu curso será de MX$0.00 y para ver los niveles tendras que adquirir el curso gratis</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary close-free-modal"  data-dismiss="modal">Continuar</button>
                
                    </div>
                    </div>
                </div>
                </div>

                <div class="modal fade" id="ModalCostoCero" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle"><i class="fas fa-exclamation-triangle text-warning"></i> ¡Oops!</h5>
                        <button type="button" class="close close-free-modal" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>Si estableces $0.00 en el precio de tu curso los niveles ya no podran serestablecidos como gratis</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary close-costo-curso"  data-dismiss="modal">Continuar</button>
                
                    </div>
                    </div>
                </div>
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

  </div>


  <?php
  function Scripts()
  {

    include Constants::PROJECT_PATH_INCLUDE . "Vista/Pages/Cursos/Scripts/addCourse.Scripts.php";
  }
  ?>

</body>

</html>