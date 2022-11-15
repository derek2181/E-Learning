<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700&display=swap" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
  <link rel="stylesheet" href="<?php echo Constants::VIEWS_PATH?>css/widthme.css">
  <link rel="stylesheet" href="<?php echo Constants::VIEWS_PATH?>css/main.css">
  <style>

  </style>
</head>
<body>
  <div class="container-fluid p-0">

    <div class="row gx-0 d-flex mb-5 ">
      <div class="col-10 offset-1 d-flex flex-column align-items-center  bg-white   ">

        <div class="row gx-0 w-xlg-50 w-lg-75 w-xl-75 w-md-75">
          <div class="col-12 mt-5">
            <form id="login_form" action="<?php echo Template::Route(UsuariosController::ROUTE, UsuariosController::LOGEAR_USUARIO); ?>" method="POST" data-parsley-validate="" class="bg-white  pt-4 pb-4 mb-3 mt-1 px-5 rounded-3 shadow-lg">
              <div class="row">
                <div class="col-12 p-0">
                  <h2 class="text-center mb-4 p-0">Ingreso a cuenta</h2>
                </div>

              </div>


              <div class="mb-3">
                <label for="select" class="form-label text-dark fw-bold">Tipo de usuario:</label>
                <select class="form-select" aria-label="Tipo de usuario" id="select" name="rolUsuario">
                  <?php foreach ($rolesUsuario as $iPos => $iRol) : ?>
                    <option value="<?php echo $iRol->getIdRol(); ?>"><?php echo $iRol->getTipoRol(); ?></option>
                  <?php endforeach ?>
                </select>
              </div>

              <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label"> <i class="fas fa-envelope"></i> E-Mail</label>

                <input type="email" class="form-control px-3" id="exampleInputEmail1" aria-describedby="emailHelp" name="email" value="<?php echo General::getCookieCorreo();?>">
                <div id="emailHelp" class="form-text "></div>
              </div>
              <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label"> <i class="fas fa-key"></i> Contraseña </label>

                <input type="password" class="form-control" id="exampleInputPassword1" name="password">


              </div>


              <?php 
                if (General::getUsuarioIncorrectoEnLogin() === true):
              ?>
                  <div class ="my-3 text-danger">
                    <i class='fas fa-exclamation-circle'></i> Su usuario y/o contraseña están incorrectos o no existen con el rol seleccionado
                  </div>
                  
              <?php 
                  General::setUsuarioIncorrectoEnLogin(null);
                endif; 
              ?>

              <!-- <div class="mb-3 form-check"> -->
                <!-- <input type="checkbox" class="form-check-input" id="exampleCheck1"> -->
                <!-- <label class="form-check-label" for="exampleCheck1">Recordarme</label> -->
              <!-- </div> -->
              <div class="container d-flex justify-content-center">
                <button type="submit" class="btn btn-form-color px-5  ">Ingresar</button>

              </div>


            </form>
          </div>
        </div>

        <hr class="text-primary" style="width:30%;border:0.5px solid black">

        <div class="row">

          <div class="col-12 p-2">
            <h1 class="text-center p-4 fs-4 .bg-dark.bg-gradient "> O ingresa con</h1>
          </div>
        </div>

        <div class="col-lg-2 mb-2 mb-lg-0  ">
      
              <a href="<?php echo htmlspecialchars($loginUrl) ?>" class="btn btn-primary facebook-button shadow-lg d-flex align-items-center justify-content-center w-100"><i class=" fab fa-facebook-square"></i> <span class="p-2">Facebook</span></a>
       
<!-- 
          <div class="col-lg-2  ">
            <form action="">

              <button class="btn btn-danger google-button shadow-lg d-flex align-items-center justify-content-center w-100 "><i class="fab fa-google"></i> <span class="p-2">Google</span></button>

            </form>
          </div> 
-->
        </div>

        <h5 class="mt-4 text-center ">¿No tienes una cuenta? <a href="<?php echo Template::Route(UsuariosController::ROUTE, UsuariosController::CREAR_USUARIO); ?>" class="text-decoration-none">Registrate</a></h5>

      </div>


    </div>

    <footer class="text-center text-white  justify-content-center " style="background-color: #0d0d0e;">
      <!-- Grid container -->

      <!-- Grid container -->

      <!-- Copyright -->
      <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2);">
        © 2021 Copyright<br>
              Luis Angel Daniel Sánchez<br>
              Derek Jafet Cortes Madriz<br>
        
      </div>
      <!-- Copyright -->
    </footer>
    <!-- Footer -->
  </div>

  <!-- Footer -->
  <?php 
  function Scripts(){
      include Constants::PROJECT_PATH_INCLUDE . "Vista/Pages/Usuarios/Scripts/login.Scripts.php";
  }
  ?>
</body>
</html>