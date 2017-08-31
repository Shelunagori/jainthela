<?php $url_excel="/?".$url; ?>
<div class="portlet light bordered">
	<div class="portlet-title">
		<div class="caption">
			<i class="icon-globe font-blue-steel"></i>
			<span class="caption-subject font-blue-steel uppercase">Consolidate Report</span>
		</div>
		<div class="actions">
			<?php echo $this->Html->link( '<i class="fa fa-file-excel-o"></i> Excel', '/ItemLedgers/ExcelAverageReport/'.@$url_excel.'',['class' =>'btn btn-sm green tooltips pull-right','target'=>'_blank','escape'=>false,'data-original-title'=>'Download as excel']); ?>
			
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
						$grand_total_opening_bal=0;
						$grand_total_purchase_bal=0;
						$grand_total_sale_bal=0;
						$grand_total_wastage_bal=0;
						$grand_total_weight_bal=0;
						$grand_total_closing_bal=0;
						foreach ($details as $detail):
							$item_id=$detail->item_id;
							$totalPurchaseQuantity=round($detail->totalPurchaseQuantity, 2);
							$totalPurchaseAmount=round($detail->totalPurchaseAmount, 2);;
							$totalOrderSale=round($detail->totalOrderSale, 2);
							$totalWalkinSale=round($detail->totalWalkinSale, 2);
							$totalOrderAmount=round($detail->totalOrderAmount, 2);
							$totalWalkinAmount=round($detail->totalWalkinAmount, 2);
							$totalwasteWarehouse=round($detail->totalwasteWarehouse, 2);
							$totalWeightVariation=round($detail->totalWeightVariation, 2);
							//$purchase_amount_total=$totalPurchaseQuantity*$per_item_average_amount;
							$opening_balance_qty=$opening_balance_quantity[$item_id];
							$opening_balance_amt=$opening_balance_amount[$item_id];
							if(is_nan($opening_balance_amt)){
								$opening_balance_amt=0;
							}
							
							$total_opening_balance_amount=round($opening_balance_amt, 2);
							
							$total_sales_quantity=$totalOrderSale+$totalWalkinSale;
							$total_sales_amount=$totalOrderAmount+$totalWalkinAmount;
							
							$per_item_average_amount=round($item_average[$item_id],2);
							if(is_nan($per_item_average_amount)){
								$per_item_average_amount=0;
							}
							$total_waste_quantity=$totalwasteWarehouse+$totalWeightVariation;
							$total_waste_amount=round($totalwasteWarehouse*$per_item_average_amount, 2);
							$total_weight_variation_amount=round($totalWeightVariation*$per_item_average_amount, 2);
							
							$total_in_quantity=$totalPurchaseQuantity+$opening_balance_qty;
							$total_out_quantity=$total_sales_quantity+$totalwasteWarehouse+$totalWeightVariation;
							$closing_balance_quantity=round(($total_in_quantity-$total_out_quantity), 2);
							//$total_in_amount=$totalPurchaseAmount+$total_opening_balance_amount;
							//$total_out_amount=$total_waste_amount+$total_weight_variation_amount+$total_sales_amount;
							$closing_balance_amount=round(($closing_balance_quantity*$per_item_average_amount), 2);
							
							$grand_total_opening_bal=$grand_total_opening_bal + $opening_balance_amt;
							$grand_total_purchase_bal=$grand_total_purchase_bal+$totalPurchaseAmount;
							$grand_total_sale_bal=$grand_total_sale_bal+$total_sales_amount;
							$grand_total_wastage_bal=$grand_total_wastage_bal+$total_waste_amount;
							$grand_total_weight_bal=$grand_total_weight_bal+$total_weight_variation_amount;
							$grand_total_closing_bal=$grand_total_closing_bal+$closing_balance_amount;
						?>
							<tr>
								<td>
									<?= h(++$page_no) ?>
								</td>
								<td>
									<?= h($detail->item->name).'('.$detail->item->alias_name.')'  ?>
								</td>
								
								<td align="right">
									<?= h($opening_balance_qty.' '.$detail->item->unit->unit_name)?>
								</td>
								<td align="right">
									<?= h($opening_balance_amt)?>
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
									<?= h($total_weight_variation_amount) ?>
								</td>
								
								<td align="right">
									<?= h($closing_balance_quantity.' '.$detail->item->unit->unit_name)?>
								</td>
								<td align="right">
									<?= h($closing_balance_amount) ?>
								</td>
							</tr>
						<?php  endforeach;  ?>
							<tr>
								<td colspan="2"></td>
								<td ><b>Total Opening</b></td>
								<td align="right"><b><?= h($grand_total_opening_bal) ?></b></td>
								<td ><b>Total Purchase</b></td>
								<td align="right"><b><?= h($grand_total_purchase_bal) ?></b></td>
								<td ><b>Total Sale</b></td>
								<td align="right"><b><?= h($grand_total_sale_bal) ?></b></td>
								<td ><b>Total Wastage</b></td>
								<td align="right"><b><?= h($grand_total_wastage_bal) ?></b></td>
								<td ><b>Total Weight Variation</b></td>
								<td align="right"><b><?= h($grand_total_weight_bal) ?></b></td>
								<td ><b>Total Closing</b></td>
								<td align="right"><b><?= h($grand_total_closing_bal) ?></b></td>
							</tr>
							
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