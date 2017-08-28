<style>
.table>thead>tr>th, .table > tbody > tr > td{
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
						<i class="fa fa-plus"></i> Combo Offers
					</span>
				</div>
				<div class="actions">
					<?php echo $this->Html->link('<i class="fa fa-plus"></i> Add','/ComboOffers/add',['escape'=>false,'class'=>'btn btn-default']) ?>
					&nbsp;					
					<input type="text" class="form-control input-sm pull-right" placeholder="Search..." id="search3"  style="width: 200px;">
				</div>
			</div>
			<div class="portlet-body">
				<table class="table table-condensed table-hover table-bordered" id="main_tble">
					<thead>
						<tr>
							<tr>
								<th>Sr</th>
								<th>Name</th>
								<th>Actual Rate</th>
								<th>Discount</th>
								<th>Sales Rate</th>
								<th>Date</th>
								<th class="actions"><?= __('Actions') ?></th>
							</tr>
						</tr>
					</thead>
					<tbody>
					<?php foreach ($comboOffers as $comboOffer): 
							@$i++;
							?>
						<tr>
							<td><?= h($i) ?></td>
							<td><?= h($comboOffer->name) ?></td>
							<td><?= h($comboOffer->print_rate) ?></td>
							<td><?= h($comboOffer->discount_per.' %') ?></td>
							<td><?= h($comboOffer->sales_rate)?></td>
							<td><?= h(date('d-M-Y', strtotime($comboOffer->created_on))) ?></td>
							<td class="actions">
								<?= $this->Html->link(__('View'), ['action' => 'view', $comboOffer->id]) ?>
								<?php //$this->Html->link(__('Edit'), ['action' => 'edit', $comboOffer->id]) ?>
								
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
<script>
var $rows = $('#main_tble tbody tr');
	$('#search3').on('keyup',function() {
		var val = $.trim($(this).val()).replace(/ +/g, ' ').toLowerCase();
		var v = $(this).val();
		if(v){ 
			$rows.show().filter(function() {
				var text = $(this).text().replace(/\s+/g, ' ').toLowerCase();
	
				return !~text.indexOf(val);
			}).hide();
		}else{
			$rows.show();
		}
	});
</script>