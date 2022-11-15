<script>
    $(document).ready(() => {


        $(document).on("click", "#modal-delete-course", function() {
            var inputElement = $(this);
            var input = document.getElementById("modal-delete-course");
            let datos = new FormData();
            datos.append("idCurso", inputElement[0].value);


            $.ajax({
                url: "<?php echo Template::Route(CursosController::ROUTE, CursosController::DELETE_CURSO); ?>",
                cache: false,
                processData: false,
                contentType: false,
                type: "POST",
                data: datos,
                success: function(res, status) {
                    var container_editar_borrar = $(`#button-editar-borrar-${inputElement[0].value}`);
                    // $(`#button-editar-borrar-${inputElement[0].value}`).fadeOut("slow").remove();
                    container_editar_borrar.fadeOut(200);
                     
                    setTimeout(function(){
                        container_editar_borrar.remove();
                    }, 1000);
                },
                error: function(res, status) {

                    console.log(res.responseText);
                },
                failure: function(res, status) {
                    console.log(status);
                }
            });
        });

        $('#contenedor-general-comentarios').on("click", ".button-eliminar-curso", function(e) {
            e.preventDefault();
            var elemento = $(this);
            var varIdCurso = elemento.val();

            var button_modal_delete = $("#modal-delete-course");
            button_modal_delete.val(varIdCurso);

            $("#exampleModal").show();

        });

        $('#CargarMasCursos').click(() => {
            let numeroPaginacion = $('#NumeroCursoPaginacion').val();
            $.ajax({
                url: '<?php echo Template::Route(CursosController::ROUTE, CursosController::ALUMNOS_CURSO); ?>',
                type: 'POST',
                data: {
                    paginacion: numeroPaginacion
                },

                dataType: 'json',
                success: function(data) {

                    $('#NumeroCursoPaginacion').val(+numeroPaginacion + data.length);

                    $.each(data, function(key, value) {
                        var IdCurso = value.IdCurso;
                        var TituloCurso = value.TituloCurso;
                        var ImagenCurso = value.ImagenCurso;
                        var TotalIngresos = value.TotalIngresos;
                        var EstadoCurso = value.EstadoCurso;

                        var cards = '' +
                            '                                       <div class="container-curso card m-2 pt-3 shadow-lg card-course-' + IdCurso + '" style="width: 18rem;">' +
                            '                                            <img src="data:image/jpeg; base64,' + ImagenCurso + '" class="card-img-top img-thumbnail custom-img-card" alt="...">' +
                            '                                            <div class="card-body">' +
                            '                                                <h5 class="card-title text-cut">' + TituloCurso + '</h5>' +
                            '                                                <h5><strong>MX$' + TotalIngresos + '</strong> recaudado.</h5>' +
                            '                                                <div class="row">' +
                            '                                                    <div class="col-7 ">' +
                            '                                                        <a href="<?php echo Template::Route(CursosController::ROUTE, CursosController::MOSTRAR_CURSO) . "/" ?>' + IdCurso + '" class="btn btn-dark w-100 button-continue-watching">Ver' +
                            '                                                            detalles</a>' +
                            '                                                    </div>';

                        if (EstadoCurso == 1) {
                            cards += '' +
                                '                                                   <div class="col-5 d-flex justify-content-between" id ="button-editar-borrar-' + IdCurso + '">' +
                                '                                                       <div class="col-2 d-flex justify-content-center me-1 ">' +
                                '                                                           <form method="POST" action="<?php echo Template::Route(CursosController::ROUTE, CursosController::EDITAR_CURSO); ?>">' +
                                '                                                               <input type="hidden" name="idCurso" value="' + IdCurso + '">' +
                                '                                                               <button type="submit" class="btn btn-success"><i class="fas fa-edit"></i></button>' +
                                '                                                           </form>' +
                                '                                                       </div>' +
                                '                                                       <div class="col-2 d-flex justify-content-center">' +
                                '                                                           <button type="button" class="button-eliminar-curso btn btn-danger" value="' + IdCurso + '" data-toggle="modal" data-target="#ModalElminado"><i class="fas fa-trash-alt"></i></button>' +
                                '                                                       </div>' +
                                '                                                    </div>';
                        }
                        else{
                            cards += '' +
                                '<div class="col-5 ">'+
                                                        '<span class="text-danger fs-6"> <i class="fas fa-exclamation-circle pe-1"></i>Curso eliminado</span>'+
                                                        '</div>';
                        }

                        cards += '' +
                            '                                                </div>' +
                            '                                            </div>' +
                            '                                        </div>' +
                            '';


                        var cursos = $(".container-curso");

                        var cursoAnterior = $(".container-curso").last();

                        $(cards).hide().insertAfter(cursoAnterior).fadeIn(200);

                    });

                },
                error: function(data) {
                    console.log(data);
                },
                failure: function(data) {
                    console.log(data);
                },
            });
        });

        var totalPayPal = $("#paypalPayment").data("paypal");
        var totalTarjeta = $("#cardPayment").data("tarjeta");
        var students = $("#courseStudents").data("students");
        var ctx = $('#formaDePago');
        var ctp = $('#students');
        var cts = $('#studentsByCourse');

        $('#courseInfo').click((element) => {

            $('#courseInfo').removeClass('btn-inactive-color');
            $('#courseInfo').addClass('btn-active-color');
            $('#courseLevels').removeClass('btn-active-color');
            $('#courseLevels').addClass('btn-inactive-color');


        });

        $('#courseLevels').click((element) => {
            $('#courseLevels').removeClass('btn-inactive-color');
            $('#courseLevels').addClass('btn-active-color');
            $('#courseInfo').removeClass('btn-active-color');
            $('#courseInfo').addClass('btn-inactive-color');
        });
        let paypalAmount = (Math.round(totalPayPal * 100) / 100).toFixed(2);
        let cardAmount = (Math.round(totalTarjeta * 100) / 100).toFixed(2);
        var myChart = new Chart(ctx, {
            type: 'bar', //'doughnut''pie',
            data: {
                labels: ['PayPal', 'Tarjeta'],
                datasets: [{
                    label: "MX$",
                    data: [paypalAmount, cardAmount],
                    backgroundColor: [
                        'rgba(20, 99, 220, 0.7)',
                        'rgba(54, 162, 20, 0.7)',
                    ],
                    borderColor: [
                        'rgba(20, 99, 220, 0.7)',
                        'rgba(54, 162, 20, 0.7)',
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: false,
            }
        });

        var courseNames = [];
        var courseStudents = [];
        var courseColor = [];
        students.forEach((course) => {

            let r = Math.floor((Math.random() * 255) + 1);
            let g = Math.floor((Math.random() * 255) + 1);
            let b = Math.floor((Math.random() * 255) + 1);
            courseNames.push(course.TituloCurso);
            courseStudents.push(course.CantidadAlumnos);
            courseColor.push(`rgba(${r}, ${g}, ${b}, 0.4)`);
        });


        var myChart = new Chart(ctp, {
            type: 'pie', //'doughnut''pie',
            data: {
                labels: courseNames,
                datasets: [{
                    label: 'Total de estudiantes',
                    data: courseStudents,
                    backgroundColor: courseColor,
                    borderColor: [
                        'rgba(0, 0, 0, 0)',
                    ],
                    borderWidth: 1
                }]
            },

        });




    });
</script>