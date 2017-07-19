<div class="col-md-12">
			<div class="row">
				<div class="col-lg-2 col-md-2 col-sm-2 col-xs-6">
					<div class="dashboard-stat blue-madison">
						<div class="visual">
							<i class="fa fa-comments"></i>
						</div>
						<div class="details">
							<div class="number">
								 <?php echo $totalOrder;?>
							</div>
							<div class="desc">
								 Total Order
							</div>
						</div>
						<a class="more" href="Orders">
						View more <i class="m-icon-swapright m-icon-white"></i>
						</a>
					</div>
				</div>
				<div class="col-lg-2 col-md-2 col-sm-2 col-xs-6">
					<div class="dashboard-stat red-intense">
						<div class="visual">
							<i class="fa fa-bar-chart-o"></i>
						</div>
						<div class="details">
							<div class="number">
								  <?php echo $inProcessOrder;?>
							</div>
							<div class="desc">
								 In Process
							</div>
						</div>
						<a class="more" href="Orders">
						View more <i class="m-icon-swapright m-icon-white"></i>
						</a>
					</div>
				</div>
				<div class="col-lg-2 col-md-2 col-sm-2 col-xs-6">
					<div class="dashboard-stat green-haze">
						<div class="visual">
							<i class="fa fa-shopping-cart"></i>
						</div>
						<div class="details">
							<div class="number">
								  <?php echo $deliveredOrder;?>
							</div>
							<div class="desc">
								 Delivered order
							</div>
						</div>
						<a class="more" href="Orders">
						View more <i class="m-icon-swapright m-icon-white"></i>
						</a>
					</div>
				</div>
				<div class="col-lg-2 col-md-2 col-sm-2 col-xs-6">
					<div class="dashboard-stat purple-plum">
						<div class="visual">
							<i class="fa fa-globe"></i>
						</div>
						<div class="details">
							<div class="number">
								  <?php echo $cancelOrder;?>
							</div>
							<div class="desc">
								 Cancel order
							</div>
						</div>
						<a class="more" href="Orders">
						View more <i class="m-icon-swapright m-icon-white"></i>
						</a>
					</div>
				</div>
					<div class="col-lg-2 col-md-2 col-sm-2 col-xs-6">
					<div class="dashboard-stat blue-madison">
						<div class="visual">
							<i class="fa fa-comments"></i>
						</div>
						<div class="details">
							<div class="number">
								  <?php echo $offlineOrder;?>
							</div>
							<div class="desc">
								 Offline Order
							</div>
						</div>
						<a class="more" href="Orders">
						View more <i class="m-icon-swapright m-icon-white"></i>
						</a>
					</div>
				</div>
				<div class="col-lg-2 col-md-2 col-sm-2 col-xs-6">
					<div class="dashboard-stat red-intense">
						<div class="visual">
							<i class="fa fa-bar-chart-o"></i>
						</div>
						<div class="details">
							<div class="number">
								  <?php echo $bulkOrder;?>
							</div>
							<div class="desc">
								 Bulk Booking
							</div>
						</div>
						<a class="more" href="Orders">
						View more <i class="m-icon-swapright m-icon-white"></i>
						</a>
					</div>
				</div>
				
				
			</div>
			</div>
			
			<!--<style>
.table>thead>tr>th{
	font-size:12px !important;
}
</style>
<div class="row">
	<div class="col-md-12">
		<div class="portlet light bordered">
			<div class="portlet-body">
				<table class="table table-condensed table-hover table-bordered" id="main_tble">
					<thead>
						<tr style="background-color:#F3F3F3; ">
							<th scope="col">Sr. No.</th>
							<th scope="col">Order No.</th>
							<th scope="col">Customer Name</th>
							<th scope="col">wallet Amount</th>
							<th scope="col">Grand Total</th>
							<th scope="col">Order Type</th>
							<th scope="col">Order Date</th>
							<th scope="col">Delivery Date</th>
							<th scope="col">Status</th>
							<th scope="col" class="actions"><?= __('Actions') ?></th>
						</tr>
					</thead>
					<tbody>
						<?php $sr_no=0; foreach ($orders as $order): 
						$sr_no++;
						$delivery_date=date('d-m-Y', strtotime($order->delivery_date));
						$current_date=date('d-m-Y');
						?>
						<tr>
						<td><?php echo $sr_no;?> </td>
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
							<td align="right"><?= $this->Number->format($order->amount_from_wallet) ?></td>
							<td align="right"><?= $this->Number->format($order->total_amount) ?></td>
							<td><?= h($order->order_type) ?></td>
							<td><?= h($order_date) ?></td>
							<td><?= h($delivery_date) ?></td>
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
</div>-->



<div class="portlet blue-hoki box col-md-6">
						<div class="portlet-title">
						<div class="caption">
								<i class="fa fa-user"></i>Cash Back Winners
								</div>
							<div class="tools">
								<a href="javascript:;" class="collapse" data-original-title="" title="">
								</a>
							</div>
						</div>
						<div class="portlet-body" style="display: block">
								
							<p>
								<table class="table table-condensed table-hover table-bordered" id="main_tble">
					<tbody>
						<?php
						$sr_no=0; foreach ($fetch_cashback_win_details as $cb): $sr_no++;
						?>
						<tr>
						<div class="col-md-3">
<div class="row">
							<!-- SIDEBAR USERPIC -->
							<span class="badge badge-danger tooltips" data-original-title="Virtule Item"><?php echo $sr_no;?></span>
							<div class="profile-userpic">
								<img src="http://app.jainthela.in<?php echo $this->request->webroot;?>img/user2.png" class="img-responsive" alt="" style="width:100px; height:100px">
							</div>
							<!-- END SIDEBAR USERPIC -->
							<!-- SIDEBAR USER TITLE -->
							<div class="profile-usertitle">
								<div class="profile-usertitle-name" style="padding-left:40px">
									 <?php echo $cb->customer->name;?>
								</div>
								<div class="profile-usertitle-job" style="padding-left:18px">
									 <?php echo $cb->customer->mobile;?>
								</div>
							</div>
						</div>
					</div>
						</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
							</p>
					</div></div>