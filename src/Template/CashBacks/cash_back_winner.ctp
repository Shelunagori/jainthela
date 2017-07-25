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
						<i class="fa fa-book"></i> Cash Back Winners</span>
				</div>
				<div class="actions"> 
					<input type="text" class="form-control input-sm pull-right" placeholder="Search..." id="search3"  style="width: 200px;">
				</div>	
			</div>
			<div class="portlet-body">
				<table class="table table-bordered table-condensed" id="main_tble">
					<thead>
						<tr>
							
							<th scope="col">#</th>
							<th scope="col">Customer Name</th>
							<th scope="col">Cash Back No.</th>
							<th scope="col">Order No.</th>
							<th scope="col">Winning Amount</th>
							<th scope="col">Winning Date</th>
							<th scope="col">Claimed/Not Claimed</th>
						</tr>
					</thead>
					<tbody>
						
						<?php
						$sr_no=0; foreach ($fetch_cashback_win_details as $cb): $sr_no++;
						$customer_name=$cb->customer->name;
						$customer_mobile=$cb->customer->mobile;
						$firstCharacter = substr($customer_name, 0, 1);
						
						?>
						<tr >
							<td><?php if($cb->claim=='yes'){ ?><?php echo '<span class="badge badge-success tooltips">'?><?php } else {?><?php echo '<span class="badge badge-warning tooltips">'?><?php } ?><?= h(ucwords($firstCharacter)) ?><?php echo '</span>'; ?></td>
							<td><?= h(ucwords($customer_name).' ('.$customer_mobile.')') ?></td>
							<td><?= h('#'.str_pad($cb->cash_back_no, 4, '0', STR_PAD_LEFT)) ?></td>
							<td><?= h($cb->order_no) ?></td>
							<td><?php echo $this->Number->format($cb->amount,['places'=>2]); ?></td>
							<td><?= h(date('d-m-Y',strtotime($cb->created_on))) ?></td>
							<td><?php if($cb->claim=='yes'){ ?><a class="btn green btn-xs" >Claimed</a><?php } else {?><a class="btn red btn-xs" >Not Claimed</a><?php } ?>
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
				