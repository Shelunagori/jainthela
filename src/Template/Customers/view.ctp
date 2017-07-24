<div class="row">
<div class="col-md-12">
<div class="portlet">
<div class="portlet-body"> 

	<div class="portlet light bordered">
		<div class="portlet-title">
			<div class="caption">
				<i class="icon-globe font-blue-steel"></i>
				<span class="caption-subject font-blue-steel uppercase">Customer Details Report</span>
			</div>
			<div class="caption pull-right">
				<i class="fa fa-user"></i>Customer : <?= $Customers->name ?><span class="hidden-480">
				| Mobile : <?= $Customers->mobile ?></span>
			</div>
		</div>
		<div class="portlet-body form"><br>
		<!-- BEGIN FORM-->
				<div class="row">
					<div class="col-md-12">
						<div class="actions">
							<?php
							foreach($Customers->jain_cash_points as $jain_cash_data){
								$jain_cash_total_point=$jain_cash_data->total_point;
								$jain_cash_total_used_point=$jain_cash_data->total_used_point;
								$jain_cash_remaining_point=$jain_cash_total_point-$jain_cash_total_used_point;
							}
							foreach($Customers->wallets as $wallet_data){
								$wallet_total_advance=$wallet_data->total_advance;
								$wallet_total_consumed=$wallet_data->total_consumed;
								$wallet_remaining_amount=$wallet_total_advance-$wallet_total_consumed;
							}
							foreach($Customers->orders as $order_data){
								$total_order_data=$order_data->total_order;
							}
							 ?>
							 <table>
								<tr>
									<td width="35%">
										<div style="border:1px solid #ece5e5;height:38px;width:100px;margin-left:100px;font-size:17px;padding:4px;">
										JAIN CASH<br><?= @$jain_cash_remaining_point ?>
										</div>
									</td>
									<td width="35%">
										<div style="border:1px solid #ece5e5;height:38px;width:100px;margin-left:120px;font-size:18px;padding:8px;">
										WALLET<br><?= @$wallet_remaining_amount ?>
										</div>
									</td>
									<td width="35%">
										<div style="border:1px solid #ece5e5;height:38px;width:100px;margin-left:120px;font-size:18px;padding:8px;">
										ORDERS<br><?= @$total_order_data ?>
										</div>
									</td>
								</tr>
							</table>
	<div class="col-md-12">
		<h3 align="center">Jain Cash Details</h3>
	<div>
	<table width="100%" border="1">
		<tr>
			<td width="50%" valign="top" align="left">
				<table class="table table-condensed table-hover table-bordered" id="main_tble">
					<caption style="text-align:center;font-size:20px;">Earned Points</caption>
					<thead>
						<tr>
							<th>Sr</th>
							<th>Customer</th>
							<th>Point</th>
							<th>Date</th>
						</tr>
					</thead>
					<tbody>
						<?php 
						foreach($jain_cash_gains as $jain_cash_gain){
						@$i++;
							?>
							<tr>
								<td><?= $i ?></td>
								<td>
									<?= h($jain_cash_gain->from_customer->name) ?>
								</td>
								<td>
									<?= h($jain_cash_gain->points) ?>
								</td>
								<td>
									<?= h(date('d-M-Y', strtotime($jain_cash_gain->created_on))) ?>
								</td>
						<?php } ?>														 
					</tbody>
				</table>
			</td>
			<td width="50%" valign="top" align="right">
				<table class="table table-condensed table-hover table-bordered" id="main_tble2">
					<caption style="text-align:center;font-size:20px;">Used Points</caption>
					<thead>
						<tr>
							<th>Sr</th>
							<th>Order</th>
							<th>Point</th>
							<th>Date</th>
						</tr>
					</thead>
					<tbody>
						<?php 
						foreach($jain_cash_uses as $jain_cash_use){
						@$j++;
							?>
							<tr>
								<td><?= $j ?></td>
								<td>
									<?php @$order_number_show=$jain_cash_use->order->order_no; ?>
									<?= h('#'.str_pad($this->Number->format(@$order_number_show), 4, '0', STR_PAD_LEFT)) ?>
								</td>
								<td>
									<?= h($jain_cash_use->used_point) ?>
								</td>
								<td>
									<?= h(date('d-M-Y', strtotime($jain_cash_use->updated_on))) ?>
								</td>
						<?php } ?>
						 
					</tbody>
				</table>	
			</td>
		</tr>
	</table>
	 
