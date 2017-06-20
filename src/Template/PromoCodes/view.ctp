<?php
/**
  * @var \App\View\AppView $this
  * @var \App\Model\Entity\PromoCode $promoCode
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Promo Code'), ['action' => 'edit', $promoCode->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Promo Code'), ['action' => 'delete', $promoCode->id], ['confirm' => __('Are you sure you want to delete # {0}?', $promoCode->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Promo Codes'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Promo Code'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Item Categories'), ['controller' => 'ItemCategories', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Item Category'), ['controller' => 'ItemCategories', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Jain Thela Admins'), ['controller' => 'JainThelaAdmins', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Jain Thela Admin'), ['controller' => 'JainThelaAdmins', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Orders'), ['controller' => 'Orders', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Order'), ['controller' => 'Orders', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="promoCodes view large-9 medium-8 columns content">
    <h3><?= h($promoCode->code) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Code') ?></th>
            <td><?= h($promoCode->code) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Item Category') ?></th>
            <td><?= $promoCode->has('item_category') ? $this->Html->link($promoCode->item_category->name, ['controller' => 'ItemCategories', 'action' => 'view', $promoCode->item_category->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Jain Thela Admin') ?></th>
            <td><?= $promoCode->has('jain_thela_admin') ? $this->Html->link($promoCode->jain_thela_admin->name, ['controller' => 'JainThelaAdmins', 'action' => 'view', $promoCode->jain_thela_admin->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($promoCode->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Discount Per') ?></th>
            <td><?= $this->Number->format($promoCode->discount_per) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Valid From') ?></th>
            <td><?= h($promoCode->valid_from) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Valid To') ?></th>
            <td><?= h($promoCode->valid_to) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created On') ?></th>
            <td><?= h($promoCode->created_on) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Orders') ?></h4>
        <?php if (!empty($promoCode->orders)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Order No') ?></th>
                <th scope="col"><?= __('Jain Thela Admin Id') ?></th>
                <th scope="col"><?= __('Customer Id') ?></th>
                <th scope="col"><?= __('Amount From Wallet') ?></th>
                <th scope="col"><?= __('Amount From Jain Cash') ?></th>
                <th scope="col"><?= __('Amount From Promo Code') ?></th>
                <th scope="col"><?= __('Total Amount') ?></th>
                <th scope="col"><?= __('Promo Code Id') ?></th>
                <th scope="col"><?= __('Order Type') ?></th>
                <th scope="col"><?= __('Order Date') ?></th>
                <th scope="col"><?= __('Status') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($promoCode->orders as $orders): ?>
            <tr>
                <td><?= h($orders->id) ?></td>
                <td><?= h($orders->order_no) ?></td>
                <td><?= h($orders->jain_thela_admin_id) ?></td>
                <td><?= h($orders->customer_id) ?></td>
                <td><?= h($orders->amount_from_wallet) ?></td>
                <td><?= h($orders->amount_from_jain_cash) ?></td>
                <td><?= h($orders->amount_from_promo_code) ?></td>
                <td><?= h($orders->total_amount) ?></td>
                <td><?= h($orders->promo_code_id) ?></td>
                <td><?= h($orders->order_type) ?></td>
                <td><?= h($orders->order_date) ?></td>
                <td><?= h($orders->status) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Orders', 'action' => 'view', $orders->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Orders', 'action' => 'edit', $orders->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Orders', 'action' => 'delete', $orders->id], ['confirm' => __('Are you sure you want to delete # {0}?', $orders->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
