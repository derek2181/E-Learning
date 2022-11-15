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
  <link rel="stylesheet" href="<?php echo Constants::VIEWS_PATH?>css/widthme.css">
  <link rel="stylesheet" href="<?php echo Constants::VIEWS_PATH?>css/navbar.css">
  <link rel="stylesheet" href="<?php echo Constants::VIEWS_PATH?>css/main.css">
</head>

<body>


  <div class="container-fluid p-0">

   
        <main >
            <div class="d-flex justify-content-center align-items-center mt-5" style="height:100px">
                <h1>Escoje tu rol</h1>
            </div>
            
            <div  style="height:600px;">
            <form method="POST" id="rol_form" action="<?php echo Template::Route(UsuariosController::ROUTE,UsuariosController::SELECCION_ROL);?>">

                <div  style="height:100px" class="w-100 justify-content-evenly align-items-start  d-flex">
              
                <input type="radio" class="btn-check" name="Rol" value="<?php echo ROL::Escuela?>" id="student-rol" autocomplete="off">
                <label class="btn btn-outline-success btn-lg fs-1" for="student-rol"><i class="fas fa-user-graduate"></i> Estudiante</label>

                <input type="radio" class="btn-check" name="Rol" value="<?php echo ROL::Estudiante?>" id="school-rol" autocomplete="off">
                <label class="btn btn-outline-success btn-lg fs-1" for="school-rol"><i class="fas fa-university"></i>Escuela</label>

                </div>
                <div id="error_placement_rol" style="height:100px" class="d-flex justify-content-center text-danger fs-3">
              
                </div>
                <div class="d-flex justify-content-center">
                <button type="submit" form="rol_form"  class="btn btn-form-color btn-lg fs-1">Continuar</button>
                </div>

            </form>
            </div>
        </main>



      <div class="mt-5">
     
         <footer class="text-center text-white" style="background-color: #0d0d0e;">
            <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2);">
              © 2021 Copyright<br>
              Luis Angel Daniel Sánchez<br>
              Derek Jafet Cortes Madriz<br>
              
            </div>
 
          </footer>

      </div>
    </div>




    <?php

    function Scripts()
    {
      include Constants::PROJECT_PATH_INCLUDE . "Vista/Pages/Cursos/Scripts/rolSelection.Scripts.php";
    }
    ?>

</body>

</html>