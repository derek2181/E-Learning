$(function(){
  $("#navbarPage").load("navbar.jsp"); 
});

jQuery.validator.addMethod("lettersonly", function(value, element) {
return this.optional(element) || /^[ñÑa-zA-ZÀ-ÿ\s]+$/i.test(value);
}, "Letters only please");

jQuery.validator.addMethod("complexpassword", function(value, element) {
return this.optional(element) || /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/.test(value);
}, "Bad password format");

jQuery.validator.addMethod("lessThan", function(value, element) {
let currentTime = new Date(); 
let valueDate = new Date(value + " 00:00:00");
//  let valueDay = valueDate.getUTCDate();
//  let valueMonth = valueDate.getUTCMonth();
//  let valueYear = valueDate.getUTCFullYear();
//  let valueDateUTC = new Date(valueYear, valueMonth, valueDay);
//  console.log(currentTime);
//  console.log(value);
//  console.log(valueDate);
//  console.log(valueDate.getTime());
//  console.log(currentTime.getTime());
//  console.log(valueDateUTC);
return this.optional(element) || valueDate.getTime() < currentTime.getTime();
}, "Date is greater than today");


jQuery.validator.methods.email = function( value, element ) {
return this.optional(element) || /^([a-zA-Z0-9_]+(?:[.-]?[a-zA-Z0-9]+)*@[a-zA-Z0-9]+(?:[.-]?[a-zA-Z0-9]+)*\.[a-zA-Z]{2,7})$/.test(value);
}

var reader = new FileReader();
var readerSignup = new FileReader();

reader.onload = function (e) {
$("#img").attr("src", e.target.result);
}

readerSignup.onload = function (e) {
$("#img_user").attr("src", e.target.result);
}

function readURL(input) {
if (input.files && input.files[0]) {
    reader.readAsDataURL(input.files[0]);
}
}

function readURLSignup(input) {
if (input.files && input.files[0]) {
  readerSignup.readAsDataURL(input.files[0]);
}
}

/* Validations */

