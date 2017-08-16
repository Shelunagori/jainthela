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
						<i class="fa fa-plus"></i> Customers
					</span>
				</div>
				<div class="actions">
					<?php echo $this->Html->link('<i class="fa fa-plus"></i> Add new','/Customers/Add',['escape'=>false,'class'=>'btn btn-default']) ?>&nbsp;
					<input type="text" class="form-control input-sm pull-right" placeholder="Search..." id="search3" style="width: 200px;">
				</div>
			</div>
			<div class="portlet-body">
				<table class="table table-condensed table-hover table-bordered" id="main_tble">
					<thead>
						<tr>
							<th>Sr</th>
							<th>Name</th>
							<th>Email</th>
							<th>Address</th>
							<th>Bulk Booking Discount %</th>
							<th scope="col" class="actions"><?= __('Actions') ?></th>
						</tr>
					</thead>
					<tbody>
						<?php $i=0;
						foreach ($customers as $customer): 
						$i++;
						$name=$customer->name;
						$mobile=$customer->mobile;
						if(!empty($mobile)){
							$show_name=$name.' ('.$mobile.')';
						}else{
							$show_name=$name;
						}
						?>
						<tr>
							<td><?= $i ?></td>
							<td><?= h($show_name) ?></td>
							<td><?= h($customer->email) ?></td>
							<td><?= h($customer->address) ?></td>
							<td><?= h($customer->bulk_booking_discount_percent) ?></td>
							<td class="actions">
								<?= $this->Html->link(__('Edit'), ['action' => 'edit', $customer->id]) ?>
								<?= $this->Html->link(__('View'), ['action' => 'view', $customer->id ]) ?>
								<?= $this->Html->link(__('Address'), ['controller'=>'CustomerAddresses', 'action' => 'index', $customer->id ]) ?>
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