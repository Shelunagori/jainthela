<?php
/**
  * @var \App\View\AppView $this
  * @var \App\Model\Entity\WalkinSale $walkinSale
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Walkin Sale'), ['action' => 'edit', $walkinSale->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Walkin Sale'), ['action' => 'delete', $walkinSale->id], ['confirm' => __('Are you sure you want to delete # {0}?', $walkinSale->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Walkin Sales'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Walkin Sale'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Drivers'), ['controller' => 'Drivers', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Driver'), ['controller' => 'Drivers', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Jain Thela Admins'), ['controller' => 'JainThelaAdmins', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Jain Thela Admin'), ['controller' => 'JainThelaAdmins', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Warehouses'), ['controller' => 'Warehouses', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Warehouse'), ['controller' => 'Warehouses', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Walkin Sale Details'), ['controller' => 'WalkinSaleDetails', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Walkin Sale Detail'), ['controller' => 'WalkinSaleDetails', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="walkinSales view large-9 medium-8 columns content">
    <h3><?= h($walkinSale->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($walkinSale->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Mobile') ?></th>
            <td><?= h($walkinSale->mobile) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Driver') ?></th>
            <td><?= $walkinSale->has('driver') ? $this->Html->link($walkinSale->driver->name, ['controller' => 'Drivers', 'action' => 'view', $walkinSale->driver->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Jain Thela Admin') ?></th>
            <td><?= $walkinSale->has('jain_thela_admin') ? $this->Html->link($walkinSale->jain_thela_admin->name, ['controller' => 'JainThelaAdmins', 'action' => 'view', $walkinSale->jain_thela_admin->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Warehouse') ?></th>
            <td><?= $walkinSale->has('warehouse') ? $this->Html->link($walkinSale->warehouse->name, ['controller' => 'Warehouses', 'action' => 'view', $walkinSale->warehouse->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($walkinSale->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Total Amount') ?></th>
            <td><?= $this->Number->format($walkinSale->total_amount) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Transaction Date') ?></th>
            <td><?= h($walkinSale->transaction_date) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Walkin Sale Details') ?></h4>
        <?php if (!empty($walkinSale->walkin_sale_details)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Walkin Sale Id') ?></th>
                <th scope="col"><?= __('Item Id') ?></th>
                <th scope="col"><?= __('Quantity') ?></th>
                <th scope="col"><?= __('Rate') ?></th>
                <th scope="col"><?= __('Amount') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($walkinSale->walkin_sale_details as $walkinSaleDetails): ?>
            <tr>
                <td><?= h($walkinSaleDetails->id) ?></td>
                <td><?= h($walkinSaleDetails->walkin_sale_id) ?></td>
                <td><?= h($walkinSaleDetails->item_id) ?></td>
                <td><?= h($walkinSaleDetails->quantity) ?></td>
                <td><?= h($walkinSaleDetails->rate) ?></td>
                <td><?= h($walkinSaleDetails->amount) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'WalkinSaleDetails', 'action' => 'view', $walkinSaleDetails->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'WalkinSaleDetails', 'action' => 'edit', $walkinSaleDetails->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'WalkinSaleDetails', 'action' => 'delete', $walkinSaleDetails->id], ['confirm' => __('Are you sure you want to delete # {0}?', $walkinSaleDetails->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
