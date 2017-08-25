
<?php 

	$date= date("d-m-Y"); 
	$time=date('h:i:a',time());

	$filename="CONSOLIDATE REPORT_".$date.'_'.$time;

	header ("Expires: 0");
	header ("Last-Modified: " . gmdate("D,d M YH:i:s") . " GMT");
	header ("Cache-Control: no-cache, must-revalidate");
	header ("Pragma: no-cache");
	header ("Content-type: application/vnd.ms-excel");
	header ("Content-Disposition: attachment; filename=".$filename.".xls");
	header ("Content-Description: Generated Report" );

?>
				<table border="1">
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
							$totalPurchaseQuantity=round($detail->totalPurchaseQuantity, 2);
							$totalPurchaseAmount=round($detail->totalPurchaseAmount, 2);;
							$totalOrderSale=round($detail->totalOrderSale, 2);
							$totalWalkinSale=round($detail->totalWalkinSale, 2);
							$totalOrderAmount=round($detail->totalOrderAmount, 2);
							$totalWalkinAmount=round($detail->totalWalkinAmount, 2);
							$totalwasteWarehouse=round($detail->totalwasteWarehouse, 2);
							$totalWeightVariation=round($detail->totalWeightVariation, 2);
							
							$per_item_average_amount=round(($totalPurchaseAmount/$totalPurchaseQuantity), 2);
							
							if(is_nan($per_item_average_amount)){
								$per_item_average_amount=0;
							}
							//$purchase_amount_total=$totalPurchaseQuantity*$per_item_average_amount;
							$opening_balance_qty=$opening_balance_quantity[$item_id];
							$opening_balance_amt=$opening_balance_amount[$item_id];
							
							$opening_item_average_amount=round(($opening_balance_amt/$opening_balance_qty), 2);
							if(is_nan($opening_item_average_amount)){
								$opening_item_average_amount=0;
							}
							$total_opening_balance_amount=round($opening_balance_qty*$opening_item_average_amount, 2);
							
							$total_sales_quantity=$totalOrderSale+$totalWalkinSale;
							$total_sales_amount=$totalOrderAmount+$totalWalkinAmount;
							
							
							$total_waste_quantity=$totalwasteWarehouse+$totalWeightVariation;
							$total_waste_amount=round($totalwasteWarehouse*$per_item_average_amount, 2);
							$total_weight_variation_amount=round($totalWeightVariation*$per_item_average_amount, 2);
							
							$total_in_quantity=$totalPurchaseQuantity+$opening_balance_qty;
							$total_out_quantity=$total_sales_quantity+$totalwasteWarehouse+$totalWeightVariation;
							$closing_balance_quantity=round(($total_in_quantity-$total_out_quantity), 2);
							 
							$total_in_amount=$totalPurchaseAmount+$total_opening_balance_amount;
							$total_out_amount=$total_waste_amount+$total_weight_variation_amount+$total_sales_amount;
							$closing_balance_amount=round(($total_in_amount-$total_out_amount), 2);
							
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
									<?= h($total_opening_balance_amount)?>
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
							<!--tr>
								<td colspan="3" align="right"><b>Total Wastage Amount</b></td>
								<td align="right"><b><?php //h($total_wastage_amount) ?></b></td>
							</tr-->
					</tbody>
				</table>