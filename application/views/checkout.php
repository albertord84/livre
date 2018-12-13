<!DOCTYPE html>
<html lang="pt-BR">
    <head>
	<meta charset="UTF-8">
	<title>Livre.digital</title>
	<meta name="viewport" content="width=device-width">
	<link rel="shortcut icon" type="image/png" href="<?php echo base_url().'assets/'?>img/icones/favicon.jpeg">

	<!-- Font Awesome -->
	<link rel="stylesheet" href="<?php echo base_url().'assets/css/font-awesome/font-awesome.min.css'?>">

	<!-- GALERIA -->	
        <link rel="stylesheet" type="text/css" href="<?php echo base_url().'assets/galeria/css/fresco/fresco.css?'.$SCRIPT_VERSION;?>" />

	<!-- Bootstrap -->
	<link rel="stylesheet" href="<?php echo base_url().'assets/css/bootstrap.min.css?'.$SCRIPT_VERSION;?>">
	<link rel="stylesheet" href="<?php echo base_url().'assets/css/bootstrap-multiselect.css?'.$SCRIPT_VERSION;?>">

	<!-- Owl Carousel Assets -->
	<link href="<?php echo base_url().'assets/css/carousel/owl.carousel.css?'.$SCRIPT_VERSION;?>" rel="stylesheet">
	<link href="<?php echo base_url().'assets/css/carousel/owl.theme.css?'.$SCRIPT_VERSION;?>" rel="stylesheet">
	<link href="<?php echo base_url().'assets/css/carousel/owl.transitions.css?'.$SCRIPT_VERSION;?>" rel="stylesheet">

	<!-- CSS -->
	<link rel="stylesheet" href="<?php echo base_url().'assets/css/estilo.css?'.$SCRIPT_VERSION;?>" />
	<link rel="stylesheet" href="<?php echo base_url().'assets/css/definicoes.css?'.$SCRIPT_VERSION;?>" />
	<link rel="stylesheet" href="<?php echo base_url().'assets/css/media.css?'.$SCRIPT_VERSION;?>" />
        
        <!-- IUGU JS -->
        <script type="text/javascript" src="https://js.iugu.com/v2"></script>
                
        <!-- JS -->
        <script type="text/javascript">
            var base_url = '<?php echo base_url();?>';
            var key = '<?php echo $key;?>';
        </script>
        
        <?php include_once "pixel_facebook.php";?>
        <?php include_once "pixel_gtags.php";?>        
        <?php //include_once "pixel_ecomerce_analytics.php";?>
        <?php // include_once "pixel_adwords.php";?>
        <?php include_once "pixel_bing.php";?>
        <?php include_once "pixel_linkedin.php";?>
        <?php include_once "pixel_crazy_egg.php";?>
        <?php date_default_timezone_set('America/Sao_Paulo'); ?>
    </head>
<!--    <body>
	<header class="fleft100 pd-tb30 pabsolute m-top50 m-none-xs text-center">
            <div class="container">
                <div class="col-md-10 col-sm-12 col-xs-12 fnone i-block">
                    <div class="logo col-md-3 col-sm-3 col-xs-12 pd-0 center-xs m-top12 text-left"><a href="<?php echo base_url();?>"><img src="<?php echo base_url().'assets/'?>img/icones/logo.png" alt=""></a></div>
                    <div class="col-md-6 col-sm-6 col-xs-12 text-left">
                        <div class="fleft100">
                            <h1 class="fw-600 ft-size45 ft-Rajdhani cl-green"><i>Falta pouco!</i></h1>
                            <h3 class="cl-fff ft-Rajdhani">Só precisamos de mais alguns dados:</h3>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-3 col-xs-12 pd-0 text-right center-xs m-top20">
                        <ul class=" sociais i-block">
                            <li><a href="https://www.instagram.com/livre.digital/" target="_blank"><img src="<?php echo base_url().'assets/'?>img/icones/ig.png"></a></li>
                            <li class="tv cl-fff">|</li>
                            <li><a href="https://m.facebook.com/Livre.dig/?tsid=0.714847921740313&source=result&__nodl&_rdr" target="_blank"><img src="<?php echo base_url().'assets/'?>img/icones/fb.png"></a></li>
                            <li class="tv cl-fff">|</li>
                        </ul>
                        <ul class="menu i-block m-top10-xs">				
                            <li><a href="#contact_me">Suporte</a></li>
                            
                        </ul>                        
                    </div>
                </div>
            </div>
	</header>-->

    <body>
	<header class="fleft100 m-none-xs text-center m-top20"  id="bcheck">
		<div class="container">
			<div class="col-md-10 col-sm-12 col-xs-12 fnone i-block">
				<div class="logo col-md-3 col-sm-3 col-xs-12 pd-0 center-xs m-top12 text-left"><a href="<?php echo base_url();?>"><img src="<?php echo base_url().'assets/'?>img/icones/logo.png" alt=""></a></div>
				<div class="col-md-9 col-sm-9 col-xs-12 pd-0 text-right center-xs m-top20">
<!--					<ul class="menu i-block m-top10-xs">				
						<li><a href="">Suporte</a></li>
						<li class="tv cl-fff">|</li>
						<li><a href="">Afiliados</a></li>
					</ul>-->
                                        <ul class=" sociais i-block">
                                            <li><a href="https://www.instagram.com/livre.digital/" target="_blank"><img src="<?php echo base_url().'assets/'?>img/icones/ig.png"></a></li>
                                            <li class="tv cl-fff">|</li>
                                            <li><a href="https://m.facebook.com/Livre.dig/?tsid=0.714847921740313&source=result&__nodl&_rdr" target="_blank"><img src="<?php echo base_url().'assets/'?>img/icones/fb.png"></a></li>
                                            <li class="tv cl-fff">|</li>
                                        </ul>
                                        <ul class="menu i-block m-top10-xs">				
                                            <li><a href="#contact_me">Suporte</a></li>
                                        </ul>
				</div>				
			</div>
                        <div class="fleft100">
                            <div class="col-md-12 col-sm-12 col-xs-12 text-left center-sm">
                                    <div class="fleft100">
                                        <span class="fw-600 ft-Rajdhani cl-green" style="font-size: 2.5em;"><i>Falta pouco!</i></span>
                                            <span class="cl-fff ft-Rajdhani" style="font-size: 1.7em; padding-left: 10px">Só precisamos de mais alguns dados:</span>
                                    </div>
                            </div>                            
                        </div>
		</div>
	</header>

