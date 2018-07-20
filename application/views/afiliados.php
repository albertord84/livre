<?php include_once "inc/header-interno.php";?>
<section class="fleft100 m-top40 m-b100">
	<div class="container">
                <?php
                if($_SESSION['logged_role'] === 'ADMIN'){?>
                    <h4 class="pd-lr15 m-b10 fw-300 fleft100"><em>Afiliados</em></h4>
                    <div class="trans cl-fff fleft100 pd-20">
                            <div class="col-md-7 col-sm-7 col-xs-12 pd-0">
                                    <span class="fleft100 cl-fff pd-lr15">Digite sua busca aqui:</span>
                                    <div class="col-md-8 col-sm-8 col-xs-12">					
                                        <input type="text" class="pd-5 m-top5 fleft100 bk-fff b-none cl-black" placeholder="CPF">
                                    </div>
                                    <div class="col-md-4 col-sm-4 col-xs-12 text-center">
                                        <a href="" class="cl-fff bk-blue pd-5 fleft100 m-top5 ft-size15">Pesquisar</a>
                                    </div>
                            </div>
                            <div class="col-md-5 col-sm-5 col-xs-12 m-top10-xs">
                                <span class="fleft100">Filtro</span>
                                    <div class="col-md-7 col-sm-7 col-xs-12  pd-0">
                                            <input type="text" class="pd-5 m-top5 fleft100 bk-fff b-none cl-black">
                                    </div>
                                    <div class="col-md-5 col-sm-5 col-xs-12">
                                            <a href="" class="cl-fff bk-blue pd-8 fleft100 add">+ Adicionar filtro</a>
                                </div>
                            </div>
                    </div>                
                    <!--<div class="fleft100 voltar pd-20 bk-fff">
                            <a href="" class="cl-silver ft-size17">< Voltar</a>
                    </div>-->
                <?php }?>
		<div class="fleft100 pd-20">
			<div class="col-md-5 col-sm-5 col-xs-12 pd-0 center-xs">
				<div class="col-md-2 col-sm-2 col-xs-12 pd-0">
                                        <img src="<?php echo base_url().'assets/'?>img/icones/avatar.jpg" class="mxw-50">
				</div>
				<div class="col-md-10 col-sm-10 col-xs-12 pd-lr10 ft-size14 m-top10-xs">
                                    <h3><?php echo $_SESSION['affiliate_logged_datas']['complete_name'];?></h3>
					<div class="col-md-7 col-sm-6 col-xs-12 pd-right5 pd-lr0-xs">
						<br><?php echo $_SESSION['affiliate_logged_datas']['titular_name'];?> <br>
                                                (<?php echo $_SESSION['affiliate_logged_datas']['phone_ddd'];?>) 
                                                <?php echo $_SESSION['affiliate_logged_datas']['phone_number'];?> <br>
                                                <?php echo $_SESSION['affiliate_logged_datas']['email'];?> <br>
					</div>
					<div class="col-md-5 col-sm-6 col-xs-12 pd-left5 pd-lr0-xs m-top10-xs">
                                            <br><b><?php echo $_SESSION['affiliate_logged_datas']['bank_name'];?></b>
                                            <br>Agência: <?php echo $_SESSION['affiliate_logged_datas']['agency'];?> 
                                            <br>CC: <?php echo $_SESSION['affiliate_logged_datas']['account'];?>-<?php echo $_SESSION['affiliate_logged_datas']['dig'];?> 
                                            <br>CPF: <?php echo $_SESSION['affiliate_logged_datas']['titular_cpf'];?>
					</div>
				</div>
			</div>
			<div class="col-md-3 col-sm-3 col-xs-12 center-xs">                                
				<div class="col-md-12 col-sm-12 col-xs-12 pd-lr5 m-top10 text-center">Este mês</div>                                
                                    <div class="col-md-12 col-sm-12 col-xs-12 pd-lr5 m-top10 text-center">                              
                                    <div class="col-md-6 col-sm-6 col-xs-12 pd-lr5 m-top10">
                                        <span class="fleft100">Empréstimos</span>
                                        <span class="emp"><?php echo $_SESSION['affiliate_logged_datas']['amount_transactions'];?></span>
                                    </div>
                                    <div class="col-md-6 col-sm-6 col-xs-12 pd-lr5 m-top10">
                                        <span class="fleft100">Valor total</span>
                                            <span class="emp">R$ <?php echo $_SESSION['affiliate_logged_datas']['total_value']; ?>
                                        </span>
                                    </div>
                                    <!--<div class="col-md-2 col-sm-2 col-xs-12 pd-lr5 porc text-center">▲ <span class="fleft100">20%</span></div>-->
                                </div>  
			</div>
			<div class="col-md-4 col-sm-4 col-xs-12 text-center">
				<div class="fleft100 bk-fff pd-15 text-center fw-600 m-top25">
                                    <p>Mande esse link para seus clientes</p>
					<a href="https://livre.digital/livre/?afiliado=<?php echo $_SESSION['affiliate_logged_datas']['code'];?>">https://livre.digital/livre/?afiliado=<?php echo $_SESSION['affiliate_logged_datas']['code'];?> </a>
				</div>
				<!--<img src="<?php //echo base_url().'assets/'?>img/icones/grafico.jpg" class="mxw-280">-->
			</div>
		</div>
		<div class="fleft100 pd-20 bk-fff">
			<div class="trans cl-fff fleft100 pd-20">
                            <form action="<?php echo base_url().'index.php/welcome/transacoes';?>" method="post">
				<div class="col-md-7 col-sm-7 col-xs-12 pd-0">
					<span class="fleft100 cl-black pd-lr15">Digite sua busca aqui:</span>
					<div class="col-md-8 col-sm-8 col-xs-12">					
						<input type="text" class="pd-5 m-top5 fleft100 bk-fff cl-black">
					</div>
					<div class="col-md-4 col-sm-4 col-xs-12 text-center">
						<a href="" class="cl-fff bk-blue pd-5 fleft100 m-top5 ft-size16">Pesquisar</a>
					</div>
				</div>				
                                <!--<div class="col-md-5 col-sm-5 col-xs-12 m-top10-xs">
					<span class="fleft100 cl-black">Filtro</span>
					<div class="col-md-7 col-sm-7 col-xs-12  pd-0">
						<input type="text" class="pd-5 m-top5 fleft100 bk-fff cl-black">
					</div>
					<div class="col-md-5 col-sm-5 col-xs-12">
						<a href="" class="cl-fff bk-blue pd-8 fleft100 add">+ Adicionar filtro</a>
					</div>
				</div>-->
                                
                            </form>
			</div>
			<ul class="zebra fleft100 ft-size12 cl-black">
                            <?php foreach($_SESSION['affiliate_logged_transactions'] as $transaction) { ?>
				<li>
                                    <div class="w5 m-top15 m-top10-xs">
                                        <img src="<?php echo base_url().'assets/'?>img/icones/ck.png" alt="">
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
                                        <small class="fleft100">Dados do cartão</small>
                                        <?php 
                                            echo $transaction['credit_card_name'].'<br>';                                            
                                            echo 'Final - '.$transaction['credit_card_final']; 
                                        ?>                                              
                                    </div>
                                    <div class="w20 fw-500 text-left center-xs m-top10-xs">
                                        <small class="fleft100">Dados bancários</small>
                                        <?php 
                                            echo $transaction['bank_name'].'<br>';
                                            echo 'AG. '.$transaction['agency'].' - CC. '.$transaction['account'];
                                        ?>
                                    </div>
				</li>
                            <?php }?>
			</ul>
			<ul class="pg text-right m-top20 fleft100">
                            <li><a id="prev_page" href=""><<</a></li>				
                            <li><a id="actual_page" href="">1</a></li>
                            <li><a id="next_page" href="">>></a></li>
			</ul>
		</div>
	</div>
</section>
<?php include_once "inc/footer-interno.php";?>