<?php $url_excel="/?".$url; ?>
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
						<i class="fa fa-plus"></i> Issue Return Report
					</span>
				</div>
				<div class="actions"> 
					<?php echo $this->Html->link( '<i class="fa fa-file-excel-o"></i> Excel', '/ItemLedgers/Export-Excel-Item/'.@$url_excel.'',['class' =>'btn btn-sm green tooltips pull-right','target'=>'_blank','escape'=>false,'data-original-title'=>'Download as excel']); ?>
					
				</div>
				
			</div>
			<div class="portlet-body">
				<form method="GET">
					<div class="col-md-12">
						<div class="col-md-3">
							<?php echo $this->Form->control('from',['placeholder'=>'Date From','class'=>'form-control input-sm date-picker from','data-date-format'=>'dd-mm-yyyy','label'=>false,'type'=>'text','value'=>@$from]); ?>
						</div>
						<div class="col-md-3">
							<?php echo $this->Form->control('to',['placeholder'=>'Date To','class'=>'form-control input-sm date-picker go','data-date-format'=>'dd-mm-yyyy','label'=>false,'type'=>'text','value'=>@$to]); ?>
						</div>
						<div class="col-md-2">
							<?php echo $this->Form->input('item_id', ['empty'=>'--Select-','options'=>$items,'label' => false,'class' => 'form-control input-sm attribute select2me', 'value'=>@$item_id]); ?>
						</div>
						<div class="col-md-2">
							<?php echo $this->Form->input('driver_id', ['empty'=>'--Select-','options'=>$drivers,'label' => false,'class' => 'form-control input-sm attribute select2me', 'value'=>@$driver_id]); ?>
						</div>
						<div class="col-md-2">
							<?= $this->Form->button($this->Html->tag('i', '', ['class'=>'fa fa-search']) . __(' Go'),['class'=>'btn btn-success']); ?>
						</div>
					</div>
				</form>
				<br><br>
				<?php $page_no=$this->Paginator->current('Orders'); $page_no=($page_no-1)*20; ?>
				<table class="table table-condensed table-hover table-bordered" id="main_tble">
					<thead>
						<tr>
							<th>Sr.no</th>
							<th>Date</th>
							<th>Time</th>
							<th>Driver</th>
							<th>Item</th>
							<th>Issue</th>
							<th>Return</th>
						</tr>
					</thead>
					<tbody>
						<?php $sr_no=0; foreach ($item_ledgers as $item_ledger): 
						
						$transaction_date=$item_ledger->transaction_date;
						$org_transaction_date=date('d-M-Y');
						$created_on=$item_ledger->created_on;
						
						$order_time=date('h:i a', strtotime($created_on));
						$actual_date=date('d-M-Y', strtotime($transaction_date));
						$status=$item_ledger->status;
						$quantity=$item_ledger->quantity;
						@$driver_name=$item_ledger->driver->name;
						$item_name=$item_ledger->item->name;
						$unit_name=$item_ledger->item->unit->unit_name;
						if($quantity>0){
						?>
						<tr>
							<td><?= $this->Number->format(++$sr_no) ?></td>
							<td><?= h($actual_date) ?></td>
							<td><?= h($order_time) ?></td>
							<td><?= h($driver_name) ?></td>
							<td><?= h($item_name) ?></td>
							<?php if($status=='In'){ ?>
								<td align="right"><?= h($quantity.' '.$unit_name) ?></td>
								<td></td>
							<?php }	if($status=='out'){ ?>
								<td></td>
								<td align="right"><?= h($quantity.' '.$unit_name) ?></td>
							<?php } ?>
						</tr>
						<?php 
							}
						endforeach; ?>
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