<!--         ASSINATURA MODAL 
        <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
            <div class="modal-dialog mxw-450" role="document">
                <div class="modal-content b-none">                    
                     <button type="button" class="close ft-roboto fw-100" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">X</span></button> 
                    <div class="titlemodal tmgreen">
                        <a style="font-size:20px; position: absolute; right: 15px; cursor: pointer;" data-dismiss="modal" >&times;</a>
                        <img src="<?php echo base_url().'assets/'?>img/icones/lapis.png"> Utilize a mesma assinatura da sua identidade.                        
                    </div>
                    <div class="prelative fleft100 pd-20 bk-fff text-center"> 				
                        <img src="<?php echo base_url().'assets/'?>img/icones/ass.jpg" class="w100">				
                    </div>	
                    <div class="fleft100 m-top10 text-right center-sm">
                        <button class="bt-green" data-dismiss="modal">Pronto!</button>
                    </div>
                </div>
            </div>
        </div> /ASSINATURA MODAL -->
        <!-- ASSINATURA MODAL -->
        <div class="modal" id="wait" style="left: 50%; top: 40%;">
            <img src="<?php echo base_url().'assets/img/icones/GIF SITE LIVRE.gif';?>">
        </div>
        
        <div class="modal fade" id="modal_captured" tabindex="-1" role="dialog" aria-labelledby="ModalLabel2" data-backdrop="static" data-keyboard="false">
            <div class="modal-dialog mxw-700" role="document">
                <div class="modal-content b-none">                    
                     <!--<button type="button" class="close ft-roboto fw-100" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">X</span></button>--> 
                    <div class="titlemodal tmgray">
                        <!--<a style="color:black; font-size:15px; position: absolute; right: 15px; cursor: pointer;" data-dismiss="modal" >&times;</a>-->
                        Limite Negado                        
                    </div>
                    <div class="pd-left25 text-center pd-30 m-top20-sm">
                        <div class="col-md-12 col-sm-12 col-xs-12 fnone i-block rs">
                            <div m-top20>
                                O valor solicitado não foi aprovado pois precisa mais limite do que você tem disponível. <br><b>Mas temos boas noticias!</b>
                                Conseguimos aprovar o valor abaixo, clique em contratar para confirmar.<br><br>
                                <span style="border-radius: 10px; padding: 10px; border-style:solid; display: inline-block;" >Você pode solicitar <span id="re_captured"></span>% do valor anterior</span>
                            </div>
                            <div class="bverdeNEW">
                                <span><h6>RESUMO DO CONTRATO:</h6></span>
                                <div class="m-top20">                                    
                                    <span class="m-top10 text-center">
                                        <small>Valor das parcelas:</small>
                                        <h3>R$ <span id="re_plot_value"></span> </h3>
                                    </span>                      
                                    <span class="col-md-6 col-sm-6 col-xs-6 m-top15 pd-left40">
                                        <small>Prazo para pagamento:</small>
                                        <h4><span id="re_num_plot"></span> meses</h4>
                                    </span>
                                    <span class="col-md-6 col-sm-6 col-xs-6 m-top15 text-left pd-left20">
                                        <small>Valor solicitado:</small>
                                        <h4>R$ <span id="re_solicited_value"></span></h4>
                                    </span>                                        
                                    <span class="col-md-6 col-sm-6 col-xs-6 m-top25 pd-left40">
                                        <small>Taxa de juros ao mês:</small>
                                        <h4><span id="re_tax"></span> %</h4>
                                    </span>
                                    <span class="col-md-4 col-sm-4 col-xs-4 m-top25 text-left pd-left20">
                                        <small>Custo Efetivo Total:</small>
                                        <h4>R$ <span id="re_total"></span></h4>
                                    </span>                                    
                                    <span class="col-md-4 col-sm-4 col-xs-4 m-top15 ">
                                        <small class="ft-size11">IOF:</small>
                                        <span class="ft-size10">R$ <span id="re_IOF"></span></span>
                                    </span>
                                    <span class="col-md-4 col-sm-4 col-xs-4 m-top15 ">
                                        <small class="ft-size11">CET:</small>
                                        <span class="ft-size10"><span id="re_CET"></span> %</span>
                                    </span>
                                    <span class="col-md-4 col-sm-4 col-xs-4 m-top15 ">
                                        <small class="ft-size11">CET ANUAL:</small>
                                        <span class="ft-size10"><span id="re_CET_ANUAL"></span> %</span>
                                    </span>
                                </div>
                            </div>
                            <div class="fleft100 text-right col-12">                            
                                <div class="m-top10 text-right col-6">
                                    <button id="btn_cancel_pre_contract" class="bt-green px2" style="background-color: #e1e1e1">Cancelar</button>
                                    <button id="btn_accept_pre_contract" class="bt-green px2 m-top5">Contratar</button>                            
                                </div>
                            </div>
                        </div>
                    </div>                    
                </div>
            </div>
        </div> 
        <!--CAPTURED MODAL--> 
        
        <div class="modal fade" id="modal_signature" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
            <div class="modal-dialog mxw-700" role="document">
                <div class="modal-content b-none">                    
                   <!--  <button type="button" class="close ft-roboto fw-100" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">X</span></button> -->
                    <div class="titlemodal tmgreen">
                        <a style="font-size:20px; position: absolute; right: 15px; cursor: pointer;" data-dismiss="modal" >&times;</a>
                        <img src="<?php echo base_url().'assets/'?>img/icones/lapis.png"> Utilize a mesma assinatura da sua identidade.                        
                    </div>
                    <div style="display:block;margin:0;padding:0;border:0;outline:0;font-size:10px!important;color:#AAA!important;vertical-align:baseline;background:transparent;width:700px;"></div>
