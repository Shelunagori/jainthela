<?php
/**
  * @var \App\View\AppView $this
  * @var \App\Model\Entity\ItemSubCategory $itemSubCategory
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Item Sub Category'), ['action' => 'edit', $itemSubCategory->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Item Sub Category'), ['action' => 'delete', $itemSubCategory->id], ['confirm' => __('Are you sure you want to delete # {0}?', $itemSubCategory->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Item Sub Categories'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Item Sub Category'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Item Categories'), ['controller' => 'ItemCategories', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Item Category'), ['controller' => 'ItemCategories', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Items'), ['controller' => 'Items', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Item'), ['controller' => 'Items', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="itemSubCategories view large-9 medium-8 columns content">
    <h3><?= h($itemSubCategory->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Item Category') ?></th>
            <td><?= $itemSubCategory->has('item_category') ? $this->Html->link($itemSubCategory->item_category->name, ['controller' => 'ItemCategories', 'action' => 'view', $itemSubCategory->item_category->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($itemSubCategory->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($itemSubCategory->id) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Items') ?></h4>
        <?php if (!empty($itemSubCategory->items)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Name') ?></th>
                <th scope="col"><?= __('Item Category Id') ?></th>
                <th scope="col"><?= __('Item Sub Category Id') ?></th>
                <th scope="col"><?= __('Unit Id') ?></th>
                <th scope="col"><?= __('Alias Name') ?></th>
                <th scope="col"><?= __('Description') ?></th>
                <th scope="col"><?= __('Minimum Stock') ?></th>
                <th scope="col"><?= __('Freeze') ?></th>
                <th scope="col"><?= __('Minimum Quantity Factor') ?></th>
                <th scope="col"><?= __('Print Quantity') ?></th>
                <th scope="col"><?= __('Seller Id') ?></th>
                <th scope="col"><?= __('Jain Thela Admin Id') ?></th>
                <th scope="col"><?= __('Ready To Sale') ?></th>
                <th scope="col"><?= __('Print Rate') ?></th>
                <th scope="col"><?= __('Discount Per') ?></th>
                <th scope="col"><?= __('Sales Rate') ?></th>
                <th scope="col"><?= __('Is Combo') ?></th>
                <th scope="col"><?= __('Out Of Stock') ?></th>
                <th scope="col"><?= __('Image') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($itemSubCategory->items as $items): ?>
            <tr>
                <td><?= h($items->id) ?></td>
                <td><?= h($items->name) ?></td>
                <td><?= h($items->item_category_id) ?></td>
                <td><?= h($items->item_sub_category_id) ?></td>
                <td><?= h($items->unit_id) ?></td>
                <td><?= h($items->alias_name) ?></td>
                <td><?= h($items->description) ?></td>
                <td><?= h($items->minimum_stock) ?></td>
                <td><?= h($items->freeze) ?></td>
                <td><?= h($items->minimum_quantity_factor) ?></td>
                <td><?= h($items->print_quantity) ?></td>
                <td><?= h($items->seller_id) ?></td>
                <td><?= h($items->jain_thela_admin_id) ?></td>
                <td><?= h($items->ready_to_sale) ?></td>
                <td><?= h($items->print_rate) ?></td>
                <td><?= h($items->discount_per) ?></td>
                <td><?= h($items->sales_rate) ?></td>
                <td><?= h($items->is_combo) ?></td>
                <td><?= h($items->out_of_stock) ?></td>
                <td><?= h($items->image) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Items', 'action' => 'view', $items->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Items', 'action' => 'edit', $items->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Items', 'action' => 'delete', $items->id], ['confirm' => __('Are you sure you want to delete # {0}?', $items->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
