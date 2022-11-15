<script>

$(document).ready(function () {

        $(".vjs-tech").on("ended", function () {

                var nivelVideo = $(this);

                var varIdNivel = nivelVideo.attr("id-nivel");
                var varIdCurso = nivelVideo.attr("id-curso");

                var varProgressNivel = nivelVideo.attr("progess");

                if (varProgressNivel != 0) {
                        $.ajax({
                                url: '<?php echo Template::Route(CursosController::ROUTE, CursosController::FINALIZAR_NIVEL_CURSO); ?>',
                                type: 'post',
                                data: {
                                        IdNivel: varIdNivel,
                                        IdCurso: varIdCurso,
                                        ProgressNivel: varProgressNivel
                                },
                                dataType: 'json',
                                success: function (data) {
                                        console.log("exito");
                                },
                        });
                }
        });

        $('#courseInfo').click((element) => {

                $('#courseInfo').removeClass('btn-inactive-color');
                $('#courseInfo').addClass('btn-active-color');
                $('#courseLevels').removeClass('btn-active-color');
                $('#courseLevels').addClass('btn-inactive-color');
                $('#courseDocument').addClass('btn-inactive-color')
                $('#courseDocument').removeClass('btn-active-color');

        });

        $('#courseLevels').click((element) => {

                $('#courseLevels').removeClass('btn-inactive-color');
                $('#courseLevels').addClass('btn-active-color');
                $('#courseInfo').removeClass('btn-active-color');
                $('#courseInfo').addClass('btn-inactive-color');
                $('#courseDocument').addClass('btn-inactive-color')
                $('#courseDocument').removeClass('btn-active-color');


        });
        $('#courseDocument').click((element) => {

                $('#courseDocument').removeClass('btn-inactive-color');
                $('#courseDocument').addClass('btn-active-color');
                $('#courseInfo').removeClass('btn-active-color');
                $('#courseInfo').addClass('btn-inactive-color');
                $('#courseLevels').addClass('btn-inactive-color')
                $('#courseLevels').removeClass('btn-active-color');


        });
});


</script>