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
                ['action' => 'delete', $purchaseBooking->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $purchaseBooking->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Purchase Bookings'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Grns'), ['controller' => 'Grns', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Grn'), ['controller' => 'Grns', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Vendors'), ['controller' => 'Vendors', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Vendor'), ['controller' => 'Vendors', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Jain Thela Admins'), ['controller' => 'JainThelaAdmins', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Jain Thela Admin'), ['controller' => 'JainThelaAdmins', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Purchase Booking Details'), ['controller' => 'PurchaseBookingDetails', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Purchase Booking Detail'), ['controller' => 'PurchaseBookingDetails', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="purchaseBookings form large-9 medium-8 columns content">
    <?= $this->Form->create($purchaseBooking) ?>
    <fieldset>
        <legend><?= __('Edit Purchase Booking') ?></legend>
        <?php
            echo $this->Form->control('grn_id', ['options' => $grns]);
            echo $this->Form->control('voucher_no');
            echo $this->Form->control('transaction_date');
            echo $this->Form->control('vendor_id', ['options' => $vendors]);
            echo $this->Form->control('jain_thela_admin_id', ['options' => $jainThelaAdmins]);
            echo $this->Form->control('created_on');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
