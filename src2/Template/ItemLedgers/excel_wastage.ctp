<?php 

	$date= date("d-m-Y"); 
	$time=date('h:i:a',time());

	$filename="Wastage_item_report_".$date.'_'.$time;

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
							<th>Sr.No.</th>
							<th>Item Name</th>
							<th>Wastage Quantity</th>
						</tr>
					</thead>
					<tbody>
						<?php $page_no=1; foreach ($wastageItems as $wastageItem):  ?>
							<tr>
								<td>
									<?= h(++$page_no) ?>
								</td>
								<td>
									<?= h($wastageItem->item->name).'('.$wastageItem->item->alias_name.')'  ?>
								</td>
								<td>
									<?= h($wastageItem->totalOutWarehouse.$wastageItem->item->unit->unit_name)?>
								</td>
							</tr>
							
						<?php endforeach;?>
					</tbody>
				</table>
				
