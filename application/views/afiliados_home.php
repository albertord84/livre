<!DOCTYPE html>
<html lang="pt-BR">
<head>
	<meta charset="UTF-8">
	<title>Livre.digital</title>
	<meta name="viewport" content="width=device-width">
	<link rel="shortcut icon" type="image/png" href="<?php echo base_url().'assets/img/icones/favicon.png'?>">

	<!-- Font Awesome -->
	<link rel="stylesheet" href="<?php echo base_url().'assets/css/font-awesome/font-awesome.min.css?'.$SCRIPT_VERSION?>">

	<!-- GALERIA -->	
	<link rel="stylesheet" type="text/css" href="<?php echo base_url().'assets/galeria/css/fresco/fresco.css?'.$SCRIPT_VERSION?>" />

	<!-- Bootstrap -->
	<link rel="stylesheet" href="<?php echo base_url().'assets/css/bootstrap.min.css?'.$SCRIPT_VERSION?>">
	<link rel="stylesheet" href="<?php echo base_url().'assets/css/bootstrap-multiselect.css?'.$SCRIPT_VERSION?>">

	<!-- Owl Carousel Assets -->
	<link  rel="stylesheet" href="<?php echo base_url().'assets/css/carousel/owl.carousel.css?'.$SCRIPT_VERSION?>">
	<link  rel="stylesheet" href="<?php echo base_url().'assets/css/carousel/owl.theme.css?'.$SCRIPT_VERSION?>">
	<link  rel="stylesheet" href="<?php echo base_url().'assets/css/carousel/owl.transitions.css?'.$SCRIPT_VERSION?>">

	<!-- CSS -->
	<link rel="stylesheet" href="<?php echo base_url().'assets/css/estilo.css?'.$SCRIPT_VERSION?>" />
	<link rel="stylesheet" href="<?php echo base_url().'assets/css/definicoes.css?'.$SCRIPT_VERSION?>" />
	<link rel="stylesheet" href="<?php echo base_url().'assets/css/media.css?'.$SCRIPT_VERSION?>" />
        
        <script type="text/javascript">
            var base_url = '<?php echo base_url();?>';
            var key = '<?php echo $key;?>';
        </script>
        <?php include_once "pixel_facebook.php";?>
        <?php include_once "pixel_gtags.php";?>
        <?php include_once "pixel_adwords.php";?>
        
