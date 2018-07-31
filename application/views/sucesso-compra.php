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
    <link rel="stylesheet" href="<?php echo base_url().'assets/css/bootstrap-datepicker.min.css?'.$SCRIPT_VERSION;?>">

    <!-- Owl Carousel Assets -->
    <link href="<?php echo base_url().'assets/css/carousel/owl.carousel.css?'.$SCRIPT_VERSION;?>" rel="stylesheet">
    <link href="<?php echo base_url().'assets/css/carousel/owl.theme.css?'.$SCRIPT_VERSION;?>" rel="stylesheet">
    <link href="<?php echo base_url().'assets/css/carousel/owl.transitions.css?'.$SCRIPT_VERSION;?>" rel="stylesheet">

    <!-- CSS -->
    <link rel="stylesheet" href="<?php echo base_url().'assets/css/estilo.css?'.$SCRIPT_VERSION;?>" />
    <link rel="stylesheet" href="<?php echo base_url().'assets/css/definicoes.css?'.$SCRIPT_VERSION;?>" />
    <link rel="stylesheet" href="<?php echo base_url().'assets/css/media.css?'.$SCRIPT_VERSION;?>" />
    
    <?php include_once "pixel_facebook.php";?>
    <?php include_once "pixel_gtags.php";?>        
    <?php include_once "pixel_ecomerce_analytics.php";?>
    <?php include_once "pixel_adwords.php";?>
    
</head>
<body id="bcheck">
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
						<li><a href="">Suporte</a></li>
					</ul>
				</div>
			</div>
		</div>
	</header>

<section class="fleft100 pd-tb40 m-top40">
	<div class="container">	
		<div class="col-md-8 col-sm-8 col-xs-12 col-md-offset-2  m-top150">
			<div class="fleft100 final">
				<h2 class="bk-green5 text-center pd-tb15 fw-800"><img src="<?php echo base_url().'assets/'?>img/icones/iselid.png" alt=""> Pronto!</h2>
				<div class="fleft100 pd-30 bk-fff ">
					<div class="fleft100 pd-lr60 m-top40 m-b40">
						<h4 class="cl-blue m-b10">Dados enviados com sucesso!</h4>
						<p>
							Se estiver tudo certo seu empréstimo será liberado. <br><b>Vamos enviar e-mails de atualizações sobre o seu pedido.</b> Até já!
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
<?php include_once "inc/footer-interno.php";?>