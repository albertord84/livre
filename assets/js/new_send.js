$(document).ready(function () {
    
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
    
    $("#new_cartao").on("change", function (e) {
        var file = $(this)[0].files[0];        
        var upload = new Upload2(file);
        // execute upload
        upload.doUpload(0);
        //alert("file upload");
    });    
    
    $("#new_selcartao").on("change", function (e) {
        var file = $(this)[0].files[0];        
        var upload = new Upload2(file);
        // execute upload
        upload.doUpload(1);
        //alert("file upload");
    });
    
    $("#new_id").on("change", function (e) {
        var file = $(this)[0].files[0];        
        var upload = new Upload2(file);
        // execute upload
        upload.doUpload(2);
        //alert("file upload");
    });
    
    $("#new_selid").on("change", function (e) {
        var file = $(this)[0].files[0];        
        var upload = new Upload2(file);
        // execute upload
        upload.doUpload(3);
        //alert("file upload");
    });
    
    $("#new_ucpf").change(function() {
        if(this.checked) {
            $('#new_ucpf_img').trigger('click'); 
        }
    });
    
    $("#new_ucpf_img").on("change", function (e) {
        var file = $(this)[0].files[0];        
        var upload = new Upload2(file);
        // execute upload
        upload.doUpload(4);
        //alert("file upload");
    });
    
    var Upload2 = function (file) {
    this.file = file;
    };

    Upload2.prototype.getType = function() {
        return this.file.type;
    };
    Upload2.prototype.getSize = function() {
        return this.file.size;
    };
    Upload2.prototype.getName = function() {
        return this.file.name;
    };
    
    Upload2.prototype.doUpload = function (id) {
        var that = this;
        var formData = new FormData();
        var trid = typeof getUrlVars()["trid"] !== 'undefined' ? getUrlVars()["trid"] : 'NULL';
        
        // add assoc key values, this will be posts values
        formData.append("file", this.file, this.getName());
        formData.append("upload_file", true);        
        formData.append("id", id);        
        formData.append("trid", trid);        

        $("body").css("cursor", "wait");
        $('#wait_resend').show();
        $.ajax({
            type: "POST",
            dataType: 'json',
            url: base_url+'index.php/welcome/new_upload_file',
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
                    modal_alert_message('Arquivo enviado com sucesso!');
                    switch (id) {
                        case 0:
                            $('#new_check_front_credit_card').removeClass('uplred');
                            $('#new_check_front_credit_card').removeClass('uplsilver').addClass('uplgreen');                            
                            $('#new_status_front_cc').removeClass('fa fa-arrow-up');
                            $('#new_status_front_cc').removeClass('fa fa-times-circle-o').addClass('fa fa-check-circle-o');                            
                            break;
                        case 1:
                            $('#new_check_selfie_credit_card').removeClass('uplred');
                            $('#new_check_selfie_credit_card').removeClass('uplsilver').addClass('uplgreen'); 
                            $('#new_status_selfie_cc').removeClass('fa fa-arrow-up');
                            $('#new_status_selfie_cc').removeClass('fa fa-times-circle-o').addClass('fa fa-check-circle-o');                            
                            break;
                        case 2:
                            $('#new_check_open_identity').removeClass('uplred');
                            $('#new_check_open_identity').removeClass('uplsilver').addClass('uplgreen');                            
                            $('#new_status_open_id').removeClass('fa fa-arrow-up');
                            $('#new_status_open_id').removeClass('fa fa-times-circle-o').addClass('fa fa-check-circle-o');                           
                            break;
                        case 3:
                            $('#new_check_selfie_with_identity').removeClass('uplred');
                            $('#new_check_selfie_with_identity').removeClass('uplsilver').addClass('uplgreen');                              
                            $('#new_status_selfie_id').removeClass('fa fa-arrow-up');
                            $('#new_status_selfie_id').removeClass('fa fa-times-circle-o').addClass('fa fa-check-circle-o');                           
                            break;
                        default:
                            ;                        
                    }
                    $("body").css("cursor", "default");
                    $('#wait_resend').hide();
                }
                else{
                    $("body").css("cursor", "default");
                    $('#wait_resend').hide();
                    modal_alert_message(response['message']);
                    switch (id) {
                        case 0:
                            $('#new_check_front_credit_card').removeClass('uplsilver');
                            $('#new_check_front_credit_card').removeClass('uplgreen').addClass('uplred');                            
                            $('#new_status_front_cc').removeClass('fa fa-arrow-up');                            
                            $('#new_status_front_cc').removeClass('fa fa-check-circle-o').addClass('fa fa-times-circle-o');                            
                            break;
                        case 1:
                            $('#new_check_selfie_credit_card').removeClass('uplsilver');
                            $('#new_check_selfie_credit_card').removeClass('uplgreen').addClass('uplred'); 
                            $('#new_status_selfie_cc').removeClass('fa fa-arrow-up');
                            $('#new_status_selfie_cc').removeClass('fa fa-check-circle-o').addClass('fa fa-times-circle-o');                            
                            break;
                        case 2:
                            $('#new_check_open_identity').removeClass('uplsilver');
                            $('#new_check_open_identity').removeClass('uplgreen').addClass('uplred');                            
                            $('#new_status_open_id').removeClass('fa fa-arrow-up');
                            $('#new_status_open_id').removeClass('fa fa-check-circle-o').addClass('fa fa-times-circle-o');                            
                            break;
                        case 3:
                            $('#new_check_selfie_with_identity').removeClass('uplsilver');
                            $('#new_check_selfie_with_identity').removeClass('uplgreen').addClass('uplred');                              
                            $('#new_status_selfie_id').removeClass('fa fa-arrow-up');
                            $('#new_status_selfie_id').removeClass('fa fa-check-circle-o').addClass('fa fa-times-circle-o');                            
                            break
                        default:
                            ;                                 
                    }
                }
            },
            error: function (error) {
                // handle error
                $("body").css("cursor", "default");
                $('#wait_resend').hide();
            },
            async: true,
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            timeout: 60000
        });
    };
    
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
    
    $("#send_new_photos").click(function () {          
        var new_ucpf = $('#new_ucpf').is(":checked"), 
            trid = typeof getUrlVars()["trid"] !== 'undefined' ? getUrlVars()["trid"] : 'NULL';
        $.ajax({
            url: base_url+'index.php/welcome/new_finished_upload',
            data:{
                'new_ucpf': new_ucpf,
                'trid': trid
            },
            type: 'POST',
            dataType: 'json',
            success: function (response) {
                if(response['success']){
                    modal_alert_message(response['message']);
                } else
                    modal_alert_message(response['message']);
            }
        });        
    });
    
}); 
