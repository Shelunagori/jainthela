<tr>
	<td colspan="3">
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
					<?php foreach($warehpouse_itemLedgers as $warehpouse_itemLedger){

					$total_in=number_format($warehpouse_itemLedger->totalInWarehouse, 2);
					$total_out=number_format($warehpouse_itemLedger->totalOutWarehouse, 2);
					$remaining=number_format($total_in-$total_out, 2);
					$item_id=$warehpouse_itemLedger->item_id;
					if($remaining!=0){
					@$i++;
						$name=@$warehpouse_itemLedger->warehouse->name;
						$warehouse_name=' (Warehouse) ';
						 
					?>
						<tr class="main_tr" class="tab">
							<td width="1px">
								<?= $i ?>.
							</td>
							 <td>
							 <?= $name.$warehouse_name ?>
							 </td>
							<td>
								<?= $remaining.' '.$warehpouse_itemLedger->item->unit->shortname;?>
							</td>
							
						</tr>
					<?php } } ?>
					
					<?php foreach($driver_itemLedgers as $driver_itemLedger){

					$total_in=number_format($driver_itemLedger->totalInDriver, 2);
					$total_out=number_format($driver_itemLedger->totalOutDriver, 2);
					$remaining=number_format(($total_in-$total_out), 2);
					$item_id=$driver_itemLedger->item_id;
					if($remaining!=0){
					@$i++;
					 
						$name=$driver_itemLedger->driver->name;
						$driver=' (Driver) ';
					?>
						<tr class="main_tr" class="tab">
							<td width="1px">
								<?= $i ?>.
							</td>
							 <td>
								<?= h($name.''.$driver) ?>
							 </td>
							<td>
								<?= @$remaining.' '.@$warehpouse_itemLedger->item->unit->shortname;?>
							</td>
							
						</tr>
					<?php } } ?>
					
					
				</tbody>
			</table>
		</td>
	</tr>
		