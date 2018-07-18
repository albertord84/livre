<?php include_once "inc/header-interno.php";?>

<!--  -->
<div class="modal fade" id="trans" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
	<div class="modal-dialog mxw-1100" role="document">
		<div class="modal-content b-none">
                    <!--  <button type="button" class="close ft-roboto fw-100" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">X</span></button> -->
			<div class="fleft100 pd-20 bk-fff ft-size13"> 				
                            <div class="w5 m-top15 m-top10-xs center-xs"><img src="<?php echo base_url().'assets/img/icones/ck.png'?>" alt=""></div>
				<div class="w25 fw-500 m-top15 m-top10-xs center-xs">
                                    <p>#<span id="trans_id"></span> <span id="trans_name"></span> <br>
					E-mail: <span id="trans_email"></span> <br>
					CPF: <span id="trans_cpf"></span> <br>
					Cel.: (<span id="trans_phone_ddd"></span>) <span id="trans_phone_number"></span> 
                                    </p>
				</div>
				<div class="w15 fw-500 m-top15 m-top10-xs center-xs"><span id="trans_date"></span></div>
				<div class="w10 cl-blue m-top15 m-top10-xs center-xs fw-500"><span id="trans_solicited_value"></span></div>
				<div class="w20 fw-500 text-left center-xs m-top10-xs">
					<small class="fleft100 cl-silver">Dados do cartão</small>
					<span id="trans_credit_card_name"></span> - Final <span id="trans_credit_card_final"></span> <br>
					<!--24/Julho - CVV 245

					<div class="fleft100">
						<small class="fleft100 cl-silver m-top20">Dados do cartão</small>
						Investimento em estudos
					</div>-->
				</div>
				<div class="w20 fw-500 text-left center-xs m-top10-xs">
					<small class="fleft100 cl-silver">Dados bancários</small>
					Itau - AG. 8888 - CC. 58866-6

					<div class="fleft100">
						<small class="fleft100 cl-silver m-top20">Endereço</small>
						Rua das flores, 399 - Pirai <br>RJ - CEP. 22222222
					</div>
				</div>
				<div class="w5 fw-500 m-top10 center-xs"><a href=""><img src="<?php echo base_url().'assets/img/icones/close.png'?>" alt=""></a></div>

				<div class="fleft100 m-top40">
					<div class="col-md-4 col-sm-4 col-xs-12">
						<div class="enviados pd-15">
							<h5 class="fleft100 m-b10"><img src="<?php echo base_url().'assets/img/icones/anx.png'?>"> Arquivos enviados</h5>
							<ul>
								<li><img src="<?php echo base_url().'assets/img/icones/env.jpg'?>"></li>
								<li><img src="<?php echo base_url().'assets/img/icones/env.jpg'?>"></li>
								<li><img src="<?php echo base_url().'assets/img/icones/env.jpg'?>"></li>
								<li><img src="<?php echo base_url().'assets/img/icones/env.jpg'?>"></li>
								<li><img src="<?php echo base_url().'assets/img/icones/env.jpg'?>"></li>
							</ul>
						</div>
						<a href="" class="cl-black fleft100 text-center m-top10"><u>Baixar arquivos</u></a>
					</div>
					<div class="col-md-3 col-sm-3 col-xs-12 m-top10-xs">
						<select class="form-control multiselect multiselect-icon">          
			              <option value="0" selected="selected">Aguardando</option>          
			              <option value="1">Aprovar</option>
			              <option value="2">Pedir novas fotos</option>
			              <option value="3">Pedir nova conta</option>
			              <option value="4">Recusar/Estornar</option>
			            </select> 
					</div>
					<div class="col-md-5 col-sm-5 col-xs-12 m-top10-xs">
						<div class="fleft100 text-right center-xs"><button class="bt-green">Salvar</button></div>
					</div>
				</div>
			</div>	
		</div>
	</div>
</div><!-- / -->

