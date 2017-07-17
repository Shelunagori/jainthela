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
				
			</div>
			<div class="portlet-body">
				<table class="table table-condensed table-hover table-bordered" id="main_tble">
					<thead>
						<tr style="background-color:#F3F3F3">
							<th scope="col">Sr. No.</th>
							<th scope="col">Created On</th>
							<th scope="col">Order No.</th>
							<th scope="col">Customer Name</th>
							<th scope="col">Cash Back No</th>
							<th scope="col">CashBack(%)</th>
							<th scope="col">CashBack(Limit)</th>
							<th scope="col">Winner</th>
							<th scope="col">Claim</th>
						</tr>
					</thead>
					<tbody>
						<?php
						
						
						$sr_no=0; foreach ($cashBacks as $cb): $sr_no++;
						$created_on=date('d-m-Y', strtotime($cb->created_on));
						
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
						<tr <?php if($cb->won=='yes' && $cb->claim=='yes')
						{
					echo 'style="background-color:#BCDCE5; color:green;style:bold"';
							
						}?>>
							<td><?= $sr_no ?></td>
							<td><?= $created_on ?></td>
							<td><?= h($cb->order_no) ?></td>
							<td><?= h($cb->customer->mobile); echo ' - '; h($cb->customer->name) ?></td>
							<td><b><?= h($cb->cash_back_no) ?></b></td>
							<td><?= h($cb->cash_back_percentage . '%') ?></td>
							<td><?= h('After '.$cb->cash_back_limit . ' Order') ?></td>
							<td class="<?php echo $winner;?>"><b><?= h($winner) ?></b></td>
							<td class="<?php echo $claimed;?>"><b><?= h($claimed) ?></b></td>
						</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
			
				 
				