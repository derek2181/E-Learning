<script>
    $(document).ready(function() {
        var idContainer = $('#courseID');
        var courseid = idContainer.data('courseid');

        $('#pills-reviews').hide();
        $('#courseLevels').click((element) => {

            $('#courseLevels').removeClass('btn-inactive-color');
            $('#courseLevels').addClass('btn-active-color');
            $('#courseReviews').removeClass('btn-active-color');
            $('#courseReviews').addClass('btn-inactive-color');
            setTimeout(function() {
                $('div#pills-reviews').fadeOut(0);
            }, 200);
            setTimeout(function() {
                $('div#pills-levels').fadeIn(0);
            }, 200);

        });

        $('#courseReviews').click((element) => {

            $('#courseReviews').click((element) => {

                $('#courseReviews').removeClass('btn-inactive-color');
                $('#courseReviews').addClass('btn-active-color');
                $('#courseLevels').removeClass('btn-active-color');
                $('#courseLevels').addClass('btn-inactive-color');
                setTimeout(function() {
                    $('div#pills-levels').fadeOut(0);
                }, 200);

                setTimeout(function() {
                    $('div#pills-reviews').fadeIn(0);
                }, 200);

            });

        });

        $('#conseguir-curso').click((element) => {
            $.ajax({
                url: '<?php echo Template::Route(ComprasController::ROUTE, ComprasController::REALIZAR_COMPRA_GRATIS); ?>',
                type: 'post',

                data: {
                    idcurso: courseid
                },
                dataType: 'json',
                success: function(data) {
                    $('#exampleModal').modal('show');
                    setTimeout(() => {
                        window.location = '<?php echo Template::Route(InicioController::ROUTE, null); ?>';
                    }, 2000)


                },
                error: function(data) {
                    console.log("Error");
                },
                failure: function(data) {
                    console.log("Failure");
                },
            });

        });

        putPopOvers();

        function ingresarVoto(voto) {
            var varIdCurso = courseid;

            $.ajax({
                url: '<?php echo Template::Route(CalificacionesController::ROUTE, CalificacionesController::CREAR_CALIFICACION); ?>',
                type: 'post',
                data: {
                    votoCalifcacion: voto,
                    IdCurso: varIdCurso
                },
                dataType: 'json',
                success: function(data) {
                    actualizarBarraCalificacion();
                },
                error: function(data) {
                    console.log("algo no jalo");
                    console.log(data.text);
                },
                failure: function(data) {
                    console.log("Failure");
                },
            });
        }

        function actualizarBarraCalificacion() {
            var varIdCurso = courseid;

            $.ajax({
                url: '<?php echo Template::Route(CursosController::ROUTE, CursosController::CONSEGUIR_CURSO); ?>',
                type: 'post',
                data: {
                    IdCurso: varIdCurso
                },
                dataType: 'json',
                success: function(data) {
                    var containerEtiquetaLikes = $("#container-label-likes");
                    var etiquetaLikes = $("#label-likes");
                    etiquetaLikes.remove();

                    var barraLikes = $("#barra-likes");
                    var barraDislikes = $("#barra-dislikes");

                    var porcentajeCalificacion = data.PorcentajeCalificacion;
                    if (+porcentajeCalificacion >= 0) {

                        barraLikes.width(porcentajeCalificacion + "%");
                        barraDislikes.width((100 - +porcentajeCalificacion) + "%");

                        var contenidoEtiquetaLikes = '' +
                            '   <h4 id="label-likes" class="fw-normal">' +
                            '       Al <span class="fw-bolder">' + porcentajeCalificacion + '%</span> de las personas le gustó este curso' +
                            '   </h4>' +
                            '';

                        // containerEtiquetaLikes.append(contenidoEtiquetaLikes);
                        $(contenidoEtiquetaLikes).hide().insertAfter(containerEtiquetaLikes).fadeIn(200);

                        // etiquetaLikes.text('Al <span class="fw-bolder">' + porcentajeCalificacion + '%</span> de las personas le gustó este curso');
                    } else {

                        barraLikes.width("0%");
                        barraDislikes.width("0%");

                        var contenidoEtiquetaLikes = '' +
                            '   <h4 id="label-likes" class="fw-normal">Este curso aun no tiene ningún voto</h4>' +
                            '';

                        // containerEtiquetaLikes.append(contenidoEtiquetaLikes);
                        $(contenidoEtiquetaLikes).hide().insertAfter(containerEtiquetaLikes).fadeIn(200);
                    }
                },
                error: function(data) {
                    console.log("algo no jalo");
                    console.log(data.text);
                },
                failure: function(data) {
                    console.log("Failure");
                },
            });
        }


        $('#like-button').click((e) => {
            e.preventDefault();

            var buttonLike = $("#like-button");
            var buttonDislike = $('#dislike-button');

            if (buttonLike.hasClass("liked") == false) {
                buttonLike.addClass('liked')
                buttonDislike.removeClass('disliked');
            } else {
                buttonLike.removeClass('liked')
            }

            ingresarVoto(1);

        });
        $('#dislike-button').click((e) => {
            e.preventDefault();

            var buttonLike = $("#like-button");
            var buttonDislike = $('#dislike-button');

            if (buttonDislike.hasClass("disliked") == false) {
                buttonDislike.addClass('disliked')
                buttonLike.removeClass('liked');
            } else {
                buttonDislike.removeClass('disliked')
            }



            ingresarVoto(0);

        });

        $('#contenedor-general-comentarios').on("click", "#button-enviar-comentario", function(e) {
            e.preventDefault();
            var elemento = $(this);
            var varIdCurso = courseid;
            var descripcionComentario = $("#descripcion-comentario").val();

            $.ajax({
                url: '<?php echo Template::Route(ComentariosController::ROUTE, ComentariosController::CREAR_COMENTARIO); ?>',
                type: 'post',
                data: {
                    IdCurso: varIdCurso,
                    comment: descripcionComentario,
                },
                dataType: 'json',
                success: function(data) {

                    var buttonCargarMas = $("#id-count-messages");
                    var valueButtonCargarMas = +buttonCargarMas.val() + 1;

                    buttonCargarMas.val(valueButtonCargarMas);
                    var IdComentarioCurso = data.IdComentario;
                    // var UsuarioComento = value.UsuarioComento;
                    // var CursoComentado = value.CursoComentado;
                    // var DescripcionComentario = value.DescripcionComentario;
                    // var FechaCreacionComentario = value.FechaCreacionComentario;
                    // var EstadoComentario = value.EstadoComentario;
                    // var NombreCompletoUsuarioComento = value.NombreCompletoUsuarioComento;
                    // var ImagenPerfilUsuarioComento = value.ImagenPerfilUsuarioComento;

                    var ImagenPerfilUsuarioComento = data.ImagenPerfilUsuarioComento;
                    var NombreCompletoUsuarioComento = data.NombreCompletoUsuarioComento;
                    var FechaCreacionComentario = data.FechaCreacionComentario;
                    var DescripcionComentario = data.DescripcionComentario;

                    var comentarioHTML = '' +
                        '<div class="row bg-white mb-3 container-comentario" id="container-comentario-' + IdComentarioCurso + '">' +
                        '    <div class="col-12  p-3 ">' +
                        '        <div class="row">' +
                        '            <div class="col-10">' +
                        '                <img src="data:image/jpeg; base64,' + ImagenPerfilUsuarioComento + '" style="border-radius:100%; height:50px; width:50px" alt="">' +
                        '                <span class="ms-2 text-break fw-bold">' + NombreCompletoUsuarioComento + '</span>' +
                        '            </div>' +
                        '            <div class="col-2">' +
                        '                <span class="fw-light">' + FechaCreacionComentario + '</span>' +
                        '                <div id="id-button-edit-delete">' +
                        '                   <button class="button-editar-comentario btn btn-success d-inline" value="' + IdComentarioCurso + '"><i class="fas fa-edit"></i></button>' +
                        '                   <button class="button-borrar-comentario btn btn-danger d-inline" value="' + IdComentarioCurso + '" data-bs-toggle="modal" data-bs-target="#modal-eliminar-Curso"><i class="fas fa-trash-alt"></i></button>' +
                        '                </div>' +
                        '            </div>' +
                        '        </div>' +
                        '    </div>' +
                        '    <div class="col-12" id="container-texto-comentario-' + IdComentarioCurso + '">' +
                        '        <p class="fw-light text-break text-wrap" id="texto-comentario-' + IdComentarioCurso + '">' + DescripcionComentario + '</p>' +
                        '    </div>' +
                        '</div>' +
                        '';



                    var comentarios = $(".container-comentario");

                    var comentarioSiguiente = $(".container-comentario").first();


                    if (comentarioSiguiente.length == 0) {

                        var seccionComentarios = $("#seccion-comentarios");
                        $(comentarioHTML).hide().appendTo(seccionComentarios).fadeIn(300);
                    } else {
                        $(comentarioHTML).hide().insertBefore(comentarioSiguiente).fadeIn(300);
                    }

                    $("#descripcion-comentario").val('');

                    var container_comentarios = $("#container-escribir-comentario");

                    // container_comentarios.fadeOut(200);
                    container_comentarios.remove();
                    // setTimeout(function(){
                    //     container_comentarios.remove();
                    // }, 1000);



                    var botonBorrarComent = $("#button-modal-delete");
                    var textoModal = $("#texto-modal");

                    botonBorrarComent.val(IdComentarioCurso);
                    textoModal.text("¿Estás seguro de dar de baja el comentario \"" + DescripcionComentario + "\"?");

                },
                error: function(data) {
                    console.log("algo no jalo");
                    console.log(data.text);
                }
            });
        });

        var texto_comentario = null;
        $('#contenedor-general-comentarios').on("click", ".button-editar-comentario", function(e) {
            // var varIdCurso = courseid;

            var botonBorrarComent = $(this);
            var varIdComent = botonBorrarComent.val();

            var parrafo_texto = $("#texto-comentario-" + varIdComent);

            var comentario_parrafo_texto = $.trim(parrafo_texto.text());
            texto_comentario = comentario_parrafo_texto;

            var container_texto = $("#container-texto-comentario-" + varIdComent);

            var inputComentario = '<div id ="editar-comentario-container">' +

                '                                <div class="form-floating mb-2">' +
                // '                                  <input type="hidden" name="id-curso" value="' + courseid + '">' +
                '                                  <textarea name="comment" class="form-control" placeholder="Leave a comment here" id="descripcion-comentario">' + comentario_parrafo_texto + '</textarea>' +
                '                                  <label for="floatingTextarea">Reseña</label>' +
                '                                </div>' +
                '                                <div id="error-container" class="d-flex flex-column">' +
                '                                </div>' +
                '' +
                '                                <div class="row">' +
                '                                  <div class="col-12 d-flex justify-content-center">' +
                '                                    <button id="button-enviar-comentario-editado" value="' + varIdComent + '" class="btn btn-form-color btn-lg fs-5">Enviar</button>' +
                '                                  </div>' +
                '                                </div>' +
                '                   </div>';


            parrafo_texto.remove();
            $(inputComentario).hide().appendTo(container_texto).fadeIn(300);


            var container_botones = $("#id-button-edit-delete");
            var buttonEditar = $(".button-editar-comentario");
            var buttonBorrar = $(".button-borrar-comentario");

            var buttonCancel = '<button id="button-cancel-editar" class ="btn" value="' + varIdComent + '"><i class="fas fa-times-circle btn btn-danger"></i></button>';

            buttonEditar.remove();
            buttonBorrar.remove();
            $(buttonCancel).hide().appendTo(container_botones).fadeIn(300);


        });

        function removeEditContainerInsertParrafo(varIdComent, textoComent) {
            var container_texto = $("#container-texto-comentario-" + varIdComent);

            var input_texto_Comentario = $("#editar-comentario-container");
            var parrafo_texto = '<p class="fw-light text-break text-wrap" id="texto-comentario-' + varIdComent + '">' + textoComent + '</p>';

            input_texto_Comentario.remove();
            $(parrafo_texto).hide().appendTo(container_texto).fadeIn(300);

            var container_botones = $("#id-button-edit-delete");

            var button_Cancelar = $("#button-cancel-editar");
            var buttonsEditarCancelar = '' +
                '   <button class="button-editar-comentario btn btn-success d-inline" value="' + varIdComent + '"><i class="fas fa-edit"></i></button>' +
                '   <button class="button-borrar-comentario btn btn-danger d-inline" value="' + varIdComent + '" data-bs-toggle="modal" data-bs-target="#modal-eliminar-Curso"><i class="fas fa-trash-alt"></i></button>' +
                '';


            button_Cancelar.remove();
            $(buttonsEditarCancelar).hide().appendTo(container_botones).fadeIn(300);
        }

        $('#contenedor-general-comentarios').on("click", "#button-cancel-editar", function(e) {

            var botonCancelarComent = $(this);
            var varIdComent = botonCancelarComent.val();

            removeEditContainerInsertParrafo(varIdComent, texto_comentario);

            texto_comentario = null;
        });


        $('#contenedor-general-comentarios').on("click", "#button-enviar-comentario-editado", function(e) {
            e.preventDefault();
            var elemento = $(this);
            var varIdCurso = courseid;
            var varIdComentario = elemento.val();
            var descripcionComentario = $("#descripcion-comentario").val();

            $.ajax({
                url: '<?php echo Template::Route(ComentariosController::ROUTE, ComentariosController::EDITAR_COMENTARIO); ?>',
                type: 'post',
                data: {
                    IdComentario: varIdComentario,
                    comment: descripcionComentario,
                },
                dataType: 'json',
                success: function(data) {

                    var IdComentarioCurso = data.IdComentario;
                    var DescripcionComentario = data.DescripcionComentario;

                    removeEditContainerInsertParrafo(IdComentarioCurso, DescripcionComentario);

                    var botonBorrarComent = $("#button-modal-delete");
                    var textoModal = $("#texto-modal");

                    botonBorrarComent.val(IdComentarioCurso);
                    textoModal.text("¿Estás seguro de dar de baja el comentario \"" + DescripcionComentario + "\"?");

                },
                error: function(data) {
                    console.log("algo no jalo");
                    console.log(data.text);
                }
            });
        });


        $('#contenedor-general-comentarios').on("click", '.button-editar-comentario', function() {
            $("#button-modal-delete").show();
        });

        $('#button-modal-delete').click(function(e) {
            // var varIdCurso = courseid;

            var botonBorrarComent = $(this);
            var varIdComent = botonBorrarComent.val();

            var textoModal = $("#texto-modal");
            var containerModal = $("#modal-eliminar-Curso");
            var containerModalShadow = $(".modal-backdrop");

            botonBorrarComent.val("");
            textoModal.text("");
            containerModal.hide();
            containerModalShadow.remove();

            $.ajax({
                url: '<?php echo Template::Route(ComentariosController::ROUTE, ComentariosController::DELETE_COMENTARIO); ?>',
                type: 'post',
                data: {
                    // IdCurso: varIdCurso,
                    IdComentario: varIdComent,
                },
                dataType: 'json',
                success: function(data) {


                    var container_comentario = '' +
                        '                            <div id="container-escribir-comentario">' +
                        '' +
                        '                              <div class="form-floating mb-2">' +
                        // '                                <input type="hidden" name="id-curso" value="' + courseid + '">' +
                        '                                <textarea name="comment" class="form-control" placeholder="Leave a comment here" id="descripcion-comentario"></textarea>' +
                        '                                <label for="floatingTextarea">Reseña</label>' +
                        '                              </div>' +
                        '                              <div id="error-container" class="d-flex flex-column">' +
                        '                              </div>' +
                        '' +
                        '                              <div class="row">' +
                        '                                <div class="col-12 d-flex justify-content-center">' +
                        '                                  <button id="button-enviar-comentario" class="btn btn-form-color btn-lg fs-5">Enviar</button>' +
                        '                                </div>' +
                        '                              </div>' +
                        '                            </div>' +
                        '';


                    var containerCalificacion = $("#container-calificacion");

                    $(container_comentario).hide().insertAfter(containerCalificacion).fadeIn(300);

                    var container_comentarios = $("#container-comentario-" + varIdComent);

                    // container_comentarios.fadeOut(200);
                    container_comentarios.remove();

                },
                error: function(data) {
                    console.log("algo no jalo");
                    console.log(data.text);
                }
            });
        });

        $('#id-count-messages').click(function(e) {
            e.preventDefault();
            var buttonCargarMas = $(this);
            var varNumeroComentario = buttonCargarMas.val();

            $.ajax({
                url: '<?php echo Template::Route(ComentariosController::ROUTE, ComentariosController::CARGAR_COMENTARIOS); ?>',
                type: 'post',
                data: {
                    numeroComentario: varNumeroComentario,
                    IdCurso: courseid
                },
                dataType: 'json',
                success: function(data) {

                    buttonCargarMas.val(+varNumeroComentario + data.length);

                    $.each(data, function(key, value) {
                        var IdComentarioCurso = value.IdComentario;
                        var UsuarioComento = value.UsuarioComento;
                        var CursoComentado = value.CursoComentado;
                        var DescripcionComentario = value.DescripcionComentario;
                        var FechaCreacionComentario = value.FechaCreacionComentario;
                        var EstadoComentario = value.EstadoComentario;
                        var NombreCompletoUsuarioComento = value.NombreCompletoUsuarioComento;
                        var ImagenPerfilUsuarioComento = value.ImagenPerfilUsuarioComento;

                        var IdContainerComentario = +varNumeroComentario + 1;

                        var usuarioActivo = <?php echo General::getIdUsuarioActivo(); ?>

                        var comentarioHTML = '' +
                            '<div class="row bg-white mb-3 container-comentario">' +
                            '    <div class="col-12  p-3 ">' +
                            '        <div class="row">' +
                            '            <div class="col-10">' +
                            '                <img src="data:image/jpeg; base64,' + ImagenPerfilUsuarioComento + '" style="border-radius:100%; height:50px; width:50px" alt="">' +
                            '                <span class="ms-2 text-break fw-bold">' + NombreCompletoUsuarioComento + '</span>' +
                            '            </div>' +
                            '            <div class="col-2">' +
                            '                <span class="fw-light">' + FechaCreacionComentario + '</span>' +
                            '';

                        if (usuarioActivo == UsuarioComento) {

                            comentarioHTML += ' <div id="id-button-edit-delete">' +
                                '                   <button class="button-editar-comentario btn btn-success d-inline" value="' + IdComentarioCurso + '"><i class="fas fa-edit"></i></button>' +
                                '                   <button class="button-borrar-comentario btn btn-danger d-inline" value="' + IdComentarioCurso + '" data-bs-toggle="modal" data-bs-target="#modal-eliminar-Curso"><i class="fas fa-trash-alt"></i></button>' +
                                '               </div>';
                        }

                        comentarioHTML += '' +
                            '            </div>' +
                            '        </div>' +
                            '    </div>' +
                            '    <div class="col-12"  id="container-texto-comentario-' + IdComentarioCurso + '">' +
                            '        <p class="fw-light text-break text-wrap" id="texto-comentario-' + IdComentarioCurso + ' ">' + DescripcionComentario + '</p>' +
                            '    </div>' +
                            '</div>' +
                            '';

                        var comentarioSiguiente = $(".container-comentario").last();

                        if (comentarioSiguiente.length == 0) {

                            var seccionComentarios = $("#seccion-comentarios");
                            $(comentarioHTML).hide().appendTo(seccionComentarios).fadeIn(300);
                        } else {
                            $(comentarioHTML).hide().insertAfter(comentarioSiguiente).fadeIn(300);
                        }

                    });

                },
                error: function(data) {
                    console.log("algo no jalo");
                    console.log(data.text);
                },
                failure: function(data) {
                    console.log("Failure");
                },
            });
        });


    });
</script>