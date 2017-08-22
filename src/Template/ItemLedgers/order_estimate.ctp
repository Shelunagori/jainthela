<style>

@media print{
	.maindiv{
		width:100% !important;
	}	
	
}
p{
margin-bottom: 0;
}
.table > thead > tr > th, .table > tbody > tr > th, .table > tfoot > tr > th, .table > thead > tr > td, .table > tbody > tr > td, .table > tfoot > tr > td {
    padding: 5px !important;
	font-family:Lato !important;
}
</style>

<style type="text/css" media="print">
@page {
    size: auto;   /* auto is the initial value */
    margin: 0px 0px 0px 0px;  /* this affects the margin in the printer settings */
}
</style>
<?php $url_excel="/?".$url; ?>
<div class="row">
	<div class="col-md-12">
		<div class="portlet light">
			<div class="portlet-title">
				<div class="caption">
					<i class="font-purple-intense"></i>
					<span class="caption-subject font-purple-intense ">
						<i class="fa fa-plus"></i> ORDER ESTIMATE
					</span>
				</div>
				<div class="actions"> 
					<input type="text" class="form-control input-sm pull-right hidden-print" placeholder="Search..." id="search3"  style="width: 200px;margin-right: 5px;">
					
				</div>
			</div>
			<a class="btn green btn-md pull-right all_empty hidden-print" style="margin-left:4px;">All Empty</a>
			<a class="btn  blue hidden-print margin-bottom-5 pull-right" onclick="javascript:window.print();">Print <i class="fa fa-print"></i></a>
			
			<div class="portlet-body">
				<!-- BEGIN FORM-->
				<div class="row">
					<div class="col-md-12">
						<table id="main_tble" class="table table-condensed table-bordered">
							<thead style="font-size:14px;">
								<tr>
									<th >
										<label>Sr<label>
									</th>
									<th>
										<label>Item<label>
									</th>
									<th>
										<label>Next Day Requirement<label>
									</th>
									<th>
										<label>Average Sale( As per last 7 Days )<label>
									</th>
									<th>
										<label>Current Stock<label>
									</th>
									<th>
										<label>To be Ordered<label>
									</th>
								</tr>
							</thead>
							<tbody id='main_tbody' class="tab">
						<?php foreach($itemLedgers as $itemLedger){
								$item_id=$itemLedger->item_id;
								$item_freeze=$itemLedger->item->freeze;
								$next_requirement=$itemLedger->item->next_day_requirement;
								if($item_freeze==1){
									continue;
								}
								$driver_stock=number_format($itemLedger->totalInDriver-$itemLedger->totalOutDriver, 2);
								$warehouse_stock=number_format($itemLedger->totalInWarehouse-$itemLedger->totalOutWarehouse, 2);
								
								if(($driver_stock!= 0) ||($warehouse_stock!= 0)) {
								@$i++;
								
								?>
									<tr class="main_tr" class="tab">
										<td width="1px"><?= $i ?>.</td>
										<td>
											<?= $itemLedger->item->name ?>
										</td>
											<td>
											<?= number_format(@$next_day_item_requirement[$item_id]) ?>
										
										<td>
											<?= number_format(@$item_average_sale[$item_id],2).' '.$item_unit_name[$item_id] ?>
										</td>
										<td>
											<?= number_format($driver_stock+$warehouse_stock, 2).' '.$itemLedger->item->unit->shortname ?>
										</td>
										<td>
											<?php echo  $this->Form->control('next_day_order',['class'=>'form-control input-sm nextdayorder quant','placeholder'=>'','label'=>false,'item_id'=>$item_id,'value'=>$next_requirement,'minimum_quantity_factor'=>$itemLedger->item->minimum_quantity_factor,'unit_name'=>$itemLedger->item->unit->shortname]); ?>
											<span class="msg_shw2" style="color:blue; font-size:12px; text-align:left;"><?php if($next_requirement){ echo $next_requirement. ' '.$itemLedger->item->unit->shortname; } ?> </span>
										</td>
										
									</tr>
								<?php } 
								} ?>
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
$(document).ready(function(){

	$('.nextdayorder').die().live("blur",function() {
		var current_entity=$(this);
		var entity=$(this).closest('tr');
		var item_id=entity.find(".nextdayorder").attr("item_id");
		var qty=entity.find(".nextdayorder").val();
		var url="<?php echo $this->Url->build(['controller'=>'ItemLedgers','action'=>'ajaxNextOrder']);
		?>";
		url=url+'/'+item_id+'/'+qty,
		$.ajax({
			url: url,
		}).done(function(response) {
			entity.find(".nextdayorder").val(qty);
		});		
    });
	
	$('.all_empty').die().live("click",function() {
	$('.nextdayorder').val(0);
	$(".msg_shw2").text('');
	var url="<?php echo $this->Url->build(['controller'=>'ItemLedgers','action'=>'ajaxNext']);
		?>";
		url=url;
		$.ajax({
			url: url,
		}).done(function(response) {
		});		
    });
	
	$(".quant").die().live('keyup',function(){
		var quant = parseFloat($(this).val());
		var unit_name = $(this).attr('unit_name');
		if(!unit_name){ unit_name=0; }
		
		$(this).closest('tr').find('.msg_shw2').html(quant+" "+unit_name);
		
	});
	
});
</script>
