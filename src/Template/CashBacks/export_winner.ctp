<?php 

	$date= date("d-m-Y"); 
	$time=date('h:i:a',time());

	$filename="Cash_back_winner_".$date.'_'.$time;

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
							<th>Sr No</th>
							<th scope="col">#</th>
							<th scope="col">Customer Name</th>
							<th scope="col">Cash Back No.</th>
							<th scope="col">Order No.</th>
							<th scope="col">Winning Amount</th>
							<th scope="col">Winning Date</th>
							<th scope="col">Claimed/Not Claimed</th>
							<th scope="col">Notification/SMS Sent</th>
						</tr>
					</thead>
					<tbody>
						
						<?php
						$num_rows=1; $i=1;$total_amt=0;
						foreach($fetch_cashback_win_details as $cb){
						$num_rows++;
						}
						$sr_no=0; foreach ($fetch_cashback_win_details as $cb): 
						$color=intval(256*$sr_no/($num_rows-1));
						
						$sr_no++;
						$customer_name=$cb->customer->name;
						$customer_mobile=$cb->customer->mobile;
						$firstCharacter = substr($customer_name, 0, 1);
						$total_amt+=$cb->amount;
						?>
						<tr>
							<td><?php echo $i++;?></td>
							<td><?php if($cb->claim=='yes'){ ?><?php echo '<span class="badge badge-success tooltips">'?>
							<?php } else {?><?php echo '<span class="badge badge-warning tooltips">'?>
							<?php } ?><?= h(ucwords($firstCharacter)) ?><?php echo '</span>'; ?></td>
							<td><?= h(ucwords($customer_name).' ('.$customer_mobile.')') ?></td>
							<td><?= h('#'.str_pad($cb->cash_back_no, 4, '0', STR_PAD_LEFT)) ?></td>
							<td><?= h($cb->order_no) ?></td>
							<td><?php echo $this->Number->format($cb->amount,['places'=>2]); ?></td>
							<td><?= h(date('d-m-Y',strtotime($cb->winning_date))) ?></td>
							<td><?php if($cb->claim=='yes'){ ?><a class="btn green btn-xs" >Claimed</a><?php } else {?><a class="btn red btn-xs" >Not Claimed</a><?php } ?>
							</td>	
							<td><?= h($cb->sms_sent) ?></td>
							
						</tr>
						<?php endforeach; ?>
						<tr>
							<td colspan="5" align="right"><b>Total</b></td><td><b><?php echo $this->Number->format($total_amt,['places'=>2]); ?></b></td>
						</tr>
					</tbody>
				</table>
	
					
