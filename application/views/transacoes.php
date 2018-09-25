<?php include_once "inc/header-interno.php";?>
<?php // include_once "pixel_facebook.php";?>
<?php // include_once "pixel_gtags.php";?>        
<?php //include_once "pixel_ecomerce_analytics.php";?>
<?php //include_once "pixel_adwords.php";?>

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
        
<div class="modal fade" id="trans" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
	<div class="modal-dialog mxw-1100" role="document">
		<div class="modal-content b-none">
                    <!--  <button type="button" class="close ft-roboto fw-100" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">X</span></button> -->                        
			<div class="fleft100 pd-20 bk-fff ft-size13"> 				                                
				<div style="text-align:right;"><a data-dismiss="modal" style="cursor:pointer"><img src="<?php echo base_url().'assets/img/icones/close.png'?>" alt=""></a></div>
                                <div class="w5 m-top15 m-top10-xs center-xs"><img style="width:20px; height:20px" id="icon_trans" src="<?php echo base_url().'assets/img/icones/ck.png'?>" alt=""></div>
                                <div class="w25 fw-500 m-top10-xs center-xs">
                                    <small class="fleft100 cl-silver">Dados pessoais</small>
                                    <p>
                                        #<span id="trans_id"></span>
                                        <span id="trans_name"></span> <br>
					E-mail: <span id="trans_email"></span> <br>
					CPF: <span id="trans_cpf"></span> <br>
					Cel.: (<span id="trans_phone_ddd"></span>) <span id="trans_phone_number"></span> 
                                    </p>
                                    <small class="fleft100 cl-silver">Dados da transação</small>
                                    <p>                                        
                                        PartnerId: <span id="trans_partnerId"></span><br>
                                        CCB_numb: <span id="trans_trans_ccb_number"></span><br>
                                    </p>
				</div>
                                <div class="w20 fw-500 text-left m-top10-xs center-xs">
					<small class="fleft100 cl-silver">Dados do cartão</small>
					<span id="trans_credit_card_name"></span> <br> 
                                        Final <span id="trans_credit_card_final"></span> <br>
					<div class="fleft100">
                                            <small class="fleft100 cl-silver m-top20">Uso do dinheiro:</small>
                                            <span id="way_to_spend_name"></span> <br>
					</div>
				</div>
				<div class="w20 fw-500 text-left center-xs m-top10-xs">
					<small class="fleft100 cl-silver">Dados bancários</small>
					(<span id="trans_bank_code"></span>) <span id="trans_bank_name"></span> <br>
                                        AG. <span id="trans_agency"></span> <br>
                                        CC. <span id="trans_account"></span>-<span id="trans_dig"></span>
					<div class="fleft100">
						<small class="fleft100 cl-silver m-top20">Endereço</small>
                                                <span id="trans_street_address"></span>, <span id="trans_number_address"></span> <br> 
                                                <span id="trans_city_address"></span>, <span id="trans_state_address"></span> 
                                                <br> CEP. <span id="trans_cep"></span>
					</div>
				</div>
                                <div class="w20 fw-500 text-left m-top10-xs center-xs">
                                    <small class="fleft100 cl-silver">Dados da Solicitação</small>
                                    <span id="trans_date"></span><br>                                    
                                    Valor solicitado: R$<span id="trans_solicited_value"></span><br>
                                    Prazo: <span id="trans_numb_plots"></span> meses <br>
                                    Parcelas: R$ <span id="trans_value_plots"></span><br>                                    
                                    CET: R$ <span id="trans_cet"></span><br>                                    
                                    IOF: R$ <span id="trans_iof"></span><br>
                                    Juros ao mes: <span id="trans_tax"></span>%<br>                                    
                                </div>				                                    
                                <div class="w12 fw-500 text-left m-top40 center-xs">
                                    <small class="fleft100 cl-silver"></small>                                                                        
                                    CET MENSAL: <br>
                                    <span id="trans_cet_m"></span>%<br><br>
                                    CET ANUAL: <br>
                                    <span id="trans_cet_a"></span>%                                    
                                </div>
				<div class="fleft100 m-top40">
                                    
					<div class="col-md-4 col-sm-4 col-xs-12">
                                            <div class="enviados pd-15">
                                                <h5 class="fleft100 m-b10"><img src="<?php echo base_url().'assets/img/icones/anx.png'?>"> Arquivos enviados</h5>
                                                <ul>                                                    
                                                    <li><img class="foto_usr" id = "0" src="<?php echo base_url().'assets/img/icones/env.jpg'?>"></li>
                                                    <li><img class="foto_usr" id = "1" src="<?php echo base_url().'assets/img/icones/env.jpg'?>"></li>
                                                    <li><img class="foto_usr" id = "2" src="<?php echo base_url().'assets/img/icones/env.jpg'?>"></li>
                                                    <li><img class="foto_usr" id = "3" src="<?php echo base_url().'assets/img/icones/env.jpg'?>"></li>                                                    
                                                    <li><img class="foto_usr" id = "4" src="<?php echo base_url().'assets/img/icones/env.jpg'?>"></li>                                                                                                        
                                                </ul>
                                            </div>
                                            <a href="" class="cl-black fleft100 text-center m-top10"><u>Baixar arquivos</u></a>
					</div>
					<div class="col-md-2 col-sm-2 col-xs-12">
                                            <div class="enviados pd-15 text-center">
                                                <img id="get_url_contract" style="width:63%" src="<?php echo base_url().'assets/img/icones/pdf.jpeg'?>">
                                            </div>
					</div>
					<div class="col-md-4 col-sm-4 col-xs-12 m-top10-xs">
                                            <select id="sel_admin_actions" class="form-control multiselect multiselect-icon">          
                                                <option value="0" selected="selected">Aguardando</option>          
                                                <option value="1">Aprovar</option>
                                                <option value="2">Pedir novas fotos</option>
                                                <option value="3">Pedir nova conta</option>
                                                <option value="4">Pedir assinatura</option>
                                                <option value="5">Recusar/Estornar</option>
                                            </select>
                                            
					</div>
					<div class="col-md-2 col-sm-2 col-xs-12 m-top10-xs">
						<div class="fleft100 text-right center-xs">
                                                    <button id="save_transaction_status" class="bt-green">Salvar</button>
                                                </div>
					</div>
				</div>	
                                
                                <div class="fleft100 m-top20 m-l15 m-r20">
				    <small class="fleft100 cl-silver">Histórico dos status</small>
                                    <div id="ctn_status_history" class="m-top30">                                       
                                        <div id="status_history" style="overflow: hidden;">                                            
                                        </div>                                       
                                    </div>
				</div>
                                
			</div>	
		</div>
	</div>
