<script>
function putPopOvers(){
    var popover=document.querySelectorAll('.popover-dismiss');

    [].forEach.call(popover, (e)=>{
        var newPopover = new bootstrap.Popover(e, {
        trigger: 'hover'
       })
      });
}


putPopOvers();

function hidePills(){
    $('#pillsContainer').children().remove();
}
function showNewPills(newPills){
    $('#pillsContainer').append(newPills);

    putPopOvers();
}

$('.owl-carousel').owlCarousel({
    loop:true,
    margin:50,
    responsiveClass:true,
    dots:true,
    autoplay:false,
    autoplayTimeout:4000,
    responsive:{
        0:{
            items:1,
           
        },
        550:{
            items:2,
           
        },
        850:{
            items:3,
           
        },
        1024:{
            items:2,
            
        },
        1250:{
            items:3,
            
        },
        1600:{
            items:5,
            
        }
    }
})
$('#categoryFilter').on('keyup',function(){
  
    var filtro=$('#categoryFilter').val();


    let datos= new FormData();
    datos.append("busqueda",filtro);
    $.ajax({
        url: '<?php echo Template::Route(CategoriasController::ROUTE, CategoriasController::MOSTRAR_CATEGORIAS); ?>',
        type: 'POST',
        
        data:datos,
        //TODO sobreescribir pills
        dataType:'json',
        cache:false,
        processData: false,
        contentType: false,
        success: function (data) {
        
            if(data.length!=0){
            var pills="";
       
            //console.log(data[0].TituloCategoria);
            [].forEach.call(data,(pill)=>{
                pills+=`<a class='popover-dismiss'  href='<?php echo Template::Route(CursosController::ROUTE, CursosController::BUSQUEDA_AVANZADA_CURSOS); ?>/id-categoria--${pill.IdCategoria}' tabindex='0' data-bs-toggle='popover' data-bs-trigger='hover'
                data-bs-content='${pill.DescripcionCategoria}'><span class='badge rounded-pill category-pill-color  m-2'>${pill.TituloCategoria}</span></a>`
               
            });
        }else{
            pills="<p class='text-danger mt-2 text-wrap'>No hay categorias que contengan: "+ filtro+" </p>";

        }
            hidePills();
            showNewPills(pills);
      

        },
        error: function (data,err) {
            console.log(data);
        },
        failure: function (data) {
                console.log(data);
        },
        
    });
 });



</script>