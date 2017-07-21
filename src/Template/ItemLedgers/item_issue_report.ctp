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
						<i class="fa fa-plus"></i> Driver Statement
					</span>
				</div>
				<div class="actions">
					<?php echo $this->Html->link('<i class="fa fa-plus"></i> Add new','/Grns/Add',['escape'=>false,'class'=>'btn btn-default']) ?>
					
					<input type="text" class="form-control input-sm pull-right" placeholder="Search..." id="search3"  style="width: 200px;">&nbsp;
				
				</div>
			</div>
			<div class="portlet-body">
				<table class="table table-condensed table-hover table-bordered" id="main_tble">
					<thead>
						<tr>
							<tr>
								<th>Sr.no</th>
								<th>Date</th>
								<th>Time</th>
								<th>Driver</th>
								<th>Item</th>
								<th>Issue</th>
								<th>Return</th>
								<th>Remaining</th>
								<th scope="col" class="actions"><?= __('Actions') ?></th>
							</tr>
						</tr>
					</thead>
					<tbody>
						<?php $sr_no=0; foreach ($item_ledgers as $item_ledger): 
						
						$transaction_date=$item_ledger->transaction_date;
						$org_transaction_date=date('d-M-Y');
						$created_on=$item_ledger->created_on;
						$status=$item_ledger->status;
						$quantity=$item_ledger->quantity;
						$driver_name=$item_ledger->driver->name;
						$item_name=$item_ledger->item->name;
						?>
						<tr>
							<td><?= $this->Number->format(++$sr_no) ?></td>
							<td><?= h($org_transaction_date) ?></td>
							<td><?= h($grn->transaction_date) ?></td>
							<td><?= h($driver_name) ?></td>
							<td><?= h($grn->vendor->name) ?></td>
							
							<td class="actions">
								<?= $this->Html->link(__('View'), ['action' => 'view', $grn->id]) ?>
								<?php if($status=='open'){ ?>
								<?= $this->Html->link(__('Book Invoice'), ['controller'=>'PurchaseBookings', 'action' => 'add', $grn->id]) ?>
								<?php } ?>
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