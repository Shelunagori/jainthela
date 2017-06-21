<div class="row">
	<div class="col-md-5 col-sm-5">
		<div class="portlet light bordered">
			<div class="portlet-title">
				<div class="caption">
					<i class="font-purple-intense"></i>
					<span class="caption-subject font-purple-intense ">
							<i class="fa fa-plus"></i> Add Plan
					</span>
				</div>
			</div>
			<div class="portlet-body">
				<?= $this->Form->create($plan,['id'=>'form_sample_3']) ?>
				<div class="row">
					<div class="col-md-8">
						<label class=" control-label">Plan Name <span class="required" aria-required="true">*</span></label>
						<?php echo $this->Form->control('name',['placeholder'=>'Plan Name','class'=>'form-control input-sm','label'=>false]); ?>
					</div>
					</div>
					<div class="row">
					<div class="col-md-8">
						<label class=" control-label">Amount</label>
						<?php echo $this->Form->control('amount',['placeholder'=>'Amount','class'=>'form-control input-sm','label'=>false]); ?>
					</div></div>
					<div class="row">
					<div class="col-md-8">
						<label class=" control-label">Benifit % </label>
						<?php echo $this->Form->control('benifit_per',['placeholder'=>'Benifit %','class'=>'form-control input-sm','label'=>false]); ?>
					</div>
				</div>
				<div class="row">
					<div class="col-md-8">
						<label class=" control-label">Total Amount</label>
						<?php echo $this->Form->control('total_amount',['readonly','placeholder'=>'Total Amount','class'=>'form-control input-sm','label'=>false]); ?>
					</div>
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
					<span class="caption-subject">Plans</span>
				</div>
				<div class="actions">
					<input type="text" class="form-control input-sm pull-right" placeholder="Search..." id="search3"  style="width: 200px;">
				</div>
			</div>
			<div class="portlet-body">
				<div style="overflow-y: scroll;height: 400px;">
					<table class="table table-condensed table-hover table-bordered" id="main_tble">
					<thead>
						<tr>
							<th>Sr</th>
							<th>Plan Name</th>
							<th>Amount</th>
							<th>Benifit %</th>
							<th>Total Amount</th>
							<th>Status</th>
						</tr>
					</thead>
					<tbody>
						<?php
						$i=0;
						foreach ($plans as $plan):
						$i++;

						?>
						<tr>
							<td><?= $i ?></td>
							<td><?= h($plan->name) ?></td>
							<td><?= h($plan->amount) ?></td>
							<td><?= h($plan->benifit_per) ?></td>
							<td><?= h($plan->total_amount) ?>
							<span id="status_id" style="display:none;"><?php echo $plan->id; ?></span>
							</td>
							<td>
							<?php echo  $this->Form->control('status',['class'=>'form-control input-sm input-small status','options'=>['Active'=>'Active','Deactive'=>'Deactive'], 'value'=>$plan->status,'label'=>false]); ?>
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
					required: true,					 
				},
				amount:{
					required: true,
				},
				benifit_per:{
					required: true,
				},
				total_amount:{
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
<script>
$(document).ready(function(){
	$("#amount,#benifit-per").die().live("keyup",function(){
		 update_total_amount()
	});
	function update_total_amount(){
		var amount=parseFloat($('#amount').val());
		var benifit_per=parseFloat($('#benifit-per').val());
		var total_amount=amount+(amount*benifit_per)/100;
		$('#total-amount').val(total_amount.toFixed(2));
	}
	
	$('.status').change(function(){
		var status = $(this).val();
		var status_id = $(this).closest('tr').find('td span#status_id').text();
		var url="<?php echo $this->Url->build(['controller'=>'Plans','action'=>'ajaxStatusPlan']);
		?>";
		url=url+'/'+status+'/'+status_id,
		$.ajax({
			url: url,
		}).done(function(response) {
			alert('Update Successfully');

		});		
    });
	
});
</script>

