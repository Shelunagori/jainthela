<?php
/**
  * @var \App\View\AppView $this
  * @var \App\Model\Entity\ItemLedger[]|\Cake\Collection\CollectionInterface $itemLedgers
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Item Ledger'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Items'), ['controller' => 'Items', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Item'), ['controller' => 'Items', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Franchises'), ['controller' => 'Franchises', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Franchise'), ['controller' => 'Franchises', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Purchase Inward Vouchers'), ['controller' => 'PurchaseInwardVouchers', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Purchase Inward Voucher'), ['controller' => 'PurchaseInwardVouchers', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="itemLedgers index large-9 medium-8 columns content">
    <h3><?= __('Item Ledgers') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('item_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('franchise_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('rate') ?></th>
                <th scope="col"><?= $this->Paginator->sort('status') ?></th>
                <th scope="col"><?= $this->Paginator->sort('quantity') ?></th>
                <th scope="col"><?= $this->Paginator->sort('transaction_date') ?></th>
                <th scope="col"><?= $this->Paginator->sort('purchase_inward_voucher_id') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($itemLedgers as $itemLedger): ?>
            <tr>
                <td><?= $this->Number->format($itemLedger->id) ?></td>
                <td><?= $itemLedger->has('item') ? $this->Html->link($itemLedger->item->name, ['controller' => 'Items', 'action' => 'view', $itemLedger->item->id]) : '' ?></td>
                <td><?= $itemLedger->has('franchise') ? $this->Html->link($itemLedger->franchise->name, ['controller' => 'Franchises', 'action' => 'view', $itemLedger->franchise->id]) : '' ?></td>
                <td><?= $this->Number->format($itemLedger->rate) ?></td>
                <td><?= h($itemLedger->status) ?></td>
                <td><?= $this->Number->format($itemLedger->quantity) ?></td>
                <td><?= h($itemLedger->transaction_date) ?></td>
                <td><?= $itemLedger->has('purchase_inward_voucher') ? $this->Html->link($itemLedger->purchase_inward_voucher->id, ['controller' => 'PurchaseInwardVouchers', 'action' => 'view', $itemLedger->purchase_inward_voucher->id]) : '' ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $itemLedger->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $itemLedger->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $itemLedger->id], ['confirm' => __('Are you sure you want to delete # {0}?', $itemLedger->id)]) ?>
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
