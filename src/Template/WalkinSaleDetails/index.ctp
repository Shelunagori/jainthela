<?php
/**
  * @var \App\View\AppView $this
  * @var \App\Model\Entity\WalkinSaleDetail[]|\Cake\Collection\CollectionInterface $walkinSaleDetails
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Walkin Sale Detail'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Walkin Sales'), ['controller' => 'WalkinSales', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Walkin Sale'), ['controller' => 'WalkinSales', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Items'), ['controller' => 'Items', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Item'), ['controller' => 'Items', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="walkinSaleDetails index large-9 medium-8 columns content">
    <h3><?= __('Walkin Sale Details') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('walkin_sale_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('item_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('quantity') ?></th>
                <th scope="col"><?= $this->Paginator->sort('rate') ?></th>
                <th scope="col"><?= $this->Paginator->sort('amount') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($walkinSaleDetails as $walkinSaleDetail): ?>
            <tr>
                <td><?= $this->Number->format($walkinSaleDetail->id) ?></td>
                <td><?= $walkinSaleDetail->has('walkin_sale') ? $this->Html->link($walkinSaleDetail->walkin_sale->name, ['controller' => 'WalkinSales', 'action' => 'view', $walkinSaleDetail->walkin_sale->id]) : '' ?></td>
                <td><?= $walkinSaleDetail->has('item') ? $this->Html->link($walkinSaleDetail->item->name, ['controller' => 'Items', 'action' => 'view', $walkinSaleDetail->item->id]) : '' ?></td>
                <td><?= $this->Number->format($walkinSaleDetail->quantity) ?></td>
                <td><?= $this->Number->format($walkinSaleDetail->rate) ?></td>
                <td><?= $this->Number->format($walkinSaleDetail->amount) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $walkinSaleDetail->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $walkinSaleDetail->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $walkinSaleDetail->id], ['confirm' => __('Are you sure you want to delete # {0}?', $walkinSaleDetail->id)]) ?>
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