</div>

<div class="modal fade" id="trans_edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
	<div class="modal-dialog mxw-1100" role="document">
		<div class="modal-content b-none">
			<div class="fleft100 pd-20 bk-fff ft-size13"> 				                                
				<div style="text-align:right;"><a data-dismiss="modal" style="cursor:pointer"><img src="<?php echo base_url().'assets/img/icones/close.png'?>" alt=""></a></div>
                                <div class="w5 m-top15 m-top10-xs center-xs"><img style="width:20px; height:20px" id="edit_icon_trans" src="<?php echo base_url().'assets/img/icones/ck.png'?>" alt=""></div>
                                <div class="w25 fw-500 m-top10-xs center-xs">
                                    <small class="fleft100 cl-silver">Dados pessoais</small>
                                    <p>
                                        #<span id="edit_trans_id"></span>
                                        <span id="edit_trans_name"></span> <br>
					E-mail: <span id="edit_trans_email"></span> <br>
					CPF: <span id="edit_trans_cpf"></span> <br>
					Cel.: (<span id="edit_trans_phone_ddd"></span>) <span id="edit_trans_phone_number"></span> 
                                    </p>
                                    <small class="fleft100 cl-silver">Dados da transação</small>
                                    <p>                                        
                                        PartnerId: <span id="edit_trans_partnerId"></span><br>
                                        CCB_numb: <span id="edit_trans_trans_ccb_number"></span><br>
                                    </p>
				</div>
                                <div class="w20 fw-500 text-left m-top10-xs center-xs">
					<small class="fleft100 cl-silver">Dados do cartão</small>
					<span id="edit_trans_credit_card_name"></span> <br> 
                                        Final <span id="edit_trans_credit_card_final"></span> <br>
					<div class="fleft100">
                                            <small class="fleft100 cl-silver m-top20">Uso do dinheiro:</small>
                                            <span id="way_to_spend_name"></span> <br>
					</div>
				</div>
				<div class="w20 fw-500 text-left center-xs m-top10-xs">
					<small class="fleft100 cl-silver">Dados bancários</small>
					(<span id="edit_trans_bank_code"></span>) <span id="edit_trans_bank_name"></span> <br>
                                        AG. <span id="edit_trans_agency"></span> <br>
                                        CC. <span id="edit_trans_account"></span>-<span id="edit_trans_dig"></span>
					<div class="fleft100">
						<small class="fleft100 cl-silver m-top20">Endereço</small>
                                                <span id="edit_trans_street_address"></span>, <span id="edit_trans_number_address"></span> <br> 
                                                <span id="edit_trans_city_address"></span>, <span id="edit_edit_trans_state_address"></span> 
                                                <br> CEP. <span id="edit_edit_trans_cep"></span>
					</div>
				</div>
                                <div class="w20 fw-500 text-left m-top10-xs center-xs">
                                    <small class="fleft100 cl-silver">Dados da Solicitação</small>
                                    <span id="edit_trans_date"></span><br>                                    
                                    Valor solicitado: R$<span id="edit_trans_solicited_value"></span><br>
                                    Prazo: <span id="edit_trans_numb_plots"></span> meses <br>
                                    Parcelas: R$ <span id="edit_trans_value_plots"></span><br>                                    
                                    CET: R$ <span id="edit_trans_cet"></span><br>                                    
                                    IOF: R$ <span id="edit_trans_iof"></span><br>
                                    Juros ao mes: <span id="edit_trans_tax"></span>%<br>                                    
                                </div>				                                    
                                <div class="w12 fw-500 text-left m-top40 center-xs">
                                    <small class="fleft100 cl-silver"></small>                                                                        
                                    CET MENSAL: <br>
                                    <span id="edit_trans_cet_m"></span>%<br><br>
                                    CET ANUAL: <br>
                                    <span id="edit_trans_cet_a"></span>%                                    
                                </div>	
                                
                                <div class="col-md-2 col-sm-2 col-xs-12 m-top10-xs">
                                        <div class="fleft100 text-right center-xs">
                                            <button id="edit_save_transaction" class="bt-green">Salvar</button>
                                        </div>
                                </div>
                                
                                
                                
			</div>	
		</div>
	</div>
