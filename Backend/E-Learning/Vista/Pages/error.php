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

        <main style="margin-top:200px">
            <div class="error-contenedor mt-5">

                <div class="row gx-0 justify-content-center">
                  

                            <div class="col-12 d-flex my-auto col-lg-8 justify-content-center">

                                <h1 class="error-text display-1"><i class="far fa-frown"></i> ¡Parece que hubo un error!</h1>
                            </div>
                       
                 


                </div>
                <div class="row gx-0 justify-content-center">
                    <div class="col-12 d-flex justify-content-center" >
                        <p class="error-text fs-1">Sera mejor <a href="<?php echo Template::Route(InicioController::ROUTE, null); ?>">regresar...</a></p>
                    </div>
                </div>

                <div class="row gx-0 justify-content-center">
                    <div class="col-12 d-flex justify-content-center" >
                        <p class="error-text"><?php echo $validacionesGenerales->getMensajeError(); ?></p>
                    </div>
                </div>
            </div>

        </main>

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

</body>

</html>