<div class="row">
	<div class="col-md-12">
		<div class="portlet light">
			<div class="portlet-title">
				<div class="actions">
					<input type="text" class="form-control input-sm pull-right" placeholder="Search..." id="search3" style="width: 200px;">
				</div>
			</div>
			<div class="portlet-body">
					<!-- BEGIN FORM-->
							<div class="row">
								<h3 style="text-align:center;">STOCK REPORT</h3>
									<div class="col-md-12">
										<table id="main_tble" class="table table-condensed table-bordered">
											<thead>
												<tr align="center">
													<td width="10%">
														<label>Sr<label>
													</td>
													<td width="40%">
														<label>Item<label>
													</td>
													<td width="20%">
														<label>Current Stock<label>
													</td>
												</tr>
											</thead>
											<tbody id='main_tbody' class="tab">
												<?php foreach($itemLedgers as $itemLedger){
												$total_in=$itemLedger->total_in;
												$total_out=$itemLedger->total_out;
												$remaining=$total_in-$total_out;
												@$i++;
												?>
													<tr class="main_tr" class="tab">
														<td align="center" width="1px">
															<?= $i ?>.
														</td>
														<td align="center">
															<?= $itemLedger->item->name ?>
														</td>	
														<td align="center">
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
						<div id="data">
						
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