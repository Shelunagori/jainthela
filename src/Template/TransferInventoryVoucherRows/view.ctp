<?php
/**
  * @var \App\View\AppView $this
  * @var \App\Model\Entity\TransferInventoryVoucherRow $transferInventoryVoucherRow
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Transfer Inventory Voucher Row'), ['action' => 'edit', $transferInventoryVoucherRow->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Transfer Inventory Voucher Row'), ['action' => 'delete', $transferInventoryVoucherRow->id], ['confirm' => __('Are you sure you want to delete # {0}?', $transferInventoryVoucherRow->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Transfer Inventory Voucher Rows'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Transfer Inventory Voucher Row'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Transfer Inventory Vouchers'), ['controller' => 'TransferInventoryVouchers', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Transfer Inventory Voucher'), ['controller' => 'TransferInventoryVouchers', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Items'), ['controller' => 'Items', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Item'), ['controller' => 'Items', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="transferInventoryVoucherRows view large-9 medium-8 columns content">
    <h3><?= h($transferInventoryVoucherRow->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Transfer Inventory Voucher') ?></th>
            <td><?= $transferInventoryVoucherRow->has('transfer_inventory_voucher') ? $this->Html->link($transferInventoryVoucherRow->transfer_inventory_voucher->id, ['controller' => 'TransferInventoryVouchers', 'action' => 'view', $transferInventoryVoucherRow->transfer_inventory_voucher->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Item') ?></th>
            <td><?= $transferInventoryVoucherRow->has('item') ? $this->Html->link($transferInventoryVoucherRow->item->name, ['controller' => 'Items', 'action' => 'view', $transferInventoryVoucherRow->item->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($transferInventoryVoucherRow->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Quantity') ?></th>
            <td><?= $this->Number->format($transferInventoryVoucherRow->quantity) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Waste Quantity') ?></th>
            <td><?= $this->Number->format($transferInventoryVoucherRow->waste_quantity) ?></td>
        </tr>
    </table>
</div>
