<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $appNotificationCustomer->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $appNotificationCustomer->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List App Notification Customers'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List App Notifications'), ['controller' => 'AppNotifications', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New App Notification'), ['controller' => 'AppNotifications', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Customers'), ['controller' => 'Customers', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Customer'), ['controller' => 'Customers', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="appNotificationCustomers form large-9 medium-8 columns content">
    <?= $this->Form->create($appNotificationCustomer) ?>
    <fieldset>
        <legend><?= __('Edit App Notification Customer') ?></legend>
        <?php
            echo $this->Form->control('app_notification_id', ['options' => $appNotifications]);
            echo $this->Form->control('customer_id', ['options' => $customers]);
            echo $this->Form->control('sent');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
