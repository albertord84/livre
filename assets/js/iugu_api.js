$(document).ready(function () {
   Iugu.setAccountID("80BF7285A577436483EE04E0A80B63F4");
   Iugu.setTestMode(true);
   
   /*
    * this debe ser un formulario e cada campo debe tener un atributo data-iugu
    * ademas deben especificarse los campos como aparece en la API
   */
  
    $("#btn_steep_2_next_new").click(function () {    
        Iugu.createPaymentToken(this, function(response) {
            if (response.errors) {
                    alert("Erro salvando cartão");
            } else {
                    alert("Token criado:" + response.id);
            }	
        });
    });
    /*jQuery(function($) {
      $('#payment-form').submit(function(evt) {
          var form = $(this);
          var tokenResponseHandler = function(data) {

              if (data.errors) {
                  alert("Erro salvando cartão: " + JSON.stringify(data.errors));
              } else {
                  $("#token").val( data.id );
                  form.get(0).submit();
              }

              // Seu código para continuar a submissão
              // Ex: form.submit();
          }

          Iugu.createPaymentToken(this, tokenResponseHandler);
          return false;
      });
    });*/
    
});
