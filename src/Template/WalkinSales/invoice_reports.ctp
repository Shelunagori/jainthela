<style>
.table>thead>tr>th, .table > tbody > tr > td{
	font-size:12px !important;
}
</style>
<div class="row">
	<div class="col-md-12">
		<div class="portlet light bordered">
			<div class="portlet-title">
				<div class="caption">
					<i class="icon-globe font-blue-steel"></i>
					<span class="caption-subject font-blue-steel uppercase ">
						 Invoice Report
					</span>
				</div>
				
			<div class="portlet-body form">
				<form method="GET" >
				<table width="50%" class="table table-condensed">
					<tbody>
						<tr>
							
							<td width="2%">
							<?php if(!empty($from_date)){ ?>
								<input type="text" name="From" class="form-control input-sm date-picker" placeholder="Transaction From" value="<?php echo @date('d-m-Y', strtotime($from_date));  ?>"  data-date-format="dd-mm-yyyy">
							<?php }else{ ?>
								<input type="text" name="From" class="form-control input-sm date-picker" placeholder="Transaction From" value="<?php echo date('01-m-Y');  ?>"  data-date-format="dd-mm-yyyy">
							<?php } ?>	
							</td>	
							<td width="2%">
							<?php if(!empty($to_date)){ ?>
								<input type="text" name="To" class="form-control input-sm date-picker" placeholder="Transaction To" value="<?php echo @date('d-m-Y', strtotime($to_date));  ?>"  data-date-format="dd-mm-yyyy" >
							<?php }else{ ?>
								<input type="text" name="To" class="form-control input-sm date-picker" placeholder="Transaction To" value="<?php echo date('d-m-Y');  ?>"  data-date-format="dd-mm-yyyy" >
							<?php } ?>	
							</td>
							<td width="10%">
								<button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-filter"></i> Filter</button>
							</td>
							<td width="2%" align="right">
								<input type="text" class="form-control input-sm pull-right" placeholder="Search..." id="search3"  style="width: 200px;">
							</td>
						</tr>
					</tbody>
				</table>
			</form>
				<table class="table table-condensed table-hover table-bordered" id="main_tble">
					<thead>
						<tr> 
							<th>Sr</th>
							<th style="text-align:center;">Supplier Name</th>
							<th style="text-align:center;">Order No.</th>
							<th style="text-align:center;">Transaction Date</th>
							<th style="text-align:center;">Type</th>
							<th style="text-align:right;">Amount</th>
						</tr>
					</thead>
					<tbody>
						<?php $i=1; $amount_total=0; foreach ($walkinSales as $walkinSale){ 
						?>
						<tr>
							<td><?= h($i++) ?></td>
							<td align="center"><?php if(!empty(h(@$walkinSale->warehouse_id))){echo $walkinSale->warehouse->name ;} else { echo @$walkinSale->driver->name; }?></td>
							<td align="center"><?= h(@$walkinSale->order_no) ?></td>
							<td align="center"><?= h(@$walkinSale->transaction_date) ?></td>
							<td align="center">Walkin</td>
							<td align="right"><?= $this->Number->precision(@$walkinSale->total_amount,2); 
							$amount_total+=$walkinSale->total_amount;
							?></td>
						</tr>
						<?php } ?>
						<?php $i=$i; foreach($Orders as $order){ ?>
							<tr>
							<td><?= h($i++) ?></td>
							<td align="center"><?php if(!empty(h(@$order->warehouse_id))){echo $order->warehouse->name ;} else { echo @$order->driver->name; }?></td>
							<td align="center"><?= h(@$order->order_no) ?></td>
							<td align="center"><?= h(date('d-m-Y',strtotime(@$order->delivery_date))) ?></td>
							<td align="center">
							<?php if(@$order->order_type == 'Wallet' || @$order->order_type == 'Cod' || @$order->order_type == 'Online' || @$order->order_type == 'Offline' ){
								echo "Online";
							}else {
								echo "BulkOrder";
							}?>
							</td>
							<td align="right"><?= $this->Number->precision($order->total_amount,2); 
							$amount_total+=$order->total_amount;
							?></td>
						</tr>
						<?php } ?>
						<tr>
						<td align="right" colspan="5"><b>Total</b></td>
						<td align="right"><b><?php echo $this->Number->format($amount_total,['places'=>2]); ?></b></td>
					<tr>
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
