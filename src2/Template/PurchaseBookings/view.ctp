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
}
</style>
<style type="text/css" media="print">
@page {
    size: auto;   /* auto is the initial value */
    margin: 0 5px 0 20px;  /* this affects the margin in the printer settings */
}
</style>
<a class="btn  blue hidden-print margin-bottom-5 pull-right" onclick="javascript:window.print();">Print <i class="fa fa-print"></i></a>

<div style="border:solid 1px #c7c7c7;background-color: #FFF;padding: 10px;margin: auto;width: 55%;font-size: 12px;" class="maindiv">	
	<table width="100%" class="divHeader">
		
		<tr>
			<td colspan="3"><div style="font-size: 18px" align="center">Purchase Booking Voucher</div>
				<div style="border:solid 2px #0685a8;margin-bottom:5pxe;margin-top: 5px;"></div>
			</td>
		</tr>
	</table>
	<table width="100%">
		<tr>
			<td width="50%" valign="top" align="left">
				<table>
					<tr>
						<td>Voucher No.</td>
						<td width="20" align="center">:</td>
						<td><?= h('#'.str_pad($this->Number->format($purchaseBooking->voucher_no), 4, '0', STR_PAD_LEFT)) ?></td>
					</tr>
					<tr>
						<td>G.R.N. No.</td>
						<td width="20" align="center">:</td>
						<td ><?= h('#'.str_pad($this->Number->format($purchaseBooking->grn_id), 4, '0', STR_PAD_LEFT)) ?></td>
						
					</tr>
					<tr>
						<td>Vendor</td>
						<td width="20" align="center">:</td>
						<td ><?= h($purchaseBooking->vendor->name)  ?></td>
						
					</tr>
				</table>
			</td>
			<td width="50%" valign="top" align="right">
				<table>
					<tr>
						<td>Transaction Date</td>
						<td width="20" align="center">:</td>
						 <td><?= h($purchaseBooking->transaction_date) ?></td>
					</tr>
			
					<tr>
						<td>Created On</td>
						<td width="20" align="center">:</td>
						<td ><?= h($purchaseBooking->created_on) ?></td>
						
					</tr>
			
				</table>
				
			</td>
			
		</tr>
	</table>
	
			
	
	<table width="100%">
		<tr>
			<td width="50%" valign="top" align="right"></td>
			<td width="50%" valign="top" align="right">
				
			</td>
		</tr>
	</table>
	
	<table width="100%">
		<tr>
			<td width="50%" valign="top" align="right"></td>
			<td width="50%" valign="top" align="right">
				<table>
					
				</table>
			</td>
		</tr>
	</table>
	<br/>
	<table width="100%" class="table" style="font-size:12px" align="center">
		<tr >
			<td ><strong><?= __('S.N.') ?></strong></td>
			<td ><strong><?= __('Item') ?></strong></td>
			<td ><strong><?= __('Unit') ?></strong></td>
			<td ><strong><?= __('Quantity') ?></strong></td>
			<td ><strong><?= __('Rate') ?></strong></td>
			<td align="right"><strong><?= __('Amount') ?></strong></td>	
		</tr>
		
		<?php 
		$i=0;
		$total=0;
		foreach ($purchaseBooking->purchase_booking_details as $data){
			?>
			
			<tr>
			<td ><?=h(++$i)?></td>
			<td ><?= h($data->item->name) ?></td>
			<td ><?=h($data->item->unit->longname)?></td>
			<td ><?=h($data->quantity)?></td>
			<td ><?=h($data->rate)?></td>
			<td align="right"><?=h($data->amount)?></td>
			</tr>
		<?php
		$total=$total+$data->amount;
		} ?>
	</table>
	
	
	
	<div style="border:solid 1px ;"></div>
	<table width="100%" >
		<tr align="right">
				<td><b>Total</b></td><td width="10%"><?=h($total)?></td></tr></table>
	<table width="100%" class="divFooter">
		
			 <tr align="right">
			 <td align="right" valign="top" width="35%">
				<table style="margin-top:3px;">
					<tr>
					   <td width="15%" align="right"> 
						<br>
						<br>
						 <span>Prepared By</span><br/>
						 <span><b><?= __('Jain Thela') ?></b></span><br/>
						</td>
					</tr>
				</table>
			 </td>
			
		    
		</tr>
	</table>
</div>
</div>
