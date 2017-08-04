<?php 

	$date= date("d-m-Y"); 
	$time=date('h:i:a',time());

	$filename="Item_stock_report_".$date.'_'.$time;

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
							<th>Sr</th>
							<th>Item</th>
							<th>Driver Stock</th>
							<th>Warehouse Stock</th>
							<th>Current Stock</th>
						</tr>
					</thead>
					<tbody id='main_tbody' class="tab">
						<?php foreach($itemLedgers as $itemLedger){
							
								$item_freeze=$itemLedger->item->freeze;
								if($item_freeze==1){
									continue;
								}
								$driver_stock=$itemLedger->totalInDriver-$itemLedger->totalOutDriver;
								$warehouse_stock=$itemLedger->totalInWarehouse-$itemLedger->totalOutWarehouse;
								@$i++;
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
											<?= $driver_stock+$warehouse_stock.' '.$itemLedger->item->unit->shortname ?>
										</td>
									</tr>
								<?php } ?>
							</tbody>
				</table>
				
