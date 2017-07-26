<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Ledgers'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Ledger Accounts'), ['controller' => 'LedgerAccounts', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Ledger Account'), ['controller' => 'LedgerAccounts', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Purchase Bookings'), ['controller' => 'PurchaseBookings', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Purchase Booking'), ['controller' => 'PurchaseBookings', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Walkin Sales'), ['controller' => 'WalkinSales', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Walkin Sale'), ['controller' => 'WalkinSales', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="ledgers form large-9 medium-8 columns content">
    <?= $this->Form->create($ledger) ?>
    <fieldset>
        <legend><?= __('Add Ledger') ?></legend>
        <?php
            echo $this->Form->control('ledger_account_id', ['options' => $ledgerAccounts]);
            echo $this->Form->control('purchase_booking_id', ['options' => $purchaseBookings]);
            echo $this->Form->control('walkin_sale_id', ['options' => $walkinSales]);
            echo $this->Form->control('debit');
            echo $this->Form->control('credit');
            echo $this->Form->control('transaction_date');
            echo $this->Form->control('created_on');
            echo $this->Form->control('edited_on');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
