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
    <link rel="stylesheet" href="<?php echo Constants::VIEWS_PATH?>plugins/css/OwlCarousel/owl.carousel.min.css">
    <link rel="stylesheet" href="<?php echo Constants::VIEWS_PATH?>plugins/css/OwlCarousel/owl.theme.default.min.css">
    <link rel="stylesheet" href="<?php echo Constants::VIEWS_PATH?>plugins/css/widthme.css">

    <link rel="stylesheet" href="<?php echo Constants::VIEWS_PATH?>css/main.css">
</head>

<body>

    <div class="container-fluid p-0 ">

        <!-- <div class="position-absolute bottom-0 flex-d mx-auto  ">
    <a class="btn btn-secondary" href="">Iniciar sesion</a>
    <a class="btn btn-secondary">Registrarse</a>
        </div> -->

        <main>
            <div class="row d-flex ">
            <div style="max-height:750px; min-height:500px; overflow-y: scroll;" class="col-12 col-lg-3  pb-0 ">
                    <div class="row d-flex mb-3 p-3">
                        <div class="col-2 col-lg-3 ">
                            <!-- <img src="<?php echo Constants::VIEWS_PATH?>images/avatar.png" > -->
                            <img style="height:70px;width:70px; border-radius:100%" alt="..." src="data:image/jpeg; base64, <?php echo $usuarioActivo->getImagenPerfilUsuario(); ?>">
                        </div>
                        <div class="col-10 col-lg-9 d-flex flex-column justify-content-center">
                            <h5 class="text-left m-0"><?php echo $usuarioActivo->getNombreUsuario(); ?></h5>
                            <p><?php echo $usuarioActivo->getTipoRol(); ?></p>
                        </div>
                    </div>

                    <div class="row mb-3 p-3">
                            <input class="form-control me-2" id="filtroUsuarios" type="search" placeholder="Buscar usuario">
                    </div>
                    <hr>

                    <div class="user-chats" id="chats">
                        <?php foreach ($listaBandejaMensajes as $iMensajeBandeja) : ?>

                            <!-- TODO: ESTE IF, ELSE SE PUEDE HACER MEJOR DESDE LA BASE DE DATOS? -->
                            <?php if ($iMensajeBandeja->getUsuarioEnvia() == $usuarioActivo->getIdUsuario()) : ?>
                                <a class="chat-user" href="<?php echo Template::Route(MensajesController::ROUTE, MensajesController::MOSTRAR_MENSAJES . "/" . $iMensajeBandeja->getUsuarioRecibe()); ?>">



                                    <div class="user-card row d-flex mb-0 pt-3 ps-3 pe-3 pb-0  ">
                                        <div class="col-3">
                                            <img src="data:image/jpeg; base64, <?php echo $iMensajeBandeja->getImagenUsuarioRecibe(); ?>" style="height:60px;width:60px; border-radius:100% " alt="">
                                        </div>
                                        <div class="col-9 ">
                                            <div class="row mb-2">
                                                <div class="col-12">

                                                    <h5 class="m-0 text-cut"><?php echo $iMensajeBandeja->getNombreUsuarioRecibe() ?></h5>

                                                </div>
                                            
                                            </div>
                                            <div class="row  m-0">
                                                <p class="p-0 text-cut">Enviado: <?php echo $iMensajeBandeja->getDescripcionMensaje() ?></p>

                                            </div>
                                        </div>
                                    </div>


                                </a>
                            <?php elseif ($iMensajeBandeja->getUsuarioRecibe() == $usuarioActivo->getIdUsuario()) : ?>
                                <a class="chat-user" href="<?php echo Template::Route(MensajesController::ROUTE, MensajesController::MOSTRAR_MENSAJES . "/" . $iMensajeBandeja->getUsuarioEnvia()); ?>">

                                    <div class="user-card row d-flex mb-0 pt-3 ps-3 pe-3 pb-0  ">
                                        <div class="col-3">
                                            <img src="data:image/jpeg; base64, <?php echo $iMensajeBandeja->getImagenUsuarioEnvia(); ?>" style="height:60px;width:60px;border-radius:100% " alt="">
                                        </div>
                                        <div class="col-9 ">
                                            <div class="row mb-2">
                                                <div class="col-12">

                                                    <h5 class="m-0 text-cut"><?php echo $iMensajeBandeja->getNombreUsuarioEnvia() ?></h5>

                                                </div>
                                                
                                            </div>
                                            <div class="row  m-0">
                                                <p class="p-0 text-cut">Recibido: <?php echo $iMensajeBandeja->getDescripcionMensaje() ?></p>

                                            </div>
                                        </div>
                                    </div>


                                </a>
                            <?php endif; ?>

                        <?php endforeach; ?>
                    </div>



                </div>

                <?php if ($usuarioRemitente != null) : ?>


                    <div class="col-lg-9 col-12  pb-2 ">
                        <div class="header-messages ">
                            <div class="row p-4">
                                <div class="col-12 d-flex align-items-center">
                                    <img class="me-2" style="height:70px; border-radius: 100%;" alt="..." src="data:image/jpeg; base64, <?php echo $usuarioRemitente->getImagenPerfilUsuario(); ?>">
                                    <h5><?php echo $usuarioRemitente->getNombreCompletoUsuario() ?></h5>
                                </div>
                                <hr>
                            </div>
                        </div>

                        <div class="messages" style="overflow-y: scroll; overflow-x: hidden; height:675px; ">

                            <?php foreach ($listaMensajesConversacion as $iMensajesConversacion) : ?>


                                <div class="row mb-1">

                                    <div class="col-12">
                                        <?php if ($iMensajesConversacion->getUsuarioEnvia() == $usuarioActivo->getIdUsuario()) : ?>
                                    <div class="row mb-1">
                                        <div class="col-12">
                                            <div class="row p-2">
                                        
                                                <div class="col-7 offset-5 d-flex justify-content-end ">
                                                
                                                    <h4 class="p-2 text-break"
                                                        style="border-radius:15px; border-top-right-radius: 0px; background:rgba(223, 223, 223, 0.445)">
                                                        <?php echo $iMensajesConversacion->getDescripcionMensaje(); ?>                                                    </h4>
                                                
                                                        <img class="me-2" src="data:image/jpeg; base64, <?php echo $iMensajesConversacion->getImagenUsuarioEnvia(); ?>" style="height:45px; border-radius: 100%;" alt="">


                                                </div>
                                                <span class="d-flex justify-content-end"><?php echo $iMensajesConversacion->getFechaCreacionConFormatoMensaje(); ?></span>

                                             </div>
                                        </div>
                                                
                                    </div>
                                        <?php else : ?>
                                        <div class="row ">

                                            <div class="col-12">

                                                <div class="row ">
                                                    <div class="col-7  d-flex ">
                                                        <img class="me-2" src="data:image/jpeg; base64, <?php echo $iMensajesConversacion->getImagenUsuarioEnvia(); ?>" style="height:45px; border-radius: 100%;" alt="">

                                                        <h4 class="p-2 text-wrap text-break  "
                                                            style="border-radius:15px; border-top-left-radius: 0px; background:rgba(223, 223, 223, 0.445)">
                                                            <?php echo $iMensajesConversacion->getDescripcionMensaje() ?>
                                                        </h4>

                                                    </div>
                                                    <span class="d-flex justify-content-start"><?php echo $iMensajesConversacion->getFechaCreacionConFormatoMensaje(); ?></span>

                                                </div>
                                            </div>

                                        </div>
                                        <?php endif; ?>
                                    </div>

                                </div>

                            <?php endforeach; ?>
                        </div>
                        <div class="form-messages">
                            <form action="<?php echo Template::Route(MensajesController::ROUTE, MensajesController::CREAR_MENSAJE); ?>" method="POST">
                                <div class="row">
                                    <div class="col-12 d-flex">
                                        <input type="text" name="descripcion" class="form-control form-control rounded-pill" placeholder="Escribe tu mensaje..." aria-label=".form-control-lg example" autocomplete="off">
                                        <input type="hidden" name="usuario-recibe" value="<?php echo $usuarioRemitente->getIdUsuario(); ?>">
                                        <button class="btn btn-primary bg-dark border-dark rounded-pill"><i class="fab fa-telegram-plane"></i></button>

                                    </div>

                                </div>

                            </form>
                        </div>

                    </div>
                <?php endif ?>
            </div>

        </main>

    </div>

    <?php
    function Scripts()
    {
        include Constants::PROJECT_PATH_INCLUDE . "Vista/Pages/Cursos/Scripts/chat.Scripts.php";
    }
    ?>

</body>

</html>