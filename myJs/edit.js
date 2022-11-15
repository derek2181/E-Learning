$( document ).ready(function() {

 
if($('#form_success_message').val()==1){
    $('#success-dialog').css("display","block");
    setTimeout(function() {
        $('#success-dialog').fadeOut("slow");
       }, 2000);
}
   

    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
    
            reader.onload = function (e) {
                $('#userImage').attr('src', e.target.result);
            }
    
            reader.readAsDataURL(input.files[0]);
        }
    }
    
    $("#fileImage").change(function(){
        readURL(this);
    });

    
});