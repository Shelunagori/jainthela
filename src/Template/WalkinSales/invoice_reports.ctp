<?php $url_excel="/?".$url; ?>
<style>
.table>thead>tr>th, .table > tbody > tr > td{
	font-size:12px !important;
}
 @media print
   {
     .printdata{
		 display:none;
	 }
   }

</style>
<div class="row printdata">
	<div class="col-md-12">
		<div class="portlet light bordered">
			<div class="portlet-title">
				<div class="caption">
					<i class="icon-globe font-blue-steel"></i>
					<span class="caption-subject font-blue-steel uppercase ">
						 Invoice Report
					</span>
				</div>
				<div class="actions">
					<?php echo $this->Html->link( '<i class="fa fa-file-excel-o"></i> Excel', '/WalkinSales/Export-Excel/'.@$url_excel.'',['class' =>'btn btn-sm green tooltips pull-right','target'=>'_blank','escape'=>false,'data-original-title'=>'Download as excel']); ?>
				</div>
				
			<div class="portlet-body form">
				<form method="GET">
						<table width="50%" class="table table-condensed">
					<tbody>
						<tr>
							<td width="2%">
								<?php echo $this->Form->input('warehouse', ['empty'=>'--Warehouses--','options' => $Warehouses,'label' => false,'class' => 'form-control input-sm select2me','placeholder'=>'Category','value'=> h(@$warehouse_id) ]); ?>
							</td>
							<td width="2%">
								<?php echo $this->Form->input('drivers', ['empty'=>'--Drivers--','options' => $Drivers,'label' => false,'class' => 'form-control input-sm select2me','placeholder'=>'Category','value'=> h(@$drivers_id) ]); ?>
							</td>
							<td width="2%">
								<?php echo $this->Form->input('type', ['empty'=>'--Type--','options' => $types,'label' => false,'class' => 'form-control input-sm select2me','placeholder'=>'Type','value'=> h(@$type) ]); ?>
							</td>
							<td width="5%">
							<?php if(!empty($from_date)){ ?>
								<input type="text" name="From" class="form-control input-sm date-picker" placeholder="Transaction From" value="<?php echo @date('d-m-Y', strtotime($from_date));  ?>"  data-date-format="dd-mm-yyyy">
							<?php }else{ ?>
								<input type="text" name="From" class="form-control input-sm date-picker" placeholder="Transaction From" value="<?php echo @date('d-m-Y');  ?>"  data-date-format="dd-mm-yyyy">
							<?php } ?>	
							</td>	
							<td width="5%">
							<?php if(!empty($to_date)){ ?>
								<input type="text" name="To" class="form-control input-sm date-picker" placeholder="Transaction To" value="<?php echo @date('d-m-Y', strtotime($to_date));  ?>"  data-date-format="dd-mm-yyyy" >
							<?php }else{ ?>
								<input type="text" name="To" class="form-control input-sm date-picker" placeholder="Transaction To" value="<?php echo @date('d-m-Y');  ?>"  data-date-format="dd-mm-yyyy" >
							<?php } ?>	
							</td>
							<td width="10%">
								<button type="submit" class="btn btn-success btn-sm"><i class="fa fa-filter"></i> Filter</button>
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
							<th style="text-align:center;">Warehouse</th>
							<th style="text-align:center;">Driver</th>
							<th style="text-align:center;">Order No.</th>
							<th style="text-align:center;">Transaction Date</th>
							<th style="text-align:center;">Type</th>
							<th style="text-align:right;">Amount</th>
						</tr>
					</thead>
					<tbody>
						<?php $amount_total=0; $i=0;
							if(@$type=='Walkin'){
								foreach ($walkinSales as $walkinSale){ ?>
						<tr>
							<td>
								<?= h(++$i) ?>
							</td>
							<td align="center">
								<?php if(!empty(h(@$walkinSale->warehouse_id))){echo @$walkinSale->warehouse->name ;} else { echo "-"; }?>
							</td>
							<td align="center">
								<?php if(!empty(h(@$walkinSale->driver_id))){echo @$walkinSale->driver->name ;} else { echo "-"; }?>
							</td>
							<td align="center">
								<a class="view_walk" order_id="<?php echo @$walkinSale->id; ?>" ><?= h(@$walkinSale->order_no) ?></a>
							</td>
							<td align="center">
								<?= h(@$walkinSale->created_on) ?>
							</td>
							<td align="center">Walkin</td>
							<td align="right">
								<?= $this->Number->precision(@$walkinSale->total_amount,2); 
								$amount_total+=$walkinSale->total_amount;?>
							</td>
						</tr>
						<?php }}else if(@$type == 'Online'){
							 $i=$i; foreach($Orders as $order){ ?>
							<tr>
								<td>
									<?= h(++$i) ?>
								</td>
								<td align="center">
									<?php if(!empty(h(@$order->warehouse_id))){echo $order->warehouse->name ;} else { echo "-"; }?>
								</td>
								<td align="center">
									<?php if(!empty(h(@$order->driver_id))){echo $order->driver->name ;} else { echo "-"; }?>
								</td>
								<td align="center">
									<?php echo $this->Html->link($order->order_no,['controller'=>'Orders','action' => 'view', $order->id, 'print'],['target'=>'_blank']); ?>
						
								</td>
								<td align="center">
									<?= h(@$order->order_date) ?>
								</td>
								<td align="center">
									<?php if(@$order->order_type == 'Wallet' || @$order->order_type == 'Cod' || @$order->order_type == 'Online' || @$order->order_type == 'Offline' ){
										echo "Online";
									}?>
								</td>
								<td align="right">
									<?= $this->Number->precision($order->grand_total,2); 
									$amount_total+=$order->grand_total;?>
								</td>
							</tr>
							<?php }}
							 else if($type == 'Bulkorder'){
								$i=$i; foreach($Orders as $order){ ?>
								<tr>
									<td>
										<?= h(++$i) ?>
									</td>
									<td align="center">
										<?php if(!empty(h(@$order->warehouse_id))){echo $order->warehouse->name ;} else { echo "-"; }?>
									</td>
									<td align="center">
										<?php if(!empty(h(@$order->driver_id))){echo $order->driver->name ;} else { echo "-"; }?>
									</td>
									<td align="center">
										<?php echo $this->Html->link($order->order_no,['controller'=>'Orders','action' => 'view', $order->id, 'print'],['target'=>'_blank']); ?>
									</td>
									<td align="center">
										<?= h(@$order->order_date) ?>
									</td>
									<td align="center">
										<?php if(@$order->order_type == 'Wallet' || @$order->order_type == 'Cod' || @$order->order_type == 'Online' || @$order->order_type == 'Offline' ){
											echo "Online";
										}else {
											echo "BulkOrder";
										}?>
									</td>
									<td align="right">
										<?= $this->Number->precision($order->grand_total,2); 
										$amount_total+=$order->grand_total;?>
									</td>
								</tr>
							 <?php }}
									else{
										foreach ($walkinSales as $walkinSale){ ?>
									<tr>
										<td><?= h(++$i) ?></td>
										<td align="center"><?php if(!empty(h(@$walkinSale->warehouse_id))){echo @$walkinSale->warehouse->name ;} else { echo "-"; }?></td>
										<td align="center"><?php if(!empty(h(@$walkinSale->driver_id))){echo @$walkinSale->driver->name ;} else { echo "-"; }?></td>
										
										<td align="center">
											<a class="view_walk" order_id="<?php echo @$walkinSale->id; ?>" ><?= h(@$walkinSale->order_no) ?></a>
										</td>
										<td align="center"><?= h(@$walkinSale->created_on) ?></td>
										<td align="center">Walkin</td>
										<td align="right"><?= $this->Number->precision(@$walkinSale->total_amount,2); 
										$amount_total+=$walkinSale->total_amount;
										?></td>
									</tr>
									 <?php }
									foreach($Orders as $order){ ?>
									<tr>
										<td><?= h(++$i) ?></td>
										<td align="center"><?php if(!empty(h(@$order->warehouse_id))){echo $order->warehouse->name ;} else { echo "-"; }?></td>
										<td align="center"><?php if(!empty(h(@$order->driver_id))){echo $order->driver->name ;} else { echo "-"; }?></td>
										<td align="center">
											<?php echo $this->Html->link($order->order_no,['controller'=>'Orders','action' => 'view', $order->id, 'print'],['target'=>'_blank']); ?>
										</td>
										<td align="center"><?= h(@$order->order_date) ?></td>
										<td align="center">
										<?php if(@$order->order_type == 'Wallet' || @$order->order_type == 'Cod' || @$order->order_type == 'Online' || @$order->order_type == 'Offline' ){
											echo "Online";
										}else {
											echo "BulkOrder";
										}?>
										</td>
										<td align="right"><?= $this->Number->precision($order->grand_total,2); 
										$amount_total+=$order->grand_total;
										?></td>
									</tr><?php }} ?>
									<tr>
										<td align="right" colspan="6"><b>Total</b></td>
										<td align="right"><b><?php echo $this->Number->format($amount_total,['places'=>2]); ?></b></td>
									<tr>
								</tbody>
							</table>
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
	
		var url="<?php echo $this->Url->build(["controller" => "WalkinSales", "action" => "showSearch"]); ?>";	
//alert(url);		
		url=url;  
		$.ajax({
			url: url,
			type: 'GET',
			dataType: 'text'
		}).done(function(response) { 
			$('#showsearch').append('#showdata').html(response).select2();
		});
	
	
	
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
	$('.view_walk').die().live('click',function() {
		$('#popup').show();
		var order_id=$(this).attr('order_id');
		$('#popup').find('div.modal-body').html('Loading...');	 
			var url="<?php echo $this->Url->build(["controller" => "WalkinSales", "action" => "ajaxView"]); ?>";
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
	///search 
	
});
</script>
<div  class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel3" aria-hidden="false" style="display: none;border:0px;" id="popup">
<div class="modal-backdrop fade in" ></div>
	<div class="modal-dialog">
		<div class="modal-content" style="border:0px;">
			<div class="modal-body" >
				<p >
					 Body goes here...
				</p>
			</div>
		</div>
	</div>
</div>