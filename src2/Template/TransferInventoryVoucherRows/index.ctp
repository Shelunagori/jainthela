<?php
/**
  * @var \App\View\AppView $this
  * @var \App\Model\Entity\TransferInventoryVoucherRow[]|\Cake\Collection\CollectionInterface $transferInventoryVoucherRows
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Transfer Inventory Voucher Row'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Transfer Inventory Vouchers'), ['controller' => 'TransferInventoryVouchers', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Transfer Inventory Voucher'), ['controller' => 'TransferInventoryVouchers', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Items'), ['controller' => 'Items', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Item'), ['controller' => 'Items', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="transferInventoryVoucherRows index large-9 medium-8 columns content">
    <h3><?= __('Transfer Inventory Voucher Rows') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('transfer_inventory_voucher_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('item_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('quantity') ?></th>
                <th scope="col"><?= $this->Paginator->sort('waste_quantity') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($transferInventoryVoucherRows as $transferInventoryVoucherRow): ?>
            <tr>
                <td><?= $this->Number->format($transferInventoryVoucherRow->id) ?></td>
                <td><?= $transferInventoryVoucherRow->has('transfer_inventory_voucher') ? $this->Html->link($transferInventoryVoucherRow->transfer_inventory_voucher->id, ['controller' => 'TransferInventoryVouchers', 'action' => 'view', $transferInventoryVoucherRow->transfer_inventory_voucher->id]) : '' ?></td>
                <td><?= $transferInventoryVoucherRow->has('item') ? $this->Html->link($transferInventoryVoucherRow->item->name, ['controller' => 'Items', 'action' => 'view', $transferInventoryVoucherRow->item->id]) : '' ?></td>
                <td><?= $this->Number->format($transferInventoryVoucherRow->quantity) ?></td>
                <td><?= $this->Number->format($transferInventoryVoucherRow->waste_quantity) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $transferInventoryVoucherRow->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $transferInventoryVoucherRow->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $transferInventoryVoucherRow->id], ['confirm' => __('Are you sure you want to delete # {0}?', $transferInventoryVoucherRow->id)]) ?>
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
