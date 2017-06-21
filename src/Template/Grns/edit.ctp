<?php
/**
  * @var \App\View\AppView $this
  */
?>+++
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $grn->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $grn->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Grns'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Vendors'), ['controller' => 'Vendors', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Vendor'), ['controller' => 'Vendors', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Cities'), ['controller' => 'Cities', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New City'), ['controller' => 'Cities', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="grns form large-9 medium-8 columns content">
    <?= $this->Form->create($grn) ?>
    <fieldset>
        <legend><?= __('Edit Grn') ?></legend>
        <?php
            echo $this->Form->control('grn_no');
            echo $this->Form->control('transaction_date');
            echo $this->Form->control('vendor_id', ['options' => $vendors]);
            echo $this->Form->control('city_id', ['options' => $cities]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
