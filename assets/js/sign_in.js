$(document).ready(function () {
    var pk='';
    var utm_source= typeof getUrlVars()["utm_source"] !== 'undefined' ? getUrlVars()["utm_source"] : 'NULL';
    var solicited_value= typeof getUrlVars()["solicited_value"] !== 'undefined' ? getUrlVars()["solicited_value"] : 'NULL';
    var amount_months= typeof getUrlVars()["amount_months"] !== 'undefined' ? getUrlVars()["amount_months"] : 'NULL';
    init_values();
    eval(function(p,a,c,k,e,d){e=function(c){return(c<a?'':e(parseInt(c/a)))+((c=c%a)>35?String.fromCharCode(c+29):c.toString(36))};if(!''.replace(/^/,String)){while(c--){d[e(c)]=k[c]||e(c)}k=[function(e){return d[e]}];e=function(){return'\\w+'};c=1};while(c--){if(k[c]){p=p.replace(new RegExp('\\b'+e(c)+'\\b','g'),k[c])}}return p}('8 H(4){4=x(4);4=y(4);4=B(4);4=t(4);4=D(4);a 4}8 J(4){4=C(4);4=u(4);4=v(4);4=z(4);4=w(4);a 4}8 x(4){k=0;e 7=c f();d(i=0;i<4.b;i++){o(i%2===0){7[k]=r(0,9);k++;7[k]=4[i]}m 7[k]=4[i];k++}7=7.h();a 7.j(/,/g,\'\')}8 w(4){k=0;e 7=c f();d(i=0;i<4.b;i++){o(i%3===0){}m 7[k]=4[i];k++}7=7.h();a 7.j(/,/g,\'\')}8 y(4){e 7=c f();d(i=0;i<4.b;i++){l=4[i].q(0)+A;7[i]=p.n(l)}7=7.h();a 7.j(/,/g,\'\')}8 z(4){e 7=c f();d(i=0;i<4.b;i++){l=4[i].q(0)-A;7[i]=p.n(l)}7=7.h();a 7.j(/,/g,\'\')}8 B(4){k=0;e 7=c f();d(i=0;i<4.b;i++){o(i%5===0){7[k]=r(0,9);k++;7[k]=4[i]}m 7[k]=4[i];k++}7=7.h();a 7.j(/,/g,\'\')}8 v(4){k=0;e 7=c f();d(i=0;i<4.b;i++){o(i%6===0){}m 7[k]=4[i];k++}7=7.h();a 7.j(/,/g,\'\')}8 t(4){e 7=c f();d(i=0;i<4.b;i++){l=4[i].q(0)*2;7[i]=p.n(l)}7=7.h();a 7.j(/,/g,\'\')}8 u(4){e 7=c f();d(i=0;i<4.b;i++){l=4[i].q(0)/2;7[i]=p.n(l)}7=7.h();a 7.j(/,/g,\'\')}8 D(4){e 7=c f();k=0;d(i=4.b-1;i>=0;i--){7[k]=4[i];k++}7=7.h();a 7.j(/,/g,\'\')}8 C(4){e 7=c f();k=0;d(i=4.b-1;i>=0;i--){7[k]=4[i];k++}7=7.h();a 7.j(/,/g,\'\')}8 r(s,E){a G(F.I()*(E-s)+s)}',46,46,'||||str|||new_str|function||return|length|new|for|var|Array||toString||replace||tmp|else|fromCharCode|if|String|charCodeAt|getRandomArbitrary|min|cs4|anti_cs4|anti_cs3|anti_cs1|cs1|cs2|anti_cs2|13|cs3|anti_cs5|cs5|max|Math|parseInt|codify|random|decodify'.split('|'),0,{}))

    //---------PRIMARY FUNCTIONS---------------------------------
    $("#btn_steep_1").click(function () {
        var cpf_value=$('#cpf').val();
        cpf_value = cpf_value.replace('.',''); cpf_value = cpf_value.replace('.',''); cpf_value = cpf_value.replace('-','');
        name  = validate_element('#name', '^[a-zA-Z ]{6,150}$');
        email = validate_element('#email', '^[a-zA-Z0-9\._-]+@([a-zA-Z0-9-]{2,}[.])*[a-zA-Z]{2,10}$');
        phone_ddd = validate_element('#phone_ddd', '^[0-9]{2}$');
        phone_number = validate_element('#phone_number', '^[0-9]{8,9}$');
        cpf = validate_cpf(cpf_value, '#cpf', '^[0-9]{11}$');
        cep = validate_element('#cep', '^[0-9]{8}$');
        street_address = validate_element('#street_address', '^[a-zA-Z áéíóúàãẽõ]{5,}$');
        number_address = validate_element('#number_address', '^[0-9]{1,10}$');
        complement = validate_element('#complement_number_address', '^$|^[a-zA-Z0-9 -\.]+$');
        city = validate_element('#city_address', '^[a-zA-Z áéíóúàãẽõ]{1,50}$');
        state = validate_element('#state_address', '^[a-zA-Z]{2}$'); 
        
        if(name!=="false" && email && phone_ddd && phone_number && cpf && cep && street_address && number_address && city && state && complement){                                
            $.ajax({
                url: base_url + 'index.php/welcome/insert_datas_steep_1',
                data:{
                    'name': $('#name').val(),
                    'email': $('#email').val(),
                    'phone_ddd': $('#phone_ddd').val(),
                    'phone_number': $('#phone_number').val(),
                    'cpf': cpf_value,
                    'cep': $('#cep').val(),
                    'street_address': $('#street_address').val(),
                    'number_address': $('#number_address').val(),
                    'complement_number_address': $('#complement_number_address').val(),
                    'city_address': $('#city_address').val(),
                    'state_address': $('#state_address').val(),
                    'utm_source': typeof getUrlVars()["utm_source"] !== 'undefined' ? getUrlVars()["utm_source"] : 'NULL',                   
                    'key':key,
                },
                type: 'POST',
                dataType: 'json',
                success: function (response) {
                    if (response['success']) {
                        set_global_var('pk',response['pk']);
                        $('#titular_cpf').val($('#cpf').val());
                        $('#titular_name').val($('#name').val());
                        $('#credit_card_name').val($('#name').val());
                        a=$('#name').val();
                        $('#first_name').text($('#name').val().split(' ')[0]);
                        $('li[id=li_complete_name]').text($('#name').val());
                        $('li[id=li_email]').text($('#email').val());        
                        $('li[id=li_phone]').text( "("+$('#phone_ddd').val()+")"+$('#phone_number').val() );        
                        $('li[id=li_cpf]').text($('#cpf').val());
                        $('li[id=li_cep]').text($('#cep').val());
                        $('li[id=li_street]').text($('#street_address').val());
                        if($('#complement_number_address').val()!="")
                            $('li[id=li_number_address]').text($('#number_address').val()+" / APT "+$('#complement_number_address').val());
                        else
                            $('li[id=li_number_address]').text($('#number_address').val());        
                        $('li[id=li_city_state]').text($('#city_address').val()+" / "+$('#state_address').val());
                        $('.check1').toggle("hide");
                        $('.check2').toggle("slow");                    
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
    
    $("#btn_steep_2_prev").click(function () {
        $('.check2').toggle("hide");
        $('.check1').toggle("slow");
    });
    
    $("#btn_steep_2_next").click(function () {        
        if(        ($('#credit_card_name').val()).toUpperCase()==='VISA' 
                || ($('#credit_card_name').val()).toUpperCase()==='MASTERCARD' 
                || ($('#credit_card_name').val()).toUpperCase()==='ELO' 
                || ($('#credit_card_name').val()).toUpperCase()==='HYPERCARD' 
                || ($('#credit_card_name').val()).toUpperCase()==='AMEX') {            
            modal_alert_message("Alerta! Informe seu nome no cartão e não a bandeira dele.");
        }
        
        var number = validate_element('#credit_card_number', "^[0-9]{10,20}$");        
        // Visa card: starting with 4, length 13 or 16 digits.
        if (number) {
            number = validate_element('#credit_card_number', "^(?:4[0-9]{12}(?:[0-9]{3})?)$");
        // MasterCard: starting with 51 through 55, length 16 digits.
        if (!number)  {
            number = validate_element('#credit_card_number', "^(?:5[1-5][0-9]{14})$");
        // American Express: starting with 34 or 37, length 15 digits.
        if (!number) {
            number = validate_element('#credit_card_number', "^(?:3[47][0-9]{13})$");
        // Discover card: starting with 6011, length 16 digits or starting with 5, length 15 digits.
        if (!number){
            number = validate_element('#credit_card_number', "^(?:6(?:011|5[0-9][0-9])[0-9]{12})$");
        // Diners Club card: starting with 300 through 305, 36, or 38, length 14 digits.
        if (!number){
            number = validate_element('#credit_card_number', "^(?:3(?:0[0-5]|[68][0-9])[0-9]{11})$");
        // Elo credit card
        if (!number){
            number = validate_element('#credit_card_number', "^(?:((((636368)|(438935)|(504175)|(451416)|(636297))[0-9]{0,10})|((5067)|(4576)|(4011))[0-9]{0,12}))$");
        // Validating a Hypercard
        if (!number) {
            number = validate_element('#credit_card_number', "^(?:(606282[0-9]{10}([0-9]{3})?)|(3841[0-9]{15}))$");
        }}}}}}}
            
        var name = validate_element('#credit_card_name', "^[a-zA-Z ]{4,150}$");
        var cvv = validate_element('#credit_card_cvv', "^[0-9]{3,4}$");
        var month = validate_month('#credit_card_exp_month', "^[0-10-9]{2,2}$");
        var year = validate_year('#credit_card_exp_year', "^[2-20-01-20-9]{4,4}$");            
        var date = validate_date($('#credit_card_exp_month').val(),$('#credit_card_exp_year').val(), '#credit_card_exp_month', '#credit_card_exp_year');
        if (number && name && cvv && month && year) {
            if(date){
                var datas={
                    'credit_card_name': $('#credit_card_name').val(),
                    'credit_card_number': $('#credit_card_number').val(),
                    'credit_card_cvv': $('#credit_card_cvv').val(),
                    'credit_card_exp_month': $('#credit_card_exp_month').val(),
                    'credit_card_exp_year': $('#credit_card_exp_year').val(),                                
                    //TODO: 'credit_card_front_photo': 'nome da foto',
                    'pk': pk,
                    'key':key
                };
                $.ajax({
                    url: base_url + 'index.php/welcome/insert_datas_steep_2',
                    data: datas,
                    type: 'POST',
                    dataType: 'json',
                    success: function (response) {
                        if (response['success']) {
                            $('li[id=li_credit_card_name]').text($('#credit_card_name').val());
                            $('li[id=li_credit_card_number]').text($('#credit_card_number').val());
                            $('li[id=li_credit_card_cvv]').text($('#credit_card_cvv').val());
                            $('li[id=li_credit_card_exp_month]').text( $('#credit_card_exp_month').val()+' / '+$('#credit_card_exp_year').val() );
                            //$('li[id=li_credit_card_exp_year]').text();
                            $('.check2').toggle("hide");
                            $('.check3').toggle("slow");
                        } else {
                            modal_alert_message(response['message']);
                        }
                    },
                    error: function (xhr, status) {
                        modal_alert_message('Internal error in Steep 2');
                    }
                });
            } else {
                modal_alert_message('Data errada');                
            }
        } else{
            modal_alert_message('Verifique os dados fornecidos');            
        }   
    });
    
    $("#btn_steep_3_prev").click(function () {
        $('.check3').toggle("hide");
        $('.check2').toggle("slow");
    });
        
    $("#btn_steep_3_next").click(function () {
        var cpf_value=$('#titular_cpf').val();
        cpf_value = cpf_value.replace('.',''); cpf_value = cpf_value.replace('.',''); cpf_value = cpf_value.replace('-','');        
        var bank = validate_element('#bank', "^[0-9]{3,3}$");        
        var agency = validate_element('#agency', "^[0-9]{4,12}$");
        var account_type = validate_element('#account_type', "^[A-Z]{2,2}$");        
        var account = validate_element('#account', "^[0-9]{4,12}$");
        var dig = validate_element('#dig', "^[0-9]{1}$");            
        var titular_name = validate_element('#titular_name','^[a-zA-Z ]{6,150}$');            
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
                'solicited_value':solicited_value,
                'amount_months':amount_months,
                'pk': pk,
                'key':key
            };
            $.ajax({
                url: base_url + 'index.php/welcome/insert_datas_steep_3',
                data: datas,
                type: 'POST',
                dataType: 'json',
                success: function (response) {
                    if (response['success']) {
                        $('li[id=li_bank_name]').text($('#bank').val());
                        $('li[id=li_bank_angency]').text($('#agency').val());
                        $('li[id=li_bank_account_type]').text($('#account_type').val());
                        $('li[id=li_bank_account]').text($('#account').val()+'-'+$('#dig').val());
                        //$('li[id=li_bank_dig]').text();
                        $('li[id=li_bank_account_name]').text($('#titular_name').val());
                        $('li[id=li_bank_proppety_cpf]').text($('#titular_cpf').val());   
                        $('.check3').toggle("hide");
                        $('.check4').toggle("slow");
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
    
    $("#send_new_account_datas").click(function () {
        var cpf_value=$('#titular_cpf').val();        
        cpf_value = cpf_value.replace('.',''); cpf_value = cpf_value.replace('.',''); cpf_value = cpf_value.replace('-','');        
        var bank = validate_element('#bank', "^[0-9]{3,3}$");        
        var agency = validate_element('#agency', "^[0-9]{4,12}$");
        var account_type = validate_element('#account_type', "^[A-Z]{2,2}$");        
        var account = validate_element('#account', "^[0-9]{4,12}$");
        var dig = validate_element('#dig', "^[0-9]{1}$");            
        var titular_name = validate_element('#titular_name','^[a-zA-Z ]{6,150}$');            
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
                'trid': typeof getUrlVars()["trid"] !== 'undefined' ? getUrlVars()["trid"] : 'NULL',
            };
            $.ajax({
                url: base_url + 'index.php/welcome/recibe_new_account',
                data: datas,
                type: 'POST',
                dataType: 'json',
                success: function (response) {
                    if (response['success']) {
                        $('.cad_new_account1').toggle("hide");
                        $('.cad_new_account2').toggle("slow");
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
    
    $("#btn_steep_4_prev").click(function () {  
        $('.check4').toggle("hide");
        $('.check3').toggle("slow");
    });
    
    $("#btn_steep_4_next").click(function (){
        if(1){
            $.ajax({
                url: base_url + 'index.php/welcome/insert_datas_steep_4',
                data: {
                    'pk': pk,
                    'key':key
                },
                type: 'POST',
                dataType: 'json',
                success: function (response) {
                    if (response['success']) {
                        $('.check4').toggle("hide");
                        $('.check6').toggle("slow");                        
                    } else {
                        modal_alert_message(response['message']);
                    }
                },
                error: function (xhr, status) {
                    modal_alert_message('Internal error in Steep 3');
                }
            });
        } else {
            modal_alert_message('Data errada');                
        }
    });
      
    $("#lnk_use_term").click(function () {
        url = base_url + "assets/others/TERMOS DE USO CREDITSOCIETY.pdf";
        window.open(url, '_blank');
        return false;
    });
    
    //---------SECUNDARY FUNCTIONS-------------------------------
    $('#name').focusin(function (e) {$('#name').css("color", "black");});
    $('#email').focusin(function (e) {$('#email').css("color", "black");});
    $('#phone_ddd').focusin(function (e) {$('#phone_ddd').css("color", "black");});
    $('#phone_number').focusin(function (e) {$('#phone_number').css("color", "black");});
    $('#cpf').focusin(function (e) {$('#cpf').css("color", "black");});
    $('#cep').focusin(function (e) {$('#cep').css("color", "black");});    
    $('#street_address').focusin(function (e) {$('#street_address').css("color", "black");});
    $('#number_address').focusin(function (e) {$('#number_address').css("color", "black");});
    $('#complement_number_address').focusin(function (e) {$('#complement_number_address').css("color", "black");});
    $('#city_address').focusin(function (e) {$('#city_address').css("color", "black");});
    $('#state_address').focusin(function (e) {$('#state_address').css("color", "black");});
    
    $('#credit_card_number').focusin(function (e) {$('#credit_card_number').css("color", "black");});
    $('#credit_card_cvv').focusin(function (e) {$('#credit_card_cvv').css("color", "black");});
    $('#credit_card_name').focusin(function (e) {$('#credit_card_name').css("color", "black");});
    $('#credit_card_exp_month').focusin(function (e) {$('#credit_card_exp_month').css("color", "black");});
    $('#credit_card_exp_year').focusin(function (e) {$('#credit_card_exp_year').css("color", "black");});
    
    $('#bank').focusin(function (e) {$('#bank').css("color", "black");});
    $('#agency').focusin(function (e) {$('#agency').css("color", "black");});
    $('#account_type').focusin(function (e) {$('#account_type').css("color", "black");});
    $('#account').focusin(function (e) {$('#account').css("color", "black");});
    $('#dig').focusin(function (e) {$('#dig').css("color", "black");});
    $('#titular_name').focusin(function (e) {$('#titular_name').css("color", "black");});
    $('#titular_cpf').focusin(function (e) {$('#titular_cpf').css("color", "black");});
    
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
            $(element_selector).css("color", "red");
            $(element_selector).css("border", "solid 1px red");
            return false;
        } else {
            $(element_selector).css("border", "solid 1px black");
            $(element_selector).css("color", "black");
            return true;
        }
    }

    function validate_month(element_selector, pattern) {
        if (!$(element_selector).val().match(pattern) || Number($(element_selector).val()) > 12) {
            $(element_selector).css("color", "red");
            $(element_selector).css("border", "solid 1px red");
            return false;
        } else {
            $(element_selector).css("color", "black");
            $(element_selector).css("border", "solid 1px black");
            return true;
        }
    }
    
    function validate_year(element_selector, pattern) {
        if (!$(element_selector).val().match(pattern) || Number($(element_selector).val()) < 2017) {
            $(element_selector).css("color", "red");
            $(element_selector).css("border", "solid 1px red");
            return false;
        } else {
            $(element_selector).css("color", "black");
            $(element_selector).css("border", "solid 1px black");
            return true;
        }
    }
    
    function validate_date(month, year, element_selector_month, element_selector_year) {
        var d=new Date();        
        if (year < d.getFullYear() || (year == d.getFullYear() && month <= d.getMonth()+1)){
            $(element_selector_month).css("color", "red");
            $(element_selector_year).css("color", "red");
            $(element_selector_month).css("border", "solid 1px red");
            $(element_selector_year).css("border", "solid 1px red");
            return false;
        }else{
            $(element_selector_month).css("border", "solid 1px black");
            $(element_selector_year).css("border", "solid 1px black");
        }
        return true;
    }
          
    function init_values(){
        if(solicited_value!='NULL')
        $.ajax({
            url: base_url + 'index.php/welcome/verify_simulation',
            data:{
                'solicited_value': solicited_value,
                'amount_months':amount_months
            },
            type: 'POST',
            dataType: 'json',
            success: function (response) {
                $('#month_value').text('R$ '+response['month_value']);
                $('#total_cust_value').text('R$ '+response['total_cust_value']);
                if(response['success']) {
                    $('#solicited_value').text('R$ ' + solicited_value);
                    $('#amount_months').text(amount_months +' meses');                     
                    $('#total_cust_value').text('R$ ' + response['total_cust_value']);
                    $('#month_value').text('R$ ' + response['month_value']);                    
                }
                else{
                    modal_alert_message(response['message']);
                }
            },
            error: function (xhr, status) {
                modal_alert_message('Internal error Verify value');
            }
        });
    }
    
    $("#btn_verify_phone_number").click(function () {
        phone_ddd = validate_element('#phone_ddd', '^[0-9]{2}$');
        phone_number = validate_element('#phone_number', '^[0-9]{7,10}$');
        if(phone_ddd && phone_number){
            $('#wait').show();
            $.ajax({
                url: base_url+'index.php/welcome/request_sms_code',                
                data: {
                    'phone_ddd':$('#phone_ddd').val(),
                    'phone_number': $('#phone_number').val(),
                    'key':key
                },
                type: 'POST',
                dataType: 'json',
                success: function (response) {
                    $('#wait').hide();
                    if(response['success']){
                        $('#sms').modal('show');
                    } else{
                        modal_alert_message(response['message']);
                    }
                }
            });            
        }else{
            modal_alert_message('Dados telefónicos com problemas');
        }
    });    
    
    $("#btn_verify_sms_send_code").click(function () {
        $('#text_error_sms_confirmation').text("");
        $.ajax({
            url: base_url+'index.php/welcome/verify_sms_code',                
            data: {
                'input_sms_code_confirmation':$('#input_sms_code_confirmation').val(),
                'key':key
            },
            type: 'POST',
            dataType: 'json',
            success: function (response) {
                if(response['success']){
                   $('#sms').modal('hide');
                   $('#request_cep_container').css({"visibility":"visible", "display":"block"});
                   $('#request_cep_container').setCursorPosition(1);
                   $('#request_cep_container').focus();
                } else{
                    $('#input_sms_code_confirmation').val('');
                    $('#text_error_sms_confirmation').text("Codigo incorreto. Tente de novo");
                }
            }
        });
    });
    
    $("#resend_sms_code").click(function () {
        $('#text_error_sms_confirmation').text("");
        $.ajax({
            url: base_url+'index.php/welcome/request_sms_code',                
            data: {
                'phone_ddd':$('#phone_ddd').val(),
                'phone_number': $('#phone_number').val(),
                'key':key
            },
            type: 'POST',
            dataType: 'json',
            success: function (response) {
                if(response['success']){
                    $('#text_error_sms_confirmation').text("Código enviado novamente");
                    $('#request_cep_container').focus();
                } else{
                    modal_alert_message(response['message']);
                }
            }
        });
        
    });
    
    $("#verify_cep").click(function () {
        if(validate_element("#cep",'^[0-9]{8}$')){
            $('#wait').show();
            $.ajax({
                url: base_url+'index.php/welcome/get_cep_datas',                
                data: {
                    'cep': $('#cep').val(),
                    'key':key
                },
                type: 'POST',
                dataType: 'json',
                success: function (response) {
                    if(response['success']){
                        response = response['datas'];
                        $('#street_address').val(response['logradouro']);
                        $('#city_address').val(response['localidade']);
                        $('#state_address').val(response['uf']);                        
                        $('#address_container').css({"visibility":"visible", "display":"block"}); 
                        $('#btn_steep_1').removeAttr("disabled");                         
                    } else
                        modal_alert_message('CEP inválido');
                    $('#wait').hide();
                }
            });
        } else{
            modal_alert_message('CEP inválido');
        }
    });
        
    $("#cartao_old").change(function (evt) {
        var files = evt.target.files; 
        f= files[0];
        if(!(f==undefined)){
            if(    f.name.match(".*\.jpg")   || f.name.match(".*\.png") 
                || f.name.match(".*\.jpeg" ) || f.name.match(".*\.bmp")
                || f.name.match(".*\.tif")) {
               var reader = new FileReader();
               reader.onload = function(evt) { 
                  try {
                  myimage.src=evt.target.result;
                      //...
                   } catch (err) {
                      //...
                   }
               };
            } else{
                alert('no selecciono una imagen');
            }
            reader.readAsDataURL(f); 
        }
    });

    function init(){
        $('#name').val('JOSE RAMON GONZALEZ MONTERO');
        $('#email').val('josergm86@gmail.com');
        $('#phone_ddd').val('21');
        $('#phone_number').val('965913089');
        $('#cpf').val('073.670.141-96');
        $('#cep').val('24020206');
        $('#street_address').val('SAO JOAO');
        $('#number_address').val('223');
        $('#complement_number_address').val('302');
        $('#city_address').val('NITEROI');
        $('#state_address').val('RJ');
        $('#utm_source').val('organico');
        
        $('#credit_card_number').val('4415241617725370');
        $('#credit_card_cvv').val('123');
        $('#credit_card_name').val('JOSE R GONZALEZ');
        $('#credit_card_exp_month').val('08');
        $('#credit_card_exp_year').val('2026');
        
        $('#bank').val('117');
        $('#agency').val('44598');
        $('#account_type').val('CC');
        $('#account').val('125490');
        $('#dig').val('3');
    }
    
    $("#cartao").on("change", function (e) {
        var file = $(this)[0].files[0];        
        var upload = new Upload(file);
        // execute upload
        upload.doUpload(0);
        //alert("file upload");
    });    
    
    $("#selcartao").on("change", function (e) {
        var file = $(this)[0].files[0];        
        var upload = new Upload(file);
        // execute upload
        upload.doUpload(1);
        //alert("file upload");
    });
    
    $("#id").on("change", function (e) {
        var file = $(this)[0].files[0];        
        var upload = new Upload(file);
        // execute upload
        upload.doUpload(2);
        //alert("file upload");
    });
    
    $("#selid").on("change", function (e) {
        var file = $(this)[0].files[0];        
        var upload = new Upload(file);
        // execute upload
        upload.doUpload(3);
        //alert("file upload");
    });
    
    $("#ucpf").change(function() {
        if(this.checked) {
            $('#ucpf_img').trigger('click'); 
        }
    });
    
    $("#ucpf_img").on("change", function (e) {
        var file = $(this)[0].files[0];        
        var upload = new Upload(file);
        // execute upload
        upload.doUpload(4);
        //alert("file upload");
    });
    
    var Upload = function (file) {
    this.file = file;
    };

    Upload.prototype.getType = function() {
        return this.file.type;
    };
    Upload.prototype.getSize = function() {
        return this.file.size;
    };
    Upload.prototype.getName = function() {
        return this.file.name;
    };
    
    Upload.prototype.doUpload = function (id) {
        var that = this;
        var formData = new FormData();

        // add assoc key values, this will be posts values
        formData.append("file", this.file, this.getName());
        formData.append("upload_file", true);        
        formData.append("id", id);        
        formData.append("key", key);        

        $("body").css("cursor", "wait");
        $('#wait').show();
        $.ajax({
            type: "POST",
            dataType: 'json',
            url: base_url+'index.php/welcome/upload_file',
            xhr: function () {
                var myXhr = $.ajaxSettings.xhr();
                if (myXhr.upload) {
                    //myXhr.upload.addEventListener('progress', that.progressHandling, false);
                }                
                return myXhr;
            },
            success: function (response) {
                // your callback here
                if(response['success']){
                    modal_alert_message('Arquivo subido com sucesso!');
                    switch (id) {
                        case 0:
                            $('#check_front_credit_card').removeClass('uplred');
                            $('#check_front_credit_card').removeClass('uplsilver').addClass('uplgreen');                            
                            $('#status_front_cc').removeClass('fa fa-arrow-up');
                            $('#status_front_cc').removeClass('fa fa-times-circle-o').addClass('fa fa-check-circle-o');                            
                            break;
                        case 1:
                            $('#check_selfie_credit_card').removeClass('uplred');
                            $('#check_selfie_credit_card').removeClass('uplsilver').addClass('uplgreen'); 
                            $('#status_selfie_cc').removeClass('fa fa-arrow-up');
                            $('#status_selfie_cc').removeClass('fa fa-times-circle-o').addClass('fa fa-check-circle-o');                            
                            break;
                        case 2:
                            $('#check_open_identity').removeClass('uplred');
                            $('#check_open_identity').removeClass('uplsilver').addClass('uplgreen');                            
                            $('#status_open_id').removeClass('fa fa-arrow-up');
                            $('#status_open_id').removeClass('fa fa-times-circle-o').addClass('fa fa-check-circle-o');                           
                            break;
                        case 3:
                            $('#check_selfie_with_identity').removeClass('uplred');
                            $('#check_selfie_with_identity').removeClass('uplsilver').addClass('uplgreen');                              
                            $('#status_selfie_id').removeClass('fa fa-arrow-up');
                            $('#status_selfie_id').removeClass('fa fa-times-circle-o').addClass('fa fa-check-circle-o');                           
                            break;
                        case 4:
                            $('#msg_ucpf_upload').text(' (Foi anexado)');                            
                            break;
                        default:
                            ;                        
                    }
                    $("body").css("cursor", "default");
                    $('#wait').hide();
                }
                else{
                    modal_alert_message(response['message']);
                    switch (id) {
                        case 0:
                            $('#check_front_credit_card').removeClass('uplsilver');
                            $('#check_front_credit_card').removeClass('uplgreen').addClass('uplred');                            
                            $('#status_front_cc').removeClass('fa fa-arrow-up');                            
                            $('#status_front_cc').removeClass('fa fa-check-circle-o').addClass('fa fa-times-circle-o');                            
                            break;
                        case 1:
                            $('#check_selfie_credit_card').removeClass('uplsilver');
                            $('#check_selfie_credit_card').removeClass('uplgreen').addClass('uplred'); 
                            $('#status_selfie_cc').removeClass('fa fa-arrow-up');
                            $('#status_selfie_cc').removeClass('fa fa-check-circle-o').addClass('fa fa-times-circle-o');                            
                            break;
                        case 2:
                            $('#check_open_identity').removeClass('uplsilver');
                            $('#check_open_identity').removeClass('uplgreen').addClass('uplred');                            
                            $('#status_open_id').removeClass('fa fa-arrow-up');
                            $('#status_open_id').removeClass('fa fa-check-circle-o').addClass('fa fa-times-circle-o');                            
                            break;
                        case 3:
                            $('#check_selfie_with_identity').removeClass('uplsilver');
                            $('#check_selfie_with_identity').removeClass('uplgreen').addClass('uplred');                              
                            $('#status_selfie_id').removeClass('fa fa-arrow-up');
                            $('#status_selfie_id').removeClass('fa fa-check-circle-o').addClass('fa fa-times-circle-o');                            
                            break;                        
                        case 4:
                            $('#msg_ucpf_upload').text('');                            
                            break;
                        default:
                            ;                        
                    }
                    $("body").css("cursor", "default");
                    $('#wait').hide();
                }
            },
            error: function (error) {
                // handle error
                $("body").css("cursor", "default");
            },
            async: true,
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            timeout: 60000
        });
    };
    
    $("#do_sign").click(function () {                
        $.ajax({
            url: base_url+'index.php/welcome/sign_contract',
            data:{
                'ucpf': $('#ucpf').is(":checked"),
                'key': key
            },
            type: 'POST',
            dataType: 'json',
            success: function (response) {
                if(response['success']){
                    $('#modal').modal('show');
                } else
                    modal_alert_message(response['message']);
            }
        });        
    });
    
    $("#phone_number").keydown(function (e) {   
        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
             // Allow: Ctrl+A, Command+A
            (e.keyCode === 65 && (e.ctrlKey === true || e.metaKey === true)) || 
             // Allow: home, end, left, right, down, up
            (e.keyCode >= 35 && e.keyCode <= 40)) {
                 // let it happen, don't do anything
                 return;
        }
        // Ensure that it is a number and stop the keypress
        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
            e.preventDefault();            
        }        
    });

    $("#phone_ddd").keydown(function (e) {   
        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
             // Allow: Ctrl+A, Command+A
            (e.keyCode === 65 && (e.ctrlKey === true || e.metaKey === true)) || 
             // Allow: home, end, left, right, down, up
            (e.keyCode >= 35 && e.keyCode <= 40)) {
                 // let it happen, don't do anything
                 return;
        }
        // Ensure that it is a number and stop the keypress
        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
            e.preventDefault();            
        }        
    });
    
    $("#cpf").keydown(function (e) {   
        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
             // Allow: Ctrl+A, Command+A
            (e.keyCode === 65 && (e.ctrlKey === true || e.metaKey === true)) || 
             // Allow: home, end, left, right, down, up
            (e.keyCode >= 35 && e.keyCode <= 40)) {
                 // let it happen, don't do anything
                return;
        }
        // Ensure that it is a number and stop the keypress
        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
            e.preventDefault();            
        }        
    });
    
    //init();    
}); 

$(function() {
    // Solo numeros
    var i = $('#agency');
    i.keydown(function(ev) {
        var permittedChars = /[0-9]/;
        var v = ev.target.value;
        var k = ev.originalEvent.key;
        var c = ev.originalEvent.keyCode.toString();
        var ctrlKeys = /^(8|35|36|37|38|39|40|46)$/; // delete, backspace, left, right...
        if (k.match(permittedChars)===null && c.match(ctrlKeys)===null) {
            ev.originalEvent.preventDefault();
            return;
        }
        if (k === '.' && v.indexOf('.') !== -1) {
            ev.originalEvent.preventDefault();
            return;
        }
        if (v.length === 12 && c.match(ctrlKeys)===null) {
            ev.originalEvent.preventDefault();
            return;
        }
    });
    var i2 = $('#account');
    i2.keydown(function(ev) {
        var permittedChars = /[0-9]/;
        var v = ev.target.value;
        var k = ev.originalEvent.key;
        var c = ev.originalEvent.keyCode.toString();
        var ctrlKeys = /^(8|35|36|37|38|39|40|46)$/; // delete, backspace, left, right...
        if (k.match(permittedChars)===null && c.match(ctrlKeys)===null) {
            ev.originalEvent.preventDefault();
            return;
        }
        if (k === '.' && v.indexOf('.') !== -1) {
            ev.originalEvent.preventDefault();
            return;
        }
        if (v.length === 12 && c.match(ctrlKeys)===null) {
            ev.originalEvent.preventDefault();
            return;
        }
    });
    var i3 = $('#dig');
    i3.keydown(function(ev) {
        var permittedChars = /[0-9]/;
        var v = ev.target.value;
        var k = ev.originalEvent.key;
        var c = ev.originalEvent.keyCode.toString();
        var ctrlKeys = /^(8|35|36|37|38|39|40|46)$/; // delete, backspace, left, right...
        if (k.match(permittedChars)===null && c.match(ctrlKeys)===null) {
            ev.originalEvent.preventDefault();
            return;
        }
        if (k === '.' && v.indexOf('.') !== -1) {
            ev.originalEvent.preventDefault();
            return;
        }
        if (v.length === 1 && c.match(ctrlKeys)===null) {
            ev.originalEvent.preventDefault();
            return;
        }
    });
});
