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
			<?php $page_no=$this->Paginator->current('Orders'); $page_no=($page_no-1)*20; ?>
				<table class="table table-condensed table-hover table-bordered" id="main_tble">
					<thead>
						<tr>
							<th scope="col">Sr. No.</th>
							<th scope="col">Order No.</th>
							<th scope="col">Customer Name</th>
							<!--<th scope="col">wallet Amount</th>-->
							<th scope="col">Locality</th>
							<th scope="col">Grand Total</th>
							<th scope="col">Order Type</th>
							<th scope="col">Order Date</th>
							<th scope="col">Delivery Date</th>
							<th scope="col">Delivery Time</th>
							<th scope="col">Status</th>
							<th scope="col" class="actions"><?= __('Actions') ?></th>
						</tr>
					</thead>
					<tbody>
						<?php
						$sr_no=0; foreach ($orders as $order): 
						$delivery_date=date('d-m-Y', strtotime($order->delivery_date));
						$current_date=date('d-m-Y');
						?>
						<tr <?php if($delivery_date==$current_date){ ?>style="background-color:#D0D0D0; "<?php } ?>>
							<td><?= ++$page_no ?></td>
							<td><a class="view_order" order_id="<?php echo $order->id; ?>" ><?= h($order->order_no) ?></a> </td>
							<td>
								<?php
									$customer_name=$order->customer->name;
									$customer_mobile=$order->customer->mobile;
									$status=$order->status;
									$order_date=date('d-m-Y h:i a', strtotime($order->order_date));
									
									
								?>
								<?= h($customer_name.' ('.$customer_mobile.')') ?>
							</td>
							<!--<td align="right"><?= $this->Number->format($order->amount_from_wallet) ?></td>-->
							<td><?= h(@$order->customer_address->locality) ?></td>
							<td align="right"><?= $this->Number->format($order->grand_total) ?></td>
							<td><?= h($order->order_type) ?></td>
							<td><?= h($order_date) ?></td>
							<td><?= h($delivery_date) ?></td>
							<td><?= h($order->delivery_time) ?></td>
							<td><?= h($status) ?></td>
							
							<td class="actions">
							<?php  if(($status=='In Process') || ($status=='In process')){ ?>
							   <a class="btn blue btn-xs get_order" order_id="<?php echo $order->id; ?>" >Delivere</a>
							   <a class="btn red btn-xs cncl" order_id="<?php echo $order->id; ?>" >Cancel</a>
							<?php } ?> 
							</td>
						</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
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
	$('.view_order').die().live('click',function() {
		$('#popup').show();
		var order_id=$(this).attr('order_id');
		$('#popup').find('div.modal-body').html('Loading...');
		var url="<?php echo $this->Url->build(["controller" => "Orders", "action" => "view"]); ?>";
		url=url+'/'+order_id;
		$.ajax({
			url: url,
			type: 'GET',
			dataType: 'text'
		}).done(function(response) {
			$('#popup').find('div.modal-body').html(response);
		});	
	});
	$('.close').die().live('click',function() {
		$('#popup').hide();
	});
	
	$('.cncl').die().live('click',function() {
		$('#popup').show();
		var order_id=$(this).attr('order_id');
 		$('#popup').find('div.modal-body').html('Loading...');
		var url="<?php echo $this->Url->build(["controller" => "Orders", "action" => "cancel_box"]); ?>";
		url=url+'/'+order_id;
		$.ajax({
			url: url,
			type: 'GET',
			dataType: 'text'
		}).done(function(response) {
			$('#popup').find('div.modal-body').html(response);
		});	
	});
	$('.close').die().live('click',function() {
		$('#popup').hide();
	});
	
	
	
	$('.goc').die().live('click',function() 
	{ 
		$('#data').html('<i style= "margin-top: 20px;" class="fa fa-refresh fa-spin fa-3x fa-fw"></i><b> Loading... </b>');
		var odr_id = $(this).attr("value");
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
	
	$('.get_order').die().live('click',function() {
		var order_id=$(this).attr('order_id');
		var m_data = new FormData();
		m_data.append('order_id',order_id);
 		$.ajax({
			url: "<?php echo $this->Url->build(["controller" => "Orders", "action" => "ajax_deliver_api"]); ?>",
			data: m_data,
			processData: false,
			contentType: false,
			type: 'POST',
			dataType:'text',
			success: function(data)   // A function to be called if request succeeds
			{
				location.reload();
 				//$('.setup').html(data);
			}	
		});
	});
});
</script>
<div  class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel3" aria-hidden="false" style="display: none;" id="popup">
<div class="modal-backdrop fade in" ></div>
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-body">
				<p>
					 Body goes here...
				</p>
			</div>
		</div>
	</div>
</div>