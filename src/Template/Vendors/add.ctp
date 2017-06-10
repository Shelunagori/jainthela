<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Vendors'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Franchises'), ['controller' => 'Franchises', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Franchise'), ['controller' => 'Franchises', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="vendors form large-9 medium-8 columns content">
    <?= $this->Form->create($vendor) ?>
    <fieldset>
        <legend><?= __('Add Vendor') ?></legend>
        <?php
            echo $this->Form->control('name');
            echo $this->Form->control('address');
            echo $this->Form->control('mobile');
            echo $this->Form->control('email');
            echo $this->Form->control('franchise_id', ['options' => $franchises]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
