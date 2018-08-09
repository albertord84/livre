<?php include_once "inc/header-interno.php";?>
<?php include_once "pixel_facebook.php";?>
<?php include_once "pixel_gtags.php";?>        
<?php //include_once "pixel_ecomerce_analytics.php";?>
<?php //include_once "pixel_adwords.php";?>

<section class="fleft100 m-top40 m-b100 center-xs">
	<div class="container">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <form action="<?php echo base_url().'index.php/welcome/resumo';?>" method="post">
                        <div class="trans cl-fff fleft100 pd-20">
                            <div class="col-md-3 col-sm-3 col-xs-12 m-top10-xs"></div>
                            <div class="col-md-6 col-sm-6 col-xs-12 m-top10-xs">
                                <span class="fleft100">Período de busca</span>
                                <div class="col-md-5 col-sm-5 col-xs-6 pd-0">
                                    <div class="input-group date m-top5">
                                        <input type="date" id="abstract_init_date" placeholder="mm/dd/yyyy" class="form-control">
                                    </div>
                                </div>                           
                                <div class="col-md-1 col-sm-1 col-xs-6 pd-0" ></div>
                                <div class="col-md-5 col-sm-5 col-xs-6 pd-0" >
                                    <div class="input-group date m-top5">
                                        <input type="date" id="abstract_end_date" placeholder="mm/dd/yyyy" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div>
                                <input name="num_page" type="text" style="visibility:hidden;display:none" value="0">
                            </div>
                            <div class="col-md-2 col-sm-2 col-xs-12 text-center m-top20 m-top20-xs">
                                <input id="btn_abstract_admin_search" type="submit" class="cl-fff bk-blue pd-8 fleft100" value="Pesquisar">
                            </div>
                        </div>
                    </form>
                </div>
		<div class="col-md-6 col-sm-6 col-xs-12">
			<h4 class="pd-lr15 m-b10"><em>Geral</em> 
                        </h4>
			<div class="col-md-6 col-sm-6 col-xs-12 pd-lr10 m-b20 gr">
				<div class="fleft100 bk-fff pd-20">
					<span class="ft-size12 fw-600 cl-black">VALOR TOTAL (CET)</span>
					<h4 class="fw-600 cl-blue">R$ 265.000,00</h4>
				</div>
			</div>
			<div class="col-md-6 col-sm-6 col-xs-12 pd-lr10 m-b20 gr">
				<div class="fleft100 bk-fff pd-20">
					<span class="ft-size12 fw-600 cl-black">VALOR EMPRESTADO</span>
					<h4 class="fw-600 cl-blue">R$ 265.000,00</h4>
				</div>
			</div>
			<div class="col-md-6 col-sm-6 col-xs-12 pd-lr10 m-b20 gr">
				<div class="fleft100 bk-fff pd-20">
					<span class="ft-size12 fw-600 cl-black">TIKET MÉDIO</span>
					<h4 class="fw-600 cl-blue">R$ 5.190,85</h4>
				</div>
			</div>
			<div class="col-md-6 col-sm-6 col-xs-12 pd-lr10 m-b20 gr">
				<div class="fleft100 bk-fff pd-20">
					<span class="ft-size12 fw-600 cl-black">NÚMERO MÉDIO DE PARCELAS</span>
					<h4 class="fw-600 cl-blue">10 X</h4>
				</div>
			</div>
<!--			<div class="col-md-6 col-sm-6 col-xs-12 pd-lr10 m-b20 gr">
				<div class="fleft100 bk-fff pd-20">
					<span class="ft-size12 fw-600 cl-black">SALDO RETIDO PELO BANCO</span>
					<h4 class="fw-600 cl-blue">R$ 65.000,00 (X%)</h4>
				</div>
			</div>
			<div class="col-md-6 col-sm-6 col-xs-12 pd-lr10 m-b20 gr">
				<div class="fleft100 bk-fff pd-20">
					<span class="ft-size12 fw-600 cl-black">RECEITA LIQUIDA</span>
					<h4 class="fw-600 cl-blue">R$ 200.000,00 (X%)</h4>
				</div>
			</div>
			<div class="col-md-6 col-sm-6 col-xs-12 pd-lr10 m-b20 gr">
				<div class="fleft100 bk-fff pd-20">
					<span class="ft-size12 fw-600 cl-black">% DE RECEITA LÍQUIDA SOBRE O CET</span>
					<h4 class="fw-600 cl-blue">R$ 65.000,00 (X%)</h4>
				</div>
			</div>
			<div class="col-md-6 col-sm-6 col-xs-12 pd-lr10 m-b20 gr">
				<div class="fleft100 bk-fff pd-20">
					<span class="ft-size12 fw-600 cl-black">% RECEITA LÍQUIDA SOBRE O VALOR EMPRESTADO</span>
					<h4 class="fw-600 cl-blue">R$ 100.000,00 (X%)</h4>
				</div>
			</div>-->
		</div>
