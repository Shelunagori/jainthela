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
                ['action' => 'delete', $cart->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $cart->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Carts'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Customers'), ['controller' => 'Customers', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Customer'), ['controller' => 'Customers', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Items'), ['controller' => 'Items', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Item'), ['controller' => 'Items', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="carts form large-9 medium-8 columns content">
    <?= $this->Form->create($cart) ?>
    <fieldset>
        <legend><?= __('Edit Cart') ?></legend>
        <?php
            echo $this->Form->control('customer_id', ['options' => $customers]);
            echo $this->Form->control('item_id', ['options' => $items]);
            echo $this->Form->control('quantity');
<<<<<<< HEAD
            echo $this->Form->control('cart_count');
=======
>>>>>>> 8ad41ceb2ec85f2b846b3156a3e5d37a6c786214
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
