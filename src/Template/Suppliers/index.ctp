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
						<i class="fa fa-plus"></i> Add Supplier
					</span>
				</div>
				<div class="actions">
					<?php echo $this->Html->link('<i class="fa fa-plus"></i> Add new','/Suppliers/Add',['escape'=>false,'class'=>'btn btn-default']) ?>
					<input type="text" class="form-control input-sm pull-right" placeholder="Search..." id="search3" style="width: 200px;">
				</div>
			</div>
			<div class="portlet-body">
				<table class="table table-condensed table-hover table-bordered" id="main_tble">
					<thead>
						<tr>
							<th>Sr</th>
							<th>Franchise Name</th>
							<th>Supplier Name</th>
							<th>Mobile No.</th>
							<th>Email</th>
							<th>Address</th>
							<th scope="col" class="actions"><?= __('Actions') ?></th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($suppliers as $supplier): ?>
						<tr>
							<td><?= $this->Number->format($supplier->id) ?></td>
							<td><?= h($supplier->franchise->name) ?></td>
							<td><?= h($supplier->name) ?></td>
							<td><?= h($supplier->mobile) ?></td>
							<td><?= h($supplier->email) ?></td>
							<td><?= h($supplier->address) ?></td>
							<td class="actions">
								<?= $this->Html->link(__('Edit'), ['action' => 'edit', $supplier->id]) ?>
								<?= $this->Form->postLink(__('Freeze'), ['action' => 'delete', $supplier->id], ['confirm' => __('Are you sure you want to delete # {0}?', $supplier->id)]) ?>
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