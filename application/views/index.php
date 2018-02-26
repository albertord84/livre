<?php include_once "inc/header.php" ?>

<section class="fleft100" id="banner" style="background-image: url(<?php  echo base_url().'assets/img/banners/home.jpg';?>);">
    <div class="container">
        <div class="fleft100 center-xs">
            <div class="col-md-8 col-sm-10 col-xs-12 pd-0 cl-fff m-top150 m-top130-xs">
                <div class="col-md-6 col-sm-6 col-xs-12 pd-0">
                       <h1 class="ft-size55">Dinheiro <br>na conta <br>em 24h.</h1>
                </div>
                <div class="col-md-6 col-sm-6 col-xs-12 pd-0 m-top20-xs">
                        <h3>Empréstimo Online, <br>rápido e sem burocracia.</h3>
                        <img src="<?php  echo base_url().'assets/img/icones/sverific.png'?>" class="m-top30">
                </div>
            </div>
        </div>
        <A name="checkout"></A>
        <div id="verify_container" class="verific prelative pd-tb20 pd-lr15 bk-fff m-top80 m-top20-xs center-xs">
            <div class="col-md-6 col-sm-6 col-xs-6">
                    <span>Insira aqui o limite disponível no seu <b>cartão de crédito:</b></span>
            </div>
            <div id="ctn_verify" class="col-md-6 col-sm-6 col-xs-6 text-center">                
                <input id="input_verify" type="text" class="bverde my_money" placeholder="R$ 00,00">
                <button id="btn_verify" class="bt-blue fleft100 m-top10 ">Verificar</button>                
            </div>
        </div>
        <div class="fleft100 prelative">
            <div class="result d-none pd-tb30 bk-grafite pd-lr15 pabsolute center-xs">
                <div class="col-md-7 col-sm-7 col-xs-12 cl-fff">
                    <div class="fleft100 bverde2">
                        <span class="ft-size11 col-md-7 col-sm-7 col-xs-12">Com o limite acima <br>você pode solicitar <br>este valor emprestado:</span>
                        <h3 id="permited_value" class="ft-size20 i-block col-md-5 col-sm-5 col-xs-12 pd-0"><em>R$ 5.000,00</em></h3>
                    </div>
                </div>
                <div class="col-md-5 col-sm-5 col-xs-12 cl-fff text-center m-top10-xs">
                    <small>SELECIONE COMO IRÁ USAR O DINHEIRO</small>
                    <select name="" class="fleft100 bk-fff pd-5 m-top5 cl-grafite sradius">
                        <option value=""></option>
                    </select>
                </div>
                <div class="fleft100">
                    <div class="col-md-3 col-sm-3 col-xs-12 cl-fff">
                        <div class="fleft100 parc m-top10-xs">
                            <small>PARCELAS 
                                <b><span id="result-value1">12</span>X</b>
                            </small>
                            <input value="12" min="6" step="1" max="12" type="range" id="range" class="range fleft100 bk-none">
                            <span class="fleft100 text-center ft-size17">
                                <span id="result-value2">12</span>X
                                <i><strong id="month_value"></strong></i>
                            </span>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-3 col-xs-12 cl-fff">
                        <div class="fleft100 parc m-top15">
                            <small>CUSTO TOTAL (CET)</small>
                            <span class="fleft100 ft-size20"><i><strong  id="total_cust_value">R$ 6.225,00</strong></i></span>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-12 cl-fff m-top30">
                        <!--<a href="<?php  //echo base_url().'/index.php/welcome/checkout'?>" class="bt-green fleft100">Contratar empréstimo</a>-->
                        <div id="btn_contratar_emprestimo" class="bt-green fleft100">Contratar empréstimo</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="fleft100 pd-tb60 cl-fff cover center-xs" style="background-image: url(<?php  echo base_url().'assets/img/banners/taxa.jpg'?>);">
    <div class="container">
        <div class="col-md-5 col-sm-5 col-xs-12">
            <div class="col-md-3 col-sm-3 col-xs-12">
                <img src="<?php  echo base_url().'assets/img/icones/emp.png'?>" alt="">
            </div>
            <div class="col-md-9 col-sm-9 col-xs-12">
                <h4 class="ft-size20 fw-300 m-top5">Emprestamos para negativados e sem comprovação de renda.</h4>
            </div>
        </div>
        <div class="col-md-5 col-sm-5 col-xs-12 m-top20-xs">
            <div class="col-md-3 col-sm-3 col-xs-12">
                <img src="<?php  echo base_url().'assets/img/icones/tx.png'?>" alt="">
            </div>
            <div class="col-md-9 col-sm-9 col-xs-12">
                <h4 class="ft-size20 fw-300 m-top5">Taxa de juros <br>de apenas 4,99% a.m. </h4>
            </div>
        </div>
    </div>
</section>

<section class="fleft100 pd-tb40 m-b100" id="leao" style="background-image: url(<?php  echo base_url().'assets/img/icones/leao.png'?>);">
    <div class="container">
        <div class="fleft100 text-center">
            <img src="<?php  echo base_url().'assets/img/icones/facil.png'?>" class="mxw-500">
            <h1 class="fw-300 m-top30">Solicitar um empréstimo no Crédit Société leva <br>apenas <b class="ft-size45">2 minutos</b> e a resposta é instantânea!</h1>
        </div>
        <div class="col-md-6 col-sm-6 col-xs-12 m-top80">
            <p class="ft-size17">
                A Crédit Société utiliza uma modalidade de empréstimo atrelada ao seu cartão de crédito, utilizando o limite disponível como garantia, e você recebe o dinheiro na sua conta bancária em até 1 dia útil. 
                <br><br>
                <b>Basta preencher os dados pessoais, dados do cartão de crédito e dados bancários. A verificação é feita na hora e a resposta sobre a aprovação do seu crédito é instantânea.</b>
                <br><br>
                E melhor! Sem a necessidade de enviar documentos e esperar pela aprovação do crédito.
            </p>
            <div class="i fleft100 m-top40">
                <div class="col-md-2 col-sm-2 col-xs-12 text-center m-top20 m-top10-xs"><img src="<?php  echo base_url().'assets/img/icones/i.png'?>" alt=""></div>
                <div class="col-md-10 col-sm-10 col-xs-12 m-top20-xs">
                    IMPORTANTE: Para solicitar o empréstimo o dono do cartão de crédito e da conta bancária devem ser a mesma pessoa. Não é permitido usar o cartão de outra pessoa para solicitar o empréstimo. Em caso de titulares diferentes o empréstimo não será efetivado, sendo negado na hora.
                </div>
            </div>
        </div>
        <div class="col-md-6 col-sm-6 col-xs-12 m-top50">
            <img src="<?php  echo base_url().'assets/img/banners/man.jpg'?>" class="mxw-800">
        </div>
    </div>
</section>

<?php include_once "inc/footer.php" ?>