<!--                    <div class="fleft100 m-top10 text-right center-sm">
                        <button class="bt-green" data-dismiss="modal">Pronto!</button>
                    </div>-->
                </div>
            </div>
        </div><!-- /ASSINATURA MODAL -->

        <!-- ERRO AO REGISTRAR -->
        <div class="modal fade" id="erro" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
            <div class="modal-dialog mxw-450" role="document">
                <div class="modal-content b-none">
                    <!-- <button type="button" class="close ft-roboto fw-100" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">X</span></button> -->
                                <div class="titlemodal tmred">Erro ao registrar cartão</div>
                    <div class="prelative fleft100 pd-20 bk-fff text-center"> 				
                        <img src="<?php echo base_url().'assets/'?>img/icones/erro.png">	
                        <p class="m-top20 pd-lr50 text-left">
                            <b class="fleft100 m-b20 text-center">Parece que houve um erro durante o <br>processamento dos dados do seu cartão.</b> 
                            <b>Pedimos que verifique o limite do seu cartão.</b> <br><u>Lembre-se que o valor do crédito deve ser menor que o valor de limite do seu cartão.</u> <br><br>
                            Se mesmo assim não conseguir prosseguir, entre em contato com a operadora do seu cartão para maiores informações.
                        </p>			
                    </div>	
                    <div class="fleft100 m-top10 text-right center-sm">
                        <button class="bt-green">Pronto!</button>
                    </div>
                </div>
            </div>
        </div><!-- /ERRO AO REGISTRAR -->

        <!-- SMS -->
        <div class="modal fade" id="sms" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
            <div class="modal-dialog mxw-350" role="document">
                <div class="modal-content b-none">
                    <!-- <button type="button" class="close ft-roboto fw-100" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">X</span></button> -->		
                    <div class="prelative fleft100 pd-20 bk-fff text-center">
                        <img src="<?php echo base_url().'assets/'?>img/icones/sms.png">	
                        <p class="m-top20 pd-lr50 text-left"><b class="fleft100 m-b20 text-center">
                                Insira o código recebido por SMS:
                        </b></p>
                        <input id="input_sms_code_confirmation" type="text" class="bverde ph-fff" placeholder=""  pattern="[0-9]{3}">			
                        <p id="text_error_sms_confirmation"></p>
                    </div>	
                    <div class="fleft100 m-top10 text-right center-sm">
                        <button id="resend_sms_code" class="cl-fff m-r25 bk-none b-none">
                            <u>Reenviar código</u>
                        </button>
                        <button id="btn_verify_sms_send_code" class="bt-green">
                            Pronto!
                        </button>
                    </div>
                </div>
            </div>
        </div><!-- /SMS -->

    <section class="fleft100 fmr-check" id="bcheck">
	<div class="container">	
		<hr class="fleft100 m-b40">	
		<div class="col-md-9 col-sm-12 col-xs-12 pd-0 center-sm">
                    
                    <!--PASO 1.1-->
                    <div class="pd-0 col-md-6 col-sm-9 col-xs-12 check1 i-block-sm ">
                        <div class="fleft100 pd-lr20 pd-tb25 bk-fff h441">
                            <span class="ft-size14 fw-600 fleft100">SEUS DADOS</span>
                            <fieldset class="fleft100 col-md-12 pd-lr10">
                                <input id="name" type="text" placeholder="Nome   (como aparece no CPF)" required style="text-transform:uppercase;">
                            </fieldset>
                            <fieldset class="fleft100 col-md-12 pd-lr10">
                                <input id="email" type="text" placeholder="E-mail">
                            </fieldset>
                            <fieldset class="fleft100 col-md-12 pd-lr10">
                                <input id="cpf" type="text" placeholder="CPF  (Apenas dígitos)" maxlength="11" minlength="11">
                            </fieldset>
                            <fieldset class="col-md-3 col-sm-3 col-xs-3 pd-lr10">
                                <input id="phone_ddd" type="text" placeholder="DDD" maxlength="2">
                            </fieldset>
                            <fieldset class="col-md-6 col-sm-6 col-xs-9 pd-lr10">
                                <input id="phone_number" type="text" placeholder="Celular" maxlength="9">
                            </fieldset>
                            <fieldset class="col-md-3 col-sm-3 col-xs-12 pd-lr10 bti">
                                <!--<button class="bt-green" data-toggle="modal" data-target="#sms" data-whatever="@mdo">Verificar</button>-->
                                <button id="btn_verify_phone_number" class="bt-green" data-toggle="modal" data-whatever="@mdo">Verificar</button>
                            </fieldset>
                            
                            <div id="request_cep_container" style="visibility:hidden; display: none">
                                <span class="ft-size14 fw-600 m-top30 fleft100">SEU ENDEREÇO</span>
                                <fieldset class="col-md-4 col-sm-5 col-xs-5 pd-lr10">
                                    <input id="cep" type="text" placeholder="CEP">
                                </fieldset>
                                <fieldset class="col-md-4 col-sm-4 col-xs-12 pd-lr10 bti">
                                    <button id="verify_cep" class="bt-green">Buscar</button>
                                </fieldset>
                            </div>
                             
                            <div id="address_container" style="visibility:hidden; display: none">
                                <fieldset class="fleft100 col-md-12 pd-lr10">
                                    <input id="street_address" type="text" placeholder="Endereço">
                                </fieldset>
                                <fieldset class="col-md-4 col-sm-4 col-xs-4 pd-lr10">
                                    <input id="number_address" type="text" placeholder="Nº">
                                </fieldset>
                                <fieldset class="col-md-8 col-sm-8 col-xs-8 pd-lr10">
                                    <input id="complement_number_address" type="text" placeholder="Complemento">
                                </fieldset>
                                <fieldset class="col-md-8 col-sm-8 col-xs-8 pd-lr10">
                                    <input id="city_address" type="text" placeholder="Cidade">
                                </fieldset>
                                <fieldset class="col-md-4 col-sm-4 col-xs-4 pd-lr10">
                                    <input id="state_address" type="text" placeholder="UF">
                                    <input id="district" type="hidden" value="">
                                </fieldset>
                            </div>
                        </div>
                        <div class="fleft100 m-top10 text-right center-sm">
                            <button id="btn_steep_1" class="bt-green px1 m-top5" disabled >Próximo</button>
                        </div>
                    </div>                    
                    
                    <div class="fleft100 check2 d-none">
                        <!--PASO 2.1-->
                        <div class="col-md-4 col-sm-4 col-xs-12 bk-green pd-10 cl-fff h441">
                            <span class="ft-size14 fw-600 fleft100 m-top20">SEUS DADOS</span>
                            <ul class="ds fleft100">
                                <li id="li_complete_name"></li>
                                <li id="li_email"></li>
                                <li id="li_phone"></li>
                                <li id="li_cpf"></li>
                            </ul>
                            <span class="ft-size14 fw-600 fleft100 m-top30">SEU ENDEREÇO</span>
                            <ul class="ds fleft100">
                                <li id="li_cep"> </li>
                                <li id="li_street"></li>
                                <li id="li_number_address"></li>
                                <li id="li_city_state"></li>
                            </ul>
                            <div class="fleft100 text-center m-top15"><img src="<?php echo base_url().'assets/'?>img/icones/check.png" alt=""></div>
                        </div>
                        <div class="col-md-8 col-sm-8 col-xs-12 pd-40 bk-fff h441">
                            <!--PASO 2.2-->
                            <span class="ft-size14 fw-600 fleft100">DADOS DO CARTÃO</span>
                            <div class="cartao m-top30">
                                <div class="col-md-10 col-sm-10 col-xs-12 pd-0">
                                    <fieldset class="fleft100 pd-lr5">
                                        <input id="credit_card_number" type="text" placeholder="Número do cartão">
                                    </fieldset>
                                    <fieldset class="col-md-4 col-sm-4 col-xs-4 pd-lr5 text-right">
                                        <span class="fw-600 pull-left m-top15">Validade</span>
                                    </fieldset>
                                    <fieldset class="col-md-4 col-sm-4 col-xs-4 pd-lr5">
                                        <select id="credit_card_exp_month" required>
                                            <option value="01" selected="true">01</option>
                                            <option value="02">02</option><option value="03">03</option>
                                            <option value="04">04</option><option value="05">05</option>
                                            <option value="06">06</option><option value="07">07</option>
                                            <option value="08">08</option><option value="09">09</option>
                                            <option value="10">10</option><option value="11">11</option>
                                            <option value="12">12</option>
                                        </select>
                                    </fieldset>
                                    <fieldset class="col-md-4 col-sm-4 col-xs-4 pd-lr5">
                                        <select id="credit_card_exp_year" required>
                                            <option value="2018" selected="true">2018</option>
                                            <option value="2019">2019</option><option value="2020">2020</option>
                                            <option value="2021">2021</option><option value="2022">2022</option>
                                            <option value="2023">2023</option><option value="2024">2024</option>
                                            <option value="2025">2025</option><option value="2026">2026</option>
                                            <option value="2027">2027</option><option value="2028">2028</option>
                                            <option value="2029">2029</option><option value="2030">2030</option>
                                            <option value="2031">2031</option><option value="2032">2032</option>
                                            <option value="2033">2033</option><option value="2034">2034</option>
                                            <option value="2035">2035</option><option value="2036">2036</option>
                                            <option value="2037">2037</option><option value="2038">2038</option>
                                            <option value="2039">2039</option><option value="2040">2040</option>
                                            <option value="2041">2041</option><option value="2042">2042</option>
                                            <option value="2043">2043</option><option value="2044">2044</option>
                                            <option value="2045">2045</option><option value="2046">2046</option>
                                            <option value="2047">2047</option><option value="2048">2048</option>
                                            <option value="2049">2049</option><option value="2050">2050</option>
                                        </select>
                                    </fieldset>
                                    <fieldset class="fleft100 pd-lr5">
                                        <input id="credit_card_name" type="text" placeholder="SEU NOME NO CARTÃO" required onkeyup="javascript:this.value=this.value.toUpperCase();" style="text-transform:uppercase;">
                                    </fieldset>
                                </div>
                                <div class="col-md-2 col-sm-2 col-xs-12 pd-0">
                                    <fieldset class="fleft100 cvv">
                                        <input id="credit_card_cvv" type="text" placeholder="CVV" required minlength="3" maxlength="4">
                                    </fieldset>
                                </div>
                            </div>
                            <!-- <label for="file" class="file m-top30 bk-blue cl-fff i-block-xs">
                                <span class="col-md-2 hidden-sm hidden-xs pull-right pd-0"><img src="img/icones/up.jpg" alt=""></span>
                                <span class="col-md-10 col-sm-10 col-xs-12 pull-left m-top2 pd-tb15 pd-lr20 fw-500">Envie a foto da parte frontal do seu cartão</span>
                                <input type="file" id="file" name="file">
                            </label> -->
                        </div>
                        <div class="fleft100 text-right col-12">                            
                            <div class="m-top10 text-right col-6">
                                <button id="btn_steep_2_prev" class="bt-green px2" style="background-color: #e1e1e1">Anterior</button>
                                <button id="btn_steep_2_next" class="bt-green px2 m-top5">Próximo</button>                            
                            </div>
                            
                        </div>
                    </div>
                    
			<div class="fleft100 check3 d-none">
                            <!--PASO 3.1-->
                            <div class="col-md-3 col-sm-3 col-xs-12 bk-green pd-10 cl-fff h441">
                                <span class="ft-size14 fw-600 fleft100 m-top20">SEUS DADOS</span>
                                <ul class="ds fleft100">
                                    <li id="li_complete_name"></li>
                                    <li id="li_email"></li>
                                    <li id="li_phone"></li>
                                    <li id="li_cpf"></li>
                                </ul>
                                <span class="ft-size14 fw-600 fleft100 m-top30">SEU ENDEREÇO</span>
                                <ul class="ds fleft100">
                                    <li id="li_cep"> </li>
                                    <li id="li_street"></li>
                                    <li id="li_number_address"></li>
                                    <li id="li_city_state"></li>
                                </ul>
                                <div class="fleft100 text-center check"><img src="<?php echo base_url().'assets/'?>img/icones/check.png" alt=""></div>
                            </div>
                            <!--PASO 3.2-->
                            <div class="col-md-3 col-sm-3 col-xs-12 bk-green2 pd-10 cl-fff h441">
                                <span class="ft-size14 fw-600 fleft100 m-top20">DADOS DO CARTÃO</span>
                                <ul class="ds fleft100">
                                    <li id="li_credit_card_name"></li>
                                    <li id="li_credit_card_number"></li>
                                    <li id="li_credit_card_exp_month"></li>
                                    <li id="li_credit_card_exp_year"></li>
                                    <li id="li_credit_card_exp_cvc"></li>
                                </ul>
                                <div class="fleft100 text-center check"><img src="<?php echo base_url().'assets/'?>img/icones/check.png" alt=""></div>
                            </div>
                            <!--PASO 3.3-->
                            <div class="col-md-5 col-sm-5 col-xs-12 pd-0">
                                <div class="bk-fff fleft100 pd-30 h441">
                                    <span class="ft-size14 fw-600 fleft100">DADOS BANCÁRIOS</span>
                                    <fieldset class="col-md-8 col-sm-8 col-xs-12 pd-lr5">
                                        <!--<input type="text" placeholder="Banco">-->
                                        <select id="bank" required style="max-height: 70px">
                                            <option value="default" selected="true">BANCO...</option>
                                            <option value="341">ITAÚ UNIBANCO BM S.A.</option>
                                            <option value="237">BCO BRADESCO S.A.</option>
                                            <option value="033">BCO SANTANDER (BRASIL) S.A.</option>
                                            <option value="001">BCO DO BRASIL S.A.</option>
                                            <option value="104">CAIXA ECONOMICA FEDERAL</option>
                                            <option value="117">ADVANCED CC LTDA</option>
                                            <option value="748">BANCO COOPERATIVO SICREDI S.A.</option>
                                            <option value="172">ALBATROSS CCV S.A</option>
                                            <option value="188">ATIVA S.A. INVESTIMENTOS CCTVM</option>
                                            <option value="280">AVISTA S.A. CFI</option>
                                            <option value="080">B&T CC LTDA.</option>
                                            <option value="063">BANCO BRADESCARD</option>
                                            <option value="208">BANCO BTG PACTUAL S.A.</option>
                                            <option value="233">BANCO CIFRA</option>
                                            <option value="094">BANCO FINAXIS</option>
                                            <option value="012">BANCO INBURSA</option>
                                            <option value="077">BANCO INTER</option>
                                            <option value="249">BANCO INVESTCRED UNIBANCO S.A.</option>
                                            <option value="029">BANCO ITAÚ CONSIGNADO S.A.</option>
                                            <option value="217">BANCO JOHN DEERE S.A.</option>
                                            <option value="212">BANCO ORIGINAL</option>
                                            <option value="623">BANCO PAN</option>
                                            <option value="743">BANCO SEMEAR</option>
                                            <option value="754">BANCO SISTEMA</option>
                                            <option value="082">BANCO TOPÁZIO S.A.</option>
                                            <option value="756">BANCOOB</option>
                                            <option value="268">BARIGUI CH</option>
                                            <option value="081">BBN BCO BRASILEIRO DE NEGOCIOS S.A.</option>
                                            <option value="654">BCO A.J. RENNER S.A.</option>
                                            <option value="246">BCO ABC BRASIL S.A.</option>
                                            <option value="075">BCO ABN AMRO S.A.</option>
                                            <option value="121">BCO AGIBANK S.A.</option>
                                            <option value="025">BCO ALFA S.A.</option>
                                            <option value="641">BCO ALVORADA S.A.</option>
                                            <option value="065">BCO ANDBANK S.A.</option>
                                            <option value="213">BCO ARBI S.A.</option>
                                            <option value="096">BCO B3 S.A.</option>
                                            <option value="024">BCO BANDEPE S.A.</option>
                                            <option value="021">BCO BANESTES S.A.</option>
                                            <option value="036">BCO BBI S.A.</option>
                                            <option value="318">BCO BMG S.A.</option>
                                            <option value="752">BCO BNP PARIBAS BRASIL S A</option>
                                            <option value="107">BCO BOCOM BBM S.A.</option>
                                            <option value="122">BCO BRADESCO BERJ S.A.</option>
                                            <option value="204">BCO BRADESCO CARTOES S.A.</option>
                                            <option value="394">BCO BRADESCO FINANC. S.A.</option>                                            
                                            <option value="218">BCO BS2 S.A.</option>
                                            <option value="473">BCO CAIXA GERAL BRASIL S.A.</option>
                                            <option value="412">BCO CAPITAL S.A.</option>
                                            <option value="040">BCO CARGILL S.A.</option>
                                            <option value="320">BCO CCB BRASIL S.A.</option>
                                            <option value="266">BCO CEDULA S.A.</option>
                                            <option value="739">BCO CETELEM S.A.</option>
                                            <option value="745">BCO CITIBANK S.A.</option>
                                            <option value="241">BCO CLASSICO S.A.</option>
                                            <option value="095">BCO CONFIDENCE DE CÂMBIO S.A.</option>
                                            <option value="748">BCO COOPERATIVO SICREDI S.A.</option>
                                            <option value="222">BCO CRÉDIT AGRICOLE BR S.A.</option>
                                            <option value="505">BCO CREDIT SUISSE (BRL) S.A.</option>
                                            <option value="069">BCO CREFISA S.A.</option>
                                            <option value="003">BCO DA AMAZONIA S.A.</option>
                                            <option value="083">BCO DA CHINA BRASIL S.A.</option>
                                            <option value="707">BCO DAYCOVAL S.A</option>                                            
                                            <option value="047">BCO DO EST. DE SE S.A.</option>
                                            <option value="037">BCO DO EST. DO PA S.A.</option>
                                            <option value="041">BCO DO ESTADO DO RS S.A.</option>
                                            <option value="004">BCO DO NORDESTE DO BRASIL S.A.</option>
                                            <option value="265">BCO FATOR S.A.</option>
                                            <option value="224">BCO FIBRA S.A.</option>
                                            <option value="626">BCO FICSA S.A.</option>
                                            <option value="612">BCO GUANABARA S.A.</option>
                                            <option value="604">BCO INDUSTRIAL DO BRASIL S.A.</option>
                                            <option value="653">BCO INDUSVAL S.A.</option>
                                            <option value="630">BCO INTERCAP S.A.</option>
                                            <option value="184">BCO ITAÚ BBA S.A.</option>
                                            <option value="479">BCO ITAUBANK S.A.</option>
                                            <option value="376">BCO J.P. MORGAN S.A.</option>
                                            <option value="076">BCO KDB BRASIL S.A.</option>
                                            <option value="757">BCO KEB HANA DO BRASIL S.A.</option>
                                            <option value="300">BCO LA NACION ARGENTINA</option>
                                            <option value="495">BCO LA PROVINCIA B AIRES BCE</option>
                                            <option value="600">BCO LUSO BRASILEIRO S.A.</option>
                                            <option value="243">BCO MÁXIMA S.A.</option>
                                            <option value="389">BCO MERCANTIL DO BRASIL S.A.</option>
                                            <option value="370">BCO MIZUHO S.A.</option>
                                            <option value="746">BCO MODAL S.A.</option>
                                            <option value="066">BCO MORGAN STANLEY S.A.</option>
                                            <option value="456">BCO MUFG BRASIL S.A.</option>
                                            <option value="169">BCO OLÉ BONSUCESSO CONSIGNADO S.A.</option>
                                            <option value="079">BCO ORIGINAL DO AGRO S/A</option>
                                            <option value="712">BCO OURINVEST S.A.</option>
                                            <option value="611">BCO PAULISTA S.A.</option>
                                            <option value="643">BCO PINE S.A.</option>
                                            <option value="747">BCO RABOBANK INTL BRASIL S.A.</option>
                                            <option value="633">BCO RENDIMENTO S.A.</option>
                                            <option value="494">BCO REP ORIENTAL URUGUAY BCE</option>
                                            <option value="741">BCO RIBEIRAO PRETO S.A.</option>
                                            <option value="120">BCO RODOBENS S.A.</option>
                                            <option value="422">BCO SAFRA S.A.</option>                                            
                                            <option value="366">BCO SOCIETE GENERALE BRASIL</option>
                                            <option value="637">BCO SOFISA S.A.</option>
                                            <option value="464">BCO SUMITOMO MITSUI BRASIL S.A.</option>
                                            <option value="634">BCO TRIANGULO S.A.</option>
                                            <option value="018">BCO TRICURY S.A.</option>
                                            <option value="655">BCO VOTORANTIM S.A.</option>
                                            <option value="610">BCO VR S.A.</option>
                                            <option value="119">BCO WESTERN UNION</option>
                                            <option value="124">BCO WOORI BANK DO BRASIL S.A.</option>
                                            <option value="074">BCO. J.SAFRA S.A.</option>
                                            <option value="250">BCV</option>
                                            <option value="144">BEXS BCO DE CAMBIO S.A.</option>
                                            <option value="253">BEXS CC S.A.</option>
                                            <option value="134">BGC LIQUIDEZ DTVM LTDA</option>
                                            <option value="007">BNDES</option>
                                            <option value="017">BNY MELLON BCO S.A.</option>
                                            <option value="755">BOFA MERRILL LYNCH BM S.A.</option>
                                            <option value="126">BR PARTNERS BI</option>
                                            <option value="125">BRASIL PLURAL S.A. BCO.</option>
                                            <option value="070">BRB - BCO DE BRASILIA S.A.</option>
                                            <option value="092">BRK S.A. CFI</option>
                                            <option value="173">BRL TRUST DTVM SA</option>
                                            <option value="142">BROKER BRASIL CC LTDA.</option>
                                            <option value="011">C.SUISSE HEDGING-GRIFFO CV S/A</option>                                            
                                            <option value="288">CAROL DTVM LTDA.</option>
                                            <option value="130">CARUANA SCFI</option>
                                            <option value="159">CASA CREDITO S.A. SCM</option>
                                            <option value="097">CCC NOROESTE BRASILEIRO LTDA.</option>
                                            <option value="091">CCCM UNICRED CENTRAL RS</option>
                                            <option value="016">CCM DESP TRÂNS SC E RS</option>
                                            <option value="279">CCR DE PRIMAVERA DO LESTE</option>
                                            <option value="273">CCR DE SÃO MIGUEL DO OESTE</option>
                                            <option value="089">CCR REG MOGIANA</option>
                                            <option value="114">CENTRAL COOPERATIVA DE CRÉDITO NO ESTADO DO ESPÍRITO SANTO</option>
                                            <option value="477">CITIBANK N.A.</option>
                                            <option value="180">CM CAPITAL MARKETS CCTVM LTDA</option>
                                            <option value="127">CODEPE CVC S.A.</option>
                                            <option value="163">COMMERZBANK BRASIL S.A. - BCO MÚLTIPLO</option>
                                            <option value="136">CONF NAC COOP CENTRAIS UNICRED</option>
                                            <option value="060">CONFIDENCE CC S.A.</option>
                                            <option value="085">COOP CENTRAL AILOS</option>
                                            <option value="098">CREDIALIANÇA CCR</option>
                                            <option value="010">CREDICOAMO</option>
                                            <option value="133">CRESOL CONFEDERAÇÃO</option>
                                            <option value="182">DACASA FINANCEIRA S/A - SCFI</option>
                                            <option value="487">DEUTSCHE BANK S.A.BCO ALEMAO</option>
                                            <option value="140">EASYNVEST - TÍTULO CV SA</option>
                                            <option value="149">FACTA S.A. CFI</option>
                                            <option value="196">FAIR CC S.A.</option>
                                            <option value="278">GENIAL INVESTIMENTOS CVM S.A.</option>
                                            <option value="138">GET MONEY CC LTDA</option>
                                            <option value="064">GOLDMAN SACHS DO BRASIL BM S.A</option>
                                            <option value="177">GUIDE</option>
                                            <option value="146">GUITTA CC LTDA</option>
                                            <option value="078">HAITONG BI DO BRASIL S.A.</option>
                                            <option value="062">HIPERCARD BM S.A.</option>
                                            <option value="189">HS FINANCEIRA</option>
                                            <option value="269">HSBC BANCO DE INVESTIMENTO</option>
                                            <option value="271">IB CCTVM LTDA</option>
                                            <option value="157">ICAP DO BRASIL CTVM LTDA.</option>
                                            <option value="132">ICBC DO BRASIL BM S.A.</option>
                                            <option value="492">ING BANK N.V.</option>
                                            <option value="139">INTESA SANPAOLO BRASIL S.A. BM</option>                                            
                                            <option value="652">ITAÚ UNIBANCO HOLDING BM S.A.</option>
                                            <option value="488">JPMORGAN CHASE BANK</option>
                                            <option value="399">KIRTON BANK</option>
                                            <option value="105">LECCA CFI S.A.</option>
                                            <option value="145">LEVYCAM CCV LTDA</option>
                                            <option value="113">MAGLIANO S.A. CCVM</option>
                                            <option value="128">MS BANK S.A. BCO DE CÂMBIO</option>
                                            <option value="137">MULTIMONEY CC LTDA.</option>
                                            <option value="014">NATIXIS BRASIL S.A. BM</option>
                                            <option value="191">NOVA FUTURA CTVM LTDA.</option>
                                            <option value="753">NOVO BCO CONTINENTAL S.A. - BM</option>
                                            <option value="260">NU PAGAMENTOS S.A.</option>
                                            <option value="111">OLIVEIRA TRUST DTVM S.A.</option>
                                            <option value="613">OMNI BANCO S.A.</option>
                                            <option value="254">PARANA BCO S.A.</option>
                                            <option value="194">PARMETAL DTVM LTDA</option>
                                            <option value="174">PERNAMBUCANAS FINANC S.A. CFI</option>
                                            <option value="100">PLANNER CV S.A.</option>
                                            <option value="093">PÓLOCRED SCMEPP LTDA.</option>
                                            <option value="108">PORTOCRED S.A. - CFI</option>
                                            <option value="283">RB CAPITAL INVESTIMENTOS DTVM LTDA.</option>
                                            <option value="101">RENASCENCA DTVM LTDA</option>
                                            <option value="751">SCOTIABANK BRASIL</option>
                                            <option value="276">SENFF S.A. - CFI</option>
                                            <option value="545">SENSO CCVM S.A.</option>
                                            <option value="190">SERVICOOP</option>
                                            <option value="183">SOCRED S.A. SCM</option>
                                            <option value="118">STANDARD CHARTERED BI S.A.</option>
                                            <option value="197">STONE PAGAMENTOS S.A.</option>
                                            <option value="143">TREVISO CC S.A.</option>
                                            <option value="131">TULLETT PREBON BRASIL CVC LTDA</option>
                                            <option value="129">UBS BRASIL BI S.A.</option>
                                            <option value="015">UBS BRASIL CCTVM S.A.</option>
                                            <option value="099">UNIPRIME CENTRAL CCC LTDA.</option>
                                            <option value="084">UNIPRIME NORTE DO PARANÁ - CC</option>
                                            <option value="102">XP INVESTIMENTOS CCTVM S/A</option>
                                        </select>
                                    </fieldset>
                                    <fieldset class="col-md-4 col-sm-4 col-xs-12 pd-lr5">
                                        <input id="agency" type="text" placeholder="AGÊNCIA" required>
                                    </fieldset>
                                    <fieldset class="col-md-5 col-sm-5 col-xs-12 pd-lr5">
                                        <select id="account_type" required>
                                            <option value="default" selected="true">TIPO DE CONTA</option>
                                            <option value="CC">CORRENTE</option>
                                            <option value="PP">POUPANÇA</option>
                                        </select>
                                    </fieldset>
                                    <fieldset class="col-md-4 col-sm-4 col-xs-12 pd-lr5">
                                        <input id="account" type="text" placeholder="Conta" required>
                                    </fieldset>
                                    <fieldset class="col-md-3 col-sm-3 col-xs-12 pd-lr5">
                                        <input id="dig" type="text" placeholder="Dig." maxlength="1" required>
                                    </fieldset>
                                    <fieldset class="fleft100 col-md-12 pd-lr5">
                                        <small class="cl-black fw-600">NOME COMPLETO DO TITULAR</small>
                                        
                                        <input id="titular_name" type="text" placeholder="Nome completo do titular" required onkeyup="javascript:this.value=this.value.toUpperCase();" style="text-transform:uppercase;">
                                    </fieldset>
                                    <fieldset class="cpf col-md-7 col-sm-7 col-xs-12 pd-lr5 m-top20">
                                        <small class="cl-black fw-600">CPF DO TITULAR</small>
                                        <input id="titular_cpf" type="text" placeholder="000.000.000.00" required>
                                    </fieldset>
                                </div>
                                <div class="fleft100 m-top10 text-right">
                                    <button id="btn_steep_3_prev" class="bt-green px3" style="background-color: #e1e1e1">Anterior</button>
                                    <button id="btn_steep_3_next" class="bt-green px3 m-top5">Próximo</button>
                                </div>
                            </div>				
			</div>
                    
                    
			<div class="fleft100 check4 d-none">
                            <!--PASO 4.1-->
                            <div class="col-md-3 col-sm-3 col-xs-12 bk-green pd-10 cl-fff h441">
                                <span class="ft-size14 fw-600 fleft100 m-top20">SEUS DADOS</span>
                                <ul class="ds fleft100">
                                    <li id="li_complete_name"></li>
                                    <li id="li_email"></li>
                                    <li id="li_phone"></li>
                                    <li id="li_cpf"></li>
                                </ul>
                                <span class="ft-size14 fw-600 fleft100 m-top30">SEU ENDEREÇO</span>
                                <ul class="ds fleft100">
                                    <li id="li_cep"> </li>
                                    <li id="li_street"></li>
                                    <li id="li_number_address"></li>
                                    <li id="li_city_state"></li>
                                </ul>
                                <div class="fleft100 text-center check"><img src="<?php echo base_url().'assets/'?>img/icones/check.png" alt=""></div>
                            </div>
                            <!--PASO 4.2-->
                            <div class="col-md-2 col-sm-2 col-xs-12 bk-green3 pd-10 cl-fff h441">
                                <span class="ft-size14 fw-600 fleft100 m-top20">DADOS DO CARTÃO</span>
                                <ul class="ds fleft100">
                                    <li id="li_credit_card_name"></li>
                                    <li id="li_credit_card_number"></li>
                                    <li id="li_credit_card_exp_month"></li>
                                    <li id="li_credit_card_exp_year"></li>
                                    <li id="li_credit_card_exp_cvc"></li>
                                </ul>
                                <div class="fleft100 text-center check"><img src="<?php echo base_url().'assets/'?>img/icones/check.png" alt=""></div>
                            </div>
                            <!--PASO 4.3-->
                            <div class="col-md-2 col-sm-2 col-xs-12 bk-green2 pd-10 cl-fff h441">
                                <span class="ft-size14 fw-600 fleft100 m-top20">DADOS BANCÁRIOS</span>
                                <ul class="ds fleft100">
                                    <li id="li_bank_name"></li>
                                    <li id="li_bank_angency"></li>
                                    <li id="li_bank_account_type"></li>
                                    <li id="li_bank_account"></li>
                                    <li id="li_bank_dig"></li>
                                    <li id="li_bank_account_name"></li>
                                    <li id="li_bank_proppety_cpf"></li>
                                </ul>
                                <div class="fleft100 text-center check"><img src="<?php echo base_url().'assets/'?>img/icones/check.png" alt=""></div>
                            </div>
                            <!--PASO 4.4-->
                            <div class="col-md-5 col-sm-5 col-xs-12 pd-10 bk-fff h441 text-center">
                                <div class="fleft100 pd-lr5 text-left">
                                    <span class="ft-size14 fw-600 fleft100 m-top20">COMPROVANTES</span>
                                    <small class="fleft100 fw-600">Clique para fazer upload.</small>
                                </div>
                                
                                <h5 class="fleft100 text-left fw-600 pd-lr5 m-top20">Cartão de crédito</h5>
                                <div class="col-md-6 col-sm-6 col-xs-6 pd-lr5 m-top10">
                                    <label for="cartao">
                                        <input type="file" id="cartao" class="hidden">
                                        <?php 
                                            if($_SESSION['front_credit_card']){
                                        ?>
                                        <div id="check_front_credit_card" class="upl uplgreen c-pointer">
                                            <img src="<?php echo base_url().'assets/'?>img/icones/CARTAO.png" alt="">
                                            <i style="font-size:16px;" id = "status_front_cc" class="fa fa-check-circle-o"></i>
                                        <?php 
                                            } else {
                                        ?>
                                        <div id="check_front_credit_card" class="upl uplsilver c-pointer">
                                            <img src="<?php echo base_url().'assets/'?>img/icones/CARTAO.png" alt="">
                                            <i style="font-size:16px;" id = "status_front_cc" class="fa fa-arrow-up"></i>
                                        <?php 
                                            }
                                        ?>  
                                            <small class="fleft100">Foto da parte <br>frontal do seu cartão</small>
                                        </div>
                                    </label>
                                </div>
                                <div class="col-md-6 col-sm-6 col-xs-6 pd-lr5 m-top10">
                                    <label for="selcartao">
                                        <input type="file" id="selcartao" class="hidden">
                                        <?php 
                                            if($_SESSION['selfie_with_credit_card']){
                                        ?>
                                        <div id="check_selfie_credit_card" class="upl uplgreen c-pointer">  
                                            <img src="<?php echo base_url().'assets/'?>img/icones/SELFIE-CARTAO.png" alt="">                                            
                                            <i style="font-size:16px;" id = "status_selfie_cc" class="fa fa-check-circle-o"></i>
                                        <?php 
                                            } else {
                                        ?>
                                        <div id="check_selfie_credit_card" class="upl uplsilver c-pointer">
                                            <img src="<?php echo base_url().'assets/'?>img/icones/SELFIE-CARTAO.png" alt="">                                            
                                            <i style="font-size:16px;" id = "status_selfie_cc" class="fa fa-arrow-up"></i>
                                        <?php 
                                            }
                                        ?>      
                                            <small class="fleft100">Selfie segurando <br>seu cartão</small>
                                        </div>
                                    </label>
                                </div>

                                <h5 class="fleft100 text-left fw-600 pd-lr5">Identidade</h5>
                                <div class="col-md-6 col-sm-6 col-xs-6 pd-lr5 m-top10">						
                                    <label for="id">
                                        <input type="file" id="id" class="hidden">
                                        <?php 
                                            if($_SESSION['open_identity']){
                                        ?>
                                        <div id="check_open_identity" class="upl uplgreen c-pointer">
                                            <img src="<?php echo base_url().'assets/'?>img/icones/ID-ABERTA.png" alt="">
                                            <i style="font-size:16px;" id = "status_open_id" class="fa fa-check-circle-o"></i>
                                        <?php 
                                            } else {
                                        ?>
                                        <div id="check_open_identity" class="upl uplsilver c-pointer">
                                            <img src="<?php echo base_url().'assets/'?>img/icones/ID-ABERTA.png" alt="">
                                            <i style="font-size:16px;" id = "status_open_id" class="fa fa-arrow-up"></i>
                                        <?php 
                                            } 
                                        ?>                                         
                                            <small class="fleft100">Foto identidade aberta <br>(Frente e verso junto)</small>
                                        </div>
                                    </label>
                                </div>
                                <div class="col-md-6 col-sm-6 col-xs-6 pd-lr5 m-top10">
                                    <label for="selid">
                                        <input type="file" id="selid" class="hidden">                                        
                                        <?php 
                                            if($_SESSION['selfie_with_identity']){
                                        ?>
                                        <div id="check_selfie_with_identity" class="upl uplgreen c-pointer">
                                            <img src="<?php echo base_url().'assets/'?>img/icones/SELFIE-ID.png" alt="">
                                            <i style="font-size:16px;" id = "status_selfie_id" class="fa fa-check-circle-o"></i>
                                        <?php 
                                            } else {
                                        ?>
                                        <div id="check_selfie_with_identity" class="upl uplsilver c-pointer">
                                            <img src="<?php echo base_url().'assets/'?>img/icones/SELFIE-ID.png" alt="">
                                            <i style="font-size:16px;" id = "status_selfie_id" class="fa fa-arrow-up"></i>
                                        <?php 
                                            } 
                                        ?>                                                                                     
                                            <small class="fleft100">Selfie com identidade <br>(Lado com foto)</small>
                                        </div>
                                    </label>
                                </div>
                                <div class="fleft100 pd-lr5 m-top10">
                                    <label for="ucpf_img" class="dc m-top5">
                                        <input type="file" id="ucpf_img" class="hidden">
                                        <input type="checkbox" id="ucpf" style="margin-top: 2px;"> 
                                        <small style="text-decoration: none;">
                                            <b class="fleft100">Minha identidade não possui CPF</b> Marque para fazer upload do seu CPF
                                            <?php 
                                            if($_SESSION['cpf_card']){
                                            ?>
                                                <b><span id = 'msg_ucpf_upload'> (Foi anexado)</span></b>
                                            <?php 
                                            } else {
                                            ?>
                                                <b><span id = 'msg_ucpf_upload'></span></b>
                                            <?php 
                                            } 
                                        ?>    
                                        </small>
                                    </label>
                                </div>                                
                            </div>
                            <div class="fleft100 m-top10 text-right">
                                <button id="btn_steep_4_prev" class="bt-green px4" style="background-color: #e1e1e1">Anterior</button>
                                <button id="do_sign" type="submit" class="bt-green mxw-250 m-top5">Contratar</button>
                                <!--<a href="https://secure.rightsignature.com/templates/a928ddf8-3448-471a-8715-5c380f20f4de/template-signer-link/ab8c91ff6a6120267167cbca08615106" class="embed_button embed_green_button" id="embed_d1e97fc8-9f46-4fe0-af4a-bd5141821f37" data-guid="d1e97fc8-9f46-4fe0-af4a-bd5141821f37">Sign Document</a><script charset="ISO-8859-1" src="https://secure.rightsignature.com/embed.js"></script>-->
                                <!--<div style="display:block;margin:0;padding:0;border:0;outline:0;font-size:10px!important;color:#AAA!important;vertical-align:baseline;background:transparent;width:755px;"><iframe frameborder="0" height="500" scrolling="no" src="https://secure.rightsignature.com/templates/0ad1974f-9d3a-43d4-9cc6-b600a0512001/template-signer-link/f7619c51792d28daee0cb475964cf819" width="755"></iframe></div>-->
                            </div>

                            <!-- apenas para abrir os modais ocultos -->
