<style>

@media print{
	.maindiv{
		width:100% !important;
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

<div style="border:solid 1px #c7c7c7;background-color: #FFF;padding:10px;margin-top: -10px;width: 100%;font-size:14px;" class="maindiv">	
<button type="button" class="close hidden-print" data-dismiss="modal" aria-hidden="true"></button>
<div align="center" style="color:#F98630; font-size: 16px;font-weight: bold;">ORDERS</div>
	<div style="border:solid 2px #F98630; margin-bottom:15px;"></div>
		<table width="100%">	
			<thead>
				<tr style="background-color:#fff; color:#000;">
					<td align="left" colspan="5">
						<b>
							Customer Order No.: <?= $order->order_no ?>
						</b>
					</td>
				</tr>
				<tr style="background-color:#fff; color:#000;">
					<td align="left" colspan="5">
					<b>Address: </b><?= h(@$order->customer_address->name) ?><br><b>Mobile:</b> <?= h(@$order->customer_address->mobile) ?><br><?= h(@$order->customer_address->house_no) ?> &nbsp;<?= h(@$order->customer_address->address) ?>,&nbsp;<?= h(@$order->customer_address->locality) ?><br>	
					</td>
				</tr>
				<tr style="background-color:#F98630; color:#fff;">
					<th style="text-align:right;">#</th>
					<th style="text-align:center;">Image</th>
					<th style="text-align:left;">Item Name</th>
					<th style="text-align:center;">QTY</th>
					<th style="text-align:center;">Actual QTY</th>
					<th style="text-align:center;">Amount</th>
				</tr>
				
			</thead>
			<tbody>
				<?php
				foreach($order->order_details as $order_detail ){ 
					@$i++;
					$quantity=$order_detail->quantity;
					$actual_quantity=$order_detail->actual_quantity;
					$minimum_quantity_factor=$order_detail->item->minimum_quantity_factor;
					$unit_name=$order_detail->item->unit->unit_name;
					$image=$order_detail->item->image;
					$item_name=$order_detail->item->name;
					$alias_name=$order_detail->item->alias_name;
					$show_quantity=$quantity.' '.$unit_name;
					if(!empty($actual_quantity)){
					$show_actual_quantity=$actual_quantity.' '.$unit_name;
					}
					else{
					$show_actual_quantity='-';
					}
					$amount=$order_detail->amount;
					@$total_rate+=$amount;
					if(!empty($alias_name)){
						$show_item=$item_name.' ('.$alias_name.')';
					}else{
						$show_item=$item_name;
					} ?>
				<tr style="background-color:#fff;">
					<td align="right"><?= $i ?></td>
					<td align="center">
						<?php echo $this->Html->image('/img/item_images/'.$image, ['height' => '40px', 'width'=>'40px', 'class'=>'img-rounded img-responsive']); ?>
					</td>
					<td style="text-align:left;"><?= h($show_item) ?></td>
					<td style="text-align:center;"><?= h($show_quantity) ?></td>
					<td style="text-align:center;"><?= h($show_actual_quantity) ?></td>
					<td style="text-align:center;"><?= h($amount) ?></td>
				</tr>
				<?php } ?>
				<?php
				$amount_from_promo_code=$order->amount_from_promo_code;
				$delivery_charge=$order->delivery_charge;
				$amount_from_jain_cash=$order->amount_from_jain_cash;
				$online_amount=$order->online_amount;
				$amount_from_wallet=$order->amount_from_wallet;
				$pay_amount=$order->pay_amount;
				$status=$order->status;
				$grand_total=@$total_rate+$delivery_charge;
				?>
				<tr style="background-color:#fff; border-top:1px solid #000">
					<td colspan="4">&nbsp;</td><td align="right"><b>Amount</b></td>
					<td align="center"><b><?= h(@$total_rate) ?></b></td>
				</tr>
				
				<?php if(!empty($delivery_charge)){ ?>
				<tr style="background-color:#fff;">
					<td colspan="4">&nbsp;</td>
					<td align="right"><b>Delivery Charge</b></td>
					<td align="center"><b><?= h($delivery_charge) ?></b></td>
				</tr>
				<?php } ?>
				<tr style="background-color:#F5F5F5; border-top:1px solid #000; border-bottom:1px solid #000">
					<td colspan="4">&nbsp;</td>
					<td align="right"><b>Total Amount</b></td>
					<td align="center"><b><?= h($grand_total) ?></b></td>
				</tr>
			
				<?php if(!empty($amount_from_jain_cash)){ ?>
				<tr style="background-color:#fff; border-top:1px solid #000">
					<td colspan="4">&nbsp;</td>
					<td align="right"><b>Jain Cash</b></td>
					<td align="center"><b><?= h($amount_from_jain_cash) ?></b></td>
				</tr>
				<?php } ?>
				
				<?php if(!empty($online_amount)){ ?>
				<tr style="background-color:#fff;">
					<td colspan="4">&nbsp;</td>
					<td align="right"><b>Online Payment</b></td>
					<td align="center"><b><?= h($online_amount) ?></b></td>
				</tr>
				<?php } ?>
				
				<?php if(!empty($amount_from_wallet)){ ?>
				<tr style="background-color:#fff;">
					<td colspan="4">&nbsp;</td>
					<td align="right"><b>Wallet Payment</b></td>
					<td align="center"><b><?= h($amount_from_wallet) ?></b></td>
				</tr>
				<?php } ?>
				
				<?php if(!empty($amount_from_promo_code)){ ?>
				<tr style="background-color:#fff;">
					<td colspan="4">&nbsp;</td>
					<td align="right"><b>Promo code</b></td>
					<td align="center"><b><?= h($amount_from_promo_code)?></b></td>
				</tr>
				<?php } ?>
			
				<tr style="background-color:#F5F5F5; border-top:1px solid #000; border-bottom:1px solid #000">
					<td colspan="4">&nbsp;</td>
					<td align="right">
						<b>
						<?php if(($status=='Delivered') || ($status==' Delivered')){ ?>
							Total Paid
						<?php }else{ ?>
							Due
						<?php } ?>
						</b></td>
					<td align="center"><b><?= h($pay_amount) ?></b></td>
				</tr>
			</tbody>
			<tfoot>
				<tr>
					<td colspan="2"><b>Deliver Time Between:-</b></td>
					<td colspan="2"><b><?= h($order->delivery_time) ?></b></td>
				</tr>
				<tr>
				<td colspan="6"><a class="btn  blue hidden-print margin-bottom-5 pull-right" onclick="javascript:window.print();">Print <i class="fa fa-print"></i></a>
				</td>
				</tr>
			</tfoot>
		</table>
	</div>
