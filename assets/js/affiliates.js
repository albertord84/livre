$(document).ready(function () {
    var pk='';
    var utm_source= typeof getUrlVars()["utm_source"] !== 'undefined' ? getUrlVars()["utm_source"] : 'NULL';
    
    //---------PRIMARY FUNCTIONS---------------------------------
    $("#btn_sigin_affiliate").click(function () {
        if($('#pass').val()!==$('#pass_confirmation').val()){
            modal_alert_message('As senhas devem ser iguais');
        }else{            
            name  = validate_element('#complete_name', '^[A-Z ]{6,150}$');
            email = validate_element('#email', '^[a-zA-Z0-9\._-]+@([a-zA-Z0-9-]{2,}[.])*[a-zA-Z]{2,4}$');
            phone_ddd = validate_element('#phone_ddd', '^[0-9]{2}$');
            phone_number = validate_element('#phone_number', '^[0-9]{7,10}$');        
            if(name!=="false" && email && phone_ddd && phone_number ){                                
                $.ajax({
                    url: base_url + 'index.php/welcome/insert_affiliate',
                    data:{
                        'complete_name': $('#complete_name').val(),
                        'email': $('#email').val(),
                        'phone_ddd': $('#phone_ddd').val(),
                        'phone_number': $('#phone_number').val(),
                        'pass': $('#pass').val()
                    },
                    type: 'POST',
                    dataType: 'json',
                    success: function (response) {
                        if (response['success']) {
                            set_global_var('pk',response['pk']);                                 
                        }
                        else{
                            modal_alert_message(response['message']);
                        }
                    },
                    error: function (xhr, status) {
                        modal_alert_message('Internal error in Steep 1');
                    }
                });            
            } else{
                modal_alert_message("Erro nos dados fornecidos. Por favor, verifique.");
            } 
        }
    });
    
        
    //---------SECUNDARY FUNCTIONS-------------------------------
       
    $('#container_form_steep_1').keypress(function (e) {
        if (e.which == 13) {
            $("#btn_steep_1").click();
            return false;
        }
    });

    $('#container_form_steep_2').keypress(function (e) {
        if (e.which == 13) {
            $("#btn_steep_2").click();
            return false;
        }
    });

    $('#container_form_steep_3').keypress(function (e) {
        if (e.which == 13) {
            $("#btn_steep_3").click();
            return false;
        }
    });
    
    function set_global_var(str, value) {
        switch (str) {
            case 'pk':
                pk = value;
                break;            
        }
    }
    
    function getUrlVars(){
        var vars = [], hash;
        var hashes = window.location.href.slice(window.location.href.indexOf('?') + 1).split('&');
        for (var i = 0; i < hashes.length; i++){
            hash = hashes[i].split('=');
            vars.push(hash[0]);
            vars[hash[0]] = hash[1];
        }
        return vars;
    }
    
    function modal_alert_message(text_message){
        $('#modal_alert_message').modal('show');
        $('#message_text').text(text_message);
    }
    
    $("#accept_modal_alert_message").click(function () {
        $('#modal_alert_message').modal('hide');
    });
    
    $("#btn_modal_close").click(function () {
        $('#modal_alert_message').modal('hide');
    });
    
    function validate_cpf(cpf, element_selector, pattern) {        
        if(cpf.match(pattern)){
            cpf = cpf.replace(/[^\d]+/g,'');    
            if(cpf == '') {
                //$(element_selector).css("color", "red");
                $(element_selector).css("color", "red");
                return false;
            }
            // Elimina CPFs invalidos conhecidos    
            if (cpf.length != 11 || 
                cpf == "00000000000" || cpf == "11111111111" || cpf == "22222222222" 
                || cpf == "33333333333" || cpf == "44444444444" || cpf == "55555555555" 
                || cpf == "66666666666" || cpf == "77777777777" || cpf == "88888888888" 
                || cpf == "99999999999"){
                    $(element_selector).css("color", "red");
                    return false;
                }
            // Valida 1o digito 
            add = 0;
            for (i=0; i < 9; i ++)       
                add += parseInt(cpf.charAt(i)) * (10 - i);  
                rev = 11 - (add % 11);  
                if(rev == 10 || rev == 11)     
                    rev = 0;    
                if(rev != parseInt(cpf.charAt(9))){
                    $(element_selector).css("color", "red");
                    return false;
                }
            // Valida 2o digito 
            add = 0;
            for (i = 0; i < 10; i ++)
                add += parseInt(cpf.charAt(i)) * (11 - i);  
            rev = 11 - (add % 11);
            if (rev == 10 || rev == 11)
                rev = 0;
            if (rev != parseInt(cpf.charAt(10))){
                $(element_selector).css("color", "red");
                return false;
            }            
            $(element_selector).css("color", "black");
            return true;
        }else{
            $(element_selector).css("color", "red");
            return false;
        }
    }
    
    function validate_element(element_selector, pattern) {
        if (!$(element_selector).val().match(pattern)) {
            //$(element_selector).css("color", "red");
            $(element_selector).css("color", "red");
            return false;
        } else {
            //$(element_selector).css("color", "black");
            $(element_selector).css("color", "black");
            return true;
        }
    }

}); 