<!--                            <div class="fleft100 m-top20 text-right">
                                <button type="submit" class="bt-green mxw-250" data-toggle="modal" data-target="#erro" data-whatever="@mdo">Ver modal de erro</button>
                            </div>-->
			</div>			
		</div>
                
                <!--PASO 5.1-->
		<div class="col-md-3 col-sm-12 col-xs-12 pd-left25 text-center pd-none-480 m-top20-sm">
                    <div class="col-md-12 col-sm-5 col-xs-8 fnone i-block rs">
                        <div class="bverde4 cl-fff">
                            <span class="ft-size12">RESUMO:</span>
                            <div class="fleft100 pd-tb5 pd-lr15 text-left">
                                <span class="fleft100 m-top15">
                                    <small>Valor das parcelas:</small>
                                    <h2 class="fw-100 cl-green">R$ <?php echo $month_value;?> <b class="fw-500"></b></h2>
                                </span>                      
                                <span class="fleft100 m-top15">
                                    <small>Valor solicitado:</small>
                                    <h4 class="fleft100 fw-300">R$ <?php echo $solicited_value;?></h4>
                                </span>
                                <span class="fleft100 m-top15">
                                    <small>Prazo para pagamento:</small>
                                    <h4 class="fleft100 fw-300"><?php echo $amount_months;?> meses</h4>
                                </span>
                                <span class="fleft100 m-top15">
                                    <small>Taxa de juros ao mês:</small>
                                    <h4 class="fleft100 fw-300"><?php echo $tax;?> %</h4>
                                </span>
                                <span class="fleft100 m-top15">
                                    <small>Custo Efetivo Total:</small>
                                    <h4 class="fleft100 fw-300">R$ <?php echo $total_cust_value;?></h4>
                                </span>
                                <span class="col-md-4 col-sm-4 col-xs-4 pd-0 m-top15">
                                    <small class="ft-size11">IOF:</small>
                                    <span class="fleft100 fw-300 ft-size10">R$ <?php echo $IOF;?></span>
                                </span>
                                <span class="col-md-4 col-sm-4 col-xs-4 pd-0 m-top15">
                                    <small class="ft-size11">CET:</small>
                                    <span class="fleft100 fw-300 ft-size10"><?php echo $CET_PERC;?> %</span>
                                </span>
                                <span class="col-md-4 col-sm-4 col-xs-4 pd-0 m-top15">
                                    <small class="ft-size11">CET ANUAL:</small>
                                    <span class="fleft100 fw-300 ft-size10"><?php echo $CET_YEAR;?> %</span>
                                </span>
                            </div>
                        </div>
                    </div>
		</div>

		<!-- <div class="i fleft100 pd-30 bk-fff fw-600 m-top40">
                    <div class="col-md-1 col-sm-2 col-xs-12 text-center"><img src="img/icones/i.png" width="30"></div>
                    <div class="col-md-11 col-sm-10 col-xs-12 pd-0 m-top20-xs text-left ft-size13">
                        <h5 class="fw-700">IMPORTANTE:</h5> Para solicitar o crédito o dono do cartão de crédito e da conta bancária devem ser a mesma pessoa. Não é permitido usar o cartão de outra pessoa para solicitar o crédito. Em caso de titulares diferentes o crédito não será efetivado, sendo negado na hora.
                    </div>
		</div> -->
	</div>
        <div class="col-md-12 col-sm-12 col-xs-12 left-xs-40 m-top20-sm pd-20">
                <div class="i pd-30">
