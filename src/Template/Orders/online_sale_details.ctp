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
			<span class="caption-subject font-blue-steel ">Online Sale For "<?php foreach ($ItemLedgers as $ItemLedger){ echo $ItemLedger->item->name.'('.$ItemLedger->item->alias_name.')'; break; } ?>"</span> <br/>
			<span class="caption-subject" align="right" style="margin-left: 406px;"><b> <?php echo date('d-m-Y',strtotime(@$from_date)); ?> To <?php echo  date('d-m-Y',strtotime(@$to_date)); ?></b></span>
		</div>
		<div class="portlet-body">
		
		
			<div class="row">
				<div class="col-md-12">
				<table class="table table-bordered table-striped table-hover">
					<thead>
						<tr>
							<th>Sr. No.</th>
							<th>Order No</th>
							<th>Quantity</th>
						</tr>
					</thead>
					<?php if(sizeof($ItemLedgers->toArray())>0){ ?>
					<tbody>
						<?php $unit; $total=0; $i=1; foreach($ItemLedgers as $ItemLedger){ 
						 if(@$ItemLedger->order->order_type!='Bulkorder'){?>
						<tr>
							<td><?= h($i++) ?></td>
							<td>
								<?php echo $this->Html->link(@$ItemLedger->order->order_no,['controller'=>'Orders','action' => 'view', $ItemLedger->order->id, 'print'],['target'=>'_blank']); ?>
							</td>
							
							<td><?= h(@$ItemLedger->quantity).' '.$ItemLedger->item->unit->unit_name;
								@$total+=@$ItemLedger->quantity;
								@$unit = @$ItemLedger->item->unit->unit_name;								
								?></td>
						</tr>
						 <?php  }}?>
						<tr>
							<td colspan="2" align="right"><b>Total</b></td>
							<td><b><?php  echo $this->Number->format(@$total).' '.@$unit ?></b></td>
						</tr>
					</tbody>
						<?php  }else{ ?>
					<tbody>
					<tr>
							<td colspan="3">No Data Found</td>
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
	//
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