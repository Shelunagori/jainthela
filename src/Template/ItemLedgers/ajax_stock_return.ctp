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
					<label>Quantity<label>
				</td>
				<td width="20%">
					<label>Waste Quantity<label>
				</td>
			</tr>
		</thead>
		<tbody id='main_tbody' class="tab">
		<?php  foreach($itemLedgers as $itemLedger){
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
					<?php echo $this->Form->input('item_id[]', ['type'=>'hidden','label' => false,'class' => 'form-control input-sm number','value'=> $item_id]); ?>
					
				</td>	
				<td>
					<?php echo $this->Form->input('quantity[]', ['label' => false,'class' => 'form-control input-sm number','value'=> $remaining]); ?>
				</td>
				<td>
					<?php echo $this->Form->input('waste[]', ['label' => false,'class' => 'form-control input-sm number']); ?>
				</td>
			</tr>
		<?php } ?>
		</tbody>
	</table>
	<div class="row" style="padding-top:5px;">
		<div class="col-md-4"></div>
		<div class="col-md-4"></div>
		<div class="col-md-4"> </div>
	</div>
	<div align="center">
		<?= $this->Form->button($this->html->tag('i', '', ['class'=>'fa fa-plus']) . __(' Create purchase order'),['class'=>'btn btn-success','id'=>'submitbtn']); ?>
	</div>
	<?php }else{ ?>
	NO DATA FOUND
	<?php } ?>