<?php include_once "inc/header-interno.php";?>
<?php // include_once "pixel_facebook.php";?>
<?php // include_once "pixel_gtags.php";?>        
<?php //include_once "pixel_ecomerce_analytics.php";?>
<?php //include_once "pixel_adwords.php";?>

<script type="text/javascript">
    var num_page = '<?php echo $num_page;?>';
    var last_page = '<?php echo $last_page;?>';
    var has_next_page = '<?php echo $has_next_page;?>';
    var reload = 0;
</script>
<!--  -->
<div class="modal" id="wait_aff" style="left: 50%; top: 20%;">
    <img src="<?php echo base_url().'assets/img/icones/GIF SITE LIVRE.gif';?>">
</div>
        
<div class="modal fade" id="trans" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
	<div class="modal-dialog mxw-1100" role="document">
		<div class="modal-content b-none">
                    <!--  <button type="button" class="close ft-roboto fw-100" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">X</span></button> -->                        
			<div class="fleft100 pd-20 bk-fff ft-size13"> 				                                
				<div style="text-align:right;"><a data-dismiss="modal" style="cursor:pointer"><img src="<?php echo base_url().'assets/img/icones/close.png'?>" alt=""></a></div>
                                <div class="w5 m-top15 m-top10-xs center-xs"><img style="width:20px; height:20px" id="icon_trans" src="<?php echo base_url().'assets/img/icones/ck.png'?>" alt=""></div>
                                <div class="w25 fw-500 m-top10-xs center-xs">
                                    <small class="fleft100 cl-silver">Dados pessoais</small>
                                    <p>
                                        #<span id="trans_id"></span>
                                        <span id="trans_name"></span> <br>
					E-mail: <span id="trans_email"></span> <br>
					CPF: <span id="trans_cpf"></span> <br>
					Cel.: (<span id="trans_phone_ddd"></span>) <span id="trans_phone_number"></span> 
                                    </p>
                                    <small class="fleft100 cl-silver">Dados da transação</small>
                                    <p>                                        
                                        PartnerId: <span id="trans_partnerId"></span><br>
                                        CCB_numb: <span id="trans_trans_ccb_number"></span><br>
                                    </p>
                                    <small class="fleft100 cl-silver">Dados da procedência</small>
                                    <p>                                        
                                        utm_source: <font color="green"><span id="trans_utm_source"></span></font><br>
                                        utm_campaign: <font color="green"><span id="trans_utm_campaign"></span></font><br>
                                        utm_content: <font color="green"><span id="trans_utm_content"></span></font><br>
                                    </p>
				</div>
                                <div class="w20 fw-500 text-left m-top10-xs center-xs">
					<small class="fleft100 cl-silver">Dados do cartão</small>
					<span id="trans_credit_card_name"></span> <br> 
                                        Final <span id="trans_credit_card_final"></span> <br>
					<div class="fleft100">
                                            <small class="fleft100 cl-silver m-top20">Uso do dinheiro:</small>
                                            <span id="way_to_spend_name"></span> <br>
					</div>
				</div>
				<div class="w20 fw-500 text-left center-xs m-top10-xs">
					<small class="fleft100 cl-silver">Dados bancários</small>
					(<span id="trans_bank_code"></span>) <span id="trans_bank_name"></span> <br>
                                        AG. <span id="trans_agency"></span> <br>
                                        CC. <span id="trans_account"></span>-<span id="trans_dig"></span>
					<div class="fleft100">
						<small class="fleft100 cl-silver m-top20">Endereço</small>
                                                <span id="trans_street_address"></span>, <span id="trans_number_address"></span> <br> 
                                                <span id="trans_city_address"></span>, <span id="trans_state_address"></span> 
                                                <br> CEP. <span id="trans_cep"></span>
					</div>
				</div>
                                <div class="w20 fw-500 text-left m-top10-xs center-xs">
                                    <small class="fleft100 cl-silver">Dados da Solicitação</small>
                                    <span id="trans_date"></span><br>                                    
                                    Valor solicitado: R$<span id="trans_solicited_value"></span><br>
                                    Prazo: <span id="trans_numb_plots"></span> meses <br>
                                    Parcelas: R$ <span id="trans_value_plots"></span><br>                                    
                                    CET: R$ <span id="trans_cet"></span><br>                                    
                                    IOF: R$ <span id="trans_iof"></span><br>
                                    Juros ao mes: <span id="trans_tax"></span>%<br>                                    
                                </div>				                                    
                                <div class="w12 fw-500 text-left m-top40 center-xs">
                                    <small class="fleft100 cl-silver"></small>                                                                        
                                    CET MENSAL: <br>
                                    <span id="trans_cet_m"></span>%<br><br>
                                    CET ANUAL: <br>
                                    <span id="trans_cet_a"></span>%                                    
                                </div>
				<div class="fleft100 m-top40">
                                    
					<div class="col-md-4 col-sm-4 col-xs-12">
                                            <div class="enviados pd-15">
                                                <h5 class="fleft100 m-b10"><img src="<?php echo base_url().'assets/img/icones/anx.png'?>"> Arquivos enviados</h5>
                                                <ul>                                                    
                                                    <li><img class="foto_usr" id = "0" src="<?php echo base_url().'assets/img/icones/env.jpg'?>"></li>
                                                    <li><img class="foto_usr" id = "1" src="<?php echo base_url().'assets/img/icones/env.jpg'?>"></li>
                                                    <li><img class="foto_usr" id = "2" src="<?php echo base_url().'assets/img/icones/env.jpg'?>"></li>
                                                    <li><img class="foto_usr" id = "3" src="<?php echo base_url().'assets/img/icones/env.jpg'?>"></li>                                                    
                                                    <li><img class="foto_usr" id = "4" src="<?php echo base_url().'assets/img/icones/env.jpg'?>"></li>                                                                                                        
                                                </ul>
                                            </div>
                                            <a href="" class="cl-black fleft100 text-center m-top10"><u>Baixar arquivos</u></a>
					</div>
					<div class="col-md-2 col-sm-2 col-xs-12">
                                            <div class="enviados pd-15 text-center">
                                                <img id="get_url_contract" style="width:63%" src="<?php echo base_url().'assets/img/icones/pdf.jpeg'?>">
                                            </div>
					</div>
					<div class="col-md-4 col-sm-4 col-xs-12 m-top10-xs">
                                            <select id="sel_admin_actions" class="form-control multiselect multiselect-icon">          
                                                <option value="0" selected="selected">Aguardando</option>          
                                                <option value="1">Aprovar</option>
                                                <option value="2">Pedir novas fotos</option>
                                                <option value="3">Pedir nova conta</option>
                                                <option value="4">Pedir assinatura</option>
                                                <option value="5">Recusar/Estornar</option>
                                            </select>
                                            
					</div>
					<div class="col-md-2 col-sm-2 col-xs-12 m-top10-xs">
						<div class="fleft100 text-right center-xs">
                                                    <button id="save_transaction_status" class="bt-green">Salvar</button>
                                                </div>
					</div>
				</div>	
                                
                                <div class="fleft100 m-top20 m-l15 m-r20">
				    <small class="fleft100 cl-silver">Histórico dos status</small>
                                    <div id="ctn_status_history" class="m-top30">                                       
                                        <div id="status_history" style="overflow: hidden;">                                            
                                        </div>                                       
                                    </div>
				</div>
                                
			</div>	
		</div>
	</div>
