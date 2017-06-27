<style>
.table>thead>tr>th{
	font-size:12px !important;
}
</style>
<div class="row">
	<div class="col-md-12">
	<?= $this->Form->create($items,['id'=>'form_sample_3']) ?>
	
		<div class="portlet light bordered">
			<div class="portlet-title">
				<div class="caption">
					<i class="font-purple-intense"></i>
					<span class="caption-subject font-purple-intense ">
						<i class="fa fa-plus"></i> Sales Rate Module
					</span>
				</div>
				
			</div>
			<div class="portlet-body">
				<table class="table table-condensed table-hover table-bordered" id="main_tble">
					<thead>
						<tr>
							<th>Sr</th>
							<th>Category</th>
							<th>Name</th>
							<th>Unit</th>
							<th>Print Rate</th>
							<th>Item Discount %</th>
							<th>Sale Rate</th>
							<th>Offline Sale Rate</th>
							<th>Ready to Sale</th>
						</tr>
					</thead>
					<tbody>
						<?php $i=0; foreach ($items as $item): ?>	
						<tr>
							<td><?php echo ++$i; $i--; ?></td>
							<td><?= h($item->item_category->name) ?></td>
                            <td>
								<?= h($item->name) ?>
								<?php echo  $this->Form->control('items['.$i.'][item_id]',['type'=>'hidden','class'=>'form-control input-sm input-small', 'value'=>$item->id]); ?>
							</td>
							<td>
								<?= h($item->unit->shortname) ?>
							</td>
							<td>
								<?php echo  $this->Form->control('items['.$i.'][print_rate]',['class'=>'form-control input-sm input-small print_rate','placeholder'=>'Print Rate', 'value'=>$item->print_rate,'label'=>false]); ?></td>
							<td>
								<?php echo  $this->Form->control('items['.$i.'][discount_per]',['class'=>'form-control input-sm input-small discount_per','placeholder'=>'Print Rate', 'value'=>$item->discount_per,'label'=>false]); ?></td>
							<td>
								<?php echo  $this->Form->control('items['.$i.'][sales_rate]',['class'=>'form-control input-sm input-small sales_rate','placeholder'=>'Print Rate', 'value'=>$item->sales_rate,'label'=>false, 'readonly']); ?>
							</td>
							<td>
								<?php echo  $this->Form->control('items['.$i.'][offline_sales_rate]',['class'=>'form-control input-sm input-small offline_sales_rate','placeholder'=>'offline Print Rate', 'value'=>$item->offline_sales_rate,'label'=>false]); ?>
							</td>
							<td>
								<?php echo  $this->Form->control('items['.$i.'][ready_to_sale]',['class'=>'form-control input-sm input-small','options'=>['Yes'=>'Yes','No'=>'No'], 'value'=>$item->ready_to_sale,'label'=>false]); ?>
							</td>
						</tr>
						<?php $i++; endforeach; ?>
						
						
						<tr>
						<td colspan="9">
						<div align="center">
							<?= $this->Form->button($this->Html->tag('i', '', ['class'=>'fa fa-plus']) . __(' Update Sales Rate'),['class'=>'btn btn-success','id'=>'submitbtn']); ?>
						</div>
						</td></tr>
						
					</tbody>
				</table>
			</div>
		</div>
		<?= $this->Form->end() ?>
	</div>
</div>
<?php echo $this->Html->script('/assets/global/plugins/jquery.min.js'); ?>
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


<script>
$(document).ready(function(){
	
	$(".print_rate").die().live("keyup",function(){
		 var print_rate=$(this).val();
		 discount_per=$(this).closest('tr').find('.discount_per').val();
		 t_amount=print_rate*discount_per/100;
		 sale_amt=print_rate-t_amount;
		 $(this).closest('tr').find('.sales_rate').val((sale_amt).toFixed(2));
	});

	$(".discount_per").die().live("keyup",function(){
		 var discount_per=$(this).val();
		 print_rate=$(this).closest('tr').find('.print_rate').val();
		 
		  t_amount=print_rate*discount_per/100;
		 sale_amt=print_rate-t_amount;
		 $(this).closest('tr').find('.sales_rate').val((sale_amt).toFixed(2));
		 $(this).closest('tr').find('.offline_sales_rate').val((sale_amt).toFixed(2));
	});
});
</script>