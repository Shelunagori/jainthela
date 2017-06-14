	<table id="main_table" class="table table-condensed table-bordered">
		<thead>
			<tr align="center">
				<td width="10%">
					<label>Sr<label>
				</td>
				<td width="40%">
					<label>Item<label>
				</td>
				<td width="20%">
					<label>Stock In<label>
				</td>
				<td width="20%">
					<label>Stock Out<label>
				</td>
			</tr>
		</thead>
		<tbody id='main_tbody' class="tab">
		<?php foreach($itemLedgers as $itemLedger){
				$total_in=$itemLedger->total_in;
				$total_out=$itemLedger->total_out;
				$remaining=$total_in-$total_out;
				@$i++;
			?>
			<tr class="main_tr" class="tab">
				<td align="center" width="1px"><?= $i ?>.</td>
				<td align="center">
					<?= $itemLedger->item->name ?>
				</td>	
				<td align="center">
					<?= $total_in ?>
				</td>
				<td align="center">
					<?= $total_out ?>
				</td>
			</tr>
			<?php } ?>
		</tbody>
	</table>