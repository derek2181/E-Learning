<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    <link rel="stylesheet" href="<?php echo Constants::VIEWS_PATH?>css/main.css">
    <title>Edit</title>
</head>

<body>
    <div class="container-fluid p-0">

        <main>

            <div class="row mb-5 ">
                <div class="col-12 landing-image">
                    <!-- <img src="<?php echo Constants::VIEWS_PATH?>images/categoryBackground.jpg" class="w-100  "  style="height:700px" alt=""> -->
                </div>
            </div>
            <div class="container bg-light p-5 ">
                <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?php echo Template::Route(CursosController::ROUTE, CursosController::MOSTRAR_MIS_CURSO); ?>">Mis cursos</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Alumnos </li>
                    </ol>
                </nav>
                <div class="row mb-3">
                    <div class="col-12">
                        <h3>Alumnos de <span><?php echo $cursoElegido->getTituloCurso();  ?></span></h3>

                    </div>
                </div>



                <div class="row">
                <?php if(sizeof($listStudents )!=0) : ?>    
                    <div class="col-12" style="max-height: 500px; min-height:500px; overflow-y: scroll;">
                   
                        <table class="table table-striped table-hove table-bordered mb-5 text-center">
                            <thead>
                                <tr>
                                    <th scope="col">Nombre</th>
                                    <th scope="col">Fecha de inscripción</th>
                                    <th scope="col">Nivel de avance</th>
                                    <th scope="col">Ingreso</th>
                                    <th scope="col">Forma de pago</th>

                                </tr>
                            </thead>
                            <tbody class="text-center">
                              
                                <?php foreach($listStudents as $iStudent): ?>
                                <tr>
                                    <th scope="row"><a href="#" class="link-dark"><?php echo $iStudent->getCompraCurso()->getNombreCompletoUsuarioComprador()?></a></th>
                                    <td><?php echo $iStudent->getCompraCurso()->getFechaCreacionConFormatoCompra()?></td>
                                    <td><?php echo $iStudent->getCompraCurso()->getProgresoCursoComprado()?></td>
                                    <td>MX$<?php echo $iStudent->getCompraCurso()->getPagoConFormato()?></td>
                                    <td><?php echo $iStudent->getCompraCurso()->getFormaDePago()?></td>
                                </tr>
                               
                                <?php endforeach ?>
                             
                                <tr>


                                    <td colspan=2 scope="row">Total de ingresos</td>
                                    <td scope="row"></td>
                                    <td scope="row"></td>
                                    <td class="btn-form-color text-white text-center"> MX$<?php echo  number_format((float)$TotalIngresos, 2, '.', ','); ?></td>
                                </tr>
                            </tbody>
                        </table>
                        </div>
                        
                        <?php else: ?>
                        <div class="d-flex align-items-center justify-content-center" style="min-height:500px;">
                        <h1>Este curso aún no cuenta con estudiantes</h1>
                        </div>  
                        <?php endif ?>
                 
                   

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
        include Constants::PROJECT_PATH_INCLUDE . "Vista/Pages/Cursos/Scripts/courseStudents.Scripts.php";
    }
    ?>

</body>

</html>