<div class="row">
	<div class="col-md-5 col-sm-5">
		<div class="portlet light bordered">
			<div class="portlet-title">
				<div class="caption">
					<i class="font-purple-intense"></i>
					<span class="caption-subject font-purple-intense ">
						<?php if(!empty($id)){ ?>
							<i class="fa fa-pencil-square-o"></i> Edit Driver
						<?php }else{ ?>
							<i class="fa fa-plus"></i> Add Driver
						<?php } ?>
					</span>
				</div>
			</div>
			<div class="portlet-body">
				<?= $this->Form->create($driver,['id'=>'form_sample_3']) ?>
				<div class="row">
					<div class="col-md-12">
						<div class="col-md-6">
							<label class=" control-label">Driver Name <span class="required" aria-required="true">*</span></label>
							<?php echo $this->Form->control('name',['placeholder'=>'Driver Name','class'=>'form-control input-sm','label'=>false]); ?>
						</div>
					</div><br><br><br>
					<div class="col-md-12">
						<div class="col-md-6">
							<label class=" control-label">Mobile <span class="required" aria-required="true">*</span></label>
							<?php echo $this->Form->control('mobile',['placeholder'=>'Mobile no.','class'=>'form-control input-sm','label'=>false]); ?>
						</div>
					</div><br><br><br>
					<div class="col-md-12">
						<div class="col-md-6">
							<label class=" control-label">User Name <span class="required" aria-required="true">*</span></label>
							<?php echo $this->Form->control('user_name',['placeholder'=>'User Name','class'=>'form-control input-sm','label'=>false]); ?>
						</div>
					</div><br><br><br>
					<div class="col-md-12">
						<div class="col-md-6">
							<label class=" control-label">Password <span class="required" aria-required="true">*</span></label>
							<?php echo $this->Form->control('password',['placeholder'=>'*****','class'=>'form-control input-sm','label'=>false, 'value'=>'']); ?>
						</div>
					</div><br><br><br>
				</div>
				<br/>
				<?= $this->Form->button($this->Html->tag('i', '', ['class'=>'fa fa-plus']) . __(' Submit'),['class'=>'btn btn-success']); ?>
				<?= $this->Form->end() ?>
			</div>
		</div>
	</div>
	<div class="col-md-7 col-sm-7">
		<div class="portlet light bordered">
			<div class="portlet-title">
				<div class="caption">
					<i class=" fa fa-gift"></i>
					<span class="caption-subject">Drivers</span>
				</div>
				<div class="actions">
					<?php echo $this->Html->link('<i class="fa fa-plus"></i> Driver Location','/Drivers/driver_location',['escape'=>false,'class'=>'btn btn-default']) ?>
					&nbsp;
					<input type="text" class="form-control input-sm pull-right" placeholder="Search..." id="search3"  style="width: 200px;">
				</div>
			</div>
			<div class="portlet-body">
				<div style="overflow-y: scroll;height: 400px;">
					<table class="table table-bordered table-condensed pagin-table" id="main_tble">
						<thead>
							<tr>
								<th><?=  h('Sr.no') ?></th>
								<th><?=  h('Name') ?></th>
								<th><?=  h('Mobile') ?></th>
								<th><?=  h('User Name') ?></th>
								<th class="actions"><?= __('Actions') ?></th>
							</tr>
						</thead>
						<tbody>
							<?php
							$k=0;
							foreach ($driver_details as $driver_detail):
							@$k++; ?>
							<tr>
								<td><?= h($k) ?></td>
								<td><?= h($driver_detail->name) ?></td>
								<td><?= h($driver_detail->mobile) ?></td>
								<td><?= h($driver_detail->user_name) ?></td>
								<td class="actions">
									<?php echo $this->Html->link('<i class="fa fa-pencil-square-o"></i>',['action' => 'add', $driver_detail->id],['escape'=>false,'class'=>'btn btn-xs blue']); ?>
									
									<?php echo $this->Form->PostLink('<i class="fa fa-trash"></i>',['action' => 'delete', $driver_detail->id],[
									'escape'=>false,
									'class'=>'btn btn-xs red',
									'confirm'=> __ ('Are yousue youwant to delete this unit?',$driver_detail->id)]
									)
									?>
								</td>
							</tr>
							<?php endforeach; ?>
						</tbody>
					</table>
				</div>
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
					required: false,					 
				},
				mobile:{
					required: true,					 
				},
				user_name:{
					required: true,					 
				},
				password:{
					required: true,					 
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