</div><!-- / -->

<section class="fleft100 m-top40 m-b100">
	<div class="container">
                <div class="col-md-6 col-sm-6 col-xs-12 m-top10-xs text-left">
                    <h4 class="pd-lr15 m-b10 fw-500 fleft100"><em>Transações</em></h4>                
                </div>
                <form action="<?php echo base_url().'index.php/welcome/transacoes';?>" method="post">
                    <div class="trans cl-fff fleft100 pd-20">
                        <div class="col-md-4 col-sm-4 col-xs-12">
                            <span class="fleft100">Digite sua busca aqui:</span>
                            <input id="token" name="token" type="text" class="pd-5 m-top5 fleft100 bk-fff b-none cl-black" value="<?php echo $token?>">
			</div>
			<div class="col-md-4 col-sm-4 col-xs-12 m-top10-xs">
                            <span class="fleft100">Período de cobrança no cartão</span>
                            <div class="col-md-5 col-sm-5 col-xs-6 pd-0">
<!--                                <div class='input-group date m-top5' id='datetimepicker_init'>
                                    <input type='text' class="form-control" id="init_date" value="31/05/2018"/>
                                    <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-calendar"></span>
                                    </span>
                                </div>-->
                                <div class="input-group date m-top5">
                                    <input type="date" name="init_date" id="init_date" placeholder="mm/dd/yyyy" class="form-control" value="<?php echo $start_period;?>">
                                </div>
                            </div>                           
                            <div class="col-md-1 col-sm-1 col-xs-6 pd-0" ></div>
                            <div class="col-md-5 col-sm-5 col-xs-6 pd-0" >
