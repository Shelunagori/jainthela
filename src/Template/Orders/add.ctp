<style>
.table > thead > tr > th, .table > tbody > tr > th, .table > tfoot > tr > th, .table > thead > tr > td, .table > tbody > tr > td, .table > tfoot > tr > td{
	vertical-align: top !important;
}
</style>
<div class="row">
	<div class="col-md-12">
		<div class="portlet light bordered">
			<div class="portlet-title">
				<div class="caption">
					<i class="font-purple-intense"></i>
					<span class="caption-subject font-purple-intense "><i class="fa fa-plus"></i> Create Order </span>
				</div>
				
			</div>
			<div class="portlet-body">
				<?= $this->Form->create($order,['id'=>'form_sample_3']) ?>
				<div class="row">
					<div class="col-md-4">
						<label class=" control-label">Customer <span class="required" aria-required="true">*</span></label>
						<?php echo $this->Form->control('customer_id',['options' => $customers,'class'=>'form-control input-sm','label'=>false]); ?>
					</div>
					<div class="col-md-4">
						<label class=" control-label">Amount From Wallet</label>
						<?php echo $this->Form->control('amount_from_wallet',['placeholder'=>'Amount From Wallet','class'=>'form-control input-sm','label'=>false,'type'=>'text']); ?>
					</div>
					<div class="col-md-4">
						<label class=" control-label">Amount From jain Cash</label>
						<?php echo $this->Form->control('amount_from_jain_cash',['placeholder'=>'Amount From Jain Cash','class'=>'form-control input-sm','label'=>false,'type'=>'text']); ?>
					</div>
				</div><br/>
				<div class="row">
					<div class="col-md-4">
						<label class=" control-label">Amount From Promo Code</label>
						<?php echo $this->Form->control('amount_from_promo_code',['placeholder'=>'Amount From Promo Code','class'=>'form-control input-sm','label'=>false,'type'=>'text']); ?>
					</div>
					<div class="col-md-4">
						<label class=" control-label">Promo Code</label>
						<?php echo $this->Form->control('promo_code_id',['options' => $promoCodes,'class'=>'form-control input-sm','label'=>false]); ?>
					</div>
				</div><br/>
				<div class="row">
					<div class="col-md-1"></div>
					<div class="col-md-8">
						<table id="main_table" class="table table-condensed table-bordered">
							<thead>
								<tr align="center">
									<td>
										<label>Sr<label>
									</td>
									<td>
										<label>item<label>
									</td>
									<td>
										<label>Quantity<label>
									</td>
									<td>
										<label>Rate<label>
									</td>
									<td>
										<label>Amount<label>
									</td>
									<td><a class="btn btn-default input-sm add_row" href="#" role="button" ><i class="fa fa-plus"></i> Add Row</a></td>
								</tr>
							</thead>
							<tbody id='main_tbody' class="tab">
								
							</tbody>
							<tfoot>
								<tr>
								<td colspan="4">
								Total Amount
								</td>
								<td>
								<?php echo $this->Form->input('total_amount', ['label' => false,'class' => 'form-control input-sm number cal_amount','placeholder'=>'Total Amount','type'=>'text','readonly']); ?>
								</td>
								</tr>
							</tfoot>
						</table>
					</div>
					<div class="col-md-1"></div>
				</div>
				 
				<br/>
				<?= $this->Form->button($this->Html->tag('i', '', ['class'=>'fa fa-plus']) . __(' Submit'),['class'=>'btn btn-success']); ?>
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
	$('.delete-tr').live('click',function() 
	{
		var rowCount = $('#main_table tbody#main_tbody tr').length; 
		if(rowCount>1)
		{
			 $(this).closest('tr').remove();
			 $("#main_table tbody#main_tbody tr.main_tr").each(function(){ 
			total_amount+=parseFloat($(this).find("td:nth-child(5) input").val());
		});
			 
		}
		
    });

	$('.add_row').click(function(){
		add_row();
	});
		
	add_row();
	function add_row(){
		var tr=$("#sample_table tbody tr.main_tr").clone();
		$("#main_table tbody#main_tbody").append(tr);
		
		rename_rows();
	}

	function rename_rows(){
		var i=0; 
		$("#main_table tbody#main_tbody tr.main_tr").each(function(){ 
			$(this).find('td:nth-child(1)').html(i+1);
			$(this).find("td:nth-child(2) select").select2().attr({name:"order_details["+i+"][item_id]", id:"order_details-"+i+"-item_id"}).rules('add', {
						required: true
					});
			$(this).find("td:nth-child(3) input").attr({name:"order_details["+i+"][quantity]", id:"order_details-"+i+"-quantity"}).rules('add', {
						required: true
					});
			$(this).find("td:nth-child(4) input").attr({name:"order_details["+i+"][rate]", id:"order_details-"+i+"-rate"}).rules('add', {
				required: true
			});
			$(this).find("td:nth-child(5) input").attr({name:"order_details["+i+"][amount]", id:"order_details-"+i+"-amount"}).rules('add', {
				required: true
			});
			i++;
		});
	}
	$(document).on('keyup','.cal_amount',function(){ 
		var obj=$(this).closest('tr');
		var qty=obj.find('td:nth-child(3) input').val();
		var rate=obj.find('td:nth-child(4) input').val();
		var amount=qty*rate;
		var rate=obj.find('td:nth-child(5) input').val(amount);
		var total_amount=0;
		$("#main_table tbody#main_tbody tr.main_tr").each(function(){ 
			total_amount+=parseFloat($(this).find("td:nth-child(5) input").val());
		});
		$('input[name=total_amount]').val(total_amount);
	});
	
});
</script>
<table id="sample_table" style="display:none;" >
			<tbody>
				<tr class="main_tr" class="tab">
					<td align="center" width="1px"></td>
				    <td>
						<?php echo $this->Form->input('item_id', ['empty'=>'--Select-','options'=>$items,'label' => false,'class' => 'form-control input-sm attribute']); ?>
					</td>
					<td>
						<?php echo $this->Form->input('quantity', ['label' => false,'class' => 'form-control input-sm number cal_amount','placeholder'=>'Quantity']); ?>	
					</td>
					<td>
						<?php echo $this->Form->input('rate', ['label' => false,'class' => 'form-control input-sm number cal_amount','placeholder'=>'Rate']); ?>	
					</td>
					<td>
						<?php echo $this->Form->input('amount', ['label' => false,'class' => 'form-control input-sm number cal_amount','placeholder'=>'Amount','readonly']); ?>	
					</td>
                    <td>
						<a class="btn btn-default delete-tr input-sm" href="#" role="button" ><i class="fa fa-times"></i></a>
					</td>
				</tr>
			</tbody>
		</table>

