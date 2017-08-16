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
                ['action' => 'delete', $comboOfferDetail->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $comboOfferDetail->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Combo Offer Details'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Combo Offers'), ['controller' => 'ComboOffers', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Combo Offer'), ['controller' => 'ComboOffers', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Items'), ['controller' => 'Items', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Item'), ['controller' => 'Items', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="comboOfferDetails form large-9 medium-8 columns content">
    <?= $this->Form->create($comboOfferDetail) ?>
    <fieldset>
        <legend><?= __('Edit Combo Offer Detail') ?></legend>
        <?php
            echo $this->Form->control('combo_offer_id', ['options' => $comboOffers]);
            echo $this->Form->control('item_id', ['options' => $items]);
            echo $this->Form->control('quantity');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
