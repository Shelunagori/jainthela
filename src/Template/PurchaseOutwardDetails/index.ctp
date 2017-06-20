<?php
/**
  * @var \App\View\AppView $this
  * @var \App\Model\Entity\PurchaseOutwardDetail[]|\Cake\Collection\CollectionInterface $purchaseOutwardDetails
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Purchase Outward Detail'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Purchase Outwards'), ['controller' => 'PurchaseOutwards', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Purchase Outward'), ['controller' => 'PurchaseOutwards', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Items'), ['controller' => 'Items', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Item'), ['controller' => 'Items', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="purchaseOutwardDetails index large-9 medium-8 columns content">
    <h3><?= __('Purchase Outward Details') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('purchase_outward_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('item_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('quantity') ?></th>
                <th scope="col"><?= $this->Paginator->sort('invoice_quantity') ?></th>
                <th scope="col"><?= $this->Paginator->sort('rate') ?></th>
                <th scope="col"><?= $this->Paginator->sort('amount') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($purchaseOutwardDetails as $purchaseOutwardDetail): ?>
            <tr>
                <td><?= $this->Number->format($purchaseOutwardDetail->id) ?></td>
                <td><?= $purchaseOutwardDetail->has('purchase_outward') ? $this->Html->link($purchaseOutwardDetail->purchase_outward->id, ['controller' => 'PurchaseOutwards', 'action' => 'view', $purchaseOutwardDetail->purchase_outward->id]) : '' ?></td>
                <td><?= $purchaseOutwardDetail->has('item') ? $this->Html->link($purchaseOutwardDetail->item->name, ['controller' => 'Items', 'action' => 'view', $purchaseOutwardDetail->item->id]) : '' ?></td>
                <td><?= $this->Number->format($purchaseOutwardDetail->quantity) ?></td>
                <td><?= $this->Number->format($purchaseOutwardDetail->invoice_quantity) ?></td>
                <td><?= $this->Number->format($purchaseOutwardDetail->rate) ?></td>
                <td><?= $this->Number->format($purchaseOutwardDetail->amount) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $purchaseOutwardDetail->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $purchaseOutwardDetail->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $purchaseOutwardDetail->id], ['confirm' => __('Are you sure you want to delete # {0}?', $purchaseOutwardDetail->id)]) ?>
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
