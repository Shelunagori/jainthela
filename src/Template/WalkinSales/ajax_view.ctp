	<div style="">
	<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
	</br>
	<table width="100%">
		<tr>
			<td width="50%" valign="top" align="left">
				<table>
					<tr>
						<td>Name</td>
						<td width="20" align="center">:</td>
						<td><?= h($walkinSales->name).'('. h($walkinSales->mobile).')' ?></td>
					</tr>
					<tr>
						<td>Transaction Date</td>
						<td width="20" align="center">:</td>
						 <td><?= h($walkinSales->transaction_date) ?></td>
					</tr>
					<tr style="background-color:#fff; color:#000;">
						<td>Order No.</td>
						<td width="20" align="center">:</td>
						 <td><b><?= $walkinSales->order_no ?></b></td>
						
					</tr>
				</table>
			</td>
		</tr>
	</table>
	</br>
		<table class=" table-striped table-condensed table-hover  scroll" width="100%" border="0">
			<thead>
				
				<tr style="background-color:#F98630; color:#fff;">
					<th style="text-align:center;">#</th>
					<th style="text-align:center;">Image</th>
					<th style="text-align:left;">Item Name</th>
					<th style="text-align:center;">QTY</th>
					<th style="text-align:center;">Rate</th>
					<th style="text-align:center;">Amount</th>
				</tr>
			</thead>
			<tbody>
			<?php
$total=0;
$i=0;
			foreach ($walkinSales->walkin_sale_details as $walkinSale){
			$i++;
			$total+=$walkinSale->amount;
			$quantity=$walkinSale->quantity;
			$unit_name=$walkinSale->item->unit->unit_name;
			$show_quantity=$quantity.' '.$unit_name;
			?>
			<tr>
			<td  align="center"><?=h($i)?></td>
			<td align="center">
			<?php echo $this->Html->image('/img/item_images/'.$walkinSale->item->image, ['height' => '40px', 'width'=>'40px', 'class'=>'img-rounded img-responsive']); ?>
			</td>
			<td><?= h($walkinSale->item->name) ?></td>
			<td align="center"><?= h($show_quantity) ?></td>
			<td  align="center"><?=h($walkinSale->rate)?></td>
			<td align="center"><?=h($walkinSale->amount)?></td>
			</tr>
			
		<?php } ?>
<tr>
<td colspan="4" >&nbsp;</td>
<td align="right">Total</td>
<td  align="center"><?=h($total)?></td></tr>

	</table>
	</div>
