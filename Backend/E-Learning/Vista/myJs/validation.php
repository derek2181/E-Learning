<script>

$( document ).ready(function() {

    $.validator.addMethod('tokenize', function (value, element){   
     
        if ($("#"+element.attr('id')).val() != null && ($("#"+element.attr('id')).val() != ""))
        // if ($("#category_select").val() != null && ($("#category_select").val() != ""))
        { 
          $(".has-error").removeClass("has-error") 
          $("#tokenize_demo-error").css("display", "none");    
          return true;
        }
        else
        {  
          return false;
        };
      },"Iianda");   
$.validator.addMethod('strongPassword',function(value,element){
return this.optional(element) || value.length>=8 &&  value.length<=15 && value.indexOf(" ") < 0
&& /^.*(?=.{8,})(?=.*[a-z])(?=.*[A-Z])(?=.*[\d])(?=.*[\W_]).*$/.test(value);
}, "<i class='fas fa-exclamation-circle'></i> La contraseña no puede contener espacios, debe contener entre 8-15 caracteres, una mayuscula, un digito y un caracter especial");

$.validator.addMethod("roles", function(value, elem, param) {
    return $(".roles:checkbox:checked").length > 0;
 },"You must select at least one!");

$.validator.addMethod("SoloLetras", function(value, element) {

    return this.optional(element) || /^[ñÑa-zA-ZÀ-ÿ\s]+$/i.test(value);
  }, "<i class='fas fa-exclamation-circle'></i> El campo solo debe contener letras");


  $.validator.addMethod("FormatDate", function(value, element) {
    let currentTime = new Date(); 
    let valueDate = new Date(value + " 00:00:00");
    return this.optional(element) || valueDate.getTime() < currentTime.getTime();
   }, "<i class='fas fa-exclamation-circle'></i> Escoja una fecha pasada");

   $.validator.addMethod('SelectValidation', function (value) {
    return (value != '0');
    }, "<i class='fas fa-exclamation-circle'></i> Selecciona un género");

    $('#login_form').validate({
        errorClass:'text-danger',
        highlight: function(element){
            $(element).closest('input').addClass('border-danger');
            $(element).closest('select').addClass('border-danger');
            $(element).closest('label.error').addClass('text-danger');
        },
        unhighlight: function(element){
            $(element).closest('input').removeClass('border-danger');
            $(element).closest('select').removeClass('border-danger');
            
        },
        success:function(element){
            $(element).closest('input').addClass('border-success');
            $(element).closest('select').addClass('border-success');
        
        },
        rules:{
        email:{
        required:true,
        email:true
        },
        password:{
        required:true,
            
            
          
        
        },
    },
        messages:{
            email:{
                required:"<i class='fas fa-exclamation-circle'></i> Por favor ingresa un email",
                email:"<i class='fas fa-exclamation-circle'></i> Por favor ingresa un correo valido"
            },
            password:{
                required:"<i class='fas fa-exclamation-circle'></i> Ingresa una contraseña",
                
            },
           
        },
        
        
            });

  var formaPago= $(".paypal-button.paypal-button-number-0");
  var container=$('#paypal-button-container');
  var price=container.data('price');
  var idContainer=$('#courseID');
  var id=idContainer.data('courseid');
  var metodoPago=formaPago.data('funding-source');

$("#creditcardform").validate({
    debug:false,
    submitHandler: 
        function() 
        {     
                        
            $.ajax({
                url: '<?php echo Template::Route(ComprasController::ROUTE, ComprasController::REALIZAR_COMPRA_TARJETA); ?>',
                type: 'post',
                
                data: {
                idcurso:id,
                price:price
                },
                dataType: 'json',
                success: function (data) {
                $('#exampleModal').modal('show');
                setTimeout(()=>{
                window.location='<?php echo Template::Route(InicioController::ROUTE, null); ?>';
                },2000)
                

                },
                error: function (data) {
                        console.log("Error");
                },
                failure: function (data) {
                        console.log("Failure");
                },
                
            });
        },
    errorClass:'text-danger',
    rules:{
        cvc:{
            required:true,
            minlength:3
        },
        expiry:{
            required:true
        },
        number:{
            required:true,
            minlength:19
        },
        name:{
            required:true
        }

    },
    messages:{
        number:{
            
            required:"<i class='fas fa-exclamation-circle'></i>  Ingresa el número de la tarjeta",
            minlength:"<i class='fas fa-exclamation-circle'></i>  Ingresa 16 numeros"
        },
        expiry:{
            required:"<i class='fas fa-exclamation-circle'></i>  Ingresa la fecha de expiración"
        },
        name:{
            required:"<i class='fas fa-exclamation-circle'></i>  Ingresa el nombre"
        },
        cvc:{
            required:"<i class='fas fa-exclamation-circle'></i>  Ingresa la clave",
            minlength:"<i class='fas fa-exclamation-circle'></i>  Ingresa 3 numeros"
        }
    }

});
$('#rol_form').validate({


    errorPlacement: function(error, element) {
        
        error.appendTo('#error_placement_rol');  
            
    },

    
    rules:{
        Rol:{
            required:true
        }

    },
    messages:{
        Rol:{
            required:"<i class='fas fa-exclamation-circle'></i>  Selecciona un rol"
        }
    }
    
});            
$('#edit_password_form').validate({
    
    errorClass:'text-danger',
    highlight: function(element){
        $(element).closest('input').addClass('border-danger');
        $(element).closest('select').addClass('border-danger');
        $(element).closest('label.error').addClass('text-danger');
    },
    unhighlight: function(element){
        $(element).closest('input').removeClass('border-danger');
        $(element).closest('select').removeClass('border-danger');
      
    },
    success:function(element){
        $(element).closest('input').addClass('border-success');
        $(element).closest('select').addClass('border-success');
    
    },
rules:{
    actualPassword:{
    required:true,
    },
    
    newPassword:{
        required:true,
        SoloLetras:true
    },
    firstlastname:{
        required:true,
        SoloLetras:true
    },

    newPassword:{
        required:true,
        strongPassword:true
    },
    confirmPassword:{
        equalTo:"#newPassword"
    },
    

},

messages:{
    actualPassword:{
        required:"<i class='fas fa-exclamation-circle'></i> Ingresa tu contraseña",
      
    },
    newPassword:{
        required:"<i class='fas fa-exclamation-circle'></i> Ingresa una contraseña",
      
    },
    confirmPassword:{
        equalTo:"<i class='fas fa-exclamation-circle'></i> Ingresa la misma contraseña"
    }
    
},
})            
$('#edit_form').validate({
    
    errorPlacement: function(error, element) {
       
        if (element.attr("name") === "rolUsuario" ){
            console.log(element.attr("name"));
            error.appendTo('#error_check');  
        
        }  else{
            error.insertAfter(element);
        }
            
    },
    errorClass:'text-danger',
    highlight: function(element){
        $(element).closest('input').addClass('border-danger');
        $(element).closest('select').addClass('border-danger');
        $(element).closest('label.error').addClass('text-danger');
    },
    unhighlight: function(element){
        $(element).closest('input').removeClass('border-danger');
        $(element).closest('select').removeClass('border-danger');
      
    },
    success:function(element){
        $(element).closest('input').addClass('border-success');
        $(element).closest('select').addClass('border-success');
    
    },
rules:{
   
    name:{
        required:true,
        SoloLetras:true
    },
    firstlastname:{
        required:true,
        SoloLetras:true
    },
    secondlastname:{
        required:true,
        SoloLetras:true
    },
    birthday:{
        required:true,
        FormatDate:true
    },
    gender:{
        SelectValidation:true
    },
    rolUsuario:{
        required:true,

    }

},

messages:{
    password:{
        required:"<i class='fas fa-exclamation-circle'></i> Ingresa una contraseña",
        
    },
    name:{
        required:"<i class='fas fa-exclamation-circle'></i> Por favor ingresa el nombre"
    },
    firstlastname:{
        required:"<i class='fas fa-exclamation-circle'></i> Por favor ingresa el apellido paterno"
    },
    secondlastname:{
        required:"<i class='fas fa-exclamation-circle'></i> Por favor ingresa el apellido materno"
    },
  
    birthday:{
        required:"<i class='fas fa-exclamation-circle'></i> Debes ingresar una fecha",
    },
    gender:{
        required:"<i class='fas fa-exclamation-circle'></i> Seleccione un genero"
    },
    rolUsuario:{
        required:"<i class='fas fa-exclamation-circle'></i> Selecciona un rol "
    }
},


    });
    $('#review_form').validate({

        errorPlacement: function(error, element) {
           
            if (element.attr("name") === "option"  ){
    
               
    
                
                
                    error.appendTo('#error-container');  
              
                error.appendTo('#error-container');  
            
            }  else{
                error.appendTo('#error-container'); 
            }
                
        },
        errorClass:'text-danger',
        highlight: function(element){
            $(element).closest('textarea').addClass('border-danger');
            
        },
        unhighlight: function(element){
            $(element).closest('textarea').addClass('border-danger');
    
          
        },
        success:function(element){
            $(element).closest('textarea').addClass('border-success');
    
        
        },
    rules:{
        comment:{
        required:true
        },
       
       option:{
           required:true
       },
        
       
    },
    
    messages:{
      
        comment:{
            required:"<i class='fas fa-exclamation-circle'></i> Necesitas añadir un comentario",
        },
        option:{
            required:"<i class='fas fa-exclamation-circle'></i> Necesitas dar me gusta o no me gusta en tu comentario"
        }
    },
    
    
    });
    
            $('#register_form').validate({
    
                errorPlacement: function(error, element) {
                   
                    if (element.attr("name") === "rolUsuario[]" ){
                        console.log(element.attr("name"));
                        error.appendTo('#error_check');  
                    
                    }  else{
                        error.insertAfter(element);
                    }
                        
                },
                errorClass:'text-danger',
                highlight: function(element){
                    $(element).closest('input').addClass('border-danger');
                    
                    $(element).closest('select').addClass('border-danger');
                    $(element).closest('label.error').addClass('text-danger');
                },
                unhighlight: function(element){
                    $(element).closest('input').removeClass('border-danger');
                    $(element).closest('select').removeClass('border-danger');
                  
                },
                success:function(element){
                    $(element).closest('input').addClass('border-success');
                    $(element).closest('select').addClass('border-success');
                
                },
                rules:{
                email:{
                required:true,
                email:true,
                remote: {
                    url: "<?php echo Template::Route(UsuariosController::ROUTE, UsuariosController::VALIDACION_EMAIL); ?>",
                    type: "post",
                    data: {
                      email: function() {
                        return $( "#exampleInputEmail1" ).val();
                      }
                    }
                  }
                },
            
                password:{
                required:true,
                strongPassword:true
                },
                confirmarContrasena:{
                required:true,
                equalTo:"#contrasena"
                },
                name:{
                    required:true,
                    SoloLetras:true
                },
                firstlastname:{
                    required:true,
                    SoloLetras:true
                },
                secondlastname:{
                    required:true,
                    SoloLetras:true
                },
                birthday:{
                    required:true,
                    FormatDate:true
                },
                gender:{
                    SelectValidation:true
                },
                "rolUsuario[]":{
                    required:true,
            
                }
            
            },
            
            messages:{
                email:{
                    required:"<i class='fas fa-exclamation-circle'></i> Por favor ingresa un email",
                    email:"<i class='fas fa-exclamation-circle'></i> Por favor ingresa un correo valido",
                    remote:"<i class='fas fa-exclamation-circle'></i> Este correo ya está en uso"
                },
                password:{
                    required:"<i class='fas fa-exclamation-circle'></i> Ingresa una contraseña",
                    
                },
                name:{
                    required:"<i class='fas fa-exclamation-circle'></i> Por favor ingresa el nombre"
                },
                firstlastname:{
                    required:"<i class='fas fa-exclamation-circle'></i> Por favor ingresa el apellido paterno"
                },
                secondlastname:{
                    required:"<i class='fas fa-exclamation-circle'></i> Por favor ingresa el apellido materno"
                },
                confirmarContrasena:{
                    required:"<i class='fas fa-exclamation-circle'></i> Necesitas confirmar la contraseña",
                
                    equalTo:"<i class='fas fa-exclamation-circle'></i> Ingresa la misma contraseña"
                },
                birthday:{
                    required:"<i class='fas fa-exclamation-circle'></i> Debes ingresar una fecha",
                },
                gender:{
                    required:"<i class='fas fa-exclamation-circle'></i> Seleccione un genero"
                },
                "rolUsuario[]":{
                    required:"<i class='fas fa-exclamation-circle'></i> Selecciona un rol "
                }
            },
            
            
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
    $('#editar-Curso-Niveles').validate({
        ignore: [],
        keyup:false,
        errorPlacement: function(error, element) {
           
        
                error.insertAfter(element);
            // }
                
        },
        errorClass:'text-danger',
        highlight: function(element){
            $(element).closest('input').addClass('border-danger');
            $(element).closest('select').addClass('border-danger');
            $(element).closest('label.error').addClass('text-danger');
        },
        unhighlight: function(element){
            $(element).closest('input').removeClass('border-danger');
            $(element).closest('select').removeClass('border-danger');
          
        },
        success:function(element){
            $(element).closest('input').addClass('border-success');
            $(element).closest('select').addClass('border-success');
        
        },
    rules:{
        title:{
        required:true,
        maxlength:40
        },
        
        description:{
        required:true,
        maxlength:200
        },
    
        "category-select[]":{
            required:true,
            // tokenize:true
            
        },
       
        "level-title[]":{
            required:true,
           
        },
       
        "course-price":{
            required:true,
            number: true
        },

    
    },
    
    messages:{
        title:{
            required:"<i class='fas fa-exclamation-circle'></i> Por favor ingresa un titulo",
            maxlength:"<i class='fas fa-exclamation-circle'></i> Solo se permiten 40 caracteres"
            },
            
            description:{
                required:"<i class='fas fa-exclamation-circle'></i> Por favor ingresa una descripción",
                maxlength:"<i class='fas fa-exclamation-circle'></i> Solo se permiten 200 caracteres"
            },
        
            "category-select[]":{
                required:"<i class='fas fa-exclamation-circle'></i> Por favor ingresa al menos una categoria",
               
                
            },
            // "file-curso-imagen":{
            //     required:"<i class='fas fa-exclamation-circle'></i> Por favor ingresa una imagen"
            
            // },
            "level-title[]":{
                required:"<i class='fas fa-exclamation-circle'></i> Por favor ingresa un titulo para el nivel"
            },
            "level-content[]":{
                required:"<i class='fas fa-exclamation-circle'></i> Por favo",
               
            },
            "file-nivel-video[]":{
                required:"<i class='fas fa-exclamation-circle'></i> Por favor ingrese el video de su nivel",
                extension:"<i class='fas fa-exclamation-circle'></i> Formato invalido, los formatos validos son: mp4,avi,mkv,mov "
            },
            "file-nivel-pdf[]":{
                required:true,
        
            },
            "course-price":{
                required:"<i class='fas fa-exclamation-circle'></i> Por favor ingresa un precio para el curso",
                number:"<i class='fas fa-exclamation-circle'></i> Por favor ingresa un número valido"
            }
    },
    
      
      
        });
    $('#crear-Curso-Niveles').validate({
  
        ignore: [],
        keyup:false,
        errorPlacement: function(error, element) {
           
        
                error.insertAfter(element);
            // }
                
        },
        errorClass:'text-danger',
        highlight: function(element){
            $(element).closest('input').addClass('border-danger');
            $(element).closest('select').addClass('border-danger');
            $(element).closest('label.error').addClass('text-danger');
        },
        unhighlight: function(element){
            $(element).closest('input').removeClass('border-danger');
            $(element).closest('select').removeClass('border-danger');
          
        },
        success:function(element){
            $(element).closest('input').addClass('border-success');
            $(element).closest('select').addClass('border-success');
        
        },
    rules:{
        title:{
        required:true,
        maxlength:40
        },
        
        description:{
        required:true,
        maxlength:200
        },
    
        "category-select[]":{
            required:true,
            // tokenize:true
            
        },
        "file-curso-imagen[]":{
            required:true,
            extension: "jpg,jpeg,png"
        },
        "level-title[]":{
            required:true,
           
        },
        // "level-content[]":{ No necesariamente necesita agregar vista previa al nivel
        //     required:true,
           
        // },
        "course-price":{
            required:true,
            number: true
        },
        "file-nivel-video[]":{
            required:true,
            extension: "mp4,avi,mkv,mov"
        },
        // "file-nivel-pdf[]":{ //No se si deba tener pdf
        //     required:true,
    
        // }
    
    },
    
    messages:{
        title:{
            required:"<i class='fas fa-exclamation-circle'></i> Por favor ingresa un titulo",
            maxlength:"<i class='fas fa-exclamation-circle'></i> Solo se permiten 40 caracteres"
            },
            
            description:{
                required:"<i class='fas fa-exclamation-circle'></i> Por favor ingresa una descripción",
                maxlength:"<i class='fas fa-exclamation-circle'></i> Solo se permiten 200 caracteres"
            },
        
            "category-select[]":{
                required:"<i class='fas fa-exclamation-circle'></i> Por favor ingresa al menos una categoria",
               
                
            },
            "file-curso-imagen[]":{
                required:"<i class='fas fa-exclamation-circle'></i> Por favor ingresa una imagen",
                extension:"<i class='fas fa-exclamation-circle'></i> Formato invalido, los formatos validos son: jpg, png, jpeg"
            
            },
            "level-title[]":{
                required:"<i class='fas fa-exclamation-circle'></i> Por favor ingresa un titulo para el nivel"
            },
            "level-content[]":{
                required:"<i class='fas fa-exclamation-circle'></i> Por favo",
               
            },
            "file-nivel-video[]":{
                required:"<i class='fas fa-exclamation-circle'></i> Por favor ingrese el video de su nivel",
                extension:"<i class='fas fa-exclamation-circle'></i> Formato invalido, los formatos validos son: mp4,avi,mkv,mov "
            },
            "file-nivel-pdf[]":{
                required:true,
        
            },
            "course-price":{
                required:"<i class='fas fa-exclamation-circle'></i> Por favor ingresa un precio para el curso",
                number:"<i class='fas fa-exclamation-circle'></i> Por favor ingresa un número valido"
            }
    },
    
    
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

$('#form-crear-categoria').validate({
  
    ignore: [],
    keyup:false,
    errorPlacement: function(error, element) {
       
        // if (element.attr("name") === "category-select[]" ){
        //  alert("AA");
        
        // }  else{
           
            error.insertAfter(element);
        // }
            
    },
    errorClass:'text-danger',
    highlight: function(element){
        $(element).closest('input').addClass('border-danger');
        $(element).closest('select').addClass('border-danger');
        $(element).closest('label.error').addClass('text-danger');
    },
    unhighlight: function(element){
        $(element).closest('input').removeClass('border-danger');
        $(element).closest('select').removeClass('border-danger');
      
    },
    success:function(element){
        $(element).closest('input').addClass('border-success');
        $(element).closest('select').addClass('border-success');
    
    },
rules:{
    "category-title":{
    required:true,
    maxlength:15
    },
    
    "category-description":{
    required:true,
    maxlength:200
    }

},

messages:{
    "category-title":{
        required:"<i class='fas fa-exclamation-circle'></i> Por favor ingresa un titulo",
        maxlength:"<i class='fas fa-exclamation-circle'></i> Solo se permiten 15 caracteres",
        },
        
        "category-description":{
            required:"<i class='fas fa-exclamation-circle'></i> Por favor ingresa una descripción",
        maxlength:"<i class='fas fa-exclamation-circle'></i> Solo se permiten 200 caracteres"
        },
        
    
},


    });


});

</script>