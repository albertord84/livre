<!DOCTYPE html>
<html lang="pt-BR">
<head>
	<meta charset="UTF-8">
    <title>Livre.digital</title>
    <meta name="viewport" content="width=device-width">
    <link rel="shortcut icon" type="image/png" href="<?php echo base_url().'assets/'?>img/icones/favicon.jpeg">

	<!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">

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

        <!-- JS -->
        <script type="text/javascript">
            var base_url = '<?php echo base_url();?>';
            var key = '<?php echo $_SESSION['key'];?>';
        </script>
    
</head>
<body id="bcheck">
	<header class="fleft100 m-top30 m-none-xs text-center">
		<div class="container">
			<div class="col-md-10 col-sm-12 col-xs-12 fnone i-block">
				<div class="logo col-md-3 col-sm-3 col-xs-12 pd-0 center-xs m-top12 text-left"><a href=""><img src="<?php echo base_url().'assets/'?>img/icones/logo.png" alt=""></a></div>
				<div class="col-md-3 col-sm-3 col-xs-12 pd-0 text-right pull-right center-xs m-top20">
					<ul class="menu i-block m-top10-xs">				
						<li><a href="">Suporte</a></li>
						<li class="tv cl-fff">|</li>
					</ul>
					<ul class=" sociais i-block">
						<li><a href="https://www.instagram.com/livre.digital/" target="_blank"><img src="<?php echo base_url().'assets/'?>img/icones/ig.png"></a></li>
                                                <li><a href="https://facebook.com/Livre.dig/?tsid=0.714847921740313&source=result&__nodl&_rdr" target="_blank"><img src="<?php echo base_url().'assets/'?>img/icones/fb.png"></a></li>
					</ul>
				</div>
			</div>
		</div>
	</header>

<section class="fleft100 pd-tb40">
    <!--modal_container_alert_message_empr-->
        <div class="modal fade" style="top:10%" id="modal_alert_message_empr" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div id="modal_container_alert_message_empr" class="modal-dialog modal-sm" role="document">                                                          
                <div class="modal-content">
                    <div class="modal-header">
                        <button id="btn_modal_close_empr" type="button" class="close" style="background:#fff;" data-dismiss="modal" aria-label="Close">
                            <img src="<?php echo base_url() . 'assets/img/icones/índice.png'; ?>"> 
                        </button>
                        <h5 class="modal-title" id="myModalLabel"><b>Mensagem</b></h5>                        
                    </div>
                    <div class="modal-body">                                            
                        <p id="message_text_empr"></p>                        
                    </div>
                    <div class="modal-footer text-center">
                        <button id="accept_modal_alert_message_empr" type="button" class="btn btn-primary active text-center ladda-button" data-style="expand-left" data-spinner-color="#ffffff" data-dismiss="modal">
                            <spam class="ladda-label"><div style="color:white; font-weight:bold">ACEITAR</div></spam>
                        </button>
                    </div>
                </div>
            </div>                                                        
        </div>
        <div class="modal" id="wait_emp" style="left: 50%; top: 40%;">
            <img src="<?php echo base_url().'assets/img/icones/GIF SITE LIVRE.gif';?>">
        </div>
	<div class="container">	
		<div class="col-md-6 col-sm-8 col-xs-12 col-md-offset-3 col-sm-offset-2">
			<div class="fleft100 selct">
				<h2 class="bk-green5 text-center fw-600 pd-tb15">RESUMO DO EMPRÉSTIMO</h2>
				<div class="fleft100 pd-30 bk-fff cl-green2 text-center fw-600">						
					<p>
						Custo de serviço cobrado pela Livre:
						<span class="cl-black ft-size17 fw-800 fleft100"><?php echo $_SESSION['transaction_values']['amount_months'];?> parcelas de R$<?php echo $_SESSION['transaction_values']['month_value'];?></span>
						<br><br><br>
						Acréscimo de juros cobrado pelo seu cartão de <br>
						crédito pelo parcelamento do saque:
						<span class="cl-black ft-size17 fw-800 fleft100"><?php echo $_SESSION['transaction_values']['amount_months'];?> parcelas de R$150,00.</span>
						<span class="fleft100 pd-tb10">--------------------------------------------------------</span>
						<span class="fleft100 ft-size17">Valor final: </span>
						<span class="cl-black ft-size17 fw-800 fleft100"><?php echo $_SESSION['transaction_values']['amount_months'];?> parcelas de R$450,00. </span>
						<span class="cl-black ft-size17 fw-800 fleft100">Custo Efetivo Total (CET): 85%</span>
						<span class="fleft100 pd-tb10">--------------------------------------------------------</span>
					</p>						
					
					<div class="col-xs-12 col-sm-5  text-center"><button id="btn_cancel_resume" class="bt-green ft-size14 w100" style="background-color: #e1e1e1">Cancelar</button></div>
					<div class="col-xs-12 col-sm-7 text-center"><button id="btn_accept_resume" class="bt-green ft-size14">Confirmar</button></div>

					<p class="ft-size15 text-left pd-lr20 m-top20 fleft100 m-b0">
						*Após solicitar o empréstimo, em caso de desistência, basta solicitar o cancelamento conosco pelo e-mail seja@livre.digital no prazo de 7 dias, sem qualquer prejuízo. Adotamos uma política de cancelamento flexível e com 100% de satisfação garantida. 
						<br><br>
						<b>Na Livre.digital você é Livre para escolher o que vai fazer!</b> 
					</p>
				</div>	
			</div>	
		</div>
	</div>
</section>
<?php include_once "inc/footer-interno.php";?>