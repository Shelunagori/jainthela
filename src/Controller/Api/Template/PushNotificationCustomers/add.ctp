<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Push Notification Customers'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Push Notifications'), ['controller' => 'PushNotifications', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Push Notification'), ['controller' => 'PushNotifications', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Customers'), ['controller' => 'Customers', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Customer'), ['controller' => 'Customers', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="pushNotificationCustomers form large-9 medium-8 columns content">
    <?= $this->Form->create($pushNotificationCustomer) ?>
    <fieldset>
        <legend><?= __('Add Push Notification Customer') ?></legend>
        <?php
            echo $this->Form->control('push_notification_id', ['options' => $pushNotifications]);
            echo $this->Form->control('customer_id', ['options' => $customers]);
            echo $this->Form->control('sent');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
