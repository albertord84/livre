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
        
        <!-- JS -->
        <script type="text/javascript">
            var base_url = '<?php echo base_url();?>';
            var key = '<?php echo $key;?>';
        </script>
        
        <?php include_once "pixel_facebook.php";?>
        <?php include_once "pixel_gtags.php";?>        
        <?php //include_once "pixel_ecomerce_analytics.php";?>
        <?php //include_once "pixel_adwords.php";?>
</head>
<body>
    
    
    <header class="fleft100 pd-tb30 pabsolute m-top100 m-none-xs text-center">
        <div class="container">
            <div class="col-md-10 col-sm-12 col-xs-12 fnone i-block">
                <div class="logo col-md-3 col-sm-3 col-xs-12 pd-0 center-xs m-top12 text-left">
                    <a href=""><img src="<?php echo base_url().'assets/'?>img/icones/logo.png" alt=""></a>
                </div>
                <div class="col-md-5 col-sm-5 col-xs-12 fr text-left">
                    <div class="fleft100">
                        <h3 class="fw-400 ft-Rajdhani">Empréstimo Online em 2 minutos <br>através do seu <b>cartão de crédito.</b></h3>
                    </div>
                </div>
                <div class="col-md-4 col-sm-4 col-xs-12 pd-0 text-right center-xs m-top20 spacement">
                    <ul class="menu i-block m-top10-xs">
                        <li><a href="https://www.instagram.com/livre.digital/" target="_blank"><img src="<?php echo base_url().'assets/'?>img/icones/ig.png"></a></li>
                        <li class="tv cl-black">|</li>
                        <li><a href="https://facebook.com/Livre.dig/?tsid=0.714847921740313&source=result&__nodl&_rdr" target="_blank"><img src="<?php echo base_url().'assets/'?>img/icones/fb.png"></a></li>
                        <li class="tv cl-black">|</li>
                        <li><a href="#contact_me">Suporte </a></li>
                        <li class="tv cl-black">|</li>
                        <li><a href="<?php echo base_url()?>index.php/welcome/afhome"> Afiliados</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </header>
    <section class="fleft100 cover text-center" id="banner" style="background-image: url(<?php echo base_url().'assets/'?>img/banners/home.jpg);">
	<div class="container">
            <div class="fleft100 m-top150">
                <div class="col-md-10 col-sm-12 col-xs-12 fnone i-block">
                    <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3 pd-0">
                        <h1 class="ft-size55 ft-Rajdhani fleft100 m-top60 text-left center-xs" style="margin-left: -4px;">Dinheiro na conta em 24h.</h1>
                    </div>
                </div>
                <div class="fleft100"><img src="<?php echo base_url().'assets/'?>img/icones/down-ar.png" class="i-block m-top50 m-b30"></div>
            </div>
            <div class="verific prelative m-top40 m-top20-xs text-right center-xs">
                <div id="verify_container">
                    <div class="col-md-4 col-sm-4 col-xs-12">
                        <span class="fleft100">Qual valor deseja solicitar?</span>
                    </div>
                    <div class="col-md-4 col-sm-4 col-xs-12 text-center">
                        <input id="input_verify" type="text" class="bverde ph-fff cl-fff" title="de R$ 0500 até R$ 3000" placeholder="R$ 0.00" maxlength="11">                        
                    </div>
                    <div class="col-md-4 col-sm-4 col-xs-12 text-center">
                        <button id="btn_verify" class="bt-white m-top5 btn-verificar">VERIFICAR</button>
                    </div>
                </div>
                <div class="fleft100 prelative ft-Rajdhani">
                    <div id="contratar_emprestimo_container"  class="result d-none pabsolute center-xs">
                        <div class="fleft100 pd-30 bk-fff pd-10-xs">
                            <div class="fleft100 bverde2">
                                <div class="col-md-7 col-sm-7 col-xs-12">
                                    <div class="ft-size13 col-md-7 col-sm-7 col-xs-12 pd-0 fw-600 text-right m-top5">
                                        Para solicitar o valor acima, você precisa ter este valor ou mais de limite disponível no seu cartão de crédito:
                                    </div>
                                    <h3 id="total_cust_value" class="ft-size22 i-block col-md-5 col-sm-5 col-xs-12 pd-0 fw-400 m-top15">R$ 5.000,00</h3>
                                </div>
                                <div class="col-md-5 col-sm-5 col-xs-12 text-center m-top10-xs">
                                    <div class="fleft100 parc m-top10-xs">
                                        <div class="col-md-3 col-sm-3 col-xs-12 pd-0">
                                            <small class="fleft100" style="margin-top: 5px;">PARCELAS</small>
                                            <b class="fleft100"><i id="result-value1">12</i>X <small class="fw-300">DE:</small></b>
                                        </div>
                                        <div class="col-md-9 col-sm-9 col-xs-12 pd-0">
                                            <h2 id="month_value" class="fleft100 text-center"><strong>R$ 518,75</strong></h2>
                                        </div>
                                        <input value="12" min="6" step="1" max="12" type="range" id="range" class="range fleft100 bk-none">
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
                            </div>
                        </div>
                        <div class="fleft100 bk-silver pd-30  pd-10-xs">
                            <div class="col-md-3 col-sm-3 col-xs-12 text-left center-xs">
                                <div class="fleft100">
                                    <small>CUSTO TOTAL (CET)</small>
                                    <h3 class="fleft100" id="total_cust_value1"><i><strong >R$ 6.225,00</strong></i></h3>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-4 col-xs-12 m-top10-xs">
                                <small>SELECIONE COMO IRÁ USAR O DINHEIRO</small>
                                <select id="money_use_form" class="fleft100 bk-fff pd-5 m-top5 cl-grafite sradius border-1px">
                                    <option value="00">Selecione     ...</option>
                                    <option value="01">Compras</option>
                                    <option value="02">Quitar dívida do cartão de crédito</option>
                                    <option value="03">Quitar cheque especial</option>
                                    <option value="04">Quitar outras dívidas</option>
                                    <option value="05">Investir em negócio próprio</option>
                                    <option value="06">Educação</option>
                                    <option value="07">Viagem</option>
                                    <option value="08">Saúde</option>
                                    <option value="09">Outros ...</option>
                                </select>							
                            </div>						
                            <div class="col-md-5 col-sm-5 col-xs-12 cl-fff">
                                <div id="btn_contratar_emprestimo" class="bt-green fleft100 btn-verificar" style="cursor: default;">Próximo passo</div>
                                <label for="ck" class="dc m-top5">
                                    <input type="checkbox" id="use_term" checked> 
                                    <small>
                                        <a href="<?php echo base_url()?>assets/others/Termos de Uso e Política de Privacidade da Livre Digital.pdf" target="_blank">
                                            Declaro que li e aceito os termos de uso e a política de privacidade
                                        </a>
                                    </small>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="fleft100 pd-tb30 cl-fff cover center-xs" id="real" style="background-image: url(<?php echo base_url().'assets/'?>img/banners/real.png);">
	<div class="container">
            <div class="col-md-8 col-sm-12 col-xs-12 pull-right">
                <div class="fleft100">
                    <div class="col-md-6 col-sm-6 col-xs-12 pd-lr0-xs m-top20 m-none-xs">
                        <div class="col-md-3 col-sm-3 col-xs-12">
                            <img src="<?php echo base_url().'assets/'?>img/icones/check2.png" width="60">
                        </div>
                        <div class="col-md-9 col-sm-9 col-xs-12 m-top10-xs">
                            <h2 class="ft-size20 fw-600 fleft100 wrap d-webkit clamp2">Pague as prestações através da fatura do seu cartão de crédito!</h2>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-12 m-top20">
                        <div class="fleft100 pd-lr15">
                            <h5 class="fw-300 m-b10">Utilize seu <b>cartão de crédito</b> para solicitar crédito em apenas <b>2 minutos.</b></h5>
                        </div>
                        <div class="fleft100 pd-lr15">
                            <img src="<?php echo base_url().'assets/'?>img/icones/cards.png" style="width:90%" alt="">
                        </div>					
                    </div>
                </div>
                <div class="fleft100 m-top70 m-top20-xs">
                    <div class="col-md-6 col-sm-6 col-xs-12 m-top20">
                        <div class="col-md-3 col-sm-3 col-xs-12">
                            <img src="<?php echo base_url().'assets/'?>img/icones/emp.png" alt="">
                        </div>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <h4 class="ft-size20 fw-300">Análise de crédito instantânea.</h4>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-12 m-top20">
                        <div class="col-md-3 col-sm-3 col-xs-12">
                            <img src="<?php echo base_url().'assets/'?>img/icones/tx.png" alt="">
                        </div>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <h4 class="ft-size20 fw-300">Taxa de juros a partir de 2,99% a.m.</h4>
                        </div>
                    </div>
                </div>
            </div>		
	</div>
    </section>

    <section class="fleft100 pd-tb80 m-b100" id="leao">
	<div class="container">
		<div class="fleft100">
			<div class="col-md-6 col-sm-6 col-xs-12">
				<h1 class="fw-300 fleft100 text-left">crédito<b class="">fácil</b> <span>{</span></h1>
			</div>
			<div class="col-md-6 col-sm-6 col-xs-12 center-xs">
				<h2>Solicitar um crédito no Livre.digital leva apenas <b>2 minutos</b> e a resposta é instantânea!</h2>
			</div>			
		</div>

		<div class="col-md-6 col-sm-6 col-xs-12 m-top80">
			<div class="fleft100 bleftgreen pd-bottom20">
				<div class="ft-size17">
					O Livre.digital utiliza uma modalidade de crédito atrelada ao seu cartão de crédito, utilizando o limite disponível como garantia e o pagamento das parcelas através da sua fatura. Você recebe o dinheiro na sua conta bancária em até 1 dia útil. 
				</div>
			</div>
			<p class="ft-size17 bl-silver">
				  Basta preencher os dados pessoais, dados do cartão de crédito e dados bancários. A verificação é feita na hora e a resposta sobre a aprovação do seu crédito é instantânea.
			</p>
			<div class="fleft100 bleftgreen pd-top20">
				<div class="ft-size17">
					<h3 class="ft-size30"><i><b>E melhor!</b></i></h3>
					O envio dos documentos é totalmente digital.
				</div>
			</div>
		</div>
		<div class="col-md-6 col-sm-6 col-xs-12 m-top80">
			<img src="<?php echo base_url().'assets/'?>img/banners/d.png" class="mxw-800">
		</div>
	</div>
</section>

<section id="i" class="fleft100 pd-tb40">
	<div class="container">
		<div class="i i-block fnone pd-tb15 col-md-10">
			<div class="col-md-1 col-sm-2 col-xs-12 text-center"><img src="<?php echo base_url().'assets/'?>img/icones/i.png" width="30"></div>
			<div class="col-md-11 col-sm-10 col-xs-12 pd-0 m-top20-xs text-left ft-size11">
				<h5>IMPORTANTE:</h5> Para solicitar crédito o dono do cartão de crédito e da conta bancária devem ser a mesma pessoa (mesmo CPF). Não é permitido usar o cartão de outra pessoa para solicitar crédito. Em caso de titulares diferentes o empréstimo não será efetivado, sendo negado na hora.
			</div>
		</div>
	</div>
</section>
<section>
<?php //include_once $_SERVER['DOCUMENT_ROOT']."/livre/src/application/views/"."inc/footer.php";?>

