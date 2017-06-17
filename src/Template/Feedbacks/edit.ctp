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
                ['action' => 'delete', $feedback->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $feedback->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Feedbacks'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Customers'), ['controller' => 'Customers', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Customer'), ['controller' => 'Customers', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="feedbacks form large-9 medium-8 columns content">
    <?= $this->Form->create($feedback) ?>
    <fieldset>
        <legend><?= __('Edit Feedback') ?></legend>
        <?php
            echo $this->Form->control('customer_id', ['options' => $customers]);
            echo $this->Form->control('comments');
            echo $this->Form->control('created_on');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
