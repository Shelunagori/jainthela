<?php
/**
  * @var \App\View\AppView $this
  * @var \App\Model\Entity\Ledger $ledger
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Ledger'), ['action' => 'edit', $ledger->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Ledger'), ['action' => 'delete', $ledger->id], ['confirm' => __('Are you sure you want to delete # {0}?', $ledger->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Ledgers'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Ledger'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Ledger Accounts'), ['controller' => 'LedgerAccounts', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Ledger Account'), ['controller' => 'LedgerAccounts', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Purchase Bookings'), ['controller' => 'PurchaseBookings', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Purchase Booking'), ['controller' => 'PurchaseBookings', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Walkin Sales'), ['controller' => 'WalkinSales', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Walkin Sale'), ['controller' => 'WalkinSales', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="ledgers view large-9 medium-8 columns content">
    <h3><?= h($ledger->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Ledger Account') ?></th>
            <td><?= $ledger->has('ledger_account') ? $this->Html->link($ledger->ledger_account->name, ['controller' => 'LedgerAccounts', 'action' => 'view', $ledger->ledger_account->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Purchase Booking') ?></th>
            <td><?= $ledger->has('purchase_booking') ? $this->Html->link($ledger->purchase_booking->id, ['controller' => 'PurchaseBookings', 'action' => 'view', $ledger->purchase_booking->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Walkin Sale') ?></th>
            <td><?= $ledger->has('walkin_sale') ? $this->Html->link($ledger->walkin_sale->name, ['controller' => 'WalkinSales', 'action' => 'view', $ledger->walkin_sale->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($ledger->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Debit') ?></th>
            <td><?= $this->Number->format($ledger->debit) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Credit') ?></th>
            <td><?= $this->Number->format($ledger->credit) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Transaction Date') ?></th>
            <td><?= h($ledger->transaction_date) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created On') ?></th>
            <td><?= h($ledger->created_on) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Edited On') ?></th>
            <td><?= h($ledger->edited_on) ?></td>
        </tr>
    </table>
</div>
