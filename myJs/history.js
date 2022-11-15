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