<!-------------------------------------!-Wallet----START----------------------------------->
	<div class="col-md-12">
		<h3 align="center">Wallet</h3>
	<div>
	<table width="100%" border="1">
		<tr>
			<td width="50%" valign="top" align="left">
				<table class="table table-condensed table-hover table-bordered" id="main_tble">
					<caption style="text-align:center;font-size:20px;">Advance</caption>
					<thead>
						<tr>
							<th>Sr</th>
							<th>Plan</th>
							<th>Advance</th>
							<th>Date</th>
						</tr>
					</thead>
					<tbody>
						<?php 
						foreach($wallet_advances as $wallet_advance){
						@$m++;
							?>
							<tr>
								<td><?= $m ?></td>
								<td>
									<?= h($wallet_advance->plan->name) ?>
								</td>
								<td>
									<?= h($wallet_advance->advance) ?>
								</td>
								<td>
									<?= h(date('d-M-Y', strtotime($jain_cash_gain->created_on))) ?>
								</td>
						<?php } ?>														 
					</tbody>
				</table>
			</td>
			<td width="50%" valign="top" align="right">
				<table class="table table-condensed table-hover table-bordered" id="main_tble2">
					<caption style="text-align:center;font-size:20px;">Consumed</caption>
					<thead>
						<tr>
							<th>Sr</th>
							<th>Order</th>
							<th>Consumed</th>
							<th>Date</th>
						</tr>
					</thead>
					<tbody>
						<?php 
						foreach($wallet_consumes as $wallet_consume){
						@$s++;
							?>
							<tr>
								<td><?= $s ?></td>
								<td>
									<?= h('#'.str_pad($this->Number->format($wallet_consume->order->order_no), 4, '0', STR_PAD_LEFT)) ?>
								</td>
								<td>
									<?= h($wallet_consume->consumed) ?>
								</td>
								<td>
									<?= h(date('d-M-Y', strtotime($wallet_consume->updated_on))) ?>
								</td>
						<?php } ?>
						 
					</tbody>
				</table>	
			</td>
		</tr>
	</table>
<!-----------------------------------Wallet----END------------------------------------------->
<!-------------------------------Order---Details---START------------------------------------->
<div class="col-md-12">
		<h3 align="center">Order Details</h3>
	<div>
<table width="100%" border="1">
<tr>
	<td width="100%" valign="top">	
		<table class="table table-condensed table-hover table-bordered" id="main_tble" >
			<thead>
				<tr>
					<th>Sr</th>
					<th>Order</th>
					<th>Date</th>
					<th>Total</th>
					<th>Action</th>
					<th>Status</th>
				</tr>
			</thead>
			<tbody>
				<?php
				foreach($Orders as $Order){
				@$t++;
					?>
					<tr>
						<td><?= $t ?></td>
						<td>
							<?= h('#'.str_pad($this->Number->format($Order->order_no), 4, '0', STR_PAD_LEFT)) ?>
						</td>
						<td>
							<?= h(date('d-M-Y', strtotime($Order->order_date))) ?>
						</td>
						<td>
							<?= h($Order->total_amount) ?>
						</td>
						<td>
							<?= $this->Html->link(__('View'), ['action' => 'view', $Order->id]) ?>
						</td>
						<td>
							<?= h($Order->status) ?>
						</td>
					</tr>
				<?php } ?>														 
			</tbody>
			</table>
		</td>
	</tr>
</table>
<!----------------------------------Order---Details---END--------------------------------------->
						</div>
					 </div>
				</div>
			<!-- END FORM-->
			<div id="data"> </div>						
		</div>
	</div>
</div>
	</div>
</div>
    <div class="col-md-1">
	</div>
</div>	
		
<?php echo $this->Html->script('/assets/global/plugins/jquery.min.js'); ?>
<script>
$(document).ready(function() {
	
	var $rows = $('#main_tble tbody tr');
	$('#search').on('keyup',function() {
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
	
	var $rows2 = $('#main_tble2 tbody tr');
	$('#search2').on('keyup',function() {
		var val = $.trim($(this).val()).replace(/ +/g, ' ').toLowerCase();
		var v = $(this).val();
		if(v){ 
			$rows2.show().filter(function() {
				var text = $(this).text().replace(/\s+/g, ' ').toLowerCase();	
				return !~text.indexOf(val);
			}).hide();
		}else{
			$rows2.show();
		}
	});
	
	var $rows3 = $('#main_tble3 tbody tr');
	$('#search3').on('keyup',function() {
		var val = $.trim($(this).val()).replace(/ +/g, ' ').toLowerCase();
		var v = $(this).val();
		if(v){ 
			$rows3.show().filter(function() {
				var text = $(this).text().replace(/\s+/g, ' ').toLowerCase();	
				return !~text.indexOf(val);
			}).hide();
		}else{
			$rows3.show();
		}
	});
	
});
</script>
