$(document).ready(function(){       
    
    
    function modal_alert_message(text_message){
        $('#modal_alert_message').modal('show');
        $('#message_text').text(text_message);
    }
    
    $("#accept_modal_alert_message").click(function () {
        $('#modal_alert_message').modal('hide');
    });
    
    $("#btn_modal_close").click(function() {
        $('#modal_alert_message').modal('hide');
    });
    
    $("#btn_send_message").click(function(){
        name=validate_empty('#field_name');
        email=validate_element('#field_email',"^[a-zA-Z0-9\._-]+@([a-zA-Z0-9-]{2,}[.])*[a-zA-Z]{2,10}$");
        message=validate_empty('#field_message');
        if(name && email && message){
            //var l= Ladda.create(this);              
            //l.start();            
            $.ajax({
                url : base_url+'index.php/welcome/message',
                data :{ 'name':$("#field_name").val(),
                        'email':$("#field_email").val(),
                        'message':$("#field_message").val()
                    },
                type : 'POST',
                dataType : 'json',
                success : function(response){
                    if(response['success']){
                        modal_alert_message(response['message']);
                    } else
                        modal_alert_message(response['message']);    
                    //l.stop();
                    $("#field_name").val("");
                    $("#field_email").val("");
                    $("#field_message").val(""); 
                },
                error : function(xhr, status) {
//                    modal_alert_message(T('Erro enviando a mensagem, tente depois...'));
//                    //l.stop();
//                    $("#field_name").val("");
//                    $("#field_email").val("");
//                    $("#field_message").val(""); 
                    alert('Confira sua conexão a Internet')
                }
            });
        } else{
            modal_alert_message("Alguns dados incorretos");            
        }
    });    
              
    $('#talkme_frm').keypress(function (e) {
        if (e.which == 13) {
            $("#btn_send_message").click();
            return false;
        }
    });
    
    function validate_element(element_selector,pattern){
        if(!$(element_selector).val().match(pattern)){
            $(element_selector).css("border", "1px solid red");
            return false;
        } else{
            $(element_selector).css("border", "1px solid gray");
            return true;
        }
    } 
    
    function validate_empty(element_selector){
        if($(element_selector).val()===''){
            $(element_selector).css("border", "1px solid red");
            return false;
        } else{
            $(element_selector).css("border", "1px solid gray");
            return true;
        }
    } 
 }); 