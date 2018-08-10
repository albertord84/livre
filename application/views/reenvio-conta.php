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
    
    <script type="text/javascript">
        var base_url = '<?php echo base_url();?>';
    </script>
    <?php include_once "pixel_facebook.php";?>
    <?php include_once "pixel_gtags.php";?>        
    <?php //include_once "pixel_ecomerce_analytics.php";?>
    <?php //include_once "pixel_adwords.php";?>
    
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
                <h2 class="bk-green5 text-center pd-tb15">Cadastre uma nova conta</h2>
                <div class="fleft100 pd-30 bk-fff">
                    <ul class="pap fleft100 pd-lr80 text-center">
                        <li class="pred">
                            <span class="fleft100">1. Dados enviados <br>com sucesso!</span>
                            <img src="<?php echo base_url().'assets/'?>img/icones/passo1-yellow.png" class="passo-yellow">
                            <img src="<?php echo base_url().'assets/'?>img/icones/passo1-green.png" class="passo-green">
                            <img src="<?php echo base_url().'assets/'?>img/icones/passo1-red.png" class="passo-red">
                        </li>
                        <li class="psilver">
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
                        <h4 class="cl-blue m-b15">Oi, <?php echo explode(' ',$transaction['name'])[0];?>!</h4>
                        <p>
                            Verificamos que sua conta bancária não é a mesma do títular do cartão de crédito. Para que o empréstimo seja aprovado, é obrigatório que o titular do cartão seja o mesmo titular da conta bancária.
                        </p>
                        <b>Por favor, informe uma nova conta para prosseguir com o seu empréstimo:</b>

                        <div class="col-md-8 col-sm-8 col-xs-12 col-md-offset-2">
                            <div class="cad_new_account1 bk-fff fleft100 pd-30">
                                <span class="ft-size14 fw-600 fleft100">DADOS BANCÁRIOS</span>
                                <fieldset class="col-md-8 col-sm-8 col-xs-12 pd-lr5">
                                    <select id="bank" style="max-height: 70px">
                                        <option value="default" selected="true">BANCO...</option>
                                        <option value="117">ADVANCED CC LTDA</option>
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
                                        <option value="237">BCO BRADESCO S.A.</option>
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
                                        <option value="001">BCO DO BRASIL S.A.</option>
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
                                        <option value="033">BCO SANTANDER (BRASIL) S.A.</option>
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
                                        <option value="104">CAIXA ECONOMICA FEDERAL</option>
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
                                        <option value="341">ITAÚ UNIBANCO BM S.A.</option>
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
                                    <input id="titular_name" type="text" placeholder="Nome completo do titular" onkeyup="javascript:this.value=this.value.toUpperCase();" style="text-transform:uppercase;" required>
                                </fieldset>
                                <fieldset class="col-md-8 col-sm-8 col-xs-12 pd-lr5 m-top20">
                                    <small class="cl-black fw-600">CPF DO TITULAR</small>
                                    <input id="titular_cpf" type="text" placeholder="000.000.000.00" required>
                                </fieldset>
                                <div class="fleft100 m-top30 text-right">
                                    <button id="send_new_account_datas" class="bt-green w100">Enviar</button>
                                </div>
                            </div>
                            
                            <div class="cad_new_account2 d-none bk-fff fleft100 pd-30">
                                <div class="fleft100 pd-30 bk-fff m-top20 text-justify">
                                    <h1 class="ft-size45 text-center cl-green m-b20">Pronto!</h1>
                                    <h3>Obrigado, <li id="affiliate_first_name"></li>!</h3>
                                    <h4 class="m-top20">Opa, seus dados bancários foram atualizados corretamente, agora para continuar, deve assinar novamente o contrato.</h4>
                                </div>
                                <div class="fleft100 m-top10 text-right">
                                    <button id="send_new_account_datas" class="bt-green w100">Assinar novamente</button>
                                </div>
                            </div>
                            
                            
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
    