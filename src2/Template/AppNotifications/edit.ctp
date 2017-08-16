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
                ['action' => 'delete', $appNotification->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $appNotification->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List App Notifications'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Items'), ['controller' => 'Items', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Item'), ['controller' => 'Items', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="appNotifications form large-9 medium-8 columns content">
    <?= $this->Form->create($appNotification) ?>
    <fieldset>
        <legend><?= __('Edit App Notification') ?></legend>
        <?php
            echo $this->Form->control('message');
            echo $this->Form->control('image');
            echo $this->Form->control('app_link');
            echo $this->Form->control('item_id', ['options' => $items, 'empty' => true]);
            echo $this->Form->control('screen_type');
            echo $this->Form->control('created_on');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
