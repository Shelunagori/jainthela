<tr id="discount">
	<td colspan="4" style="text-align:right;">Discount in Percent</td>
	<td><?php echo $this->Form->control('discount_percent',['placeholder'=>'Discount','class'=>'form-control input-sm','label'=>false,'type'=>'hidden','value'=>$customer->bulk_booking_discount_percent]); ?>
	<?= $customer->bulk_booking_discount_percent ?>
	</td>
	<td></td>
</tr>