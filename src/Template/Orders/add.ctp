<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Orders'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Customers'), ['controller' => 'Customers', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Customer'), ['controller' => 'Customers', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Promo Codes'), ['controller' => 'PromoCodes', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Promo Code'), ['controller' => 'PromoCodes', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Franchises'), ['controller' => 'Franchises', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Franchise'), ['controller' => 'Franchises', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Order Details'), ['controller' => 'OrderDetails', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Order Detail'), ['controller' => 'OrderDetails', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="orders form large-9 medium-8 columns content">
    <?= $this->Form->create($order) ?>
    <fieldset>
        <legend><?= __('Add Order') ?></legend>
        <?php
            echo $this->Form->control('order_no');
            echo $this->Form->control('order_date');
            echo $this->Form->control('customer_id', ['options' => $customers]);
            echo $this->Form->control('delivery_charges');
            echo $this->Form->control('amount_from_wallet');
            echo $this->Form->control('amount_from_jain_cash');
            echo $this->Form->control('amount_from_promocode');
            echo $this->Form->control('promo_code_id', ['options' => $promoCodes]);
            echo $this->Form->control('order_type');
            echo $this->Form->control('franchise_id', ['options' => $franchises]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
