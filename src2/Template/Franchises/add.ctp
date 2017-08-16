<div class="row">
	<div class="col-md-12">
		<div class="portlet light bordered">
			<div class="portlet-title">
				<div class="caption">
					<i class="font-purple-intense"></i>
					<span class="caption-subject font-purple-intense ">
						<i class="fa fa-plus"></i> Add Franchise
					</span>
				</div>
				<div class="actions"></div>
			</div>
			<div class="portlet-body">
			<?= $this->Form->create($franchise,['id'=>'form_sample_3']) ?>
				<div class="row">
					<div class="col-md-3">
						<?php echo $this->Form->control('name',['class'=>'form-control input-sm','placeholder'=>'Franchise Name']); ?>
					</div>
					<div class="col-md-3">
						<?php echo $this->Form->control('city_id', ['empty'=>'--select--','options' => $cities,'class'=>'form-control input-sm']); ?>
					</div>
					<div class="col-md-3">
						<label class="control-label">User Name</label>
						<?php echo $this->Form->control('users[0][username]',['class'=>'form-control input-sm','placeholder'=>'User Name','label'=>false]); ?>
					</div>
					<div class="col-md-3">
						<label class="control-label">Password</label>
						<?php echo $this->Form->control('users[0][password]',['class'=>'form-control input-sm','placeholder'=>'Password','label'=>false]); 
						echo $this->Form->control('users[0][role]',['type'=>'hidden','value'=>'franchise']);
						?>
					</div>
				</div>
				<div class="row">
					<div class="col-md-3">
						<div class="checkbox-list" data-error-container="#form_2_services_error">
						<?php echo $this->Form->input('item_categories._ids', ['options' => $ItemCategories,'multiple' => 'checkbox','class'=>'form-control input-sm']); ?>
						</div>
						<div id="form_2_services_error"></div>
					</div>
					
				</div>
			<?= $this->Form->button(__('Create new franchise'),['class'=>'btn btn-success']) ?>
			<?= $this->Form->end() ?>
			</div>
		</div>
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
				name:{
					required: true,					 
				},
				city_id:{
					required: true,
				},
				'users[0][username]':{
					required: true,
				},
				'users[0][password]':{
					required: true,
				},
				'item_categories[_ids][]':{
					required: true,
				},
				
			},
			messages: {
			 'users[0][username]': {
              remote: "This User Name is already exist."
            }
			
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
			event.preventDefault();
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
			success3.show();
			error3.hide();
			form[0].submit(); // submit the form
		}

	});
	//--	 END OF VALIDATION
});
</script>

