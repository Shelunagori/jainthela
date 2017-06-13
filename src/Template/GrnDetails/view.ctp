<?php
/**
  * @var \App\View\AppView $this
  * @var \App\Model\Entity\GrnDetail $grnDetail
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Grn Detail'), ['action' => 'edit', $grnDetail->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Grn Detail'), ['action' => 'delete', $grnDetail->id], ['confirm' => __('Are you sure you want to delete # {0}?', $grnDetail->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Grn Details'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Grn Detail'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Items'), ['controller' => 'Items', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Item'), ['controller' => 'Items', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="grnDetails view large-9 medium-8 columns content">
    <h3><?= h($grnDetail->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Item') ?></th>
            <td><?= $grnDetail->has('item') ? $this->Html->link($grnDetail->item->name, ['controller' => 'Items', 'action' => 'view', $grnDetail->item->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($grnDetail->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Grn Id') ?></th>
            <td><?= $this->Number->format($grnDetail->grn_id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Quantity') ?></th>
            <td><?= $this->Number->format($grnDetail->quantity) ?></td>
        </tr>
    </table>
</div>
