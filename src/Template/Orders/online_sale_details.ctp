<div class="portlet light bordered">
	<div class="portlet-title">
		<div class="caption">
			<i class="icon-globe font-blue-steel"></i>
			<span class="caption-subject font-blue-steel ">Online Sale For "<?php foreach ($onlineSales as $onlineSale){ echo $onlineSale->item->name; break; } ?>"</span>
		</div>
		<div class="portlet-body">
			<div class="row">
				<div class="col-md-12">
				<table class="table table-bordered table-striped table-hover">
					<thead>
						<tr>
							<th>Sr. No.</th>
							<th>Order No</th>
							<th>Quantity</th>
						</tr>
					</thead>
					<tbody>
						<?php $i=0; foreach($onlineSales as $onlineSale){ ?> 
						<tr>
							<td><?= h($i++) ?></td>
							<td><?= h(@$onlineSale->order->order_no) ?></td>
							<td><?= h(@$onlineSale->quantity).$onlineSale->item->unit->unit_name ?></td>
						</tr>
						<?php } ?>
					</tbody>
				</table>
				
				</div>
			</div>
		</div>
	</div>
</div>

