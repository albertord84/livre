<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Livre.digital</title>
    <meta name="viewport" content="width=device-width">
    <link rel="shortcut icon" type="image/png" href="<?php echo base_url().'assets/'?>img/icones/favicon.jpeg">

    <!-- Font Awesome -->
    <!--<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">-->
    <link rel="stylesheet" href="<?php echo base_url().'assets/css/font-awesome/font-awesome.min.css'?>">

    <!-- GALERIA -->	
    <link rel="stylesheet" type="text/css" href="<?php echo base_url().'assets/galeria/css/fresco/fresco.css?'.$SCRIPT_VERSION;?>" />

    <!-- Bootstrap -->
    <link rel="stylesheet" href="<?php echo base_url().'assets/css/bootstrap.min.css?'.$SCRIPT_VERSION;?>">
    <link rel="stylesheet" href="<?php echo base_url().'assets/css/bootstrap-multiselect.css?'.$SCRIPT_VERSION;?>">
    <link rel="stylesheet" href="<?php echo base_url().'assets/css/bootstrap-datepicker.min.css?'.$SCRIPT_VERSION;?>">

    <!-- Owl Carousel Assets -->
    <link href="<?php echo base_url().'assets/css/carousel/owl.carousel.css?'.$SCRIPT_VERSION;?>" rel="stylesheet">
    <link href="<?php echo base_url().'assets/css/carousel/owl.theme.css?'.$SCRIPT_VERSION;?>" rel="stylesheet">
    <link href="<?php echo base_url().'assets/css/carousel/owl.transitions.css?'.$SCRIPT_VERSION;?>" rel="stylesheet">

    <!-- CSS -->
    <link rel="stylesheet" href="<?php echo base_url().'assets/css/estilo.css?'.$SCRIPT_VERSION;?>" />
    <link rel="stylesheet" href="<?php echo base_url().'assets/css/definicoes.css?'.$SCRIPT_VERSION;?>" />
    <link rel="stylesheet" href="<?php echo base_url().'assets/css/media.css?'.$SCRIPT_VERSION;?>" />
    
    <!-- JS -->
    <script type="text/javascript">
        var base_url = '<?php echo base_url();?>';            
    </script>
    
    <?php include_once "pixel_facebook.php";?>
    <?php include_once "pixel_gtags.php";?>        
    <?php //include_once "pixel_ecomerce_analytics.php";?>
    <?php //include_once "pixel_adwords.php";?>
</head>
<body id="bcheck">
        <div class="modal" id="wait_resend" style="left: 50%; top: 40%;">
            <img src="<?php echo base_url().'assets/img/icones/GIF SITE LIVRE.gif';?>">
        </div>
	<header class="fleft100 pd-tb30 pabsolute m-top50 m-none-xs text-center">
		<div class="container">
			<div class="col-md-10 col-sm-12 col-xs-12 fnone i-block">
				<div class="logo col-md-3 col-sm-3 col-xs-12 pd-0 center-xs m-top12 text-left"><a href=""><img src="<?php echo base_url().'assets/'?>img/icones/logo.png" alt=""></a></div>
				<div class="col-md-6 col-sm-6 col-xs-12 text-left">
                                    <div class="fleft100">
                                        <h1 class="fw-600 ft-size45 ft-Rajdhani cl-green"><i>Falta pouco!</i></h1>
                                        <h3 class="cl-fff ft-Rajdhani">Só precisamos de mais alguns dados:</h3>
                                    </div>
				</div>
				<div class="col-md-3 col-sm-3 col-xs-12 pd-0 text-right center-xs m-top20">
                                    <ul class=" sociais i-block">
                                        <li><a href="https://www.instagram.com/livre.digital/" target="_blank"><img src="<?php echo base_url().'assets/'?>img/icones/ig.png"></a></li>
                                        <li><a href="https://facebook.com/Livre.dig/?tsid=0.714847921740313&source=result&__nodl&_rdr" target="_blank"><img src="<?php echo base_url().'assets/'?>img/icones/fb.png"></a></li>
                                    </ul>
                                    <ul class="menu i-block m-top10-xs">				
                                        <li class="tv cl-fff">|</li>
                                        <li><a href="#contact_me">Suporte</a></li>
					</ul>
				</div>
			</div>
		</div>
	</header>

