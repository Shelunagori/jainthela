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
                ['action' => 'delete', $ledgerAccount->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $ledgerAccount->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Ledger Accounts'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Jain Thela Admins'), ['controller' => 'JainThelaAdmins', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Jain Thela Admin'), ['controller' => 'JainThelaAdmins', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Vendors'), ['controller' => 'Vendors', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Vendor'), ['controller' => 'Vendors', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Account Groups'), ['controller' => 'AccountGroups', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Account Group'), ['controller' => 'AccountGroups', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="ledgerAccounts form large-9 medium-8 columns content">
    <?= $this->Form->create($ledgerAccount) ?>
    <fieldset>
        <legend><?= __('Edit Ledger Account') ?></legend>
        <?php
            echo $this->Form->control('name');
            echo $this->Form->control('jain_thela_admin_id', ['options' => $jainThelaAdmins]);
            echo $this->Form->control('vendor_id', ['options' => $vendors]);
            echo $this->Form->control('account_group_id', ['options' => $accountGroups]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
