<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
  <link rel="stylesheet" href="<?php echo Constants::VIEWS_PATH?>css/edit.css">
  <link rel="stylesheet" href="<?php echo Constants::VIEWS_PATH?>css/main.css">
  <title>Edit</title>
</head>

<body>
  <div class="container-fluid p-0">
    <div class="container">
      <div id="success-dialog" class="alert alert-success alert-dismissible fade show text-center" role="alert">
        <strong class="text-center"> La información ha sido editada con éxito</strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
      <div id="error-dialog" class="alert alert-danger alert-dismissible fade show text-center" role="alert">
        <strong class="text-center">La contraseña que haz ingresado es incorrecta</strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
      <form id="edit_form" class="bg-white  pt-4 pb-4 mb-3 mt-1 px-5 rounded-3 shadow-lg"
      action="<?php echo Template::Route(UsuariosController::ROUTE, UsuariosController::EDITAR_USUARIO);?>" method="POST" enctype="multipart/form-data">
        <input type="hidden" value="
        <?php if ($perfilEditadoCorrectamente == true){
            echo "1";
        } 
        else{ 
          echo "0";
        } 
        ?>" id="form_success_message">

            <input type="hidden" value="
        <?php if ($contrasenaEditadaCorrectamente == true){ 
          echo "1";
        } else{
          echo "0";
        }
        ?>" id="pass_success_message">


        <div class="row">
          <div class="col-12 p-0">
            <h2 class="text-center mb-4 p-0">Editar perfil</h2>
          </div>

        </div>

        <div class="row mb-5">
          <div class="col-12">
            <div class="container d-flex justify-content-center ">
              <div class="position-relative">
                <!-- <img id="userImage" class="img-fluid img-thumbnail rounded-circle" style="height:200px; width:215px" src="<?php echo Constants::VIEWS_PATH?>images/avatar.png" alt=""> -->
                <!-- <img  id="userImage" class="img-fluid img-thumbnail rounded-circle" style="height:200px; width:215px"  -->
                <!-- src="<?php echo Constants::VIEWS_PATH?>images/avatar.png" alt=""> -->

                <img id="userImage" class="img-fluid img-thumbnail rounded-circle" style="height:200px; width:215px"  src = "data:image/jpeg; base64, <?php echo $usuarioActivo->getImagenPerfilUsuario();?>" >
                <?php if(General::getUsuarioLoggeadoFacebook() != true):?> 
                  <input type="file" id="fileImage" name="file-image-user" style="opacity:0;width:1%; position:absolute; ">


                  <label
                    class="btn-form-color d-flex justify-content-center align-items-center position-absolute top-100 start-50 translate-middle  rounded-circle p-2"
                    id="imageLabel" for="fileImage"
                    style="background:rgb(5, 5, 5); border:2px solid rgb(207, 207, 207); cursor:pointer; color:white">
                    <i class="fas fa-edit"></i>
                  </label>
                <?php endif;?>
              </div>

            </div>
          </div>
        </div>
        <div class="row">

          <div class="col-12 col-md-6">
            <div class="mb-3 ">
              <label for="InputName" class="form-label  has-error-form"> <i class="fas fa-user"></i> Nombre</label>

              <input type="text" id="InputName" class="form-control px-3" name="name" value="<?php echo $usuarioActivo->getNombreUsuario(); ?>" <?php if(General::getUsuarioLoggeadoFacebook() == true) echo "readonly"; ?>>
              <div id="name" name="nombre" class="form-text text-danger"></div>
              <!-- TODO: ESTE DIV "name" QUÉ HACE? -->
            </div>
            <div class="mb-3">
              <label for="InputLastName" class="form-label"> <i class="fas fa-user-friends"></i> Apellido Paterno</label>

              <input type="text" id="InputLastName" class="form-control px-3" name="firstlastname" value="<?php echo $usuarioActivo->getApellidoPaternoUsuario(); ?>" <?php if(General::getUsuarioLoggeadoFacebook() == true) echo "readonly"; ?>>
              <div id="name" name="apellidoP" class="form-text text-danger"></div>
              <!-- TODO: ESTE DIV "apellidoP" QUÉ HACE? -->
            </div>


            <div class="mb-3">
              <label for="InputSecondName" class="form-label"> <i class="fas fa-user-friends"></i> Apellido Materno</label>

              <input type="text" id="InputSecondName" class="form-control px-3" name="secondlastname" value="<?php echo $usuarioActivo->getApellidoMaternoUsuario(); ?>" <?php if(General::getUsuarioLoggeadoFacebook() == true) echo "readonly"; ?>>
              <div id="name" name="apellidoM" class="form-text text-danger"></div>
              <!-- TODO: ESTE DIV "apellidoM" QUÉ HACE? -->
            </div>
           

          </div>
          <div class="col-12 col-md-6">
            <div class="mb-3">
              <label for="exampleInputEmail1" class="form-label"> <i class="fas fa-envelope"></i> E-Mail</label>

              <input type="text" class="form-control px-3" id="exampleInputEmail1" aria-describedby="emailHelp" name="email" value="<?php echo $usuarioActivo->getCorreoUsuario(); ?>" readonly>
              <div id="emailHelp" class="form-text text-danger"></div>
            </div>

            <div class=" mb-3">
              <label for="date" class="form-label"><i class="fas fa-calendar-alt"></i> Fecha de nacimiento</label>
              <input type="date" class="form-control" id="date" name="birthday" value="<?php echo $usuarioActivo->getFechaNacimientoUsuario(); ?>" <?php if(General::getUsuarioLoggeadoFacebook() == true) echo "readonly"; ?>>

            </div>
            <div class="mb-3">
              <label for="InputSecondName" class="form-label"> <i class="fas fa-venus-mars"></i> Género</label>
              <?php if(General::getUsuarioLoggeadoFacebook() == true):?> 
                <input type="text" class="form-control" id="gender" value="<?php echo $usuarioActivo->getGeneroUsuario(); ?>" <?php if(General::getUsuarioLoggeadoFacebook() == true) echo "readonly"; ?>>
              <?php else: ?>
                <select class="form-select form-select" aria-label="form-select-sm example" id="gender" name="gender">
                  <option value="0" selected>Selecciona tu género</option>
                  <option value="Hombre" <?php if ($usuarioActivo->isGeneroUsuarioEqualTo("Hombre")) {
                                            echo "selected";
                                          } ?> >Hombre</option>
                  <option value="Mujer" <?php if ($usuarioActivo->isGeneroUsuarioEqualTo("Mujer")) {
                                          echo "selected";
                                        } ?> >Mujer</option>
                  <option value="Otro" <?php if ($usuarioActivo->isGeneroUsuarioEqualTo("Otro")) {
                                          echo "selected";
                                        } ?> >Otro</option>
                </select>
              <?php endif; ?>
            </div>
          </div>
        </div>

        <?php if(General::getUsuarioLoggeadoFacebook() != true):?> 
          <div class="container d-flex justify-content-center">
            <button type="submit" class="btn btn-form-color  px-5 mb-5 ">Confirmar</button>

          </div>

          <div class="container d-flex justify-content-center">
            <button type="button" class="btn btn-form-color  px-5  " data-bs-toggle="modal" data-bs-target="#editPassModal">Actualizar contraseña</button>

          </div>
        <?php endif; ?>

      </form>
    </div>
  </div>
  <div class="modal fade" id="editPassModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">

        <form id="edit_password_form" class="bg-white  rounded-3 shadow-lg"
           action="<?php echo Template::Route(UsuariosController::ROUTE, UsuariosController::EDITAR_CONTRASENA);?>" method="POST">
          <div class="modal-content">
             <div class="modal-header">
               <h5 class="modal-title" id="exampleModalLabel">Editar contraseña</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
         </div>
      <div class="modal-body">
      <div class="mb-3">
              <!-- border-danger text-danger -->
              <label for="actualPassword" class="form-label "> <i class="fas fa-key"></i> Contraseña actual </label>

              <input placeholder="******" type="password" class="form-control " id="actualPassword" name="actualPassword">
              <!-- <div id="emailHelp" class="form-text text-danger"><i class="fas fa-exclamation-circle"></i>Debe tener entre 4 y 5 caracteres</div> -->

            </div>
            <div class="mb-3">
              <!-- border-danger text-danger -->
              <label for="newPassword" class="form-label "> <i class="fas fa-key"></i> Nueva contraseña </label>

              <input placeholder="******" type="password" class="form-control " id="newPassword" name="newPassword">
              <!-- <div id="emailHelp" class="form-text text-danger"><i class="fas fa-exclamation-circle"></i>Debe tener entre 4 y 5 caracteres</div> -->

            </div>
            <div class="mb-3">
              <!-- border-danger text-danger -->
              <label for="confirmPassword" class="form-label "> <i class="fas fa-key"></i>Confirmar nueva contraseña </label>

              <input placeholder="******" type="password" class="form-control " id="confirmPassword" name="confirmPassword">
              <!-- <div id="emailHelp" class="form-text text-danger"><i class="fas fa-exclamation-circle"></i>Debe tener entre 4 y 5 caracteres</div> -->

            </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-primary"  form="edit_password_form">Actualizar contraseña</button>
      </div>
    </div>
  </div>
</div>

  <?php 
  function Scripts(){
      include Constants::PROJECT_PATH_INCLUDE . "Vista/Pages/Usuarios/Scripts/edit.Scripts.php";
  }
  ?>
</body>

</html>