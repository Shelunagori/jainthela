<?php
/**
  * @var \App\View\AppView $this
  * @var \App\Model\Entity\AppNotificationCustomer[]|\Cake\Collection\CollectionInterface $appNotificationCustomers
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New App Notification Customer'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List App Notifications'), ['controller' => 'AppNotifications', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New App Notification'), ['controller' => 'AppNotifications', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Customers'), ['controller' => 'Customers', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Customer'), ['controller' => 'Customers', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="appNotificationCustomers index large-9 medium-8 columns content">
    <h3><?= __('App Notification Customers') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('app_notification_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('customer_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('sent') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($appNotificationCustomers as $appNotificationCustomer): ?>
            <tr>
                <td><?= $this->Number->format($appNotificationCustomer->id) ?></td>
                <td><?= $appNotificationCustomer->has('app_notification') ? $this->Html->link($appNotificationCustomer->app_notification->id, ['controller' => 'AppNotifications', 'action' => 'view', $appNotificationCustomer->app_notification->id]) : '' ?></td>
                <td><?= $appNotificationCustomer->has('customer') ? $this->Html->link($appNotificationCustomer->customer->name, ['controller' => 'Customers', 'action' => 'view', $appNotificationCustomer->customer->id]) : '' ?></td>
                <td><?= $this->Number->format($appNotificationCustomer->sent) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $appNotificationCustomer->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $appNotificationCustomer->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $appNotificationCustomer->id], ['confirm' => __('Are you sure you want to delete # {0}?', $appNotificationCustomer->id)]) ?>
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
