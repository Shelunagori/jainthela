<?php 

	$date= date("d-m-Y"); 
	$time=date('h:i:a',time());

	$filename="Stock Voucher_return_report_".$date.'_'.$time;

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
							<th>Voucher No.</th>
							<th>Created Date</th>
							<th>Driver Name</th>
							<th style="text-align:right;">Amount Receivable</th>
							<th style="text-align:right;">Amount Received</th>
							
						</tr>
					</thead>
					<tbody>
					
            <?php @$sr_no =0; foreach ($stockReturnVouchers as $stockReturnVoucher):
			if($stockReturnVoucher->amount_received > 0){ ?>
            <tr>
                <td><?= $this->Number->format(++$sr_no) ?></td>
				
				<td><?php echo $this->Html->link('#'.str_pad(number_format($stockReturnVoucher->id),6, '0', STR_PAD_LEFT),['controller'=>'StockReturnVouchers','action' => 'view', $stockReturnVoucher->id],['target'=>'_blank']); ?></td>
                 <td><?= h($stockReturnVoucher->created_on_date) ?></td>
				 <td><?= h($stockReturnVoucher->driver->name) ?></td>
                <td align="right"><?= $this->Number->format($stockReturnVoucher->amount_receivable) ?></td>
                <td align="right"><?= $this->Number->format($stockReturnVoucher->amount_received) ?></td>
				
            </tr>
            <?php } endforeach; ?>
        </tbody>
    </table>