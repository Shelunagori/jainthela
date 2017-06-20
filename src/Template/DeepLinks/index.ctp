<?php
/**
  * @var \App\View\AppView $this
  * @var \App\Model\Entity\DeepLink[]|\Cake\Collection\CollectionInterface $deepLinks
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Deep Link'), ['action' => 'add']) ?></li>
    </ul>
</nav>
<div class="deepLinks index large-9 medium-8 columns content">
    <h3><?= __('Deep Links') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('link_name') ?></th>
                <th scope="col"><?= $this->Paginator->sort('link_url') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($deepLinks as $deepLink): ?>
            <tr>
                <td><?= $this->Number->format($deepLink->id) ?></td>
                <td><?= h($deepLink->link_name) ?></td>
                <td><?= h($deepLink->link_url) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $deepLink->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $deepLink->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $deepLink->id], ['confirm' => __('Are you sure you want to delete # {0}?', $deepLink->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
    </div>
</div>
