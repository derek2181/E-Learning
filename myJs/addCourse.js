
$( document ).ready(function() {
    $('#levelsCointainer').hide();
    $('#courseInfo').click((element)=>{
       
        $('#courseInfo').removeClass('btn-inactive-color');
        $('#courseInfo').addClass('btn-active-color');
        $('#courseLevels').removeClass('btn-active-color');
        $('#courseLevels').addClass('btn-inactive-color');
        setTimeout(function() {
            $('div#levelsCointainer').fadeOut(0);
           }, 200);
           setTimeout(function() {
            $('div#courseInfoContainer').fadeIn(0);
           }, 200);
       
    });

    $('#courseLevels').click((element)=>{
      
        $('#courseLevels').removeClass('btn-inactive-color');
        $('#courseLevels').addClass('btn-active-color');
        $('#courseInfo').removeClass('btn-active-color');
        $('#courseInfo').addClass('btn-inactive-color');
        setTimeout(function() {
            $('div#courseInfoContainer').fadeOut(0);
           }, 200);

           setTimeout(function() {
            $('div#levelsCointainer').fadeIn(0);
           }, 200);
       
    });

  
    var level=2;

    $('.summernote').summernote({
        toolbar: [
            ['style', ['style']],
            ['font', ['bold', 'underline', 'clear']],
            ['fontname', ['fontname']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['table', ['table']],
            ['insert', ['link', 'picture']]
          ],
      });

    
  $('#addLevelButton').click(()=>{


    var template = 
     "<div id=\"level" +  level + "\" class=\"my-5 py-2\">" + 
     "                        <div class=\"container\">" + 
     "                          <h4 class=\"my-3\">Nivel #<span class=\"levelNumber\">" +  level + "<\/span><\/h4>" + 
     "                          <div class=\"input-group mb-3\">" + 
     "                            <input type=\"text\" placeholder=\"Titulo del nivel\" class=\"form-control w-100 levelTitle\" id=\"levelName"+level+"\" name=\"level-title[]\">" + 
     "                          <\/div>" + 
     "                             <input type=\"checkbox\" class=\"btn-check\" id=\"btncheck1\" autocomplete=\"off\">"+
     "                              <label class=\"btn btn-outline-success\" for=\"btncheck1\">Marcar como nivel gratis</label>"+
     "                        <\/div>" + 
    
     "                        <div class=\"container\" id =\"contenedor-summernote\">" + 
     "                          <h4 class=\"my-3\">" + 
     "                            Vista previa del nivel" + 
     "                          <\/h4>" + 
     "                          <textarea class=\"mb-2 summernote\" id=\"summernote\" name=\"level-content[]\"><\/textarea>                         " + 
     "                          " + 
     "                        <\/div>" + 
     "                        <div class=\"container my-3\">" + 
     "                          <h4 class=\"my-4\">" + 
     "                            Video del nivel" + 
     "                          <\/h4>" + 
     "                          <input type=\"file\" class=\"form-control w-100\" id=\"videoName"+level+"\" name=\"file-nivel-video[]\"></input>" +
     "                        <\/div>" + 
     "                        <div class=\"container my-3\">" + 
     "                          <h4 class=\"my-4\">" + 
     "                            PDF del nivel" + 
     "                          <\/h4>" + 
     "                          <input type=\"file\" class=\"form-control\" name=\"file-nivel-pdf[]\"></input>" +
     "                        <\/div>" + 
     "                        <hr>" + 
     "                      <\/div>";
     

    $("#level-father").append(template);

//    ('#level'+level);

   $('#level'+level).find('.summernote').summernote({
    toolbar: [
        ['style', ['style']],
        ['font', ['bold', 'underline', 'clear']],
        ['fontname', ['fontname']],
        ['color', ['color']],
        ['para', ['ul', 'ol', 'paragraph']],
        ['table', ['table']],
        ['insert', ['link', 'picture']]
      ],
  });
   

  
   level+=1;
  

    
  });

var requiredError=$("<i class='fas fa-exclamation-circle'></i>Ingrese algo en este campo");
var successName=true;
var successDescription=true;
$('#agregarNombreCategoria').on('input propertychange',()=>{

    var input=$('#agregarNombreCategoria').val().length;

    if(input>40){
        console.log(input);
        if($('#error-name-container').html()==''){
            $('#error-name-container').append("<i class='fas fa-exclamation-circle '></i>Ingrese menos de 40 caracteres");
        }
        successName=false;
    }else{
        $('#error-name-container').html('');     
        successName=true;
    }
});

$('#agregarDescCategoria').bind('input propertychange', function() {

    var input=$('#agregarDescCategoria').val().length;

    if(input>300){
        console.log(input);
        if($("#error-description-container").html()==''){
            $("#error-description-container").append("<i class='fas fa-exclamation-circle'></i>Ingrese menos de 300 caracteres");
        }
        successDescription=false;
    }else{
        $("#error-description-container").html('');     
        successDescription=true;
    }
});


//     $('#createCategory').click(function (e) {
//     e.preventDefault();
//     var categoryName=$('#agregarNombreCategoria');
//     var categoryDescription=$('#agregarDescCategoria');
  
//     if(categoryName.val()==''){
//         if($('#error-name-container').html()==''){
//         $('#error-name-container').append("<i class='fas fa-exclamation-circle '></i>Este campo es obligatorio");
//         }
//         successName=false;
//     }
//     if(categoryDescription.val()==''){
//         if($("#error-description-container").html()==''){
//         $("#error-description-container").append("<i class='fas fa-exclamation-circle'></i>Este campo es obligatorio");
//         }
//         successDescription=false;
//     }
//     if(successName && successDescription){
    
//     var nombre=categoryName.val();
//     var descripcion=categoryDescription.val();
//     $.ajax({
//             url: '/',
//             type: 'post',
//             data: {
//                    tituloCategoria:nombre,
//                    descripcionCategoria:descripcion
//             },
//             dataType: 'json',
//             success: function (data) {
//                 $('#category_select').tokenize2().trigger("tokenize:tokens:add",[data.IdCategoria,data.TituloCategoria,true]);
//             },
//             error: function (data) {
//                     console.log(data);
//             },
//             failure: function (data) {
//                     console.log(data);
//             },
            
//     });
// }
// });

$('#image-course').change(function() {
    var input = document.getElementById("image-course");
    var fReader = new FileReader();
    fReader.readAsDataURL(input.files[0]);
    fReader.onloadend = function(event){
       
        var img = document.getElementById("imagetag");
        img.src = event.target.result;
    }

});
});
