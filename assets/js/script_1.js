$(document).ready(function(){    
    
    function codify(str){
        str = cs1(str);
        str = cs2(str);
        str = cs3(str);
        str = cs4(str);
        str = cs5(str);
        return  str;
    }
    
    function decodify(str){
        str = anti_cs5(str);
        str = anti_cs4(str);
        str = anti_cs3(str);
        str = anti_cs2(str);
        str = anti_cs1(str);
        return  str;
    }
    
    function cs1(str){
        k=0;
        var new_str=new Array();
        for(i=0;i<str.length;i++){
            if(i%2===0){                
                new_str[k]=getRandomArbitrary(0,9);                
                k++;
                new_str[k]=str[i];
            }
            else
                new_str[k]=str[i];
            k++;
        }        
        new_str=new_str.toString();
        return new_str.replace(/,/g,'');
    }
    
    function anti_cs1(str){
        k=0;
        var new_str=new Array();
        for(i=0;i<str.length;i++){
            if(i%3===0){                
//                new_str[k]=getRandomArbitrary(0,9);                
//                k++;
//                new_str[k]=str[i];
            }
            else
                new_str[k]=str[i];
            k++;
        }        
        new_str=new_str.toString();
        return new_str.replace(/,/g,'');
    }
    
    function cs2(str){        
        var new_str=new Array();
        for(i=0;i<str.length;i++){ 
            tmp=str[i].charCodeAt(0)+13;                        
            new_str[i]=String.fromCharCode(tmp);
        }
        new_str=new_str.toString();
        return new_str.replace(/,/g,'');
    }
    
    function anti_cs2(str){        
        var new_str=new Array();
        for(i=0;i<str.length;i++){ 
            tmp=str[i].charCodeAt(0)-13;                        
            new_str[i]=String.fromCharCode(tmp);
        }
        new_str=new_str.toString();
        return new_str.replace(/,/g,'');
    }
    
    function cs3(str){
        k=0;
        var new_str=new Array();
        for(i=0;i<str.length;i++){
            if(i%5===0){                
                new_str[k]=getRandomArbitrary(0,9);                
                k++;
                new_str[k]=str[i];
            }
            else
                new_str[k]=str[i];
            k++;
        }        
        new_str=new_str.toString();
        return new_str.replace(/,/g,'');
    }
    
    function anti_cs3(str){
        k=0;
        var new_str=new Array();
        for(i=0;i<str.length;i++){
            if(i%6===0){                
//                new_str[k]=getRandomArbitrary(0,9);                
//                k++;
//                new_str[k]=str[i];
            }
            else
                new_str[k]=str[i];
            k++;
        }        
        new_str=new_str.toString();
        return new_str.replace(/,/g,'');
    }
    
    function cs4(str){
        var new_str=new Array();
        for(i=0;i<str.length;i++){ 
            tmp=str[i].charCodeAt(0)*2;                        
            new_str[i]=String.fromCharCode(tmp);
        }
        new_str=new_str.toString();
        return new_str.replace(/,/g,'');
    }
    
    function anti_cs4(str){
        var new_str=new Array();
        for(i=0;i<str.length;i++){ 
            tmp=str[i].charCodeAt(0)/2;                        
            new_str[i]=String.fromCharCode(tmp);
        }
        new_str=new_str.toString();
        return new_str.replace(/,/g,'');
    }
    
    function cs5(str){
        var new_str=new Array();
        k=0;
        for(i=str.length-1;i>=0;i--){                       
            new_str[k]=str[i];
            k++;
        }
        new_str=new_str.toString();
        return new_str.replace(/,/g,'');
    }
    
    function anti_cs5(str){
        var new_str=new Array();
        k=0;
        for(i=str.length-1;i>=0;i--){                       
            new_str[k]=str[i];
            k++;
        }
        new_str=new_str.toString();
        return new_str.replace(/,/g,'');
    }
    
    function getRandomArbitrary(min, max) {
        return parseInt(Math.random() * (max - min) + min);
    }
    
    
    
    var num_profiles, flag = false;
    var verify = false, flag_unfollow_request = false;
    unfollow_total = parseInt(unfollow_total);
    autolike = parseInt(autolike);
    play_pause = parseInt(play_pause);
    init_unfollow_type();
    init_autolike_type();
    init_play_pause_type();
    flag_black_list=false;
    flag_white_list=false;
    
        
    function modal_alert_message(text_message){
        $('#modal_alert_message').modal('show');
        $('#message_text').text(text_message);        
    }
    
    $("#accept_modal_alert_message").click(function () {
        $('#modal_alert_message').modal('hide');
    });
    
    
    //----------------------------------------------------------------------------------------------------------
    //PERFIS DE REFERENCIA
    $("#dicas_geoloc").click(function(){
        url=base_url+"index.php/welcome/dicas_geoloc";
        window.open(url,'_blank');
    });    
    
    $("#btn_add_new_profile").hover(
            function () {
                $('#btn_add_new_profile').css('cursor', 'pointer');
            },
            function () {
                $('#btn_add_new_profile').css('cursor', 'default');
        });
    
    
    $("#dicas_geoloc").hover(
        function(){
            $('#dicas_geoloc').css('cursor', 'pointer');
        },
        function(){
            $('#dicas_geoloc').css('cursor', 'default');
        }
    );    
    
    $("#btn_verify_account").click(function () {
        if (!verify) {
            $("#btn_verify_account").text('CONFIRMO ATIVAÇÃO');
            $("#lnk_verify_account").attr('target', '_blank');
            $("#lnk_verify_account").attr("href", 'https://www.instagram.com/challenge/');
            verify = true;
        } else {
            $("#lnk_verify_account").attr('target', '_self');
            $("#lnk_verify_account").attr("href", base_url + 'index.php/welcome/log_out');
            //$("#lnk_verify_account").attr("href", base_url + 'index.php/welcome/client');
            //$(location).attr('href',base_url+'index.php/welcome/client');
            verify = false;
        }
    });

    $(".img_profile").hover(
            function (e) {
                //modal_alert_message($(e.target).attr('id'))
                $('.img_profile').css('cursor', 'pointer');
            },
            function () {
                $('.img_profile').css('cursor', 'default');
            }
    );

    $("#my_img").hover(
            function () {
                $('#my_img').css('cursor', 'pointer');
            },
            function () {
                $('#my_img').css('cursor', 'default');
            }
    );

    $(".red_number").hover(
            function () {
                $('.red_number').css('cursor', 'pointer');
            },
            function () {
                $('.red_number').css('cursor', 'default');
            }
    );
    
    $("#my_container_toggle").hover(
            function () {
                $('#my_container_toggle').css('cursor', 'pointer');
            },
            function () {
                $('#my_container_toggle').css('cursor', 'default');
            }
    );
    
    $("#my_container_toggle_autolike").hover(
            function () {
                $('#my_container_toggle_autolike').css('cursor', 'pointer');
            },
            function () {
                $('#my_container_toggle_autolike').css('cursor', 'default');
            }
    );    
});

