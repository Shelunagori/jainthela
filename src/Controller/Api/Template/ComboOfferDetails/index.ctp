<?php
/**
  * @var \App\View\AppView $this
  * @var \App\Model\Entity\ComboOfferDetail[]|\Cake\Collection\CollectionInterface $comboOfferDetails
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Combo Offer Detail'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Combo Offers'), ['controller' => 'ComboOffers', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Combo Offer'), ['controller' => 'ComboOffers', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Items'), ['controller' => 'Items', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Item'), ['controller' => 'Items', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="comboOfferDetails index large-9 medium-8 columns content">
    <h3><?= __('Combo Offer Details') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('combo_offer_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('item_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('quantity') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($comboOfferDetails as $comboOfferDetail): ?>
            <tr>
                <td><?= $this->Number->format($comboOfferDetail->id) ?></td>
                <td><?= $comboOfferDetail->has('combo_offer') ? $this->Html->link($comboOfferDetail->combo_offer->name, ['controller' => 'ComboOffers', 'action' => 'view', $comboOfferDetail->combo_offer->id]) : '' ?></td>
                <td><?= $comboOfferDetail->has('item') ? $this->Html->link($comboOfferDetail->item->name, ['controller' => 'Items', 'action' => 'view', $comboOfferDetail->item->id]) : '' ?></td>
                <td><?= $this->Number->format($comboOfferDetail->quantity) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $comboOfferDetail->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $comboOfferDetail->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $comboOfferDetail->id], ['confirm' => __('Are you sure you want to delete # {0}?', $comboOfferDetail->id)]) ?>
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
