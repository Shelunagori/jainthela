<?php
/**
  * @var \App\View\AppView $this
  * @var \App\Model\Entity\Warehouse[]|\Cake\Collection\CollectionInterface $warehouses
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Warehouse'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Jain Thela Admins'), ['controller' => 'JainThelaAdmins', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Jain Thela Admin'), ['controller' => 'JainThelaAdmins', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Item Ledgers'), ['controller' => 'ItemLedgers', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Item Ledger'), ['controller' => 'ItemLedgers', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="warehouses index large-9 medium-8 columns content">
    <h3><?= __('Warehouses') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('name') ?></th>
                <th scope="col"><?= $this->Paginator->sort('jain_thela_admin_id') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($warehouses as $warehouse): ?>
            <tr>
                <td><?= $this->Number->format($warehouse->id) ?></td>
                <td><?= h($warehouse->name) ?></td>
                <td><?= $warehouse->has('jain_thela_admin') ? $this->Html->link($warehouse->jain_thela_admin->name, ['controller' => 'JainThelaAdmins', 'action' => 'view', $warehouse->jain_thela_admin->id]) : '' ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $warehouse->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $warehouse->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $warehouse->id], ['confirm' => __('Are you sure you want to delete # {0}?', $warehouse->id)]) ?>
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
