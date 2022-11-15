<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link
    href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700&display=swap"
    rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css"
    integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
  <link rel="stylesheet" href="<?php echo Constants::VIEWS_PATH?>css/widthme.css">
  <link rel="stylesheet" href="<?php echo Constants::VIEWS_PATH?>css/diploma.css">
<link rel="stylesheet" href="<?php echo Constants::VIEWS_PATH?>css/navbar.css">
  <link rel="stylesheet" href="<?php echo Constants::VIEWS_PATH?>css/main.css">
</head>

<body>

  <div class="container-fluid p-0 ">

    
    <div id="diploma-content" class="container-fluid mb-5 ">
      <div class="d-flex justify-content-center">
        <img src="<?php echo Constants::VIEWS_PATH?>images/courselogoBlack.png" style="width:15%" alt="">
      </div>
    
      <h1 class="text-center mb-5 pb-5">Reconocimiento por parte de <?php echo $datosDiplomaCurso->getNombreCompletoUsuarioCreador(); ?></h1>
      <h5 class="text-center">EL PRESENTE CERTIFICADO SE OTORGA A:</h5>
      <h1 class="display-4 mb-5 text-center fw-bolder" ><?php echo $datosDiplomaCurso->getCompraCurso()->getNombreCompletoUsuarioComprador(); ?></h1>
      <h5 class="text-center mt-5">POR HABER TERMINADO SATISFACTORIAMENTE EL CURSO DE:</h5>
      <h3 class="text-center mb-5 pb-5"><?php echo $datosDiplomaCurso->getTituloCurso(); ?></h3>
      <h5 class="text-center fs-5 fw-light">Fecha de terminación del curso</h5>
      <h5 class="text-center fs-5 "><?php echo $datosDiplomaCurso->getCompraCurso()->getFechaCompletadoConFormatoCompra(); ?></h5>
    </div>
    <div id="buttonContent" class="container d-flex mb-3 justify-content-center">
      <button id="printer" class=" btn btn-form-color fs-3 ">Imprimir</button>
    </div>
 
  </div>

  
</body>
<?php
  function Scripts()
  {
    include Constants::PROJECT_PATH_INCLUDE . "Vista/Pages/Cursos/Scripts/diploma.Scripts.php";
  }
  ?>
</html>