<?php
/**
  * @var \App\View\AppView $this
  * @var \App\Model\Entity\Wallet $wallet
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Wallet'), ['action' => 'edit', $wallet->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Wallet'), ['action' => 'delete', $wallet->id], ['confirm' => __('Are you sure you want to delete # {0}?', $wallet->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Wallets'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Wallet'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Customers'), ['controller' => 'Customers', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Customer'), ['controller' => 'Customers', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Plans'), ['controller' => 'Plans', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Plan'), ['controller' => 'Plans', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Orders'), ['controller' => 'Orders', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Order'), ['controller' => 'Orders', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="wallets view large-9 medium-8 columns content">
    <h3><?= h($wallet->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Customer') ?></th>
            <td><?= $wallet->has('customer') ? $this->Html->link($wallet->customer->name, ['controller' => 'Customers', 'action' => 'view', $wallet->customer->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Plan') ?></th>
            <td><?= $wallet->has('plan') ? $this->Html->link($wallet->plan->name, ['controller' => 'Plans', 'action' => 'view', $wallet->plan->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Order') ?></th>
            <td><?= $wallet->has('order') ? $this->Html->link($wallet->order->id, ['controller' => 'Orders', 'action' => 'view', $wallet->order->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($wallet->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Advance') ?></th>
            <td><?= $this->Number->format($wallet->advance) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Consumed') ?></th>
            <td><?= $this->Number->format($wallet->consumed) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Updated On') ?></th>
            <td><?= h($wallet->updated_on) ?></td>
        </tr>
    </table>
</div>
