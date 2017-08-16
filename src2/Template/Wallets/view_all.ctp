<style>
.table>thead>tr>th{
	font-size:12px !important;
}
</style>
<div class="row">
	<div class="col-md-12">
		<div class="portlet light bordered">
			<div class="portlet-title">
				<div class="caption">
					<i class="font-purple-intense"></i>
					<span class="caption-subject font-purple-intense ">
						<i class="fa fa-plus"></i> Wallet Report
					</span>
				</div>
				
			</div>
			<div class="portlet-body">
			
				<table class="table table-condensed table-hover table-bordered" id="main_tble">
					<?php
						$i=0;
						
						foreach ($wallets as $wallet): ?>
						<tr>
							<td rowspan="3" >Name <?= h($wallet->customer->name) ?></td>
							<td>
							<tr>Advance : <?= h($wallet->advance) ?></tr>
							<tr>Plan : <?= h($wallet->plan_id) ?></tr>
							<tr>Order : <?= h($wallet->order_id) ?></tr></td>
						</tr>
					<?php endforeach; ?>
				</table>
			</div>
		</div>
	</div>
</div>
<?php echo $this->Html->script('/assets/global/plugins/jquery.min.js'); ?>
<script>
var $rows = $('#main_tble tbody tr');
	$('#search3').on('keyup',function() {
		var val = $.trim($(this).val()).replace(/ +/g, ' ').toLowerCase();
		var v = $(this).val();
		if(v){ 
			$rows.show().filter(function() {
				var text = $(this).text().replace(/\s+/g, ' ').toLowerCase();
	
				return !~text.indexOf(val);
			}).hide();
		}else{
			$rows.show();
		}
	});
</script>