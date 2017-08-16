<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Purchase Outward Details'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Purchase Outwards'), ['controller' => 'PurchaseOutwards', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Purchase Outward'), ['controller' => 'PurchaseOutwards', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Items'), ['controller' => 'Items', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Item'), ['controller' => 'Items', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="purchaseOutwardDetails form large-9 medium-8 columns content">
    <?= $this->Form->create($purchaseOutwardDetail) ?>
    <fieldset>
        <legend><?= __('Add Purchase Outward Detail') ?></legend>
        <?php
            echo $this->Form->control('purchase_outward_id', ['options' => $purchaseOutwards]);
            echo $this->Form->control('item_id', ['options' => $items]);
            echo $this->Form->control('quantity');
            echo $this->Form->control('invoice_quantity');
            echo $this->Form->control('rate');
            echo $this->Form->control('amount');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
