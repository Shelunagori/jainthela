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
					<span class="caption-subject font-purple-intense "><i class="fa fa-plus"></i> Edit Order </span>
				</div>

			</div>
			<div class="portlet-body">
				<?= $this->Form->create($order,['id'=>'form_sample_3']) ?>
				<?php 
				if(!empty($bulkorder_id)){
					foreach($bulk_Details as $bulk_Detail){
						$bulk_image=$bulk_Detail->image;
						$bulk_delivery_date=date('d-M-Y', strtotime($bulk_Detail->delivery_date));
						$bulk_delivery_time=$bulk_Detail->delivery_time;
						
					}
				}
				
				$order_date=date('d-m-Y', strtotime($order->order_date));
					?>
				<div class="row">
					<div class="col-md-4">
						<label class=" control-label">Customer <span class="required" aria-required="true">*</span></label>
						<?php echo $this->Form->control('customer_id',['empty'=>'--Select Customer--','options' => $customers,'class'=>'form-control input-sm select2me','id'=>'customer_id','label'=>false]); ?>
					</div>
					<div class="col-md-3">
						<label class=" control-label">Warehouse <span class="required" aria-required="true">*</span></label>
						<?php echo $this->Form->control('warehouse_id',['options' => $warehouses,'class'=>'form-control input-sm','id'=>'customer_id','label'=>false]); ?>
					</div>
					<div class="col-md-3">
						<label class="control-label">Order Date <span class="required" aria-require>*</span></label>
						<?php echo $this->Form->control('order_date1',['placeholder'=>'dd-mm-yyyy','class'=>'form-control input-sm date-picker','data-date-format'=>'dd-mm-yyyy','label'=>false,'type'=>'text','value'=>$order_date]); ?>
					</div>
				<!--
				<?php if(!empty($bulkorder_id)){ ?>
					<div class="col-md-4" align="center">
						<label class=" control-label">Delivery Date</label><br>
						<?php echo $bulk_delivery_date; ?>
					</div>
						<div class="col-md-4" align="center">
						<label class=" control-label">Delivery Time</label><br>
						<?php echo $bulk_delivery_time; ?>
					</div>
				<?php } ?>
				-->
				</div><br/>
				<div class="row">
				
					<div class="row">
					<?php if($order->order_type=="Bulkorder"){ ?>
				
					<div class="col-md-3">
						<div class="form-group">
							<label class="control-label">Provide Cash Back <span class="required" aria-required="true">*</span></label>
							<div class="radio-list">
								<div class="radio-inline" style="padding-right: 5px;">
									<?php echo $this->Form->radio(
									'cash_back_flag',
									[
										['value' => 'no', 'text' => 'Yes','class' => 'radio-task'],
										['value' => 'yes', 'text' => 'No','class' => 'radio-task']
									]
									); ?>
								</div>
							</div>
						</div>
					</div>
			
				<?php } ?>
					<div class="col-md-6">
						<label class="control-label">Address</label>
							<?php echo $this->Form->input('customer_address_id', ['type'=>'hidden','label' => false,'class' => 'form-control','placeholder' => 'Address','value'=>@$customer_address_id]); ?>
							<?php echo $this->Form->input('customer_address', ['label' => false,'class' => 'form-control','placeholder' => 'Address','rows'=>'5','cols'=>'5','value'=>ucwords(@$order->customer->customer_addresses[0]['house_no']).ucwords(@$order->customer->customer_addresses[0]['address']).'-'.ucwords(@$order->customer->customer_addresses[0]['locality'])]); ?>
							
							<a href="#" role="button" class="pull-right select_address" >
							Select Address </a>
							
						
					</div>
				</div>
				<div class="col-md-12"><br/></div>
				<div class="row">
					
					<div class="col-md-8">
						<table id="main_table" class="table table-condensed table-bordered">
							<thead>
								<tr align="center">
									<td width="5%">
										<label>Sr<label>
									</td>
									<td width="30%">
										<label>item<label>
									</td>
									<td width="20%">
										<label>Quantity<label>
									</td>
									<td width="20%">
										<label>Rate<label>
									</td>
									<td width="20%">
										<label>Amount<label>
									</td>
									<td width="0%"></td>
									<td></td>
								</tr>
							</thead>
								<tbody id='main_tbody' class="tab">
								<?php $k=0;
								foreach($OrderDetails as $OrderDetail){
									$fetch_id=$OrderDetail->id;
									$fetch_item_id=$OrderDetail->item_id;
									$fetch_quantity=$OrderDetail->quantity;
									$fetch_rate=$OrderDetail->rate;
									$fetch_amount=$OrderDetail->amount;
									$fetch_combo=$OrderDetail->is_combo;
									$minimum_quantity_factor=$OrderDetail->item->minimum_quantity_factor;
									$unit_name=$OrderDetail->item->unit->unit_name;
									$actual_quantity=$fetch_quantity/$minimum_quantity_factor;
									$msg_box_show=$actual_quantity*$minimum_quantity_factor;
									?>
									<tr class="main_tr" class="tab">
										<td align="center" width="1px"></td>
										<td>
											<?php echo $this->Form->input('item_id', ['empty'=>'--Select-','options'=>$items,'label' => false,'class' => 'form-control input-sm attribute', 'value'=>$fetch_item_id]); ?>
											<span class="msg_shw" style="color:blue;font-size:12px;">selling factor in : <?php echo $minimum_quantity_factor.' '.$unit_name; ?></span>
										</td>
										<td>
											<?php echo $this->Form->input('show_quantity', ['value'=> $fetch_quantity,'label' => false,'class' => 'form-control input-sm number cal_amount quant','value'=>$actual_quantity, 'minimum_quantity_factor'=>$minimum_quantity_factor, 'unit_name'=>$unit_name]); ?>
											
											<span class="msg_shw2" style="color:blue;font-size:12px;"><?php echo $msg_box_show.' '.$unit_name; ?></span>
											<?php echo $this->Form->input('quantity', ['label' => false,'class' => 'form-control input-sm number mains', 'type'=>'hidden','value'=>$fetch_quantity]); ?>
										</td>
										<td>
											<?php echo $this->Form->input('rate', ['label' => false,'class' => 'form-control input-sm number cal_amount rat_value','placeholder'=>'Rate','value'=>$fetch_rate]); ?>	
										</td>
										<td>
											<?php echo $this->Form->input('amount', ['label' => false,'class' => 'form-control input-sm number cal_amount','placeholder'=>'Amount','readonly','value'=>$fetch_amount]); ?>	
										</td>
										<td>
										<?php echo $this->Form->input('is_combo', ['label' => false,'class' => 'form-control input-sm is_combo','type'=>'hidden','value'=>$fetch_combo]); ?>	
										</td>
										<td>
											<a class="btn btn-default delete-tr input-sm" href="#" role="button" ><i class="fa fa-times"></i></a>
										</td>
									</tr>
							<?php $k++;	} ?>
							</tbody>
							<tfoot>
								<?php if($order->discount_percent>0){ ?>
								<tr id="discount">
									<td colspan="4" style="text-align:right;">Discount in Percent</td>
									<td><?php echo $this->Form->control('discount_percent',['placeholder'=>'Discount','class'=>'form-control input-sm','label'=>false,'type'=>'text','value'=>$order->discount_percent,'readonly']); ?>
									
									</td>
								</tr>
								<?php } ?>
								<tr>
									<td colspan="4" style="text-align:right;">
									<a class="btn btn-default input-sm add_row" href="#" role="button"  style="float: left;"><i class="fa fa-plus"></i> Add Row</a>
									Total Amount</td>
									<td>
									<?php echo $this->Form->input('total_amount', ['label' => false,'class' => 'form-control input-sm number cal_amount','placeholder'=>'Total Amount','type'=>'text','readonly','value'=>$order->total_amount]); ?>
									</td>
									<td></td>	</tr>
								
								<tr>
									<td colspan="4" style="text-align:right;">
									Delivery Charge
									</td>
									<td>
									<?php echo $this->Form->control('delivery_charge',['placeholder'=>'Amount From Wallet','class'=>'number form-control input-sm cal_amount dlvry','label'=>false,'type'=>'text','value'=>$order->delivery_charge,'readonly']); ?>
									</td>
									<td></td>
								</tr>
								
								<tr>
									<td colspan="4" style="text-align:right;">Grand Total</td>
									<td><?php echo $this->Form->input('grand_total', ['label' => false,'class' => 'form-control input-sm number ','placeholder'=>'Total Amount','type'=>'text','readonly']); ?>
									</td>
								</tr>
									<td colspan="4" style="text-align:right;">
									Amount From Wallet
									</td>
									<td>
									<?php echo $this->Form->control('amount_from_wallet',['placeholder'=>'Amount From Wallet','class'=>'
									form-control input-sm cal_amount','label'=>false,'type'=>'text','readonly']); ?>
									</td>
									<td></td>
								</tr>
								
								
								<tr>
									<td colspan="4" style="text-align:right;">
									Paid Amount
									</td>
									<td>
									<?php echo $this->Form->input('pay_amount', ['label' => false,'class' => 'form-control input-sm number cal_amount','placeholder'=>'Total Amount','type'=>'text','readonly']); ?>
									</td>
									<td></td>
								</tr>
								
	<td></td>
</tr>
							</tfoot>
						</table>
					</div>
				</div>
				<div class="row">
					<div class="col-md-2">
						<label class="control-label">Delivery Date<span class="required" aria-require>*</span></label>
						<?php echo $this->Form->control('delivery_date',['placeholder'=>'dd-mm-yyyy','class'=>'form-control input-sm date-picker','data-date-format'=>'dd-mm-yyyy','label'=>false,'type'=>'text','value'=>date('d-m-Y')]); ?>
					</div>
					<div class="col-md-2">
						<label class="control-label">Delivery Time <span class="required" aria-require>*</span></label>										
						<?= $this->Form->input('delivery_time_id', ['empty'=>'--Select time--','options' => $delivery_time,'class'=>'form-control input-sm select2me','id'=>'delivery_id','label'=>false]) ?>
					</div>
					<div class="col-md-1">
						<?= $this->Form->input('delivery_time', ['class'=>'form-control','label'=>false,'type'=>'hidden','id'=>'del_time']) ?>
					</div>
				</div> 
				 
				<br/>
				<center>
				<?= $this->Form->button($this->Html->tag('i', '', ['class'=>'fa fa-plus']) . __(' Submit'),['class'=>'btn btn-success']); ?>
				</center>
				<?= $this->Form->end() ?>
			</div>
		</div>
	</div>

</div>
<?php echo $this->Html->script('/assets/global/plugins/jquery.min.js'); ?>
<script>
$(document).ready(function() {
  //--------- FORM VALIDATION
  calculate_total();
	var form3 = $('#form_sample_3');
	var error3 = $('.alert-danger', form3);
	var success3 = $('.alert-success', form3);
	form3.validate({
		
		errorElement: 'span', //default input error message container
		errorClass: 'help-block help-block-error', // default input error message class
		focusInvalid: true, // do not focus the last invalid input
		rules: {
				customer_id:{
					required: true
				},
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
		var total_amount=0;
		var rowCount = $('#main_table tbody#main_tbody tr').length; 
		if(rowCount>1)
		{
			 $(this).closest('tr').remove();
			 $("#main_table tbody#main_tbody tr.main_tr").each(function(){ 
			 
			total_amount+=parseFloat($(this).find("td:nth-child(5) input").val());
			
		});
		var amount_from_wallet=parseFloat($('input[name=amount_from_wallet]').val());
		var grand_total=total_amount-amount_from_wallet;
		$('input[name=total_amount]').val(grand_total);
			 
		}
		rename_rows();
		calculate_total();
    });

	$('.add_row').click(function(){
		add_row();
		calculate_total();
	});

	rename_rows();
	calculate_total();
	function add_row(){
		var tr=$("#sample_table tbody tr.main_tr").clone();
		$("#main_table tbody#main_tbody").append(tr);
		
		rename_rows();
		calculate_total();
	}


	function calculate_total(){
		var total=0;
		$("#main_table tbody#main_tbody tr.main_tr").each(function(){ 
		
		var obj=$(this).closest('tr');
		var qty=obj.find('td:nth-child(3) input').val();
		var rate=obj.find('td:nth-child(4) input').val();
		var amount=qty*rate;
		var rate=obj.find('td:nth-child(5) input').val(amount);
		var total_amount=0;
		$("#main_table tbody#main_tbody tr.main_tr").each(function(){ 
			total_amount+=parseFloat($(this).find("td:nth-child(5) input").val());
		});
		var display_amount=Math.round(total_amount);
		if($('input[name=discount_percent]').val())
		{
		var discount_percent=parseFloat($('input[name=discount_percent]').val());
		var discount_amount=Math.round(total_amount*(discount_percent/100));
		var total_amount=Math.round(total_amount-discount_amount);
		}
		if(total_amount<100 && total_amount>0){
			$('input[name=delivery_charge]').val(50);
		}else{
			$('input[name=delivery_charge]').val(0);
		}
		var amount_from_wallet=parseFloat($('input[name=amount_from_wallet]').val());
		var delivery_charge=parseFloat($('input[name=delivery_charge]').val());
		if(!amount_from_wallet){
		amount_from_wallet=0;
		}
		
		var grand_total=Math.round(total_amount+delivery_charge);
		var paid_amount=Math.round(grand_total-amount_from_wallet);
		$('input[name=grand_total]').val(grand_total);
		$('input[name=total_amount]').val(display_amount);
		$('input[name=pay_amount]').val(paid_amount);
		
		});
	}
	
	
	function rename_rows(){
		var i=0; 
		$("#main_table tbody#main_tbody tr.main_tr").each(function(){ 
			$(this).find('td:nth-child(1)').html(i+1);
			$(this).find("td:nth-child(2) select").select2().attr({name:"order_details["+i+"][item_id]", id:"order_details-"+i+"-item_id"}).rules('add', {
						required: true
					});
			$(this).find("td:nth-child(3) input.quant").attr({name:"order_details["+i+"][show_quantity]", id:"order_details-"+i+"-show_quantity"}).rules('add', {
						required: true
					});
			$(this).find("td:nth-child(3) input.mains").attr({name:"order_details["+i+"][quantity]", id:"order_details-"+i+"-quantity"}).rules('add', {
						required: true
					});
			$(this).find("td:nth-child(4) input").attr({name:"order_details["+i+"][rate]", id:"order_details-"+i+"-rate"}).rules('add', {
				required: true
			});
			$(this).find("td:nth-child(5) input").attr({name:"order_details["+i+"][amount]", id:"order_details-"+i+"-amount"}).rules('add', {
				required: true
			});
			$(this).find("td:nth-child(6) input[type=hidden]").attr({name:"order_details["+i+"][is_combo]", id:"order_details-"+i+"-is_combo"});
			
			i++;
		});
		calculate_total();
	}

	$(document).on('keyup','.cal_amount',function(){ 
	
		calculate_total();
	});

	
	<?php
	if($order->order_type==='Bulkorder')
	{
	?>
		$(document).on('change','#customer_id',function(){ 
			var customer_id=$(this).val();
			$('#data').html('<i style= "margin-top: 20px;" class="fa fa-refresh fa-spin fa-3x fa-fw"></i><b> Loading... </b>');
				var m_data = new FormData();
				m_data.append('customer_id',customer_id);
				$('#discount').remove();
				$.ajax({
					url: "<?php echo $this->Url->build(["controller" => "Orders", "action" => "ajax_customer_discount"]); ?>",
					data: m_data,
					processData: false,
					contentType: false,
					type: 'POST',
					dataType:'text',
					success: function(data)   // A function to be called if request succeeds
					{
						$('#main_table tfoot').prepend(data);
						calculate_total();
					}	
				});	
				
		});
	<?php
	}
	?>
	
	
	$(".attribute").die().live('change',function(){
		
		var raw_attr_name = $('option:selected', this).attr('print_quantity');
		var raw_attr_rates = $('option:selected', this).attr('sales_rate');
		var raw_attr_unit_name3 = $('option:selected', this).attr('unit_name');
		var raw_attr_minimum_quantity_factor = $('option:selected', this).attr('minimum_quantity_factor');
		var raw_attr_minimum_quantity_purchase = $('option:selected', this).attr('minimum_quantity_purchase');
		var amount=raw_attr_minimum_quantity_factor*raw_attr_rates;
		var is_combo=$('option:selected', this).attr('is_combo');
		
		$(this).closest('tr').find('.msg_shw').html("selling factor in : "+ raw_attr_minimum_quantity_factor +" "+ raw_attr_unit_name3);
		$(this).closest('tr').find('.is_combo').val(is_combo);
		$(this).closest('tr').find('.rat_value').val(raw_attr_rates);
		$(this).closest('tr').find('.quant').val(1);
		
		$(this).closest('tr').find('.msg_shw2').html(raw_attr_minimum_quantity_factor+" "+raw_attr_unit_name3);
		$(this).closest('tr').find('.mains').val(raw_attr_minimum_quantity_factor);
		$(this).closest('tr').find('.quant').attr('minimum_quantity_factor', +raw_attr_minimum_quantity_factor);
		$(this).closest('tr').find('.quant').attr('unit_name', ''+raw_attr_unit_name3+'');
		$(this).closest('tr').find('.show_amount').val(amount);
		//$(this).closest('tr').find('.quant').attr('max', +raw_attr_minimum_quantity_purchase);
		calculate_total();
	});

	$(".quant").die().live('keyup',function(){
		var quant = parseFloat($(this).val());
		if(!quant){ quant=0; }
		var minimum_quantity_factor = parseFloat($(this).attr('minimum_quantity_factor'));
		if(!minimum_quantity_factor){ minimum_quantity_factor=0; }
		var unit_name = $(this).attr('unit_name');
		if(!unit_name){ unit_name=0; }
		var g_total = quant*minimum_quantity_factor;
		$(this).closest('tr').find('.msg_shw2').html(g_total+" "+unit_name);
		$(this).closest('tr').find('.mains').val(g_total);
		calculate_total();
	});
	
	$(document).on('keyup', '.number', function(e)
    { 
		var mdl=$(this).val();
		var numbers =  /^[0-9]*$/;
		if(mdl.match(numbers))
		{
		}
		else
		{
			$(this).val('');
			return false;
		}
    });
	
	$("#delivery_id").die().live('change',function(){
		var raw_time_name = $('option:selected', this).text();
		$('#del_time').val(raw_time_name);
		//$(this).closest('tr').find('.quant').attr('max', +raw_attr_minimum_quantity_purchase);
	});
	////
	$('.closebtn').live("click",function() { 
		$(".modal").hide();
    });
	
	$('.select_address').on("click",function() { 
		open_address();
    });
	
	function open_address(){
		var customer_id=$('select[name="customer_id"]').val();
		$("#result_ajax").html('<div align="center"><?php echo $this->Html->image('/img/wait.gif', ['alt' => 'wait']); ?> Loading</div>');
		var url="<?php echo $this->Url->build(['controller'=>'Customers','action'=>'addressList']); ?>";
		url=url+'/'+customer_id,
		$("#myModal1").show();
		$.ajax({
			url: url,
		}).done(function(response) {
			$("#result_ajax").html(response);
		});
	}
	
	$('.insert_address').die().live("click",function() { 
		var addr=$(this).text();
		var addr_id=$(this).attr('addressid');
		$('textarea[name="customer_address"]').val(addr);
		$('input[name="customer_address_id"]').val(addr_id);
		$("#myModal1").hide();
		var customer_id=$('select[name="customer_id"] option:selected').val();
		var url="<?php echo $this->Url->build(['controller'=>'CustomerAddresses','action'=>'adddefaultAddress']); ?>";
		url=url+'/'+customer_id+'/'+addr_id,
		$.ajax({
			url: url,
		}).done(function(response) { 
		});
    });
	///
	$('.customer_id').on("change",function() {
		var customer_id=$('select[name="customer_id"] option:selected').val();
		
		var url="<?php echo $this->Url->build(['controller'=>'Customers','action'=>'defaultAddress']); ?>";
		url=url+'/'+customer_id,
		
		$.ajax({
			url: url,
		}).done(function(response) { 
			if(response == ' '){
				$('#address').modal({ keyboard: false, backdrop: 'static'}).show();
				var validator = $( "#myForm1" ).validate();
			$('#form1')[0].reset();
			$("label.error").hide();
			$(".error").removeClass("error");
			validator.reset();
			}else{	
				$('textarea[name="customer_address"]').val(response);
			}
		});
	});
});
</script>
<table id="sample_table" style="display:none;" >
			<tbody>
				<tr class="main_tr" class="tab">
					<td align="center" width="1px"></td>
				    <td>
						<?php echo $this->Form->input('item_id', ['empty'=>'--Select-','options'=>$items,'label' => false,'class' => 'form-control input-sm attribute']); ?>
						<span class="msg_shw" style="color:blue;font-size:12px;"></span>
					</td>
					<td>
						<?php echo $this->Form->input('show_quantity', ['label' => false,'class' => 'form-control input-sm number cal_amount quant','placeholder'=>'Quantity','value'=>0]); ?>
						
						<span class="msg_shw2" style="color:blue;font-size:12px;"></span>
							<?php echo $this->Form->input('quantity', ['label' => false,'class' => 'form-control input-sm number mains','value'=>0, 'type'=>'hidden']); ?>
						
					</td>
					<td>
						<?php echo $this->Form->input('rate', ['label' => false,'class' => 'form-control input-sm number cal_amount rat_value','placeholder'=>'Rate','value'=>0]); ?>	
					</td>
					<td>
						<?php echo $this->Form->input('amount', ['label' => false,'class' => 'form-control input-sm number cal_amount','placeholder'=>'Amount','readonly','value'=>0]); ?>	
					</td>
					<td>
						<?php echo $this->Form->input('is_combo', ['label' => false,'class' => 'form-control input-sm is_combo','type'=>'hidden']); ?>	
					</td>
                    <td>
						<a class="btn btn-default delete-tr input-sm" href="#" role="button" ><i class="fa fa-times"></i></a>
					</td>
				</tr>
			</tbody>
		</table>
<div id="myModal1" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="false" style="display: ; padding-right: 12px;"><div class="modal-backdrop fade in" ></div>
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-body" id="result_ajax">
				
			</div>
			 <div class="modal-footer">
				<button class="btn default closebtn">Close</button>
			</div>
		</div>
	</div>
</div>
