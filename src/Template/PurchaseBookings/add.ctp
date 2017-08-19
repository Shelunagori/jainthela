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
					<span class="caption-subject font-purple-intense "><i class="fa fa-plus"></i> Create Purchase Booking </span>
				</div>
				
			</div>
			<div class="portlet-body">
				<?= $this->Form->create($purchaseBooking,['id'=>'form_sample_3']) ?>
				<div class="row">
					<div class="col-md-4">
						<label class=" control-label">Transaction Date <span class="required" aria-required="true">*</span></label>
						<?php echo $this->Form->control('transaction_date',['placeholder'=>'dd-mm-yyyy','class'=>'form-control input-sm date-picker','data-date-format'=>'dd-mm-yyyy','label'=>false,'type'=>'text','value'=>date('d-m-Y')]); ?>
					</div>
					<div class="col-md-4">
						<label class=" control-label">vendor Name</label><br/>
						<?= $grn->vendor->name ?>
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
									<td><label>Invoice Quantity<label></td>
									<td><label>Rate<label></td>
									<td><label>Amount<label></td>
								</tr>
							</thead>
							<tbody id="main_tbody">
							<?php
							$sr_no=1;
							$grn_rows=0;
							foreach($grn->grn_details as $grn_detail)
							{
							?>
								<tr class="main_tr">
									<td align="center" width="1px"><?= $sr_no++ ?></td>
									<td>
									<?php echo $this->Form->control('purchase_booking_details['.$grn_rows.'][item_id]',['value' => $grn_detail->item_id,'class'=>'form-control input-sm','label'=>false,'type'=>'hidden']); ?>
									<?= $grn_detail->item->name ?>
										
									</td>
									<td>
									<?= $grn_detail->quantity ?>
										<?php echo $this->Form->input('purchase_booking_details['.$grn_rows.'][quantity]', ['label' => false,'class' => 'form-control input-sm number','placeholder'=>'Quantity','value'=>$grn_detail->quantity,'type'=>'hidden']); ?>	
									</td>
									<td>
										<?php echo $this->Form->input('purchase_booking_details['.$grn_rows.'][invoice_quantity]', ['label' => false,'class' => 'form-control input-sm number calculation_amount','placeholder'=>'Invoice Quantity','value'=>$grn_detail->quantity]); ?>	
									</td>
									<td>
										<?php echo $this->Form->input('purchase_booking_details['.$grn_rows.'][rate]', ['label' => false,'class' => 'form-control input-sm number cal_amount calculation_amount','placeholder'=>'Rate']); ?>	
									</td>
									<td>
										<?php echo $this->Form->input('purchase_booking_details['.$grn_rows.'][amount]', ['label' => false,'class' => 'form-control input-sm number','placeholder'=>'Amount','readonly']); ?>	
									</td>
								</tr>
							<?php
							$grn_rows++;
							}
							?>
							</tbody>
							<tfoot>
								<tr>
									<th colspan="5" style="text-align:right;">Total Amount
									<?php echo $this->Form->input('total_amount', ['label' => false,'class' => 'form-control input-sm number','placeholder'=>'Amount','type'=>'hidden']); ?></th>
									<th id="total_amount">
									</th>
								</tr>
								<tr>
									<th colspan="5" style="text-align:right;">Frieght Amount
									</th>
									<th id="frieght_amount">
									<?php echo $this->Form->input('frieght_amount', ['label' => false,'class' => 'calculation_amount form-control input-sm number frieght_amount','placeholder'=>'Amount','type'=>'text', 'value' => 0]); ?>
									</th>
								</tr>
								<tr>
									<th colspan="5" style="text-align:right;">GST Percentage(%)
									</th>
									<th id="gst_percentage">
									<?php echo $this->Form->input('gst_percentage', ['label' => false,'class' => 'form-control input-sm number gst_per calculation_amount','placeholder'=>'Amount','type'=>'text']); ?>
									<?php echo $this->Form->input('gst_amount', ['label' => false,'class' => 'form-control input-sm','type'=>'hidden']); ?>
									</th>
								</tr>
								<tr>
									<th colspan="5" style="text-align:right;">Grand Total
									<?php echo $this->Form->input('grand_total', ['label' => false,'class' => 'form-control input-sm number grnd_ttl','placeholder'=>'Amount','type'=>'hidden']); ?></th>
									<th id="grand_total">
									</th>
								</tr>
							</tfoot>
						</table>
					</div>
					
				</div>
				 
				<br/>
				<center>
				<?= $this->Form->button($this->Html->tag('i', '', ['class'=>'fa fa-plus']) . __(' Submit'),['class'=>'btn btn-success']); ?>
				<?= $this->Form->end() ?>
				</center>
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
	
	$("[name^=purchase_booking_details]").each(function () {
		$(this).rules("add", {
			required: true
		});
	});
	/* $(document).on('keyup','.cal_amount',function(){ 
		var obj=$(this).closest('tr');
		var invoice_qty=obj.find('td:nth-child(4) input').val();
		var rate=obj.find('td:nth-child(5) input').val();
		var amount=invoice_qty*rate;
		var rate=obj.find('td:nth-child(6) input').val(amount);
		var total_amount=0;
		$("#main_table tbody tr").each(function(){ 
			total_amount+=parseFloat($(this).find("td:nth-child(6) input").val());
		});
		$('input[name=total_amount]').val(total_amount);
		$('#total_amount').text(total_amount);
	});
	 */
	$(document).on('keyup', '.number', function(e)
    { 
		var mdl=$(this).val();
		var numbers =  /^[0-9]*\.?[0-9]*$/;
		if(mdl.match(numbers))
		{
		}
		else
		{
			$(this).val('');
			return false;
		}
    });

	$(".calculation_amount").die().live('keyup',function(){
		calculation();
	});	
	$(".del_click").die().live('click',function(){
		calculation();				
	});	
	function calculation(){
		var amount_total = 0;		
		$("#main_table tbody#main_tbody tr.main_tr").each(function(){
			var amount =0;
			var quantity = parseFloat($(this).find("td:nth-child(4) input").val());
			if(!quantity){ quantity=0; }
			var price = parseFloat($(this).find("td:nth-child(5) input").val());
			if(!price){ price=0; }
			amount = quantity*price;
			amount_total=amount_total+amount;
			$(this).find("td:nth-child(6) input").val(amount.toFixed(2));
			var total_amount = parseFloat($(this).find("td:nth-child(6) input").val());
		}); 
			var frght_amnt = parseFloat($(".frieght_amount").val());
			if(!frght_amnt){ frght_amnt=0; }
			var all_amount=amount_total+frght_amnt;
			var gst_per = parseFloat($(".gst_per").val());
			if(!gst_per){ gst_per=0; }
			var gst_amount=((all_amount*gst_per)/100);
			var grand_total = (all_amount+gst_amount);
			$('input[name=total_amount]').val(amount_total.toFixed(2));
			$('#total_amount').text(amount_total.toFixed(2));
			$('input[name=gst_amount]').val(gst_amount.toFixed(2));
			$('input[name=grand_total]').val(grand_total.toFixed(2));
			$('#grand_total').text(grand_total.toFixed(2));
	}
});
</script>


