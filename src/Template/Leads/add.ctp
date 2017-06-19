<div class="row">
		<div class="col-md-12">
			<div class="portlet">
		<div class="portlet-body"> 
			<?= $this->Form->create($lead,['id'=>'form_sample_3']) ?>
				<div class="portlet light bordered">
					<div class="portlet-title">
						<div class="caption">
							<span>
							<B>Lead</B>
							</span>
						</div>
					</div>
					<div class="portlet-body form">
					<!-- BEGIN FORM-->
							<div class="row">
								 <div class="col-md-12">
									 <div class="col-md-4">
										<label class="col-md-6 control-label">Description <span class="required" 	aria-required="true">*</span></label>
										 <?= $this->Form->input('order_description',['class'=>'form-control input-sm','label'=>false,'placeholder'=>'Order Description','rows'=>'3','style'=>'resize: none;']) ?>
										 
									 </div>
								 <br></div>
							</div>
						<!-- END FORM-->
					 
						<div class="row" style="padding-top:5px;">
							<div class="col-md-4"></div>
							<div class="col-md-4"></div>
							<div class="col-md-4"> </div>
						</div>
						<div align="center">
							<?= $this->Form->button($this->html->tag('i', '', ['class'=>'fa fa-plus']) . __(' Create'),['class'=>'btn btn-success','id'=>'submitbtn']); ?>
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
