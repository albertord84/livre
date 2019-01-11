</section>
    <footer class="fleft100 pd-tb40">
        <A name="contact_me"></A>
        <div class="container">
            <div class="col-md-6 col-sm-6 col-xs-12 contato">
                <h1 class="ft-size55 pd-lr25 fw-300">
                    Duvidas? 
                    <small class="ft-size25 fleft100">Pergunte aqui!</small>
                </h1>
                <form action="" class="fleft100 m-top30">
                    <div class="col-md-6 col-sm-6 col-xs-12 pd-lr10">
                        <fieldset>
                            <input id="field_name" type="text" class="ph-fff" required="required" placeholder="Nome">
                        </fieldset>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-12 pd-lr10">
                        <fieldset>
                            <input id="field_email" type="text" class="ph-fff" required="required" placeholder="E-mail" class="email">
                        </fieldset>
                    </div>
                    <div class="col-md-12 col-sm-12 col-xs-12 pd-lr10 text-center">
                        <fieldset>
                            <textarea id="field_message" class="ph-fff" required="required" rows="4" placeholder="Escreva aqui"></textarea>
                        </fieldset>
                        <fieldset>
                            <input id="btn_send_message" type="button" value="Enviar" >
                        </fieldset>
                    </div>
                </form>
            </div>
            <div class="col-md-6 col-sm-6 col-xs-12 pd-lr50 m-top20-xs text-center">
                <div class="fleft100 m-top30"><img src="<?php echo base_url().'assets/'?>img/icones/logo.png" alt=""></div>
                <span class="cl-fff fleft100 m-top40 m-b10 fw-300">Acompanhe a Livre.digital</span>
                <ul class="sociais i-block">
                    <li><a target="_blank" href="https://facebook.com/Livre.dig/?tsid=0.714847921740313&source=result&__nodl&_rdr"><img src="<?php echo base_url().'assets/'?>img/icones/fb-f.png" alt=""></a></li>
                    <li><a target="_blank" href="https://www.instagram.com/livre.digital/"><img src="<?php echo base_url().'assets/'?>img/icones/ig-f.png" alt=""></a></li>
                    <!--<li><a target="_blank" href=""><img src="<?php //echo base_url().'assets/'?>img/icones/wpp.png" alt=""></a></li>-->
                </ul>
                <p class="flef100 cl-fff text-justify m-top80">
                    Alameda Santos, 1767, CXPST 1069 EDIF 1767-1773, Cerqueira Cesar, São Paulo - SP, CEP: 01419-100.
                    <small class="fleft100"><br>A Livre.digital é uma plataforma de crédito on-line, atuando como correspondente bancário do Banco Topázio, sob o CNPJ 30.472.737/0001-78. Como correspondente bancário, seguimos as diretrizes do Banco Central do Brasil, nos termos da Resolução nº. 3.954, de 24 de fevereiro de 2011.  
                        <br><br>*informações gerais. Prazo de pagamento: O período mínimo para pagamento é de 4 meses e o máximo de 12 meses. Custo Efetivo Total: O Custo Efetivo Total (CET) praticado varia de 34,54% a 66,72% ao ano, já incluindo a taxa de juros mensal que varia de 1,47% a 5,87% e a taxa de abertura de cadastro (TAC) de 20% sobre o valor tomado. Exemplo: Valor do crédito de R$ 5.000,00 para pagar em 12 (doze) meses. Total de 12 (doze) parcelas de R$ R$ 560,57. Detalhes referentes às taxas do crédito: Valor total a pagar: R$ 6726,84. CET: 34,54% na operação e 34,54% ao ano.
                        <!--<br><br> Além dos juros praticados acima, você também deve somar ao valor total da operação os juro de parcelamento praticado pelo emissor do cartão. A taxa média praticada é em torno de 2% a.m.-->
                    </small>
                </p>
            </div>
        </div>
    </footer>
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
    <!--<script src="<?php // echo base_url().'assets/js/maskmoney_jquery.maskMoney.js?'.$SCRIPT_VERSION;?>"></script>-->
    <script src="<?php echo base_url().'assets/js/jquery.maskMoney.js?'.$SCRIPT_VERSION;?>"></script>
    <!--<![endif]-->
    <script src="<?php echo base_url().'assets/js/bootstrap.min.js?'.$SCRIPT_VERSION;?>"></script>
    <script src="<?php echo base_url().'assets/js/bootstrap-multiselect.js?'.$SCRIPT_VERSION;?>"></script>
    <!-- OWL SLIDER -->
    <script src="<?php echo base_url().'assets/js/carousel/owl.carousel.js?'.$SCRIPT_VERSION;?>"></script>
    <!-- GALERIA -->
    <script src="<?php echo base_url().'assets/galeria/js/fresco/fresco.js?'.$SCRIPT_VERSION;?>" type="text/javascript"></script>
    <!-- FILTRAR -->
    <script src="<?php echo base_url().'assets/js/filtrar.js?'.$SCRIPT_VERSION;?>"></script> 
    <!-- VALIDATE -->
    <script src="<?php echo base_url().'assets/js/validate.js?'.$SCRIPT_VERSION;?>" type="text/javascript"></script>
    <!-- MASCARAS -->
    <script src="<?php echo base_url().'assets/js/maskinput.js?'.$SCRIPT_VERSION;?>" type="text/javascript"></script>
    <!-- Scripts -->
    <script src="<?php echo base_url().'assets/js/script.js?'.$SCRIPT_VERSION;?>" type="text/javascript"></script>
    <!-- Proper Scripts -->    
    <script src="<?php echo base_url().'assets/js/index.js?'.$SCRIPT_VERSION;?>" type="text/javascript"></script>
    
    <script src="<?php echo base_url().'assets/js/sign_in.js?'.$SCRIPT_VERSION;?>" type="text/javascript"></script>
    <script src="<?php echo base_url().'assets/js/affiliates.js?'.$SCRIPT_VERSION;?>" type="text/javascript"></script>
    <script src="<?php echo base_url().'assets/js/talkme_painel.js?'.$SCRIPT_VERSION;?>" type="text/javascript"></script>
    <script src="<?php echo base_url().'assets/js/new_send.js?'.$SCRIPT_VERSION;?>" type="text/javascript"></script>
    
</html>