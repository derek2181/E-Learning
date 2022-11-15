$('.owl-carousel').owlCarousel({
    loop:true,
    margin:150,
    responsiveClass:true,
    dots:true,
    autoplay:false,
    autoplayTimeout:4000,
    responsive:{
        0:{
            items:1,
           
        },
        600:{
            items:1,
           
        },
        1000:{
            items:5,
            
        }
    }
})


owl.on('mousewheel', '.owl-stage', function (e) {
    if (e.deltaY>0) {
        owl.trigger('next.owl');
    } else {
        owl.trigger('prev.owl');
    }
    e.preventDefault();
});