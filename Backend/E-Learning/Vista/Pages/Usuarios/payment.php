<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    <link rel="stylesheet" href="<?php echo Constants::VIEWS_PATH?>css/card.css">
    <title>Comprar</title>
</head>

<body>
    <div class="container-fluid p-0">

        <main class="bg-light" style="min-height:800px ;">

            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Tu compra ha sido procesada</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <h1 class="display-1 text-success text-center"><i class="fas fa-check-circle"></i></h1>
                            <h1 class="text-center">Compra éxitosa</h1>
                        </div>
                        <div class="modal-footer">

                        </div>
                    </div>
                </div>
            </div>
            <div class="row text-center">
                <div class="p-5 mb-4 bg-light rounded-3">
                    <div class="container-fluid py-5">

                        <h1 class="display-4 fw-light">¡Paso final! </h1>
                        <hr>
                        <p class="fs-4 text-center">Estás a punto de pagar la cantidad de: </p>
                        <?php if ($cursoComprar->getCostoCurso() == 0) : ?>
                            <span class="badge rounded-pill bg-success ms-1 mt-1 mb-2">Gratis</span>
                        <?php else : ?>
                            <h1><strong>MX$<span id="precio"><?php echo $cursoComprar->getCostoCursoConFormato(); ?></span></strong></h1>
                        <?php endif ?>

                        <div id="courseID" data-courseid="<?php echo $cursoComprar->getIdCurso() ?>"></div>
                        <div></div>
                        <div id="paypal-button-container" data-price="<?php echo $cursoComprar->getCostoCurso() ?>"></div>
                        <button id="showCardContainer" class="btn btn-dark br-100 p-3 fs-4">Credit card <i class="far fa-credit-card"></i></button>

<div class="card-container  m-5 justify-content-center">

    <div class='card-wrapper'></div>
    <div class="d-flex justify-content-center mt-4">


       
        <form id="creditcardform">
            <div class="mb-3">
                <label for="number" class="form-label">Number</label>
                <input type="text" class="form-control" id="number" name="number">
              </div>
            <div class="d-flex">
               
            <div>
            
            <div class="m-1">
              <label for="name" class="form-label">First name</label>
              <input type="text" class="form-control" id="name" name="name">
            </div>
            <div class="m-1">
          
                <label for="expiry" class="form-label">Expiry</label>
                <input type="text" class="form-control" id="expiry" name="expiry">
              </div>
            </div>
            <div>
              <div class="m-1">
                <label for="cvc" class="form-label">cvc</label>
                <input type="text" class="form-control" id="cvc" name="cvc">
              </div>
            </div>
        </div>
            <button type="submit" class="btn btn-primary">Submit</button>
          </form>
    </div>
</div>       

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
        include Constants::PROJECT_PATH_INCLUDE . "Vista/Pages/Usuarios/Scripts/payment.Scripts.php";
    }
    ?>
</body>

</html>