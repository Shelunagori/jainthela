<div class="row">
		<div class="col-md-12">
			<div class="portlet">
		<div class="portlet-body"> 
			<?= $this->Form->create($appNotification,['type' => 'file','id'=>'form_sample_3']) ?>
				<div class="portlet light bordered">
					<div class="portlet-title">
						<div class="caption">
							<span>
								<h3><B>Product Descriptions </B></h3>
							</span>
						</div>
					</div>
					<div class="portlet-body form">
					<!-- BEGIN FORM-->
							<div class="row">
								 <div class="col-md-6">
									<div class="form-group">
										<label class="col-md-6 control-label">Item <span class="required" 	aria-required="true">*</span></label>
										 <?= $this->Form->input('item_id', ['empty'=>'---select item---','options'=>$Items,'class'=>'form-control input-sm attribute','label'=>false]) ?>
									</div>
								</div>
							<br>
								 
								 <div class="col-md-12">
									<div class="form-group">
										<label class="col-md-6 control-label">Message <span class="required" 	aria-required="true">*</span></label>
										 <?= $this->Form->input('message',['class'=>'form-control input-sm','label'=>false,'placeholder'=>'','rows'=>'3','style'=>'resize: none;']) ?>
									</div>	 
									 </div>
										<?= $this->Form->input('image',['type'=>'hidden','class'=>'form-control input-sm img','label'=>false]) ?>
								 <br></div><br><br>

						<!-- END FORM-->

						<div align="center">
							<?= $this->Form->button($this->Html->tag('i', '', ['class'=>'fa fa-plus']) . __(' Submit'),['class'=>'btn btn-success','id'=>'submitbtn']); ?>
						</div>
					</div>
				</div>
			<?= $this->Form->end() ?>
		</div>
	</div>
</div>
    <div class="col-md-1">
	</div>
</div>
<?php echo $this->Html->script('/assets/global/plugins/jquery.min.js'); ?>
<script>
$(document).ready(function() {
	$(".attribute").die().live('change',function(){
		var image_name = $('option:selected', this).attr('image');
		$('.img').val(image_name);
	});
});
</script>