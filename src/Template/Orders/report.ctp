<head>

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
</head>
<a class="btn  blue hidden-print margin-bottom-5 pull-right" onclick="javascript:window.print();">Print <i class="fa fa-print"></i></a>

	 <div id="header" ><br/>	
		<table width="100%" style="border:solid 1px ;">
			<tr><td></td><td align="center" style="font-size:18px;"><b>SHRINAKODA  AGROPRODUCT  PRIVATE  LIMITED</b></td></tr>
			<tr>
				<td align="right"  >
				<?php echo $this->Html->image('/img/jain-thela-app-icon.png', ['height' => '90px']); ?></td>
				<td align="center" style="font-size:16px;"><b> 15 - 16 Nr. Eicher Service Center, Aapni Dhani,</br> Pratap Nagar Udaipur Rajasthan - 313001</br> TEL : 08947839199 </br> E-mail : info@jainthela.com</br> GSTIN : 08AAXCS7570B1ZU</b></td>
			</tr>
			
			<tr>
				<td colspan="2" >
					<div style="border:solid 1px ;margin-top: 5px; margin-top:15px;"></div>
					<div style="border:solid 1px ;margin-top: 5px; margin-top:15px;"></div>
				</td>
			</tr>
			<tr>
				<td colspan="2"><div style="font-size:26px" align="center"><b>Tax Invoice</b></div>
				</td>
			</tr>
		</table>
  </div>
	<table width="100%" class="divHeader" style="border:1px solid;">
		<tr>
			<td width="50%" valign="top" align="left">
				<table width="100%" class= "table table-bordered" style="font-size:12px;border:1px solid;">	
					<tr>
						<td>Invoice No.: <?= h($order->order_no) ?></td>
					</tr>
					<tr>
						<td>Transaction Date :  <?= date('d-m-Y',strtotime($order->order_date)) ?></td>
					</tr>
					<tr>
						<td>Reverse Charge(Y/N) :  </td>
					</tr>
					<tr>
						<td>State : Rajasthan  |  Pincode : 313001</td>
					</tr>
				</table>
			</td>
			<td width="50%" valign="top" align="right">
				<table width="100%"  class= "table table-bordered" style="font-size:12px;border:1px solid;">	
					<tr> 
						<td>Transport Mode : </td>
					</tr>
					<tr>
						<td>Vehicle number : </td>
					</tr>
					<tr>
						<td>Date of supply : </td>
					</tr>
					<tr>
						<td>Place of supply : </td>
					</tr>
				</table>
			</td>
		</tr>
		
	</table>
	<table width="100%" class="divHeader" style="border:1px solid;">
		<tr>
			<td width="50%" valign="top" align="left">
				<table width="100%"  class= "table table-bordered" style="font-size:12px;border:1px solid;">	
					<tr>
						<td align="center" style="font-size:14px;"><b>Bill to Party</b></td>
					</tr>
					<tr> 
						<td>Name : </td>
					</tr>
					<tr>
						<td>Address : </td>
					</tr>
					<tr rowspan="2">
						<td>GSTIN : </td>
					</tr>
					<tr>
						<td>State : Rajasthan  |  Pincode : 313001</td>
					</tr>
				</table>
			</td>
			<td width="50%" valign="top" align="right">
				<table width="100%" class= "table table-bordered" style="font-size:12px;border:1px solid;">	
					<tr>
						<td align="center" style="font-size:14px;"><b>Ship to Party</b></td>
					</tr>
					<tr> 
						<td>Name : </td>
					</tr>
					<tr>
						<td>Address : </td>
					</tr>
					<tr rowspan="2">
						<td>GSTIN : </td>
					</tr>
					<tr>
						<td>State : Rajasthan  |  Pincode : 313001</td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td colspan="2" >
					<div style="border:solid 1px;"></div>
					<div style="border:solid 1px ;margin-top: 5px;"></div>
			</td>
		</tr>
	</table>
	<div style="border:solid 1px;">
	<table width="100%" class="table table-bordered" style="border:1px solid;">
	<tr >
			<th><?= __('S.N.') ?></th>
			<th><?= __('Product Description') ?></th>
			<th><?= __('HSN code') ?></th>
			<th><?= __('UOM') ?></th>
			<th><?= __('Qty') ?></th>
			<th><?= __('Rate') ?></th>
			<th><?= __('Amount') ?></th>
			<th><?= __('Discount') ?></th>
			<th><?= __('Taxable Value') ?></th>
			<th colspan="2" align="center"><?= __('CGST') ?></th>
			<th colspan="2" align="center"><?= __('SGST') ?></th>
			<th><?= __('Total') ?></th>
		</tr>
		<tr >
		<th colspan="9"></td>
			<th>Rate</th><th>Amount</th>
			<th>Rate</th><th>Amount</th>
			<th></th>
		<tr>
		
		<?php 
		$i=0;
		foreach ($order->order_details as $order_detail){
			?>
			<tr>
			<td><?=h(++$i)?></td>
			<td><?= h($order_detail->item->name) ?></td>
			<td></td>
			<td> </td>
			<td ><?=h($order_detail->quantity)?></td>
			<td ><?=h($order_detail->rate)?></td>
			<td ><?=h($order_detail->amount)?></td>
			<td></td>
			<td> </td>
			<td></td>
			<td> </td>
			<td></td>
			<td> </td>
			<td ><?=h($order_detail->amount)?></td>
			</tr>
			<?php } ?>
			<tr>
			</tr>
			<tr>
			<td colspan="3" align="center" style="font-size:20px;"><b>TOTAL</b></td>
			<td></td>
			<td></td>
			<td style="font-size:14px;"><b><?=h($order->total_amount)?></b></td>
			<td>0</td>
			<td></td>
			<td></td><td></td>
			<td></td>
			<td></td>
			<td></td>
			<td style="font-size:14px;"><b><?=h($order->total_amount)?></b></td>
			</tr>
			<tr >
			<td colspan="9" align="center" style="font-size:14px;"><b>Total Invoice amount in words </b></td>
			<td colspan="4"  style="font-size:14px;"><b>Total Amount before Tax</b></td>
			<td style="font-size:14px;"><b></b></td>
			</tr>
			<tr ><td  rowspan ="4" colspan="9"></td>
			<td colspan="4"  style="font-size:14px;"><b>Add:CGST</b></td>
			<td></td> 
			</tr>
			<tr>
			
			<td colspan="4"  style="font-size:14px;"><b>Add:SGST</b></td>
			<td></td>
			</tr>
			<tr>
			
			<td colspan="4"  style="font-size:14px;"><b>Total Tax Amount</b></td>
			<td></td>
			</tr>
			<tr>
			
			<td colspan="4"  style="font-size:14px;"><b>Total Amount after Tax</b></td>
			<td></td>
			</tr>
	
		
		<tr>
			 <td colspan="6" style="font-size:14px;" align="center"> Bank Details</td>
			 <td colspan="3" rowspan="5" style="font-size:14px;"></td>
			 <td  colspan="4" style="font-size:14px;"><b>GST on Reverse Charge</b></td>
		</tr>
		<tr>
			<td colspan="6" style="font-size:14px;"> Bank Name : Canara Bank</td>
			<td colspan="5" align="center" style=" border: 0px #fff" >Certified that the particulars given above are true and correct </br>
			
		</tr>	
		<tr>
			<td colspan="6" style="font-size:14px;"> Bank A/c  : 2982214000019 </td>
			<td colspan="5" align="center" style=" border: none;"><b> For SHRINAKODA AGROPRODUCT PRIVATE LIMITED</b></td>
		</tr>
		<tr>
			<td colspan="6" style="font-size:14px;"> Bank IFSC : CNRB0002982 </td>
		
		</tr>
		<tr>
			<td rowspan="4"  colspan="6" align="center" style="font-size:14px;"> Terms & Conditions</br>
			</td>
			
		</tr>
		<tr></tr>
		<tr></tr>
		<tr>
			<td colspan="3" valign="bottom" style="font-size:14px;" align="center">Common Seal</td>
			<td colspan="5" align="center" style="border-top:0px;"> Authorised Signatory</td>
		</tr>
		
		
	</table>
	</div>



