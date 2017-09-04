<?php $url_excel="/?".$url; ?>
<div class="row">
	<div class="col-md-12">
		<div class="portlet light bordered">
			<div class="portlet-title">
				<div class="caption">
					<i class="font-purple-intense"></i>
					<span class="caption-subject font-purple-intense">
						<i class="fa fa-plus"></i>Stock Voucher Return Report
					</span>
				</div>
				<div class="actions"> 
					<?php echo $this->Html->link( '<i class="fa fa-file-excel-o"></i> Excel', '/StockReturnVouchers/Export-Excel/'.@$url_excel.'',['class' =>'btn btn-sm green tooltips pull-right','target'=>'_blank','escape'=>false,'data-original-title'=>'Download as excel']); ?>
					
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
							<?php echo $this->Form->input('driver_id', ['empty'=>'--Select-','options'=>$drivers,'label' => false,'class' => 'form-control input-sm attribute select2me', 'value'=>@$driver_id]); ?>
						</div>
						<div class="col-md-2">
							<?= $this->Form->button($this->Html->tag('i', '', ['class'=>'fa fa-search']) . __(' Go'),['class'=>'btn btn-success']); ?>
						</div>
					</div>
				</form>
				<br><br>
				<?php $page_no=$this->Paginator->current('ItemLedgers'); $page_no=($page_no-1)*20; ?>
				<table class="table table-condensed table-hover table-bordered" id="main_tble">
					<thead>
						<tr>
							<th>Sr.no</th>
							<th>Voucher No.</th>
							<th>Created Date</th>
							<th>Driver Name</th>
							<th style="text-align:right;">Amount Receivable</th>
							<th style="text-align:right;">Amount Received</th>
							
						</tr>
					</thead>
					<tbody>
					
            <?php @$sr_no =0; foreach ($stockReturnVouchers as $stockReturnVoucher): ?>
            <tr>
                <td><?= $this->Number->format(++$sr_no) ?></td>
				
				<td><?php echo $this->Html->link('#'.str_pad(number_format($stockReturnVoucher->id),4, '0', STR_PAD_LEFT),['controller'=>'StockReturnVouchers','action' => 'view', $stockReturnVoucher->id],['target'=>'_blank']); ?></td>
                 <td><?= h($stockReturnVoucher->created_on_date) ?></td>
				 <td><?= h($stockReturnVoucher->driver->name) ?></td>
                <td align="right"><?= $this->Number->format($stockReturnVoucher->amount_receivable) ?></td>
                <td align="right"><?= $this->Number->format($stockReturnVoucher->amount_received) ?></td>
				
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
<?php echo $this->Html->script('/assets/global/plugins/jquery.min.js'); ?>
<script>

$(document).ready(function() {
	$('.view_order').die().live('click',function() {
		$('#popup').show();
		var voucher_id=$(this).attr('voucher_id');
		$('#popup').find('div.modal-body').html('Loading...');
		var url="<?php echo $this->Url->build(["controller" => "StockReturnVouchers", "action" => "View"]); ?>";
		url=url+'/'+voucher_id;
		

		$.ajax({
			url: url,
			type: 'GET',
			dataType: 'text'
		}).done(function(response) {
			$('#popup').find('div.modal-body').html(response);
		});	
	});
});
</script>
<div  class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel3" aria-hidden="false" style="display: none;border:0px;" id="popup">
<div class="modal-backdrop fade in" ></div>
	<div class="modal-dialog">
		<div class="modal-content" style="border:0px;">
			<div class="modal-body" >
				<p >
					 Body goes here...
				</p>
			</div>
		</div>
	</div>
</div>
