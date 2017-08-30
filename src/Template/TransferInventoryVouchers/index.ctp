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
						<i class="fa fa-book"></i> Inventory Transfer Voucher </span>
				</div>
				<div class="actions">
				<?php echo $this->Html->link('<i class="fa fa-plus"></i> Add New',['controller'=>'TransferInventoryVouchers','action' => 'add'],['escape'=>false,'class'=>'btn btn-default']); ?>&nbsp;
					<input type="text" class="form-control input-sm pull-right" placeholder="Search..." id="search3" style="width: 200px;">
				</div>
			</div>
			<div class="portlet-body">
				<table class="table table-condensed table-hover table-bordered" id="main_tble">
						<thead>
						<tr>
							<th scope="col">Sr. No.</th>
							<th scope="col">Voucher No.</th>
							<th scope="col">Item</th>
							<th scope="col">Quantity</th>
							<th scope="col">Created On</th>
							<th scope="col" class="actions"><?= __('Actions') ?></th>
						</tr>
					</thead>
					<tbody>
            <?php
			$sr_no=0; foreach ($transferInventoryVouchers as $transferInventoryVoucher): ?>
            <tr>
                <td><?= ++$sr_no ?></td>
				<td><?= h('#'.str_pad($this->Number->format($transferInventoryVoucher->voucher_no), 4, '0', STR_PAD_LEFT)) ?></td>
                <td><?= $transferInventoryVoucher->item->name ?></td>
                <td><?= $transferInventoryVoucher->quantity ?></td>
                
                <td><?= h(date('d-M-Y', strtotime($transferInventoryVoucher->created_on))) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $transferInventoryVoucher->id]) ?>
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
