<div class="row">
		<div class="col-md-10">
			<div class="portlet">
		<div class="portlet-body"> 
			<?= $this->Form->create($wallet,['id'=>'form_sample_3']) ?>
				<div class="portlet light bordered">
					<div class="portlet-title">
						<div class="caption">
							<i class="icon-globe font-blue-steel"></i>
				<span class="caption-subject font-blue-steel uppercase">Remove Wallets	</span>
						</div>
					</div>
					<div class="portlet-body form">
					<!-- BEGIN FORM-->
							<div class="row">
							<div class="col-md-2"></div>
								<div class="col-md-10">
									<div class="col-md-4">
										<label class="col-md-6 control-label">Customer <span class="required" 	aria-required="true">*</span></label>
										<?php echo $this->Form->control('customer_id',['empty'=>'--Select Customer--','options' => $customers,'class'=>'form-control input-sm select2me cstmr','id'=>'customer_id','label'=>false]); ?>
									</div>
									<div class="col-md-4">
										<label class="col-md-6 control-label">Amount <span class="required" 	aria-required="true">*</span></label>
										<?= $this->Form->input('consumed',array('class'=>'form-control input-sm consumed','label'=>false)) ?>
									</div>
									
								 </div>
								 <div class="col-md-12"><br/></div>
								 <div class="col-md-12">
								 <div class="col-md-2"></div>
									 <div class="col-md-7">
										<label class="col-md-6 control-label">Narration <span class="required" aria-required="true">*</span></label>
										 <?= $this->Form->input('narration',['class'=>'form-control input-sm','label'=>false,'placeholder'=>'Narration','rows'=>'3','style'=>'resize: none;']) ?>
									 </div>
								 <br></div>
							</div>
						<!-- END FORM-->
					 <br/>
						
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
 
<?php echo $this->Html->script('/assets/global/plugins/jquery.min.js'); ?>
<script>
$(document).ready(function() {
	
	//--------- FORM VALIDATION
	var form3 = $('#form_sample_3');
	var error3 = $('.alert-danger', form3);
	var success3 = $('.alert-success', form3);
	form3.validate({
		errorElement: 'span', //default input error message container
		errorClass: 'help-block help-block-error', // default input error message class
		focusInvalid: true, // do not focus the last invalid input
		rules: {
				consumed:{
					required: true
				},
				customer_id:{
					required: true
				},
				narration:{
					required: true
				},
				
			},

		errorPlacement: function (error, element) { // render error placement for each input type
			if (element.parent(".input-group").size() > 0) {
				error.insertAfter(element.parent(".input-group"));
			} else if (element.attr("data-error-container")) {
				error.appendTo(element.attr("data-error-container"));
			} else if (element.parents('.radio-list').size() > 0) {
				error.appendTo(element.parents('.radio-list').attr("data-error-container"));
			} else if (element.parents('.radio-inline').size() > 0) {
				error.appendTo(element.parents('.radio-inline').attr("data-error-container"));
			} else if (element.parents('.checkbox-list').size() > 0) {
				error.appendTo(element.parents('.checkbox-list').attr("data-error-container"));
			} else if (element.parents('.checkbox-inline').size() > 0) {
				error.appendTo(element.parents('.checkbox-inline').attr("data-error-container"));
			} else {
				error.insertAfter(element); // for other inputs, just perform default behavior
			}
		},

		invalidHandler: function (event, validator) { //display error alert on form submit   
			success3.hide();
			error3.show();
		},

		highlight: function (element) { // hightlight error inputs
		   $(element)
				.closest('.form-group').addClass('has-error'); // set error class to the control group
		},

		unhighlight: function (element) { // revert the change done by hightlight
			$(element)
				.closest('.form-group').removeClass('has-error'); // set error class to the control group
		},

		success: function (label) {
			label
				.closest('.form-group').removeClass('has-error'); // set success class to the control group
		},

		submitHandler: function (form) {
			$('#submitbtn').prop('disabled', true);
			$('#submitbtn').text('Submitting.....');
			success3.show();
			error3.hide();
			form[0].submit(); 
			// submit the form
		}

	});
	//--	 END OF VALIDATION
	
	$('.consumed').on('keyup',function() {
		
	});

	///
	$('.cstmr').on("change",function() {
		var customer_id=$('select[name="customer_id"] option:selected').val();
	 
		var url="<?php echo $this->Url->build(['controller'=>'Wallets','action'=>'checksubtract']); ?>";
		url=url+'/'+customer_id,
			$.ajax({
				url: url,
				type: 'GET',
			}).done(function(response) { 
				$('.consumed').attr('max',response);
			});
	});
});
</script>
