$(document).ready(function () {
    
    function modal_alert_message(text_message){       
        $('#modal_alert_message').modal('show');        
        $('#message_text').text(text_message);
    }
    
    $("#accept_modal_alert_message").click(function () {
        $('#modal_alert_message').modal('hide');
    });    
    
    $("#btn_abstract_admin_search").click(function () {        
        var initDate = $('#abstract_init_date').val(), init_date = '';
        
        if(initDate!=""){
            initDate = initDate.split("-");        
            init_date = toTimestamp(initDate[1]+"/"+initDate[2]+"/"+initDate[0]);            
        }
        
        var endDate = $('#abstract_end_date').val(), end_date = '';
        
        if(endDate!=""){
            endDate = endDate.split("-");        
            end_date = toTimestamp(endDate[1]+"/"+endDate[2]+"/"+endDate[0]);
        }
        
        $.ajax({
            url: base_url+'index.php/welcome/filter_resume',                
            data: {
                'abstract_init_date': init_date,
                'abstract_end_date':end_date
            },
            type: 'POST',
            dataType: 'json',
            success: function (response) { 
                $("#num_transactions").html(response['total_transactions']);
                $("#total_cet").html('R$ '+response['total_CET']);
                $("#total_tomado").html('R$ '+response['loan_value']);
                $("#ave_ticket").html('R$ '+response['average_ticket']);
                $("#ave_plot").html(response['average_amount_months'] + ' X');                
                $("#ave_iof").html('R$ '+response['average_iof']);                
                $("#ave_tax").html(response['average_tax']+' %');                
            }
        });        
    });
}); 

function toTimestamp(strDate){
    if(!strDate)
        return null;
    var datum = Date.parse(strDate);
    return datum/1000;
}