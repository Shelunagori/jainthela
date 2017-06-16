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
					<input type="text" class="form-control input-sm pull-right" placeholder="Search..." id="search3" style="width: 200px;">	</div>
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
													<th width="40%">
														<label>Item<label>
													</th>
													<th width="20%">
														<label>Current Stock<label>
													</th>
												</tr>
											</thead>
											<tbody id='main_tbody' class="tab">
												<?php foreach($itemLedgers as $itemLedger){
												$total_in=$itemLedger->total_in;
												$total_out=$itemLedger->total_out;
												$remaining=$total_in-$total_out;
												$item_id=$itemLedger->item_id;
												@$i++;
												?>
													<tr class="main_tr" class="tab">
														<td width="1px">
															<?= $i ?>.
														</td>
                                                         <td>
														 
														 <?= $itemLedger->item->name ?>
														 
							<button type="button" class="btn btn-xs tooltips stock_show" value="<?=$item_id ?>" style="margin-left:5px;" data-original-title="Stock details"><i class="fa fa-plus-circle"></i></button>
							<button type="button" class="btn btn-xs tooltips stock_hide" id="stock_hide" value="<?=$item_id ?>" style="margin-left:5px; display:none;"><i class="fa fa-minus-circle"></i></button></td>
							
														<td>
															<?= $remaining ?>
														</td>
														
													</tr>
												<?php } ?>
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
		//$("#stock_hide").show();
		//$("#stock_show").hide();
		$(this).hide();
		$(this).closest('td').find(".stock_hide").show();
		var entity=$(this).closest('tr');
		var item_id=$(this).val();
		var url="<?php echo $this->Url->build(['controller'=>'ItemLedgers','action'=>'ajaxItemDetails']);
		?>";
		url=url+'/'+item_id,
		
		$.ajax({
			url: url,
		}).done(function(response) {
			entity.after(response);
			//$("#view_revision").html(response);
		});		
    });
	
	$('.stock_hide').die().live("click",function() {
		$(this).closest('tr').next().remove();
		$(this).hide();
		$(this).closest('td').find(".stock_show").show();
	});


    });
</script>
