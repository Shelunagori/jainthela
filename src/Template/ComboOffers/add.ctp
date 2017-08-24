<div class="row">
<div class="col-md-12">
	<div class="portlet">
		<div class="portlet-body"> 
			<?= $this->Form->create($comboOffer,['type'=>'file','id'=>'form_sample_3']) ?>
				<div class="portlet light bordered">
					<div class="portlet-title">
						<div class="caption">
							<span>
							<B>Combo Offer</B>
							</span>
						</div>
						<div class="actions">
							<?php echo $this->Html->link('<i class="fa fa-plus"></i> View All','/ComboOffers/index',['escape'=>false,'class'=>'btn btn-default']) ?>
						</div>
					</div>
					<div class="portlet-body form">
					<!-- BEGIN FORM-->
							<div class="row">
								<div class="col-md-12">
									<div class="col-md-3">
										<label class="col-md-6 control-label">Offer Name <span class="required" aria-required="true">*</span></label>
										<?= $this->Form->input('name',array('class'=>'form-control input-sm','placeholder'=>'Offer Name','label'=>false)) ?>
									</div>
									<div class="col-md-3">
										<label class="col-md-6 control-label">Image</label>
										<?= $this->Form->input('image',['class'=>'form-control','type'=>'File','label'=>false]) ?>
									</div>
								 </div>
								 <div class="col-md-12"><br></div>
								 <div class="col-md-12">
									<div class="col-md-3">
										<label class="col-md-6 control-label">Print Rate<span class="required" aria-required="true">*</span></label>
										<?= $this->Form->input('print_rate',['class'=>'form-control input-sm number grnd_ttl calc','label'=>false,'placeholder'=>'Print Rate']) ?>
									</div>
									<div class="col-md-3">
										<label class="col-md-6 control-label">Discount (%)<span class="required" aria-required="true">*</span></label>
										<?= $this->Form->input('discount_per',['class'=>'form-control input-sm number dscnt calc','label'=>false,'placeholder'=>'Discount']) ?>
									</div>
									<div class="col-md-3">
										<label class="col-md-6 control-label">Sales Rate<span class="required" aria-required="true">*</span></label>
										<?= $this->Form->input('sales_rate',['class'=>'form-control input-sm number sls_rat calc','label'=>false,'placeholder'=>'Sales Rate']) ?>
									</div>
								 
								 </div>
								 <div class="col-md-12"><br></div>
							</div>
						<!-- END FORM-->
						<table id="main_table" class="table table-condensed table-bordered">
							<thead>
								<tr align="center">
									<td width="12%">
										<label>Sr<label>
									</td>
									<td width="25%">
										<label>Item<label>
									</td>
									<td width="15%">
										<label>Quantity<label>
									</td>
									<td width="15%">
										<label>Sales Rate<label>
									</td>
									<td width="15%">
										<label>Combo Rate<label>
									</td>
									<td width="15%">
										<label>Combo Amount<label>
									</td>
									<td></td>
								</tr>
							</thead>
							<tbody id='main_tbody' class="tab">
								
							</tbody>
							<tfoot>
								<tr>
									<td>
										<button type="button" class="add btn btn-default input-sm"><i class="fa fa-plus"></i> Add row</button>
									</td>
									
								</tr>
							</tfoot>
						</table>
						<div class="row" style="padding-top:5px;">
							<div class="col-md-4"></div>
							<div class="col-md-4"></div>
							<div class="col-md-4"> </div>
						</div>
						<div align="center">
							<?= $this->Form->button($this->Html->tag('i', '', ['class'=>'fa fa-plus']) . __(' Create Combo Offer'),['class'=>'btn btn-success','id'=>'submitbtn']); ?>
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
				name:{
					required: true
				},
				mobile:{
					required: true
				},
				warehouse_id:{
					required: true
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
			$('#submitbtn').prop('disabled', true);
			$('#submitbtn').text('Submitting.....');
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

	$('.delete-tr').live('click',function() 
	{
		var rowCount = $('#main_table tbody#main_tbody tr').length; 
		if(rowCount>1)
		{
			 $(this).closest('tr').remove();
			 rename_rows();		 
		}	
    });

		$('.add').click(function(){
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
					$(this).find("td:nth-child(2) select").select2().attr({name:"combo_offer_details["+i+"][item_id]", id:"combo_offer_details-"+i+"-item_id"}).rules('add', {
								required: true
							});
					$(this).find("td:nth-child(3) input.quant").attr({name:"combo_offer_details["+i+"][show]", id:"combo_offer_details-"+i+"-show"}).rules('add', {
								required: true
							});
					$(this).find("td:nth-child(3) input.act_quant").attr({name:"combo_offer_details["+i+"][quantity]", id:"combo_offer_details-"+i+"-quantity"}).rules('add', {
								required: true
							});		
					$(this).find("td:nth-child(4) input").attr({name:"combo_offer_details["+i+"][extra]", id:"combo_offer_details-"+i+"-extra"}).rules('add', {
								required: true
							});
					$(this).find("td:nth-child(5) input").attr({name:"combo_offer_details["+i+"][rate]", id:"combo_offer_details-"+i+"-rate"}).rules('add', {
								required: true
							});
					$(this).find("td:nth-child(6) input").attr({name:"combo_offer_details["+i+"][amount]", id:"combo_offer_details-"+i+"-amount"}).rules('add', {
								required: true
							});				
					i++;
				});
			}



	$(".calc").die().live('keyup',function(){
		var total=$(".grnd_ttl").val();
		var discount=$(".dscnt").val();
		var final_amount=((total*discount)/100);
		var sales_amount=total-final_amount;
		$(".sls_rat").val(sales_amount);
		
	});	
	 
	$(".calculation_amount").die().live('keyup',function(){
		calculation();				
	});	
	$(".del_calculation").die().live('click',function(){
		calculation();				
	});
	$(".calc").die().live('keyup',function(){
		var total=$(".grnd_ttl").val();
		var discount=$(".dscnt").val();
		var final_amount=((total*discount)/100);
		var sales_amount=Math.round(total-final_amount);
		$(".sls_rat").val(sales_amount);
		calculation();	
	});
	function calculation(){
		var grand_total = 0;		
		$("#main_table tbody#main_tbody tr.main_tr").each(function(){
			var amount =0;
			var quantity = parseFloat($(this).find("td:nth-child(3) input").val());
			if(!quantity){ quantity=0; }
			var price = parseFloat($(this).find("td:nth-child(3) input").attr("price"));
			if(!price){ price=0; }			
			var unit_name = parseFloat($(this).find("td:nth-child(3) input").attr("unit_name"));
			if(!unit_name){ unit_name=0; }
			amount = Math.round(quantity*price);
			grand_total=grand_total+amount;
			$(this).find("td:nth-child(4) input").val(amount);
		});
			var selling_rate=parseFloat($(".sls_rat").val());
			if(!selling_rate){ selling_rate=0; }
		$("#main_table tbody#main_tbody tr.main_tr").each(function(){	
			var amount_value=parseFloat($(this).find("td:nth-child(4) input").val());
			if(!amount_value){ amount_value=0; }
			var quantity1 = parseFloat($(this).find("td:nth-child(3) input").val());
			if(!quantity1){ quantity1=0; }
			var actual_amount=Math.round((selling_rate*amount_value)/grand_total);
			var actual_rate=Math.round(actual_amount/quantity1);
			$(this).find("td:nth-child(6) input").val(actual_amount);
			$(this).find("td:nth-child(5) input").val(actual_rate);
		});
		//$(".grnd_ttl").val(grand_total.toFixed(2));
		
		
	}
	

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
	
	$(".attribute").die().live('change',function(){
		var raw_attr_name = $('option:selected', this).attr('print_quantity');
		var raw_attr_unit_name3 = $('option:selected', this).attr('unit_name');
		var raw_attr_minimum_quantity_factor = $('option:selected', this).attr('minimum_quantity_factor');	
		var raw_attr_minimum_quantity_purchase = $('option:selected', this).attr('minimum_quantity_purchase');	
		var raw_attr_rates = $('option:selected', this).attr('rates');
		//alert(raw_attr_rates);
		$(this).closest('tr').find('.msg_shw').html("selling factor: "+raw_attr_name);
		$(this).closest('tr').find('.quant').attr('minimum_quantity_factor', +raw_attr_minimum_quantity_factor);
		$(this).closest('tr').find('.quant').attr('unit_name', ''+raw_attr_unit_name3+'');
 		$(this).closest('tr').find('.quant').attr('price', +raw_attr_rates);
 		$(this).closest('tr').find('.amnt').val(raw_attr_rates);
	});
	
 $(".quant").die().live('keyup',function(){
		var quant = parseFloat($(this).val());
		if(!quant){ quant=0; }
		var minimum_quantity_factor = parseFloat($(this).attr('minimum_quantity_factor'));
		if(!minimum_quantity_factor){ minimum_quantity_factor=0; }
		var unit_name = $(this).attr('unit_name');
		if(!unit_name){ unit_name=0; }
		var price =  parseFloat($(this).attr('price'));
		if(!price){ price=0; }
		var g_total = quant*minimum_quantity_factor;
		var rate = Math.round(quant*price);
		$(this).closest('tr').find('.amnt').val(rate);
		$(this).closest('tr').find('.msg_shw2').html(g_total+" "+unit_name);
		$(this).closest('tr').find('.act_quant').val(g_total);
		var g_total =  parseFloat($('.grnd_ttl').val());
		if(!g_total){ g_total=0; }
		var final_val = g_total+rate;
		//$('.grnd_ttl').val(final_val);
	});  
});

