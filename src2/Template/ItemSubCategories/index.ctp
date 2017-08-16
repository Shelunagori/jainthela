<?php
/**
  * @var \App\View\AppView $this
  * @var \App\Model\Entity\ItemSubCategory[]|\Cake\Collection\CollectionInterface $itemSubCategories
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Item Sub Category'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Item Categories'), ['controller' => 'ItemCategories', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Item Category'), ['controller' => 'ItemCategories', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Items'), ['controller' => 'Items', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Item'), ['controller' => 'Items', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="itemSubCategories index large-9 medium-8 columns content">
    <h3><?= __('Item Sub Categories') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('item_category_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('name') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($itemSubCategories as $itemSubCategory): ?>
            <tr>
                <td><?= $this->Number->format($itemSubCategory->id) ?></td>
                <td><?= $itemSubCategory->has('item_category') ? $this->Html->link($itemSubCategory->item_category->name, ['controller' => 'ItemCategories', 'action' => 'view', $itemSubCategory->item_category->id]) : '' ?></td>
                <td><?= h($itemSubCategory->name) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $itemSubCategory->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $itemSubCategory->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $itemSubCategory->id], ['confirm' => __('Are you sure you want to delete # {0}?', $itemSubCategory->id)]) ?>
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
