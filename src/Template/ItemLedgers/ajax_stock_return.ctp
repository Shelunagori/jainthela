
<?php 
	foreach($itemLedgers as $itemLedger){
		$total_in=$itemLedger->total_in;
		$total_out=$itemLedger->total_out;
		$remaining=$total_in-$total_out;
		@$i++;
?>
	<tr class="main_tr" class="tab">
		<td align="center" width="1px"><?= $i ?>.</td>
		<td>
			<?= $itemLedger->item->name ?>
		</td>	
		<td>
			<?php echo $this->Form->input('quantity[]', ['label' => false,'class' => 'form-control input-sm number','value'=> $remaining]); ?>
		</td>
	</tr>
	<?php } ?>