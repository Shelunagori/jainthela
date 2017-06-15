<?php
/**
  * @var \App\View\AppView $this
  * @var \App\Model\Entity\BulkBookingLead $bulkBookingLead
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Bulk Booking Lead'), ['action' => 'edit', $bulkBookingLead->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Bulk Booking Lead'), ['action' => 'delete', $bulkBookingLead->id], ['confirm' => __('Are you sure you want to delete # {0}?', $bulkBookingLead->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Bulk Booking Leads'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Bulk Booking Lead'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Jain Thela Admins'), ['controller' => 'JainThelaAdmins', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Jain Thela Admin'), ['controller' => 'JainThelaAdmins', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="bulkBookingLeads view large-9 medium-8 columns content">
    <h3><?= h($bulkBookingLead->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($bulkBookingLead->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Mobile') ?></th>
            <td><?= h($bulkBookingLead->mobile) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Jain Thela Admin') ?></th>
            <td><?= $bulkBookingLead->has('jain_thela_admin') ? $this->Html->link($bulkBookingLead->jain_thela_admin->name, ['controller' => 'JainThelaAdmins', 'action' => 'view', $bulkBookingLead->jain_thela_admin->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Status') ?></th>
            <td><?= h($bulkBookingLead->status) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Image') ?></th>
            <td><?= h($bulkBookingLead->image) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($bulkBookingLead->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Lead No') ?></th>
            <td><?= $this->Number->format($bulkBookingLead->lead_no) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created On') ?></th>
            <td><?= h($bulkBookingLead->created_on) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Lead Description') ?></h4>
        <?= $this->Text->autoParagraph(h($bulkBookingLead->lead_description)); ?>
    </div>
</div>
