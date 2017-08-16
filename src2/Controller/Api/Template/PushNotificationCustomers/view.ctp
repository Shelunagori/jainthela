<?php
/**
  * @var \App\View\AppView $this
  * @var \App\Model\Entity\PushNotificationCustomer $pushNotificationCustomer
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Push Notification Customer'), ['action' => 'edit', $pushNotificationCustomer->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Push Notification Customer'), ['action' => 'delete', $pushNotificationCustomer->id], ['confirm' => __('Are you sure you want to delete # {0}?', $pushNotificationCustomer->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Push Notification Customers'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Push Notification Customer'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Push Notifications'), ['controller' => 'PushNotifications', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Push Notification'), ['controller' => 'PushNotifications', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Customers'), ['controller' => 'Customers', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Customer'), ['controller' => 'Customers', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="pushNotificationCustomers view large-9 medium-8 columns content">
    <h3><?= h($pushNotificationCustomer->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Push Notification') ?></th>
            <td><?= $pushNotificationCustomer->has('push_notification') ? $this->Html->link($pushNotificationCustomer->push_notification->id, ['controller' => 'PushNotifications', 'action' => 'view', $pushNotificationCustomer->push_notification->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Customer') ?></th>
            <td><?= $pushNotificationCustomer->has('customer') ? $this->Html->link($pushNotificationCustomer->customer->name, ['controller' => 'Customers', 'action' => 'view', $pushNotificationCustomer->customer->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($pushNotificationCustomer->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Sent') ?></th>
            <td><?= $this->Number->format($pushNotificationCustomer->sent) ?></td>
        </tr>
    </table>
</div>
