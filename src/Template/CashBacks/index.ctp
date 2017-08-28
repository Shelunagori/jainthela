<?php $url_excel="/?".$url; ?>
<style>
.table>thead>tr>th{
	font-size:12px !important;
}
.YES{
	color:green;
	
}
</style>
<div class="row">
	<div class="col-md-12">
		<div class="portlet light bordered">
			<div class="portlet-title">
				<div class="caption">
					<i class="font-purple-intense"></i>
					<span class="caption-subject font-purple-intense ">
						<i class="fa fa-book"></i> Cash Back Details</span>
				</div>
				<div class="actions"> 
				<?php echo $this->Html->link( '<i class="fa fa-file-excel-o"></i> Excel', '/CashBacks/Export-Excel/'.@$url_excel.'',['class' =>'btn btn-sm green tooltips pull-right','target'=>'_blank','escape'=>false,'data-original-title'=>'Download as excel']); ?>
					<input type="text" class="form-control input-sm pull-right" placeholder="Search..." id="search3"  style="width: 200px;margin-right: 5px;">
					
				</div>	
			</div>
			<div class="portlet-body">
				
				<table class="table table-bordered table-condensed" id="main_tble">
					<thead>
						<tr>
							<th scope="col">S.No</th>
							<th scope="col">Customer Name</th>
							<th scope="col">Order No.</th>
							<th style="text-align:right;" scope="col">Amount</th>
							<th scope="col">CashBack(%)</th>
							<th scope="col">CashBack(Limit)</th>
							<th scope="col">Won</th>
							<th scope="col">Claim</th>
							<th scope="col">Created On</th>
							<th scope="col" class="actions"><?= __('Actions') ?></th>
							
						</tr>
					</thead>
					<tbody>
						<?php
						
						
						$sr_no=0; foreach ($cashBacks as $cb): $sr_no++;
						$created_on=date('d-m-Y', strtotime($cb->created_on));
						$customer_name=ucwords($cb->customer->name);
						$customer_mobile=$cb->customer->mobile;
						if($cb->won=='yes')
						{
						$winner='YES';
						}
						else if($cb->won=='no')
						{
							$winner='NO';
						}
						
						if($cb->claim=='yes')
						{
						$claimed='YES';	
						}
						else if($cb->claim=='no')
						{
							$claimed='NO';
						}
						
						?>
						<tr >
							<td><?= h($sr_no) ?></td>
							<td><?= h($customer_name.' ('.$customer_mobile.')') ?></td>
							<td><?= h($cb->order_no) ?></td>
							<td align="right"><?= h($cb->amount) ?></td>
							<td><?= h($cb->cash_back_percentage . '%') ?></td>
							<td><?= h('After '.$cb->cash_back_limit . ' Cashback ids') ?></td>
							<td class="<?php echo $winner;?>"><b><?= h($winner) ?></b></td>
							<td class="<?php echo $claimed;?>"><b><?= h($claimed) ?></b></td>
							<td><?= $created_on ?></td>
							<td><?php if($cb->won=='no') { ?><?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $cb->id], ['confirm' => __('Are you sure you want to delete Cash Back id for  {0}?', $customer_name)]) ?><?php } ?>
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
$(document).ready(function() {
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
});
</script>				 
				