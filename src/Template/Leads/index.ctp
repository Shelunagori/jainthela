<style>	
.table > thead > tr > th, .table > tbody > tr > th, .table > tfoot > tr > th, .table > thead > tr > td, .table > tbody > tr > td, .table > tfoot > tr > td{
	vertical-align: top !important;
}
</style>
<div class="row">
	<div class="col-md-1"></div>
	<div class="col-md-12">
		<div class="portlet light bordered">
			<div class="portlet-title">
				<div class="caption">
					<span>
					<B>Leads</B>
					</span>
				</div>
				<div class="actions">
					<?php echo $this->Html->link('Add',['controller'=>'Leads','action' => 'add'],['escape'=>false,'class'=>'btn btn-default']); ?>
					<input type="text" class="form-control input-sm pull-right" placeholder="Search..." id="search3"  style="width: 200px;">
					<?php if($status=='open' or $status==''){
						$class1="btn btn-xs blue";
						$class2="btn btn-default";
					}elseif($status=='close'){
						$class1="btn btn-default";
						$class2="btn btn-xs blue";
					}
					 ?>
						<?php echo $this->Html->link('Open',['controller'=>'Leads','action' => 'index/open'],['escape'=>false,'class'=>$class1]); ?>
						<?php echo $this->Html->link('Close',['controller'=>'Leads','action' => 'index/close'],['escape'=>false,'class'=>$class2]); ?>&nbsp;
				</div>
			</div>
			<div class="portlet-body">
			<table class="table table-bordered table-condensed" id="main_tble">
				<thead>
					<tr>
						<th scope="col"><?= ('Sr.no') ?></th>
						<th scope="col"><?= ('Lead No') ?></th>
						<th scope="col"><?= ('name') ?></th>
						<th scope="col"><?= ('Mobile') ?></th>
						<?php if($status=='open'){ ?>
						<th scope="col" class="actions"><?= __('Actions') ?></th>
						<?php } ?>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($leads as $lead): 
						@$k++;
					?>
					<tr>
						<td><?= $k ?></td>
						<td>
							<?= $lead->lead_no ?>
						</td>
						<td><?= $lead->name ?></td>
						<td><?= $lead->mobile ?></td>
						<?php if($status=='open'){ ?>
							<td class="actions">
								<?php echo  $this->Html->link('<i class="fa fa-edit"></i>', ['action' => 'edit', $lead->id],array('escape'=>false,'class'=>'btn btn-xs yellow')); ?>
											
								<?php echo  $this->Form->postLink('<i class="fa fa-trash"></i>', ['action' => 'delete', $lead->id], ['escape'=>false,'class'=>'btn btn-xs btn-danger','confirm' => __('Are you sure you want to delete # {0}?', $lead->id)]); ?>
							</td>
						<?php } ?>
					</tr>
					<?php endforeach; ?>
				</tbody>
			</table>
		   </div>
		</div>
	</div>
    <div class="col-md-1"></div>
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

