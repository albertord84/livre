</section>

<footer class="fleft100 bk-grafite pd-tb40">
    <A name="lnk_support"></A>
    <div class="container">
        <div class="col-md-6 col-sm-6 col-xs-12 contato">
            <h1 class="ft-size55 pd-lr10">Dúvidas? <small class="ft-size25">Pergunte aqui!</small></h1>
            <form id="talkme_frm" action="" class="fleft100 m-top20">
                <div class="col-md-6 col-sm-6 col-xs-12 pd-lr10">
                    <fieldset>
                        <input id="field_name" type="text" required="required" placeholder="Nome" class="email">
                    </fieldset>
                </div>
                <div class="col-md-6 col-sm-6 col-xs-12 pd-lr10">
                    <fieldset>
                        <input id="field_email" type="text" required="required" placeholder="E-mail" class="email">
                    </fieldset>
                </div>
                <div class="col-md-12 col-sm-12 col-xs-12 pd-lr10 text-right">
                    <fieldset>
                        <textarea id="field_message" required="required" rows="4" placeholder="Escreva aqui" class="email"></textarea>
                    </fieldset>
                    <fieldset>                        
                        <button id="btn_send_message" class="send_message ladda-button" type="button" data-style="expand-left" data-spinner-color="#ffffff">
                            <spam class="ladda-label">Enviar</spam>
                        </button>
                    </fieldset>
                </div>
            </form>
        </div>
        <div class="col-md-6 col-sm-6 col-xs-12 pd-lr50 m-top20-xs">
            <span class="cl-fff">Acompanhe a Crédit Société</span>
            <ul class=" sociais i-block">
                <li><a target="_blank" href="https://facebook.com/creditsociety"><img src="<?php  echo base_url().'assets/img/icones/fb.png'?>" alt=""></a></li>
                <li><a target="_blank" href="https://instagram.com/creditsociety"><img src="<?php  echo base_url().'assets/img/icones/ig.png'?>" alt=""></a></li>
                <!--<li><a target="_blank" href="https://web.whatsapp.com/"><img src="<?php  echo base_url().'assets/img/icones/wpp.png'?>" alt=""></a></li>-->
            </ul>
            <div class="fleft100 m-top40 m-top20-xs m-b10"><img src="<?php  echo base_url().'assets/img/icones/logo-footer.png'?>" alt=""></div>
            <p class="flef100 cl-fff">
                <!--Av. Paula Sousa 351, Maracanã, Rio de Janeiro - RJ, CEP: 20271-120.-->
                <!--<small class="fleft100"><br>"iformações gerais. Prazo de pagamento: O período mínimo para pagamento é de 6 meses e o máximo de 12 meses. Custo Efetivo Total: O Custo Efetivo Total (CET) praticado varia de 24,08% a 42,08% ao ano, já incluindo a taxa de juros mensal de 4,99% e a taxa de adesão de 5% sobre o valor total. Exemplo: Valor do empréstimo de R$ 1.000,00 para pagar em 12 (doze) meses. Total de 12 (doze) parcelas de R$ 118,39. Detalhes referentes às taxas do empréstimo: Valor total a pagar: R$ 1.420,79. CET: 42,08% a.a.</small>-->
                <small class="fleft100" style="text-align:justify"><br>"Informações gerais. Prazo de pagamento: O período mínimo para pagamento é de 6 meses e o máximo de 12 meses. Custo Efetivo Total: O Custo Efetivo Total (CET) praticado varia de 40,63% a 88,35% ao ano, já incluindo a taxa de juros mensal de 4,99% e a taxa de abertura de cadastro de 5% sobre o valor total. Exemplo: Valor do empréstimo de R$ 1.000,00 para pagar em 12 (doze) meses. Total de 12 (doze) parcelas de R$ 156,96. Detalhes referentes às taxas do empréstimo: Valor total a pagar: R$ 1.883,50. CET: 88,35% a.a.</small>
                <small class="fleft100" style="text-align:justify"><br>"O Livre.digital é uma Fintech e atua como correspondente bancário, sob os termos da Resolução nº 3.954, de 24 de fevereiro de 2011, facilitando o processo de contratação de empréstimos, e sendo remunerado pelas instituições financeiras parceiras. <br> O Livre.digital é operado pela P B Petti Intermediação e Agenciamento de Serviços, CNPJ: 20.775.149/0001-49, Av. Paula Sousa 351, Maracanã, Rio de Janeiro - RJ, CEP: 20271-120</small>
            </p>
        </div>
    </div>


    <!--modal_container_alert_message-->
    <div class="modal fade" style="top:10%" id="modal_alert_message" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div id="modal_container_alert_message" class="modal-dialog modal-sm" role="document">                                                          
            <div class="modal-content">
                <div class="modal-header">
                    <button id="btn_modal_close" type="button" class="close" style="background-color:transparent" data-dismiss="modal" aria-label="Close">
                        <img src="<?php echo base_url() . 'assets/img/icones/FECHAR.png'; ?>" alt="Close">
                    </button>
                    <h5 class="modal-title" id="myModalLabel"><b>Mensagem</b></h5>                        
                </div>
                <div class="modal-body">                                            
                    <p id="message_text" class="text-center"></p>                        
                </div>
                <div class="modal-footer text-center">
                    <button id="accept_modal_alert_message" type="button" class="btn btn-primary active text-center">
                        <spam><div style="color:white; font-weight:bold">ACEITAR</div></spam>
                    </button>
                </div>
            </div>
        </div>                                                        
    </div>
</footer>

</body>
<!--[if lt IE 9]>
<script src="js/jquery-1.9.1.js"></script>
<![endif]-->
<!--[if gte IE 9]><!-->
<script src="<?php  echo base_url().'assets/js/jquery-3.1.1.min.js'?>"></script>
<!--<![endif]-->
<script src="<?php  echo base_url().'assets/js/bootstrap.min.js'?>"></script>
<script src="<?php  echo base_url().'assets/js/bootstrap-multiselect.js'?>"></script>
<!-- OWL SLIDER -->
<script src="<?php  echo base_url().'assets/js/carousel/owl.carousel.js'?>"></script>
<!-- GALERIA -->
<script type="text/javascript" src="<?php  echo base_url().'assets/galeria/js/fresco/fresco.js'?>"></script>
<!-- FILTRAR -->
<script src="<?php  echo base_url().'assets/js/filtrar.js'?>"></script> 
<!-- VALIDATE -->
<script src="<?php  echo base_url().'assets/js/validate.js'?>" type="text/javascript"></script>
<!-- MASCARAS -->
<script type="text/javascript" src="<?php  echo base_url().'assets/js/maskinput.js'?>"></script>
<!-- Scripts -->
<script type="text/javascript" src="<?php  echo base_url().'assets/js/script.js'?>"></script>
<script type="text/javascript" src="<?php  echo base_url().'assets/js/ladda.min.js'?>"></script>

<!--functionalities JS files-->
<script type="text/javascript" src="<?php  echo base_url().'assets/js/index.js'?>"></script>
<script type="text/javascript" src="<?php  echo base_url().'assets/js/talkme_painel.js'?>"></script>
<script type="text/javascript" src="<?php  echo base_url().'assets/js/sign_in.js'?>"></script>


</html>