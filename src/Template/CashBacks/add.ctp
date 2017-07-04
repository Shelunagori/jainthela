<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Cash Backs'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Customers'), ['controller' => 'Customers', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Customer'), ['controller' => 'Customers', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="cashBacks form large-9 medium-8 columns content">
    <?= $this->Form->create($cashBack) ?>
    <fieldset>
        <legend><?= __('Add Cash Back') ?></legend>
        <?php
            echo $this->Form->control('cash_back_no');
            echo $this->Form->control('customer_id', ['options' => $customers]);
            echo $this->Form->control('amount');
            echo $this->Form->control('claim');
            echo $this->Form->control('created_on');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
