<?php
/**
  * @var \App\View\AppView $this
  * @var \App\Model\Entity\Cart $cart
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Cart'), ['action' => 'edit', $cart->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Cart'), ['action' => 'delete', $cart->id], ['confirm' => __('Are you sure you want to delete # {0}?', $cart->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Carts'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Cart'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Customers'), ['controller' => 'Customers', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Customer'), ['controller' => 'Customers', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Items'), ['controller' => 'Items', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Item'), ['controller' => 'Items', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="carts view large-9 medium-8 columns content">
    <h3><?= h($cart->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Customer') ?></th>
            <td><?= $cart->has('customer') ? $this->Html->link($cart->customer->name, ['controller' => 'Customers', 'action' => 'view', $cart->customer->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Item') ?></th>
            <td><?= $cart->has('item') ? $this->Html->link($cart->item->name, ['controller' => 'Items', 'action' => 'view', $cart->item->id]) : '' ?></td>
        </tr>
        <tr>
<<<<<<< HEAD
            <th scope="row"><?= __('Cart Count') ?></th>
            <td><?= h($cart->cart_count) ?></td>
        </tr>
        <tr>
=======
>>>>>>> 8ad41ceb2ec85f2b846b3156a3e5d37a6c786214
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($cart->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Quantity') ?></th>
            <td><?= $this->Number->format($cart->quantity) ?></td>
        </tr>
    </table>
</div>
