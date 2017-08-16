<?php
/**
  * @var \App\View\AppView $this
  * @var \App\Model\Entity\User $user
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit User'), ['action' => 'edit', $user->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete User'), ['action' => 'delete', $user->id], ['confirm' => __('Are you sure you want to delete # {0}?', $user->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Cities'), ['controller' => 'Cities', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New City'), ['controller' => 'Cities', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Jain Thela Admins'), ['controller' => 'JainThelaAdmins', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Jain Thela Admin'), ['controller' => 'JainThelaAdmins', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="users view large-9 medium-8 columns content">
    <h3><?= h($user->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Username') ?></th>
            <td><?= h($user->username) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Password') ?></th>
            <td><?= h($user->password) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Role') ?></th>
            <td><?= h($user->role) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Status') ?></th>
            <td><?= h($user->status) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('City') ?></th>
            <td><?= $user->has('city') ? $this->Html->link($user->city->name, ['controller' => 'Cities', 'action' => 'view', $user->city->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Jain Thela Admin') ?></th>
            <td><?= $user->has('jain_thela_admin') ? $this->Html->link($user->jain_thela_admin->name, ['controller' => 'JainThelaAdmins', 'action' => 'view', $user->jain_thela_admin->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Cashback Message') ?></th>
            <td><?= h($user->cashback_message) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($user->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Jain Cash Limit') ?></th>
            <td><?= $this->Number->format($user->jain_cash_limit) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Cash Back Percentage') ?></th>
            <td><?= $this->Number->format($user->cash_back_percentage) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Cash Back Amount') ?></th>
            <td><?= $this->Number->format($user->cash_back_amount) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Cash Back Limit') ?></th>
            <td><?= $this->Number->format($user->cash_back_limit) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('First Order Discount Amount') ?></th>
            <td><?= $this->Number->format($user->first_order_discount_amount) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($user->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($user->modified) ?></td>
        </tr>
    </table>
</div>
