<?php
/**
  * @var \App\View\AppView $this
  * @var \App\Model\Entity\PurchaseBookingDetail[]|\Cake\Collection\CollectionInterface $purchaseBookingDetails
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Purchase Booking Detail'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Purchase Bookings'), ['controller' => 'PurchaseBookings', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Purchase Booking'), ['controller' => 'PurchaseBookings', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Items'), ['controller' => 'Items', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Item'), ['controller' => 'Items', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="purchaseBookingDetails index large-9 medium-8 columns content">
    <h3><?= __('Purchase Booking Details') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('purchase_booking_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('item_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('quantity') ?></th>
                <th scope="col"><?= $this->Paginator->sort('invoice_quantity') ?></th>
                <th scope="col"><?= $this->Paginator->sort('rate') ?></th>
                <th scope="col"><?= $this->Paginator->sort('amount') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($purchaseBookingDetails as $purchaseBookingDetail): ?>
            <tr>
                <td><?= $this->Number->format($purchaseBookingDetail->id) ?></td>
                <td><?= $purchaseBookingDetail->has('purchase_booking') ? $this->Html->link($purchaseBookingDetail->purchase_booking->id, ['controller' => 'PurchaseBookings', 'action' => 'view', $purchaseBookingDetail->purchase_booking->id]) : '' ?></td>
                <td><?= $purchaseBookingDetail->has('item') ? $this->Html->link($purchaseBookingDetail->item->name, ['controller' => 'Items', 'action' => 'view', $purchaseBookingDetail->item->id]) : '' ?></td>
                <td><?= $this->Number->format($purchaseBookingDetail->quantity) ?></td>
                <td><?= $this->Number->format($purchaseBookingDetail->invoice_quantity) ?></td>
                <td><?= $this->Number->format($purchaseBookingDetail->rate) ?></td>
                <td><?= $this->Number->format($purchaseBookingDetail->amount) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $purchaseBookingDetail->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $purchaseBookingDetail->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $purchaseBookingDetail->id], ['confirm' => __('Are you sure you want to delete # {0}?', $purchaseBookingDetail->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
    </div>
</div>
