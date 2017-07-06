<?php
/**
  * @var \App\View\AppView $this
  * @var \App\Model\Entity\Warehouse $warehouse
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Warehouse'), ['action' => 'edit', $warehouse->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Warehouse'), ['action' => 'delete', $warehouse->id], ['confirm' => __('Are you sure you want to delete # {0}?', $warehouse->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Warehouses'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Warehouse'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Jain Thela Admins'), ['controller' => 'JainThelaAdmins', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Jain Thela Admin'), ['controller' => 'JainThelaAdmins', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Item Ledgers'), ['controller' => 'ItemLedgers', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Item Ledger'), ['controller' => 'ItemLedgers', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="warehouses view large-9 medium-8 columns content">
    <h3><?= h($warehouse->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($warehouse->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Jain Thela Admin') ?></th>
            <td><?= $warehouse->has('jain_thela_admin') ? $this->Html->link($warehouse->jain_thela_admin->name, ['controller' => 'JainThelaAdmins', 'action' => 'view', $warehouse->jain_thela_admin->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($warehouse->id) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Item Ledgers') ?></h4>
        <?php if (!empty($warehouse->item_ledgers)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Jain Thela Admin Id') ?></th>
                <th scope="col"><?= __('Driver Id') ?></th>
                <th scope="col"><?= __('Different Driver Id') ?></th>
                <th scope="col"><?= __('Grn Id') ?></th>
                <th scope="col"><?= __('Purchase Booking Id') ?></th>
                <th scope="col"><?= __('Item Id') ?></th>
                <th scope="col"><?= __('Warehouse Id') ?></th>
                <th scope="col"><?= __('Rate') ?></th>
                <th scope="col"><?= __('Status') ?></th>
                <th scope="col"><?= __('Quantity') ?></th>
                <th scope="col"><?= __('Transaction Date') ?></th>
                <th scope="col"><?= __('Rate Updated') ?></th>
                <th scope="col"><?= __('Inventory Transfer') ?></th>
                <th scope="col"><?= __('Created On') ?></th>
                <th scope="col"><?= __('Creation Date') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($warehouse->item_ledgers as $itemLedgers): ?>
            <tr>
                <td><?= h($itemLedgers->id) ?></td>
                <td><?= h($itemLedgers->jain_thela_admin_id) ?></td>
                <td><?= h($itemLedgers->driver_id) ?></td>
                <td><?= h($itemLedgers->different_driver_id) ?></td>
                <td><?= h($itemLedgers->grn_id) ?></td>
                <td><?= h($itemLedgers->purchase_booking_id) ?></td>
                <td><?= h($itemLedgers->item_id) ?></td>
                <td><?= h($itemLedgers->warehouse_id) ?></td>
                <td><?= h($itemLedgers->rate) ?></td>
                <td><?= h($itemLedgers->status) ?></td>
                <td><?= h($itemLedgers->quantity) ?></td>
                <td><?= h($itemLedgers->transaction_date) ?></td>
                <td><?= h($itemLedgers->rate_updated) ?></td>
                <td><?= h($itemLedgers->inventory_transfer) ?></td>
                <td><?= h($itemLedgers->created_on) ?></td>
                <td><?= h($itemLedgers->creation_date) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'ItemLedgers', 'action' => 'view', $itemLedgers->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'ItemLedgers', 'action' => 'edit', $itemLedgers->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'ItemLedgers', 'action' => 'delete', $itemLedgers->id], ['confirm' => __('Are you sure you want to delete # {0}?', $itemLedgers->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
