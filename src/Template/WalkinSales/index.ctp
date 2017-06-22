<style>
.table>thead>tr>th, .table > tbody > tr > td{
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
						<i class="fa fa-plus"></i> Walkin Sales
					</span>
				</div>
				<div class="actions">
					
					
				<input type="text" class="form-control input-sm pull-right" placeholder="Search..." id="search3"  style="width: 200px;">
				</div>
			</div>
			<div class="portlet-body">
				<table class="table table-condensed table-hover table-bordered" id="main_tble">
					<thead>
						<tr>
									<tr> <th>Sr</th>
									<th>Transaction Date</th>
									<th>Name</th>
									 <th>Mobile</th>
									<th >Warehouse </th>
									<th >Total Amount</th>
									<th class="actions"><?= __('Actions') ?></th>
								</tr>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($walkinSales as $walkinSale): ?>
            <tr>
                <td><?= $this->Number->format($walkinSale->id) ?></td>
                <td><?= h($walkinSale->transaction_date) ?></td>
                <td><?= h($walkinSale->name) ?></td>
                <td><?= h($walkinSale->mobile) ?></td>
                <td><?= h($walkinSale->warehouse->name)?></td>
                <td><?= $this->Number->format($walkinSale->total_amount) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $walkinSale->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $walkinSale->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $walkinSale->id], ['confirm' => __('Are you sure you want to delete # {0}?', $walkinSale->id)]) ?>
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

