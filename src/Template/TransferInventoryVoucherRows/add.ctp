<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Transfer Inventory Voucher Rows'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Transfer Inventory Vouchers'), ['controller' => 'TransferInventoryVouchers', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Transfer Inventory Voucher'), ['controller' => 'TransferInventoryVouchers', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Items'), ['controller' => 'Items', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Item'), ['controller' => 'Items', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="transferInventoryVoucherRows form large-9 medium-8 columns content">
    <?= $this->Form->create($transferInventoryVoucherRow) ?>
    <fieldset>
        <legend><?= __('Add Transfer Inventory Voucher Row') ?></legend>
        <?php
            echo $this->Form->control('transfer_inventory_voucher_id', ['options' => $transferInventoryVouchers]);
            echo $this->Form->control('item_id', ['options' => $items]);
            echo $this->Form->control('quantity');
            echo $this->Form->control('waste_quantity');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
