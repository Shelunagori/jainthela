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
						<i class="fa fa-plus"></i> Grns
					</span>
				</div>
				<div class="actions">
					<?php echo $this->Html->link('<i class="fa fa-plus"></i> Add new','/Grns/Add',['escape'=>false,'class'=>'btn btn-default']) ?>
					<input type="text" class="form-control input-sm pull-right" placeholder="Search..." id="search3" style="width: 200px;">
				</div>
			</div>
			<div class="portlet-body">
				<table class="table table-condensed table-hover table-bordered" id="main_tble">
					<thead>
						<tr>
							<tr>
								<th>Sr</th>
								<th>Grn No</th>
								<th>Transaction Date</th>
								<th>Created On</th>
								<th>Vendor</th>
								<th scope="col" class="actions"><?= __('Actions') ?></th>
							</tr>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($grns as $grn): ?>
						<tr>
							<td><?= $this->Number->format($grn->id) ?></td>
							<td><?= $this->Number->format($grn->grn_no) ?></td>
							<td><?= h($grn->transaction_date) ?></td>
							<td><?= h($grn->created_on) ?></td>
							<td><?= h($grn->vendor->name) ?></td>
							<td class="actions">
								<?= $this->Html->link(__('View'), ['action' => 'view', $grn->id]) ?>
								<?= $this->Html->link(__('Book Invoice'), ['action' => 'view', $grn->id]) ?>
							</td>
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