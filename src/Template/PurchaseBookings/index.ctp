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
							<th scope="col"><?= $this->Paginator->sort('voucher_no') ?></th>
							<th scope="col"><?= $this->Paginator->sort('grn_id') ?></th>
							
							<th scope="col"><?= $this->Paginator->sort('transaction_date') ?></th>
							<th scope="col"><?= $this->Paginator->sort('vendor_id') ?></th>
							<th scope="col"><?= $this->Paginator->sort('jain_thela_admin_id') ?></th>
							<th scope="col"><?= $this->Paginator->sort('created_on') ?></th>
							<th scope="col" class="actions"><?= __('Actions') ?></th>
						</tr>
					</thead>
					<tbody>
            <?php $sr_no=0; foreach ($purchaseBookings as $purchaseBooking): ?>
            <tr>
                <td><?= ++$sr_no ?></td>
				<td><?= $this->Number->format($purchaseBooking->voucher_no) ?></td>
                <td><?= $purchaseBooking->has('grn') ? $this->Html->link($purchaseBooking->grn->id, ['controller' => 'Grns', 'action' => 'view', $purchaseBooking->grn->id]) : '' ?></td>
                
                <td><?= h($purchaseBooking->transaction_date) ?></td>
                <td><?= $purchaseBooking->has('vendor') ? $this->Html->link($purchaseBooking->vendor->name, ['controller' => 'Vendors', 'action' => 'view', $purchaseBooking->vendor->id]) : '' ?></td>
                <td><?= $purchaseBooking->has('jain_thela_admin') ? $this->Html->link($purchaseBooking->jain_thela_admin->name, ['controller' => 'JainThelaAdmins', 'action' => 'view', $purchaseBooking->jain_thela_admin->id]) : '' ?></td>
                <td><?= h($purchaseBooking->created_on) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $purchaseBooking->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $purchaseBooking->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $purchaseBooking->id], ['confirm' => __('Are you sure you want to delete # {0}?', $purchaseBooking->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
				</table>
			</div>
			<div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
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