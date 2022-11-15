<?php

//Redireccionar a algun otro lugar 
//header("Location: https://www.google.com");
//die();
// $template = new TemplateController();
ob_start();
$usuarioActivo = UsuariosController::getUsuarioActivo();

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <link rel="stylesheet" href="<?php echo Constants::VIEWS_PATH?>css/widthme.css">
    
  <link rel="stylesheet" href="<?php echo Constants::VIEWS_PATH?>css/navbar.css">
  <title>Pagina Principal</title>

</head>

<body>

  <header>
    <nav class="navbar navbar-light d-flex navbar-style" style="min-height: 65px; justify-content:space-between;">

      <div class="order-1 col-12 px-0 px-lg-2 col-lg-3 w-lg-75">
        <button class="px-1 navbar-toggler navbar-toggler-icon d-lg-none button-navbar-desplegar" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasExample" aria-controls="offcanvasExample">
        </button>
        <a class="navbar-brand text-white" href="<?php echo Template::Route(InicioController::ROUTE, null); ?>">
          
          <img src="<?php echo Constants::VIEWS_PATH?>images/courselogo.png" alt="" class="navbar-imagen ms-lg-2">

          <!-- class = "position-absolute mx-2 "  -->
          E-Learning
        </a>
      </div>
      <div class="order-3 col-12 px-2 mt-1 order-lg-2 col-lg-5 w-xlg-50 w-lg-50 mt-lg-0  col-xl-4 ">
      
        <form class="d-flex justify-content-center " action="<?php echo Template::Route(CursosController::ROUTE, CursosController::BUSQUEDA_AVANZADA_CURSOS); ?>" method="POST" autocomplete="off">
          <div class="navbar-search-bar col-12 ">
          
            <input id="navbar-search-bar " class="navbar-search-bar-input" name="titulo-curso" type="search" placeholder="Buscar producto" aria-label="Buscar">
            <button class="button-navbar-search p-0 mx-2" type="submit"><i class="fas fa-search"></i></button>
          </div>

        </form>

      </div>
      <a href="<?php echo Template::Route(CursosController::ROUTE, CursosController::BUSQUEDA_AVANZADA_CURSOS); ?>"  class="order-3 btn btn-form-color order-lg-2 d-lg-inline d-none "><i class="fas fa-search-plus"></i></a>

      <?php if ($usuarioActivo == null) : ?>


        <div class="order-2 col-7 d-none d-lg-inline me-3 order-lg-3 col-lg-3" style="width: auto;">

          <div style="display: inline;">
            <a href="<?php echo Template::Route(UsuariosController::ROUTE, UsuariosController::LOGEAR_USUARIO); ?>" class="link-navbar">
              <h1 class="label-navbar-sesion d-none d-xl-inline">Inicia Sesión</h1>
              <i class="fas fa-sign-in-alt button-navbar-icons mx-1"></i>
            </a>
          </div>

        </div>
    </nav>
    <div class="offcanvas offcanvas-start sub-navbar" style="z-index: 10000001 !important;" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
      <div class="offcanvas-header">
        <h5 class="offcanvas-title sub-navbar-title" id="offcanvasExampleLabel">E-Learning</h5>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
      </div>
      <div class="offcanvas-body">
        <div class="row px-0">
          <div class="col-12 py-2 linea-top linea-bottom">
            <a class="nav-link categories-text" href="<?php echo Template::Route(UsuariosController::ROUTE, UsuariosController::LOGEAR_USUARIO); ?>">
              Iniciar sesión
            </a>

          </div>
          <div class="col-12 py-2 linea-bottom">
            <a class="nav-link categories-text" href="<?php echo Template::Route(UsuariosController::ROUTE, UsuariosController::CREAR_USUARIO); ?>">
              Registrarse
            </a>
          </div>


        </div>

      </div>

      <div class="row gx-0 p-3">
        <h4 class="text-white">Derechos reservados <i class="fas fa-copyright"></i></h4>
      </div>

    </div>
  <?php else : ?>

    <?php if (General::isTipoRol(Rol::Escuela)) : ?>
      <div class="order-2 d-none d-lg-inline">
        <a href="<?php echo Template::Route(CursosController::ROUTE, CursosController::CREAR_CURSO); ?>" class="btn btn-form-color">Agregar curso</a>
      </div>
      <div class="order-2 col-7 d-none d-lg-inline me-3 order-lg-3 col-lg-3" style="width: auto;">

        <a href="<?php echo Template::Route(UsuariosController::ROUTE, UsuariosController::MOSTRAR_USUARIO); ?>" class="link-navbar">
          <h1 class="label-navbar-sesion d-none d-xl-inline">Bienvenido <?php echo $usuarioActivo->getNombreUsuario() ?></h1>
          <i class="fas fa-university button-navbar-icons mx-1"></i>

        </a>

        <a href="<?php echo Template::Route(CursosController::ROUTE, CursosController::MOSTRAR_MIS_CURSO); ?>" class="link-navbar">
          <i class="fas fa-chart-line button-navbar-icons mx-1"></i>
        </a>

        <a href="<?php echo Template::Route(MensajesController::ROUTE, MensajesController::MOSTRAR_MENSAJES); ?>" class="link-navbar">
          <i class="fas fa-comment button-navbar-icons mx-1"></i>
        </a>

        <div style="display: inline">
          <a href="<?php echo Template::Route(UsuariosController::ROUTE, UsuariosController::CERRAR_SESION); ?>" class="link-navbar">
            <i class="fas fa-door-open  button-navbar-icons mx-1"></i>
          </a>
        </div>

      </div>
    <?php elseif (General::isTipoRol(Rol::Estudiante)) : ?>
      <div class="order-2 col-7 d-none d-lg-inline me-3 order-lg-3 col-lg-3" style="width: auto;">

        <a href="<?php echo Template::Route(UsuariosController::ROUTE, UsuariosController::MOSTRAR_USUARIO); ?>" class="link-navbar">
          <h1 class="label-navbar-sesion d-none d-xl-inline">Bienvenido <?php echo $usuarioActivo->getNombreUsuario() ?></h1>
          <i class="fas fa-user-graduate button-navbar-icons mx-1"></i>
        </a>


        <a href="<?php echo Template::Route(ComprasController::ROUTE, ComprasController::MOSTRAR_MIS_CURSOS_COMPRDOS); ?>" class="link-navbar">
          <i class="fas fa-book  button-navbar-icons mx-1"></i>
        </a>

        <a href="<?php echo Template::Route(MensajesController::ROUTE, MensajesController::MOSTRAR_MENSAJES); ?>" class="link-navbar">
          <i class="fas fa-comment button-navbar-icons mx-1"></i>
        </a>

        <div style="display: inline">
          <a href="<?php echo Template::Route(UsuariosController::ROUTE, UsuariosController::CERRAR_SESION); ?>" class="link-navbar">
            <i class="fas fa-door-open  button-navbar-icons mx-1"></i>
          </a>
        </div>

      </div>
    <?php endif ?>

    </nav>
    <div class="offcanvas offcanvas-start sub-navbar" style="z-index: 10000001 !important;" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
      <div class="offcanvas-header">
        <h5 class="offcanvas-title sub-navbar-title" id="offcanvasExampleLabel">E-Learning</h5>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
      </div>
      <div class="offcanvas-body">
        <div class="row px-0">
          <div class="col-12 py-2 linea-top linea-bottom">
            <a class="nav-link categories-text" href="<?php echo Template::Route(UsuariosController::ROUTE, UsuariosController::MOSTRAR_USUARIO); ?>">
              Mi cuenta
            </a>

          </div>
          <?php
          if (General::isTipoRol(Rol::Escuela)) : ?>
            <div class="col-12 py-2 linea-bottom">
              <a class="nav-link categories-text" href="<?php echo Template::Route(CursosController::ROUTE, CursosController::CREAR_CURSO); ?>">
                Agregar curso
              </a>
            </div>
            <div class="col-12 py-2 linea-bottom">
              <a class="nav-link categories-text" href="<?php echo Template::Route(CursosController::ROUTE, CursosController::MOSTRAR_MIS_CURSO); ?>">
                Estadisticas
              </a>
            </div>
          <?php elseif (General::isTipoRol(Rol::Estudiante)) : ?>
            <div class="col-12 py-2 linea-bottom">
              <a class="nav-link categories-text" href="<?php echo Template::Route(ComprasController::ROUTE, ComprasController::MOSTRAR_MIS_CURSOS_COMPRDOS); ?>">
                Mis cursos
              </a>
            </div>
          <?php endif ?>
          <div class="col-12 py-2 linea-bottom">
            <a class="nav-link categories-text" href="<?php echo Template::Route(UsuariosController::ROUTE, UsuariosController::CERRAR_SESION); ?>">
              Cerrar sesión
            </a>
          </div>


        </div>

      </div>

      <div class="row gx-0 p-3">
        <h4 class="text-white">Derechos reservados <i class="fas fa-copyright"></i></h4>
      </div>

    </div>
  <?php endif ?>




  </header>

  <?php
  $this->DeterminePage();
  ?>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <!-- <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script> -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
  </script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
  </script>
  
  <?php
  $this->CallScripts();
  ?>


</body>

</html>