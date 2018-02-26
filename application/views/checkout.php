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
                    <fieldset class="col-md-4 col-sm-5 col-xs-5 pd-lr10">
                        <input id="cep" class="frm"  type="text" placeholder="CEP" required>
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
                                <option value="AC">Acre</option>
                                <option value="RN">Rio Grande do Norte</option>
                                <option value="SP">São Paulo</option>
                                <option value="RJ">Rio de Janeiro</option>
                                <option value="RS">Rio Grande do Sul</option>                                
                            </select>
                        </div>
                    </fieldset>
                    <fieldset class="col-md-12 col-sm-12 col-xs-12 pd-lr10" style="margin-top:15px">
                        <p>(*) Opcional</p>
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
                    <span class="ft-size14 fw-600 fleft100"><em>DADOS DO CARTÃO</em></span>
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
                    <label for="file" class="file m-top30 bk-blue cl-fff i-block-xs">
                        <span class="col-md-2 hidden-sm hidden-xs pull-right pd-0"><img src="<?php  echo base_url().'assets/img/icones/up.jpg'?>" alt=""></span>
                        <span class="col-md-10 col-sm-10 col-xs-12 pull-left m-top2 pd-tb15 pd-lr20 fw-500">Envie a foto da parte frontal do seu cartão</span>
                        <input type="file" id="file" name="file">
                    </label>
                </div>
                <div class="fleft100 m-top10 text-right">
                    <button id="btn_steep_2" class="bt-white">Próximo</button>
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
                        <em>DADOS DO CARTÃO</em>
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
                        <!--<input id="bank" type="text" placeholder="Banco" required onkeyup="javascript:this.value=this.value.toUpperCase();" style="text-transform:uppercase;" required>-->
                        <select id="bank" required>
                            <option value="default" selected="true">BANCO...</option>
                            <option value="0023">S.A. ITAÚ</option>
                            <option value="0019">BANCO DE BRASIL</option>
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
                    <button id="btn_steep_3" class="bt-white">Próximo</button>
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
                        <em>DADOS DO CARTÃO</em>
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
                        Você fez tudo certo, agora só falta sua assinatura no contrato para que o valor contratado seja enviado para sua conta.
                        <br><br>
                        Após a assinatura, nossa equipe entrará em contato dentro de 24h para informa-lo
                    </p>
                    <div class="fleft100 text-center check">
                        <label for="check">
                            <span class="col-md-2 col-sm-2 pd-0">
                                <input type="checkbox" id="check" checked="true" style="margin-top: 0;">
                            </span> 
                            <span class="col-md-10 col-sm-10 ft-size10 text-left">
                                <u>Declaro que li e aceito os <a id="lnk_use_term">termos de uso</a></u>
                            </span>
                        </label>
                    </div>
                </div>
                <div class="fleft100 m-top20 text-right">
                    <button id="btn_steep_4" type="submit" class="bt-green mxw-250">Assinar e contratar</button>
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
                            <b class="fleft100" id="permited_value"></b>
                        </span>
                        <span class="fleft100 m-top15">
                            <small>Prazo para pagamento:</small>
                            <b class="fleft100" id="amount_months"></b>
                        </span>
                        <span class="fleft100 m-top15">
                            <small>Valor das parcelas:</small>
                            <b class="fleft100" id="limit_value"></b>
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
