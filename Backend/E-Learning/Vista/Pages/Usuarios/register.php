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
  <div class="container-fluid  p-0">

    <div class="row gx-0 d-flex mb-5 ">
      <div class="col-10 offset-1 d-flex flex-column align-items-center  bg-white   ">

        <div class="row gx-0 mt-3 mt-lg-5 w-xlg-50 w-lg-75 w-xl-75 w-md-75">
          <div class="col-12 ">
            <form id="register_form" class="bg-white  pt-4 pb-4 mb-3 mt-1 px-3 px-md-5 rounded-3 shadow-lg" action="<?php echo Template::Route(UsuariosController::ROUTE, UsuariosController::CREAR_USUARIO); ?>" method="POST" enctype="multipart/form-data">
              <div class="row">
                <div class="col-12 p-0">
                  <h2 class="text-center mb-4 p-0">Registro</h2>
                </div>

              </div>

              <div class="row d-flex align-items-center  justify-content-center">

                <h5 class="text-center">Escoge tu rol</h5>
                <div class="d-flex justify-content-center mb-1">
                 <div>

  
                  <?php foreach ($rolesUsuario as $iPos => $iRol) : ?>

                    <label class="form-check-label me-4" for="<?php echo $iRol->getTipoRol(); ?>_check"><?php echo $iRol->getTipoRol(); ?></label>
                    <input class="form-check-input " type="checkbox" value="<?php echo $iRol->getIdRol(); ?>" name="rolUsuario[]" id="<?php echo $iRol->getTipoRol(); ?>_check">

                  <?php endforeach ?>
                  </div>
                </div>

                <span class=" text-danger text-center mb-3" id="error_check"></span>


                <!-- <div id="emailHelp" class="form-text mb-4 text-danger d-flex justify-content-center align-items-center"><i class="fas fa-exclamation-circle"></i> Escoja alguna opción</div> -->




              </div>
              <div class="row">

                <div class="col-12 col-md-6">
                  <div class="mb-3 ">
                    <label for="InputName" class="form-label  has-error-form"> <i class="fas fa-user"></i> Nombre</label>

                    <input type="text" id="InputName" class="form-control px-3" name="name">
                    <div id="name" name="nombre" class="form-text text-danger"></div>
                    <!-- TODO: ESTE DIV "name" QUÉ HACE? -->
                  </div>
                  <div class="mb-3">
                    <label for="InputLastName" class="form-label"> <i class="fas fa-user-friends"></i> Apellido Paterno</label>

                    <input type="text" id="InputLastName" class="form-control px-3" name="firstlastname">
                    <div id="name" name="apellidoP" class="form-text text-danger"></div>
                    <!-- TODO: ESTE DIV "apellidoP" QUÉ HACE? -->
                  </div>


                  <div class="mb-3">
                    <label for="InputSecondName" class="form-label"> <i class="fas fa-user-friends"></i> Apellido Materno</label>

                    <input type="text" id="InputSecondName" class="form-control px-3" name="secondlastname">
                    <div id="name" name="apellidoM" class="form-text text-danger"></div>
                    <!-- TODO: ESTE DIV "apellidoM" QUÉ HACE? -->
                  </div>
                  <div class="mb-3">
                    <label for="InputSecondName" class="form-label"> <i class="fas fa-venus-mars"></i> Género</label>

                    <select class="form-select form-select" aria-label="form-select-sm example" id="gender" name="gender">
                      <option value="0" selected>Selecciona tu género</option>
                      <option value="Hombre">Hombre</option>
                      <option value="Mujer">Mujer</option>
                      <option value="Otro">Otro</option>
                    </select>
                  </div>

                </div>
                <div class="col-12 col-md-6">
                  <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label"> <i class="fas fa-envelope"></i> E-Mail</label>

                    <input type="text" class="form-control px-3" id="exampleInputEmail1" aria-describedby="emailHelp" name="email">
                    <div id="emailHelp" class="form-text text-danger"></div>
                  </div>
                  <div class="mb-3">
                    <!-- border-danger text-danger -->
                    <label for="contrasena" class="form-label "> <i class="fas fa-key"></i> Contraseña </label>

                    <input type="password" class="form-control " id="contrasena" name="password">
                    <!-- <div id="emailHelp" class="form-text text-danger"><i class="fas fa-exclamation-circle"></i>Debe tener entre 4 y 5 caracteres</div> -->

                  </div>
                  <div class="mb-3">
                    <!-- <label for="confirmarContrasena" class="form-label text-danger"> <i class="fas fa-key"></i> Confirmar contraseña    </label> -->
                    <label for="confirmarContrasena" class="form-label "> <i class="fas fa-key"></i> Confirmar contraseña </label>

                    <input type="password" class="form-control" id="confirmarContrasena" name="confirmarContrasena">

                  </div>
                  <div class=" mb-3">
                    <label for="date" class="form-label"><i class="fas fa-calendar-alt"></i> Fecha de nacimiento</label>
                    <input type="date" class="form-control" id="date" name="birthday">

                  </div>
                </div>
              </div>

              <div class="container d-flex justify-content-center">
                <button type="submit" class="btn btn-dark px-5  ">Ingresar</button>

              </div>



            </form>
          </div>
        </div>

        <hr class="text-primary" style="width:30%;border:0.5px solid black">

        <div class="row ">

          <div class="col-12 p-2">
            <h1 class="text-center p-4 fs-4 .bg-dark.bg-gradient "> O registrate con</h1>
          </div>
        </div>
        <div class="row w-100  mb-2 ">
          <div class="col-lg-2 mx-auto mb-2 mb-lg-0  ">
            <form action="">

              <button class="btn btn-primary facebook-button shadow-lg d-flex align-items-center justify-content-center w-100"><i class=" fab fa-facebook-square"></i> <span class="p-2">Facebook</span></button>

            </form>
          </div>

<!-- 
            <div class="col-lg-2  ">
            <form action="">

              <button class="btn btn-danger google-button shadow-lg d-flex align-items-center justify-content-center w-100 "><i class="fab fa-google"></i> <span class="p-2">Google</span></button>

            </form>
          </div> 
-->
        </div>

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
  function Scripts()
  {
    include Constants::PROJECT_PATH_INCLUDE . "Vista/Pages/Usuarios/Scripts/register.Scripts.php";
  }
  ?>
</body>

</html>