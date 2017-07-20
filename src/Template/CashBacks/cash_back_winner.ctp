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
							
							<th scope="col">Sr</th>
							<th scope="col">#</th>
							<th scope="col">Customer Name</th>
							<th scope="col">Amount</th>
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
							<td><?= h($sr_no) ?></td>
							<td><?php echo '<span class="badge badge-success tooltips">'?><?= h($firstCharacter) ?><?php echo '</span>'; ?></td>
							<td><?= h($customer_name.' ('.$customer_mobile.')') ?></td>
							
							
							<td><?= h($cb->amount) ?></td>
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
				