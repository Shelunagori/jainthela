<?php
/**
  * @var \App\View\AppView $this
  * @var \App\Model\Entity\PurchaseBooking[]|\Cake\Collection\CollectionInterface $purchaseBookings
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Purchase Booking'), ['action' => 'add']) ?></li>
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
<div class="purchaseBookings index large-9 medium-8 columns content">
    <h3><?= __('Purchase Bookings') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('grn_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('voucher_no') ?></th>
                <th scope="col"><?= $this->Paginator->sort('transaction_date') ?></th>
                <th scope="col"><?= $this->Paginator->sort('vendor_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('jain_thela_admin_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created_on') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($purchaseBookings as $purchaseBooking): ?>
            <tr>
                <td><?= $this->Number->format($purchaseBooking->id) ?></td>
                <td><?= $purchaseBooking->has('grn') ? $this->Html->link($purchaseBooking->grn->id, ['controller' => 'Grns', 'action' => 'view', $purchaseBooking->grn->id]) : '' ?></td>
                <td><?= $this->Number->format($purchaseBooking->voucher_no) ?></td>
                <td><?= h($purchaseBooking->transaction_date) ?></td>
                <td><?= $purchaseBooking->has('vendor') ? $this->Html->link($purchaseBooking->vendor->name, ['controller' => 'Vendors', 'action' => 'view', $purchaseBooking->vendor->id]) : '' ?></td>
                <td><?= $purchaseBooking->has('jain_thela_admin') ? $this->Html->link($purchaseBooking->jain_thela_admin->name, ['controller' => 'JainThelaAdmins', 'action' => 'view', $purchaseBooking->jain_thela_admin->id]) : '' ?></td>
                <td><?= h($purchaseBooking->created_on) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $purchaseBooking->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $purchaseBooking->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $purchaseBooking->id], ['confirm' => __('Are you sure you want to delete # {0}?', $purchaseBooking->id)]) ?>
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
