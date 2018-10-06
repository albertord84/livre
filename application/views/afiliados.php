<?php include_once "inc/header-interno.php";?>
<?php include_once "pixel_facebook.php";?>
<?php include_once "pixel_gtags.php";?>        
<?php //include_once "pixel_ecomerce_analytics.php";?>
<?php //include_once "pixel_adwords.php";?>
<script type="text/javascript">
    var num_page = '<?php echo $num_page;?>';
    var has_next_page = '<?php echo $has_next_page;?>';
</script>
<section class="fleft100 m-top40 m-b100">
	<div class="container">
                <?php
                if($_SESSION['logged_role'] === 'ADMIN'){?>
                    <h4 class="pd-lr15 m-b10 fw-300 fleft100"><em>Afiliados</em></h4>                    
                <?php }?>
		<div class="fleft100 pd-20">
                    <div class="col-md-5 col-sm-5 col-xs-12 pd-0 center-xs">
                        <div class="col-md-2 col-sm-2 col-xs-12 pd-0">
                            <label for="avatar" style="cursor: pointer">
                                <input type="file" id="avatar" class="hidden">
                                <img id ="avatar_img" style="border-radius: 50px" src="<?php echo base_url().'assets/data_affiliates/affiliate_'.$_SESSION['logged_id']."/photo_profile?a=".time();?>" class="mxw-50">                                        
                            </label>    
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
                                <span class="fleft100">Créditos</span>
                                <span class="emp"><?php echo $_SESSION['affiliate_logged_datas']['amount_transactions'];?></span>
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-12 pd-lr5 m-top10">
                                <span class="fleft100">Valor total</span>
                                <span class="emp">
                                    R$ <?php echo str_replace('.', ',', $_SESSION['affiliate_logged_datas']['total_value']/100); ?>
                                </span>
                            </div>
                            <!--<div class="col-md-2 col-sm-2 col-xs-12 pd-lr5 porc text-center">▲ <span class="fleft100">20%</span></div>-->
                        </div>  
                    </div>
                    <div class="col-md-4 col-sm-4 col-xs-12 text-center">
                        <div class="fleft100 bk-fff pd-15 text-center fw-600 m-top25">
                            <p>Mande esse link para seus clientes</p>
                            <?php
                                $tlf = $_SESSION['affiliate_logged_datas']['phone_number'];
                                echo '<a href="https://livre.digital/livre/?afiliado='.$tlf.'">'.
                                    'https://livre.digital/livre/?afiliado='.$tlf.'</a>';
                            ?>
                        </div>
                    </div>
		</div>
                <div class="fleft100 ">
			<div class="trans cl-fff fleft100 pd-20">
                            <form action="<?php echo base_url().'index.php/welcome/afiliados';?>" method="post">
                                <div class=" cl-black fleft100 pd-20">
                                    <div class="col-md-4 col-sm-4 col-xs-12">
                                        <span class="fleft100">Digite sua busca aqui:</span>
                                        <input id="token" name="token" type="text" class="pd-5 m-top5 fleft100 bk-fff cl-black" value="<?php echo $token?>">
                                    </div>
                                    <div class="col-md-4 col-sm-4 col-xs-12 m-top10-xs">
                                        <span class="fleft100">Período de assinatura</span>
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
			</div>
                </div>
		<div class="fleft100 pd-20 bk-fff">		
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
                                        <?php echo $transaction['id']; ?>
                                    </div>
                                    <div class="w15 fw-500 m-top15 m-top10-xs">
                                        <?php echo $transaction['name']; ?>
                                    </div>
                                    <div class="w15 fw-500 m-top15 m-top10-xs">
                                        <?php echo date("d-m-y / H:i", $transaction['dates'][0]['date']); ?>
                                    </div>
                                    <div class="w10 cl-blue m-top15 m-top10-xs fw-500">
                                        R$ <?php echo str_replace('.', ',', $transaction['amount_solicited']/100); ?>
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
                            <li><a id="actual_page" href=""><?php echo $num_page;?></a></li>
                            <li><a id="next_page" href="">>></a></li>
			</ul>
		</div>
	</div>
</section>
<?php include_once "inc/footer-interno.php";?>