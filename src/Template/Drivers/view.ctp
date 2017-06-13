<?php
/**
  * @var \App\View\AppView $this
  * @var \App\Model\Entity\Driver $driver
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Driver'), ['action' => 'edit', $driver->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Driver'), ['action' => 'delete', $driver->id], ['confirm' => __('Are you sure you want to delete # {0}?', $driver->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Drivers'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Driver'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Cities'), ['controller' => 'Cities', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New City'), ['controller' => 'Cities', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="drivers view large-9 medium-8 columns content">
    <h3><?= h($driver->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($driver->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('City') ?></th>
            <td><?= $driver->has('city') ? $this->Html->link($driver->city->name, ['controller' => 'Cities', 'action' => 'view', $driver->city->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($driver->id) ?></td>
        </tr>
    </table>
</div>
