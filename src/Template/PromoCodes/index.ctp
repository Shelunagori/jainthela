<?php
/**
  * @var \App\View\AppView $this
  * @var \App\Model\Entity\PromoCode[]|\Cake\Collection\CollectionInterface $promoCodes
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Promo Code'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Item Categories'), ['controller' => 'ItemCategories', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Item Category'), ['controller' => 'ItemCategories', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Jain Thela Admins'), ['controller' => 'JainThelaAdmins', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Jain Thela Admin'), ['controller' => 'JainThelaAdmins', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Orders'), ['controller' => 'Orders', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Order'), ['controller' => 'Orders', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="promoCodes index large-9 medium-8 columns content">
    <h3><?= __('Promo Codes') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('code') ?></th>
                <th scope="col"><?= $this->Paginator->sort('discount_per') ?></th>
                <th scope="col"><?= $this->Paginator->sort('item_category_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('jain_thela_admin_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('valid_from') ?></th>
                <th scope="col"><?= $this->Paginator->sort('valid_to') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created_on') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($promoCodes as $promoCode): ?>
            <tr>
                <td><?= $this->Number->format($promoCode->id) ?></td>
                <td><?= h($promoCode->code) ?></td>
                <td><?= $this->Number->format($promoCode->discount_per) ?></td>
                <td><?= $promoCode->has('item_category') ? $this->Html->link($promoCode->item_category->name, ['controller' => 'ItemCategories', 'action' => 'view', $promoCode->item_category->id]) : '' ?></td>
                <td><?= $promoCode->has('jain_thela_admin') ? $this->Html->link($promoCode->jain_thela_admin->name, ['controller' => 'JainThelaAdmins', 'action' => 'view', $promoCode->jain_thela_admin->id]) : '' ?></td>
                <td><?= h($promoCode->valid_from) ?></td>
                <td><?= h($promoCode->valid_to) ?></td>
                <td><?= h($promoCode->created_on) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $promoCode->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $promoCode->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $promoCode->id], ['confirm' => __('Are you sure you want to delete # {0}?', $promoCode->id)]) ?>
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
