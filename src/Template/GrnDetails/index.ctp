<?php
/**
  * @var \App\View\AppView $this
  * @var \App\Model\Entity\GrnDetail[]|\Cake\Collection\CollectionInterface $grnDetails
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Grn Detail'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Items'), ['controller' => 'Items', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Item'), ['controller' => 'Items', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="grnDetails index large-9 medium-8 columns content">
    <h3><?= __('Grn Details') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('grn_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('item_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('quantity') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($grnDetails as $grnDetail): ?>
            <tr>
                <td><?= $this->Number->format($grnDetail->id) ?></td>
                <td><?= $this->Number->format($grnDetail->grn_id) ?></td>
                <td><?= $grnDetail->has('item') ? $this->Html->link($grnDetail->item->name, ['controller' => 'Items', 'action' => 'view', $grnDetail->item->id]) : '' ?></td>
                <td><?= $this->Number->format($grnDetail->quantity) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $grnDetail->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $grnDetail->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $grnDetail->id], ['confirm' => __('Are you sure you want to delete # {0}?', $grnDetail->id)]) ?>
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
