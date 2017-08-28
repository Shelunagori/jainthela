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
						<i class="fa fa-plus"></i>First Order Discount Report
					</span>
				</div>
				<div class="actions">
					<input type="text" class="form-control input-sm pull-right" placeholder="Search..." id="search3" style="width: 200px;">
				</div>
			</div>
			<div class="portlet-body">
				<table class="table table-condensed table-hover table-bordered" id="main_tble">
					<thead>
						<tr>
							<th>Sr</th>
							<th>Name</th>
							<th>Registration Date</th>
							<th>First Order Delivered</th>
							<th>Cash Back Won</th>
						</tr>
					</thead>
					<tbody>
						<?php $i=0;
						foreach ($customers as $customer): 
						$i++;
						$customer_id=$customer->id;
						$name=$customer->name;
						$mobile=$customer->mobile;
						if(!empty($mobile)){
							$show_name=$name.' ('.$mobile.')';
						}else{
							$show_name=$name;
						}
						?>
						<tr>
							<td><?= $i ?></td>
							<td><?= h($show_name) ?></td>
							<td><?= h(h($customer->created_on)) ?></td>
							<td><?php if($total_order[$customer_id]>0) { echo 'Yes';} else { echo '-'; } ?></td>
							<td><?php if($customer->first_time_win_status =='Yes') { echo $customer->first_time_win_status; }  else { echo '-'; } ?></td>
							
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