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
					<div class="col-md-4">
						<label class=" control-label">Customer <span class="required" aria-required="true">*</span></label>
						<?php echo $this->Form->control('customer_id',['empty'=>'--Select Customer--','options' => $customers,'class'=>'form-control input-sm select2me','id'=>'customer_id','label'=>false]); ?>
					</div>
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
				</div><br/>
				
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
									<td></td>
								</tr>
							</thead>
							<tbody id='main_tbody' class="tab">
								
							</tbody>
							<tfoot>
								<tr>
									<td colspan="4" style="text-align:right;">
									<a class="btn btn-default input-sm add_row" href="#" role="button"  style="float: left;"><i class="fa fa-plus"></i> Add Row</a>
									Amount From Wallet</td>
									<td>
									<?php echo $this->Form->control('amount_from_wallet',['placeholder'=>'Amount From Wallet','class'=>'form-control input-sm cal_amount','label'=>false,'type'=>'text','value'=>0]); ?>
									</td>
									<td></td>
								</tr>
								<tr>
								<td colspan="4" style="text-align:right;">
								Grand Total
								</td>
								<td>
								<?php echo $this->Form->input('total_amount', ['label' => false,'class' => 'form-control input-sm number cal_amount','placeholder'=>'Total Amount','type'=>'text','readonly']); ?>
								</td>
								<td></td>
								</tr>
							</tfoot>
						</table>
					</div>
					<div class="col-md-4">
						<?php if(!empty($bulkorder_id)){ ?>
						<?php echo $this->Html->image('/img/bulkbookingimages/'.$bulk_image.'', ['height' => '200px','width' => '320px']); ?>
						<?php } ?>
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
		var amount_from_wallet=parseFloat($('input[name=amount_from_wallet]').val());
		var grand_total=total_amount-amount_from_wallet;
		$('input[name=total_amount]').val(grand_total);
	});
	
		$(".attribute").die().live('change',function(){
		var raw_attr_name = $('option:selected', this).attr('print_quantity');
		var raw_attr_rates = $('option:selected', this).attr('rates');
		$(this).closest('tr').find('.msg_shw').html("per quantity in "+raw_attr_name);
		$(this).closest('tr').find('.rat_value').val(raw_attr_rates);
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
						<?php echo $this->Form->input('quantity', ['label' => false,'class' => 'form-control input-sm number cal_amount','placeholder'=>'Quantity','value'=>0]); ?>
						<span class="msg_shw" style="color:blue;font-size:12px;"></span>
					</td>
					<td>
						<?php echo $this->Form->input('rate', ['label' => false,'class' => 'form-control input-sm number cal_amount rat_value','placeholder'=>'Rate','value'=>0]); ?>	
					</td>
					<td>
						<?php echo $this->Form->input('amount', ['label' => false,'class' => 'form-control input-sm number cal_amount','placeholder'=>'Amount','readonly','value'=>0]); ?>	
					</td>
                    <td>
						<a class="btn btn-default delete-tr input-sm" href="#" role="button" ><i class="fa fa-times"></i></a>
					</td>
				</tr>
			</tbody>
		</table>

