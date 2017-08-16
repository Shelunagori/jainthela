<?php
/**
  * @var \App\View\AppView $this
  * @var \App\Model\Entity\LedgerAccount $ledgerAccount
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Ledger Account'), ['action' => 'edit', $ledgerAccount->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Ledger Account'), ['action' => 'delete', $ledgerAccount->id], ['confirm' => __('Are you sure you want to delete # {0}?', $ledgerAccount->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Ledger Accounts'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Ledger Account'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Jain Thela Admins'), ['controller' => 'JainThelaAdmins', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Jain Thela Admin'), ['controller' => 'JainThelaAdmins', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Vendors'), ['controller' => 'Vendors', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Vendor'), ['controller' => 'Vendors', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Account Groups'), ['controller' => 'AccountGroups', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Account Group'), ['controller' => 'AccountGroups', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="ledgerAccounts view large-9 medium-8 columns content">
    <h3><?= h($ledgerAccount->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($ledgerAccount->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Jain Thela Admin') ?></th>
            <td><?= $ledgerAccount->has('jain_thela_admin') ? $this->Html->link($ledgerAccount->jain_thela_admin->name, ['controller' => 'JainThelaAdmins', 'action' => 'view', $ledgerAccount->jain_thela_admin->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Vendor') ?></th>
            <td><?= $ledgerAccount->has('vendor') ? $this->Html->link($ledgerAccount->vendor->name, ['controller' => 'Vendors', 'action' => 'view', $ledgerAccount->vendor->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Account Group') ?></th>
            <td><?= $ledgerAccount->has('account_group') ? $this->Html->link($ledgerAccount->account_group->name, ['controller' => 'AccountGroups', 'action' => 'view', $ledgerAccount->account_group->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($ledgerAccount->id) ?></td>
        </tr>
    </table>
</div>
