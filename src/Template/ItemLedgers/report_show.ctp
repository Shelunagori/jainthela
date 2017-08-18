<?php $url_excel="/?".$url; ?>
<div class="row">
	<div class="col-md-12">
		<div class="portlet light">
			<div class="portlet-title">
				<div class="caption">
					<i class="font-purple-intense"></i>
					<span class="caption-subject font-purple-intense ">
						<i class="fa fa-plus"></i> STOCK REPORT
					</span>
				</div>
				<div class="actions"> 
					<?php echo $this->Html->link( '<i class="fa fa-file-excel-o"></i> Excel', '/ItemLedgers/Export-Excel-Stock/'.@$url_excel.'',['class' =>'btn btn-sm green tooltips pull-right','target'=>'_blank','escape'=>false,'data-original-title'=>'Download as excel']); ?>
					<input type="text" class="form-control input-sm pull-right" placeholder="Search..." id="search3"  style="width: 200px;margin-right: 5px;">
					
				</div>
			</div>
			<div class="portlet-body">
				<!-- BEGIN FORM-->
				<div class="row">
					<div class="col-md-12">
						<table id="main_tble" class="table table-condensed table-bordered">
							<thead>
								<tr>
									<th width="10%">
										<label>Sr<label>
									</th>
									<th width="20%">
										<label>Item<label>
									</th>
									<th width="20%">
										<label>Driver Stock<label>
									</th>
									<th width="20%">
										<label>Warehouse Stock<label>
									</th>
									<th width="20%">
										<label>Current Stock<label>
									</th>
								</tr>
							</thead>
							<tbody id='main_tbody' class="tab">
						<?php foreach($itemLedgers as $itemLedger){
							
								$item_freeze=$itemLedger->item->freeze;
								if($item_freeze==1){
									continue;
								}
								$driver_stock=number_format($itemLedger->totalInDriver-$itemLedger->totalOutDriver, 2);
								$warehouse_stock=number_format($itemLedger->totalInWarehouse-$itemLedger->totalOutWarehouse, 2);
								@$i++;
								
								if(($driver_stock!= 0) ||($warehouse_stock!= 0)) {
								?>
									<tr class="main_tr" class="tab">
										<td width="1px"><?= $i ?>.</td>
										<td>
											<a href="#" role="button" class="stock_show" itm="<?= $itemLedger->item_id ?>"><?= $itemLedger->item->name ?></a>	
										</td>
										<td>
											<?= $driver_stock.' '.$itemLedger->item->unit->shortname ?>
										</td>
										<td>
											<?= $warehouse_stock.' '.$itemLedger->item->unit->shortname ?>
										</td>
										<td>
											<?= number_format($driver_stock+$warehouse_stock, 2).' '.$itemLedger->item->unit->shortname ?>
										</td>
									</tr>
								<?php } 
								} ?>
							</tbody>
						</table>
					</div>
					<div class="col-md-12"><br></div>
							</div>
						<!-- END FORM-->
						<div id="view_revision">
						
						</div>
						<div class="row" style="padding-top:5px;">
							<div class="col-md-4"></div>
							<div class="col-md-4"></div>
							<div class="col-md-4"> </div>
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

	$('.stock_show').die().live("click",function() {
		var current_entity=$(this);
		$(this).closest('td').append('<span class="loading_span">Loading...</span>');
		$(this).closest('td').find(".stock_hide").show();
		var entity=$(this).closest('tr');
		var item_id=$(this).closest('tr').find(".stock_show").attr("itm");
		var url="<?php echo $this->Url->build(['controller'=>'ItemLedgers','action'=>'ajaxItemDetails']);
		?>";
		url=url+'/'+item_id,
		$.ajax({
			url: url,
		}).done(function(response) {
			current_entity.removeClass("stock_show").addClass("stock_hide");
			entity.after(response);
			current_entity.closest('td').find('span.loading_span').remove();
		});		
    });
	
	$('.stock_hide').die().live("click",function() {
		$(this).closest('tr').next().remove();
		$(this).addClass("stock_show").removeClass("stock_hide");
	});


    });
</script>
