$(document).ready(function () {
    var pk='';
    var utm_source= typeof getUrlVars()["utm_source"] !== 'undefined' ? getUrlVars()["utm_source"] : 'NULL';
    var utm_campaign= typeof getUrlVars()["utm_campaign"] !== 'undefined' ? getUrlVars()["utm_campaign"] : 'NULL';
    var utm_content= typeof getUrlVars()["utm_content"] !== 'undefined' ? getUrlVars()["utm_content"] : 'NULL';
    //var has_next_page = false;
    var transaction_id;
    
    //---------ADMIN FUNCTIONS-----------------------------------
    $("#trans").on("hidden.bs.modal", function () {
        if(reload == 1){
            location.reload(); //recargar pagina porque a ordem pode mudar
            reload = 0;
        }
      });
    
    $("#save_transaction_status").click(function () {
        var val = parseInt($("#sel_admin_actions").val());        
        if(val && confirm("Tem certeza que deseja realizar essa operação na transação")){            
            var fn;
            switch (val){
                case 0:
                    fn = '';
                    break;
                case 1:
                    fn = 'approve_transaction';
                    break;
                case 2:
                    fn = 'request_new_photos';
                    break;
                case 3:
                    fn = 'request_new_account';
                    break;
                case 4:
                    fn = 'request_new_sing_us';
                    break;
                case 5:
                    fn = 'request_recuse_and_reverse_money';
                    break;
            }
            if(fn!=''){
                $('#wait_aff').show();
                $.ajax({
                    url: base_url + 'index.php/welcome/'+fn,
                    type: 'POST',
                    dataType: 'json',
                    success: function (response) {  
                        $('#wait_aff').hide();
                        reload = response['reload'];
                        if(reload){
                            var d = new Date();
                            var url_status = base_url + 'assets/img/icones/' + response['src_status']['icon_by_status'];
                            $("#icon_trans").attr("src", url_status+"?"+d.getTime());
                            $("#icon_trans").attr("title", response['src_status']['hint_by_status']);
                        }
                        modal_alert_message(response['message']);
                    },
                    error: function (xhr, status) {                        
                        modal_alert_message('Internal error');                        
                        $('#wait_aff').hide();
                    }
                });                
            }
        }
    });
    
    //---------PRIMARY FUNCTIONS---------------------------------
    $("#btn_sigin_affiliate_steep1").click(function () {
        if($('#affiliate_pass').val()!==$('#affiliate_pass_confirmation').val()){
            modal_alert_message('As senhas devem ser iguais');
        }else{
            complete_name  = validate_element('#affiliate_complete_name', '^[A-ZÃÕÇÁÉÍÓÚÀÈÌÒÙ ]{6,150}$');
            email = validate_element('#affiliate_email', '^[a-zA-Z0-9\._-]+@([a-zA-Z0-9-]{2,}[.])*[a-zA-Z]{2,10}$');
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
        email = validate_element('#affiliate_email_login', '^[a-zA-Z0-9\._-]+@([a-zA-Z0-9-]{2,}[.])*[a-zA-Z]{2,10}$');
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
        transaction_id = this.id;
        $.ajax({
            url: base_url + 'index.php/welcome/get_transaction_datas_by_id',
            data:{
                'id': transaction_id
            },
            type: 'POST',
            dataType: 'json',
            success: function (response) {
                if(response['success']) {               
                    $("#trans_id").text(response['message']['tr_id']);
                    $("#trans_name").text(response['message']['name']);
                    $("#trans_email").text(response['message']['email']);
                    $("#trans_partnerId").text(response['message']['contract_id']);
                    $("#trans_trans_ccb_number").text(response['message']['ccb_number']);
                    $("#trans_utm_source").text(response['message']['utm_source']);
                    $("#trans_utm_campaign").text(response['message']['utm_campaign']);
                    $("#trans_utm_content").text(response['message']['utm_content']);
                    $("#trans_cpf").text(response['message']['cpf']);
                    $("#trans_phone_ddd").text(response['message']['phone_ddd']);
                    $("#trans_phone_number").text(response['message']['phone_number']);
                    $("#trans_date").text(response['message']['solicited_date']);
                    $("#trans_solicited_value").text((response['message']['amount_solicited']/100).toString().replace('.',','));
                    $("#trans_credit_card_name").text(response['message']['credit_card_name']);
                    $("#trans_credit_card_final").text(response['message']['credit_card_final']);
                    $("#trans_bank_name").text(response['message']['bank_name']);
                    $("#trans_bank_code").text(response['message']['bank']);
                    $("#trans_agency").text(response['message']['agency']);
                    $("#trans_account").text(response['message']['account']);
                    $("#trans_dig").text(response['message']['dig']);
                    $("#trans_street_address").text(response['message']['street_address']);
                    $("#trans_number_address").text(response['message']['number_address']);
                    $("#trans_city_address").text(response['message']['city_address']);
                    $("#trans_state_address").text(response['message']['state_address']);
                    $("#trans_cep").text(response['message']['cep']);                                        
                    $("#way_to_spend_name").text(response['message']['way_to_spend_name']);    
                    $("#trans_payment_str").text(response['message']['payment_source_str']);    
                    $("#numb_transactions").text(response['message']['numb_transactions']);    
                    //financials values
                    $("#trans_numb_plots").text(response['message']['number_plots']);    
                    $("#trans_value_plots").text(response['message']['month_value']);    
                    $("#trans_cet").text(response['message']['total_cust_value']);    
                    $("#trans_iof").text(response['message']['IOF']);    
                    $("#trans_tax").text(response['message']['tax']);    
                    $("#trans_cet_m").text(response['message']['CET_PERC']);    
                    $("#trans_cet_a").text(response['message']['CET_YEAR']);    
                    var history = '';
                    for(i=0;i<response['message']['dates'].length;i++){
                        st = get_icon_by_status(response['message']['dates'][i]['status_id']);
                        history += (
                            "<spam title='"+st['hint_by_status']+"' style='float: left; padding-top: 11px; padding-bottom: 11px;' ><spam class='status-history' style='width:80px;'>"+
                                "<img style='width:20px; margin-right:10px' src='"+base_url+"assets/img/icones/"+st['icon_by_status']+"'>"+
                                    toDate(response['message']['dates'][i]['date'])+'</spam></spam>');
                    }
                    $("#status_history").html(history);
                    var d = new Date();
                    var url_status = base_url + 'assets/img/icones/' + response['src_status']['icon_by_status'];
                    $("#icon_trans").attr("src", url_status+"?"+d.getTime());
                    $("#icon_trans").attr("title", response['src_status']['hint_by_status']);
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
    
    $('#edit_save_transaction').click(function () {
        if(confirm("Tem certeza que deseja salvar os dados?")){
            $.ajax({
                url: base_url + 'index.php/welcome/update_transaction_datas_by_id',
                data:{
                    'edit_trans_name':$("#edit_trans_name").val(),
                    'edit_trans_email':$("#edit_trans_email").val(),
                    'edit_trans_phone_ddd':$("#edit_trans_phone_ddd").val(),
                    'edit_trans_phone_number':$("#edit_trans_phone_number").val(),
                    'edit_trans_credit_card_name':$("#edit_trans_credit_card_name").val(),
                    'edit_trans_bank_code':$("#edit_trans_bank_code").val(),
                    'edit_trans_agency':$("#edit_trans_agency").val(),
                    'edit_trans_account':$("#edit_trans_account").val(),
                    'edit_trans_dig':$("#edit_trans_dig").val(),
                    'edit_account_type':$("#edit_trans_account_type").val(),
                    'edit_trans_street_address':$("#edit_trans_street_address").val(),
                    'edit_trans_number_address':$("#edit_trans_number_address").val(),
                    'edit_trans_complement_address':$("#edit_trans_complement_address").val(),
                    'edit_trans_city_address':$("#edit_trans_city_address").val(),
                    'edit_trans_state_address':$("#edit_trans_state_address").val(),
                    'edit_trans_cep':$("#edit_trans_cep").val(),  
                },
                type: 'POST',
                dataType: 'json',
                success: function (response) {
                    if(response['success']) {
                        alert("Dados atualizados com sucesso");
                        $('#trans_edit').modal('hide');
                         location.reload(); 
                    }
                    else{
                        modal_alert_message(response['message']);
                    }
                },
                error: function (xhr, status) {
                    modal_alert_message('Internal error');
                }
            }); 
        }else{
            $('#trans_edit').modal('hide');
        }
    });
    
    $('#btn_edit_trans_cep').click(function () {
        if(validate_element("#edit_trans_cep",'^[0-9]{8}$')){
            $.ajax({
                url: base_url+'index.php/welcome/get_cep_datas',                
                data: {
                    'cep': $('#edit_trans_cep').val(),
                },
                type: 'POST',
                dataType: 'json',
                success: function (response) {
                    if(response['success']){
                        response = response['datas'];
                        $('#edit_trans_number_address').val("");
                        $('#edit_trans_complement_address').val("");
                        $('#edit_trans_street_address').val(response['logradouro']);
                        $('#edit_trans_city_address').val(response['localidade']);
                        $('#edit_trans_state_address').val(response['uf']);                        
                        $('#edit_trans_address_container').css({"visibility":"visible", "display":"block"}); 
                    } else
                        modal_alert_message('CEP inválido');
                }
            });
        } else{
            modal_alert_message('CEP inválido');
        }
    });
    
    $('.btn_edit_trnsaction').click(function () {
        transaction_id = this.id.replace("edit", "");
        $.ajax({
            url: base_url + 'index.php/welcome/get_transaction_datas_by_id',
            data:{
                'id': transaction_id
            },
            type: 'POST',
            dataType: 'json',
            success: function (response) {
                if(response['success']) {               
                    $("#edit_trans_id").val('#'+response['message']['tr_id']);
                    $("#edit_trans_name").val(response['message']['name']);
                    $("#edit_trans_email").val(response['message']['email']);
                    $("#edit_trans_cpf").val(response['message']['cpf']);
                    $("#edit_trans_phone_ddd").val(response['message']['phone_ddd']);
                    $("#edit_trans_phone_number").val(response['message']['phone_number']);
                    
                    $("#edit_trans_partnerId").val('PartnerId: '+response['message']['contract_id']);
                    $("#edit_trans_trans_ccb_number").val('CCB_numb: '+response['message']['ccb_number']);                    
                    $("#edit_trans_date").text(response['message']['solicited_date']);
                    $("#edit_trans_solicited_value").text((response['message']['amount_solicited']/100).toString().replace('.',','));
                    
                    $("#edit_trans_credit_card_name").val(response['message']['credit_card_name']);
                    $("#edit_trans_credit_card_final").val('Final '+response['message']['credit_card_final']);
                    
                    $("#edit_trans_bank_code").val(response['message']['bank']);
                    $("#edit_trans_agency").val(response['message']['agency']);
                    $("#edit_trans_account").val(response['message']['account']);
                    $("#edit_trans_dig").val(response['message']['dig']);
                    $("#edit_trans_account_type").val(response['message']['account_type']);
                    
                    $("#edit_trans_street_address").val(response['message']['street_address']);
                    $("#edit_trans_number_address").val(response['message']['number_address']);
                    $("#edit_trans_complement_address").val(response['message']['complement_number_address']);
                    $("#edit_trans_city_address").val(response['message']['city_address']);
                    $("#edit_trans_state_address").val(response['message']['state_address']);
                    $("#edit_trans_cep").val(response['message']['cep']);                                        

                    //financials values
                    $("#edit_trans_numb_plots").text(response['message']['number_plots']);    
                    $("#edit_trans_value_plots").text(response['message']['month_value']);    
                    $("#edit_trans_cet").text(response['message']['total_cust_value']);    
                    $("#edit_trans_iof").text(response['message']['IOF']);    
                    $("#edit_trans_tax").text(response['message']['tax']);    
                    $("#edit_trans_cet_m").text(response['message']['CET_PERC']);    
                    $("#edit_trans_cet_a").text(response['message']['CET_YEAR']);    
                    
                    $("#edit_icon_trans").attr("title", response['src_status']['hint_by_status']);
                    $('#trans_edit').modal('show');
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
    
    $('.btn_delete_trnsaction').click(function () {
        transaction_id = this.id.replace("edit", "");
        if(confirm("Confirma eliminar essa transação do banco de dados?")){
            $.ajax({
                url: base_url + 'index.php/welcome/delete_transaction_datas_by_id',
                data:{
                    'id': transaction_id
                },
                type: 'POST',
                dataType: 'json',
                success: function (response) {
                    if(response['success']) {               
                        alert('Transação e dependencias eliminadas corretamente');
                         location.reload(); 
                    }
                    else{
                        modal_alert_message(response['message']);
                    }
                },
                error: function (xhr, status) {
                    modal_alert_message('Internal error');
                }
            });         
        }
    });
    
    function get_icon_by_status($status_id) {
        BEGINNER= '1';
        WAIT_SIGNATURE = '2';
        APPROVED = '3';
        WAIT_PHOTO = '4';
        WAIT_ACCOUNT = '5';
        TOPAZIO_APROVED = '6';
        TOPAZIO_IN_ANALISYS = '7';
        TOPAZIO_DENIED = '8';
        REVERSE_MONEY = '9';
        PENDING = '22';
        switch ($status_id) {
            case BEGINNER:
                return {'hint_by_status':'BEGGINER','icon_by_status':'8 BEGGINER.png'};
            case WAIT_SIGNATURE:
                return {'hint_by_status':'WAIT_SIGNATURE','icon_by_status':'6 AGUARD.png'}; 
            case APPROVED:
                return {'hint_by_status':'APPROVED','icon_by_status':'3 APROV.png'};
            case WAIT_PHOTO:
                return {'hint_by_status':'WAIT_PHOTO','icon_by_status':'6 AGUARD.png'};
            case WAIT_ACCOUNT:
                return {'hint_by_status':'WAIT_ACCOUNT','icon_by_status':'6 AGUARD.png'};
            case TOPAZIO_APROVED:
                return {'hint_by_status':'TOPAZIO_APROVED','icon_by_status':'1 APROV  TOP.png'};
            case TOPAZIO_IN_ANALISYS:
                return {'hint_by_status':'TOPAZIO_IN_ANALISYS','icon_by_status':'2 AGUARD TOP.png'};
            case TOPAZIO_DENIED:
                return {'hint_by_status':'TOPAZIO_DENIED','icon_by_status':'4 REPROV TOP.png'};
            case REVERSE_MONEY:
                return {'hint_by_status':'REVERSE_MONEY','icon_by_status':'5 REPROV DEVOLVIDO.png'};
            case PENDING:
                return {'hint_by_status':'PENDING FOR ANALYSIS','icon_by_status':'7 PENDENTE.png'};
        }
    }
        
    $('#get_url_contract').click(function () {
        $.ajax({
            url: base_url+'index.php/welcome/get_url_contract',            
            data:{},
            type: 'POST',
            dataType: 'json',
            success: function (response) {
                if(response['success']) {
                    window.open(response['url_contract'], 'Contrato - Livre.digital');
                    return false;
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
        
    $('#actual_page').click(function () {
        return false;
    });
    
    $('#prev_page').click(function () {
        if(num_page>1){
            num_page--;
            $('#num_page').val(num_page);    
            $('#btn_afiliate_search').click();                        
        }
        return false;
    });
    
    $('#next_page').click(function () {        
        if(has_next_page){
            num_page++;            
            $('#num_page').val(num_page);
            $('#btn_afiliate_search').click();                        
        }
        return false;
    });
    
    $('#go_page').click(function () {
        if($('#page_pos').val()>=1 && $('#page_pos').val()<=last_page){
            num_page = $('#page_pos').val();
            $('#num_page').val(num_page);    
            $('#btn_afiliate_search').click();                        
        }
        else{
            modal_alert_message('Esse valor não está no intervalo de páginas');
        }
        return false;
    });
    
    if(num_page==1) 
        $('#prev_page').css({'color':'silver'});
    else
        $('#prev_page').css({'color':'black'});
    
    if(!has_next_page)
        $('#next_page').css({'color':'silver'});
    else
        $('#next_page').css({'color':'black'});
    
    
    $('#init_date').change(function (e) {
        num_page = 1;            
        $('#num_page').val(num_page);
    });
    
    $('#end_date').change(function (e) {
        num_page = 1;            
        $('#num_page').val(num_page);
    });
    
    $('#token').change(function (e) {
        num_page = 1;            
        $('#num_page').val(num_page);
    });
    
    //----------------------SECUNDARY FUNCTIONS-------------------------------
       
    $('#container_form_steep_1').keypress(function (e) {
        if (e.which == 13) {
            $("#btn_sigin_affiliate_steep1").click();
            return false;
        }
    });

    $('#container_form_steep_2').keypress(function (e) {
        if (e.which == 13) {
            $("#btn_sigin_affiliate_steep2").click();
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
    
    $("#export_transactions").on("click", function(){                        
        $(location).attr('href',base_url+'index.php/welcome/export_transactions');                                                                      
    });
    
    $("#export_leads").on("click", function(){                
        $(location).attr('href',base_url+'index.php/welcome/export_leads');
    });
    
    function toDate(number){    
        var a = new Date(number*1000);
        var year = a.getFullYear();
        var month = a.getMonth()+1;
        if(month <= 9)
            month = '0'+month;

        var date = a.getDate();
        if(date <= 9)
            date = '0'+date;
        var t = date + '/' + month + '/' + year;
        return t;
    }
    
    
    /************UPLOADING PHOTO/***********/    
    $("#avatar").on("change", function (e) {
        var file = $(this)[0].files[0];        
        var upload = new Upload(file);
        // execute upload
        upload.doUpload(0);
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

        $.ajax({
            type: "POST",
            dataType: 'json',
            url: base_url+'index.php/welcome/upload_file_affiliate',
            xhr: function () {
                var myXhr = $.ajaxSettings.xhr();
                if (myXhr.upload) {
                    //myXhr.upload.addEventListener('progress', that.progressHandling, false);
                }
                return myXhr;
            },
            success: function (response) {                
                if(response['success']){                    
                    $("#avatar_img").attr("src",response['message']);                                        
                }
                else{
                    alert(response['message']);                    
                }
            },
            error: function (error) {
                // handle error
            },
            async: true,
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            timeout: 60000
        });
    };    
    /************END UPLOADING PHOTO/***********/
    $('.foto_usr').click(function () {
        var id = this.id;        
        $.ajax({
            url: base_url+'index.php/welcome/get_url_image',            
            data:{id:id},
            type: 'POST',
            dataType: 'json',
            success: function (response) {
                if(response['success']) {                    
                    var left  = ($(window).width()/2)-(640/2),
                    top   = ($(window).height()/2)-(480/2);
                    window.open(base_url + response['url_image']+'?refresh='+$.now(), '','width=640,height=480, top='+top+', left='+left);
                    return false;
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

}); 
