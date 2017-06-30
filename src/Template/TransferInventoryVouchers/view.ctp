<?php
/**
  * @var \App\View\AppView $this
  * @var \App\Model\Entity\TransferInventoryVoucher $transferInventoryVoucher
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Transfer Inventory Voucher'), ['action' => 'edit', $transferInventoryVoucher->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Transfer Inventory Voucher'), ['action' => 'delete', $transferInventoryVoucher->id], ['confirm' => __('Are you sure you want to delete # {0}?', $transferInventoryVoucher->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Transfer Inventory Vouchers'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Transfer Inventory Voucher'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Items'), ['controller' => 'Items', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Item'), ['controller' => 'Items', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Transfer Inventory Voucher Rows'), ['controller' => 'TransferInventoryVoucherRows', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Transfer Inventory Voucher Row'), ['controller' => 'TransferInventoryVoucherRows', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="transferInventoryVouchers view large-9 medium-8 columns content">
    <h3><?= h($transferInventoryVoucher->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Item') ?></th>
            <td><?= $transferInventoryVoucher->has('item') ? $this->Html->link($transferInventoryVoucher->item->name, ['controller' => 'Items', 'action' => 'view', $transferInventoryVoucher->item->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($transferInventoryVoucher->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Voucher No') ?></th>
            <td><?= $this->Number->format($transferInventoryVoucher->voucher_no) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Quantity') ?></th>
            <td><?= $this->Number->format($transferInventoryVoucher->quantity) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created On') ?></th>
            <td><?= h($transferInventoryVoucher->created_on) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Transfer Inventory Voucher Rows') ?></h4>
        <?php if (!empty($transferInventoryVoucher->transfer_inventory_voucher_rows)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Transfer Inventory Voucher Id') ?></th>
                <th scope="col"><?= __('Item Id') ?></th>
                <th scope="col"><?= __('Quantity') ?></th>
                <th scope="col"><?= __('Waste Quantity') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($transferInventoryVoucher->transfer_inventory_voucher_rows as $transferInventoryVoucherRows): ?>
            <tr>
                <td><?= h($transferInventoryVoucherRows->id) ?></td>
                <td><?= h($transferInventoryVoucherRows->transfer_inventory_voucher_id) ?></td>
                <td><?= h($transferInventoryVoucherRows->item_id) ?></td>
                <td><?= h($transferInventoryVoucherRows->quantity) ?></td>
                <td><?= h($transferInventoryVoucherRows->waste_quantity) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'TransferInventoryVoucherRows', 'action' => 'view', $transferInventoryVoucherRows->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'TransferInventoryVoucherRows', 'action' => 'edit', $transferInventoryVoucherRows->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'TransferInventoryVoucherRows', 'action' => 'delete', $transferInventoryVoucherRows->id], ['confirm' => __('Are you sure you want to delete # {0}?', $transferInventoryVoucherRows->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
