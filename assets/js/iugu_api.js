$(document).ready(function () {
   Iugu.setAccountID("80BF7285A577436483EE04E0A80B63F4");
   Iugu.setTestMode(true);
   
   /*
    * this debe ser un formulario e cada campo debe tener un atributo data-iugu
    * ademas deben especificarse los campos como aparece en la API
   */
    
    Iugu.createPaymentToken(this, function(response) {
            if (response.errors) {
                    alert("Erro salvando cartão");
            } else {
                    alert("Token criado:" + response.id);
            }	
    });
    
    function get_token() {
        var cc = Iugu.CreditCard("4111111111111111", 
                     "12", "2017", "Nome", 
                     "Sobrenome", "123");
        var form = $(this);
        var tokenResponseHandler = function(data) {

            if (data.errors) {
                alert("Erro salvando cartão: " + JSON.stringify(data.errors));
            } else {
                //$("#token").val( data.id );
                //form.get(0).submit();
                alert("Token criado")
            }

            // Seu código para continuar a submissão
            // Ex: form.submit();
        }
        
        var tokenResponseHandler2 = function(data2) {

            if (data.errors) {
                alert("Erro salvando cartão: " + JSON.stringify(data.errors2));
            } else {
                //$("#token").val( data.id );
                //form.get(0).submit();
                alert("Token criado")
            }

            // Seu código para continuar a submissão
            // Ex: form.submit();
        }

        Iugu.createPaymentToken(cc, tokenResponseHandler);
        Iugu.createPaymentToken(cc, tokenResponseHandler2);
        return false;
    }
    $("#btn_steep_2_next").click(function () {   
       get_token(); 
    });
    /*$("#btn_steep_2_next").click(function () {  
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
    */
});
