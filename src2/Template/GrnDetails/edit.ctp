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
                ['action' => 'delete', $grnDetail->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $grnDetail->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Grn Details'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Items'), ['controller' => 'Items', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Item'), ['controller' => 'Items', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="grnDetails form large-9 medium-8 columns content">
    <?= $this->Form->create($grnDetail) ?>
    <fieldset>
        <legend><?= __('Edit Grn Detail') ?></legend>
        <?php
            echo $this->Form->control('grn_id');
            echo $this->Form->control('item_id', ['options' => $items]);
            echo $this->Form->control('quantity');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