</script>
	<table id="sample_table" style="display:none;" cellpadding="5" cellspacing="5">
		<tbody>
			<tr class="main_tr" class="tab">
				<td align="center" width="1px"></td>
				<td>
					<?= $this->Form->input('item_id',array('options' => $items,'class'=>'form-control input-sm attribute','empty' => 'Select','label'=>false)) ?>
					<span class="msg_shw" style="color:blue;font-size:12px;"></span>
				</td>
				<td>
					<?php echo $this->Form->input('show', ['label' => false,'class' => 'form-control input-sm number quant calculation_amount','placeholder'=>'Quantity']); ?>
					<?php echo $this->Form->input('quantity', ['label' => false,'class' => 'form-control input-sm act_quant ','type'=>'hidden']); ?>
					<span class="msg_shw2" style="color:blue;font-size:12px;"></span>
				</td>
				<td>
					<?php echo $this->Form->input('extra', ['label' => false,'class' => 'form-control input-sm number amnt','placeholder'=>'extra']); ?>
				</td>
				<td>
					<?php echo $this->Form->input('rate', ['label' => false,'class' => 'form-control input-sm','placeholder'=>'rate' ,'readonly'=>'readonly']); ?>
				</td>
				<td>
					<?php echo $this->Form->input('amount', ['label' => false,'class' => 'form-control input-sm number','placeholder'=>'amount','readonly'=>'readonly']); ?>
				</td>
				<td>
					<a class="btn btn-default delete-tr input-sm del_calculation" href="#" role="button" style="margin-bottom: 1px;"><i class="fa fa-times"></i></a>
				</td>
			</tr>
		</tbody>
	</table>
