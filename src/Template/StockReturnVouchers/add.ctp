<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Stock Return Vouchers'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Drivers'), ['controller' => 'Drivers', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Driver'), ['controller' => 'Drivers', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Jain Thela Admins'), ['controller' => 'JainThelaAdmins', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Jain Thela Admin'), ['controller' => 'JainThelaAdmins', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Item Ledgers'), ['controller' => 'ItemLedgers', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Item Ledger'), ['controller' => 'ItemLedgers', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="stockReturnVouchers form large-9 medium-8 columns content">
    <?= $this->Form->create($stockReturnVoucher) ?>
    <fieldset>
        <legend><?= __('Add Stock Return Voucher') ?></legend>
        <?php
            echo $this->Form->control('driver_id', ['options' => $drivers]);
            echo $this->Form->control('created_on_date');
            echo $this->Form->control('amount_receivable');
            echo $this->Form->control('amount_received');
            echo $this->Form->control('jain_thela_admin_id', ['options' => $jainThelaAdmins]);
            echo $this->Form->control('item_ledger_id');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
