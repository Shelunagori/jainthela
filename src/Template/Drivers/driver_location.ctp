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
					<span class="caption-subject font-purple-intense">
						<i class="fa fa-plus"></i> Driver Location Report
					</span>
				</div>
				<div class="actions">
					<input type="text" class="form-control input-sm pull-right" placeholder="Search..." id="search3" style="width: 200px;">
				</div>
			</div>
			<div class="portlet-body">
				<?php $page_no=$this->Paginator->current('Orders'); $page_no=($page_no-1)*20; ?>
				<table class="table table-condensed table-hover table-bordered" id="main_tble">
					<thead>
						<tr>
							<th>Sr.no</th>
							<th>Driver</th>
							<th>lattitude</th>
							<th>longitude</th>
							<th>Date</th>
						</tr>
					</thead>
					<tbody>
						<?php $sr_no=0; foreach ($driver_details as $driver_detail): 
						
						$created_on=date('d-m-Y h:i a', strtotime($driver_detail->created_on));
						$longitude=$driver_detail->longitude;
						$lattitude=$driver_detail->lattitude;
						$driver_name=$driver_detail->driver->name;
						?>
						<tr>
							<td><?= $this->Number->format(++$sr_no) ?></td>
							<td><?= h($driver_name) ?></td>
							<td><?= h($lattitude) ?></td>
							<td><?= h($longitude) ?></td>
							<td><?= h($created_on) ?></td>
						</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
				<div class="paginator">
					<ul class="pagination">
						<?= $this->Paginator->first('<< ' . __('first')) ?>
						<?= $this->Paginator->prev('< ' . __('previous')) ?>
						<?= $this->Paginator->numbers() ?>
						<?= $this->Paginator->next(__('next') . ' >') ?>
						<?= $this->Paginator->last(__('last') . ' >>') ?>
					</ul>
					<p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
				</div>
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
	

$(document).ready(function() {	
	$('.go').die().live('change',function()
	{ 
		$('#data').html('<i style= "margin-top: 20px;" class="fa fa-refresh fa-spin fa-3x fa-fw"></i><b> Loading... </b>');
		var dat_from = $(".from").val();
		var dat_to = $(this).val();
 		var m_data = new FormData();
		m_data.append('dat_from',dat_from);
		m_data.append('dat_to',dat_to);

		$.ajax({
			url: "<?php echo $this->Url->build(["controller" => "ItemLedgers", "action" => "ajax_item_issue_report"]); ?>",
			data: m_data,
			processData: false,
			contentType: false,
			type: 'POST',
			dataType:'text',
			success: function(data)   // A function to be called if request succeeds
			{
				alert(data);
				$('#data').html(data);
				 
			}	
		});	
	});
});
</script>