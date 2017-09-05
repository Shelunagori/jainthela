<style>

@media print{
	.maindiv{
		width:100% !important;
	}	
	.hidden-print{
		display:none;
	}
}
p{
margin-bottom: 0;
}
.table > thead > tr > th, .table > tbody > tr > th, .table > tfoot > tr > th, .table > thead > tr > td, .table > tbody > tr > td, .table > tfoot > tr > td {
    padding: 5px !important;
	font-family:Lato !important;
}
</style>

<style type="text/css" media="print">
@page {
    size: auto;   /* auto is the initial value */
    margin: 0px 0px 0px 0px;  /* this affects the margin in the printer settings */
}
</style>
<div style="border:solid 1px #c7c7c7;background-color: #FFF;padding:10px;width: 100%;font-size:14px;" class="maindiv">	

<div align="center" style="color:#F98630; font-size: 16px;font-weight: bold;">Stock Return Voucher</div>
	<div style="border:solid 2px #F98630; margin-bottom:0px;"></div>
		<table width="100%" style="margin-top:20px;" >	
			
			<tbody>
				<tr style="background-color:#fff; color:#000;">
					<td align="left" colspan="6">
						
						<b>
							Driver: <?= h(ucwords($stockReturnVoucher->driver->name)) ?>
						</b>
					</td>
				</tr>
				<tr style="background-color:#fff; color:#000;">
					<td align="left" colspan="6">
						<b>
							Voucher No.: <?= h('#'.str_pad(number_format($stockReturnVoucher->id),6, '0', STR_PAD_LEFT)) ?>
						</b>
					</td>
				</tr>
				<tr style="background-color:#fff; color:#000;">
					
						<td align="left" colspan="6">
						<b>
							Amount Receivable: <?= $this->Number->format($stockReturnVoucher->amount_receivable) ?>
						</b>
					</td>
				</tr>
				<tr style="background-color:#fff; color:#000;">
					<td align="left" colspan="6">
						<b>
							Amount Received:  <?= $this->Number->format($stockReturnVoucher->amount_received) ?>
						</b>
					</td>
				</tr>
				
				<tr style="background-color:#fff; color:#000;">
					
					<td align="left" colspan="6">
						<b>
							Date.: <?= h($stockReturnVoucher->created_on_date) ?>
						</b>
					</td>
				</tr>
				
				<tr style="background-color:#fff; color:#000;margin-top:20px;">
					
				</tr>
			</table>
			<table class="table table-bordered"width="100%" style="margin-top:20px;">
				<thead>
				<tr >
					<th style="text-align:right;">#</th>
					<th style="text-align:left;">Item Name</th>
					<th style="text-align:center;">QTY</th>
				</tr>
				</thead>
				
				
				 <?php foreach ($stockReturnVoucher->item_ledgers as $itemLedgers): 
					@$i++;
					$item_name=$itemLedgers->item->name;
					$show_quantity=$itemLedgers->quantity.' '.$itemLedgers->item->unit->unit_name;
				?>	
				<tr style="background-color:#fff;">
					<td align="right"><?= $i ?></td>
					
					<td style="text-align:left;"><?= h($item_name) ?></td>
					<td style="text-align:center;"><?= h($show_quantity) ?></td>
				</tr>
				<?php endforeach ?>
				
			</tbody>
		
		</table>
	</div>
