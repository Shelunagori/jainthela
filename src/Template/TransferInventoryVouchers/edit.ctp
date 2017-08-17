<div class="row">
		<div class="col-md-12">
			<div class="portlet">
		<div class="portlet-body"> 
			<?= $this->Form->create($transferInventoryVoucher,['id'=>'form_sample_3']) ?>
				<div class="portlet light bordered">
					<div class="portlet-title">
						<div class="caption">
							<span>
							<B>Transfer Inventory Voucher</B>
							</span>
						</div>
					</div>
					<div class="portlet-body form">
					<!-- BEGIN FORM-->
							<div class="row">
								<div class="col-md-6">
									<h4 align="center">OUT</h4>
									<div class="col-md-12">
										<label class="col-md-6 control-label">Warehouse <span class="required" 	aria-required="true">*</span></label>
										<?= $this->Form->input('warehouse_id',array('options' => $warehouses,'class'=>'ware_house form-control input-sm','label'=>false, 'value'=>$transferInventoryVoucher->warehouse_id)) ?>
									</div>
									<div class="col-md-12"><br></div>
									<div class="col-md-6">
										<label class="col-md-6 control-label">Item <span class="required" 	aria-required="true">*</span></label>
										<?= $this->Form->input('item_id',array('options' => $items,'class'=>'form-control input-sm select2me itm_chng','empty' => 'Select','label'=>false, 'value'=>$transferInventoryVoucher->item_id)) ?>
									</div>
									
									<div class="col-md-2">
										<label class="control-label">Available <span class="required" aria-require>*</span></label>
										 <div id="set"></div>
									</div>
									<div class="col-md-2">
										<label class="control-label">Quantity<span class="required" aria-require>*</span></label>
										<?php echo $this->Form->control('quantity',['placeholder'=>'quantity','class'=>'form-control input-sm valid main_quantity calculation_amount','label'=>false,'type'=>'text', 'value'=>$transferInventoryVoucher->quantity]); ?>
									</div>
								 </div>
								 <div class="col-md-6">
								   <h4 align="center">IN</h4>
									<table id="main_table" class="table table-condensed table-bordered">
										<thead>
											<tr align="center">
												<td width="7%">
													<label>Sr<label>
												</td>
												<td width="40%">
													<label>Item<label>
												</td>
												<td width="20%">
													<label>Quantity<label>
												</td>
												<td></td>
											</tr>
										</thead>
										<tbody id='main_tbody' class="tab">
											<?php 
											$trnsfr_quntity=0;
											$i=0;
										
											foreach($transferInventoryVoucher->transfer_inventory_voucher_rows as $transferInventoryVoucherRow){
												@$k++;
												$minimum_quantity_factor=$transferInventoryVoucherRow->item->minimum_quantity_factor;
												$unit_name=$transferInventoryVoucherRow->item->unit->unit_name;
												$actal_qty=$transferInventoryVoucherRow->quantity;
												$trnsfr_quntity=$trnsfr_quntity+$transferInventoryVoucherRow->quantity;
												
												?>
											<tr class="main_tr" class="tab">
												<td align="center" width="1px"><?= $k ?></td>
												<td>
												<?= $this->Form->input('transfer_inventory_voucher_rows['.$i.'][item_id]',array('options' => $items,'class'=>'form-control input-sm itm_chng attribute','empty' => 'Select','label'=>false, 'value'=>$transferInventoryVoucherRow->item_id)) ?>
												</td>
												<td>
												<?= $this->Form->input('transfer_inventory_voucher_rows['.$i.'][quantity]', ['label' => false,'class' => 'form-control input-sm number valid calculation_amount quant','placeholder'=>'Quantity','value'=>$transferInventoryVoucherRow->quantity,'minimum_quantity_factor'=>$minimum_quantity_factor, 'unit_name'=>$unit_name]); ?>
											
												<span class="msg_shw2" style="color:blue;font-size:12px;"><?php echo $actal_qty.' '.$unit_name; ?></span>
												<?= $this->Form->input('transfer_inventory_voucher_rows['.$i.'][quantity_factor]', ['label' => false,'class' => 'form-control input-sm number mains', 'type'=>'hidden','value'=>$transferInventoryVoucherRow->quantity_factor]); ?>
						
												</td>

												<td>
												<a class="btn btn-default delete-tr input-sm" href="#" role="button" style="margin-bottom: 1px;"><i class="fa fa-times"></i></a>
												</td>
											</tr>
												
											<?php
												$i++;
											} ?>
											
										</tbody>
										<tfoot>
											<tr>
												<td>
													<button type="button" class="add btn btn-default input-sm"><i class="fa fa-plus"></i> Add row</button>
												</td>
												
												<td colspan="4"></td>
											</tr>
											<tr>
												<td></td>
												<td>Waste Quantity</td>
												<td>
												<?php 
												$remaining=$transferInventoryVoucher->quantity-$trnsfr_quntity;
												?>
													<?php echo $this->Form->input('waste_quantity', ['label' => false,'class' =>'remaining form-control input-sm number valid','placeholder'=>'waste Quantity']); ?>	
												</td>
											</tr>
										</tfoot>
									</table>
								 </div>
								 <div class="col-md-12"><br></div>
							</div>
						
						<div class="row" style="padding-top:5px;">
							<div class="col-md-4"></div>
							<div class="col-md-4"></div>
							<div class="col-md-4"> </div>
						</div>
						<div align="center">
							<?= $this->Form->button($this->Html->tag('i', '', ['class'=>'fa fa-plus']) . __(' Transfer Inventory'),['class'=>'btn btn-success','id'=>'submitbtn']); ?>
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
				warehouses_id:{
					required: false
				},
				driver_id:{
					required: true
				},
				transaction_date:{
					required: false
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
	calculation();
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
			 
		}
		rename_rows();
		calculation();
    });

	$('.add').click(function(){
			add_row();
			calculation();
	});

	

	function add_row(){
			var tr=$("#sample_table tbody tr.main_tr").clone();
			$("#main_table tbody#main_tbody").append(tr); 
			rename_rows();
			calculation();
		}

	function rename_rows(){
		var i=0;
		$("#main_table tbody#main_tbody tr.main_tr").each(function(){ 
			$(this).find('td:nth-child(1)').html(i+1);
			$(this).find("td:nth-child(2) select").select2().attr({name:"transfer_inventory_voucher_rows["+i+"][item_id]", id:"transfer_inventory_voucher_rows-"+i+"-item_id"}).rules('add', {
						required: true
					});
			$(this).find("td:nth-child(3) input").attr({name:"transfer_inventory_voucher_rows["+i+"][quantity]", id:"transfer_inventory_voucher_rows-"+i+"-quantity"}).rules('add', {
						required: true
					});
			$(this).find("td:nth-child(3) input[type=hidden]").attr({name:"transfer_inventory_voucher_rows["+i+"][quantity_factor]", id:"transfer_inventory_voucher_rows-"+i+"-quantity_factor"}).rules('add', {
						required: true
					});
			i++;
		});
	}

	rename_rows();
	$(".calculation_amount").die().live('keyup',function(){
		calculation();
	});

	function calculation(){
		
		var grand_total = 0;		
		$("#main_table tbody#main_tbody tr.main_tr").each(function(){
			var quantity = parseFloat($(this).find("td:nth-child(3) input").val());
		if(!quantity){ quantity=0; }			
			var minimum_quantity_factor = parseFloat($(this).find("td:nth-child(3) input[type=hidden]").val());
	
			if(!minimum_quantity_factor){ minimum_quantity_factor=0; }
			var final_val=quantity*minimum_quantity_factor;
			
			grand_total=grand_total+final_val;
			$(this).find("td:nth-child(4) input").val(final_val.toFixed(2));
		});
			var main_quantity = parseFloat($(".main_quantity").val());
			
			if(!main_quantity){ main_quantity=0; }
		var remaining = main_quantity-grand_total;
		
		$(".remaining").val(remaining.toFixed(2));
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

	$('.itm_chng').die().live('change',function() 
	{ 
		$('#data').html('<i style= "margin-top: 20px;" class="fa fa-refresh fa-spin fa-3x fa-fw"></i><b> Loading... </b>');
		var update = $(this);
		var itm_val = $(this).val();
		var unit_name = $('option:selected', this).attr('unit_name');
		$('.main_quantity').attr('unit_name', ''+unit_name+'');
		var ware_house = $(".ware_house").val();
 		var m_data = new FormData();
		m_data.append('itm_val',itm_val);
		m_data.append('ware_house',ware_house);

		$.ajax({
			url: "<?php echo $this->Url->build(["controller" => "ItemLedgers", "action" => "ajax_stock_available"]); ?>",
			data: m_data,
			processData: false,
			contentType: false,
			type: 'POST',
			dataType:'text',
			success: function(data)   // A function to be called if request succeeds
			{
				$("#set").html(data+" "+unit_name);
				$(".main_quantity ").attr('max', +data);
				//$('.valid').attr('max',data);
				/* $(update).closest('div').find('#set').html(data);
				$(update).closest('tr').find('.stock_available').html(data);
				$(update).closest('tr').find('.valid').attr('max',data); */
			}
		});	
		calculation();
	});
	
	


	$(".attribute").die().live('change',function(){
		var raw_attr_name = $('option:selected', this).attr('print_quantity');
		var raw_attr_rates = $('option:selected', this).attr('rates');
		var raw_attr_unit_name3 = $('option:selected', this).attr('unit_name');
		var raw_attr_minimum_quantity_factor = $('option:selected', this).attr('minimum_quantity_factor');
		var raw_attr_minimum_quantity_purchase = $('option:selected', this).attr('minimum_quantity_purchase');
		$(this).closest('tr').find('.msg_shw').html("selling factor in : "+ raw_attr_unit_name3);
		//$(this).closest('tr').find('.rat_value').val(raw_attr_rates);
		$(this).closest('tr').find('.quant').attr('minimum_quantity_factor', +raw_attr_minimum_quantity_factor);
		$(this).closest('tr').find('.quant').attr('unit_name', ''+raw_attr_unit_name3+'');
		//$(this).closest('tr').find('.quant').attr('max', +raw_attr_minimum_quantity_purchase);
		calculation();
	});

	$(".quant").die().live('keyup',function(){
		var quant = parseFloat($(this).val());
		if(!quant){ quant=0; }
		var minimum_quantity_factor = parseFloat($(this).attr('minimum_quantity_factor'));
		if(!minimum_quantity_factor){ minimum_quantity_factor=0; }
		var unit_name = $(this).attr('unit_name');
		if(!unit_name){ unit_name=0; }
		var g_total = quant*minimum_quantity_factor;
		$(this).closest('tr').find('.msg_shw2').html(quant+" "+unit_name);
		$(this).closest('tr').find('.mains').val(minimum_quantity_factor);
		calculation();
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
						<?php echo $this->Form->input('quantity', ['label' => false,'class' => 'form-control input-sm number valid calculation_amount quant','placeholder'=>'Quantity','value'=>0]); ?>
						<span class="msg_shw2" style="color:blue;font-size:10px;"></span>
						<?php echo $this->Form->input('quantity', ['label' => false,'class' => 'form-control input-sm number mains','value'=>0, 'type'=>'hidden']); ?>
						
					</td>
					 
                    <td>
						<a class="btn btn-default delete-tr input-sm" href="#" role="button" style="margin-bottom: 1px;"><i class="fa fa-times"></i></a>
					</td>
				</tr>
			</tbody>
		</table>
