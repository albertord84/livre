<?php include_once "inc/header-interno.php";?>

<script type="text/javascript">
    var num_page = '<?php echo $num_page;?>';
    var last_page = '<?php echo $last_page;?>';
    var has_next_page = '<?php echo $has_next_page;?>';
    var reload = 0;
</script>
<!--  -->
<div class="modal" id="wait_aff" style="left: 50%; top: 20%;">
    <img src="<?php echo base_url().'assets/img/icones/GIF SITE LIVRE.gif';?>">
</div>
       
<section class="fleft100 m-top40 m-b100">
	<div class="container">
                <div class="col-md-6 col-sm-6 col-xs-12 m-top10-xs text-left">
                    <h4 class="pd-lr15 m-b10 fw-500 fleft100"><em>Afiliados</em></h4>                
                </div>
                <form action="<?php echo base_url().'index.php/welcome/transacoes';?>" method="post">
                    <div class="trans cl-fff fleft100 pd-20">
                        <div class="col-md-4 col-sm-4 col-xs-12">
                            <span class="fleft100">Digite sua busca aqui:</span>
                            <input id="token" name="token" type="text" class="pd-5 m-top5 fleft100 bk-fff b-none cl-black" value="<?php echo $token?>">
			</div>
			<div class="col-md-4 col-sm-4 col-xs-12 m-top10-xs">
                            <span class="fleft100">Assinatura</span>
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
                            <span class="fleft100">Status</span>
                            <div class="m-top25 m-top25-xs">
                                <select name="status" id="status" required style="max-height: 70px; background-color:#293d3d;">
                                    <option value="default" selected="0">ANY STATE</option>
                                    <option value="1" <?php if($status == 1) echo "selected='selected'";?> >BEGINNER</option>                               
                                    <option value="2" <?php if($status == 2) echo "selected='selected'";?>>ACTIVE</option>                                
                                    <option value="3" <?php if($status == 3) echo "selected='selected'";?>>DELETED</option>                                
                                    <option value="4" <?php if($status == 4) echo "selected='selected'";?>>DONT_DISTURB</option>                                
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
            
            
                 <div class="col-md-4 col-sm-4 col-xs-12 m-top10-xs text-left">
                    <span>
                    <h4 class="pd-lr15 m-b10 m-top20 fw-300 fleft100">Resultados: <?php echo $total_in_query;?></h4>                      
                    </span>
                </div>
                 <div class="col-md-4 col-sm-4 col-xs-12 m-top10-xs text-center">
                     <span>
                    <h4 class="pd-lr15 m-b10 m-top20 fw-300 fleft100">Página: <?php echo $num_page;?></h4>                      
                    </span>
                </div>
                <!--                
                <div class="col-md-3 col-sm-3 col-xs-12 m-top10-xs m-top10 m-b10 text-right">
                     <button id="export_leads">Leads</button>
                </div>
                 <div class="col-md-1 col-sm-1 col-xs-12 m-top10-xs m-top10 m-b10 text-right">
                     <button id="export_transactions">Exportar</button>
                </div>
                -->
		
		<ul class="zebra fleft100 ft-size12 cl-black">
			<li class="text-left">
                            <div class="w5 text-left m-top15 m-top10-xs"> 
                                St.
                            </div>
                            <div class="w10 text-left fw-500 m-top15 m-top10-xs">
                                Afil - ID
                            </div>
                            <div class="w25 text-left fw-500 m-top15 m-top10-xs">
                                Afiliado
                            </div>                        
                            <div class="w10 text-left fw-500 m-top15 m-top10-xs">
                                Afil - CODE
                            </div>                            
                            <div class="w10 text-left m-top15 m-top10-xs fw-500">
                                INIT DATE 
                            </div>                            
                            <div class="w15 text-left m-top15 m-top10-xs fw-500">
                                Account bank 
                            </div>
			</li>
                    <?php foreach($_SESSION['affiliates'] as $afiliate) { ?>
                        <li class="text-left">
                            <div class="w5 text-left m-top15 m-top10-xs">                                                                
                                1<!--<img style="width:20px; height:20px" title="<?php echo $afiliate['hint_by_status']?>" src="<?php echo base_url().'assets/img/icones/'.$afiliate['icon_by_status'];?>" alt="">-->
                            </div>
                            <div class="w10 text-left fw-500 m-top15 m-top10-xs">
                                <?php echo $afiliate['client_id']; ?>
                            </div>
                            <div class="w25 text-left fw-500 m-top15 m-top10-xs">
                                <?php echo $afiliate['complete_name']; ?><br>
                                CPF: <?php echo substr($afiliate['titular_cpf'], 0, 3).'.'.substr($afiliate['titular_cpf'], 3, 3).'.'.substr($afiliate['titular_cpf'], 6, 3).'-'.substr($afiliate['titular_cpf'], 9, 2); ?>
                            </div>
                            <div class="w10 text-left fw-500 m-top15 m-top10-xs">
                                <?php echo $afiliate['code']; ?>
                            </div>
                            <div class="w10 text-left cl-blue m-top15 m-top10-xs fw-500">
                                <?php echo date("Y-m-d", $afiliate['init_date']); ?>
                            </div>
                            <div class="w15 text-left fw-500 text-left center-xs m-top10-xs">
                                <?php 
                                    echo $afiliate['bank_name'].'<br>';
                                    echo 'AG. '.$afiliate['agency'].' - CC. '.$afiliate['account'];
                                ?>
                            </div>
<!--                            <div class="w5 fw-500 m-top10">
                                <?php if($afiliate['status_id']!=7 && $afiliate['status_id']!=9 && $afiliate['status_id']!=6){ ?>
                                    <a href="" data-toggle="modal" data-target="" data-whatever="@mdo">
                                        <img id="edit<?php echo $afiliate['tr_id']; ?>" class="btn_edit_trnsaction" style="width:30px" src="<?php echo base_url().'assets/img/icones/edit.jpg'?>" alt="">
                                    </a>
                                <?php } ?>
                            </div>
                            <div class="w5 fw-500 m-top10">
                                <a href="" data-toggle="modal" data-target="" data-whatever="@mdo">
                                    <img id="<?php echo $afiliate['tr_id']; ?>" class="btn_see_trnsaction" src="<?php echo base_url().'assets/img/icones/add.png'?>" alt="">
                                </a>
                            </div>-->
			</li>
                    <?php }?> 
		</ul>
<!--		<ul class="pg text-right m-top20 fleft100">
                    <ul class="pg text-right m-top20 fleft100">
                        <div class="col-md-6 col-sm-6 col-xs-12">                            
                        </div>
                        <div class="col-md-4 col-sm-4 col-xs-12">                            
                            <input id = "page_pos" type="text" size="5 px">
                            <li><a id="go_page" href="">Ir a página</a></li> máx(<?php echo $last_page;?>)
                        </div>
                        <div class="col-md-2 col-sm-2 col-xs-12 m-top5">
                            <li><a id="prev_page" href=""><<</a></li>
                            <li><a id="actual_page" href=""><?php echo $num_page;?></a></li>
                            <li><a id="next_page" href="">>></a></li>
                        </div>
                    </ul>
		</ul>-->
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
    <?php include_once "pixel_adroll.php";?>
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
