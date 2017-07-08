	<div style="">
	<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
		<table class=" table-striped table-condensed table-hover  scroll" width="100%" border="0">
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
					<b>Address: </b><?= $order->customer_address->name ?><br><b>Mobile:</b> <?= $order->customer_address->mobile ?><br><?= $order->customer_address->house_no ?> &nbsp;<?= $order->customer_address->address ?>,&nbsp;<?= $order->customer_address->locality ?><br>	
					</td>
				</tr>
				<tr style="background-color:#F98630; color:#fff;">
					<th style="text-align:center;"><label><strong>#</strong></label></th>
					<th style="text-align:center;"><label><strong>Image</strong></label></th>
					<th style="text-align:center;"><label><strong>Item Name</strong></label></th>
					<th style="text-align:center;"><label><strong>QTY</strong></label></th>
					<th style="text-align:center;"><label><strong>Actual QTY</strong></label></th>
					<th style="text-align:center;"><label><strong>Amount</strong></label></th>
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
					$amount=$order_detail->amount;
					@$total_rate+=$amount;
					if(!empty($alias_name)){
						$show_item=$item_name.' ('.$alias_name.')';
					}else{
						$show_item=$item_name;
					} ?>
				<tr style="background-color:#fff;">
					<td><?= $i ?></td>
					<td align="center">
						<?php echo $this->Html->image('/img/item_images/'.$image, ['height' => '40px', 'width'=>'40px', 'class'=>'img-rounded img-responsive']); ?>
					</td>
					<td style="text-align:center;"><?= h($show_item) ?></td>
					<td style="text-align:center;"><?= h($show_quantity) ?></td>
					<td style="text-align:center;"><?= h($show_quantity) ?></td>
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
					<td align="right"><b>Total Paid</b></td>
					<td align="center"><b><?= h($pay_amount) ?></b></td>
				</tr>
			</tbody>
		</table>
	</div>
