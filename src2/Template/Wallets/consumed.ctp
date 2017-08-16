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
					<thead>
						<tr>
							<th>Sr</th>
							<th>Name</th>
							<th>Consumed Wallet</th>
							<th>Plan</th>
							<!--<th scope="col" class="actions"><?= __('Actions') ?></th>-->
						</tr>
					</thead>
					<tbody>
					
						<?php $i=0; 
						foreach ($wallets as $wallet): ?>
						<tr>
							<td><?= h($i++) ?></td>
							<td><?= h(@$wallet->customer->name) ?></td>
							<td><?= h(@$wallet->consumed) ?></td>
							<td><?= h(@$wallet->plan->name) ?></td>
							
						</tr>
						<?php endforeach; ?>
					</tbody>
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