</div>

<div class="modal fade" id="trans_edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
	<div class="modal-dialog mxw-1100" role="document">
		<div class="modal-content b-none">
			<div class="fleft100 pd-20 bk-fff ft-size13"> 				                                
				<div style="text-align:right;"><a data-dismiss="modal" style="cursor:pointer">
                                    <img src="<?php echo base_url().'assets/img/icones/close.png'?>" alt=""></a></div>
                                <div class="w5 m-top15 m-top10-xs center-xs">
                                    <img style="width:20px; height:20px" id="edit_icon_trans" src="<?php echo base_url().'assets/img/icones/ck.png'?>" alt=""></div>
                                <div class="w25 fw-500 m-top10-xs center-xs">
                                    <small class="fleft100 cl-silver">Dados pessoais</small>
                                    <p>
                                        <input type="text" id="edit_trans_id" disabled><br>
                                        <input type="text" id="edit_trans_name"><br>
					<input type="text" id="edit_trans_email"> <br>
                                        <input type="text" id="edit_trans_cpf" disabled> <br>
                                        (<input type="text" id="edit_trans_phone_ddd" style="width:30px">) 
                                            <input type="text" id="edit_trans_phone_number" style="width:124px"> 
                                    </p>
                                    <small class="fleft100 cl-silver">Dados da transação</small>
                                    <p>                                        
                                        <input type="text" id="edit_trans_partnerId" disabled><br>
                                        <input type="text" id="edit_trans_trans_ccb_number" disabled><br>
                                    </p>
				</div>
                                <div class="w20 fw-500 text-left m-top10-xs center-xs">
					<small class="fleft100 cl-silver">Dados do cartão</small>
                                        <input type="text" id="edit_trans_credit_card_name"><br>
                                        <input type="text" id="edit_trans_credit_card_final" disabled><br><br><br>
                                        
                                        <small class="fleft100 cl-silver">Dados bancários</small>
                                        <select id="edit_trans_bank_code" required style="max-height:70px; width:150px">
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
                                        </select><br>                                        
                                        <span>AG. <input type="text" id="edit_trans_agency" style="width:125px"></span><br>
                                        <span>CC. <input type="text" id="edit_trans_account"  style="width:90px">
                                            -<input type="text" id="edit_trans_dig" style="width:30px"></span><br>
                                        <span>Tipo. 
                                            <select id="edit_trans_account_type" style="width:118px">
                                                <option value="default" selected="true">TIPO DE CONTA</option>
                                                <option value="CC">CORRENTE</option>
                                                <option value="PP">POUPANÇA</option>
                                            </select>
                                        </span>
				</div>
				<div class="w20 fw-500 text-left center-xs m-top10-xs">
                                        <small class="fleft100 cl-silver">Endereço</small>
                                        <input type="text" id="edit_trans_street_address"> <br> 
                                        <span>
                                            <input type="text" id="edit_trans_number_address" style="width:100px"> 
                                            <input type="text" id="edit_trans_complement_address" style="width:63px">                                              
                                        </span><br>
                                        <input type="text" id="edit_trans_city_address"><br>
                                        <input type="text" id="edit_trans_state_address"><br> 
                                        <span>
                                            CEP. <input type="text" id="edit_trans_cep" style="width:100px">
                                            <button type="button" id="btn_edit_trans_cep" class="btn btn-success" style="width:35px;height:30px"><span class="glyphicon glyphicon-search" aria-hidden="false"></span></button>
                                        </span>
				</div>
                                <div class="w20 fw-500 text-left m-top10-xs center-xs">
                                    <small class="fleft100 cl-silver">Dados da Solicitação</small>
                                    <span id="edit_trans_date"></span><br>                                    
                                    Valor solicitado: R$<span id="edit_trans_solicited_value"></span><br>
                                    Prazo: <span id="edit_trans_numb_plots"></span> meses <br>
                                    Parcelas: R$ <span id="edit_trans_value_plots"></span><br>                                    
                                    CET: R$ <span id="edit_trans_cet"></span><br>                                    
                                    IOF: R$ <span id="edit_trans_iof"></span><br>
                                    Juros ao mes: <span id="edit_trans_tax"></span>%<br>                                    
                                </div>				                                    
                                <div class="w12 fw-500 text-left m-top40 center-xs">
                                    <small class="fleft100 cl-silver"></small>                                                                        
                                    CET MENSAL: <br>
                                    <span id="edit_trans_cet_m"></span>%<br><br>
                                    CET ANUAL: <br>
                                    <span id="edit_trans_cet_a"></span>%                                    
                                </div>	
                                
                                <div class="col-md-12 col-sm-12 col-xs-12 m-top10-xs">
                                        <div class="fleft100 text-right center-xs">
                                            <button id="edit_save_transaction" class="bt-green">Salvar</button>
                                        </div>
                                </div>
                                
                                
                                
			</div>	
		</div>
	</div>