<!--                                <div class='input-group date m-top5' id='datetimepicker_end'>
                                    <input type='text' class="form-control" id="end_date" value="31/05/2018"/>
                                    <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-calendar"></span>
                                    </span>
                                </div>-->
                                <div class="input-group date m-top5">
                                    <input type="date" name="end_date" id="end_date" placeholder="mm/dd/yyyy" class="form-control" value="<?php echo $end_period;?>">
                                </div>
                            </div>
			</div>
                        <div class="col-md-2 col-sm-2 col-xs-12">                            
                            <span class="fleft100">Estado</span>
                            <div class="m-top25 m-top25-xs">
                                <select name="status" id="status" required style="max-height: 70px; background-color:#293d3d;">
                                    <option value="default" selected="0">ANY STATE</option>
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
                 <div class="col-md-3 col-sm-3 col-xs-12 m-top10-xs m-top10 m-b10 text-right">
                     <button id="export_leads">Leads</button>
                </div>
                 <div class="col-md-1 col-sm-1 col-xs-12 m-top10-xs m-top10 m-b10 text-right">
                     <button id="export_transactions">Exportar</button>
                </div>
		
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
                                Account bank 
                            </div>
                            <div class="w20 m-top15 m-top10-xs fw-500">
                                Dados do cartão                        
                            </div>
                            
			</li>
                    <?php foreach($_SESSION['affiliate_logged_transactions'] as $transaction) { ?>
			<li>
                            <div class="w5 m-top15 m-top10-xs">                                                                
                                <img style="width:20px; height:20px" title="<?php echo $transaction['hint_by_status']?>" src="<?php echo base_url().'assets/img/icones/'.$transaction['icon_by_status'];?>" alt="">
                            </div>
                            <div class="w10 fw-500 m-top15 m-top10-xs">
                                <?php echo $transaction['client_id']; ?>
                            </div>
                            <div class="w15 fw-500 m-top15 m-top10-xs">
                                <?php echo substr($transaction['cpf'], 0, 3).'.'.substr($transaction['cpf'], 3, 3).'.'.substr($transaction['cpf'], 6, 3).'-'.substr($transaction['cpf'], 9, 2); ?>
                            </div>
                            <div class="w15 fw-500 m-top15 m-top10-xs">
                                <?php echo date("d-m-y / H:i", $transaction['dates'][0]['date']); ?>
                            </div>
                            <div class="w10 cl-blue m-top15 m-top10-xs fw-500">
                               R$ <?php echo str_replace('.', ',', $transaction['amount_solicited']/100).' ('.$transaction['number_plots'].')'; ?>                               
                            </div>
                            <div class="w20 fw-500 text-left center-xs m-top10-xs">
                                <?php 
                                    echo $transaction['credit_card_name'].'<br>';
                                    echo 'Final - '. $transaction['credit_card_final']; 
                                ?>  
                            </div>
                            <div class="w15 fw-500 text-left center-xs m-top10-xs">
                                <!--<small class="fleft100">Dados do cartão</small>-->
                                <?php 
                                    echo $transaction['bank_name'].'<br>';
                                    echo 'AG. '.$transaction['agency'].' - CC. '.$transaction['account'];
                                ?>
                            </div>
                            <div class="w5 fw-500 m-top10">
                                <a href="" data-toggle="modal" data-target="" data-whatever="@mdo">
                                    <img id="edit<?php echo $transaction['client_id']; ?>" class="btn_edit_trnsaction" style="width:30px" src="<?php echo base_url().'assets/img/icones/edit.jpg'?>" alt="">
                                </a>
                            </div>
                            <div class="w5 fw-500 m-top10">
                                <a href="" data-toggle="modal" data-target="" data-whatever="@mdo">
                                    <img id="<?php echo $transaction['client_id']; ?>" class="btn_see_trnsaction" src="<?php echo base_url().'assets/img/icones/add.png'?>" alt="">
                                </a>
                            </div>
			</li>
                    <?php }?> 
		</ul>
		<ul class="pg text-right m-top20 fleft100">
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
