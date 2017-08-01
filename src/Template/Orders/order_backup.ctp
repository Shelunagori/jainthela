<style>
.table > thead > tr > th, .table > tbody > tr > th, .table > tfoot > tr > th, .table > thead > tr > td, .table > tbody > tr > td, .table > tfoot > tr > td{
	vertical-align: top !important;
}
.error{
	color:#a94442;
}
</style>
<div class="row"><div class="col-md-1"></div>
	<div class="col-md-10">
		<div class="portlet light bordered">
			<div class="portlet-title">
				<div class="caption">
					<i class="font-purple-intense"></i>
					<span class="caption-subject font-purple-intense "><i class="fa fa-plus"></i> Create Order </span>
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
					?>
				<div class="row">
					<div class="col-md-3">
						<label class=" control-label">Customer <span class="required" aria-required="true">*</span></label>
						<?php echo $this->Form->control('customer_id',['empty'=>'--Select Customer--','options' => $customers,'class'=>'form-control input-sm select2me customer_id','id'=>'customer_id','label'=>false]); ?>
					</div>
					<div class="col-md-3">
						<label class="control-label">Order Date <span class="required" aria-require>*</span></label>
						<?php echo $this->Form->control('order_date1',['placeholder'=>'dd-mm-yyyy','class'=>'form-control input-sm date-picker','data-date-format'=>'dd-mm-yyyy','label'=>false,'type'=>'text','value'=>date('d-m-Y')]); ?>
					</div>
					
				<!--<?php if(!empty($bulkorder_id)){ ?>
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
					<div class="col-md-6">
						<label class="control-label">Address</label>
							<?php echo $this->Form->input('customer_address_id', ['type'=>'hidden','label' => false,'class' => 'form-control','placeholder' => 'Address']); ?>
							<?php echo $this->Form->input('customer_address', ['label' => false,'class' => 'form-control','placeholder' => 'Address','rows'=>'5','cols'=>'5']); ?>
							<a href="#" role="button" class="pull-left add_address"  >
							 Add Address </a>
							<a href="#" role="button" class="pull-right select_address" >
							Select Address </a>
					</div>
					<div class="col-md-6" align="center">
						<?php if(!empty($bulkorder_id)){ ?>
						<?php echo $this->Html->image('/img/bulkbookingimages/'.$bulk_image.'', ['height' => '200px','width' => '320px']); ?>
						<?php } ?>
					</div>
				</div>
				<div class="col-md-12"><br/></div>
				<div class="row">
					
					<div class="col-md-12">
						<table id="main_table" class="table table-condensed table-bordered" width="100%">
							<thead>
								<tr align="center">
									<td width="3%">
										<label>Sr<label>
									</td>
									<td width="25%">
										<label>item<label>
									</td>
									<td width="10%">
										<label>Quantity<label>
									</td>
									<td width="10%">
										<label>Rate<label>
									</td>
									<td width="10%">
										<label>Amount<label>
									</td>
									<td width="10%">
										<label>CGST Rate</label>
									</td>
									<td width="10%">
										<label>CGST Amount</label>
									</td>
									<td width="10%">
										<label>SGST Rate</label>
									</td>
									<td width="10%">
										<label>SGST Amount</label>
									</td>
									<td>
										<label></label>
									</td>
								</tr>
							</thead>
							<tbody id='main_tbody' class="tab">
								
							</tbody>
							<tfoot>
								<tr>
									<td colspan="7" style="text-align:right;">
									<a class="btn btn-default input-sm add_row" href="#" role="button"  style="float: left;"><i class="fa fa-plus"></i> Add Row</a>
									Grand Total</td>
									<td colspan="2">
									<?php echo $this->Form->input('total_amount', ['label' => false,'class' => 'form-control input-sm number cal_amount','placeholder'=>'Total Amount','type'=>'text','readonly']); ?>
									</td>
									<td></td>
								</tr>
								<tr>
									<td colspan="7" style="text-align:right;">
									 Total CGST</td>
									<td colspan="2">
									<?php echo $this->Form->input('total_cgst_amount', ['label' => false,'class' => 'form-control input-sm number cal_amount','placeholder'=>'Total CGST','type'=>'text','readonly']); ?>
									</td>
									<td></td>
								</tr>
								<tr>
									<td colspan="7" style="text-align:right;">
									 Total RGST</td>
									<td colspan="2">
									<?php echo $this->Form->input('total_sgst_amount', ['label' => false,'class' => 'form-control input-sm number cal_amount','placeholder'=>'Total RGST','type'=>'text','readonly']); ?>
									</td>
									<td></td>
								</tr>
								<tr>
									<td colspan="7" style="text-align:right;">
									Amount From Wallet
									</td>
									<td colspan="2">
									<?php echo $this->Form->control('amount_from_wallet',['placeholder'=>'Amount From Wallet','class'=>'number form-control input-sm cal_amount','label'=>false,'type'=>'text','value'=>0]); ?>
									</td>
									<td></td>
								</tr>
								<tr>
									<td colspan="7" style="text-align:right;">
									Delivery Charge
									</td>
									<td colspan="2">
									<?php echo $this->Form->control('delivery_charge',['placeholder'=>'Amount From Wallet','class'=>'number form-control input-sm cal_amount dlvry','label'=>false,'type'=>'text','value'=>0,'readonly']); ?>
									</td>
									<td></td>
								</tr>
								
								<tr>
									<td colspan="7" style="text-align:right;">
									Paid Amount
									</td>
									<td colspan="2">
									<?php echo $this->Form->input('pay_amount', ['label' => false,'class' => 'form-control input-sm number cal_amount','placeholder'=>'Total Amount','type'=>'text','readonly']); ?>
									</td>
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
<div class="col-md-1"></div>
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
			$(this).find("td:nth-child(3) input").attr({name:"order_details["+i+"][show_quantity]", id:"order_details-"+i+"-show_quantity"}).rules('add', {
						required: true
					});
			$(this).find(".mains").attr({name:"order_details["+i+"][quantity]", id:"order_details-"+i+"-quantity"}).rules('add', {
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
	<?php
	if($order_type=='Bulkorder')
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
					}	
				});	
		});
	<?php
	}
	?>
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
		if($('input[name=discount_percent]').val())
		{
		var discount_percent=parseFloat($('input[name=discount_percent]').val());
		var discount_amount=total_amount*(discount_percent/100);
		total_amount-=discount_amount;
		}
		if(total_amount<100){
			$('input[name=delivery_charge]').val(100);
		}else{
			$('input[name=delivery_charge]').val(0);
		}
		var amount_from_wallet=parseFloat($('input[name=amount_from_wallet]').val());
		var delivery_charge=parseFloat($('input[name=delivery_charge]').val());
		
		var grand_total=total_amount-amount_from_wallet+delivery_charge;
		$('input[name=total_amount]').val(total_amount);
		$('input[name=pay_amount]').val(grand_total);
		
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
		$(this).closest('tr').find('.mains').val(g_total);
	});
	
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
	$("#delivery_id").die().live('change',function(){
		var raw_time_name = $('option:selected', this).text();
		$('#del_time').val(raw_time_name);
		//$(this).closest('tr').find('.quant').attr('max', +raw_attr_minimum_quantity_purchase);
	});
	///default Address
	$('.closebtn').live("click",function() { 
		$(".modal").hide();
    });
	
	$('.select_address').on("click",function() { 
		open_address();
    });
	
	$('.add_address').on("click",function() {
			var customer_id=$('select[name="customer_id"]').val();
			if(customer_id == ""){
				alert("Please Select Customer First");
			}else{
				$('#address').modal('show');
				var validator = $( "#myForm1" ).validate();
				//$('#form1')[0].reset();
				$("label.error").hide();
				$(".error").removeClass("error");
			}
			
			//validator.reset();
			
	});
	
	$('.btnsubmit').on("click",function(e) {
		$("#form1").validate({ 
			submitHandler: function(form) {
					$("#form1").submit(function(e) {
						e.preventDefault();
					});
					var customer_id=$('select[name="customer_id"]').val();
					if(customer_id == ""){
						alert("Please Select Customer First");
					}
					var name=$('input[name="name"]').val();
					var mobile=$('input[name="mobile"]').val();
					var house_no=$('input[name="house_no"]').val();
					var address=$('textarea[name="address"]').val();
					var locality=$('input[name="locality"]').val();
					var default_address=$('input[name="default_address"]:checked').val();
					var url="<?php echo $this->Url->build(['controller'=>'CustomerAddresses','action'=>'saveAddress']); ?>";
					url=url+'/'+customer_id+'/'+name+'/'+mobile+'/'+house_no+'/'+address+'/'+locality+'/'+default_address,
					$.ajax({
						url: url,
					}).done(function(response) {
						$('#address').hide();
						var customer_id=$('select[name="customer_id"] option:selected').val();
						var url="<?php echo $this->Url->build(['controller'=>'Customers','action'=>'defaultAddress']); ?>";
						url=url+'/'+customer_id,	
						$.ajax({
							url: url,
						}).done(function(response) { 
							$('textarea[name="customer_address"]').val(response);
							$('#address').modal('toggle');
							$('#address input').val('');
							$('#address textarea').val('');
						});
					});
		}});		
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
						<?php echo $this->Form->input('cgst_rate', ['label' => false,'class' => 'form-control input-sm number cal_amount cgst_rate','placeholder'=>'Rate','value'=>0]); ?>	
					</td><td>
						<?php echo $this->Form->input('cgst_amount', ['label' => false,'class' => 'form-control input-sm number cal_cgstamount','placeholder'=>'Amount','readonly','value'=>0]); ?>	
					</td><td>
						<?php echo $this->Form->input('sgst_rate', ['label' => false,'class' => 'form-control input-sm number cal_amount sgst_rate','placeholder'=>'Rate','value'=>0]); ?>	
					</td><td>
						<?php echo $this->Form->input('sgst_amount', ['label' => false,'class' => 'form-control input-sm number cal_sgstamount','placeholder'=>'Amount','readonly','value'=>0]); ?>	
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
<!-----Address-->
<div class="modal fade" id="address" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Add Address</h4>
			</div><form id="form1">
			<div class="modal-body">
				<div class="row">
					<div class="col-md-6">
						<label class=" control-label">Name<span class="required" aria-required="true">*</span></label>
						<?php echo $this->Form->input('name',['placeholder'=>'Name','class'=>'form-control input-sm','label'=>false,'required']); ?>
					</div>
					<div class="col-md-6">
					<label class=" control-label">Mobile <span class="required" aria-required="true">*</span></label>
						<?php echo $this->Form->input('mobile',['placeholder'=>'Mobile','class'=>'form-control input-sm','label'=>false,'required']); ?>
					</div>
				</div>
				<div class="row">
					<div class="col-md-6">
						<label class=" control-label">House no <span class="required" aria-required="true">*</span></label>
						<?php echo $this->Form->input('house_no',['placeholder'=>'House no','class'=>'form-control input-sm','label'=>false,'required']); ?>
					</div>
					<div class="col-md-6">
						<label class=" control-label">Locality<span class="required" aria-required="true">*</span></label>
						<?php echo $this->Form->input('locality',['placeholder'=>'locality','class'=>'form-control input-sm','label'=>false,'required']); ?>
					</div>
				</div>
				
				<div class="row">
					<div class="col-md-12">
						<label class=" control-label">Address<span class="required" aria-required="true">*</span></label>
						<?php echo $this->Form->input('address',['placeholder'=>'Address','class'=>'form-control input-sm','label'=>false,'cols'=>1,'required']); ?>
					</div>
					
				</div>
				
				
			
			</div>
			<div class="modal-footer">
				<button type="button" class="btn default" data-dismiss="modal">Close</button>
				<button type="submit" class="btn btn-success btnsubmit">Save changes</button>
			</div>
			</form>
		</div>
	</div>
</div>

