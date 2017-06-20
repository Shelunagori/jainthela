<tr>
	<td colspan="3">
<<<<<<< HEAD
			<table id="main_tble" class="table table-condensed" border='0' style="background-color:#F3F3F3">
				<thead>
				<tr>
						<th width="10%">
							<label>Sr<label>
						</th>
						<th width="40%">
							<label>Driver / Warehouse Name<label>
						</th>
						<th width="20%">
							<label>Stock<label>
						</th>
					</tr>
				</thead>
				<tbody id='main_tbody' class="tab">
					<?php foreach($itemLedgers as $itemLedger){
					$total_in=$itemLedger->total_in;
					$total_out=$itemLedger->total_out;
					$remaining=$total_in-$total_out;
					$item_id=$itemLedger->item_id;
					@$i++;
					if($itemLedger->driver_id==0)
					{
						$name=$itemLedger->warehouse->name;
						$warehouse_name=' (Warehouse) ';
						}else {
						$name=$itemLedger->driver->name;
						$warehouse_name='';
					}
					?>
						<tr class="main_tr" class="tab">
							<td width="1px">
								<?= $i ?>.
							</td>
							 <td>
							 <?= $name.$warehouse_name ?>
							 </td>
							<td>
								<?= $remaining.' '.$itemLedger->item->unit->shortname;?>
							</td>
							
						</tr>
					<?php } ?>
				</tbody>
			</table>
		</td>
	</tr>
=======
		<table id="main_tble" class="table table-condensed" border='0' style="background-color:#F3F3F3;width: 60%;margin: auto;">
			<thead>
				<tr>
					<th width="10%">
						<label>Sr<label>
					</th>
					<th width="40%">
						<label>Driver / Warehouse Name<label>
					</th>
					<th width="20%">
						<label>Stock<label>
					</th>
				</tr>
			</thead>
			<tbody id='main_tbody' class="tab">
				<?php foreach($itemLedgers as $itemLedger){
				$total_in=$itemLedger->total_in;
				$total_out=$itemLedger->total_out;
				$remaining=$total_in-$total_out;
				$item_id=$itemLedger->item_id;
				@$i++;
				if($itemLedger->driver_id==0)
				{
					$name=$itemLedger->warehouse->name;
					$warehouse_name=' (Warehouse) ';
					}else {
					$name=$itemLedger->driver->name;
					$warehouse_name='';
				}
				?>
					<tr class="main_tr" class="tab">
						<td width="1px">
							<?= $i ?>.
						</td>
						 <td>
						 <?= $name.$warehouse_name ?>
						 </td>
						<td>
							<?= $remaining.' '.$itemLedger->item->unit->shortname;?>
						</td>
						
					</tr>
				<?php } ?>
			</tbody>
		</table>
	</td>
</tr>
>>>>>>> origin/master
									