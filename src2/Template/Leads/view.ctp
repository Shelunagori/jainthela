<?php
/**
  * @var \App\View\AppView $this
  * @var \App\Model\Entity\Lead $lead
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Lead'), ['action' => 'edit', $lead->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Lead'), ['action' => 'delete', $lead->id], ['confirm' => __('Are you sure you want to delete # {0}?', $lead->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Leads'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Lead'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Jain Thela Admins'), ['controller' => 'JainThelaAdmins', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Jain Thela Admin'), ['controller' => 'JainThelaAdmins', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="leads view large-9 medium-8 columns content">
    <h3><?= h($lead->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($lead->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Mobile') ?></th>
            <td><?= h($lead->mobile) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Jain Thela Admin') ?></th>
            <td><?= $lead->has('jain_thela_admin') ? $this->Html->link($lead->jain_thela_admin->name, ['controller' => 'JainThelaAdmins', 'action' => 'view', $lead->jain_thela_admin->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Status') ?></th>
            <td><?= h($lead->status) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($lead->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Lead No') ?></th>
            <td><?= $this->Number->format($lead->lead_no) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created On') ?></th>
            <td><?= h($lead->created_on) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Order Description') ?></h4>
        <?= $this->Text->autoParagraph(h($lead->order_description)); ?>
    </div>
</div>
