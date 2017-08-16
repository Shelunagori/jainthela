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
                ['action' => 'delete', $purchaseOutward->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $purchaseOutward->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Purchase Outwards'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Vendors'), ['controller' => 'Vendors', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Vendor'), ['controller' => 'Vendors', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Jain Thela Admins'), ['controller' => 'JainThelaAdmins', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Jain Thela Admin'), ['controller' => 'JainThelaAdmins', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Purchase Outward Details'), ['controller' => 'PurchaseOutwardDetails', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Purchase Outward Detail'), ['controller' => 'PurchaseOutwardDetails', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="purchaseOutwards form large-9 medium-8 columns content">
    <?= $this->Form->create($purchaseOutward) ?>
    <fieldset>
        <legend><?= __('Edit Purchase Outward') ?></legend>
        <?php
            echo $this->Form->control('voucher_no');
            echo $this->Form->control('transaction_date');
            echo $this->Form->control('vendor_id', ['options' => $vendors]);
            echo $this->Form->control('jain_thela_admin_id', ['options' => $jainThelaAdmins]);
            echo $this->Form->control('total_amount');
            echo $this->Form->control('created_on');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
