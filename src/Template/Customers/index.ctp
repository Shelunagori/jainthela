<?php
/**
  * @var \App\View\AppView $this
  * @var \App\Model\Entity\Customer[]|\Cake\Collection\CollectionInterface $customers
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Customer'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Franchises'), ['controller' => 'Franchises', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Franchise'), ['controller' => 'Franchises', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="customers index large-9 medium-8 columns content">
    <h3><?= __('Customers') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('name') ?></th>
                <th scope="col"><?= $this->Paginator->sort('mobile') ?></th>
                <th scope="col"><?= $this->Paginator->sort('email') ?></th>
                <th scope="col"><?= $this->Paginator->sort('franchise_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('freeze') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($customers as $customer): ?>
            <tr>
                <td><?= $this->Number->format($customer->id) ?></td>
                <td><?= h($customer->name) ?></td>
                <td><?= h($customer->mobile) ?></td>
                <td><?= h($customer->email) ?></td>
                <td><?= $customer->has('franchise') ? $this->Html->link($customer->franchise->name, ['controller' => 'Franchises', 'action' => 'view', $customer->franchise->id]) : '' ?></td>
                <td><?= h($customer->freeze) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $customer->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $customer->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $customer->id], ['confirm' => __('Are you sure you want to delete # {0}?', $customer->id)]) ?>
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
