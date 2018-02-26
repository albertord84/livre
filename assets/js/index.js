$(document).ready(function () {
    
    var solicited_value=0;
    var amount_months=parseInt($("#range").val());    
    var utm_source= typeof getUrlVars()["utm_source"] !== 'undefined' ? getUrlVars()["utm_source"] : 'NULL';
    var slideToggle=1;
    
    
    $('#verify_container').keypress(function (e) {
        if (e.which == 13) {
            $("#btn_verify").click();
            return false;
        }
    });
    
    $("#btn_contratar_emprestimo").hover(
            function (e) {
                //modal_alert_message($(e.target).attr('id'))
                $('#btn_contratar_emprestimo').css('cursor', 'pointer');
            },
            function () {
                $('#btn_contratar_emprestimo').css('cursor', 'default');
            }
    );
    
    
    $("#range").change(function () {
        amount_months=$("#range").val();
        $("#result-value1").text($("#range").val());
        $("#result-value2").text($("#range").val());
        $(".its li").addClass('at');
        verify(0);
    });
            
    $("#btn_verify").click(function () {
        verify(1);
    });
    
    $("#lnk_checkout").click(function () {
        $('#ctn_verify').toggle("hide");
        $('#ctn_verify').toggle("slow");
        $("#input_verify").focus();
    });
    
    function verify(flag){
        if($('#input_verify').val()===''){
           modal_alert_message("Entre o valor que deseja receber emprestado");
        }else{
            solicited_value = $('#input_verify').val();
            solicited_value = solicited_value.replace('R$ ','');
            solicited_value = solicited_value.replace(',','.');
            solicited_value = parseFloat(solicited_value);            
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
                    //$('#permited_value').text('R$ '+response['permited_value']);
                    $('#total_cust_value').text('R$ '+response['total_cust_value']);
                    if (response['success']) {
                        //response['permited_value']=response['permited_value'].replace('.',',');
                        //$('#permited_value').css('color','white');
                        if(flag==1 && slideToggle==1){
                            set_global_var('slideToggle', 0);
                            $('.result').slideToggle(150);                            
                        }
                    }
                    else{
                        $('#permited_value').css('color','red');
                        modal_alert_message(response['message']);
                    }
                },
                error: function (xhr, status) {
                    modal_alert_message('Internal error Verify value');
                }
            });              
        }
    }
    
    $('#btn_contratar_emprestimo').click(function () {
        if($('#input_verify').val()===''){
           modal_alert_message("Operação não permitida");
        }else{
            solicited_value = $('#input_verify').val();
            solicited_value = solicited_value.replace('R$ ','');
            solicited_value = solicited_value.replace(',','.');
            solicited_value = parseFloat(solicited_value);
            params="utm_source="+utm_source+"&solicited_value="+solicited_value+"&frm_money_use_form="+$('#money_use_form').val()+"&amount_months="+amount_months;
            url=base_url+"index.php/welcome/checkout?"+params;
            $(location).attr('href',url);
        }
    });
    
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
    
    function set_global_var(str, value) {
        switch (str) {
            case 'solicited_value':
                solicited_value = value;
                break;            
            case 'amount_months':
                amount_months = value;
                break;                        
            case 'slideToggle':
                slideToggle = value;
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
    
    
    
    
}); 