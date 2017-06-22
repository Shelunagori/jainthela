<div class="row">
		<div class="col-md-12">
			<div class="portlet">
		<div class="portlet-body"> 
			<?= $this->Form->create($walkinSale,['id'=>'form_sample_3']) ?>
				<div class="portlet light bordered">
					<div class="portlet-title">
						<div class="caption">
							<span>
							<B>Walk In Sales</B>
							</span>
						</div>
						<div class="actions">
					
					
					<?php echo $this->Html->link('<i class="fa fa-plus"></i> View All','/WalkinSales/index',['escape'=>false,'class'=>'btn btn-default']) ?>
					
				</div>
					</div><?php /* echo $this->Html->link('<i class="fa fa-plus"></i> Add new','/WalkinSales/index',['escape'=>false,'class'=>'btn btn-default'])  */?>
					<div class="portlet-body form">
					<!-- BEGIN FORM-->
							<div class="row">
								<div class="col-md-12">
									<div class="col-md-3">
										<label class="col-md-6 control-label">Customer Name <span class="required" 	aria-required="true">*</span></label>
										<?= $this->Form->input('name',array('class'=>'form-control input-sm select2me','placeholder'=>'Customer Name','label'=>false)) ?>
									</div>
									<div class="col-md-3">
										<label class="col-md-8 control-label">Customer Mobile No <span class="required" aria-required="true">*</span></label>
										<?= $this->Form->input('mobile',array('class'=>'form-control input-sm select2me number','placeholder'=>'Customer Mobile No','label'=>false)) ?>
									</div>
									<div class="col-md-3">
											<label class="col-md-6 control-label">Warehouses <span class="required" 	aria-required="true">*</span></label>
											<?= $this->Form->input('warehouse_id',array('options' => $warehouses,'class'=>'form-control input-sm','label'=>false)) ?>
										</div>
										 
									<div class="col-md-3">
										<label class="control-label">Date <span class="required" aria-require>*</span></label>
										<?php echo $this->Form->control('transaction_date',['placeholder'=>'dd-mm-yyyy','class'=>'form-control input-sm date-picker','data-date-format'=>'dd-mm-yyyy','label'=>false,'type'=>'text','value'=>date('d-m-Y')]); ?>
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
									<td width="30%">
										<label>Item<label>
									</td>
									<td width="15%">
										<label>Quantity<label>
									</td>
									<td width="15%">
										<label>Rate<label>
									</td>
									<td width="20%">
										<label>Amount<label>
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
									<td colspan="3" style="text-align:right !important;">
										<label class="control-label" >Grand Total</label>
									</td>
									<td>
										<div class="form-group">
											<?= $this->Form->input('total_amount',['class'=>'form-control input-sm grnd_ttl','label'=>false,'placeholder'=>'Grand Total','label'=>false]) ?>
										</div>
									</td>
									<td></td>
								</tr>
							</tfoot>
						</table>
						<div class="row" style="padding-top:5px;">
							<div class="col-md-4"></div>
							<div class="col-md-4"></div>
							<div class="col-md-4"> </div>
						</div>
						<div align="center">
							<?= $this->Form->button($this->html->tag('i', '', ['class'=>'fa fa-plus']) . __(' Create Walk In Sales'),['class'=>'btn btn-success','id'=>'submitbtn']); ?>
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
					$(this).find("td:nth-child(2) select").select2().attr({name:"walkin_sale_details["+i+"][item_id]", id:"walkin_sale_details-"+i+"-item_id"}).rules('add', {
								required: true
							});
					$(this).find("td:nth-child(3) input").attr({name:"walkin_sale_details["+i+"][quantity]", id:"walkin_sale_details-"+i+"-quantity"}).rules('add', {
								required: true
							}); 
					$(this).find("td:nth-child(4) input").attr({name:"walkin_sale_details["+i+"][rate]", id:"walkin_sale_details-"+i+"-rate"}).rules('add', {
								required: true
							});
					$(this).find("td:nth-child(5) input").attr({name:"walkin_sale_details["+i+"][amount]", id:"walkin_sale_details-"+i+"-amount"}).rules('add', {
								required: true
							}); 
					i++;
				});
			}


	$(".calculation_amount").die().live('keyup',function(){
		calculation();				
	});	
	$(".del_click").die().live('click',function(){
		calculation();				
	});	
	function calculation(){
		var grand_total = 0;		
		$("#main_table tbody#main_tbody tr.main_tr").each(function(){
			var amount =0;
			var quantity = parseFloat($(this).find("td:nth-child(3) input").val());
			if(!quantity){ quantity=0; }
			var price = parseFloat($(this).find("td:nth-child(4) input").val());
			if(!price){ price=0; }
			amount = quantity*price;
			grand_total=grand_total+amount;
			$(this).find("td:nth-child(5) input").val(amount.toFixed(2));
			var total_amount = $(this).find("td:nth-child(5) input").val();
		}); 
		$(".grnd_ttl").val(grand_total.toFixed(2));
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
});
 
</script>
		<table id="sample_table" style="display:none;" cellpadding="5" cellspacing="5">
			<tbody>
				<tr class="main_tr" class="tab">
					<td align="center" width="1px"></td>
				    <td>
						<?= $this->Form->input('item_id',array('options' => $items,'class'=>'form-control input-sm select2me','empty' => 'Select','label'=>false)) ?>
					</td>
					<td>
						<?php echo $this->Form->input('quantity', ['label' => false,'class' => 'form-control input-sm number calculation_amount','placeholder'=>'Quantity']); ?>	
					</td>
					<td>
						<?php echo $this->Form->input('rate', ['label' => false,'class' => 'form-control input-sm calculation_amount number','placeholder'=>'Price']); ?>
					</td>
                    <td>
						<?php echo $this->Form->input('amount', ['label' => false,'class' => 'form-control input-sm number','placeholder'=>'Total Amount']); ?>
					</td>						  
                    <td>
						<a class="btn btn-default delete-tr input-sm del_click" href="#" role="button" style="margin-bottom: 1px;"><i class="fa fa-times"></i></a>
					</td>
				</tr>
			</tbody>
		</table>