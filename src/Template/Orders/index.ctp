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
						<i class="fa fa-book"></i> Order</span>
				</div>
				<div class="actions">
					<?php echo $this->Html->link('<i class="fa fa-plus"></i> Add new','/Orders/Add',['escape'=>false,'class'=>'btn btn-default']) ?>
					<input type="text" class="form-control input-sm pull-right" placeholder="Search..." id="search3" style="width: 200px;">
				</div>
			</div>
			<div class="portlet-body">
				<table class="table table-condensed table-hover table-bordered" id="main_tble">
						<thead>
						<tr>
							<th scope="col">Sr. No.</th>
							<th scope="col"><?= $this->Paginator->sort('order_no') ?></th>
							<th scope="col"><?= $this->Paginator->sort('customer_id') ?></th>
							<th scope="col"><?= $this->Paginator->sort('amount_from_wallet') ?></th>
							<th scope="col"><?= $this->Paginator->sort('amount_from_jain_cash') ?></th>
							<th scope="col"><?= $this->Paginator->sort('amount_from_promo_code') ?></th>
							<th scope="col"><?= $this->Paginator->sort('total_amount') ?></th>
							<th scope="col"><?= $this->Paginator->sort('promo_code_id') ?></th>
							<th scope="col"><?= $this->Paginator->sort('order_type') ?></th>
							<th scope="col"><?= $this->Paginator->sort('order_date') ?></th>
							<th scope="col"><?= $this->Paginator->sort('status') ?></th>
							<th scope="col" class="actions"><?= __('Actions') ?></th>
						</tr>
					</thead>
					<tbody>
            <?php $sr_no=0; foreach ($orders as $order): ?>
            <tr>
                <td><?= ++$sr_no ?></td>
				<td><?= $this->Number->format($order->order_no) ?></td>
                <td><?= $order->has('customer') ? $this->Html->link($order->customer->name, ['controller' => 'Customers', 'action' => 'view', $order->customer->id]) : '' ?></td>
                <td><?= $this->Number->format($order->amount_from_wallet) ?></td>
                <td><?= $this->Number->format($order->amount_from_jain_cash) ?></td>
                <td><?= $this->Number->format($order->amount_from_promo_code) ?></td>
                <td><?= $this->Number->format($order->total_amount) ?></td>
                <td><?= $order->has('promo_code') ? $this->Html->link($order->promo_code->id, ['controller' => 'PromoCodes', 'action' => 'view', $order->promo_code->id]) : '' ?></td>
                <td><?= h($order->order_type) ?></td>
                <td><?= h($order->order_date) ?></td>
                <td><?= h($order->status) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $order->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $order->id]) ?>
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