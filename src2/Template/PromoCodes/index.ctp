<div class="row">
	<div class="col-md-5 col-sm-5">
		<div class="portlet light bordered">
			<div class="portlet-title">
				<div class="caption">
					<i class="font-purple-intense"></i>
					<span class="caption-subject font-purple-intense ">
							<i class="fa fa-plus"></i> Add Promo Code
					</span>
				</div>
			</div>
			<div class="portlet-body">
				<?= $this->Form->create($promoCode,['id'=>'form_sample_3']) ?>
				<div class="row">
					<div class="col-md-8">
						<label class=" control-label">Promo Code Name <span class="required" aria-required="true">*</span></label>
						<?php echo $this->Form->control('code',['placeholder'=>'Promo Code Name','class'=>'form-control input-sm','label'=>false]); ?>
					</div>
					</div>
					<div class="row">
					<div class="col-md-8">
						<label class=" control-label">Discount</label>
						<?php echo $this->Form->control('discount_per',['placeholder'=>'Discount','class'=>'form-control input-sm','label'=>false]); ?>
					</div></div>
					<div class="row">
					<div class="col-md-8">
						<?php echo $this->Form->control('item_category_id', ['empty'=>'-- select --','options' => $itemCategories,'class'=>'form-control input-sm select select2me select2','required']); ?>
					</div>
				</div>
				<div class="row">
					<div class="col-md-8">
						<label class=" control-label">Valid From</label>
						<?php echo $this->Form->control('valid_from',['readonly','placeholder'=>'Valid From','class'=>'form-control input-sm date-time-range-picker','label'=>false]); ?>
					</div>
				</div>
				<div class="row">
					<div class="col-md-8">
						<label class=" control-label">Valid To</label>
						<?php echo $this->Form->control('valid_to',['readonly','placeholder'=>'Valid To','class'=>'form-control input-sm','label'=>false]); ?>
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
					<span class="caption-subject">Codes</span>
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
							<th>Code Name</th>
							<th>Discount</th>
							<th>Item Category</th>
							<th>Valid From</th>
							<th>Valid To</th>
							<th>Status</th>
						</tr>
					</thead>
					<tbody>
						<?php
						$i=0;
						foreach ($promoCodes as $promoCode):
						$i++;

						?>
						<tr>
							<td><?= $i ?></td>
							<td><?= h(@$promoCode->code) ?></td>
							<td><?= h(@$promoCode->discount_per) ?></td>
							<td><?= h(@$promoCode->ItemCategories->item_category_id) ?></td>
							<td><?= h(@$promoCode->valid_from) ?>
							<td><?= h(@$promoCode->valid_to) ?>
							<span id="status_id" style="display:none;"><?php echo $promoCode->id; ?></span>
							</td>
							<td>
							<?php echo  $this->Form->control('status',['class'=>'form-control input-sm input-small status','options'=>['Active'=>'Active','Deactive'=>'Deactive'], 'value'=>$promoCode->status,'label'=>false]); ?>
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
				code:{
					required: true,					 
				},
				discount_per:{
					required: true,
				},
				valid_from:{
					required: true,
				},
				valid_to:{
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
	$('.status').change(function(){
		var status = $(this).val();
		var status_id = $(this).closest('tr').find('td span#status_id').text();
		var url="<?php echo $this->Url->build(['controller'=>'PromoCodes','action'=>'ajaxStatusPromoCode']);
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

