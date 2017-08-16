<?php
/**
  * @var \App\View\AppView $this
  * @var \App\Model\Entity\Franchise $franchise
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Franchise'), ['action' => 'edit', $franchise->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Franchise'), ['action' => 'delete', $franchise->id], ['confirm' => __('Are you sure you want to delete # {0}?', $franchise->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Franchises'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Franchise'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Cities'), ['controller' => 'Cities', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New City'), ['controller' => 'Cities', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Franchise Item Categories'), ['controller' => 'FranchiseItemCategories', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Franchise Item Category'), ['controller' => 'FranchiseItemCategories', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="franchises view large-9 medium-8 columns content">
    <h3><?= h($franchise->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($franchise->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('City') ?></th>
            <td><?= $franchise->has('city') ? $this->Html->link($franchise->city->name, ['controller' => 'Cities', 'action' => 'view', $franchise->city->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($franchise->id) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Franchise Item Categories') ?></h4>
        <?php if (!empty($franchise->franchise_item_categories)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Franchise Id') ?></th>
                <th scope="col"><?= __('Item Category Id') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($franchise->franchise_item_categories as $franchiseItemCategories): ?>
            <tr>
                <td><?= h($franchiseItemCategories->franchise_id) ?></td>
                <td><?= h($franchiseItemCategories->item_category_id) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'FranchiseItemCategories', 'action' => 'view', $franchiseItemCategories->franchise_id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'FranchiseItemCategories', 'action' => 'edit', $franchiseItemCategories->franchise_id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'FranchiseItemCategories', 'action' => 'delete', $franchiseItemCategories->franchise_id], ['confirm' => __('Are you sure you want to delete # {0}?', $franchiseItemCategories->franchise_id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
