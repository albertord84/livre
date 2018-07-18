$(document).ready(function () {
    var pk='';
    var utm_source= typeof getUrlVars()["utm_source"] !== 'undefined' ? getUrlVars()["utm_source"] : 'NULL';
    
    //---------PRIMARY FUNCTIONS---------------------------------
    $("#btn_sigin_affiliate_steep1").click(function () {
        if($('#affiliate_pass').val()!==$('#affiliate_pass_confirmation').val()){
            modal_alert_message('As senhas devem ser iguais');
        }else{
            complete_name  = validate_element('#affiliate_complete_name', '^[A-ZÃÕÇÁÉÍÓÚÀÈÌÒÙ ]{6,150}$');
            email = validate_element('#affiliate_email', '^[a-zA-Z0-9\._-]+@([a-zA-Z0-9-]{2,}[.])*[a-zA-Z]{2,4}$');
            phone_ddd = validate_element('#affiliate_phone_ddd', '^[0-9]{2}$');
            phone_number = validate_element('#affiliate_phone_number', '^[0-9]{7,10}$');        
            if(complete_name!=="false" && email && phone_ddd && phone_number ){                                
                $.ajax({
                    url: base_url + 'index.php/welcome/insert_affiliate_steep1',
                    data:{
                        'complete_name': $('#affiliate_complete_name').val(),
                        'email': $('#affiliate_email').val(),
                        'phone_ddd': $('#affiliate_phone_ddd').val(),
                        'phone_number': $('#affiliate_phone_number').val(),
                        'pass': $('#affiliate_pass').val(),
                        'key':key
                    },
                    type: 'POST',
                    dataType: 'json',
                    success: function (response) {
                        if(response['success']) {
                            $('li[id=li_complete_name]').text($('#affiliate_complete_name').val());
                            $('#titular_name').val($('#affiliate_complete_name').val());
                            $('li[id=li_email]').text($('#affiliate_email').val());        
                            $('li[id=li_phone]').text( "("+$('#affiliate_phone_ddd').val()+")"+$('#affiliate_phone_number').val() );        
                            $('.cad1').toggle("hide");
                            $('.cad2').toggle("slow");
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
        
    $("#btn_sigin_affiliate_steep2").click(function () {
        var cpf_value=$('#titular_cpf').val();
        cpf_value = cpf_value.replace('.',''); cpf_value = cpf_value.replace('.',''); cpf_value = cpf_value.replace('-','');
        var bank = validate_element('#bank', "^[0-9]{3,3}$");        
        var agency = validate_element('#agency', "^[0-9]{4,12}$");
        var account_type = validate_element('#account_type', "^[A-Z]{2,2}$");        
        var account = validate_element('#account', "^[0-9]{4,12}$");
        var dig = validate_element('#dig', "^[0-9]{1}$");            
        var titular_name = validate_element('#titular_name','^[A-ZÃÕÇÁÉÍÓÚÀÈÌÒÙ ]{6,150}$');            
        var titular_cpf = validate_cpf(cpf_value, '#titular_cpf', '^[0-9]{11}$');
        if(bank && agency && account_type && account && dig && titular_name && titular_cpf) {
            datas={
                'bank': $('#bank').val(),
                'agency': $('#agency').val(),
                'account_type': $('#account_type').val(),
                'account': $('#account').val(),
                'dig': $('#dig').val(),
                'titular_name': $('#titular_name').val(),
                'titular_cpf': cpf_value,
                'key':key
            };
            $.ajax({
                url: base_url + 'index.php/welcome/insert_affiliate_steep2',
                data: datas,
                type: 'POST',
                dataType: 'json',
                success: function (response) {
                    if (response['success']) {  
                        var name = $('#affiliate_complete_name').val();
                        name = name.split(" ");
                        $('#affiliate_first_name').text(name[0]);                        
                        $('.cad2').toggle("hide");
                        $('.cad3').toggle("slow");
                    } else {
                        modal_alert_message(response['message']);
                    }
                },
                error: function (xhr, status) {
                    modal_alert_message('Internal error in Steep 3');
                }
            });
        } else{
            modal_alert_message('Verifique os dados fornecidos');            
        }
    });
    
    $("#btn_afiliate_login").click(function () {
        email = validate_element('#affiliate_email_login', '^[a-zA-Z0-9\._-]+@([a-zA-Z0-9-]{2,}[.])*[a-zA-Z]{2,4}$');
        if(email){
            $.ajax({
                url: base_url + 'index.php/welcome/login_affiliate',
                data:{
                    'email': $('#affiliate_email_login').val(),
                    'pass': $('#affiliate_pass_login').val(),
                    'key':key
                },
                type: 'POST',
                dataType: 'json',
                success: function (response) {
                    if(response['success']) {
                         $(location).attr('href', base_url + 'index.php/welcome/painel');
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
    });
    
    $('.btn_see_trnsaction').click(function () {
        var id = this.id;   
        $.ajax({
            url: base_url + 'index.php/welcome/get_transaction_datas_by_id',
            data:{
                'id': id
            },
            type: 'POST',
            dataType: 'json',
            success: function (response) {
                if(response['success']) {
                    /*year=date.getFullYear();
                    day=date.getDate();
                    hour=date.getHours();
                    minutes=date.getMinutes();
                    seconds=date.getSeconds();
                    return day+"/"+month+"/"+year+" "+hour+":"+minutes+":"+seconds;*/
                    
                    $("#trans_id").text(response['message']['id']);
                    $("#trans_name").text(response['message']['name']);
                    $("#trans_email").text(response['message']['email']);
                    $("#trans_cpf").text(response['message']['cpf']);
                    $("#trans_phone_ddd").text(response['message']['phone_ddd']);
                    $("#trans_phone_number").text(response['message']['phone_number']);
                    $("#trans_date").text('DD-MM-YY / HH:MM');
                    $("#trans_solicited_value").text(response['message']['amount_solicited']);
                    $("#trans_credit_card_name").text(response['message']['credit_card_name']);
                    $("#trans_credit_card_final").text(response['message']['credit_card_final']);
//                    $("#trans_").text(response['message']['']);


                    $('#trans').modal('show');
                }
                else{
                    modal_alert_message(response['message']);
                }
            },
            error: function (xhr, status) {
                modal_alert_message('Internal error');
            }
        }); 
        
    });
        
    
    //----------------------SECUNDARY FUNCTIONS-------------------------------
       
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
    
    $('#frm_affiliates_login').keypress(function (e) {
        if (e.which == 13) {
            $("#btn_afiliate_login").click();
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
    
    function init_signin(){        
        $('#affiliate_complete_name').val('JOSÉ RAMÓN GONZÁLEZ MONTERO');
        $('#affiliate_username').val('josergm86');
        $('#affiliate_email').val('josergm86@gmail.com');
        $('#affiliate_phone_ddd').val('21');
        $('#affiliate_phone_number').val('965913089');
        $('#affiliate_pass').val('jr24666gm');
        $('#affiliate_pass_confirmation').val('jr24666gm');
        $('#titular_cpf').val('07367014196');
    }
    
    //init_signin();

}); 
