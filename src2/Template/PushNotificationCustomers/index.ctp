<?php
/**
  * @var \App\View\AppView $this
  * @var \App\Model\Entity\PushNotificationCustomer[]|\Cake\Collection\CollectionInterface $pushNotificationCustomers
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Push Notification Customer'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Push Notifications'), ['controller' => 'PushNotifications', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Push Notification'), ['controller' => 'PushNotifications', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Customers'), ['controller' => 'Customers', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Customer'), ['controller' => 'Customers', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="pushNotificationCustomers index large-9 medium-8 columns content">
    <h3><?= __('Push Notification Customers') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('push_notification_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('customer_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('sent') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($pushNotificationCustomers as $pushNotificationCustomer): ?>
            <tr>
                <td><?= $this->Number->format($pushNotificationCustomer->id) ?></td>
                <td><?= $pushNotificationCustomer->has('push_notification') ? $this->Html->link($pushNotificationCustomer->push_notification->id, ['controller' => 'PushNotifications', 'action' => 'view', $pushNotificationCustomer->push_notification->id]) : '' ?></td>
                <td><?= $pushNotificationCustomer->has('customer') ? $this->Html->link($pushNotificationCustomer->customer->name, ['controller' => 'Customers', 'action' => 'view', $pushNotificationCustomer->customer->id]) : '' ?></td>
                <td><?= $this->Number->format($pushNotificationCustomer->sent) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $pushNotificationCustomer->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $pushNotificationCustomer->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $pushNotificationCustomer->id], ['confirm' => __('Are you sure you want to delete # {0}?', $pushNotificationCustomer->id)]) ?>
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
