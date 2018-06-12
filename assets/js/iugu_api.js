$(document).ready(function () {
   Iugu.setAccountID("80BF7285A577436483EE04E0A80B63F4");
   Iugu.setTestMode(true);
   
   /*
    * this debe ser un formulario e cada campo debe tener un atributo data-iugu
    * ademas deben especificarse los campos como aparece en la API
   */
  
    $("#btn_steep_2_next").click(function () {  
        alert("solicitando token");
        var data = JSON.stringify({
            "account_id": "80BF7285A577436483EE04E0A80B63F4",
            "method": "credit_card",
            "test": "true",
            "data": {
              "number": "378282246310005",
              "verification_value": "1234",
              "first_name": "JORGE",
              "last_name": "MORENO",
              "month": "06",
              "year": "2020"
            }
          });
          
        var xhr = new XMLHttpRequest();
        xhr.withCredentials = true;

        xhr.addEventListener("readystatechange", function () {
          if (this.readyState === this.DONE) {
            console.log(this.responseText);
          }
        });

        xhr.open("POST", "https://api.iugu.com/v1/payment_token");

        xhr.send(data);
        
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
