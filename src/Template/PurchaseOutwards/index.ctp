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
						<i class="fa fa-book"></i> Purchase Outward</span>
				</div>
				<div class="actions">
					<?php echo $this->Html->link('<i class="fa fa-plus"></i> Add new','/PurchaseOutwards/Add',['escape'=>false,'class'=>'btn btn-default']) ?>
					
					<input type="text" class="form-control input-sm pull-right" placeholder="Search..." id="search3" style="width: 200px;">
				</div>
			</div>
			<div class="portlet-body">
				<table class="table table-condensed table-hover table-bordered" id="main_tble">
						<thead>
						<tr>
							<th scope="col">Sr. No.</th>
							<th scope="col">Voucher No.</th>
							<th scope="col">Transaction Date</th>
							<th scope="col">Vendor Name</th>
							<th scope="col">Grand Total</th>
							<th scope="col">Created On</th>
							<th scope="col" class="actions"><?= __('Actions') ?></th>
						</tr>
					</thead>
					<tbody>
            <?php $sr_no=0; foreach ($purchaseOutwards as $purchaseOutward): ?>
            <tr>
                <td><?= ++$sr_no ?></td>
				<td><?= h('#'.str_pad($this->Number->format($purchaseOutward->voucher_no), 4, '0', STR_PAD_LEFT)) ?></td>
                <td><?= h(date('d-M-Y', strtotime($purchaseOutward->transaction_date))) ?></td>
                <td><?= $purchaseOutward->vendor->name ?></td>
                <td><?= number_format($purchaseOutward->total_amount,2) ?></td>
                
                <td><?= h(date('d-M-Y', strtotime($purchaseOutward->created_on))) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $purchaseOutward->id]) ?>
                  <!--  <?= $this->Html->link(__('Edit'), ['action' => 'edit', $purchaseOutward->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $purchaseOutward->id], ['confirm' => __('Are you sure you want to delete # {0}?', $purchaseOutward->id)]) ?>-->
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