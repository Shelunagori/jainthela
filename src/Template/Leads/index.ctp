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
							<i class="font-purple-intense"></i>
							<span class="caption-subject font-purple-intense ">
							<i class="fa fa-book"></i> Leads</span>
						</div>
				
				<div class="actions">
					<?php echo $this->Html->link('<i class="fa fa-plus"></i> Add New',['controller'=>'Leads','action' => 'add'],['escape'=>false,'class'=>'btn btn-default']); ?>
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
						<th scope="col"><?= ('Name') ?></th>
						<th scope="col"><?= ('Mobile') ?></th>
						<?php if($status=='close'){ ?><th scope="col"><?= ('Reason') ?></th><?php } ?>
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
							<?= h('#'.str_pad($lead->lead_no, 4, '0', STR_PAD_LEFT)) ?>
						</td>
						<td><?= $lead->name ?></td>
						<td><?= $lead->mobile ?></td>
						<?php if($status=='close'){ ?><td><?= $lead->reason ?></td><?php } ?>
						<?php if($status=='open'){ ?>
							<td class="actions">
								<?php echo  $this->Html->link('<i class="fa fa-edit"></i>', ['action' => 'edit', $lead->id],array('escape'=>false,'class'=>'btn btn-xs yellow')); ?>
								
			<a class="btn red btn-xs"  rel="tooltip" title="Delete"  data-toggle="modal" href="#delete<?= $lead->id ?>"><i class="fa fa-trash"></i></a>
			<div class="modal fade" id="delete<?= $lead->id ?>" tabindex="-1" aria-hidden="true" style="padding-top:35px">
				<div class="modal-dialog modal-md">
					<div class="modal-content">
						<div class="modal-header">
							<span class="modal-title" style="font-size:14px; text-align:center">Are you sure, you want to Close this Lead?</span>
						</div>
						<div class="modal-footer">
						<div class="portlet-body">
				<?= $this->Form->create($leads,['id'=>'form_sample_3']) ?>
				<div class="row">
					<div class="col-md-12">
						<label class="control-label col-md-3">Enter Your Reason <span class="required" aria-required="true">*</span></label>
						<?php echo $this->Form->control('reason',['required','rows'=>'1','type'=>'textarea','placeholder'=>'Enter Reason...','class'=>'form-control input-sm','label'=>false]); ?>
		<?php echo $this->Form->control('lead_id',['required','type'=>'hidden','class'=>'form-control input-sm','label'=>false, 'value'=>$lead->id]); ?>
					</div>
				</div>
				<br/>				
				<?= $this->Form->button($this->Html->tag('i', '', ['class'=>'']) . __('Close'),['class'=>'btn btn-danger','data-dismiss'=>'modal']); ?>
				<?= $this->Form->button($this->Html->tag('i', '', ['class'=>'']) . __(' Submit'),['class'=>'btn btn-success']); ?>
				<?= $this->Form->end() ?>
			</div>
						</div>
					</div>
				</div>
			</div>
								<?= $this->Html->link(__('Create Order'), ['action' => 'Orders/add/', $lead->id]) ?>
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