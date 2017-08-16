<?php 

	$date= date("d-m-Y"); 
	$time=date('h:i:a',time());

	$filename="Cash_back_details_".$date.'_'.$time;

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
							<th scope="col">S.No</th>
							<th scope="col">Customer Name</th>
							<th scope="col">Order No.</th>
							<th style="text-align:right;" scope="col">Amount</th>
							<th scope="col">CashBack(%)</th>
							<th scope="col">CashBack(Limit)</th>
							<th scope="col">Won</th>
							<th scope="col">Claim</th>
							<th scope="col">Created On</th>
						</tr>
					</thead>
					<tbody>
						<?php
						$sr_no=0; foreach ($cashBacks as $cb): $sr_no++;
						$created_on=date('d-m-Y', strtotime($cb->created_on));
						$customer_name=ucwords($cb->customer->name);
						$customer_mobile=$cb->customer->mobile;
						if($cb->won=='yes')
						{
							$winner='YES';
						}
						else if($cb->won=='no')
						{
							$winner='NO';
						}
						
						if($cb->claim=='yes')
						{
							$claimed='YES';	
						}
						else if($cb->claim=='no')
						{
							$claimed='NO';
						}
						
						?>
						<tr >
							<td><?= h($sr_no) ?></td>
							<td><?= h(@$customer_name.' ('.@$customer_mobile.')') ?></td>
							<td><?= h(@$cb->order_no) ?></td>
							<td align="right"><?= h(@$cb->amount) ?></td>
							<td><?= h(@$cb->cash_back_percentage . '%') ?></td>
							<td><?= h('After '.@$cb->cash_back_limit . ' Cashback ids') ?></td>
							<td class="<?php echo @$winner;?>"><b><?= h(@$winner) ?></b></td>
							<td class="<?php echo @$claimed;?>"><b><?= h(@$claimed) ?></b></td>
							<td><?= @$created_on ?></td>
						</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
				
