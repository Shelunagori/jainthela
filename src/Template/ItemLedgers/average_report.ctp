<?php $url_excel="/?".$url; ?>
<div class="portlet light bordered">
	<div class="portlet-title">
		<div class="caption">
			<i class="icon-globe font-blue-steel"></i>
			<span class="caption-subject font-blue-steel uppercase">All Over Average Report</span>
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
				<table class="table table-bordered table-striped table-hover" id="main_tble" width="100%">
					<thead>
						<tr>
							<th rowspan="2">Sr.</th>
							<th rowspan="2">Item Name</th>
							<th colspan="2" style="text-align:center;">Opening Balance</th>
							<th colspan="2" style="text-align:center;">Purchase</th>
							<th colspan="2" style="text-align:center;">Sale</th>
							<th colspan="2" style="text-align:center">Wastage</th>
							<th colspan="2" style="text-align:center">Weight Variation</th>
							<th colspan="2" style="text-align:center">Closing Balance</th>
						</tr>
						<tr>
							<th>Quantity</th>
							<th>Amount</th>
							
							<th>Quantity</th>
							<th>Amount</th>
							
							<th>Quantity</th>
							<th>Amount</th>
							
							<th>Quantity</th>
							<th>Amount</th>
							
							<th>Quantity</th>
							<th>Amount</th>
							
							<th>Quantity</th>
							<th>Amount</th>
						</tr>
					</thead>
					<tbody>
						<?php
						$total_wastage_amount=0;
						foreach ($details as $detail):
								$item_id=$detail->item_id;
							$totalPurchaseQuantity=number_format($detail->totalPurchaseQuantity, 2);
							$totalPurchaseAmount=number_format($detail->totalPurchaseAmount, 2);
							$totalOrderSale=number_format($detail->totalOrderSale, 2);
							$totalWalkinSale=number_format($detail->totalWalkinSale, 2);
							$totalOrderAmount=number_format($detail->totalOrderAmount, 2);
							$totalWalkinAmount=number_format($detail->totalWalkinAmount, 2);
							$totalwasteWarehouse=number_format($detail->totalwasteWarehouse, 2);
							$totalWeightVariation=number_format($detail->totalWeightVariation, 2);
							
							$per_item_average_amount=number_format(($totalPurchaseAmount/$totalPurchaseQuantity), 2);
							
							$opening_balance_quantity=$opening_balance[$item_id];
							$opening_balance_amount=number_format($opening_balance_quantity*$per_item_average_amount, 2);
							
							$total_sales_quantity=$totalOrderSale+$totalWalkinSale;
							$total_sales_amount=$totalOrderAmount+$totalWalkinAmount;
							
							$total_waste_quantity=$totalwasteWarehouse+$totalWeightVariation;
							$total_waste_amount=number_format($totalwasteWarehouse*$per_item_average_amount, 2);
							$total_weight_variation_amount=number_format($totalWeightVariation*$per_item_average_amount, 2);
							$item_id=$detail->item_id;
							$average_rate_per=$item_average[$item_id];
							$average_quantity_rate_amount=round($waste_quantity*$average_rate_per);
							 
							 $total_in_quantity=$totalPurchaseQuantity+$opening_balance_quantity;
							 $total_out_quantity=$total_sales_quantity+$totalwasteWarehouse+$totalWeightVariation;
							 $closing_balance_quantity=number_format(($total_in_quantity-$total_out_quantity), 2);
							@$total_wastage_amount+=$average_quantity_rate_amount;
						?>
							<tr>
								<td>
									<?= h(++$page_no) ?>
								</td>
								<td>
									<?= h($detail->item->name).'('.$detail->item->alias_name.')'  ?>
								</td>
								
								<td align="right">
									<?= h($opening_balance_quantity.' '.$detail->item->unit->unit_name)?>
								</td>
								<td align="right">
									<?= h($opening_balance_amount)?>
								</td>
								
								<td align="right">
									<?= h($totalPurchaseQuantity.' '.$detail->item->unit->unit_name)?>
								</td>
								<td align="right">
									<?= h($totalPurchaseAmount)?>
								</td>
								
								<td align="right">
									<?= h($total_sales_quantity.' '.$detail->item->unit->unit_name)?>
								</td>
								<td align="right">
									<?= h($total_sales_amount)?>
								</td>
								
								<td align="right">
									<?= h($totalwasteWarehouse.' '.$detail->item->unit->unit_name)?>
								</td>
								<td align="right">
									<?= h($total_waste_amount)?>
								</td>
								
								<td align="right">
									<?= h($totalWeightVariation.' '.$detail->item->unit->unit_name)?>
								</td>
								<td align="right">
									<?= h($total_weight_variation_amount)?>
								</td>
								
								<td align="right">
									<?= h($closing_balance_quantity.' '.$detail->item->unit->unit_name)?>
								</td>
								<td align="right">
									<?php ?>
								</td>
							</tr>
						<?php  endforeach;  ?>
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