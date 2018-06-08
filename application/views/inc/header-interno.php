<!--<!DOCTYPE html>
    Comentado. Nuevo header a continuacion. Eliminar despues.
<html lang="pt-BR">
<head>
	<meta charset="UTF-8">
	<title>Livre.com</title>
	<meta name="viewport" content="width=device-width">
	<link rel="icon" type="image/png" href="img/favicon.png">

	 Font Awesome 
	<link rel="stylesheet" href="css/font-awesome/font-awesome.min.css">

	 GALERIA 	
	<link rel="stylesheet" type="text/css" href="galeria/css/fresco/fresco.css" />

	 Bootstrap 
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/bootstrap-multiselect.css">

	 Owl Carousel Assets 
	<link href="css/carousel/owl.carousel.css" rel="stylesheet">
	<link href="css/carousel/owl.theme.css" rel="stylesheet">
	<link href="css/carousel/owl.transitions.css" rel="stylesheet">

	 CSS 
	<link rel="stylesheet" href="css/estilo.css" />
	<link rel="stylesheet" href="css/definicoes.css" />
	<link rel="stylesheet" href="css/media.css" />
</head>-->
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Livre.digital</title>
    <meta name="viewport" content="width=device-width">
    <link rel="shortcut icon" type="image/png" href="<?php echo base_url().'assets/'?>img/icones/favicon.png">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">

    <!-- GALERIA -->	
    <link rel="stylesheet" type="text/css" href="<?php echo base_url().'assets/'?>galeria/css/fresco/fresco.css" />

    <!-- Bootstrap -->
    <link rel="stylesheet" href="<?php echo base_url().'assets/'?>css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url().'assets/'?>css/bootstrap-multiselect.css">

    <!-- Owl Carousel Assets -->
    <link href="<?php echo base_url().'assets/'?>css/carousel/owl.carousel.css" rel="stylesheet">
    <link href="<?php echo base_url().'assets/'?>css/carousel/owl.theme.css" rel="stylesheet">
    <link href="<?php echo base_url().'assets/'?>css/carousel/owl.transitions.css" rel="stylesheet">

    <!-- CSS -->
    <link rel="stylesheet" href="<?php echo base_url().'assets/'?>css/estilo.css" />
    <link rel="stylesheet" href="<?php echo base_url().'assets/'?>css/definicoes.css" />
    <link rel="stylesheet" href="<?php echo base_url().'assets/'?>css/media.css" />

    <!-- JS -->
    <script type="text/javascript">
        var base_url = '<?php echo base_url();?>';    
    </script>

    <?php include_once "pixel_facebook.php";?>
    <?php include_once "pixel_gtags.php";?>
    <?php include_once "pixel_adwords.php";?>

</head>

<body>
	<header class="fleft100 pd-tb30 hinter center-xs">
		<div class="container">
			<div class="logo-inter col-md-2 col-sm-2 col-xs-12 center-xs"><a href=""><img src="img/icones/logo-interna.png" alt=""></a></div>
			<div class="col-md-7 col-sm-7 col-xs-12">
				<ul class="mn fleft100 m-top2"> 
					<li><a href="resumo.php">RESUMO</a></li>
					<li><a href="transacoes.php">TRANSAÇÕES</a></li>
					<li><a href="configuracoes.php">CONFIGURAÇÕES</a></li>
					<li><a href="afiliados.php">AFILIADOS</a></li>
				</ul>
			</div>
			<div class="col-md-3 col-sm-3 col-xs-12 text-right center-xs">
				<ul class="menu i-block m-top10-xs">
					<li><a href="">Conta</a></li>
					<li class="tv">|</li>
					<li><a href="">Sair</a></li>
				</ul>
			</div>
		</div>
	</header>