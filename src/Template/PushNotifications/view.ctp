<?php
/**
  * @var \App\View\AppView $this
  * @var \App\Model\Entity\PushNotification $pushNotification
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Push Notification'), ['action' => 'edit', $pushNotification->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Push Notification'), ['action' => 'delete', $pushNotification->id], ['confirm' => __('Are you sure you want to delete # {0}?', $pushNotification->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Push Notifications'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Push Notification'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Push Notification Customer'), ['controller' => 'PushNotificationCustomer', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Push Notification Customer'), ['controller' => 'PushNotificationCustomer', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="pushNotifications view large-9 medium-8 columns content">
    <h3><?= h($pushNotification->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Image') ?></th>
            <td><?= h($pushNotification->image) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($pushNotification->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created On') ?></th>
            <td><?= h($pushNotification->created_on) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Message') ?></h4>
        <?= $this->Text->autoParagraph(h($pushNotification->message)); ?>
    </div>
    <div class="related">
        <h4><?= __('Related Push Notification Customer') ?></h4>
        <?php if (!empty($pushNotification->push_notification_customer)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Push Notification Id') ?></th>
                <th scope="col"><?= __('Customer Id') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($pushNotification->push_notification_customer as $pushNotificationCustomer): ?>
            <tr>
                <td><?= h($pushNotificationCustomer->id) ?></td>
                <td><?= h($pushNotificationCustomer->push_notification_id) ?></td>
                <td><?= h($pushNotificationCustomer->customer_id) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'PushNotificationCustomer', 'action' => 'view', $pushNotificationCustomer->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'PushNotificationCustomer', 'action' => 'edit', $pushNotificationCustomer->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'PushNotificationCustomer', 'action' => 'delete', $pushNotificationCustomer->id], ['confirm' => __('Are you sure you want to delete # {0}?', $pushNotificationCustomer->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
