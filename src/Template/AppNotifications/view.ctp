<?php
/**
  * @var \App\View\AppView $this
  * @var \App\Model\Entity\AppNotification $appNotification
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit App Notification'), ['action' => 'edit', $appNotification->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete App Notification'), ['action' => 'delete', $appNotification->id], ['confirm' => __('Are you sure you want to delete # {0}?', $appNotification->id)]) ?> </li>
        <li><?= $this->Html->link(__('List App Notifications'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New App Notification'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Items'), ['controller' => 'Items', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Item'), ['controller' => 'Items', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="appNotifications view large-9 medium-8 columns content">
    <h3><?= h($appNotification->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('App Link') ?></th>
            <td><?= h($appNotification->app_link) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Item') ?></th>
            <td><?= $appNotification->has('item') ? $this->Html->link($appNotification->item->name, ['controller' => 'Items', 'action' => 'view', $appNotification->item->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Screen Type') ?></th>
            <td><?= h($appNotification->screen_type) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($appNotification->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created On') ?></th>
            <td><?= h($appNotification->created_on) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Message') ?></h4>
        <?= $this->Text->autoParagraph(h($appNotification->message)); ?>
    </div>
    <div class="row">
        <h4><?= __('Image') ?></h4>
        <?= $this->Text->autoParagraph(h($appNotification->image)); ?>
    </div>
</div>
