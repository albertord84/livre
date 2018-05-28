<!DOCTYPE html>
<html lang="pt-BR">
<head>
	<meta charset="UTF-8">
	<title>Livre.com</title>
	<meta name="viewport" content="width=device-width">
	<link rel="icon" type="image/png" href="img/favicon.png">

	<!-- Font Awesome -->
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">

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
	<header class="fleft100 pd-tb30 pabsolute m-top50 m-none-xs text-center">
		<div class="container">
			<div class="col-md-10 col-sm-12 col-xs-12 fnone i-block">
				<div class="logo col-md-3 col-sm-3 col-xs-12 pd-0 center-xs m-top12 text-left"><a href=""><img src="img/icones/logo.png" alt=""></a></div>
				<div class="col-md-6 col-sm-6 col-xs-12 text-left">
					<div class="fleft100">
						<h1 class="fw-600 ft-size45 ft-Rajdhani cl-green"><i>Falta pouco!</i></h1>
						<h3 class="cl-fff ft-Rajdhani">Só precisamos de mais alguns dados:</h3>
					</div>
				</div>
				<div class="col-md-3 col-sm-3 col-xs-12 pd-0 text-right center-xs m-top20">
					<ul class="menu i-block m-top10-xs">				
						<li><a href="">Suporte</a></li>
						<li class="tv cl-fff">|</li>
					</ul>
					<ul class=" sociais i-block">
						<li><a href="" target="_blank"><img src="img/icones/ig.png"></a></li>
						<li><a href="" target="_blank"><img src="img/icones/fb.png"></a></li>
					</ul>
				</div>
			</div>
		</div>
	</header>

<!-- ASSINATURA MODAL -->
<div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
	<div class="modal-dialog mxw-450" role="document">
		<div class="modal-content b-none">
           <!--  <button type="button" class="close ft-roboto fw-100" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">X</span></button> -->
			<div class="titlemodal tmgreen"><img src="img/icones/lapis.png"> Utilize a mesma assinatura da sua identidade.</div>
			<div class="prelative fleft100 pd-20 bk-fff text-center"> 				
                <img src="img/icones/ass.jpg" class="w100">				
			</div>	
			<div class="fleft100 m-top10 text-right center-sm"><button class="bt-green">Pronto!</button></div>
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
                <img src="img/icones/erro.png">	
                <p class="m-top20 pd-lr50 text-left">
                	<b class="fleft100 m-b20 text-center">Parece que houve um erro durante o <br>processamento dos dados do seu cartão.</b> 
                	<b>Pedimos que verifique o limite do seu cartão.</b> <br><u>Lembre-se que o valor do empréstimo deve ser menor que o valor de limite do seu cartão.</u> 
					<br><br>
					Se mesmo assim não conseguir proesseguir, entre em contato com a operadora do seu cartão para maiores informações.
                </p>			
			</div>	
			<div class="fleft100 m-top10 text-right center-sm"><button class="bt-green">Pronto!</button></div>
		</div>
	</div>
</div><!-- /ERRO AO REGISTRAR -->

<!-- SMS -->
<div class="modal fade" id="sms" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
	<div class="modal-dialog mxw-350" role="document">
		<div class="modal-content b-none">
            <!-- <button type="button" class="close ft-roboto fw-100" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">X</span></button> -->		
			<div class="prelative fleft100 pd-20 bk-fff text-center"> 				
                <img src="img/icones/sms.png">	
                <p class="m-top20 pd-lr50 text-left"><b class="fleft100 m-b20 text-center">Insira o código recebido:</b></p>
                <input type="text" class="bverde ph-fff" placeholder="R$ 00,00">			
			</div>	
			<div class="fleft100 m-top10 text-right center-sm"><button href="" class="cl-fff m-r25 bk-none b-none"><u>Reenviar código</u></button><button class="bt-green">Pronto!</button></div>
		</div>
	</div>
</div><!-- /SMS -->

