<style>
.table>thead>tr>th{
	font-size:12px !important;
}
</style>
<div class="row">
	<div class="col-md-12">
		<div class="portlet light bordered">
			<div class="portlet-title">
				<div class="caption">
					<i class="font-purple-intense"></i>
					<span class="caption-subject font-purple-intense ">
						<i class="fa fa-plus"></i> Add Item
					</span>
				</div>
				<div class="actions"></div>
			</div>
			<div class="portlet-body">
				<table class="table table-condensed table-hover table-bordered">
					<thead>
						<tr>
							<th>Sr</th>
							<th>Name</th>
							<th>Alias</th>
							<th>Unit</th>
							<th>Item Category</th>
							<th>Minimum Stock</th>
							<th>Freeze</th>
							<th>Minimum Quantity Factor</th>
							<th scope="col" class="actions"><?= __('Actions') ?></th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($items as $item): ?>
						<tr>
							<td><?= $this->Number->format($item->id) ?></td>
							<td><?= h($item->name) ?></td>
							<td><?= h($item->alias_name) ?></td>
							<td><?= h($item->unit->shortname) ?></td>
							<td><?= h($item->item_category->name) ?></td>
							
							
							<td><?= $this->Number->format($item->minimum_stock) ?></td>
							<td><?= h($item->freeze) ?></td>
							<td><?= $this->Number->format($item->minimum_quantity_factor) ?></td>
							<td class="actions">
								<?= $this->Html->link(__('Edit'), ['action' => 'edit', $item->id]) ?>
								<?= $this->Form->postLink(__('Freeze'), ['action' => 'delete', $item->id], ['confirm' => __('Are you sure you want to delete # {0}?', $item->id)]) ?>
							</td>
						</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
<?php echo $this->Html->script('/assets/global/plugins/jquery.min.js'); ?>
