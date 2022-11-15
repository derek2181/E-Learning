$( document ).ready(function() {

$('#like-button').click(()=>{

  
        $('#like-button').addClass('liked')
       $('#dislike-button').removeClass('disliked');
    
});
$('#dislike-button').click(()=>{

   
        $('#dislike-button').addClass('disliked')
       $('#like-button').removeClass('liked');
    
});

$('#courseInfo').click((element)=>{
       
        $('#courseInfo').removeClass('btn-inactive-color');
        $('#courseInfo').addClass('btn-active-color');
        $('#courseLevels').removeClass('btn-active-color');
        $('#courseLevels').addClass('btn-inactive-color');
       $('#courseDocument').addClass('btn-inactive-color')
       $('#courseDocument').removeClass('btn-active-color');
       
    });
    
    $('#courseLevels').click((element)=>{
      
        $('#courseLevels').removeClass('btn-inactive-color');
        $('#courseLevels').addClass('btn-active-color');
        $('#courseInfo').removeClass('btn-active-color');
        $('#courseInfo').addClass('btn-inactive-color');
        $('#courseDocument').addClass('btn-inactive-color')
        $('#courseDocument').removeClass('btn-active-color');
        
       
    });
    $('#courseDocument').click((element)=>{
      
        $('#courseDocument').removeClass('btn-inactive-color');
        $('#courseDocument').addClass('btn-active-color');
        $('#courseInfo').removeClass('btn-active-color');
        $('#courseInfo').addClass('btn-inactive-color');
        $('#courseLevels').addClass('btn-inactive-color')
        $('#courseLevels').removeClass('btn-active-color');
        
       
    });


});