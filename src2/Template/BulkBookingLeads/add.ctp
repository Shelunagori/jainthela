<div class="row">
		<div class="col-md-12">
			<div class="portlet">
		<div class="portlet-body"> 
			<?= $this->Form->create($bulkBookingLead,['type'=>'file','id'=>'form_sample_3']) ?>
				<div class="portlet light bordered">
					<div class="portlet-title">
						<div class="caption">
							<i class="font-purple-intense"></i>
							<span class="caption-subject font-purple-intense ">					
								<i class="fa fa-plus"></i>BULK BOOKING LEAD
							</span>
						</div>	
					</div>
					<div class="portlet-body form">
					<!-- BEGIN FORM-->
							<div class="row">
								<div class="col-md-12">
									<div class="col-md-4">
										<label class="col-md-6 control-label">Name <span class="required" 	aria-required="true">*</span></label>
										<?= $this->Form->input('name',array('class'=>'form-control input-sm ','label'=>false)) ?>
									</div>
									<div class="col-md-4">
										<label class="col-md-6 control-label">Mobile No <span class="required" 	aria-required="true">*</span></label>
										<?= $this->Form->input('mobile',array('class'=>'form-control input-sm  number','label'=>false)) ?>
									</div>
									<div class="col-md-4">
										<label class="control-label">Delivery Date <span class="required" aria-require>*</span></label>										
										<?= $this->Form->input('delivery_date', ['type'=>'text','label' =>false,'class'=>'form-control input-sm date-picker','data-date-format'=>'dd-mm-yyyy','value'=>date('d-m-Y')]) ?>
									</div>
								
								 </div>
								 <div class="col-md-12"><br></div>
								 <div class="col-md-12">
									<div class="col-md-4">
										<label class="control-label">Delivery Time <span class="required" aria-require>*</span></label>										
										<?= $this->Form->input('delivery_time', ['type'=>'text','label' =>false,'class'=>'form-control timepicker timepicker-no-seconds']) ?>
										
									</div>
									
									<div class="col-md-4">
										<label class="col-md-6 control-label">Image <span class="required" 	aria-required="true">*</span></label>
										 <?= $this->Form->input('image',['class'=>'form-control','label'=>false,'type'=>'File']) ?>
									 </div>
									 <div class="col-md-4">
										<label class="col-md-6 control-label">Description <span class="required" 	aria-required="true">*</span></label>
										 <?= $this->Form->input('lead_description',['class'=>'form-control input-sm','label'=>false,'placeholder'=>'Lead Description','rows'=>'3','style'=>'resize: none;']) ?>
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
							<?= $this->Form->button($this->Html->tag('i', '', ['class'=>'fa fa-plus']) . __(' Create'),['class'=>'btn btn-success','id'=>'submitbtn']); ?>
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