</head>
<body>
	<header class="fleft100 pd-tb30 pabsolute m-top100 m-none-xs">
		<div class="container">
			<div class="logo col-md-2 col-sm-3 col-xs-12 pd-0 center-xs m-top12"><a href=""><img src="<?php echo base_url().'assets/'?>img/icones/logo.png" alt=""></a></div>
			<div class="col-md-10 col-sm-10 col-xs-12 pd-0 text-right center-xs m-top20">
                                <ul class=" sociais i-block">
                                    <li><a href="https://www.instagram.com/livre.digital/" target="_blank"><img src="<?php echo base_url().'assets/'?>img/icones/ig.png"></a></li>
                                    <li><a href="https://facebook.com/Livre.dig/?tsid=0.714847921740313&source=result&__nodl&_rdr" target="_blank"><img src="<?php echo base_url().'assets/'?>img/icones/fb.png"></a></li>
				</ul>
				<ul class="menu i-block m-top10-xs">
                                        <li class="tv cl-fff">|</li>
                                        <li><a href="#cadastrar_agora">Cadastre-se</a></li>
                                        <li class="tv cl-fff">|</li>
					<li><a href="#contact_me">Suporte</a></li>
                                        <li class="tv cl-fff">|</li>
                                        <li class = "dropdown_open nav navbar-nav navbar-right" class="col-md-12">                                            
                                            <a href="#" class="dropdown-toggle " data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="true">
                                                Login<spam class="caret"></spam>
                                            </a>
                                            <ul class="dropdown-menu" id ="main_dropdown">
                                                <li>
                                                    <div class="col-md-12 pd-10" style="width: 270px">
                                                        <div id="login_container2">
                                                            <form id="frm_affiliates_login" action="#" method="#" class="form text-center" role="form" accept-charset="UTF-8">
                                                                <div class="form-group center" style="font-family:sans-serif; font-size:0.9em">
                                                                    EXCLUSIVO PARA AFILIADOS                                                            </div>
                                                                <div class="form-group center" style="font-family:sans-serif; font-size:0.7em">
                                                                    Use email e senha                                                            
                                                                </div>
                                                                <div class="form-group">
                                                                    <input id="affiliate_email_login" type="text" class="form-control" placeholder="E-mail"  required="">
                                                                </div>
                                                                <div class="form-group">
                                                                        <input id="affiliate_pass_login" type="password" class="form-control" placeholder="Senha" required="">
                                                                </div>
                                                                <div class="form-group">
                                                                    <button id="btn_afiliate_login" class="bt-green btn-block ladda-button" type="button" data-style="expand-left" data-spinner-color="#ffffff">
                                                                        <spam class="ladda-label">ENTRAR</spam>
                                                                    </button>
                                                                </div>
                                                                <div id="container_login_message2" class="form-group" style="text-align:justify;visibility:hidden; font-family:sans-serif; font-size:0.9em">
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </li>
                                            </ul> 
                                        </li>                                        
				</ul>
				
			</div>
		</div>
	</header>
    <section class="fleft100 cover" id="bfil" style="background-image: url(<?php echo base_url().'assets/'?>img/banners/filiados.jpg);">
        <div class="container">
            <div class="col-md-10 col-sm-10 col-xs-12 pull-right">
                <h1 class="ft-size45 cl-fff">QUER GANHAR UMA <br>RENDA EXTRA?</h1>
                <h2>Traga clientes para o Livre.digital <br>e ganhe <span>10% de comissão</span> sobre <br>o valor do empréstimo!</h2>
            </div>
        </div>
    </section>
    <section class="fleft100 pd-tb80 filiados">
            <div class="container">
                    <div class="col-md-6 col-sm-6 col-xs-12 green">
                        <h1 class="fleft100 text-center fw-300 m-b50">Benefícios para o <span><b class="fw-600">afiliado</b></span>:</h1>
                        <div class="col-md-8 col-sm-8 col-xs-12 pd-lr10">
                            <div class="fleft100 bd bk-fff pd-10 m-top10">
                                <div class="col-md-2 col-sm-2 col-xs-2 pd-0 m-top8 text-center">
                                    <img src="<?php echo base_url().'assets/'?>img/icones/mercado.png" alt="">
                                </div>
                                <div class="col-md-10 col-sm-10 col-xs-10">
                                    Comissão mais alta do mercado! <br>10% sobre o valor emprestado.
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-4 col-xs-12 pd-lr10">
                            <div class="fleft100 bd bk-fff pd-10 m-top10">
                                <div class="col-md-2 col-sm-2 col-xs-2 pd-0 m-top8 text-center">
                                    <img src="<?php echo base_url().'assets/'?>img/icones/pg.png" alt="">
                                </div>
                                <div class="col-md-10 col-sm-10 col-xs-10">
                                    Pagamento diário
                                </div>
                            </div>
                        </div>
                        <div class="col-md-5 col-sm-5 col-xs-12 pd-lr10">
                            <div class="fleft100 bd bk-fff pd-tb18 pd-lr10 m-top10">
                                <div class="col-md-2 col-sm-2 col-xs-2 pd-0 text-center">
                                    <img src="<?php echo base_url().'assets/'?>img/icones/br.png" alt="">
                                </div>
                                <div class="col-md-10 col-sm-10 col-xs-10">
                                    Sem burocracia
                                </div>
                            </div>
                        </div>
                        <div class="col-md-7 col-sm-7 col-xs-12 pd-lr10">
                            <div class="fleft100 bd bk-fff pd-10 m-top10">
                                <div class="col-md-2 col-sm-2 col-xs-2 pd-0 m-top8 text-center">
                                    <img src="<?php echo base_url().'assets/'?>img/icones/cr.png" alt="">
                                </div>
                                <div class="col-md-10 col-sm-10 col-xs-10">
                                    Análise de crédito <br>instantánea
                                </div>
                            </div>
                        </div>
                            <div class="col-md-7 col-sm-7 col-xs-12 pd-lr10">
                                    <div class="fleft100 bd bk-fff pd-10 m-top10">
                                            <div class="col-md-2 col-sm-2 col-xs-2 pd-0 text-center">
                                                    <img src="<?php echo base_url().'assets/'?>img/icones/on.png" alt="">
                                            </div>
                                            <div class="col-md-10 col-sm-10 col-xs-10">
                                                    Totalmente on-line
                                            </div>
                                    </div>
                                    <div class="fleft100 bd bk-fff pd-10 m-top10">
                                            <div class="col-md-2 col-sm-2 col-xs-2 pd-0 m-top10 text-center">
                                                    <img src="<?php echo base_url().'assets/'?>img/icones/op.png" alt="">
                                            </div>
                                            <div class="col-md-10 col-sm-10 col-xs-10">
                                                    Operação finalizada em <br>2 minutos
                                            </div>
                                    </div>
                            </div>
                            <div class="col-md-5 col-sm-5 col-xs-12 pd-lr10">
                                    <div class="fleft100 bd bk-fff pd-lr15 pd-tb20 m-top10">
                                            <div class="col-md-2 col-sm-2 col-xs-2 pd-0 text-center">
                                                    <img src="<?php echo base_url().'assets/'?>img/icones/cort.png" alt="">
                                            </div>
                                            <div class="col-md-10 col-sm-10 col-xs-10">
                                                    Corte de custos operacionais <small class="fleft100 m-top5 ft-size11">(malote, motoboy, impressão, xerox, etc)</small>
                                            </div>
                                    </div>
                            </div>
                            <div class="fleft100 pd-lr10">
                                    <div class="fleft100 bd bk-fff pd-15 m-top10">
                                            <div class="col-md-2 col-sm-2 col-xs-2 pd-0 text-center">
                                                    <img src="<?php echo base_url().'assets/'?>img/icones/temp.png" alt="">
                                            </div>
                                            <div class="col-md-10 col-sm-10 col-xs-10 m-top2 ft-size15">
                                                    Economia de tempo na aprovação da operação
                                            </div>
                                    </div>
                            </div>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-12 blue m-top80-xs">
                            <h1 class="fleft100 text-center fw-300 m-b50">Benefícios para o <span><b class="fw-600">cliente</b></span>:</h1>
                            <div class="col-md-7 col-sm-7 col-xs-12 pd-lr10">
                                    <div class="fleft100 bd bk-fff pd-10 m-top10">
                                            <div class="col-md-2 col-sm-2 col-xs-2 pd-0 m-top8 text-center">
                                                    <img src="<?php echo base_url().'assets/'?>img/icones/cr.png" alt="">
                                            </div>
                                            <div class="col-md-10 col-sm-10 col-xs-10">
                                                    Análise de crédito instantánea
                                            </div>
                                    </div>
                            </div>
                            <div class="col-md-5 col-sm-5 col-xs-12 pd-lr10">
                                    <div class="fleft100 bd bk-fff pd-tb18 pd-lr10 m-top10">
                                            <div class="col-md-2 col-sm-2 col-xs-2 pd-0 text-center">
                                                    <img src="<?php echo base_url().'assets/'?>img/icones/br.png" alt="">
                                            </div>
                                            <div class="col-md-10 col-sm-10 col-xs-10">
                                                    Sem burocracia
                                            </div>
                                    </div>
                            </div>
                            <div class="col-md-5 col-sm-5 col-xs-12 pd-lr10">
                                    <div class="fleft100 bd bk-fff pd-10 m-top10">
                                            <div class="col-md-2 col-sm-2 col-xs-2 pd-0 m-top10 m-b10 text-center">
                                                    <img src="<?php echo base_url().'assets/'?>img/icones/on.png" alt="">
                                            </div>
                                            <div class="col-md-10 col-sm-10 col-xs-10 m-top10">
                                                    Totalmente on-line
                                            </div>
                                    </div>
                            </div>
                            <div class="col-md-7 col-sm-7 col-xs-12 pd-lr10">
                                    <div class="fleft100 bd bk-fff pd-10 m-top10">
                                            <div class="col-md-2 col-sm-2 col-xs-2 pd-0 m-top8 text-center">
                                                    <img src="<?php echo base_url().'assets/'?>img/icones/rd.png" alt="">
                                            </div>
                                            <div class="col-md-10 col-sm-10 col-xs-10">
                                                    Empréstimo através do limite disponível no cartão de crédito
                                            </div>
                                    </div>
                            </div>			
                            <div class="col-md-5 col-sm-5 col-xs-12 pd-lr10">
                                    <div class="fleft100 bd bk-fff pd-15 m-top10">
                                            <div class="col-md-2 col-sm-2 col-xs-2 pd-0 m-top2 text-center">
                                                    <img src="<?php echo base_url().'assets/'?>img/icones/op.png" alt="">
                                            </div>
                                            <div class="col-md-10 col-sm-10 col-xs-10 m-b5 m-top2">
                                                    Operação finalizada em 2 minutos
                                            </div>
                                    </div>
                            </div>
                            <div class="col-md-7 col-sm-7 col-xs-12 pd-lr10">
                                    <div class="fleft100 bd bk-fff pd-10 m-top10">
                                            <div class="col-md-2 col-sm-2 col-xs-2 pd-0 text-center">
                                                    <img src="<?php echo base_url().'assets/'?>img/icones/txx.png" alt="">
                                            </div>
                                            <div class="col-md-10 col-sm-10 col-xs-10">
                                                    Taxa de juros competitiva
                                            </div>
                                    </div>
                                    <div class="fleft100 bd bk-fff pd-10 m-top10">
                                            <div class="col-md-2 col-sm-2 col-xs-2 pd-0 text-center">
                                                    <img src="<?php echo base_url().'assets/'?>img/icones/temp.png" alt="">
                                            </div>
                                            <div class="col-md-10 col-sm-10 col-xs-10">
                                                    Dinheiro na conta em 24 horas
                                            </div>
                                    </div>
                            </div>
                    </div>

                    <div class="fleft100 text-center m-top80">
                            <h3>Cadastre-se gratuitamente e participe!</h3>
                            <a href="#cadastro" class="bt-green i-block m-top20 deslize"><i class="ft-size20 fa fa-chevron-down"></i></a>
                    </div>
            </div>

            <div class="fleft100 fc m-top60"></div>
            <div class="fleft100 pd-tb60 bk-fff cf">		
                    <div class="container">
                            <h1 class="ft-size55 fw-300 fleft100 pd-lr15">Como funciona</h1>
                            <div class="col-md-6 col-sm-6 col-xs-12 m-top40" style="border-right: 3px solid #fff;padding-bottom: 10px;">
                                    <p class="ft-size17">
                                            O programa de afiliados do Live.digital é ideal para lojas de crédito que fazem atendimento ao público e pessoas físicas que buscam uma renda extra. 
                                            <br><br>
                                            A verificação de crédito é feita na mesma hora e a resposta é imediata.
                                            <br><br>
                                            O papel do afiliado é recepcionar o cliente e recomendar o empréstimo do Live.digital. 
                                            <br><br>
                                            
                                    </p>
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-12 m-top80">
                                    <p class="ft-size17">
                                            Para realizar a operação, o afiliado precisa apenas contratar o empréstimo em nosso site na companhia do seu cliente, através de um link específico, recebido por e-mail após o preenchimento do cadastro abaixo. Simples e fácil, sem burocracia e leva apenas 2 minutos para realizar cada operação de crédito!
                                            <br><br>
                                            Traga seus clientes para o Live.digital! 
                                            Receba até 10 vezes mais do que a sua comissão atual, diariamente, sem burocracia, sem custos operacionais para o seu negócio e com muito mais benefícios para seus clientes!
                                            <br><br>
                                            Seja livre!
                                    </p>
                            </div>
                    </div>
            </div>

        <div class="fleft100 m-top60 text-center fmr-check" id="cadastro">
            <div class="container">
                <A name="cadastrar_agora"></A>
                <!--STEEP 1.1-->
                <div class="pd-0 col-md-4 col-sm-9 col-xs-12 cad1 fnone i-block text-left">
                    <h1 class="fw-300 fleft100">Cadastre-se grátis!</h1>
                    <div id="container_form_steep_1" class="fleft100 pd-lr20 pd-tb25 bk-fff m-top20">
                        <span class="ft-size14 fw-600 fleft100">SEUS DADOS</span>
                        <fieldset class="fleft100 col-md-12 pd-lr10">
                            <input id="affiliate_complete_name" type="text" placeholder="NOME COMPLETO" onkeyup="javascript:this.value=this.value.toUpperCase();" style="text-transform:uppercase;" required>
                        </fieldset>                        
                        <fieldset class="fleft100 col-md-12 pd-lr10">
                            <input id="affiliate_email" type="text" placeholder="E-mail">
                        </fieldset>
                        <fieldset class="col-md-4 col-sm-4 col-xs-4 pd-lr10">
                            <input id="affiliate_phone_ddd" type="text" placeholder="DDD">
                        </fieldset>
                        <fieldset class="col-md-8 col-sm-8 col-xs-8 pd-lr10">
                            <input id="affiliate_phone_number" type="text" placeholder="Telefone">
                        </fieldset>
                        <fieldset class="fleft100 col-md-12 pd-lr10">
                            <input id="affiliate_pass" type="password" placeholder="Senha">
                        </fieldset>
                        <fieldset class="fleft100 col-md-12 pd-lr10">
                            <input id="affiliate_pass_confirmation" type="password" placeholder="Confirme sua senha">
                        </fieldset>
                    </div>
                    <div class="fleft100 m-top10 text-right center-xs">
                        <button id="btn_sigin_affiliate_steep1" class="bt-green">Próximo</button>
                    </div>
                </div>

                <div class="cad2 d-none fleft100">
                    <div id="container_form_steep_2" class="pd-0 col-md-7 col-sm-9 col-xs-12  fnone i-block text-left">
                        <h1 class="fw-300 fleft100 m-b20">Cadastre-se grátis!</h1>
                        <!--STEEP 2.1-->
                        <div class="col-md-4 col-sm-4 col-xs-12 bk-green pd-10 cl-fff h441">
                            <span class="ft-size14 fw-600 fleft100 m-top20">SEUS DADOS</span>
                            <ul class="ds fleft100">
                                <li id="li_complete_name"></li>
                                <li id="li_email"></li>
                                <li id="li_phone"></li>
                                <li id="li_pass">*********</li>
                                <li id="li_pass">*********</li>
                            </ul>
                            <div class="fleft100 text-center m-top50"><img src="<?php echo base_url().'assets/'?>img/icones/check.png" alt=""></div>
                        </div>
                        <!--STEEP 2.2-->
                        <div class="col-md-8 col-sm-8 col-xs-12 pd-40 bk-fff h441">
                            <span class="ft-size14 fw-600 fleft100">DADOS BANCÁRIOS</span>
                            <fieldset class="col-md-8 col-sm-8 col-xs-12 pd-lr10">
                                <select id="bank" required style="max-height: 70px">
                                    <option value="default" selected="true">BANCO...</option>
                                    <option value="001">BANCO DO BRASIL</option>
                                    <option value="104">CAIXA ECONÔMICA FEDERAL </option>
                                    <option value="033">BCO SANTANDER (BRASIL) S.A. </option>
                                    <option value="184">BANCO ITAÚ BBA S.A.</option>
                                    <option value="479">BANCO ITAÚ BANK S.A</option> 
                                    <option value="036">BANCO BRADESCO BBI S.A.</option>
                                    <option value="204">BANCO BRADESCO CARTÕES S.A. </option>
                                    <option value="394">BANCO BRADESCO FINANCIAMENTOS S.A</option>
                                    <option value="122">BANCO BRADESCO BERJ S.A. </option>
                                    <option value="237">BCO BRADESCO S.A.</option> 
                                    <option value="389">BCO MERCANTIL DO BRASIL S.A. </option>
                                    <option value="745">CITIBANK S.A. </option>
                                    <option value="477">CITIBANK N.A. </option>
                                    <option value="069">BCO CREFISA S.A. </option>
                                    <option value="318">BCO BMG S.A </option>
                                    <option value="652">ITAÚ UNIBANCO HOLDING S.A. </option>
                                    <option value="341">ITAÚ UNIBANCO BM S.A.</option>
                                    <option value="070">BANCO DE BRASILIA S.A </option>
                                    <option value="735">BANCO NEON S.A. </option>
                                    <option value="077">BANCO INTERMEDIUM S/A </option>
                                    <option value="741">BCO RIBEIRAO PRETO S.A. </option>
                                    <option value="739">BANCO CETELEM S.A. </option>
                                    <option value="743">BANCO SEMEAR </option>
                                    <option value="394">BCO BRADESCO FINANC. S.A. </option>
                                    <option value="747">BCO RABOBANK INTL BRASIL S.A. </option>
                                    <option value="748">BCO COOPERATIVO SICREDI S.A. </option>
                                    <option value="399">KIRTON BANK </option>
                                    <option value="757">BCO KEB HANA DO BRASIL S.A. </option>
                                    <option value="084">UNIPRIME NORTE DO PARANÁ </option>
                                    <option value="062">HIPERCARD BM S.A. </option>
                                    <option value="074">BCO. J.SAFRA S.A. </option>
                                    <option value="099">UNIPRIME CENTRAL CCC LTDA. </option>
                                    <option value="025">BCO ALFA S.A. </option>
                                    <option value="040">BCO CARGILL S.A. </option>
                                    <option value="063">BANCO BRADESCARD </option>
                                    <option value="003">BCO DA AMAZONIA S.A. </option>
                                    <option value="097">CCC NOROESTE BRASILEIRO LTDA. </option>
                                    <option value="037">BCO DO EST. DO PA S.A. </option>
                                    <option value="085">CCC URBANO </option>
                                    <option value="114">CENTRAL CECM ESP. SANTO </option>
                                    <option value="036">BCO BBI S.A. </option>
                                    <option value="004">BCO DO NORDESTE DO BRASIL S.A. </option>
                                    <option value="320">BCO CCB BRASIL S.A. </option>
                                    <option value="079">BCO ORIGINAL DO AGRO S/A </option>
                                    <option value="133">CONFEDERACAO NAC DAS CCC SOL </option>
                                    <option value="121">BCO AGIPLAN S.A.– cód. </option>
                                    <option value="083">BCO DA CHINA BRASIL S.A. </option>
                                    <option value="094">BANCO FINAXIS </option>
                                    <option value="047">BCO DO EST. DE SE S.A. cód. </option>
                                    <option value="254">PARANA BCO S.A. </option>
                                    <option value="107">BCO BBM S.A. </option>
                                    <option value="412">BCO CAPITAL S.A. </option>
                                    <option value="124">BCO WOORI BANK DO BRASIL S.A. </option>
                                    <option value="634">BCO TRIANGULO S.A. </option>
                                    <option value="132">ICBC DO BRASIL BM S.A. </option>
                                    <option value="163">COMMERZBANK BRASIL S.A. BCO </option>MÚLTIPLO 
                                    <option value="021">BCO BANESTES S.A. </option>
                                    <option value="246">BCO ABC BRASIL S.A. </option>
                                    <option value="751">SCOTIABANK BRASIL </option>
                                    <option value="746">BCO MODAL S.A. </option>
                                    <option value="241">BCO CLASSICO S.A. </option>
                                    <option value="612">BCO GUANABARA S.A. </option>
                                    <option value="604">BCO INDUSTRIAL DO BRASIL S.A.</option>
                                    <option value="505">BCO CREDIT SUISSE (BRL) S.A. </option>
                                    <option value="300">BCO LA NACION ARGENTINA </option>
                                    <option value="266">BCO CEDULA S.A. </option>
                                    <option value="376">BCO J.P. MORGAN S.A.</option>
                                    <option value="263">BCO CACIQUE S.A. </option>
                                    <option value="473">BCO CAIXA GERAL BRASIL S.A. </option>
                                    <option value="120">BCO RODOBENS S.A. </option>
                                    <option value="248">BCO BOAVISTA INTERATLANTICO S.A. </option>
                                    <option value="265">BCO FATOR S.A. </option>
                                    <option value="719">BANIF BRASIL BM S.A.</option>
                                    <option value="243">BCO MÁXIMA S.A. </option>
                                    <option value="125">BRASIL PLURAL S.A. BCO.</option>
                                    <option value="065">BANCO ANDBANK (BRASIL) S.A.</option>
                                    <option value="250">BCV – Banco de Crédito e Varejo</option>
                                    <option value="494">BCO REP ORIENTAL URUGUAY BCE </option>
                                    <option value="018">BCO TRICURY S.A. </option>
                                    <option value="422">BCO SAFRA S.A. </option>
                                    <option value="224">BCO FIBRA S.A. </option>
                                    <option value="600">BCO LUSO BRASILEIRO S.A. </option>
                                    <option value="623">BANCO PAN </option>
                                    <option value="655">BCO VOTORANTIM S.A.</option>
                                    <option value="464">BCO SUMITOMO MITSUI BRASIL S.A. </option>
                                    <option value="237">BCO BRADESCO S.A.</option>
                                    <option value="613">BCO PECUNIA S.A. </option>
                                    <option value="637">BCO SOFISA S.A. </option>
                                    <option value="653">BCO INDUSVAL S.A.</option>
                                    <option value="249">BANCO INVESTCRED UNIBANCO S.A.</option>
                                    <option value="318">BCO BMG S.A.</option>
                                    <option value="626">BCO FICSA S.A.</option>
                                    <option value="366">BCO SOCIETE GENERALE BRASIL</option>
                                    <option value="611">BCO PAULISTA S.A. </option>
                                    <option value="755">BOFA MERRILL LYNCH BM S.A. </option>
                                    <option value="089">CCR REG MOGIANA </option>
                                    <option value="643">BCO PINE S.A. </option>
                                    <option value="707">BCO DAYCOVAL S.A </option>
                                    <option value="487">DEUTSCHE BANK S.A. BCO ALEMAO </option>
                                    <option value="233">BANCO CIFRA</option>
                                    <option value="633">BCO RENDIMENTO S.A.</option>
                                    <option value="218">BANCO BONSUCESSO S.A. </option>
                                    <option value="090">CCCM SICOOB UNIMAIS</option>
                                    <option value="753">NOVO BCO CONTINENTAL S.A.</option>
                                    <option value="222">BCO CRÉDIT AGRICOLE BR S.A.</option>
                                    <option value="098">CREDIALIANÇA CCR </option>
                                    <option value="610">BCO VR S.A.</option>
                                    <option value="010">CREDICOAMO </option>
                                    <option value="217">BANCO JOHN DEERE S.A.</option>
                                    <option value="041">BCO DO ESTADO DO RS S.A.</option>
                                    <option value="654">BCO A.J. RENNER S.A.</option>
                                    <option value="212">BANCO ORIGINAL </option>
                                </select>
                            </fieldset>
                            <fieldset class="col-md-4 col-sm-4 col-xs-12 pd-lr10">
                                <input id="agency" type="text" placeholder="Agência">
                            </fieldset>	
                            <fieldset class="col-md-6 col-sm-6 col-xs-12 pd-lr10 m-top5">
                                <select id="account_type" required>
                                    <option value="default" selected="true">TIPO DE CONTA</option>
                                    <option value="CC">CORRENTE</option>
                                    <option value="PP">POUPANÇA</option>
                                </select>
                            </fieldset>	
                            <fieldset class="col-md-3 col-sm-3 col-xs-12 pd-lr10 m-top5">
                                <input id="account" type="text" placeholder="Conta">
                            </fieldset>	
                            <fieldset class="col-md-3 col-sm-3 col-xs-12 pd-lr10 m-top5">
                                <input  id="dig"  type="text" placeholder="Dig.">
                            </fieldset>	
                            <fieldset class="fleft100 col-md-12 pd-lr10">
                                <input id="titular_name" type="text" placeholder="Nome completo ou Razão Social">
                            </fieldset>	
                            <fieldset class="fleft100 col-md-12 pd-lr10">
                                <input id="titular_cpf" type="text" placeholder="CPF ou CNPJ">
                            </fieldset>
                        </div>
                        <div class="fleft100 m-top10 text-right center-xs">
                            <button id="btn_sigin_affiliate_steep2" class="bt-green">Cadastre-se</button>
                        </div>
                    </div>
                </div>
                <!--STEEP 3.1-->
                <div class="cad3 d-none fleft100">
                    <div class="pd-0 col-md-4 col-sm-9 col-xs-12 fnone i-block text-left">
                        <div class="fleft100 pd-30 bk-fff m-top20">
                            <h1 class="ft-size45 text-center cl-green m-b20">Pronto!</h1>
                            <h3>Obrigado, <li id="affiliate_first_name"></li>!</h3>
                            <h4 class="m-top20">Em até 24h seus dados serão verificados e seu acesso a conta será liberado.  <br><br>Você vai receber um e-mail da nossa equipe com instruções de como utilizar nossa plataforma.</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
<?php include_once "inc/footer.php";?>