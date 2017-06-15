<?php
/**
  * @var \App\View\AppView $this
  * @var \App\Model\Entity\LedgerAccount[]|\Cake\Collection\CollectionInterface $ledgerAccounts
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Ledger Account'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Jain Thela Admins'), ['controller' => 'JainThelaAdmins', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Jain Thela Admin'), ['controller' => 'JainThelaAdmins', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Vendors'), ['controller' => 'Vendors', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Vendor'), ['controller' => 'Vendors', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Account Groups'), ['controller' => 'AccountGroups', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Account Group'), ['controller' => 'AccountGroups', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="ledgerAccounts index large-9 medium-8 columns content">
    <h3><?= __('Ledger Accounts') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('name') ?></th>
                <th scope="col"><?= $this->Paginator->sort('jain_thela_admin_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('vendor_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('account_group_id') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($ledgerAccounts as $ledgerAccount): ?>
            <tr>
                <td><?= $this->Number->format($ledgerAccount->id) ?></td>
                <td><?= h($ledgerAccount->name) ?></td>
                <td><?= $ledgerAccount->has('jain_thela_admin') ? $this->Html->link($ledgerAccount->jain_thela_admin->name, ['controller' => 'JainThelaAdmins', 'action' => 'view', $ledgerAccount->jain_thela_admin->id]) : '' ?></td>
                <td><?= $ledgerAccount->has('vendor') ? $this->Html->link($ledgerAccount->vendor->name, ['controller' => 'Vendors', 'action' => 'view', $ledgerAccount->vendor->id]) : '' ?></td>
                <td><?= $ledgerAccount->has('account_group') ? $this->Html->link($ledgerAccount->account_group->name, ['controller' => 'AccountGroups', 'action' => 'view', $ledgerAccount->account_group->id]) : '' ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $ledgerAccount->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $ledgerAccount->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $ledgerAccount->id], ['confirm' => __('Are you sure you want to delete # {0}?', $ledgerAccount->id)]) ?>
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
