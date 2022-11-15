// $('#fecha_inicio').datepicker();
(function(factory) {
    if (typeof define === "function" && define.amd) {

        // AMD. Register as an anonymous module.
        define(["../widgets/datepicker"], factory);
    } else {

        // Browser globals
        factory(jQuery.datepicker);
    }
}(function(datepicker) {

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
    maxDate: new Date(), //Crea la instancia de una fecha con el dia de hoy
    setDate: new Date(),
    // onSelect: function() {
       
    // },

}).datepicker("setDate", new Date());

$("#fecha_fin").datepicker({
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
    maxDate: new Date(), //Crea la instancia de una fecha con el dia de hoy
    setDate: new Date(),
    // onSelect: function() {
    //     $('.modal-bg').hide();
    // },

}).datepicker("setDate", new Date());



// $('#fecha_fin').datepicker();