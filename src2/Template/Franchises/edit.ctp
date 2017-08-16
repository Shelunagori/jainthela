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
                ['action' => 'delete', $franchise->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $franchise->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Franchises'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Cities'), ['controller' => 'Cities', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New City'), ['controller' => 'Cities', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Franchise Item Categories'), ['controller' => 'FranchiseItemCategories', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Franchise Item Category'), ['controller' => 'FranchiseItemCategories', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="franchises form large-9 medium-8 columns content">
    <?= $this->Form->create($franchise) ?>
    <fieldset>
        <legend><?= __('Edit Franchise') ?></legend>
        <?php
            echo $this->Form->control('name');
            echo $this->Form->control('city_id', ['options' => $cities]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
