<?php
/**
  * @var \App\View\AppView $this
  * @var \App\Model\Entity\CashBack $cashBack
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Cash Back'), ['action' => 'edit', $cashBack->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Cash Back'), ['action' => 'delete', $cashBack->id], ['confirm' => __('Are you sure you want to delete # {0}?', $cashBack->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Cash Backs'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Cash Back'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Customers'), ['controller' => 'Customers', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Customer'), ['controller' => 'Customers', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="cashBacks view large-9 medium-8 columns content">
    <h3><?= h($cashBack->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Cash Back No') ?></th>
            <td><?= h($cashBack->cash_back_no) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Customer') ?></th>
            <td><?= $cashBack->has('customer') ? $this->Html->link($cashBack->customer->name, ['controller' => 'Customers', 'action' => 'view', $cashBack->customer->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Claim') ?></th>
            <td><?= h($cashBack->claim) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($cashBack->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Amount') ?></th>
            <td><?= $this->Number->format($cashBack->amount) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created On') ?></th>
            <td><?= h($cashBack->created_on) ?></td>
        </tr>
    </table>
</div>
