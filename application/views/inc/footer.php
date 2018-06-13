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
                <span class="cl-fff fleft100 m-top40 m-b10 fw-300">Acompanhe a Crédit Société</span>
                <ul class="sociais i-block">
                    <li><a target="_blank" href="https://m.facebook.com/Livre.dig/?tsid=0.714847921740313&source=result&__nodl&_rdr"><img src="<?php echo base_url().'assets/'?>img/icones/fb-f.png" alt=""></a></li>
                    <li><a target="_blank" href="https://www.instagram.com/livre.digital/"><img src="<?php echo base_url().'assets/'?>img/icones/ig-f.png" alt=""></a></li>
                    <!--<li><a target="_blank" href=""><img src="<?php //echo base_url().'assets/'?>img/icones/wpp.png" alt=""></a></li>-->
                </ul>
                <p class="flef100 cl-fff text-justify m-top80">
                    Av. Paula Sousa 351, Maracanã, Rio de Janeiro - RJ, CEP: 20271-120.
                    <small class="fleft100"><br>"informações gerais. Prazo de pagamento: O período mínimo para pagamento é de 6 meses e o máximo de 12 meses. Custo Efetivo Total: O Custo Efetivo Total (CET) praticado varia de 24,08% a 42,08% ao ano, já incluindo a taxa de juros mensal de 4,99% e a taxa de adesão de 5% sobre o valor total. Exemplo: Valor do empréstimo de R$ 1.000,00 para pagar em 12 (doze) meses. Total de 12 (doze) parcelas de R$ 118,39. Detalhes referentes às taxas do empréstimo: Valor total a pagar: R$ 1.420,79. CET: 42,08% a.a.</small>
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
</body>
    <!--[if lt IE 9]>
    <script src="js/jquery-1.9.1.js"></script>
    <![endif]-->
    <!--[if gte IE 9]><!-->
    <script src="<?php echo base_url().'assets/'?>js/jquery-3.1.1.min.js"></script>
    <!--<![endif]-->
    <script src="<?php echo base_url().'assets/'?>js/bootstrap.min.js"></script>
    <script src="<?php echo base_url().'assets/'?>js/bootstrap-multiselect.js"></script>
    <!-- OWL SLIDER -->
    <script src="<?php echo base_url().'assets/'?>js/carousel/owl.carousel.js"></script>
    <!-- GALERIA -->
    <script src="<?php echo base_url().'assets/'?>galeria/js/fresco/fresco.js" type="text/javascript"></script>
    <!-- FILTRAR -->
    <script src="<?php echo base_url().'assets/'?>js/filtrar.js"></script> 
    <!-- VALIDATE -->
    <script src="<?php echo base_url().'assets/'?>js/validate.js" type="text/javascript"></script>
    <!-- MASCARAS -->
    <script src="<?php echo base_url().'assets/'?>js/maskinput.js" type="text/javascript"></script>
    <!-- Scripts -->
    <script src="<?php echo base_url().'assets/'?>js/script.js" type="text/javascript"></script>
    <!-- Proper Scripts -->    
    <script src="<?php echo base_url().'assets/'?>js/index.js" type="text/javascript"></script>
    
    <script src="<?php echo base_url().'assets/js/sign_in.js'?>" type="text/javascript"></script>
    <script src="<?php echo base_url().'assets/js/affiliates.js'?>" type="text/javascript"></script>
    <script src="<?php echo base_url().'assets/'?>js/talkme_painel.js" type="text/javascript"></script>
    
    
    
</html>