<?php
/**
  * @var \App\View\AppView $this
  * @var \App\Model\Entity\ComboOffer $comboOffer
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Combo Offer'), ['action' => 'edit', $comboOffer->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Combo Offer'), ['action' => 'delete', $comboOffer->id], ['confirm' => __('Are you sure you want to delete # {0}?', $comboOffer->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Combo Offers'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Combo Offer'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Combo Offer Details'), ['controller' => 'ComboOfferDetails', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Combo Offer Detail'), ['controller' => 'ComboOfferDetails', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="comboOffers view large-9 medium-8 columns content">
    <h3><?= h($comboOffer->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($comboOffer->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= $this->Number->format($comboOffer->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Print Rate') ?></th>
            <td><?= $this->Number->format($comboOffer->print_rate) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Discount Per') ?></th>
            <td><?= $this->Number->format($comboOffer->discount_per) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Sales Rate') ?></th>
            <td><?= $this->Number->format($comboOffer->sales_rate) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created On') ?></th>
            <td><?= h($comboOffer->created_on) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Combo Offer Details') ?></h4>
        <?php if (!empty($comboOffer->combo_offer_details)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Combo Offer Id') ?></th>
                <th scope="col"><?= __('Item Id') ?></th>
                <th scope="col"><?= __('Quantity') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($comboOffer->combo_offer_details as $comboOfferDetails): ?>
            <tr>
                <td><?= h($comboOfferDetails->id) ?></td>
                <td><?= h($comboOfferDetails->combo_offer_id) ?></td>
                <td><?= h($comboOfferDetails->item_id) ?></td>
                <td><?= h($comboOfferDetails->quantity) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'ComboOfferDetails', 'action' => 'view', $comboOfferDetails->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'ComboOfferDetails', 'action' => 'edit', $comboOfferDetails->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'ComboOfferDetails', 'action' => 'delete', $comboOfferDetails->id], ['confirm' => __('Are you sure you want to delete # {0}?', $comboOfferDetails->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
