<?php
/**
  * @var \App\View\AppView $this
  * @var \App\Model\Entity\WalkinSale[]|\Cake\Collection\CollectionInterface $walkinSales
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Walkin Sale'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Drivers'), ['controller' => 'Drivers', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Driver'), ['controller' => 'Drivers', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Jain Thela Admins'), ['controller' => 'JainThelaAdmins', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Jain Thela Admin'), ['controller' => 'JainThelaAdmins', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Warehouses'), ['controller' => 'Warehouses', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Warehouse'), ['controller' => 'Warehouses', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Walkin Sale Details'), ['controller' => 'WalkinSaleDetails', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Walkin Sale Detail'), ['controller' => 'WalkinSaleDetails', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="walkinSales index large-9 medium-8 columns content">
    <h3><?= __('Walkin Sales') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('transaction_date') ?></th>
                <th scope="col"><?= $this->Paginator->sort('name') ?></th>
                <th scope="col"><?= $this->Paginator->sort('mobile') ?></th>
                <th scope="col"><?= $this->Paginator->sort('driver_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('jain_thela_admin_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('warehouse_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('total_amount') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($walkinSales as $walkinSale): ?>
            <tr>
                <td><?= $this->Number->format($walkinSale->id) ?></td>
                <td><?= h($walkinSale->transaction_date) ?></td>
                <td><?= h($walkinSale->name) ?></td>
                <td><?= h($walkinSale->mobile) ?></td>
                <td><?= $walkinSale->has('driver') ? $this->Html->link($walkinSale->driver->name, ['controller' => 'Drivers', 'action' => 'view', $walkinSale->driver->id]) : '' ?></td>
                <td><?= $walkinSale->has('jain_thela_admin') ? $this->Html->link($walkinSale->jain_thela_admin->name, ['controller' => 'JainThelaAdmins', 'action' => 'view', $walkinSale->jain_thela_admin->id]) : '' ?></td>
                <td><?= $walkinSale->has('warehouse') ? $this->Html->link($walkinSale->warehouse->name, ['controller' => 'Warehouses', 'action' => 'view', $walkinSale->warehouse->id]) : '' ?></td>
                <td><?= $this->Number->format($walkinSale->total_amount) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $walkinSale->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $walkinSale->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $walkinSale->id], ['confirm' => __('Are you sure you want to delete # {0}?', $walkinSale->id)]) ?>
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
