<script>
$( document ).ready(function() {
function hideMessages(){
    $('#chats').children().remove();
}
function showNewMessages(newMessages){
    $('#chats').append(newMessages);
}
$('#filtroUsuarios').on('keyup',function(){
    var filtro=$('#filtroUsuarios').val();
    let datos= new FormData();
    datos.append("busqueda",filtro);
    $.ajax({
        url: '<?php echo Template::Route(MensajesController::ROUTE, MensajesController::FILTRO_MEMSAJES); ?>',
        type: 'POST',
        
        data:datos,
        //TODO sobreescribir pills
        dataType:'json',
        cache:false,
        processData: false,
        contentType: false,
        success: function (data) {
            var messages="";
            if(data.bandeja.length!=0){
            
       
            //console.log(data[0].TituloCategoria);
            [].forEach.call(data.bandeja,(mensaje)=>{
                if(mensaje.UsuarioEnvia==data.idUsuario){
                    

            messages += `<a class="chat-user" href="<?php echo Template::Route(MensajesController::ROUTE, MensajesController::MOSTRAR_MENSAJES); ?>/${mensaje.UsuarioRecibe}">`+
        ``+
        `                                    <div class="user-card row d-flex mb-0 pt-3 ps-3 pe-3 pb-0  ">`+
        `                                        <div class="col-3">`+
        `                                            <img src="data:image/jpeg; base64, ${mensaje.ImagenUsuarioRecibe}" style="height:60px;width:60px;border-radius:100% " alt="">`+
        `                                        </div>`+
        `                                        <div class="col-9 ">`+
        `                                            <div class="row mb-2">`+
        `                                                <div class="col-12">`+
        ``+
        `                                                    <h5 class="m-0 text-cut">${mensaje.NombreUsuarioRecibe}</h5>`+
        ``+
        `                                                </div>`+
        `                                                `+
        `                                            </div>`+
        `                                            <div class="row  m-0">`+
        `                                                <p class="p-0 text-cut">Recibido: ${mensaje.DescripcionMensaje}</p>`+
        ``+
        `                                           </div>`+
        `                                      </div>`+
        `                                    </div>`+
        ``+
        ``+
        `                                </a>`;
	
	
                }else if(mensaje.UsuarioRecibe==data.idUsuario){
    messages += `<a class="chat-user" href="<?php echo Template::Route(MensajesController::ROUTE, MensajesController::MOSTRAR_MENSAJES); ?>/${mensaje.UsuarioEnvia}">`+
    ``+
    `                                    <div class="user-card row d-flex mb-0 pt-3 ps-3 pe-3 pb-0  ">`+
    `                                        <div class="col-3">`+
    `                                            <img src="data:image/jpeg; base64, ${mensaje.ImagenUsuarioEnvia}" style="height:60px;width:60px;border-radius:100% " alt="">`+
    `                                        </div>`+
    `                                        <div class="col-9 ">`+
    `                                            <div class="row mb-2">`+
    `                                                <div class="col-12">`+
    ``+
    `                                                    <h5 class="m-0 text-cut">${mensaje.NombreUsuarioEnvia}</h5>`+
    ``+
    `                                                </div>`+
    `                                                `+
    `                                            </div>`+
    `                                            <div class="row  m-0">`+
    `                                                <p class="p-0 text-cut">Enviado: ${mensaje.DescripcionMensaje}></p>`+
    ``+
    `                                           </div>`+
    `                                      </div>`+
    `                                    </div>`+
    ``+
    ``+
    `                                </a>`;
                }
               
            });
      
        }else{
            messages+="<div style='height:200px; width:100%;display:flex; align-items:center; justify-content:center'><p class='text-danger mt-2 text-wrap'>No se encontraron usuarios</p></div>"
        }
        hideMessages();
        showNewMessages(messages);
       

        },
        error: function (data,err) {
            console.log(data);
        },
        failure: function (data) {
                console.log(data);
        },
        
    });
 });
});
</script>