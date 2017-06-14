<?php
/**
  * @var \App\View\AppView $this
  * @var \App\Model\Entity\PurchaseBooking $purchaseBooking
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Purchase Booking'), ['action' => 'edit', $purchaseBooking->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Purchase Booking'), ['action' => 'delete', $purchaseBooking->id], ['confirm' => __('Are you sure you want to delete # {0}?', $purchaseBooking->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Purchase Bookings'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Purchase Booking'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Grns'), ['controller' => 'Grns', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Grn'), ['controller' => 'Grns', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Vendors'), ['controller' => 'Vendors', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Vendor'), ['controller' => 'Vendors', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Jain Thela Admins'), ['controller' => 'JainThelaAdmins', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Jain Thela Admin'), ['controller' => 'JainThelaAdmins', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Purchase Booking Details'), ['controller' => 'PurchaseBookingDetails', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Purchase Booking Detail'), ['controller' => 'PurchaseBookingDetails', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="purchaseBookings view large-9 medium-8 columns content">
    <h3><?= h($purchaseBooking->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Grn') ?></th>
            <td><?= $purchaseBooking->has('grn') ? $this->Html->link($purchaseBooking->grn->id, ['controller' => 'Grns', 'action' => 'view', $purchaseBooking->grn->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Vendor') ?></th>
            <td><?= $purchaseBooking->has('vendor') ? $this->Html->link($purchaseBooking->vendor->name, ['controller' => 'Vendors', 'action' => 'view', $purchaseBooking->vendor->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Jain Thela Admin') ?></th>
            <td><?= $purchaseBooking->has('jain_thela_admin') ? $this->Html->link($purchaseBooking->jain_thela_admin->name, ['controller' => 'JainThelaAdmins', 'action' => 'view', $purchaseBooking->jain_thela_admin->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($purchaseBooking->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Voucher No') ?></th>
            <td><?= $this->Number->format($purchaseBooking->voucher_no) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Transaction Date') ?></th>
            <td><?= h($purchaseBooking->transaction_date) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created On') ?></th>
            <td><?= h($purchaseBooking->created_on) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Purchase Booking Details') ?></h4>
        <?php if (!empty($purchaseBooking->purchase_booking_details)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Purchase Booking Id') ?></th>
                <th scope="col"><?= __('Item Id') ?></th>
                <th scope="col"><?= __('Quantity') ?></th>
                <th scope="col"><?= __('Invoice Quantity') ?></th>
                <th scope="col"><?= __('Rate') ?></th>
                <th scope="col"><?= __('Amount') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($purchaseBooking->purchase_booking_details as $purchaseBookingDetails): ?>
            <tr>
                <td><?= h($purchaseBookingDetails->id) ?></td>
                <td><?= h($purchaseBookingDetails->purchase_booking_id) ?></td>
                <td><?= h($purchaseBookingDetails->item_id) ?></td>
                <td><?= h($purchaseBookingDetails->quantity) ?></td>
                <td><?= h($purchaseBookingDetails->invoice_quantity) ?></td>
                <td><?= h($purchaseBookingDetails->rate) ?></td>
                <td><?= h($purchaseBookingDetails->amount) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'PurchaseBookingDetails', 'action' => 'view', $purchaseBookingDetails->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'PurchaseBookingDetails', 'action' => 'edit', $purchaseBookingDetails->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'PurchaseBookingDetails', 'action' => 'delete', $purchaseBookingDetails->id], ['confirm' => __('Are you sure you want to delete # {0}?', $purchaseBookingDetails->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