<!--		<div class="col-md-6 col-sm-6 col-xs-12">
			<h4 class="pd-lr15 m-b10"><em>Últimos empréstimos</em> <a href="" class="pull-right cl-blue">+</a></h4>
			<ul class="zebra fleft100">
				<li>
					<div class="col-md-1 col-sm-1 col-xs-12 pd-0 m-top10 m-b10"><img src="img/icones/ck.png" alt=""></div>
					<div class="col-md-4 col-sm-4 col-xs-12 cl-black fw-500 m-top10 m-b10">Ana Torres Souza Cruz</div>
					<div class="col-md-4 col-sm-4 col-xs-12 cl-black fw-500 m-top10 m-b10">31-07-17 / 15h45</div>
					<div class="col-md-3 col-sm-3 col-xs-12 pd-0 cl-blue m-top10 m-b10">R$ 6.000,00</div>
				</li>
				<li>
					<div class="col-md-1 col-sm-1 col-xs-12 pd-0 m-top10 m-b10"><img src="img/icones/x.png" alt=""></div>
					<div class="col-md-4 col-sm-4 col-xs-12 cl-black fw-500 m-top10 m-b10">Ana Torres Souza Cruz</div>
					<div class="col-md-4 col-sm-4 col-xs-12 cl-black fw-500 m-top10 m-b10">31-07-17 / 15h45</div>
					<div class="col-md-3 col-sm-3 col-xs-12 pd-0 cl-blue m-top10 m-b10">R$ 6.000,00</div>
				</li>
				<li>
					<div class="col-md-1 col-sm-1 col-xs-12 pd-0 m-top10 m-b10"><img src="img/icones/t.png" alt=""></div>
					<div class="col-md-4 col-sm-4 col-xs-12 cl-black fw-500 m-top10 m-b10">Ana Torres Souza Cruz</div>
					<div class="col-md-4 col-sm-4 col-xs-12 cl-black fw-500 m-top10 m-b10">31-07-17 / 15h45</div>
					<div class="col-md-3 col-sm-3 col-xs-12 pd-0 cl-blue m-top10 m-b10">R$ 6.000,00</div>
				</li>
				<li>
					<div class="col-md-1 col-sm-1 col-xs-12 pd-0 m-top10 m-b10"><img src="img/icones/ck.png" alt=""></div>
					<div class="col-md-4 col-sm-4 col-xs-12 cl-black fw-500 m-top10 m-b10">Ana Torres Souza Cruz</div>
					<div class="col-md-4 col-sm-4 col-xs-12 cl-black fw-500 m-top10 m-b10">31-07-17 / 15h45</div>
					<div class="col-md-3 col-sm-3 col-xs-12 pd-0 cl-blue m-top10 m-b10">R$ 6.000,00</div>
				</li>
				<li>
					<div class="col-md-1 col-sm-1 col-xs-12 pd-0 m-top10 m-b10"><img src="img/icones/x.png" alt=""></div>
					<div class="col-md-4 col-sm-4 col-xs-12 cl-black fw-500 m-top10 m-b10">Ana Torres Souza Cruz</div>
					<div class="col-md-4 col-sm-4 col-xs-12 cl-black fw-500 m-top10 m-b10">31-07-17 / 15h45</div>
					<div class="col-md-3 col-sm-3 col-xs-12 pd-0 cl-blue m-top10 m-b10">R$ 6.000,00</div>
				</li>
				<li>
					<div class="col-md-1 col-sm-1 col-xs-12 pd-0 m-top10 m-b10"><img src="img/icones/t.png" alt=""></div>
					<div class="col-md-4 col-sm-4 col-xs-12 cl-black fw-500 m-top10 m-b10">Ana Torres Souza Cruz</div>
					<div class="col-md-4 col-sm-4 col-xs-12 cl-black fw-500 m-top10 m-b10">31-07-17 / 15h45</div>
					<div class="col-md-3 col-sm-3 col-xs-12 pd-0 cl-blue m-top10 m-b10">R$ 6.000,00</div>
				</li>
				<li>
					<div class="col-md-1 col-sm-1 col-xs-12 pd-0 m-top10 m-b10"><img src="img/icones/ck.png" alt=""></div>
					<div class="col-md-4 col-sm-4 col-xs-12 cl-black fw-500 m-top10 m-b10">Ana Torres Souza Cruz</div>
					<div class="col-md-4 col-sm-4 col-xs-12 cl-black fw-500 m-top10 m-b10">31-07-17 / 15h45</div>
					<div class="col-md-3 col-sm-3 col-xs-12 pd-0 cl-blue m-top10 m-b10">R$ 6.000,00</div>
				</li>
				<li>
					<div class="col-md-1 col-sm-1 col-xs-12 pd-0 m-top10 m-b10"><img src="img/icones/x.png" alt=""></div>
					<div class="col-md-4 col-sm-4 col-xs-12 cl-black fw-500 m-top10 m-b10">Ana Torres Souza Cruz</div>
					<div class="col-md-4 col-sm-4 col-xs-12 cl-black fw-500 m-top10 m-b10">31-07-17 / 15h45</div>
					<div class="col-md-3 col-sm-3 col-xs-12 pd-0 cl-blue m-top10 m-b10">R$ 6.000,00</div>
				</li>
				<li>
					<div class="col-md-1 col-sm-1 col-xs-12 pd-0 m-top10 m-b10"><img src="img/icones/t.png" alt=""></div>
					<div class="col-md-4 col-sm-4 col-xs-12 cl-black fw-500 m-top10 m-b10">Ana Torres Souza Cruz</div>
					<div class="col-md-4 col-sm-4 col-xs-12 cl-black fw-500 m-top10 m-b10">31-07-17 / 15h45</div>
					<div class="col-md-3 col-sm-3 col-xs-12 pd-0 cl-blue m-top10 m-b10">R$ 6.000,00</div>
				</li>
			</ul>
		</div>-->
	</div>
</section>
</section>
</body>
<<!--[if lt IE 9]>
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


</html>
