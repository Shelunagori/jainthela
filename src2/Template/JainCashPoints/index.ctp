<?php
/**
  * @var \App\View\AppView $this
  * @var \App\Model\Entity\JainCashPoint[]|\Cake\Collection\CollectionInterface $jainCashPoints
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Jain Cash Point'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Customers'), ['controller' => 'Customers', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Customer'), ['controller' => 'Customers', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Orders'), ['controller' => 'Orders', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Order'), ['controller' => 'Orders', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="jainCashPoints index large-9 medium-8 columns content">
    <h3><?= __('Jain Cash Points') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('customer_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('point') ?></th>
                <th scope="col"><?= $this->Paginator->sort('used_point') ?></th>
                <th scope="col"><?= $this->Paginator->sort('order_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('updated_on') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($jainCashPoints as $jainCashPoint): ?>
            <tr>
                <td><?= $this->Number->format($jainCashPoint->id) ?></td>
                <td><?= $jainCashPoint->has('customer') ? $this->Html->link($jainCashPoint->customer->name, ['controller' => 'Customers', 'action' => 'view', $jainCashPoint->customer->id]) : '' ?></td>
                <td><?= $this->Number->format($jainCashPoint->point) ?></td>
                <td><?= $this->Number->format($jainCashPoint->used_point) ?></td>
                <td><?= $jainCashPoint->has('order') ? $this->Html->link($jainCashPoint->order->id, ['controller' => 'Orders', 'action' => 'view', $jainCashPoint->order->id]) : '' ?></td>
                <td><?= h($jainCashPoint->updated_on) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $jainCashPoint->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $jainCashPoint->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $jainCashPoint->id], ['confirm' => __('Are you sure you want to delete # {0}?', $jainCashPoint->id)]) ?>
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
