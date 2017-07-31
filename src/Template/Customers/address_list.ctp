
<div class="modal-body">
	<div class="list-group">
		<span style=" font-size: 16px; "><?= h($customer->name).'('.$customer->mobile.')' ?></span><br/><br/>
		<?php foreach (@$customer->customer_addresses as $address): ?>
		<a href="#" addressid="<?php echo $address->id ?>" class="list-group-item insert_address" role="button"><span><?= h(ucwords($address->house_no.$address->address.'-'.$address->locality)) ?></span></a>
		<?php endforeach; ?>
	</div>
</div>

