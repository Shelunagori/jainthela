<?php
/**
  * @var \App\View\AppView $this
  * @var \App\Model\Entity\Grn $grn
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Grn'), ['action' => 'edit', $grn->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Grn'), ['action' => 'delete', $grn->id], ['confirm' => __('Are you sure you want to delete # {0}?', $grn->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Grns'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Grn'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Vendors'), ['controller' => 'Vendors', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Vendor'), ['controller' => 'Vendors', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Cities'), ['controller' => 'Cities', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New City'), ['controller' => 'Cities', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="grns view large-9 medium-8 columns content">
    <h3><?= h($grn->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Vendor') ?></th>
            <td><?= $grn->has('vendor') ? $this->Html->link($grn->vendor->name, ['controller' => 'Vendors', 'action' => 'view', $grn->vendor->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('City') ?></th>
            <td><?= $grn->has('city') ? $this->Html->link($grn->city->name, ['controller' => 'Cities', 'action' => 'view', $grn->city->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($grn->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Grn No') ?></th>
            <td><?= $this->Number->format($grn->grn_no) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Transaction Date') ?></th>
            <td><?= h($grn->transaction_date) ?></td>
        </tr>
    </table>
</div>
