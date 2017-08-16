<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Push Notifications'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Push Notification Customer'), ['controller' => 'PushNotificationCustomer', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Push Notification Customer'), ['controller' => 'PushNotificationCustomer', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="pushNotifications form large-9 medium-8 columns content">
    <?= $this->Form->create($pushNotification) ?>
    <fieldset>
        <legend><?= __('Add Push Notification') ?></legend>
        <?php
            echo $this->Form->control('message');
            echo $this->Form->control('image');
            echo $this->Form->control('created_on');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
