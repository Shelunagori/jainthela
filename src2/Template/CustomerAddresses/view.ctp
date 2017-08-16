<?php
/**
  * @var \App\View\AppView $this
  * @var \App\Model\Entity\CustomerAddress $customerAddress
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Customer Address'), ['action' => 'edit', $customerAddress->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Customer Address'), ['action' => 'delete', $customerAddress->id], ['confirm' => __('Are you sure you want to delete # {0}?', $customerAddress->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Customer Addresses'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Customer Address'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Customers'), ['controller' => 'Customers', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Customer'), ['controller' => 'Customers', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="customerAddresses view large-9 medium-8 columns content">
    <h3><?= h($customerAddress->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Customer') ?></th>
            <td><?= $customerAddress->has('customer') ? $this->Html->link($customerAddress->customer->name, ['controller' => 'Customers', 'action' => 'view', $customerAddress->customer->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($customerAddress->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('House No') ?></th>
            <td><?= h($customerAddress->house_no) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Locality') ?></th>
            <td><?= h($customerAddress->locality) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($customerAddress->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Mobile') ?></th>
            <td><?= $this->Number->format($customerAddress->mobile) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Default Address') ?></th>
            <td><?= $this->Number->format($customerAddress->default_address) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Address') ?></h4>
        <?= $this->Text->autoParagraph(h($customerAddress->address)); ?>
    </div>
</div>
