<?php
/**
  * @var \App\View\AppView $this
  * @var \App\Model\Entity\PurchaseOutwardDetail $purchaseOutwardDetail
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Purchase Outward Detail'), ['action' => 'edit', $purchaseOutwardDetail->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Purchase Outward Detail'), ['action' => 'delete', $purchaseOutwardDetail->id], ['confirm' => __('Are you sure you want to delete # {0}?', $purchaseOutwardDetail->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Purchase Outward Details'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Purchase Outward Detail'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Purchase Outwards'), ['controller' => 'PurchaseOutwards', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Purchase Outward'), ['controller' => 'PurchaseOutwards', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Items'), ['controller' => 'Items', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Item'), ['controller' => 'Items', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="purchaseOutwardDetails view large-9 medium-8 columns content">
    <h3><?= h($purchaseOutwardDetail->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Purchase Outward') ?></th>
            <td><?= $purchaseOutwardDetail->has('purchase_outward') ? $this->Html->link($purchaseOutwardDetail->purchase_outward->id, ['controller' => 'PurchaseOutwards', 'action' => 'view', $purchaseOutwardDetail->purchase_outward->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Item') ?></th>
            <td><?= $purchaseOutwardDetail->has('item') ? $this->Html->link($purchaseOutwardDetail->item->name, ['controller' => 'Items', 'action' => 'view', $purchaseOutwardDetail->item->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($purchaseOutwardDetail->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Quantity') ?></th>
            <td><?= $this->Number->format($purchaseOutwardDetail->quantity) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Invoice Quantity') ?></th>
            <td><?= $this->Number->format($purchaseOutwardDetail->invoice_quantity) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Rate') ?></th>
            <td><?= $this->Number->format($purchaseOutwardDetail->rate) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Amount') ?></th>
            <td><?= $this->Number->format($purchaseOutwardDetail->amount) ?></td>
        </tr>
    </table>
</div>
