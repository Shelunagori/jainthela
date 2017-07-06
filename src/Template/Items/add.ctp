<div class="row">
	<div class="col-md-12">
		<div class="portlet light bordered">
			<div class="portlet-title">
				<div class="caption">
					<i class="font-purple-intense"></i>
					<span class="caption-subject font-purple-intense ">
						<i class="fa fa-plus"></i> Add Item
					</span>
				</div>
				<div class="actions">
				</div>
			</div>
			<div class="portlet-body">
			<?= $this->Form->create($item,['type'=>'file','id'=>'form_sample_3']) ?>
				<div class="row">
					<div class="col-md-3">
						<?php echo $this->Form->control('name',['class'=>'form-control input-sm','placeholder'=>'Item Name']); ?>
					</div>
					<div class="col-md-3">
						<?php echo $this->Form->control('alias_name',['class'=>'form-control input-sm','placeholder'=>'Alias Name']); ?>
					</div>
					<div class="col-md-3">
						<?php echo $this->Form->control('unit_id', ['empty'=>'--select--','options' => $unit_option,'class'=>'form-control input-sm attribute']); ?>
					</div>
					<div class="col-md-3">
						<?php echo $this->Form->control('item_category_id', ['empty'=>'--select--','options' => $itemCategories,'class'=>'form-control input-sm','required']); ?>
					</div>
				</div><br/>
				<div class="row">
					<div class="col-md-3">
						<?php echo $this->Form->control('minimum_stock',['class'=>'form-control input-sm','placeholder'=>'Minimum Stock']); ?>
						<span id="msg"></span>
					</div>
					<div class="col-md-3 set">
						
					</div>
					<div class="col-md-3">
						<label class="control-label">Maximum Order Limit<span class="required" aria-required="true"></span></label>
						<?php echo $this->Form->control('minimum_quantity_purchase',['class'=>'form-control input-sm order_limit','placeholder'=>'Maximum Order Limit', 'label'=>false]); ?>
						<span id="msg2"></span>
					</div>
					<div class="col-md-3">
						<?php echo $this->Form->control('description', ['class'=>'form-control input-sm','placeholder'=>'Description']); ?>
					</div>
				</div>
				<div class="row"><br>
					<div class="col-md-3">
						 <?= $this->Form->input('image',['class'=>'form-control','type'=>'File']) ?>
					</div>
					<div class="col-md-3">
								<div class="form-group">
									<label class="control-label">Type<span class="required" aria-required="true">*</span></label>
									<div class="radio-list">
										<div class="radio-inline" style="padding-left: 0px;">
											<?php echo $this->Form->radio(
											'is_virtual',
											[
												['value' => 'no', 'text' => 'Real','class' => 'radio-task virt','checked' => 'checked'],
												['value' => 'yes', 'text' => 'Virtual','class' => 'radio-task virt']
											]
											); ?>
										</div>
                                    </div>
								</div>
							</div>
							<div class="col-md-3 set2">
							</div>	
				</div>
			<?= $this->Form->button(__('Create new item'),['class'=>'btn btn-success']) ?>
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
				unit_id:{
					required: true,
				},
				image:{
					required: false,
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
	
	$(".attribute").die().live('change',function(){
		var unt_attr_name = $('option:selected', this).attr('unit_name');	
			$("#msg").html('Minimum Stock in '+ unt_attr_name);
			if(unt_attr_name=='kg'){
				var data=$("#data_fetch").html();
				$(".set").html(data);
			}else{
				$(".set").html('');
			}
 	});
	$(".order_limit").die().live('keyup',function(){
	var unt_attr_name = $('.attribute option:selected').attr('unit_name');
	var limit = $(".order_limit").val();
		if(unt_attr_name=='kg'){
				var quantity_factor = $(".qunt_factor option:selected").val();
				var total = quantity_factor*limit;
				$("#msg2").html(total +' '+ unt_attr_name);
			}else{
				$("#msg2").html(limit +' '+ unt_attr_name);
			}
	});

	$(".virt").die().live('click',function(){
		var virtual = $(this).val();
			if(virtual=='yes'){
				var data=$("#fetch").html();
				$(".set2").html(data);
			}else{
				$(".set2").html('');
			}
 	});
});
</script>
<?php 
	$factor_select[]= ['value'=>0.25,'text'=>'250 gm'];
	$factor_select[]= ['value'=>0.50,'text'=>'500 gm'];
	$factor_select[]= ['value'=>1,'text'=>'1 kg'];
?>
<div id="data_fetch" style="display:none;">
	<?php echo $this->Form->control('minimum_quantity_factor', ['options' => $factor_select,'class'=>'form-control input-sm qunt_factor']); ?>
</div>

<div id="fetch" style="display:none;">
	<?php echo $this->Form->control('parent_item_id', ['options' => $item_fetchs,'class'=>'form-control input-sm']); ?>
</div>