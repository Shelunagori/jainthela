<?php
/**
  * @var \App\View\AppView $this
  * @var \App\Model\Entity\JainCashPoint $jainCashPoint
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Jain Cash Point'), ['action' => 'edit', $jainCashPoint->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Jain Cash Point'), ['action' => 'delete', $jainCashPoint->id], ['confirm' => __('Are you sure you want to delete # {0}?', $jainCashPoint->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Jain Cash Points'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Jain Cash Point'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Customers'), ['controller' => 'Customers', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Customer'), ['controller' => 'Customers', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Orders'), ['controller' => 'Orders', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Order'), ['controller' => 'Orders', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="jainCashPoints view large-9 medium-8 columns content">
    <h3><?= h($jainCashPoint->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Customer') ?></th>
            <td><?= $jainCashPoint->has('customer') ? $this->Html->link($jainCashPoint->customer->name, ['controller' => 'Customers', 'action' => 'view', $jainCashPoint->customer->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Order') ?></th>
            <td><?= $jainCashPoint->has('order') ? $this->Html->link($jainCashPoint->order->id, ['controller' => 'Orders', 'action' => 'view', $jainCashPoint->order->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($jainCashPoint->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Point') ?></th>
            <td><?= $this->Number->format($jainCashPoint->point) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Used Point') ?></th>
            <td><?= $this->Number->format($jainCashPoint->used_point) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Updated On') ?></th>
            <td><?= h($jainCashPoint->updated_on) ?></td>
        </tr>
    </table>
</div>
