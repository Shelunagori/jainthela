<?php $url_excel="/?".$url; ?>
<div class="portlet light bordered">
	<div class="portlet-title">
		<div class="caption">
			<i class="icon-globe font-blue-steel"></i>
			<span class="caption-subject font-blue-steel uppercase">Wastage Item Report</span>
		</div>
		<div class="actions">
			<?php echo $this->Html->link( '<i class="fa fa-file-excel-o"></i> Excel', '/ItemLedgers/Excel-Wastage/'.@$url_excel.'',['class' =>'btn btn-sm green tooltips pull-right','target'=>'_blank','escape'=>false,'data-original-title'=>'Download as excel']); ?>
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
								<input type="text" name="From" class="form-control input-sm date-picker" placeholder="Transaction From" value="<?php echo date('d-m-Y');  ?>"  data-date-format="dd-mm-yyyy">
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
								<button type="submit" class="btn btn-success btn-sm"><i class="fa fa-filter"></i> Filter</button>
							</td>
							<td width="2%" align="right">
								<input type="text" class="form-control input-sm pull-right" placeholder="Search..." id="search3"  style="width: 200px;">
							</td>
						</tr>
					</tbody>
				</table>
			</form>
		<!-- BEGIN FORM-->
		<div class="row ">
			<div class="col-md-12">
			<?php $page_no=0; ?>
				<table class="table table-bordered table-striped table-hover" id="main_tble">
					<thead>
						<tr>
							<th>Sr.No.</th>
							<th>Item Name</th>
							<th>Wastage Quantity</th>
							<th style="text-align:right">Average Amount</th>
						</tr>
					</thead>
					<tbody>
						<?php 
						$total_wastage_amount=0;
						foreach ($wastageItems as $wastageItem):
						$waste_quantity=$wastageItem->totalOutWarehouse;
						$item_id=$wastageItem->item_id;
						$average_rate_per=$item_average[$item_id];
						if(is_nan($average_rate_per)){
							$average_rate_per=0;
						}
						$average_quantity_rate_amount=round($waste_quantity*$average_rate_per,2);
						if($waste_quantity>0){ 
						if(empty($average_quantity_rate_amount)){
							$average_quantity_rate_amount=0;
						}
						@$total_wastage_amount+=$average_quantity_rate_amount;
						?>
							<tr>
								<td>
									<?= h(++$page_no) ?>
								</td>
								<td>
									<?= h($wastageItem->item->name).'('.$wastageItem->item->alias_name.')'  ?>
								</td>
								<td>
									<?= h($waste_quantity.' '.$wastageItem->item->unit->unit_name)?>
								</td>
								<td align="right">
									<?= h($average_quantity_rate_amount)?>
								</td>
							</tr>
						<?php }  endforeach;  ?>
							<tr>
								<td colspan="3" align="right"><b>Total Wastage Amount</b></td>
								<td align="right"><b><?= h($total_wastage_amount) ?></b></td>
							</tr>
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