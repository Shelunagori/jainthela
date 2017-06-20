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
                ['action' => 'delete', $comboOffer->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $comboOffer->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Combo Offers'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Combo Offer Details'), ['controller' => 'ComboOfferDetails', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Combo Offer Detail'), ['controller' => 'ComboOfferDetails', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="comboOffers form large-9 medium-8 columns content">
    <?= $this->Form->create($comboOffer) ?>
    <fieldset>
        <legend><?= __('Edit Combo Offer') ?></legend>
        <?php
            echo $this->Form->control('name');
            echo $this->Form->control('print_rate');
            echo $this->Form->control('discount_per');
            echo $this->Form->control('sales_rate');
            echo $this->Form->control('created_on');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
