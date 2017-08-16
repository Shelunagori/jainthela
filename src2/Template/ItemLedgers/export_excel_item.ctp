<?php 

	$date= date("d-m-Y"); 
	$time=date('h:i:a',time());

	$filename="Item_issue_report_".$date.'_'.$time;

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
							<th>Sr.no</th>
							<th>Date</th>
							<th>Time</th>
							<th>Driver</th>
							<th>Item</th>
							<th>Issue</th>
							<th>Return</th>
						</tr>
					</thead>
					<tbody>
						<?php $sr_no=0; foreach ($item_ledgers as $item_ledger): 
						
						$transaction_date=$item_ledger->transaction_date;
						$org_transaction_date=date('d-M-Y');
						$created_on=$item_ledger->created_on;
						
						$order_time=date('h:i a', strtotime($created_on));
						$status=$item_ledger->status;
						$quantity=$item_ledger->quantity;
						@$driver_name=$item_ledger->driver->name;
						$item_name=$item_ledger->item->name;
						$unit_name=$item_ledger->item->unit->unit_name;
						?>
						<tr>
							<td><?= $this->Number->format(++$sr_no) ?></td>
							<td><?= h($org_transaction_date) ?></td>
							<td><?= h($order_time) ?></td>
							<td><?= h($driver_name) ?></td>
							<td><?= h($item_name) ?></td>
							<?php if($status=='In'){ ?>
								<td align="right"><?= h($quantity.' '.$unit_name) ?></td>
								<td></td>
							<?php }	if($status=='out'){ ?>
								<td></td>
								<td align="right"><?= h($quantity.' '.$unit_name) ?></td>
							<?php } ?>
						</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
				
