<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $purchaseBookingDetail->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $purchaseBookingDetail->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Purchase Booking Details'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Purchase Bookings'), ['controller' => 'PurchaseBookings', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Purchase Booking'), ['controller' => 'PurchaseBookings', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Items'), ['controller' => 'Items', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Item'), ['controller' => 'Items', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="purchaseBookingDetails form large-9 medium-8 columns content">
    <?= $this->Form->create($purchaseBookingDetail) ?>
    <fieldset>
        <legend><?= __('Edit Purchase Booking Detail') ?></legend>
        <?php
            echo $this->Form->control('purchase_booking_id', ['options' => $purchaseBookings]);
            echo $this->Form->control('item_id', ['options' => $items]);
            echo $this->Form->control('quantity');
            echo $this->Form->control('invoice_quantity');
            echo $this->Form->control('rate');
            echo $this->Form->control('amount');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
