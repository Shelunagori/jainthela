<div class="row">
		<div class="col-md-12">
			<div class="portlet">
		<div class="portlet-body"> 
			<?= $this->Form->create($lead,['id'=>'form_sample_3']) ?>
				<div class="portlet light bordered">
					<div class="portlet-body form">
					<!-- BEGIN FORM-->
							<div class="row">
								<h3 style="text-align:center;">LEAD</h3>
								<div class="col-md-12">
									<div class="col-md-4">
										<label class="col-md-6 control-label">Name <span class="required" 	aria-required="true">*</span></label>
										<?= $this->Form->input('name',array('class'=>'form-control input-sm select2me','label'=>false)) ?>
									</div>
									<div class="col-md-4">
											<label class="col-md-6 control-label">Mobile No <span class="required" 	aria-required="true">*</span></label>
											<?= $this->Form->input('mobile',array('class'=>'form-control input-sm select2me','label'=>false)) ?>
										</div>
										 
									<div class="col-md-2">
										<label class="control-label">Date <span class="required" aria-require>*</span></label>
										
										<?= $this->Form->input('created_on', ['type'=>'text','label' =>false,'class'=>'form-control input-sm','data-date-format'=>'dd-mm-yyyy','data-date-end-date'=>'+0d','value'=>date('d-m-Y')]) ?>
									</div>
								 </div>
								 <div class="col-md-12"><br></div>
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
							<?= $this->Form->button($this->Html->tag('i', '', ['class'=>'fa fa-plus']) . __(' Edit'),['class'=>'btn btn-success','id'=>'submitbtn']); ?>
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