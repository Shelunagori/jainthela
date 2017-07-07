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
					<?php echo $this->Html->link('<i class="fa fa-plus"></i> Add new','/Orders/Add/Offline',['escape'=>false,'class'=>'btn btn-default']) ?>
					&nbsp;
					<input type="text" class="form-control input-sm pull-right" placeholder="Search..." id="search3" style="width: 200px;">
				</div>
			</div>
			<div class="portlet-body">
				<table class="table table-condensed table-hover table-bordered" id="main_tble">
					<thead>
						<tr>
							<th scope="col">Sr. No.</th>
							<th scope="col">Order No.</th>
							<th scope="col">Customer Name</th>
							<th scope="col">wallet Amount</th>
							<th scope="col">Grand Total</th>
							<th scope="col">Order Type</th>
							<th scope="col">Order Date</th>
							<th scope="col">Status</th>
							<th scope="col" class="actions"><?= __('Actions') ?></th>
						</tr>
					</thead>
					<tbody>
						<?php $sr_no=0; foreach ($orders as $order): ?>
						<tr>
							<td><?= ++$sr_no ?></td>
							<td><?= h($order->order_no) ?></td>
							<td>
								<?php 
									$customer_name=$order->customer->name;
									$customer_mobile=$order->customer->mobile;
								?>
								<?= h($customer_name.' ('.$customer_mobile.')') ?>
							</td>
							<td align="right"><?= $this->Number->format($order->amount_from_wallet) ?></td>
							<td align="right"><?= $this->Number->format($order->total_amount) ?></td>
							<td><?= h($order->order_type) ?></td>
							<td><?= h($order->order_date) ?></td>
							<td><?= h($order->status) ?></td>
							<td class="actions">
							<?= $this->Html->link(__('View'), ['action' => 'view', $order->id]) ?>
							   <!-- <?= $this->Html->link(__('Edit'), ['action' => 'edit', $order->id]) ?>-->
							</td> 

<!------------------------------------------------------------------------------------------->
		<td class="actions"> 	 
			<a class="btn red btn-xs goc" value="<?= $order->id ?>"  rel="tooltip" title="Delete" data-toggle="modal" href="#delete<?= $order->id ?>"><i class="fa fa-trash goc" value="<?= $order->id ?>"></i></a> 
		</td>
		 
<!------------------------------------------------------------------------------------------->
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
<script>
$(document).ready(function() {
	
	$('.goc').die().live('click',function() 
	{ 
		$('#data').html('<i style= "margin-top: 20px;" class="fa fa-refresh fa-spin fa-3x fa-fw"></i><b> Loading... </b>');
		var odr_id = $(this).attr("value");
		alert(odr_id);
 		var m_data = new FormData();
		m_data.append('odr_id',odr_id);
			
		$.ajax({
			url: "<?php echo $this->Url->build(["controller" => "Orders", "action" => "ajax_order_view"]); ?>",
			data: m_data,
			processData: false,
			contentType: false,
			type: 'POST',
			dataType:'text',
			success: function(data)   // A function to be called if request succeeds
			{
				alert(data);
				$('#data').html(data);
			}	
		});	
	});
});
</script>