</div><!-- / -->

<section class="fleft100 m-top40 m-b100">
	<div class="container">
                <div class="col-md-6 col-sm-6 col-xs-12 m-top10-xs text-left">
                    <h4 class="pd-lr15 m-b10 fw-500 fleft100"><em>Transações</em></h4>                
                </div>
                <form action="<?php echo base_url().'index.php/welcome/transacoes';?>" method="post">
                    <div class="trans cl-fff fleft100 pd-20">
                        <div class="col-md-4 col-sm-4 col-xs-12">
                            <span class="fleft100">Digite sua busca aqui:</span>
                            <input id="token" name="token" type="text" class="pd-5 m-top5 fleft100 bk-fff b-none cl-black" value="<?php echo $token?>">
			</div>
			<div class="col-md-4 col-sm-4 col-xs-12 m-top10-xs">
                            <span class="fleft100">Período de cobrança no cartão</span>
                            <div class="col-md-5 col-sm-5 col-xs-6 pd-0">
                                <div class="input-group date m-top5">
                                    <input type="date" name="init_date" id="init_date" placeholder="mm/dd/yyyy" class="form-control" value="<?php echo $start_period;?>">
                                </div>
                            </div>                           
                            <div class="col-md-1 col-sm-1 col-xs-6 pd-0" ></div>
                            <div class="col-md-5 col-sm-5 col-xs-6 pd-0" >
                                <div class="input-group date m-top5">
                                    <input type="date" name="end_date" id="end_date" placeholder="mm/dd/yyyy" class="form-control" value="<?php echo $end_period;?>">
                                </div>
                            </div>
			</div>
                        <div class="col-md-2 col-sm-2 col-xs-12">                            
                            <span class="fleft100">Estado</span>
                            <div class="m-top25 m-top25-xs">
                                <select name="status" id="status" required style="max-height: 70px; background-color:#293d3d;">
                                    <option value="default" selected="0">NON BEGGINER</option>
                                    <option value="1" <?php if($status == 1) echo "selected='selected'";?> >BEGINNER</option>
                                    <option value="2" <?php if($status == 2) echo "selected='selected'";?>>WAIT_SIGNATURE</option>                                                                    
                                    <option value="4" <?php if($status == 4) echo "selected='selected'";?>>WAIT_PHOTO</option>                                
                                    <option value="5" <?php if($status == 5) echo "selected='selected'";?>>WAIT_ACCOUNT</option>                                                                    
                                    <option value="6" <?php if($status == 6) echo "selected='selected'";?>>TOPAZIO_APPROVED</option>                                                                    
                                    <option value="7" <?php if($status == 7) echo "selected='selected'";?>>TOPAZIO_IN_ANA.</option>                                                                              
                                    <option value="9" <?php if($status == 9) echo "selected='selected'";?>>REVERSE_MONEY</option>                                
                                    <option value="22" <?php if($status == 22) echo "selected='selected'";?>>PENDENT</option>                                
                                </select>                            
                            </div>
			</div>
                        <div>
                            <input name="num_page" id="num_page" type="text" style="visibility:hidden;display:none" value="<?php echo $num_page;?>">
                        </div>
			<div class="col-md-2 col-sm-2 col-xs-12 text-center m-top20 m-top20-xs">
                            <input id="btn_afiliate_search" type="submit" class="cl-fff bk-blue pd-8 fleft100" value="Pesquisar">
			</div>
                    </div>
                </form>
                <div class="col-md-4 col-sm-4 col-xs-12 m-top10-xs text-left">
                    <span>
                    <h4 class="pd-lr15 m-b10 m-top20 fw-300 fleft100">Resultados: <?php echo $total_in_query;?></h4>                      
                    </span>
                </div>
                 <div class="col-md-4 col-sm-4 col-xs-12 m-top10-xs text-center">
                     <span>
                    <h4 class="pd-lr15 m-b10 m-top20 fw-300 fleft100">Página: <?php echo $num_page;?></h4>                      
                    </span>
                </div>
                 <div class="col-md-3 col-sm-3 col-xs-12 m-top10-xs m-top10 m-b10 text-right">
                     <button id="export_leads">Leads</button>
                </div>
                 <div class="col-md-1 col-sm-1 col-xs-12 m-top10-xs m-top10 m-b10 text-right">
                     <button id="export_transactions">Exportar</button>
                </div>
		
		<ul class="zebra fleft100 ft-size12 cl-black">
			<li>
                            <div class="w5 m-top15 m-top10-xs">                                                                
                                <img style="width:20px; height:20px" title="<?php echo $transaction['hint_by_status']?>" src="<?php echo base_url().'assets/img/icones/'.$transaction['icon_by_status'];?>" alt="">
                            </div>
                            <div class="w10 fw-500 m-top15 m-top10-xs">
                                Trans - ID
                            </div>
                            <div class="w15 fw-500 m-top15 m-top10-xs">
                                CPF
                            </div>
                            <div class="w15 fw-500 m-top15 m-top10-xs">
                                Change status
                            </div>
                            <div class="w10 m-top15 m-top10-xs fw-500">
                               Value
                            </div>
                            <div class="w15 m-top15 m-top10-xs fw-500">
                                 Dados do cartão                        
                            </div>
                            <div class="w15 m-top15 m-top10-xs fw-500">
                                Account bank
                            </div>
                            
			</li>
                    <?php foreach($_SESSION['affiliate_logged_transactions'] as $transaction) { ?>
			<li>
                            <div class="w5 m-top15 m-top10-xs">                                                                
                                <img style="width:20px; height:20px" title="<?php echo $transaction['hint_by_status']?>" src="<?php echo base_url().'assets/img/icones/'.$transaction['icon_by_status'];?>" alt="">
                            </div>
                            <div class="w10 fw-500 m-top15 m-top10-xs">
                                <?php echo $transaction['tr_id']; ?>
                            </div>
                            <div class="w15 fw-500 m-top15 m-top10-xs">
                                <?php echo substr($transaction['cpf'], 0, 3).'.'.substr($transaction['cpf'], 3, 3).'.'.substr($transaction['cpf'], 6, 3).'-'.substr($transaction['cpf'], 9, 2); ?>
                            </div>
                            <div class="w15 fw-500 m-top15 m-top10-xs">
                                <?php echo date("d-m-y / H:i", $transaction['dates'][0]['date']); ?>
                            </div>
                            <div class="w10 cl-blue m-top15 m-top10-xs fw-500">
                               R$ <?php echo str_replace('.', ',', $transaction['amount_solicited']/100).' ('.$transaction['number_plots'].')'; ?>                               
                            </div>
                            <div class="w15 fw-500 text-left center-xs m-top10-xs">
                                <?php 
                                    echo $transaction['credit_card_name'].'<br>';
                                    echo 'Final - '. $transaction['credit_card_final']; 
                                ?>  
                            </div>
                            <div class="w15 fw-500 text-left center-xs m-top10-xs">
                                <!--<small class="fleft100">Dados do cartão</small>-->
                                <?php 
                                    echo $transaction['bank_name'].'<br>';
                                    echo 'AG. '.$transaction['agency'].' - CC. '.$transaction['account'];
                                ?>
                            </div>
                            <div class="w5 fw-500 m-top10">
                                <?php if($transaction['status_id']==1){ ?>
                                    <a href="" data-toggle="modal" data-target="" data-whatever="@mdo">
                                        <img id="edit<?php echo $transaction['tr_id']; ?>" class="btn_delete_trnsaction" style="width:30px" src="<?php echo base_url().'assets/img/icones/icon_delete.png'?>" alt="">
                                    </a>
                                <?php } ?>
                            </div>
                            <div class="w5 fw-500 m-top10">
                                <?php if($transaction['status_id']!=7 && $transaction['status_id']!=9 && $transaction['status_id']!=6){ ?>
                                    <a href="" data-toggle="modal" data-target="" data-whatever="@mdo">
                                        <img id="edit<?php echo $transaction['tr_id']; ?>" class="btn_edit_trnsaction" style="width:30px" src="<?php echo base_url().'assets/img/icones/edit.jpg'?>" alt="">
                                    </a>
                                <?php } ?>
                            </div>
                            <div class="w5 fw-500 m-top10">
                                <a href="" data-toggle="modal" data-target="" data-whatever="@mdo">
                                    <img id="<?php echo $transaction['tr_id']; ?>" class="btn_see_trnsaction" src="<?php echo base_url().'assets/img/icones/add.png'?>" alt="">
                                </a>
                            </div>
			</li>
                    <?php }?> 
		</ul>
		<ul class="pg text-right m-top20 fleft100">
                    <ul class="pg text-right m-top20 fleft100">
                        <div class="col-md-6 col-sm-6 col-xs-12">                            
                        </div>
                        <div class="col-md-4 col-sm-4 col-xs-12">                            
                            <input id = "page_pos" type="text" size="5 px">
                            <li><a id="go_page" href="">Ir a página</a></li> máx(<?php echo $last_page;?>)
                        </div>
                        <div class="col-md-2 col-sm-2 col-xs-12 m-top5">
                            <li><a id="prev_page" href=""><<</a></li>
                            <li><a id="actual_page" href=""><?php echo $num_page;?></a></li>
                            <li><a id="next_page" href="">>></a></li>
                        </div>
                    </ul>
		</ul>
	</div>
