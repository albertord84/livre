<?php include_once "inc/header-interno.php";?>
<section class="fleft100 m-top40 m-b100 center-xs">
	<div class="container">
		<h4><em>Configurações</em></h4>
		<div class="fleft100 bk-fff pd-tb50 pd-lr25 m-top5">
			<div class="col-md-6 col-sm-6 col-xs-12 pd-lr25 pd-lr0-xs">
				<div class="col-md-6 col-sm-6 col-xs-12 pd-0 center-xs">
					<span class="fw-600 fleft100 cl-black">Taxa de juros ao mês</span>
					<a href="" class="cl-silver fw-500"><small><u>Histórico</u></small></a>
				</div>
				<div class="col-md-3 col-sm-3 col-xs-6 m-top20-xs pd-lr20 pd-lr0-xs m-top20-xs">
					<input type="text" class="ipsilver">
				</div>
				<div class="col-md-3 col-sm-3 col-xs-6 m-top20-xs pd-0 pd-left5-xs m-top20-xs">
					<a href="" class="bt-blue fleft100 text-center ellipse">Atualizar</a>
				</div>
			</div>
			<div class="col-md-6 col-sm-6 col-xs-12 pd-lr25 m-top20-xs pd-lr0-xs center-xs">
				<div class="col-md-6 col-sm-6 col-xs-12 pd-0">
					<span class="fw-600 fleft100 cl-black">Taxa de adesão (Cédit Société)</span>
					<a href="" class="cl-silver fw-500"><small><u>Histórico</u></small></a>
				</div>
				<div class="col-md-3 col-sm-3 col-xs-6 m-top20-xs pd-lr20 pd-lr0-xs">
					<input type="text" class="ipsilver">
				</div>
				<div class="col-md-3 col-sm-3 col-xs-6 m-top20-xs pd-0 pd-left5-xs">
					<a href="" class="bt-blue fleft100 text-center ellipse">Atualizar</a>
				</div>
			</div>
			<div class="fleft100 pd-lr25 pd-lr0-xs"><hr class="linesilver fleft100"></div>
			<div class="col-md-6 col-sm-6 col-xs-12 pd-lr25 pd-lr0-xs">
				<div class="col-md-6 col-sm-6 col-xs-12 pd-0">
					<span class="fw-600 fleft100 cl-black">Número de parcelas</span>
					<a href="" class="cl-silver fw-500"><small><u>Histórico</u></small></a>
				</div>
				<div class="col-md-6 col-sm-6 col-xs-12 pd-0">
					<div class="fleft100 parc m-top10-xs">
						<div class="col-md-1 col-sm-1 col-xs-1 pd-0 cl-black fw-600 m-top5">2X</div>
						<div class="col-md-9 col-sm-9 col-xs-10"><input value="1" min="1" step="1" max="12" type="range" id="range" class="range fleft100 bk-none"></div>
						<div class="col-md-1 col-sm-1 col-xs-1 pd-0 cl-black fw-600 m-top5"><span id="result-value">1</span>X</b></div>
					</div>
					<script>
						// RANGER
						var range = document.getElementById('range');
						var result = document.getElementById('result-value');

						range.addEventListener('change', function(){
						    result.innerHTML = this.value;
						    $(".its li").addClass('at');
						});
					</script>
				</div>
				<div class="col-md-12 col-sm-12 col-xs-12 pd-0">
					<a href="" class="bt-blue pd-lr25 i-block m-top10 text-center">Atualizar</a>
				</div>
			</div>
			<div class="col-md-6 col-sm-6 col-xs-12 pd-lr25 pd-lr0-xs m-top20-xs">
				<div class="col-md-6 col-sm-6 col-xs-12 pd-0 center-xs">
					<span class="fw-600 fleft100 cl-black">Taxa de juros mensal (Banco)</span>
					<a href="" class="cl-silver fw-500"><small><u>Histórico</u></small></a>
				</div>
				<div class="col-md-3 col-sm-3 col-xs-6 m-top20-xs pd-lr20 pd-lr0-xs">
					<input type="text" class="ipsilver">
				</div>
				<div class="col-md-3 col-sm-3 col-xs-6 pd-0 m-top20-xs pd-left5-xs">
					<a href="" class="bt-blue fleft100 text-center ellipse">Atualizar</a>
				</div>
			</div>
			<div class="fleft100 pd-lr25 pd-lr0-xs"><hr class="linesilver fleft100"></div>
			<div class="col-md-6 col-sm-6 col-xs-12 pd-lr25 pd-lr0-xs pull-right">
				<div class="col-md-6 col-sm-6 col-xs-12 pd-0 center-xs">
					<span class="fw-600 fleft100 cl-black">Taxa de adesão (Meio de pagamento)</span>
					<a href="" class="cl-silver fw-500"><small><u>Histórico</u></small></a>
				</div>
				<div class="col-md-3 col-sm-3 col-xs-6 m-top20-xs pd-lr20 pd-lr0-xs">
					<input type="text" class="ipsilver">
				</div>
				<div class="col-md-3 col-sm-3 col-xs-6 pd-0 m-top20-xs pd-left5-xs">
					<a href="" class="bt-blue fleft100 text-center ellipse">Atualizar</a>
				</div>
			</div>
		</div>
	</div>
</section>
<?php include_once "inc/footer-interno.php";?>