$(document).ready(function(){
    let usuarioIncorrecto = $("#usuarioIncorrecto").val();
    if(usuarioIncorrecto == "true"){
      $("#pass_form").after("<label class='login-error'> Su usuario y/o contraseña son incorrectos.</label>");
    }

    let usernameEncontrado = $("#usernameEncontrado").val();
    if(usernameEncontrado == "true"){
      $("#username").after("<label class='signup-error'>El nombre de usuario ingresado ya esta en uso</label>");
    }

    $("#btn_delete-image").click(function(){
      $("#img").hide();
      $("#delete-image").val("1");
    });

    $("#upload-image").click(function(){
      $("#delete-image").val("0");
    });

    $("#upload").change(function() { 
        readURL(this);
        $("#img").show();
    });

    $("#imagen-edit").change(function() { 
      readURLSignup(this);
    });

    $("#imagen").change(function() { 
      readURLSignup(this);
    });

    $("#btn-erase").click(function () { 
    
        $.sweetModal({
          content: '¿Estás seguro de borrar esta publicación?',
          theme: $.sweetModal.THEME_DARK,
          buttons: {

            Conservar: {
              label: 'No eliminar',
              classes: 'greenB bordered flat'
            },
            Eliminar: {
              label: 'Eliminar',
              classes: 'redB bordered flat',
              action: function() {
                var form = $("#form-erase");
                $(form).submit();
              }
            }
          }
        })
    });

  /* ------------------- Login ------------------ 
  Este se puede encapsular en una funcion, checar */
  $("#button_main-container").click(function() {
      $("#rightside-form").validate({
        errorClass: "login-error",
        rules: {
          user: {
            required: true,
          },
          password:{
            required: true,
          }

        },
        messages: {
          user:{
            required: "Por favor ingrese un usuario",
          },
          password:{
            required: "Por favor ingrese su contrasena"
          }
        }
      });
  });

   /* ------------- Sign up ---------------------- 
  Este se puede encapsular en una funcion, checar */
  $("#button-signup_main-container").click(function(){
    $("#form_main-container").validate({ 
      ignore: ".ignore",
      errorClass: "signup-error",
      rules: {
        imagen: {
          required: true,
        },
        name: {
          required: true,
          lettersonly: true
        },
        lastnameP: {
          required: true,
          lettersonly: true
        },
        lastnameM: {
        required: false,
          lettersonly: true
        },
        birthday:{
          required: true,
          lessThan: true,
        },
        email: {
          required: true,
          email: true
        },
        password: {
          required:  true,
          complexpassword: true
        },
        passconfirm: {
          required:  true,
          equalTo: "#password"
        }
      },
      messages: {
        imagen: {
          required: "Porfavor añada una imagen."
        },
        name: {
          required: "Por favor ingrese sus nombres.",
          lettersonly: "Solo se permiten usar caracteres."
        },
        lastnameP: {
          required: "Por favor ingrese su apellido Paterno.",
          lettersonly: "Solo se permiten usar caracteres."
        },
        lastnameM: {
          lettersonly: "Solo se permiten usar caracteres."
        },
        birthday: {
          required: "Por favor ingrese una fecha de nacimiento",
          lessThan: "La fecha debe ser menor a la de hoy"
        },
        email: {
          required: "Por favor ingrese un correo electronico",
          email: "Por favor ingrese un formato correcto"
        },
        username: {
          required: "Por favor ingrese un nombre de usuario"
        },
        password: {
          required: "Por favor ingrese una contraseña",
          complexpassword: "La contraseña debe llevar por lo menos 8 caracteres, una letra mayúscula, una minúscula, un número y un signo de puntuacion."
        },
        passconfirm: {
          required: "Por favor confirme su contraseña",
          equalTo: "Su contraseña debe coincidir"
        }
      },

      errorPlacement:  function(error, element) {
        if (element.attr("name") == "imagen")
        {
            error.insertAfter("#user_main-container");
        }
        else{
            error.insertAfter(element);
        }
      }

     });
  });

  /* ----------------- Edit ------------------------ 
  Este se puede encapsular en una funcion, checar */
  $("#button-edit_main-container").click(function(){
    $("#form_main-container").validate({ 
      ignore: ".ignore",
      errorClass: "edit-error",
      rules: {
        name: {
          required: true,
          lettersonly: true
        },
        lastnameP: {
          required: true,
          lettersonly: true
        },
        lastnameM: {
          required: false,
          lettersonly: true
        },
        birthday:{
          required: true,
          date: true
        },
        email: {
          required: true,
          email: true
        },
        password: {
          required:  true
        }
      },
      messages: {
        name: {
          required: "Por favor ingrese sus nombres.",
          lettersonly: "Solo se permiten usar caracteres."
        },
        lastnameP: {
          required: "Por favor ingrese su apellido Paterno.",
          lettersonly: "Solo se permiten usar caracteres."
        },
        lastnameM: {
          lettersonly: "Solo se permiten usar caracteres."
        },
        birthday: {
          required: "Por favor ingrese una fecha de nacimiento"
        },
        email: {
          required: "Por favor ingrese un correo electronico",
          email: "Por favor ingrese un formato correcto"
        },
        username: {
          required: "Por favor ingrese un nombre de usuario"
        },
        password: {
          required: "Por favor ingrese una contrasena"
        }

      }

     });
  });
  
  /* ----------------- Question ------------------------ 
  Este se puede encapsular en una funcion, checar */
  $("#button_ask").click(function(){
    $("#form-container_question").validate({ 
      ignore: ".ignore",
      errorClass: "question-error",
      rules: {
        question: {
          required: true
        },
        /*category: { checar si afecta el select
          required: true 
        }*/
      },
      messages: {
        question: {
          required: "Por favor ingrese su pregunta."
        },
        /*category: {
          required: "Por favor ingrese alguna categoria."
        }*/
      }
     });
  });

  /* ----------------- Answer ------------------------ 
  Este se puede encapsular en una funcion, checar */
  $("#button_answer").click(function(){
    $("#form-container_answer").validate({ 
      ignore: ".ignore",
      errorClass: "answer-error",
      rules: {
        answer: {
          required: true
        },
      },
      messages: {
        answer: {
          required: "Por favor ingrese su respuesta."
        }
      }
     });
  });
  

});

