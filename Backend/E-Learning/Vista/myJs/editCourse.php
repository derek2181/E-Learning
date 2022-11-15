<script>
    $( document ).ready(function() {
    $('#image_error_message').hide();
    $(".video-error-message").hide();
    $(".pdf-error-message").hide();
    var canAccessControllerImage=true;
    var canAccessControllerVideos=true;
    var canAccessControllerPDF=true;

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
   
    let summernotes=$('.summernote');
    let summernotesContent=$('.summernote-content').toArray();
    
    for ( var i = 0; i < summernotesContent.length; i++ ) {
        $('.summernote').eq(i).summernote('code',summernotesContent[i].value)
    
    }
  


// $.each((summernotesContent,(summernoteDOM,index)=>{
//     $('#level'+index).find('.summernote').summernote('code',summernoteDOM.val());
// }));
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
var categorias=JSON.parse($('#courseCategories').val());
categorias.forEach((categoria)=>{
    $('#category_select').tokenize2().trigger("tokenize:tokens:add",[categoria.IdCategoria,categoria.TituloCategoria,true]);    
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


    $('#createCategory').click(function (e) {
    e.preventDefault();
    var categoryName=$('#agregarNombreCategoria');
    var categoryDescription=$('#agregarDescCategoria');
  
    if(categoryName.val()==''){
        if($('#error-name-container').html()==''){
        $('#error-name-container').append("<i class='fas fa-exclamation-circle '></i>Este campo es obligatorio");
        }
        successName=false;
    }
    if(categoryDescription.val()==''){
        if($("#error-description-container").html()==''){
        $("#error-description-container").append("<i class='fas fa-exclamation-circle'></i>Este campo es obligatorio");
        }
        successDescription=false;
    }
    if(successName && successDescription){
    
    var nombre=categoryName.val();
    var descripcion=categoryDescription.val();
    $.ajax({
            url: '<?php echo Template::Route(CategoriasController::ROUTE, CategoriasController::CREAR_CATEGORIAS); ?>',
            type: 'post',
            data: {
                   tituloCategoria:nombre,
                   descripcionCategoria:descripcion
            },
            dataType: 'json',
            success: function (data) {
            
                $('#category_select').tokenize2().trigger("tokenize:tokens:add",[data.IdCategoria,data.TituloCategoria,true]);
          

            },
            error: function (data) {
                    console.log(data);
            },
            failure: function (data) {
                    console.log(data);
            },
            
    });
}
});
function toggleSubmitButton(){
    
 
    if(canAccessControllerImage && canAccessControllerVideos && canAccessControllerPDF){
        $("#submit-form").prop("disabled",false);
    }else if(!canAccessControllerImage || !canAccessControllerVideos || !canAccessControllerPDF) {
        $("#submit-form").prop("disabled",true);
    }
}
function ajaxCallback(element,res,conditional){
    if(res){
        element.fadeOut("fast");
        
        if(conditional=="Imagen"){
            canAccessControllerImage=true
        }else if(conditional=="Video"){
            canAccessControllerVideos=true
        }else if(conditional=="PDF"){
            canAccessControllerPDF=true
        }
    }else{
        element.fadeIn("slow");
        if(conditional=="Imagen"){
            canAccessControllerImage=false;
        }else if(conditional=="Video"){
            canAccessControllerVideos=false;
        }else if(conditional=="PDF"){
            canAccessControllerPDF=false;
        }
    }
}
var myModal = new bootstrap.Modal(document.getElementById('ModalCourseFree'), {
  keyboard: false
});
var myModalCostoCurso = new bootstrap.Modal(document.getElementById('ModalCostoCero'), {
  keyboard: false
});
$(".checkbox-isfree").change(function(){
    if ($('.checkbox-isfree:checked').length == $('.checkbox-isfree').length) {
        myModal.show();
        $("#InputCostoCurso").val("0.00");
    }
});
$("#InputCostoCurso").change(function(){
    var elemento = $(this);
    var CostoCurso = elemento.val();

    if(+CostoCurso == 0){
        myModalCostoCurso.show();
        elemento.val("0.00");
    }
});



$('.close-free-modal').click(()=>{
    myModal.hide();
});
$('.close-costo-curso').click(()=>{
    myModalCostoCurso.hide();
});

$('#image-course').change(function(e) {
    e.preventDefault();
    var input = document.getElementById("image-course");
    var fReader = new FileReader();
    var file = input.files[0];  
   var filename = file.name;
   let errorElement=$('#image_error_message');
    fReader.readAsDataURL(input.files[0]);
    fReader.onloadend = function(event){
       
        var img = document.getElementById("imagetag");
        img.src = event.target.result;
    };
    let extensiones=['jpg','jpeg','png'];
var type="Imagen"
    validateExtensionAjax(errorElement,extensiones,filename,"Imagen");

});


$(document).on("change",".videos", function () {
    var inputElement = $(this);
   var input=document.getElementById(inputElement[0].id);
    var file = input.files[0];
   var filename = file.name;
  $(this).siblings(".videotag").text(filename);
   //$('#videoTag').text(filename);   
   let extensiones=['mp4','mov','mkv'];
   var type="Video";
   errorElement=$(this).siblings(".video-error-message");
   validateExtensionAjax(errorElement,extensiones,filename,"Video");
});

    $(document).on("change",".pdffile", function () {
    var inputElement = $(this);
   var input=document.getElementById(inputElement[0].id);
    var file = input.files[0];
   var filename = file.name;
  $(this).siblings(".pdftag").text(filename);
   //$('#videoTag').text(filename);   
   let extensiones=['pdf'];
   errorElement=$(this).siblings(".pdf-error-message");
   var type="PDF";
   validateExtensionAjax(errorElement,extensiones,filename,"PDF");

});
    


// });




});
</script>