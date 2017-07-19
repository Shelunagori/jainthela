	<div style="">
	<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
	<table width="100%">
		<tr>
			<td width="50%" valign="top" align="left">
				<table>
					<tr>
						<td>Name</td>
						<td width="20" align="center">:</td>
						<td><?= h($walkinSales->name) ?></td>
					</tr>
					<tr>
						<td>Mobile No.</td>
						<td width="20" align="center">:</td>
						<td ><?= h($walkinSales->mobile) ?></td>
					</tr>
				</table>
			</td>
			<td width="50%" valign="top" align="right">
				<table>
					<tr>
						<td>Transaction Date</td>
						<td width="20" align="center">:</td>
						 <td><?= h($walkinSales->transaction_date) ?></td>
					</tr>
					<tr>
						<td>Warehouse</td>
						<td width="20" align="center">:</td>
						<td><?= h(@$walkinSales->warehouse->name)?></td>
					</tr>
				</table>
			</td>
		</tr>
	</table>
		<table class=" table-striped table-condensed table-hover  scroll" width="100%" border="0">
			<thead>
				<tr style="background-color:#fff; color:#000;">
					<td align="left" colspan="5">
						<b>
						Order No.: <?= $walkinSales->order_no ?>
						</b>
					</td>
				</tr>
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

			?>
			<tr>
			<td  align="center"><?=h($i)?></td>
			<td  align="center"><?= h($walkinSale->item->name) ?></td>
			<td  align="center"><?=h($walkinSale->item->unit->longname)?></td>
			<td align="center"><?=h($walkinSale->quantity)?></td>
			<td  align="center"><?=h($walkinSale->rate)?></td>
			<td align="right"><?=h($walkinSale->amount)?></td>
			</tr>
			
		<?php } ?>
<tr>
<td colspan="4">&nbsp;</td>
<td>Total</td>
<td  align="center"><?=h($total)?></td></tr>

	</table>
	</div>
