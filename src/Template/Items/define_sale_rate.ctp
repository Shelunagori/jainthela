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
						<i class="fa fa-plus"></i> Sales Rate Module
					</span>
				</div>
				<div class="actions">
					
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
							<td><?= h($item->unit->shortname) ?></td>
							<td><?php echo  $this->Form->text('print_rate',['class'=>'form-control input-sm input-small p_rate','placeholder'=>'Print Rate', 'value'=>$this->Number->format($item->print_rate)]); ?></td>
							<td><?php echo  $this->Form->text('discount_per',['class'=>'form-control input-sm input-small d_per','placeholder'=>'Discount %', 'value'=>$this->Number->format($item->discount_per)]); ?></td>
							<td>
							<?php echo  $this->Form->lable('discount_per',['class'=>'readonly form-control input-sm input-small d_per','placeholder'=>'Sale Rate', 'value'=>$this->Number->format($item->sales_rate)]); ?>
							 <span id="status_id" style="display:none;"><?= $this->Number->format($item->ready_to_sale) ?></span>
							</td>
							<td>
							<?php
                                $status= $this->Number->format($item->ready_to_sale);

							echo $this->Form->select('ready_to_sale', ['empty'=>'--select--',
							'option'=>value="yes" <?php if($status == "Yes")
		     		 	 	 { echo "selected"; }?>Active, 'option'=>value="no" <?php if($status == "No")
		     		 	 	 { echo "selected"; }?>Active,'class'=>'form-control input-sm','required']); ?>
							
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