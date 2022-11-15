
$( document ).ready(function() {
    $('#pills-reviews').hide();
$('#courseLevels').click((element)=>{
       
    $('#courseLevels').removeClass('btn-inactive-color');
    $('#courseLevels').addClass('btn-active-color');
    $('#courseReviews').removeClass('btn-active-color');
    $('#courseReviews').addClass('btn-inactive-color');
    setTimeout(function() {
        $('div#pills-reviews').fadeOut(0);
       }, 200);
       setTimeout(function() {
        $('div#pills-levels').fadeIn(0);
       }, 200);
   
});

$('#courseReviews').click((element)=>{
  
    $('#courseReviews').removeClass('btn-inactive-color');
    $('#courseReviews').addClass('btn-active-color');
    $('#courseLevels').removeClass('btn-active-color');
    $('#courseLevels').addClass('btn-inactive-color');
    setTimeout(function() {
        $('div#pills-levels').fadeOut(0);
       }, 200);

       setTimeout(function() {
        $('div#pills-reviews').fadeIn(0);
       }, 200);
   
});


});
