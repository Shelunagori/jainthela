<style>
.tiles .tile {
	    height: 118px !important;
}
</style>
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
							<div class="col-md-4"></div> 
							 <div class="tiles">
								<div class="tile bg-blue-steel">
									<div class="tile-body">
										<i class="fa fa-briefcase"></i>
									</div>
									<div class="tile-object">
										<div class="name">
											 WALLET
										</div>
										<div class="number">
											<?php if(!empty(@$wallet_remaining_amount)){ ?>
											<?= @$wallet_remaining_amount ?>
											<?php }else{
												echo "0";
											} ?>
										</div>
									</div>
								</div>
								
								<div class="tile bg-purple-studio">
									<div class="tile-body">
										<i class="fa fa-shopping-cart"></i>
									</div>
									<div class="tile-object">
										<div class="name">
											 ORDERS
										</div>
										<div class="number">
										<?php if(!empty(@$total_order_data)){ ?>
											<?= @$total_order_data ?>
										<?php }else{
												echo "0";
											} ?>	
										</div>
									</div>
								</div>
							</div>
							
<!-------------------------------------!-Wallet----START----------------------------------->
	<div class="col-md-12">
		
	<table width="100%" class="table table-condensed  table-bordered" >
		<tr>
			<td width="50%" valign="top" align="left" style="background-color: rgba(228, 226, 226, 0.38);">
				<table class="table table-condensed table-bordered" id="main_tble">
					<caption style="text-align:center;font-size:20px;">Advance In Wallet</caption>
					<thead>
						
						<tr>
							<th>Sr</th>
							<th>Plan</th>
							<th>Advance</th>
							<th>Narration</th>
							<th>Date</th>
						</tr>
					</thead>
					<tbody>
						<?php 
						foreach($wallet_advances as $wallet_advance){ 
						
						if($wallet_advance->advance == 0){
							?>
							<tr></tr>
							
						<?php }else{@$m++; ?>
							
							<tr>
								<td><?php echo $m; ?></td>
								<td>
									<?= h(@$wallet_advance->plan->name) ?>
								</td>
								<td>
									<?= h(@$wallet_advance->advance) ?>
								</td>
								<td>
									<?= h(@$wallet_advance->narration) ?>
								</td>
								<td>
									<?= h(date('d-M-Y', strtotime(@$wallet_advance->updated_on))) ?>
								</td>
						<?php }} ?>														 
					</tbody>
				</table>
			</td>
			<td width="50%" valign="top" align="right" style="background-color: rgba(228, 226, 226, 0.38);">
				<table class="table table-condensed  table-bordered" id="main_tble2">
					<caption style="text-align:center;font-size:20px;">Consumed From Wallet</caption>
					<thead>
						<tr>
							<th>Sr</th>
							<th>Order</th>
							<th>Consumed</th>
							<th>Narration</th>
							<th>Date</th>
						</tr>
					</thead>
					<tbody>
						<?php 
						foreach($wallet_consumes as $wallet_consume){  
						
						if($wallet_consume->consumed == 0){
							?>
							<tr></tr>
							
						<?php }else{ @$s++;?>
							<tr>
								<td><?= $s ?></td>
								<td>
									<?= h(@$wallet_consume->order->order_no) ?>
								</td>
								<td>
									<?= h(@$wallet_consume->consumed) ?>
								</td>
								<td>
									<?= h(@$wallet_consume->narration) ?>
								</td>
								<td>
									<?= h(date('d-M-Y', strtotime(@$wallet_consume->updated_on))) ?>
								</td>
							</tr>	
						<?php }} ?>
						 
					</tbody>
				</table>	
			</td>
		</tr>
	</table>
<!-----------------------------------Wallet----END------------------------------------------->
<!-------------------------------Order---Details---START------------------------------------->
		
<table width="100%" class="table table-condensed table-bordered" >
<tr >
	<td width="100%" style="background-color: rgba(228, 226, 226, 0.38);" valign="top">	
		<table class="table table-condensed  table-bordered" id="main_tble" >
			<thead>
			<tr><h4 align="left">Order Details</h4></tr>

				<tr>
					<th>Sr</th>
					<th>Order</th>
					<th>Date</th>
					<th>Total</th>
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
							<?= h(@$Order->order_no) ?>
						</td>
						<td>
							<?= h(date('d-M-Y', strtotime(@$Order->order_date))) ?>
						</td>
						<td>
							<?= h(@$Order->total_amount) ?>
						</td>
						
						<td>
							<?= h(@$Order->status) ?>
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
