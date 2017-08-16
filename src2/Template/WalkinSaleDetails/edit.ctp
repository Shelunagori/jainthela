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
                ['action' => 'delete', $walkinSaleDetail->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $walkinSaleDetail->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Walkin Sale Details'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Walkin Sales'), ['controller' => 'WalkinSales', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Walkin Sale'), ['controller' => 'WalkinSales', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Items'), ['controller' => 'Items', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Item'), ['controller' => 'Items', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="walkinSaleDetails form large-9 medium-8 columns content">
    <?= $this->Form->create($walkinSaleDetail) ?>
    <fieldset>
        <legend><?= __('Edit Walkin Sale Detail') ?></legend>
        <?php
            echo $this->Form->control('walkin_sale_id', ['options' => $walkinSales]);
            echo $this->Form->control('item_id', ['options' => $items]);
            echo $this->Form->control('quantity');
            echo $this->Form->control('rate');
            echo $this->Form->control('amount');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
