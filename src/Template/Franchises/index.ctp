<?php
/**
  * @var \App\View\AppView $this
  * @var \App\Model\Entity\Franchise[]|\Cake\Collection\CollectionInterface $franchises
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Franchise'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Cities'), ['controller' => 'Cities', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New City'), ['controller' => 'Cities', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Franchise Item Categories'), ['controller' => 'FranchiseItemCategories', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Franchise Item Category'), ['controller' => 'FranchiseItemCategories', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="franchises index large-9 medium-8 columns content">
    <h3><?= __('Franchises') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('name') ?></th>
                <th scope="col"><?= $this->Paginator->sort('city_id') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($franchises as $franchise): ?>
            <tr>
                <td><?= $this->Number->format($franchise->id) ?></td>
                <td><?= h($franchise->name) ?></td>
                <td><?= $franchise->has('city') ? $this->Html->link($franchise->city->name, ['controller' => 'Cities', 'action' => 'view', $franchise->city->id]) : '' ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $franchise->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $franchise->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $franchise->id], ['confirm' => __('Are you sure you want to delete # {0}?', $franchise->id)]) ?>
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
