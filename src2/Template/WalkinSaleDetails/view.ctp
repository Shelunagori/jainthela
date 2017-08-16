<?php
/**
  * @var \App\View\AppView $this
  * @var \App\Model\Entity\WalkinSaleDetail $walkinSaleDetail
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Walkin Sale Detail'), ['action' => 'edit', $walkinSaleDetail->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Walkin Sale Detail'), ['action' => 'delete', $walkinSaleDetail->id], ['confirm' => __('Are you sure you want to delete # {0}?', $walkinSaleDetail->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Walkin Sale Details'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Walkin Sale Detail'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Walkin Sales'), ['controller' => 'WalkinSales', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Walkin Sale'), ['controller' => 'WalkinSales', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Items'), ['controller' => 'Items', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Item'), ['controller' => 'Items', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="walkinSaleDetails view large-9 medium-8 columns content">
    <h3><?= h($walkinSaleDetail->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Walkin Sale') ?></th>
            <td><?= $walkinSaleDetail->has('walkin_sale') ? $this->Html->link($walkinSaleDetail->walkin_sale->name, ['controller' => 'WalkinSales', 'action' => 'view', $walkinSaleDetail->walkin_sale->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Item') ?></th>
            <td><?= $walkinSaleDetail->has('item') ? $this->Html->link($walkinSaleDetail->item->name, ['controller' => 'Items', 'action' => 'view', $walkinSaleDetail->item->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($walkinSaleDetail->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Quantity') ?></th>
            <td><?= $this->Number->format($walkinSaleDetail->quantity) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Rate') ?></th>
            <td><?= $this->Number->format($walkinSaleDetail->rate) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Amount') ?></th>
            <td><?= $this->Number->format($walkinSaleDetail->amount) ?></td>
        </tr>
    </table>
</div>
