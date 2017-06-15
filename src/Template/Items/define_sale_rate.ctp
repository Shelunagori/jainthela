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
							<th>Ready to Sale</th>
						</tr>
					</thead>
					<tbody>
						
						<?php
                        $i=0;
                        foreach ($items as $item): 
						$i++;
					?>	
						<tr>
							<td><?= $this->Number->format($i) ?></td>
							<td><?= h($item->item_category->name) ?></td>
                            <td><?= h($item->name) ?></td>
							
							<?php echo  $this->Form->input('item_id[]',['type'=>'hidden','class'=>'form-control input-sm input-small','placeholder'=>'', 'value'=>$this->Number->format($item->id)]); ?>
							
							
							<td><?= h($item->unit->shortname) ?></td>
							<td><?php echo  $this->Form->text('print_rate[]',['class'=>'form-control input-sm input-small p_rate','placeholder'=>'Print Rate', 'value'=>$this->Number->format($item->print_rate)]); ?></td>
							<td><?php echo  $this->Form->text('discount_per[]',['class'=>'form-control input-sm input-small d_per','placeholder'=>'Discount %', 'value'=>$this->Number->format($item->discount_per)]); ?></td>
							<td>
							<?php echo  $this->Form->lable('sales_rate[]',['class'=>'readonly form-control input-sm input-small s_rate','placeholder'=>'Sale Rate', 'value'=>$this->Number->format($item->sales_rate),'readonly']); ?>
							 <span id="status_id" style="display:none;"><?= $this->Number->format($item->id) ?></span>
							</td>
							<td>
							<?php 
							    $readytosale_option_array=['yes'=>'yes', 'no'=>'no'];
                                $readytosale= $item->ready_to_sale;
							echo $this->Form->input('ready_to_sale[]', ['label'=>false,'options'=>$readytosale_option_array,'class'=>'form-control input-sm','required status','value'=>$item->ready_to_sale]); ?>
							</td>
							</tr>
						<?php endforeach; ?>
						
						
						<tr>
						<td colspan="8">
						<div align="center">
							<?= $this->Form->button($this->html->tag('i', '', ['class'=>'fa fa-plus']) . __(' Update Sales Rate'),['class'=>'btn btn-success','id'=>'submitbtn']); ?>
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
	
	$(".p_rate").die().live("keyup",function(){
		 var p_rate=$(this).val();
		 d_per=$(this).closest('tr').find('.d_per').val();
		 t_amount=p_rate*d_per/100;
		 sale_amt=p_rate-t_amount;
		 $(this).closest('tr').find('.s_rate').val((sale_amt).toFixed(2));
	});
});
</script>
<script>
$(document).ready(function(){
	$(".d_per").die().live("keyup",function(){
		 var d_per=$(this).val();
		 p_rate=$(this).closest('tr').find('.p_rate').val();
		 
		  t_amount=p_rate*d_per/100;
		 sale_amt=p_rate-t_amount;
		 $(this).closest('tr').find('.s_rate').val((sale_amt).toFixed(2));
	});
});
</script>