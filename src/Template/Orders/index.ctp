<?php
/**
  * @var \App\View\AppView $this
  * @var \App\Model\Entity\Order[]|\Cake\Collection\CollectionInterface $orders
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Order'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Customers'), ['controller' => 'Customers', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Customer'), ['controller' => 'Customers', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Promo Codes'), ['controller' => 'PromoCodes', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Promo Code'), ['controller' => 'PromoCodes', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Franchises'), ['controller' => 'Franchises', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Franchise'), ['controller' => 'Franchises', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Order Details'), ['controller' => 'OrderDetails', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Order Detail'), ['controller' => 'OrderDetails', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="orders index large-9 medium-8 columns content">
    <h3><?= __('Orders') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('order_no') ?></th>
                <th scope="col"><?= $this->Paginator->sort('order_date') ?></th>
                <th scope="col"><?= $this->Paginator->sort('customer_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('delivery_charges') ?></th>
                <th scope="col"><?= $this->Paginator->sort('amount_from_wallet') ?></th>
                <th scope="col"><?= $this->Paginator->sort('amount_from_jain_cash') ?></th>
                <th scope="col"><?= $this->Paginator->sort('amount_from_promocode') ?></th>
                <th scope="col"><?= $this->Paginator->sort('promo_code_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('order_type') ?></th>
                <th scope="col"><?= $this->Paginator->sort('franchise_id') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($orders as $order): ?>
            <tr>
                <td><?= $this->Number->format($order->id) ?></td>
                <td><?= $this->Number->format($order->order_no) ?></td>
                <td><?= h($order->order_date) ?></td>
                <td><?= $order->has('customer') ? $this->Html->link($order->customer->name, ['controller' => 'Customers', 'action' => 'view', $order->customer->id]) : '' ?></td>
                <td><?= $this->Number->format($order->delivery_charges) ?></td>
                <td><?= $this->Number->format($order->amount_from_wallet) ?></td>
                <td><?= $this->Number->format($order->amount_from_jain_cash) ?></td>
                <td><?= $this->Number->format($order->amount_from_promocode) ?></td>
                <td><?= $order->has('promo_code') ? $this->Html->link($order->promo_code->name, ['controller' => 'PromoCodes', 'action' => 'view', $order->promo_code->id]) : '' ?></td>
                <td><?= h($order->order_type) ?></td>
                <td><?= $order->has('franchise') ? $this->Html->link($order->franchise->name, ['controller' => 'Franchises', 'action' => 'view', $order->franchise->id]) : '' ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $order->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $order->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $order->id], ['confirm' => __('Are you sure you want to delete # {0}?', $order->id)]) ?>
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
