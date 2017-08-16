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
                ['action' => 'delete', $customerAddress->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $customerAddress->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Customer Addresses'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Customers'), ['controller' => 'Customers', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Customer'), ['controller' => 'Customers', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="customerAddresses form large-9 medium-8 columns content">
    <?= $this->Form->create($customerAddress) ?>
    <fieldset>
        <legend><?= __('Edit Customer Address') ?></legend>
        <?php
            echo $this->Form->control('customer_id', ['options' => $customers]);
            echo $this->Form->control('name');
            echo $this->Form->control('mobile');
            echo $this->Form->control('house_no');
            echo $this->Form->control('address');
            echo $this->Form->control('locality');
            echo $this->Form->control('default_address');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
