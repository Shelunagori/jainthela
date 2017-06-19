	<?php if($count>0){ ?>
	<table id="main_table" class="table table-condensed table-bordered">
		<thead>
			<tr align="center">
				<td width="12%">
					<label>Sr<label>
				</td>
				<td width="40%">
					<label>Item<label>
				</td>
				<td width="20%">
					<label>In Stock<label>
				</td>
				<td width="20%">
					<label>Out Stock<label>
				</td>
				<td width="20%">
					<label>Available Stock<label>
				</td>
			</tr>
		</thead>
		<tbody id='main_tbody' class="tab">
		<?php  
		$k=0;
		foreach($itemLedgers as $itemLedger){
				$item_id=$itemLedger->item_id;
				$total_in=$itemLedger->total_in;
				$total_out=$itemLedger->total_out;
				$remaining=$total_in-$total_out;
				@$i++;
		?>
			<tr class="main_tr" class="tab">
				<td align="center" width="1px"><?= $i ?>.</td>
				<td>
					<?= $itemLedger->item->name ?>
					<?php echo $item_id; ?>			
				</td>	
				<td align="center">
					<?php echo $total_in; ?>
				</td>
				<td align="center">
					<?php echo $total_out; ?>
				</td>
				<td align="center">
					<?php echo $remaining; ?>
				</td>
			</tr>
		<?php $k++; } ?>
		</tbody>
	</table>
	<div class="row" style="padding-top:5px;">
		<div class="col-md-4"></div>
		<div class="col-md-4"></div>
		<div class="col-md-4"> </div>
	</div>
	<?php }else{ ?>
	NO DATA FOUND
	<?php } ?>