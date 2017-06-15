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
                ['action' => 'delete', $walkinSale->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $walkinSale->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Walkin Sales'), ['action' => 'index']) ?></li>
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
<div class="walkinSales form large-9 medium-8 columns content">
    <?= $this->Form->create($walkinSale) ?>
    <fieldset>
        <legend><?= __('Edit Walkin Sale') ?></legend>
        <?php
            echo $this->Form->control('transaction_date');
            echo $this->Form->control('name');
            echo $this->Form->control('mobile');
            echo $this->Form->control('driver_id', ['options' => $drivers]);
            echo $this->Form->control('jain_thela_admin_id', ['options' => $jainThelaAdmins]);
            echo $this->Form->control('warehouse_id', ['options' => $warehouses]);
            echo $this->Form->control('total_amount');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
