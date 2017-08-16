<?php
/**
  * @var \App\View\AppView $this
  * @var \App\Model\Entity\Ledger[]|\Cake\Collection\CollectionInterface $ledgers
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Ledger'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Ledger Accounts'), ['controller' => 'LedgerAccounts', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Ledger Account'), ['controller' => 'LedgerAccounts', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Purchase Bookings'), ['controller' => 'PurchaseBookings', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Purchase Booking'), ['controller' => 'PurchaseBookings', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Walkin Sales'), ['controller' => 'WalkinSales', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Walkin Sale'), ['controller' => 'WalkinSales', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="ledgers index large-9 medium-8 columns content">
    <h3><?= __('Ledgers') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('ledger_account_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('purchase_booking_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('walkin_sale_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('debit') ?></th>
                <th scope="col"><?= $this->Paginator->sort('credit') ?></th>
                <th scope="col"><?= $this->Paginator->sort('transaction_date') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created_on') ?></th>
                <th scope="col"><?= $this->Paginator->sort('edited_on') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($ledgers as $ledger): ?>
            <tr>
                <td><?= $this->Number->format($ledger->id) ?></td>
                <td><?= $ledger->has('ledger_account') ? $this->Html->link($ledger->ledger_account->name, ['controller' => 'LedgerAccounts', 'action' => 'view', $ledger->ledger_account->id]) : '' ?></td>
                <td><?= $ledger->has('purchase_booking') ? $this->Html->link($ledger->purchase_booking->id, ['controller' => 'PurchaseBookings', 'action' => 'view', $ledger->purchase_booking->id]) : '' ?></td>
                <td><?= $ledger->has('walkin_sale') ? $this->Html->link($ledger->walkin_sale->name, ['controller' => 'WalkinSales', 'action' => 'view', $ledger->walkin_sale->id]) : '' ?></td>
                <td><?= $this->Number->format($ledger->debit) ?></td>
                <td><?= $this->Number->format($ledger->credit) ?></td>
                <td><?= h($ledger->transaction_date) ?></td>
                <td><?= h($ledger->created_on) ?></td>
                <td><?= h($ledger->edited_on) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $ledger->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $ledger->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $ledger->id], ['confirm' => __('Are you sure you want to delete # {0}?', $ledger->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
    </div>
</div>
