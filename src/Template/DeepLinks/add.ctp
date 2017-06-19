<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Deep Links'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="deepLinks form large-9 medium-8 columns content">
    <?= $this->Form->create($deepLink) ?>
    <fieldset>
        <legend><?= __('Add Deep Link') ?></legend>
        <?php
            echo $this->Form->control('link_name');
            echo $this->Form->control('link_url');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
