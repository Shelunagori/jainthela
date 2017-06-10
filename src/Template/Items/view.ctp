<?php
/**
  * @var \App\View\AppView $this
  * @var \App\Model\Entity\Item $item
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Item'), ['action' => 'edit', $item->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Item'), ['action' => 'delete', $item->id], ['confirm' => __('Are you sure you want to delete # {0}?', $item->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Items'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Item'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Item Categories'), ['controller' => 'ItemCategories', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Item Category'), ['controller' => 'ItemCategories', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Units'), ['controller' => 'Units', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Unit'), ['controller' => 'Units', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Franchises'), ['controller' => 'Franchises', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Franchise'), ['controller' => 'Franchises', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="items view large-9 medium-8 columns content">
    <h3><?= h($item->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($item->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Item Category') ?></th>
            <td><?= $item->has('item_category') ? $this->Html->link($item->item_category->name, ['controller' => 'ItemCategories', 'action' => 'view', $item->item_category->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Unit') ?></th>
            <td><?= $item->has('unit') ? $this->Html->link($item->unit->id, ['controller' => 'Units', 'action' => 'view', $item->unit->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Franchise') ?></th>
            <td><?= $item->has('franchise') ? $this->Html->link($item->franchise->name, ['controller' => 'Franchises', 'action' => 'view', $item->franchise->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Alias Name') ?></th>
            <td><?= h($item->alias_name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($item->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Minimum Stock') ?></th>
            <td><?= $this->Number->format($item->minimum_stock) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Minimum Quantity Factor') ?></th>
            <td><?= $this->Number->format($item->minimum_quantity_factor) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Freeze') ?></th>
            <td><?= $item->freeze ? __('Yes') : __('No'); ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Description') ?></h4>
        <?= $this->Text->autoParagraph(h($item->description)); ?>
    </div>
</div>