<section class="fleft100 pd-tb40 m-top40">
	<div class="container">	
		<div class="col-md-8 col-sm-8 col-xs-12 col-md-offset-2  m-top150">
			<div class="fleft100 selct">
				<h2 class="bk-green5 text-center pd-tb15">Envie novamente suas fotos</h2>
				<div class="fleft100 pd-30 bk-fff">
					<ul class="pap fleft100 pd-lr80 text-center">
						<li class="pgreen">
							<span class="fleft100">1. Dados enviados <br>com sucesso!</span>
							<img src="<?php echo base_url().'assets/'?>img/icones/passo1-yellow.png" class="passo-yellow">
							<img src="<?php echo base_url().'assets/'?>img/icones/passo1-green.png" class="passo-green">
							<img src="<?php echo base_url().'assets/'?>img/icones/passo1-red.png" class="passo-red">
						</li>
						<li class="pyellow">
							<span class="fleft100">2. Análise <br>das fotos</span>
							<img src="<?php echo base_url().'assets/'?>img/icones/passo2-silver.png" class="passo-silver">
							<img src="<?php echo base_url().'assets/'?>img/icones/passo2-yellow.png" class="passo-yellow">
							<img src="<?php echo base_url().'assets/'?>img/icones/passo2-green.png" class="passo-green">
						</li>
						<li class="psilver">
							<span class="fleft100">3. Dinheiro na <br>conta (24h)</span>
							<img src="<?php echo base_url().'assets/'?>img/icones/passo3-silver.png" class="passo-silver">
							<img src="<?php echo base_url().'assets/'?>img/icones/passo3-green.png" class="passo-green">
						</li>
					</ul>

					<div class="fleft100 pd-lr30 m-top30 ft-size16 fmr-check">
						<h4 class="cl-blue m-b15">Oi <?php echo explode(' ',$transaction['name'])[0];?>!</h4>
						<p>
							Infelizmente suas fotos não estão legíveis ou os dados não batem com a conta informada. <b>Você só precisa reenviar novas fotos. </b>
							<br><br>
							<b>ATENÇÃO:</b> <br>
							<b>1.</b> Você precisa ser o titular da conta que receberá o valor do crédito. <br>
							<b>2.</b> As fotos precisam estar em boa qualidade e em local iluminado.
						</p>

						<div class="col-md-10 col-sm-10 col-xs-12 col-md-offset-1">
							<div class="fleft100 pd-30">
								<div class="col-md-6 col-sm-6 col-xs-6 pd-0">
									<h5 class="fleft100 text-left fw-600 pd-lr5">Cartão</h5>
									<div class="fleft100 pd-lr5 m-top10">
										<label for="new_cartao">
                                                                                    <input type="file" id="new_cartao" class="hidden">
                                                                                    <?php 
                                                                                        if($_SESSION['new_front_credit_card']){
                                                                                    ?>
                                                                                    <div id="new_check_front_credit_card" class="upl uplgreen c-pointer">
                                                                                        <img src="<?php echo base_url().'assets/'?>img/icones/CARTAO.png" alt="">
                                                                                        <i style="font-size:16px;" id = "new_status_front_cc" class="fa fa-check-circle-o"></i>
                                                                                    <?php 
                                                                                        } else {
                                                                                    ?>
                                                                                    <div id="new_check_front_credit_card" class="upl uplsilver c-pointer">
                                                                                        <img src="<?php echo base_url().'assets/'?>img/icones/CARTAO.png" alt="">
                                                                                        <i style="font-size:16px;" id = "new_status_front_cc" class="fa fa-arrow-up"></i>
                                                                                    <?php 
                                                                                        } 
                                                                                    ?>  
                                                                                        <small class="fleft100">Foto da parte <br>frontal do seu cartão</small>
                                                                                    </div>
                                                                                </label>
									</div>

									<div class="fleft100 pd-lr5 m-top10">
										<label for="new_selcartao">
                                                                                    <input type="file" id="new_selcartao" class="hidden">
                                                                                    <?php 
                                                                                        if($_SESSION['new_selfie_with_credit_card']){
                                                                                    ?>
                                                                                    <div id="new_check_selfie_credit_card" class="upl uplgreen c-pointer">
                                                                                        <img src="<?php echo base_url().'assets/'?>img/icones/SELFIE-CARTAO.png" alt="">                                            
                                                                                        <i style="font-size:16px;" id = "new_status_selfie_cc" class="fa fa-check-circle-o"></i>
                                                                                    <?php 
                                                                                        } else {
                                                                                    ?>
                                                                                    <div id="new_check_selfie_credit_card" class="upl uplsilver c-pointer">
                                                                                        <img src="<?php echo base_url().'assets/'?>img/icones/SELFIE-CARTAO.png" alt="">                                            
                                                                                        <i style="font-size:16px;" id = "new_status_selfie_cc" class="fa fa-arrow-up"></i>
                                                                                    <?php 
                                                                                        } 
                                                                                    ?>  
                                                                                        <small class="fleft100">Selfie segurando <br>seu cartão</small>
                                                                                    </div>
                                                                                </label>
									</div>	
								</div>
								
								<div class="col-md-6 col-sm-6 col-xs-6 pd-0">
									<h5 class="fleft100 text-left fw-600 pd-lr5">Identidade</h5>
									<div class="fleft100 pd-lr5 m-top10">						
										<label for="new_id">
                                                                                    <input type="file" id="new_id" class="hidden">
                                                                                    <?php 
                                                                                        if($_SESSION['open_identity']){
                                                                                    ?>
                                                                                    <div id="new_check_open_identity" class="upl uplgreen c-pointer">
                                                                                        <img src="<?php echo base_url().'assets/'?>img/icones/ID-ABERTA.png" alt="">
                                                                                        <i style="font-size:16px;" id = "new_status_open_id" class="fa fa-check-circle-o"></i>
                                                                                    <?php 
                                                                                        } else {
                                                                                    ?>
                                                                                    <div id="new_check_open_identity" class="upl uplsilver c-pointer">
                                                                                        <img src="<?php echo base_url().'assets/'?>img/icones/ID-ABERTA.png" alt="">
                                                                                        <i style="font-size:16px;" id = "new_status_open_id" class="fa fa-arrow-up"></i>
                                                                                    <?php 
                                                                                        } 
                                                                                    ?>  
                                                                                        <small class="fleft100">Foto identidade aberta <br>(Frente e verso junto)</small>
                                                                                    </div>
                                                                                </label>
									</div>
									<div class="fleft100 pd-lr5 m-top10">
										<label for="new_selid">
                                                                                    <input type="file" id="new_selid" class="hidden">                                        
                                                                                    <?php 
                                                                                        if($_SESSION['new_selfie_with_identity']){
                                                                                    ?>
                                                                                    <div id="new_check_selfie_with_identity" class="upl uplgreen c-pointer">
                                                                                        <img src="<?php echo base_url().'assets/'?>img/icones/SELFIE-ID.png" alt="">
                                                                                        <i style="font-size:16px;" id = "new_status_selfie_id" class="fa fa-check-circle-o"></i>
                                                                                    <?php 
                                                                                        } else {
                                                                                    ?>
                                                                                    <div id="new_check_selfie_with_identity" class="upl uplsilver c-pointer">
                                                                                        <img src="<?php echo base_url().'assets/'?>img/icones/SELFIE-ID.png" alt="">
                                                                                        <i style="font-size:16px;" id = "status_selfie_id" class="fa fa-arrow-up"></i>
                                                                                    <?php 
                                                                                        } 
                                                                                    ?>  
                                                                                        <small class="fleft100">Selfie com identidade <br>(Lado com foto)</small>
                                                                                    </div>
                                                                                </label>
									</div>
								</div>
                                                                <div class="fleft100 pd-lr5 m-top10">
                                                                    <label for="new_ucpf_img" class="dc m-top5">
                                                                        <input type="file" id="new_ucpf_img" class="hidden">
                                                                        <input type="checkbox" id="new_ucpf" style="margin-top: 2px;"> 
                                                                        <small style="text-decoration: none;">
                                                                            <b class="fleft100">Minha identidade não possui CPF</b> Marque para fazer upload do seu CPF
                                                                        </small>
                                                                    </label>
                                                                </div>
								<div class="fleft100 m-top30 text-center">
                                                                    <button id ="send_new_photos" class="bt-green mxw-300">
                                                                        Enviar novas fotos
                                                                    </button>
                                                                </div>
							</div>						
						</div>
					</div>
				</div>
			</div>

			<div class="fleft100 final d-none">
				<h2 class="bk-green5 text-center pd-tb15 fw-800"><img src="<?php echo base_url().'assets/'?>img/icones/iselid.png" alt=""> Pronto!</h2>
				<div class="fleft100 pd-30 bk-fff ">
					<div class="fleft100 pd-lr60 m-top40 m-b40">
						<h4 class="cl-blue m-b10">Dados enviados com sucesso!</h4>
						<p>
							Se estiver tudo certo seu crédito será liberado. <br><b>Vamos enviar e-mails de atualizações sobre o seu pedido.</b> Até já!
						</p>
						<div class="fleft100 text-center m-top30">
							<h4 class="cl-blue m-b10">Está com dúvidas?</h4>
							<p>
								Fala com a gente pelo e-mail:  <br><b>seja@livre.digital</b>
							</p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<?php //include_once "inc/footer-interno.php";?>