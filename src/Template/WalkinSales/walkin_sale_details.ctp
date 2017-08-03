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
<div class="portlet light bordered printdata">
	<div class="portlet-title">
		<div class="caption">
			<i class="icon-globe font-blue-steel"></i>
			
			<span class="caption-subject font-blue-steel ">Walk In Sale For "<?php foreach ($walkinSales as $walkinSale){ echo @$walkinSale->item->name.'('.@$walkinSale->item->alias_name.')'; break; } ?>" </span><br/>
			<span class="caption-subject" align="right" style="margin-left: 406px;"><b> <?php echo date('d-m-Y',strtotime(@$from_date)); ?> To <?php echo  date('d-m-Y',strtotime(@$to_date)); ?></b></span>
		</div>
		<div class="portlet-body">
		
		<div class="row">
				<div class="col-md-12">
				<table class="table table-bordered table-striped table-hover">
					<thead>
						<tr>
							<th>Sr. No.</th>
							<th>Driver</th>
							<th>Warehouse</th>
							<th>Order No</th>
							<th>Transaction Date</th>
							<th>Quantity</th>
							
						</tr>
					</thead>
					<tbody>
						<?php if(sizeof($walkinSales->toArray())>0){ ?>
						<?php $total=0; $unit; $i=1; foreach($walkinSales as $walkinSale){ ?> 
						<tr>
							<td><?= h($i++) ?></td>
							<td>
								<?php if(@$walkinSale->walkin_sale->driver_id !=0){ ?>
								<?= h(@$walkinSale->walkin_sale->driver->name) ?>
								<?php }else{ echo "-"; } ?>
							</td>
							<td>
								<?php  if(@$walkinSale->walkin_sale->warehouse_id !=0){ ?>
								<?= h(@$walkinSale->walkin_sale->warehouse->name) ?>
								 <?php }else{ echo "-"; }?>
							</td>
							<td>
								<a class="view_walk" order_id="<?php echo @$walkinSale->walkin_sale->id; ?>" ><?= h(@$walkinSale->walkin_sale->order_no) ?></a>
							</td>
							<td>
								<?= h(@$walkinSale->walkin_sale->transaction_date) ?>
							</td>
							<td>
								<?= h(@$walkinSale->quantity).@$walkinSale->item->unit->unit_name ;
								@$total+=@$walkinSale->quantity;
								@$unit=@$walkinSale->item->unit->unit_name; ?>
							</td>
							
						</tr>
						<?php } ?>
						<tr>
							<td colspan="5" align="right"><b>Total</b></td>
							<td><b><?php  echo $this->Number->format(@$total).@$unit ?></b></td>
						</tr>
					</tbody>
					<?php }else{ ?>
					<tbody>
					<tr>
							<td colspan="5">No Data Found</td>
					</tr>		
					</tbody>
					<?php  } ?>
				</table>
				
				</div>
			</div>
		</div>
	</div>
</div>

<?php echo $this->Html->script('/assets/global/plugins/jquery.min.js'); ?>
<script>
$(document).ready(function() {
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
	///
	$('.close').die().live('click',function() {
		$('#popup').hide();
	});
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