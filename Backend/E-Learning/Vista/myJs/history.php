<script>

$('#courseInfo').click((element)=>{
       
    $('#courseInfo').removeClass('btn-inactive-color');
    $('#courseInfo').addClass('btn-active-color');
    $('#courseLevels').removeClass('btn-active-color');
    $('#courseLevels').addClass('btn-inactive-color');
   
   
});

$('#courseLevels').click((element)=>{
  
    $('#courseLevels').removeClass('btn-inactive-color');
    $('#courseLevels').addClass('btn-active-color');
    $('#courseInfo').removeClass('btn-active-color');
    $('#courseInfo').addClass('btn-inactive-color');
    
});
$('#id-button-ver-mas').click(function (e) {
    e.preventDefault();
    var buttonCargarMas = $(this);
    var varNumeroCurso = buttonCargarMas.val();


    $.ajax({
        url: '<?php echo Template::Route(ComprasController::ROUTE, ComprasController::CARGAR_MIS_CURSOS); ?>',
        type: 'post',
        data: {
            numeroCurso: varNumeroCurso
        },
        dataType: 'json',
        success: function (data) {

            buttonCargarMas.val(+varNumeroCurso + data.length);

            $.each(data, function (key, value) {
                var IdCurso = value.IdCurso;
                var TituloCurso = value.TituloCurso;
                // var DescripcionCurso = value.DescripcionCurso;
                var ImagenCurso = value.ImagenCurso;
                // var FechaCreacionCurso = value.FechaCreacionCurso;
                // var EstadoCurso = value.EstadoCurso;
                // var UsuarioCreador = value.UsuarioCreador;
                var NombreCompletoUsuarioCreador = value.NombreCompletoUsuarioCreador;


                // var ImagenPerfilUsuarioCreador = value.ImagenPerfilUsuarioCreador;

                var ProgresoCursoComprado = value.ProgresoCursoComprado;

                // var PorcentajeCalificacion = value.PorcentajeCalificacion;

                // var CostoCurso = value.CostoCurso;

                // var UsuarioComprador = value.UsuarioComprador;
                // var NumeroCursoPaginacion = value.NumeroCursoPaginacion;
                // var CategoriaFiltro = value.CategoriaFiltro;
                // var FechaDesdeCreacionCurso = value.FechaDesdeCreacionCurso;
                // var FechaHastaCreacionCurso = value.FechaHastaCreacionCurso;


                var cursoHTML = '' +
                    '<div class="card m-2 pt-3 shadow-lg container-curso" style="width: 18rem;">' +
                    '   <img src="data:image/jpeg; base64, ' + ImagenCurso + ' " class="card-img-top img-thumbnail custom-img-card" alt="...">' +
                    '   <div class="card-body">' +
                    '       <h5 class="card-title ">' + TituloCurso + ' </h5>' +
                    '       <h5 href="#" class="tutor-name mb-3 text-cut"><i class="fas fa-graduation-cap"></i>' + NombreCompletoUsuarioCreador + ' <i class="fas fa-graduation-cap"></i></h5>' +
                    '       <div class="progress mt-3">' +
                    '           <div class="progress-bar " role="progressbar" style="width: ' + ProgresoCursoComprado + ' %" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>' +
                    '           <div class="progress-bar bg-danger " role="progressbar" style="width: ' + (100 - + ProgresoCursoComprado) +' %" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>' +
                    '' +
                    '       </div>' +
                    '       <h5 class="progress-bar-text mb-4">Tu progreso: <span>' + ProgresoCursoComprado + ' %</span></h5>' +
                    // TODO: AQUI ESTA HARDCODEADO LA RUTA´, DEBERÍA SER CON PHP
                    '       <a href="<?php echo Template::Route(CursosController::ROUTE, CursosController::MOSTRAR_CURSO); ?>/' + IdCurso + ' " class="btn btn-dark w-100 button-continue-watching">Continuar viendo</a>' +
                    '   </div>' +
                    '</div>' +
                    '';



                var cursos = $(".container-curso");

                var cursoAnterior = $(".container-curso").last();

                $(cursoHTML).hide().insertAfter(cursoAnterior).fadeIn(200);
            });

        },
        error: function (data) {
            console.log("algo no jalo");
            console.log(data.text);
        }
    });
});


</script>