<section class="fleft100 pd-tb40 fmr-check" id="bcheck">
	<div class="container">	
		<hr class="fleft100 m-top150 m-b40">	
		<div class="col-md-9 col-sm-12 col-xs-12 pd-0 center-sm">
			<div class="pd-0 col-md-6 col-sm-9 col-xs-12 check1 i-block-sm ">
				<div class="fleft100 pd-lr20 pd-tb25 bk-fff h441">
					<span class="ft-size14 fw-600 fleft100">SEUS DADOS</span>
					<fieldset class="fleft100 col-md-12 pd-lr10">
						<input type="text" placeholder="Nome completo">
					</fieldset>
					<fieldset class="fleft100 col-md-12 pd-lr10">
						<input type="text" placeholder="E-mail">
					</fieldset>
					<fieldset class="col-md-3 col-sm-3 col-xs-3 pd-lr10">
						<input type="text" placeholder="DDD">
					</fieldset>
					<fieldset class="col-md-6 col-sm-6 col-xs-6 pd-lr10">
						<input type="text" placeholder="Celular">
					</fieldset>
					<fieldset class="col-md-3 col-sm-3 col-xs-3 pd-lr10 bti">
						<button class="bt-green" data-toggle="modal" data-target="#sms" data-whatever="@mdo">Verificar</button>
					</fieldset>
					<fieldset class="fleft100 col-md-12 pd-lr10">
						<input type="text" placeholder="CPF">
					</fieldset>
					<span class="ft-size14 fw-600 m-top30 fleft100">SEU ENDEREÇO</span>
					<fieldset class="col-md-4 col-sm-5 col-xs-5 pd-lr10">
						<input type="text" placeholder="CEP">
					</fieldset>
					<fieldset class="col-md-4 col-sm-4 col-xs-3 pd-lr10 bti">
						<button class="bt-green">Buscar</button>
					</fieldset>
					<!-- <fieldset class="fleft100 col-md-12 pd-lr10">
						<input type="text" placeholder="Endereço">
					</fieldset>
					<fieldset class="col-md-4 col-sm-4 col-xs-4 pd-lr10">
						<input type="text" placeholder="Nº">
					</fieldset>
					<fieldset class="col-md-8 col-sm-8 col-xs-8 pd-lr10">
						<input type="text" placeholder="Complemento">
					</fieldset>
					<fieldset class="col-md-8 col-sm-8 col-xs-8 pd-lr10">
						<input type="text" placeholder="Cidade">
					</fieldset>
					<fieldset class="col-md-4 col-sm-4 col-xs-4 pd-lr10">
						<input type="text" placeholder="Estado">
					</fieldset> -->
				</div>
				<div class="fleft100 m-top10 text-right center-sm"><button class="bt-green px1">Próximo</button></div>
			</div>
			<div class="fleft100 check2 d-none">
				<div class="col-md-4 col-sm-4 col-xs-12 bk-green pd-10 cl-fff h441">
					<span class="ft-size14 fw-600 fleft100 m-top20">SEUS DADOS</span>
					<ul class="ds fleft100">
						<li>Marcio Araujo de Souza</li>
						<li>marcio.contato@hotmail.com</li>
						<li>21 2665-5555</li>
						<li>151.888.888.66</li>
					</ul>
					<span class="ft-size14 fw-600 fleft100 m-top30">SEU ENDEREÇO</span>
					<ul class="ds fleft100">
						<li>26663-666</li>
						<li>Rua Maro Augusto</li>
						<li>1902 / APT 223</li>
						<li>Rio de Janeiro / RJ</li>
					</ul>
					<div class="fleft100 text-center m-top15"><img src="img/icones/check.png" alt=""></div>
				</div>
				<div class="col-md-8 col-sm-8 col-xs-12 pd-40 bk-fff h441">
					<span class="ft-size14 fw-600 fleft100">DADOS DO CARTÃO</span>
					<div class="cartao m-top30">
						<div class="col-md-10 col-sm-10 col-xs-12 pd-0">
							<fieldset class="fleft100 pd-lr5">
								<input type="text" placeholder="Número do cartão">
							</fieldset>
							<fieldset class="col-md-4 col-sm-4 col-xs-4 pd-lr5 text-right">
								<span class="fw-600 pull-left m-top15">Validade</span>
							</fieldset>
							<fieldset class="col-md-4 col-sm-4 col-xs-4 pd-lr5">
								<select name="" id="">
									<option value=""></option>
								</select>
							</fieldset>
							<fieldset class="col-md-4 col-sm-4 col-xs-4 pd-lr5">
								<select name="" id="">
									<option value=""></option>
								</select>
							</fieldset>
							<fieldset class="fleft100 pd-lr5">
								<input type="text" placeholder="MARCIO ARAUJO PAIVA">
							</fieldset>
						</div>
						<div class="col-md-2 col-sm-2 col-xs-12 pd-0">
							<fieldset class="fleft100 cvv">
								<input type="text" placeholder="CVV">
							</fieldset>
						</div>
					</div>
					<!-- <label for="file" class="file m-top30 bk-blue cl-fff i-block-xs">
						<span class="col-md-2 hidden-sm hidden-xs pull-right pd-0"><img src="img/icones/up.jpg" alt=""></span>
						<span class="col-md-10 col-sm-10 col-xs-12 pull-left m-top2 pd-tb15 pd-lr20 fw-500">Envie a foto da parte frontal do seu cartão</span>
						<input type="file" id="file" name="file">
					</label> -->
				</div>
				<div class="fleft100 m-top10 text-right"><button class="bt-green px2">Próximo</button></div>
			</div>
			<div class="fleft100 check3 d-none">
				<div class="col-md-3 col-sm-3 col-xs-12 bk-green pd-10 cl-fff h441">
					<span class="ft-size14 fw-600 fleft100 m-top20">SEUS DADOS</span>
					<ul class="ds fleft100">
						<li>Marcio Araujo de Souza</li>
						<li>marcio.contato@hotmail.com</li>
						<li>21 2665-5555</li>
						<li>151.888.888.66</li>
					</ul>
					<span class="ft-size14 fw-600 fleft100 m-top30">SEU ENDEREÇO</span>
					<ul class="ds fleft100">
						<li>26663-666</li>
						<li>Rua Maro Augusto</li>
						<li>1902 / APT 223</li>
						<li>Rio de Janeiro / RJ</li>
					</ul>
					<div class="fleft100 text-center check"><img src="img/icones/check.png" alt=""></div>
				</div>
				<div class="col-md-3 col-sm-3 col-xs-12 bk-green2 pd-10 cl-fff h441">
					<span class="ft-size14 fw-600 fleft100 m-top20">DADOS DO CARTÃO</span>
					<ul class="ds fleft100">
						<li>5523 5523 5523 5523</li>
						<li>24/Julho</li>
						<li>MARCIO ARAUJO PAIVA</li>
						<li>CVV 266</li>
					</ul>
					<div class="fleft100 text-center check"><img src="img/icones/check.png" alt=""></div>
				</div>
				<div class="col-md-5 col-sm-5 col-xs-12 pd-0">
					<div class="bk-fff fleft100 pd-30 h441">
						<span class="ft-size14 fw-600 fleft100">DADOS BANCÁRIOS</span>
						<fieldset class="col-md-8 col-sm-8 col-xs-12 pd-lr5">
							<input type="text" placeholder="Banco">
						</fieldset>
						<fieldset class="col-md-4 col-sm-4 col-xs-12 pd-lr5">
							<input type="text" placeholder="Agência">
						</fieldset>
						<fieldset class="col-md-5 col-sm-5 col-xs-12 pd-lr5">
							<select name="" id="">
								<option value="">Tipo de conta</option>
							</select>
						</fieldset>
						<fieldset class="col-md-4 col-sm-4 col-xs-12 pd-lr5">
							<input type="text" placeholder="Conta">
						</fieldset>
						<fieldset class="col-md-3 col-sm-3 col-xs-12 pd-lr5">
							<input type="text" placeholder="Dig.">
						</fieldset>
						<fieldset class="fleft100 col-md-12 pd-lr5">
							<input type="text" placeholder="Marcio Araujo Paiva">
						</fieldset>
						<fieldset class="cpf col-md-7 col-sm-7 col-xs-12 pd-lr5 m-top20">
							<small class="cl-black fw-600">CPF DO TITULAR</small>
							<input type="text" placeholder="000.000.000.00">
						</fieldset>
					</div>
					<div class="fleft100 m-top10 text-right"><button class="bt-green px3">Próximo</button></div>
				</div>				
			</div>
			<div class="fleft100 check4 d-none">
				<div class="col-md-3 col-sm-3 col-xs-12 bk-green pd-10 cl-fff h441">
					<span class="ft-size14 fw-600 fleft100 m-top20">SEUS DADOS</span>
					<ul class="ds fleft100">
						<li>Marcio Araujo de Souza</li>
						<li>marcio.contato@hotmail.com</li>
						<li>21 2665-5555</li>
						<li>151.888.888.66</li>
					</ul>
					<span class="ft-size14 fw-600 fleft100 m-top30">SEU ENDEREÇO</span>
					<ul class="ds fleft100">
						<li>26663-666</li>
						<li>Rua Maro Augusto</li>
						<li>1902 / APT 223</li>
						<li>Rio de Janeiro / RJ</li>
					</ul>
					<div class="fleft100 text-center check"><img src="img/icones/check.png" alt=""></div>
				</div>
				<div class="col-md-2 col-sm-2 col-xs-12 bk-green3 pd-10 cl-fff h441">
					<span class="ft-size14 fw-600 fleft100 m-top20">DADOS DO CARTÃO</span>
					<ul class="ds fleft100">
						<li>5523 5523 5523 5523</li>
						<li>24/Julho</li>
						<li>MARCIO ARAUJO PAIVA</li>
						<li>CVV 266</li>
					</ul>
					<div class="fleft100 text-center check"><img src="img/icones/check.png" alt=""></div>
				</div>
				<div class="col-md-2 col-sm-2 col-xs-12 bk-green2 pd-10 cl-fff h441">
					<span class="ft-size14 fw-600 fleft100 m-top20">SEUS BANCÁRIOS</span>
					<ul class="ds fleft100">
						<li>5523 5566 6655 2666</li>
						<li>24/ Janeiro</li>
						<li>MARCIO ARAUJO PAIVA</li>
						<li>CVV 188</li>
					</ul>
					<div class="fleft100 text-center check"><img src="img/icones/check.png" alt=""></div>
				</div>
				<div class="col-md-5 col-sm-5 col-xs-12 pd-10 bk-fff h441 text-center">
					<div class="fleft100 pd-lr5 text-left">
						<span class="ft-size14 fw-600 fleft100 m-top20">COMPROVANTES</span>
						<small class="fleft100 fw-600">Clique para fazer upload.</small>
					</div>

					<h5 class="fleft100 text-left fw-600 pd-lr5 m-top20">Cartão</h5>
					<div class="col-md-6 col-sm-6 col-xs-6 pd-lr5 m-top10">
						<label for="cartao">
							<input type="file" id="cartao" class="hidden">
							<div class="upl uplgreen c-pointer">
								<i class="far fa-check-circle"></i>
								<img src="img/icones/icartao.png" alt="">
								<small class="fleft100">Foto da parte <br>frontal do seu cartão</small>
							</div>
						</label>
					</div>
					<div class="col-md-6 col-sm-6 col-xs-6 pd-lr5 m-top10">
						<label for="selcartao">
							<input type="file" id="selcartao" class="hidden">
							<div class="upl uplsilver c-pointer">
								<i class="fas fa-arrow-up"></i>
								<img src="img/icones/iselcart.png" alt="">
								<small class="fleft100">Selfie segurando <br>seu cartão</small>
							</div>
						</label>
					</div>

					<h5 class="fleft100 text-left fw-600 pd-lr5">Identidade</h5>
					<div class="col-md-6 col-sm-6 col-xs-6 pd-lr5 m-top10">						
						<label for="id">
							<input type="file" id="id" class="hidden">
							<div class="upl uplred c-pointer">
								<i class="far fa-times-circle"></i>
								<img src="img/icones/iid.png" alt="">
								<small class="fleft100">Foto identidade aberta <br>(Frente e verso junto)</small>
							</div>
						</label>
					</div>
					<div class="col-md-6 col-sm-6 col-xs-6 pd-lr5 m-top10">
						<label for="selid">
							<input type="file" id="selid" class="hidden">
							<div class="upl uplsilver c-pointer">
								<i class="fas fa-arrow-up"></i>
								<img src="img/icones/iselid.png" alt="">
								<small class="fleft100">Selfie com identidade <br>(Lado com foto)</small>
							</div>
						</label>
					</div>
					<div class="fleft100 pd-lr5 m-top10">
						<label for="ucpf" class="dc m-top5"><input type="checkbox" id="ucpf" style="margin-top: 2px;"> <small style="text-decoration: none;"><b class="fleft100">Minha identidade não possui CPF</b> Marque para fazer upload do seu CPF</small></label>
					</div>
				</div>
				<div class="fleft100 m-top20 text-right"><button type="submit" class="bt-green mxw-250" data-toggle="modal" data-target="#modal" data-whatever="@mdo">Assinar e contratar</button></div>
				
				<!-- apenas para abrir os modais ocultos -->
				<div class="fleft100 m-top20 text-right"><button type="submit" class="bt-green mxw-250" data-toggle="modal" data-target="#erro" data-whatever="@mdo">Ver modal de erro</button></div>
			</div>			
		</div>
		<div class="col-md-3 col-sm-12 col-xs-12 pd-left25 text-center pd-none-480 m-top20-sm">
			<div class="col-md-12 col-sm-5 col-xs-8 fnone i-block rs">
				<div class="bverde4 cl-fff">
					<span class="ft-size12">RESUMO DO EMPRÉSTIMO:</span>
					<div class="fleft100 pd-tb5 pd-lr20 text-left">
						<span class="fleft100 m-top15">
							<small>Valor solicitado:</small>
							<h2 class="fw-100 cl-green">R$ <b class="fw-500">5.000,00</b></h2>
						</span>
						<span class="fleft100 m-top15">
							<small>Valor solicitado:</small>
							<h4 class="fleft100 fw-300">R$ 2.400,00</h4>
						</span>
						<span class="fleft100 m-top15">
							<small>Prazo para pagamento:</small>
							<h4 class="fleft100 fw-300">12 meses</h4>
						</span>
						<span class="fleft100 m-top15">
							<small>Taxa de juros ao mês:</small>
							<h4 class="fleft100 fw-300">R$ 2,99</h4>
						</span>
						<span class="fleft100 m-top15">
							<small>Custo Efetivo Total:</small>
							<h4 class="fleft100 fw-300">R$ 6.225,00</h4>
						</span>
						<span class="col-md-4 col-sm-4 col-xs-4 pd-0 m-top15">
							<small class="ft-size10">IOF:</small>
							<span class="fleft100 fw-300 ft-size10">R$00,00</span>
						</span>
						<span class="col-md-4 col-sm-4 col-xs-4 pd-0 m-top15">
							<small class="ft-size10">CET:</small>
							<span class="fleft100 fw-300 ft-size10">00%</span>
						</span>
						<span class="col-md-4 col-sm-4 col-xs-4 pd-0 m-top15">
							<small class="ft-size10">CET ANUAL:</small>
							<span class="fleft100 fw-300 ft-size10">00%</span>
						</span>
					</div>
				</div>
			</div>
		</div>

		<!-- <div class="i fleft100 pd-30 bk-fff fw-600 m-top40">
			<div class="col-md-1 col-sm-2 col-xs-12 text-center"><img src="img/icones/i.png" width="30"></div>
			<div class="col-md-11 col-sm-10 col-xs-12 pd-0 m-top20-xs text-left ft-size13">
				<h5 class="fw-700">IMPORTANTE:</h5> Para solicitar o empréstimo o dono do cartão de crédito e da conta bancária devem ser a mesma pessoa. Não é permitido usar o cartão de outra pessoa para solicitar o empréstimo. Em caso de titulares diferentes o empréstimo não será efetivado, sendo negado na hora.
			</div>
		</div> -->
	</div>
</section>
<?php include_once "inc/footer.php";?>