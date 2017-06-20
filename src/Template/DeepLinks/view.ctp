<?php
/**
  * @var \App\View\AppView $this
  * @var \App\Model\Entity\DeepLink $deepLink
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Deep Link'), ['action' => 'edit', $deepLink->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Deep Link'), ['action' => 'delete', $deepLink->id], ['confirm' => __('Are you sure you want to delete # {0}?', $deepLink->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Deep Links'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Deep Link'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="deepLinks view large-9 medium-8 columns content">
    <h3><?= h($deepLink->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Link Name') ?></th>
            <td><?= h($deepLink->link_name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Link Url') ?></th>
            <td><?= h($deepLink->link_url) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($deepLink->id) ?></td>
        </tr>
    </table>
</div>