<section class="fleft100 m-top40 m-b100">
	<div class="container">
		<h4 class="pd-lr15 m-b10 fw-500 fleft100"><em>Transações</em></h4>
                <form action="<?php echo base_url().'index.php/welcome/transacoes';?>" method="post">
                    <div class="trans cl-fff fleft100 pd-20">
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <span class="fleft100">Digite sua busca aqui:</span>
                            <input name="token" type="text" class="pd-5 m-top5 fleft100 bk-fff b-none cl-black">
			</div>
			<div class="col-md-4 col-sm-4 col-xs-12 m-top10-xs">
                            <span class="fleft100">Período de busca</span>
                            <div class="col-md-5 col-sm-5 col-xs-5 pd-0">
                                    <select name="start_period" class="pd-5 m-top5 fleft100 bk-fff b-none cl-black">
                                            <option value=""></option>
                                    </select>
                            </div>
                            <div class="col-md-2 col-sm-2 col-xs-2 pd-0 text-center m-top10">
                                    Até
                            </div>
                            <div class="col-md-5 col-sm-5 col-xs-5 pd-0">
                                    <select name="end_period" class="pd-5 m-top5 fleft100 bk-fff b-none cl-black">
                                        <option value=""></option>
                                    </select>
                            </div>
			</div>
                        <div>
                            <input name="num_page" type="text" style="visibility:hidden;display:none" value="0">
                        </div>
			<div class="col-md-2 col-sm-2 col-xs-12 text-center m-top10 m-top20-xs">
                            <input type="submit" class="cl-fff bk-blue pd-8 fleft100" value="Pesquisar">
			</div>
                    </div>
                </form>
		<h4 class="pd-lr15 m-b10 m-top20 fw-300 fleft100">Resultados:</h4>
		<ul class="zebra fleft100 ft-size12 cl-black">
                    <?php foreach($_SESSION['affiliate_logged_transactions'] as $transaction) { ?>
			<li>
                            <div class="w5 m-top15 m-top10-xs">
                                <img src="<?php echo base_url().'assets/img/icones/ck.png'?>" alt="">
                            </div>
                            <div class="w10 fw-500 m-top15 m-top10-xs">
                                <?php echo $transaction['id']; ?>
                            </div>
                            <div class="w15 fw-500 m-top15 m-top10-xs">
                                <?php echo $transaction['name']; ?>
                            </div>
                            <div class="w15 fw-500 m-top15 m-top10-xs">
                                <?php echo date("d-m-y / H:i", $transaction['dates'][0]['date']); ?>
                            </div>
                            <div class="w10 cl-blue m-top15 m-top10-xs fw-500">
                                <?php echo $transaction['amount_solicited']; ?>
                            </div>
                            <div class="w20 fw-500 text-left center-xs m-top10-xs">
                                <?php 
                                    echo $transaction['credit_card_name'].'<br>';
                                    echo 'Final - '. $transaction['credit_card_final']; 
                                ?>  
                            </div>
                            <div class="w20 fw-500 text-left center-xs m-top10-xs">
                                <small class="fleft100">Dados do cartão</small>
                                <?php 
                                    echo $transaction['bank_name'].'<br>';
                                    echo 'AG. '.$transaction['agency'].' - CC. '.$transaction['account'];
                                ?>
                            </div>
                            <div class="w5 fw-500 m-top10">
                                <a href="" data-toggle="modal" data-target="" data-whatever="@mdo">
                                    <img id="<?php echo $transaction['id']; ?>" class="btn_see_trnsaction" src="<?php echo base_url().'assets/img/icones/add.png'?>" alt="">
                                </a>
                            </div>
			</li>
                    <?php }?> 
		</ul>
		<ul class="pg text-right m-top20 fleft100">
			<li><a href="">1</a></li>
			<li><a href="">2</a></li>
			<li><a href="">3</a></li>
			<li><a href="">4</a></li>
			<li><a href="">5</a></li>
			<li><a href="">6</a></li>
			<li><a href="">7</a></li>
			<li><a href="">8</a></li>
			<li><a href="">9</a></li>
			<li><a href="">>></a></li>
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
