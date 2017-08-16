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
						<i class="fa fa-book"></i> Purchase Booking</span>
				</div>
				<div class="actions">
					<input type="text" class="form-control input-sm pull-right" placeholder="Search..." id="search3" style="width: 200px;">
				</div>
			</div>
			<div class="portlet-body">
				<table class="table table-condensed table-hover table-bordered" id="main_tble">
						<thead>
						<tr>
							<th scope="col">Sr. No.</th>
							<th scope="col">Voucher No.</th>
							<th scope="col">Grn No.</th>
							
							<th scope="col">Transaction Date</th>
							<th scope="col">Vendor Name</th>
							<th scope="col">Grand Total</th>
							<th scope="col">Created On</th>
							<th scope="col" class="actions"><?= __('Actions') ?></th>
						</tr>
					</thead>
					<tbody>
            <?php $sr_no=0; foreach ($purchaseBookings as $purchaseBooking): ?>
            <tr>
                <td><?= ++$sr_no ?></td>
				<td><?= h('#'.str_pad($this->Number->format($purchaseBooking->voucher_no), 4, '0', STR_PAD_LEFT)) ?></td>
                <td><?= h('#'.str_pad($this->Number->format($purchaseBooking->grn->grn_no), 4, '0', STR_PAD_LEFT)) ?></td>
                <td><?= h($purchaseBooking->transaction_date) ?></td>
                <td><?= $purchaseBooking->vendor->name ?></td>
                <td><?= $purchaseBooking->total_amount ?></td>
                
                <td><?= h($purchaseBooking->created_on) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $purchaseBooking->id]) ?>
                  <!--  <?= $this->Html->link(__('Edit'), ['action' => 'edit', $purchaseBooking->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $purchaseBooking->id], ['confirm' => __('Are you sure you want to delete # {0}?', $purchaseBooking->id)]) ?>-->
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