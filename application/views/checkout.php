<?php include_once "inc/header.php" ?>

<section class="fleft100 pd-tb40 fmr-check" id="bcheck" style="background-image: url(<?php  echo base_url().'assets/img/banners/checkout.jpg'?>);">
    <div class="container">
        <div class="fleft100 text-center">
            <div class="i i-block fnone pd-tb15 col-md-10 m-top60 pd-20-xs m-top80-xs">
                <div class="col-md-1 col-sm-2 col-xs-12 text-center">
                    <img src="<?php  echo base_url().'assets/img/icones/i.png'?>" width="30">
                </div>
                <div class="col-md-11 col-sm-10 col-xs-12 pd-0 m-top20-xs text-left ft-size11">
                    IMPORTANTE: Para solicitar o empréstimo o dono do cartão de crédito e da conta bancária devem ser a mesma pessoa. Não é permitido usar o cartão de outra pessoa para solicitar o empréstimo. Em caso de titulares diferentes o empréstimo não será efetivado, sendo negado na hora.
                </div>
            </div>
        </div>

        <h3 class="fw-300 cl-fff m-top20 fleft100 m-b20 center-sm"><em class="ft-size30 fw-400">Falta pouco!</em> Só precisamos de mais alguns dados:</h3>
        <div class="col-md-9 col-sm-12 col-xs-12 pd-0 center-sm">
            
            <!--PASSO 1-->
            <div class="pd-0 col-md-5 col-sm-9 col-xs-12 check1 i-block-sm">
                <!--PASSO 1.1-->
                <div id="container_form_steep_1" class="fleft100 pd-lr20 pd-tb25 bk-fff">
                    <span class="ft-size14 fw-600 fleft100"><em>SEUS DADOS</em></span>
                    <fieldset class="fleft100 col-md-12 pd-lr10">
                        <input id="name" class="frm" type="text" placeholder="Nome completo" onkeyup="javascript:this.value=this.value.toUpperCase();" style="text-transform:uppercase;" required>
                    </fieldset>
                    <fieldset class="fleft100 col-md-12 pd-lr10">
                        <input id="email" class="frm"  type="text" placeholder="E-MAIL" required>
                    </fieldset>
                    <fieldset class="col-md-4 col-sm-4 col-xs-4 pd-lr10">
                        <input id="phone_ddd" class="frm"  type="text" placeholder="DDD" required>
                    </fieldset>
                    <fieldset class="col-md-8 col-sm-8 col-xs-8 pd-lr10">
                        <input id="phone_number" class="frm"  type="text" placeholder="TELEFONE" required>
                    </fieldset>
                    <fieldset class="fleft100 col-md-12 pd-lr10">
                        <input class="cpf frm" id="cpf" type="text" placeholder="CPF">
                    </fieldset>
                    
                    <span class="ft-size14 fw-600 m-top30 fleft100"><em>SEU ENDEREÇO</em></span>
                    <fieldset class="col-md-4 col-sm-5 col-xs-12 pd-lr10">
                        <input id="cep" class="frm"  type="text" placeholder="CEP" required>  
                    </fieldset>                    
                    <fieldset class="col-md-1 col-sm-2 col-xs-12 text-left">
                        <button id="verify_cep" type="button" class="btn btn-default frm" >
                            <img src="<?php  echo base_url().'assets/img/icones/search.png'?>" width="25px"/>
                        </button>                        
                    </fieldset>
                    
                    <fieldset class="fleft100 col-md-12 pd-lr10">
                        <input id="street_address" class="frm"  type="text" placeholder="ENDEREÇO" onkeyup="javascript:this.value=this.value.toUpperCase();" style="text-transform:uppercase;" required>
                    </fieldset>
                    <fieldset class="col-md-4 col-sm-4 col-xs-4 pd-lr10">
                        <input id="number_address" class="frm"  type="text" placeholder="Nº" required>
                    </fieldset>
                    <fieldset class="col-md-8 col-sm-8 col-xs-8 pd-lr10">
                        <input id="complement_number_address" class="frm"  type="text" placeholder="COMPLEMENTO (*)">
                    </fieldset>
                    <fieldset class="col-md-8 col-sm-8 col-xs-8 pd-lr10">
                        <input id="city_address" class="frm"  type="text" placeholder="CIDADE" onkeyup="javascript:this.value=this.value.toUpperCase();" style="text-transform:uppercase;" required>
                    </fieldset>
                    
                    <fieldset class="col-md-4 col-sm-4 col-xs-4 pd-lr10">
                        <!--<input type="text" placeholder="Estado">-->
                        <div class="select"  class="frm" >
                            <select id="state_address" name="local" class="btn-primeiro" id="local" required>
                                <option value="default" selected="true">ESTADO ...</option>
                                <option id="AC" value="AC">Acre</option>
                                <option id="AL" value="AL">Alagoas</option>
                                <option id="AP" value="AP">Amapá</option>
                                <option id="AM" value="AM">Amazonas</option>
                                <option id="BA" value="BA">Bahia</option>
                                <option id="CE" value="CE">Ceará</option>
                                <option id="DF" value="DF">Distrito Federal</option>
                                <option id="ES" value="ES">Espírito Santo</option>
                                <option id="GO" value="GO">Goiás</option>
                                <option id="MA" value="MA">Maranhão</option>
                                <option id="MT" value="MT">Mato Grosso</option>
                                <option id="MS" value="MS">Mato Grosso do Sul</option>
                                <option id="MG" value="MG">Minas Gerais</option>
                                <option id="PA" value="PA">Pará</option>
                                <option id="PB" value="PB">Paraíba</option>
                                <option id="PR" value="PR">Paraná</option>
                                <option id="PE" value="PE">Pernambuco</option>
                                <option id="PI" value="PI">Piauí</option>
                                <option id="RJ" value="RJ">Rio de Janeiro</option>
                                <option id="RN" value="RN">Rio Grande do Norte</option>
                                <option id="RS" value="RS">Rio Grande do Sul</option>                                
                                <option id="RO" value="RO">Rondônia</option>
                                <option id="RR" value="RR">Roraima</option>
                                <option id="SC" value="SC">Santa Catarina</option>
                                <option id="SP" value="SP">São Paulo</option>
                                <option id="SE" value="SE">Sergipe</option>
                                <option id="TO" value="TO">Tocantins</option>
                            </select>
                        </div>
                    </fieldset>
                    <fieldset class="col-md-12 col-sm-12 col-xs-12 pd-lr10" style="margin-top:15px">
                        <p>(*) Opcional</p>
                    </fieldset>        
                    <fieldset class="col-md-12 col-sm-12 col-xs-12 pd-lr10" style="margin-top:15px">
                        <label for="check">
                            <span class="col-md-1 col-sm-1 pd-0">
                                <input type="checkbox" id="check" checked="true" style="margin-top: 0;">
                            </span> 
                            <span class="col-md-11 col-sm-11 col-xs-12 ">
                                Declaro que li e aceito os <u><a id="lnk_use_term">termos de uso</a></u>
                            </span>
                        </label>
                    </fieldset>                    
                </div>
                <div class="fleft100 m-top10 text-right center-sm">
                    <button id="btn_steep_1" class="bt-white">Próximo</button>
                </div>
            </div>
            
            <!--PASSO 2-->
            <div class="fleft100 check2 d-none">
                <!--PASSO 2.1-->
                <div class="col-md-4 col-sm-4 col-xs-12 bk-green pd-20 cl-fff h441">
                    <span class="ft-size14 fw-600 fleft100 m-top20">
                        <em>SEUS DADOS</em>
                    </span>
                    <ul class="ds fleft100">
                        <li id="li_complete_name"></li>
                        <li id="li_email"></li>
                        <li id="li_phone"></li>
                        <li id="li_cpf"></li>
                    </ul>
                    <span class="ft-size14 fw-600 fleft100 m-top30"><em>SEU ENDEREÇO</em></span>
                    <ul class="ds fleft100">
                        <li id="li_cep"> </li>
                        <li id="li_street"></li>
                        <li id="li_number_address"></li>
                        <li id="li_city_state"></li>
                    </ul>
                    <div class="fleft100 text-center m-top15"><img src="<?php  echo base_url().'assets/img/icones/check.png'?>" alt=""></div>
                </div>
                <!--PASSO 2.2-->
                <div id="container_form_steep_2" class="col-md-8 col-sm-8 col-xs-12 pd-40 bk-fff h441">
                    <span class="ft-size14 fw-600 fleft100"><em>DADOS DO CARTÃO DE CRÉDITO</em></span>
                    <div class="cartao m-top30">
                        <div class="col-md-10 col-sm-10 col-xs-12 pd-0">
                            <fieldset class="fleft100 pd-lr10">
                                <input id="credit_card_number" type="text" placeholder="NÚMERO DO CARTÃO" required>
                            </fieldset>
                            <fieldset class="col-md-4 col-sm-4 col-xs-4 pd-lr10">
                                <span class="fw-600 ft-size12 pull-left m-top15">Validade</span>
                            </fieldset>
                            <fieldset class="col-md-4 col-sm-4 col-xs-4 pd-lr10">
                                <select id="credit_card_exp_month" required>
                                    <option value="01" selected="true">01</option>
                                    <option value="02">02</option><option value="03">03</option>
                                    <option value="04">04</option><option value="05">05</option>
                                    <option value="06">06</option><option value="07">07</option>
                                    <option value="08">08</option><option value="09">09</option>
                                    <option value="10">10</option><option value="11">11</option>
                                    <option value="12">12</option>
                                </select>
                            </fieldset>
                            <fieldset class="col-md-4 col-sm-4 col-xs-4 pd-lr10">
                                <select id="credit_card_exp_year" required>
                                    <option value="2018" selected="true">2018</option>
                                    <option value="2019">2019</option><option value="2020">2020</option>
                                    <option value="2021">2021</option><option value="2022">2022</option>
                                    <option value="2023">2023</option><option value="2024">2024</option>
                                    <option value="2025">2025</option><option value="2026">2026</option>
                                    <option value="2027">2027</option><option value="2028">2028</option>
                                    <option value="2029">2029</option><option value="2030">2030</option>
                                    <option value="2031">2031</option><option value="2032">2032</option>
                                </select>
                            </fieldset>
                            <fieldset class="fleft100 pd-lr10">
                                <input id="credit_card_name" type="text" placeholder="MEU NOME NO CARTÃO" onkeyup="javascript:this.value=this.value.toUpperCase();" style="text-transform:uppercase;" required>
                            </fieldset>
                        </div>
                        <div class="col-md-2 col-sm-2 col-xs-12 pd-0">
                            <fieldset class="fleft100 cvv">
                                <input id="credit_card_cvv" type="text" placeholder="CVV" required>
                            </fieldset>
                        </div>
                    </div>
                    <!--<label for="file" class="file m-top30 bk-blue cl-fff i-block-xs">
                        <span class="col-md-2 hidden-sm hidden-xs pull-right pd-0"><img src="<?php  echo base_url().'assets/img/icones/up.jpg'?>" alt=""></span>
                        <span class="col-md-10 col-sm-10 col-xs-12 pull-left m-top2 pd-tb15 pd-lr20 fw-500">Envia a foto da parte frontal do seu cartão</span>
                        <input type="file" id="file" name="file">
                    </label>-->
                </div>
                <div class="fleft100 m-top10 text-right">
                    <button id="btn_steep_2_prev" class="bt-white">Anterior</button>
                    <button id="btn_steep_2_next" class="bt-white">Próximo</button>
                </div>
            </div>
            
            <!--PASSO 3-->    
            <div class="fleft100 check3 d-none">
                <!--PASSO 3.1-->
                <div class="col-md-4 col-sm-4 col-xs-12 bk-green pd-20 cl-fff h441">
                    <span class="ft-size14 fw-600 fleft100 m-top20">
                        <em>SEUS DADOS</em>
                    </span>
                    <ul class="ds fleft100">
                        <li id="li_complete_name"></li>
                        <li id="li_email"></li>
                        <li id="li_phone"></li>
                        <li id="li_cpf"></li>
                    </ul>
                    <span class="ft-size14 fw-600 fleft100 m-top30"><em>SEU ENDEREÇO</em></span>
                    <ul class="ds fleft100">
                        <li id="li_cep"></li>
                        <li id="li_street"></li>
                        <li id="li_number_address"></li>
                        <li id="li_city_state"></li>
                    </ul>
                    <div class="fleft100 text-center check">
                        <img src="<?php  echo base_url().'assets/img/icones/check.png'?>" alt="">
                    </div>
                </div>
                <!--PASSO 3.2-->
                <div class="col-md-3 col-sm-3 col-xs-12 bk-green2 pd-20 cl-fff h441">
                    <span class="ft-size14 fw-600 fleft100 m-top20">
                        <em>DADOS DO CARTÃO DE CRÉDITO</em>
                    </span>
                    <ul class="ds fleft100">
                        <li id="li_credit_card_name"></li>
                        <li id="li_credit_card_number"></li>
                        <li id="li_credit_card_exp_month"></li>
                        <li id="li_credit_card_exp_year"></li>
                        <li id="li_credit_card_exp_cvc"></li>
                        <li id="li_credit_card_frotal_photo"></li>
                    </ul>
                    <div class="fleft100 text-center check"><img src="<?php  echo base_url().'assets/img/icones/check.png'?>" alt=""></div>
                </div>
                <!--PASSO 3.3-->
                <div id="container_form_steep_3" class="col-md-5 col-sm-5 col-xs-12 pd-40 bk-fff h441">
                    <span class="ft-size14 fw-600 fleft100"><em>DADOS BANCÁRIOS</em></span>
                    <fieldset class="col-md-8 col-sm-8 col-xs-12 pd-lr5">
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
                        <input id="account" type="text" placeholder="CONTA" required>
                    </fieldset>
                    <fieldset class="col-md-3 col-sm-3 col-xs-12 pd-lr5">
                        <input id="dig" type="text" placeholder="DIG." required>
                    </fieldset>
                    <!--<fieldset class="fleft100 col-md-12 pd-lr5">
                        <input id="titular_name" type="text" class="cl-black" placeholder="Nome completo do titular" onkeyup="javascript:this.value=this.value.toUpperCase();" style="text-transform:uppercase;" required>
                    </fieldset> -->
                    <fieldset class="cpf fleft100 pd-lr5 m-top20">
                        <small class="cl-black fw-600">NOME COMPLETO DO TITULAR</small>
                        <input id="titular_name" type="text" placeholder="Nome completo do titular" onkeyup="javascript:this.value=this.value.toUpperCase();" style="text-transform:uppercase;" required>
                    </fieldset>
                    <fieldset class="cpf fleft100 pd-lr5 m-top20">
                        <small class="cl-black fw-600">CPF DO TITULAR</small>
                        <input id="titular_cpf" type="text" required>
                    </fieldset>
                </div>
                <div class="fleft100 m-top10 text-right">
                    <button id="btn_steep_3_prev" class="bt-white">Anterior</button>
                    <button id="btn_steep_3_next" class="bt-white">Contratar</button>
                </div>
            </div>
            
            <!--PASSO 4-->
            <div class="fleft100 check4 d-none">
                <!--PASSO 4.1-->
                <div class="col-md-3 col-sm-3 col-xs-12 bk-green pd-20 cl-fff h441">
                    <span class="ft-size14 fw-600 fleft100 m-top20">
                        <em>SEUS DADOS</em>
                    </span>
                    <ul class="ds fleft100">
                        <li id="li_complete_name"></li>
                        <li id="li_email"></li>
                        <li id="li_phone"></li>
                        <li id="li_cpf"></li>
                    </ul>
                    <span class="ft-size14 fw-600 fleft100 m-top30">
                        <em>SEU ENDEREÇO</em>
                    </span>
                    <ul class="ds fleft100">
                        <li id="li_cep"></li>
                        <li id="li_street"></li>
                        <li id="li_number_address"></li>
                        <li id="li_city_state"></li>
                    </ul>
                    <div class="fleft100 text-center check">
                        <img src="<?php  echo base_url().'assets/img/icones/check.png'?>" alt="">
                    </div>
                </div>
                <!--PASSO 4.2-->
                <div class="col-md-3 col-sm-3 col-xs-12 bk-green3 pd-20 cl-fff h441">
                    <span class="ft-size14 fw-600 fleft100 m-top20">
                        <em>DADOS DO CARTÃO DE CRÉDITO</em>
                    </span>
                    <ul class="ds fleft100">
                        <li id="li_credit_card_name"></li>
                        <li id="li_credit_card_number"></li>
                        <li id="li_credit_card_exp_month"></li>
                        <li id="li_credit_card_exp_year"></li>
                        <li id="li_credit_card_exp_cvc"></li>
                        <li id="li_credit_card_frotal_photo"></li>
                    </ul>
                    <div class="fleft100 text-center check">
                        <img src="<?php  echo base_url().'assets/img/icones/check.png'?>" alt="">
                    </div>
                </div>
                <!--PASSO 4.3-->
                <div class="col-md-3 col-sm-3 col-xs-12 bk-green2 pd-20 cl-fff h441">
                    <span class="ft-size14 fw-600 fleft100 m-top20">
                        <em>DADOS BANCÁRIOS</em>
                    </span>
                    <ul class="ds fleft100">
                        <li id="li_bank_name"></li>
                        <li id="li_bank_angency"></li>
                        <li id="li_bank_account_type"></li>
                        <li id="li_bank_account"></li>
                        <li id="li_bank_dig"></li>
                        <li id="li_bank_account_name"></li>
                        <li id="li_bank_proppety_cpf"></li>
                    </ul>
                    <div class="fleft100 text-center check">
                        <img src="<?php  echo base_url().'assets/img/icones/check.png'?>" alt="">
                    </div>
                </div>
                <!--PASSO 4.4-->
                <div class="col-md-3 col-sm-3 col-xs-12 pd-tb40 pd-lr20 bk-fff h441">
                    <span class="ft-size20 fw-600 fleft100">
                        <em>PRONTO!</em>
                    </span>
                    <span class="cl-blue fw-600 ft-size16 m-top20 m-b10 fleft100">
                        Parabéns <spam id="first_name"></spam>!
                    </span>
                    <p class="ft-size13">
                        Agora, como medida de segurança, precisamos que envíe uma foto da parte frontal do seu cartão:
                        <label for="file" class="file m-top30 bk-blue cl-fff i-block-xs">
                            <span class="col-md-2 hidden-sm hidden-xs pull-right pd-0"><img src="<?php  echo base_url().'assets/img/icones/up.jpg'?>" alt=""></span>
                            <span class="col-md-10 col-sm-10 col-xs-12 pull-left m-top2 pd-tb15 pd-lr10 fw-500">Enviar a foto:</span>
                            <input type="file" id="file" name="file">
                        </label>
                    </p>
                    <p class="ft-size13">
                        Agora só falta sua assinatura no contrato. Após a assinatura, nossa equipe entrará em contato dentro de 24h para informa-lo.
                    </p>                    
                    <!--<p class="ft-size13">
                        Você fez tudo certo, agora só falta sua assinatura no contrato para que o valor contratado seja enviado para sua conta.
                        <br><br>
                        Após a assinatura, nossa equipe entrará em contato dentro de 24h para informa-lo.
                    </p>-->
                    
                </div>
                <div class="fleft100 m-top20 text-right">
                    <button id="btn_steep_4_prev" type="submit" class="bt-white">Anterior</button>
                    <button id="btn_steep_4_next" type="submit" class="bt-white">Assinar e contratar</button>
                </div>
            </div>
            
            <!--PASSO 6-->
            <div class="fleft100 check6 d-none">
                <p style="color:white;text-align:justify">OBJETIVO DO SITE 
                    O objetivo fim do site Dumbu é captar seguidores para os perfis de Instagram, clientes da 
                    ferramenta. A técnica usada pelo site consiste em seguir pessoas que seguem os perfis de referência 
                    escolhidos pelo cliente. Após determinado período o sistema do Dumbu “dessegue” essas 
                    pessoas. Cabe ao Dumbu apenas a função de seguir e “desseguir” seguidores dos perfis de referência 
                    escolhidos pelo cliente. INTEGRAÇÃO COM O INSTAGRAM A ferramenta Dumbu faz integração com o sistema do Instagram, estando sujeita a todas as
                    regras e tomadas de decisão feitas pelo Instagram, mesmo que sem aviso prévio. 
                    O Dumbu se compromete em manter suas técnicas, códigos e sistemas sempre atualizados. 
                    Por atuar dentro de sistema de terceiro (Instagram), o Dumbu não se responsabiliza por 
                    eventuais problemas causados por regras ou determinações do Instagram, mesmo que isso 
                    resulte na exclusão e/ou bloqueio do perfil de algum cliente do Dumbu. 
                    O Dumbu não se responsabiliza por exclusão e/ou bloqueio de perfis de clientes, e ao 
                    contratar a ferramenta o cliente concorda e aceita com os termos de uso e entende a não 
                    responsabilidade do Dumbu por qualquer problema oriundo de determinações do Instagram. 
                    Sendo assim o Dumbu não poderá ser acionada em juízo ou qualquer outro procedimento 
                    similar, por eventual dano gerado oriundo de decisão do Instagram. 
                </p>
            </div>
            
            
            
        </div>
        
        <div class="col-md-3 col-sm-12 col-xs-12 pd-left25 text-center pd-none-480 m-top20-sm">
            <!--PASSO 5-->
            <div class="col-md-12 col-sm-5 col-xs-8 fnone i-block rs">
                <div class="bverde3 cl-fff">
                    <span>
                        <em>RESUMO DO EMPRÉSTIMO:</em>
                    </span>
                    <div class="fleft100 pd-tb5 pd-lr20 text-left">
                        <span class="fleft100 m-top15">
                            <small>Valor solicitado:</small>
                            <b class="fleft100" id="solicited_value"></b>
                        </span>
                        <span class="fleft100 m-top15">
                            <small>Prazo para pagamento:</small>
                            <b class="fleft100" id="amount_months"></b>
                        </span>
                        <span class="fleft100 m-top15">
                            <small>Valor das parcelas:</small>
                            <b class="fleft100" id="month_value"></b>
                        </span>
                        <span class="fleft100 m-top15">
                            <small>Taxa de juros ao mês:</small>
                            <b class="fleft100">R$ 4,99</b>
                        </span>
                        <span class="fleft100 m-top15">
                            <small>Custo Efetivo Total:</small>
                            <b class="fleft100" id="total_cust_value"></b>
                        </span>
                    </div>
                </div>
            </div>
        </div>
               
        
    </div>
</section>

<section class="fleft100 pd-tb80 bk-grafite center-xs"></section>

<?php include_once "inc/footer.php"?>