<!--                        <div class="col-md-5 col-sm-6 col-xs-12">
                                <p align="left" class="cl-fff m-none ft-size12">Além dos valores aplicados pelo Livre.digital, será acrescido os juros cobrados pelo seu própio banco. Este valor não aparece em nosso RESUMO. A média de juros nessa modalidade é em torno de 2% a.m.</p>
                        </div>-->                        
                        <div class="col-md-12 col-sm-6 col-xs-12 pd-0 pd-lr15-xs m-top20-xs">
                                <p align="left" class="m-none ft-size12 cl-fff"><b class="fleft100">Não é permitido:</b> <br>- Não é permitido usar o cartão de outra pessoa para solicitar o crédito. Em caso de titulares diferentes o crédito não será efetivado, sendo negado na hora. <br>- Não é permitido utilizar cartões virtuais <br>- As fotos devem ser enviadas direto da câmera do seu celular</p>
                        </div>
                </div>
        </div>
</section>
<div class="modal fade"  id="show_sign" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2">
    <div id="show_sign_modal" class="modal-dialog modal-sm" role="document">                                                          
        <div class="modal-content">
            <div class="modal-header">
                <button id="btn_modal_close_sign" type="button" class="close" style="background:#fff;" data-dismiss="modal" aria-label="Close">
                    <img src="<?php echo base_url() . 'assets/img/icones/índice.png'; ?>"> 
                </button>
                <h5 class="modal-title" id="myModalLabel2"><b>Assinar</b></h5>                        
            </div>
            <div class="modal-body">
                <div style="display:block;margin:0;padding:0;border:0;outline:0;font-size:10px!important;color:#AAA!important;vertical-align:baseline;background:transparent;width:755px;">
                    
                </div>
            </div>
            <div class="modal-footer text-center">
                <button id="accept_modal_sign" type="button" class="btn btn-primary active text-center ladda-button" data-style="expand-left" data-spinner-color="#ffffff">
                    <spam class="ladda-label"><div style="color:white; font-weight:bold">ACEITAR</div></spam>
                </button>
            </div>
        </div>
    </div>
</div>

<?php //include_once "inc/footer.php";?>