<script>

$( document ).ready(function() {

    
   console.log ($('#form_success_message').val());

if($('#form_success_message').val()==1){
    $('#success-dialog').css("display","block");
    setTimeout(function() {
        $('#success-dialog').fadeOut("slow");
       }, 2000);
}
   
 if($('#pass_success_message').val()==1){
    $('#error-dialog').css("display","block");
    setTimeout(function() {
        $('#error-dialog').fadeOut("slow");
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

</script>