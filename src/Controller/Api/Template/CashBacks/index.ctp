<?php
/**
  * @var \App\View\AppView $this
  * @var \App\Model\Entity\CashBack[]|\Cake\Collection\CollectionInterface $cashBacks
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Cash Back'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Customers'), ['controller' => 'Customers', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Customer'), ['controller' => 'Customers', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="cashBacks index large-9 medium-8 columns content">
    <h3><?= __('Cash Backs') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('cash_back_no') ?></th>
                <th scope="col"><?= $this->Paginator->sort('customer_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('amount') ?></th>
                <th scope="col"><?= $this->Paginator->sort('claim') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created_on') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($cashBacks as $cashBack): ?>
            <tr>
                <td><?= $this->Number->format($cashBack->id) ?></td>
                <td><?= h($cashBack->cash_back_no) ?></td>
                <td><?= $cashBack->has('customer') ? $this->Html->link($cashBack->customer->name, ['controller' => 'Customers', 'action' => 'view', $cashBack->customer->id]) : '' ?></td>
                <td><?= $this->Number->format($cashBack->amount) ?></td>
                <td><?= h($cashBack->claim) ?></td>
                <td><?= h($cashBack->created_on) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $cashBack->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $cashBack->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $cashBack->id], ['confirm' => __('Are you sure you want to delete # {0}?', $cashBack->id)]) ?>
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
