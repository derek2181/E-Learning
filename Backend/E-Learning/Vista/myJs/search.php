<script>

// $('#fecha_inicio').datepicker();
(function (factory) {
    if (typeof define === "function" && define.amd) {

        // AMD. Register as an anonymous module.
        define(["../widgets/datepicker"], factory);
    } else {

        // Browser globals
        factory(jQuery.datepicker);
    }
}(function (datepicker) {

    datepicker.regional.es = {
        closeText: "Cerrar",
        prevText: "&#x3C;Ant",
        nextText: "Sig&#x3E;",
        currentText: "Hoy",
        monthNames: ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio",
            "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"
        ],
        // monthNamesShort: ["ENE", "FEB", "MAR", "ABR", "MAY", "JUN",
        //     "JUL", "AGO", "SEP", "OCT", "NOV", "DIC"
        // ],
        monthNamesShort: ["Ene", "Feb", "Mar", "Abr", "May", "Jun",
            "Jul", "Ago", "Sep", "Oct", "Nov", "Dic"
        ],
        dayNames: ["Domingo", "Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado"],
        dayNamesShort: ["Dom", "Lun", "Mar", "Mié", "Jue", "Vie", "Sáb"],
        dayNamesMin: ["D", "L", "M", "M", "J", "V", "S"],
        weekHeader: "Sm",
        dateFormat: "dd/mm/yy",
        firstDay: 1,
        isRTL: false, //si esta en true el calendario va para atras
        showMonthAfterYear: false,
        yearSuffix: ""
    };
    datepicker.setDefaults(datepicker.regional.es);

    return datepicker.regional.es;

}));

$("#fecha_inicio").datepicker({
    // beforeShow: function(input, inst) {
    //     setTimeout(function() {
    //         inst.dpDiv.css({
    //             zorder:'1',
    //             top: '50%',
    //             left: '50%',
    //             transform: 'translate(-50%, -50% )'

    //         });
    //     }, 0);
    //     $('.modal-bg').show();
    // },
    dateFormat: "d/M/yy",
    minDate: new Date(), //Crea la instancia de una fecha con el dia de hoy
    setDate: new Date(),
    // onSelect: function() {

    // },

}).datepicker("setDate", new Date());

$("#fecha_inicio").datepicker({
    // beforeShow: function(input, inst) {
    //     setTimeout(function() {
    //         inst.dpDiv.css({
    //             zorder:'1',
    //             top: '50%',
    //             left: '50%',
    //             transform: 'translate(-50%, -50% )'

    //         });
    //     }, 0);
    //     $('.modal-bg').show();
    // },
    dateFormat: "d/M/yy",
    minDate: new Date(), //Crea la instancia de una fecha con el dia de hoy
    setDate: new Date(),
    // onSelect: function() {
    //     $('.modal-bg').hide();
    // },

}).datepicker("setDate", new Date());



$('#fecha_fin').datepicker();


$('#id-button-ver-mas').click(function (e) {
    e.preventDefault();
    var buttonCargarMas = $(this);
    var varNumeroCurso = buttonCargarMas.val();

    var IdCategoria = "";
    var NombreUsuario = "";
    var TituloCurso = "";
    var FechaDesde = "";
    var FechaHasta = "";

    var IdCategoria = buttonCargarMas.parent().find("#id-categoria").val();
    var NombreUsuario = buttonCargarMas.parent().find("#nombre-usuario").val();
    var TituloCurso = buttonCargarMas.parent().find("#titulo-curso").val();
    var FechaDesde = buttonCargarMas.parent().find("#fecha-desde").val();
    var FechaHasta = buttonCargarMas.parent().find("#fecha-hasta").val();

    $.ajax({
        url: '<?php echo Template::Route(CursosController::ROUTE, CursosController::CARGAR_CURSOS); ?>',
        type: 'post',
        data: {
            numeroCurso: varNumeroCurso,
            'id-categoria': IdCategoria,
            'nombre-usuario': NombreUsuario,
            'titulo-curso': TituloCurso,
            'fecha-desde': FechaDesde,
            'fecha-hasta': FechaHasta
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
                var PorcentajeCalificacion = value.PorcentajeCalificacion;

                var CostoCurso = value.CostoCurso;

                // var UsuarioComprador = value.UsuarioComprador;
                // var NumeroCursoPaginacion = value.NumeroCursoPaginacion;
                // var CategoriaFiltro = value.CategoriaFiltro;
                // var FechaDesdeCreacionCurso = value.FechaDesdeCreacionCurso;
                // var FechaHastaCreacionCurso = value.FechaHastaCreacionCurso;

                var cursoHTML = '' +
                    '<div class="card shadow-lg  m-2 pt-3 p text-cut container-curso" style="width: 18rem;">' +
                    '    <img src="data:image/jpeg; base64,' + ImagenCurso + '" class="card-img-top img-thumbnail custom-img-card" alt="...">' +
                    '    <div class="card-body">' +
                    '        <h5 class="card-title text-cut">' + TituloCurso + '</h5>' +
                    '        <h5 href="#" class="tutor-name mb-3 text-cut">' +
                    '            <i class="fas fa-graduation-cap"></i>' +
                    '            ' + NombreCompletoUsuarioCreador +
                    '            <i class="fas fa-graduation-cap"></i>' +
                    '        </h5>' +
                    '';


                if (+PorcentajeCalificacion == 0) {
                    cursoHTML += '' +
                        '            <p class="text-break text-wrap">Al ' + PorcentajeCalificacion + '% de las personas les gustó <i class="fas fa-thumbs-up"></i></p>' +
                        '            <div class="progress mt-3">' +
                        '                <div class="progress-bar bg-success" role="progressbar" style="width: ' + PorcentajeCalificacion +'%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>' +
                        '                <div class="progress-bar bg-danger" role="progressbar" style="width: ' + (100 - + PorcentajeCalificacion) + '%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>' +
                        '            </div>';
                } else {
                    cursoHTML += '' +
                        '            <p class="text-break text-wrap">Este curso aun no tiene ningún voto</p>' +
                        '            <div class="progress mt-3">' +
                        '                <div class="progress-bar" role="progressbar" style="width: 0%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>' +
                        '            </div>';
                }

                cursoHTML += '' +
                    '        <div class="row mt-4 ">';


                    if (+CostoCurso == 0) {
                        cursoHTML += '<span class="badge rounded-pill bg-success ms-1 mt-1 mb-2">Gratis</span>';
                    } else {
                        cursoHTML += '<h5 class="text-cut">MX$' + CostoCurso + '</h5>';
                    }                    

                    cursoHTML += '' +    
                    '        </div>' +
                    '        <div class="row">' +
                    '            <a href="<?php echo Template::Route(CursosController::ROUTE, CursosController::MOSTRAR_CURSO); ?>/' + IdCurso + '" class="btn btn-primary p-2 ">Comprar ahora</a>' +
                    '        </div>' +
                    '    </div>' +
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