</section>
    <!--modal_container_alert_message-->
    <div class="modal fade" style="top:10%" id="modal_alert_message" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div id="modal_container_alert_message" class="modal-dialog modal-sm" role="document">                                                          
            <div class="modal-content">
                <div class="modal-header">
                    <button id="btn_modal_close" type="button" class="close" style="background:#fff;" data-dismiss="modal" aria-label="Close">
                        <img src="<?php echo base_url() . 'assets/img/icones/índice.png'; ?>"> 
                    </button>
                    <h5 class="modal-title" id="myModalLabel"><b>Mensagem</b></h5>                        
                </div>
                <div class="modal-body">                                            
                    <p id="message_text"></p>                        
                </div>
                <div class="modal-footer text-center">
                    <button id="accept_modal_alert_message" type="button" class="btn btn-primary active text-center ladda-button" data-style="expand-left" data-spinner-color="#ffffff">
                        <spam class="ladda-label"><div style="color:white; font-weight:bold">ACEITAR</div></spam>
                    </button>
                </div>
            </div>
        </div>                                                        
    </div>
    <?php include_once "pixel_adroll.php";?>
</body>
 <!--[if lt IE 9]>
        <script src="js/jquery-1.9.1.js"></script>
        <![endif]-->
        <!--[if gte IE 9]><!-->
        <script src="<?php echo base_url().'assets/js/jquery-3.1.1.min.js?'.$SCRIPT_VERSION;?>"></script>
        <!--<![endif]-->
        <script src="<?php echo base_url().'assets/js/bootstrap.min.js?'.$SCRIPT_VERSION;?>"></script>
        <script src="<?php echo base_url().'assets/js/bootstrap-multiselect.js?'.$SCRIPT_VERSION;?>"></script>
        <!-- OWL SLIDER -->
        <script src="<?php echo base_url().'assets/js/carousel/owl.carousel.js?'.$SCRIPT_VERSION;?>"></script>
        <!-- GALERIA -->
        <script src="<?php echo base_url().'assets/galeria/js/fresco/fresco.js?'.$SCRIPT_VERSION;?>" type="text/javascript" ></script>
        <!-- FILTRAR -->
        <script src="<?php echo base_url().'assets/js/filtrar.js?'.$SCRIPT_VERSION;?>" type="text/javascript" ></script> 
        <!-- VALIDATE -->
        <script src="<?php echo base_url().'assets/js/validate.js?'.$SCRIPT_VERSION;?>" type="text/javascript"></script>
        <!-- MASCARAS -->
        <script src="<?php echo base_url().'assets/js/maskinput.js?'.$SCRIPT_VERSION;?>" type="text/javascript" ></script>
        <!-- Scripts -->
        <script src="<?php echo base_url().'assets/js/script.js?'.$SCRIPT_VERSION;?>" type="text/javascript" ></script>
        <script src="<?php echo base_url().'assets/js/affiliates.js?'.$SCRIPT_VERSION;?>" type="text/javascript"></script>
        <script src="<?php echo base_url().'assets/js/script.js?'.$SCRIPT_VERSION;?>" type="text/javascript" ></script>


</html>
