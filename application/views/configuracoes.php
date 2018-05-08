<!DOCTYPE html>
<html lang="pt-BR">
<head>
	<meta charset="UTF-8">
	<title>Livre.com</title>
	<meta name="viewport" content="width=device-width">
	<link rel="icon" type="image/png" href="img/favicon.png">

	<!-- Font Awesome -->
	<link rel="stylesheet" href="css/font-awesome/font-awesome.min.css">

	<!-- GALERIA -->	
	<link rel="stylesheet" type="text/css" href="galeria/css/fresco/fresco.css" />

	<!-- Bootstrap -->
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/bootstrap-multiselect.css">

	<!-- Owl Carousel Assets -->
	<link href="css/carousel/owl.carousel.css" rel="stylesheet">
	<link href="css/carousel/owl.theme.css" rel="stylesheet">
	<link href="css/carousel/owl.transitions.css" rel="stylesheet">

	<!-- CSS -->
	<link rel="stylesheet" href="css/estilo.css" />
	<link rel="stylesheet" href="css/definicoes.css" />
	<link rel="stylesheet" href="css/media.css" />
</head>
<body>
	<header class="fleft100 pd-tb30 hinter center-xs">
		<div class="container">
			<div class="logo-inter col-md-2 col-sm-2 col-xs-12 center-xs"><a href=""><img src="img/icones/logo-interna.png" alt=""></a></div>
			<div class="col-md-7 col-sm-7 col-xs-12">
				<ul class="mn fleft100 m-top2"> 
					<li><a href="">RESUMO</a></li>
					<li><a href="">TRANSAÇÕES</a></li>
					<li><a href="">CONFIGURAÇÕES</a></li>
					<li><a href="">AFILIADOS</a></li>
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
<section class="fleft100 m-top40 m-b100 center-xs">
	<div class="container">
		<h4><em>Configurações</em></h4>
		<div class="fleft100 bk-fff pd-tb50 pd-lr25 m-top5">
			<div class="col-md-6 col-sm-6 col-xs-12 pd-lr25 pd-lr0-xs">
				<div class="col-md-6 col-sm-6 col-xs-12 pd-0 center-xs">
					<span class="fw-600 fleft100 cl-black">Taxa de juros ao mês</span>
					<a href="" class="cl-silver fw-500"><small><u>Histórico</u></small></a>
				</div>
				<div class="col-md-3 col-sm-3 col-xs-6 m-top20-xs pd-lr20 pd-lr0-xs m-top20-xs">
					<input type="text" class="ipsilver">
				</div>
				<div class="col-md-3 col-sm-3 col-xs-6 m-top20-xs pd-0 pd-left5-xs m-top20-xs">
					<a href="" class="bt-blue fleft100 text-center ellipse">Atualizar</a>
				</div>
			</div>
			<div class="col-md-6 col-sm-6 col-xs-12 pd-lr25 m-top20-xs pd-lr0-xs center-xs">
				<div class="col-md-6 col-sm-6 col-xs-12 pd-0">
					<span class="fw-600 fleft100 cl-black">Taxa de adesão (Cédit Société)</span>
					<a href="" class="cl-silver fw-500"><small><u>Histórico</u></small></a>
				</div>
				<div class="col-md-3 col-sm-3 col-xs-6 m-top20-xs pd-lr20 pd-lr0-xs">
					<input type="text" class="ipsilver">
				</div>
				<div class="col-md-3 col-sm-3 col-xs-6 m-top20-xs pd-0 pd-left5-xs">
					<a href="" class="bt-blue fleft100 text-center ellipse">Atualizar</a>
				</div>
			</div>
			<div class="fleft100 pd-lr25 pd-lr0-xs"><hr class="linesilver fleft100"></div>
			<div class="col-md-6 col-sm-6 col-xs-12 pd-lr25 pd-lr0-xs">
				<div class="col-md-6 col-sm-6 col-xs-12 pd-0">
					<span class="fw-600 fleft100 cl-black">Número de parcelas</span>
					<a href="" class="cl-silver fw-500"><small><u>Histórico</u></small></a>
				</div>
				<div class="col-md-6 col-sm-6 col-xs-12 pd-0">
					<div class="fleft100 parc m-top10-xs">
						<div class="col-md-1 col-sm-1 col-xs-1 pd-0 cl-black fw-600 m-top5">2X</div>
						<div class="col-md-9 col-sm-9 col-xs-10"><input value="1" min="1" step="1" max="12" type="range" id="range" class="range fleft100 bk-none"></div>
						<div class="col-md-1 col-sm-1 col-xs-1 pd-0 cl-black fw-600 m-top5"><span id="result-value">1</span>X</b></div>
					</div>
					<script>
						// RANGER
						var range = document.getElementById('range');
						var result = document.getElementById('result-value');

						range.addEventListener('change', function(){
						    result.innerHTML = this.value;
						    $(".its li").addClass('at');
						});
					</script>
				</div>
				<div class="col-md-12 col-sm-12 col-xs-12 pd-0">
					<a href="" class="bt-blue pd-lr25 i-block m-top10 text-center">Atualizar</a>
				</div>
			</div>
			<div class="col-md-6 col-sm-6 col-xs-12 pd-lr25 pd-lr0-xs m-top20-xs">
				<div class="col-md-6 col-sm-6 col-xs-12 pd-0 center-xs">
					<span class="fw-600 fleft100 cl-black">Taxa de juros mensal (Banco)</span>
					<a href="" class="cl-silver fw-500"><small><u>Histórico</u></small></a>
				</div>
				<div class="col-md-3 col-sm-3 col-xs-6 m-top20-xs pd-lr20 pd-lr0-xs">
					<input type="text" class="ipsilver">
				</div>
				<div class="col-md-3 col-sm-3 col-xs-6 pd-0 m-top20-xs pd-left5-xs">
					<a href="" class="bt-blue fleft100 text-center ellipse">Atualizar</a>
				</div>
			</div>
			<div class="fleft100 pd-lr25 pd-lr0-xs"><hr class="linesilver fleft100"></div>
			<div class="col-md-6 col-sm-6 col-xs-12 pd-lr25 pd-lr0-xs pull-right">
				<div class="col-md-6 col-sm-6 col-xs-12 pd-0 center-xs">
					<span class="fw-600 fleft100 cl-black">Taxa de adesão (Meio de pagamento)</span>
					<a href="" class="cl-silver fw-500"><small><u>Histórico</u></small></a>
				</div>
				<div class="col-md-3 col-sm-3 col-xs-6 m-top20-xs pd-lr20 pd-lr0-xs">
					<input type="text" class="ipsilver">
				</div>
				<div class="col-md-3 col-sm-3 col-xs-6 pd-0 m-top20-xs pd-left5-xs">
					<a href="" class="bt-blue fleft100 text-center ellipse">Atualizar</a>
				</div>
			</div>
		</div>
	</div>
</section>
</section>
</body>
<!--[if lt IE 9]>
<script src="js/jquery-1.9.1.js"></script>
<![endif]-->
<!--[if gte IE 9]><!-->
<script src="js/jquery-3.1.1.min.js"></script>
<!--<![endif]-->
<script src="js/bootstrap.min.js"></script>
<script src="js/bootstrap-multiselect.js"></script>
<!-- OWL SLIDER -->
<script src="js/carousel/owl.carousel.js"></script>
<!-- GALERIA -->
<script type="text/javascript" src="galeria/js/fresco/fresco.js"></script>
<!-- FILTRAR -->
<script src="js/filtrar.js"></script> 
<!-- VALIDATE -->
<script src="js/validate.js" type="text/javascript"></script>
<!-- MASCARAS -->
<script type="text/javascript" src="js/maskinput.js"></script>
<!-- Scripts -->
<script type="text/javascript" src="js/script.js"></script>


</html>
