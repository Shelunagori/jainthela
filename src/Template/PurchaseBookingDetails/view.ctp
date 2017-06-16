<?php
/**
  * @var \App\View\AppView $this
  * @var \App\Model\Entity\PurchaseBookingDetail $purchaseBookingDetail
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Purchase Booking Detail'), ['action' => 'edit', $purchaseBookingDetail->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Purchase Booking Detail'), ['action' => 'delete', $purchaseBookingDetail->id], ['confirm' => __('Are you sure you want to delete # {0}?', $purchaseBookingDetail->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Purchase Booking Details'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Purchase Booking Detail'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Purchase Bookings'), ['controller' => 'PurchaseBookings', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Purchase Booking'), ['controller' => 'PurchaseBookings', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Items'), ['controller' => 'Items', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Item'), ['controller' => 'Items', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="purchaseBookingDetails view large-9 medium-8 columns content">
    <h3><?= h($purchaseBookingDetail->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Purchase Booking') ?></th>
            <td><?= $purchaseBookingDetail->has('purchase_booking') ? $this->Html->link($purchaseBookingDetail->purchase_booking->id, ['controller' => 'PurchaseBookings', 'action' => 'view', $purchaseBookingDetail->purchase_booking->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Item') ?></th>
            <td><?= $purchaseBookingDetail->has('item') ? $this->Html->link($purchaseBookingDetail->item->name, ['controller' => 'Items', 'action' => 'view', $purchaseBookingDetail->item->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($purchaseBookingDetail->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Quantity') ?></th>
            <td><?= $this->Number->format($purchaseBookingDetail->quantity) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Invoice Quantity') ?></th>
            <td><?= $this->Number->format($purchaseBookingDetail->invoice_quantity) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Rate') ?></th>
            <td><?= $this->Number->format($purchaseBookingDetail->rate) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Amount') ?></th>
            <td><?= $this->Number->format($purchaseBookingDetail->amount) ?></td>
        </tr>
    </table>
</div>
