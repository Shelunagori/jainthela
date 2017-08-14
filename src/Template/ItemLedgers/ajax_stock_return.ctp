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
				<td width="10%">
					<label>Available Stock<label>
				</td>
				<td width="20%">
					<label>Return<label>
				</td>
				<td width="20%">
					<label>Weight variation<label>
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
				$unit_name=$itemLedger->item->unit->unit_name;
				
				if($remaining>0){
					@$i++;
		?>
			<tr class="main_tr tab">
				<td align="center" width="1px"><?= $i ?>.</td>
				<td>
					<?= $itemLedger->item->name ?>
					<?php echo $this->Form->input('item_ledgers['.$k.'][item_id]', ['type'=>'hidden','label' => false,'class' => 'form-control input-sm number','value'=> $item_id]); ?>
				</td>	
				<td align="center">
					<?php echo $this->Form->input('item_ledgers['.$k.'][remaining]', ['type'=>'hidden','label' => false,'class' => 'form-control input-sm remaining','value'=> number_format($remaining, 2)]); ?>
				<?php echo number_format($remaining, 2) ?></td>
				<td>
					<?php echo $this->Form->input('item_ledgers['.$k.'][quantity]', ['label' => false,'class' => 'form-control input-sm number quantity','value'=> number_format($remaining, 2), 'max'=>number_format($remaining, 2)]); ?>
					<span class="msg_shw" style="color:green;font-size:10px;">
						quantity in <?= $unit_name ?>
					</span>
				</td>
				<td>
					<?php echo $this->Form->input('item_ledgers['.$k.'][waste]', ['label' => false,'class' => 'form-control input-sm number quant','value'=>0]); ?>
					<span class="msg_shw2" style="color:green;font-size:10px;">
						quantity in <?= $unit_name ?>
					</span>
				</td>
			</tr>
		<?php 
		}
		$k++;
		} ?>
		</tbody>
	</table>
	<div class="row" style="padding-top:5px;">
		<div class="col-md-4"></div>
		<div class="col-md-4"></div>
		<div class="col-md-4"> </div>
	</div>
	<div align="center">
		<?= $this->Form->button($this->Html->tag('i', '', ['class'=>'fa fa-plus']) . __(' Create Stock Return'),['class'=>'btn btn-success','id'=>'submitbtn']); ?>
	</div>
	<?php }else{ ?>
	NO DATA FOUND
	<?php } ?>