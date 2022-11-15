<script>


$(document).ready(function(){
  var formaPago= $(".paypal-button.paypal-button-number-0");
  var container=$('#paypal-button-container');
  var price=container.data('price');
  var idContainer=$('#courseID');
  var id=idContainer.data('courseid');
  var metodoPago=formaPago.data('funding-source');



  paypal.Buttons({

  // Sets up the transaction when a payment button is clicked
  createOrder: function(data, actions) {
    return actions.order.create({
      purchase_units: [{
        amount: {
          value:price // Can reference variables or functions. Example: `value: document.getElementById('...').value`
        }
      }],
      // name:{
      //   given_name:"[[Derek]]",
      //   surname:"[[Gafet]]"
      // }
    });
  },

 
  style:{
    shape:"pill"
  },
  env:'sandbox', // production
  // payment: function(data,actions){
  //   return actions.payment.create({
  //     payment:{
  //       transactions:[{
  //         amount:{ total:precio}
  //       }]
  //     }
  //   })
  // },
  // Finalize the transaction after payer approval
    onApprove: function(data, actions) {
    return actions.order.capture().then(function(orderData) {
      // Successful capture! For dev/demo purposes:
          // console.log(orderData);
          // console.log('Capture result', orderData, JSON.stringify(orderData, null, 2));
          // var transactiaton = orderData.purchase_units[0].payments.captures[0];
          // alert('Transaction '+ transaction.status + ': ' + transaction.id + '\n\nSee console for all available details');
    //  console.log(orderData);
      // When ready to go live, remove the alert and show a success message within this page. For example:
      // var element = document.getElementById('paypal-button-container');
      // element.innerHTML = '';
      // element.innerHTML = '<h3>Thank you for your payment!</h3>';
      // Or go to another URL:  actions.redirect('thank_you.html');
    //  console.log(orderData.purchase_units[0].amount.value);
      $.ajax({
        url: '<?php echo Template::Route(ComprasController::ROUTE, ComprasController::REALIZAR_COMPRA); ?>',
        type: 'post',
        
        data: {
          //  costo:orderData.purchase_units[0].amount.value,
          datos:orderData,
          idcurso:id
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


    });
  }
}).render('#paypal-button-container');

});

</script>