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
										<?= $this->Form->input('warehouse_id',array('options' => $warehouses,'class'=>'form-control input-sm','label'=>false, 'value'=>$transferInventoryVoucher->warehouse_id)) ?>
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
											foreach($transferInventoryVoucherRows as $transferInventoryVoucherRow){
												@$k++;
											
												$trnsfr_quntity=$trnsfr_quntity+$transferInventoryVoucherRow->quantity;
												?>
											<tr class="main_tr" class="tab">
												<td align="center" width="1px"><?= $k ?></td>
												<td>
												<?= $this->Form->input('transfer_inventory_voucher_rows['.$i.'][item_id]',array('options' => $items,'class'=>'form-control input-sm itm_chng','empty' => 'Select','label'=>false, 'value'=>$transferInventoryVoucherRow->item_id)) ?>
												</td>
												<td>
												<?php echo $this->Form->input('transfer_inventory_voucher_rows['.$i.'][quantity]', ['label' => false,'class' => 'form-control input-sm number valid calculation_amount','placeholder'=>'Quantity', 'value'=>$transferInventoryVoucherRow->quantity]); ?>	
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
													<?php echo $this->Form->input('waste_quantity', ['label' => false,'class' => 'remaining form-control input-sm number valid','placeholder'=>'waste Quantity','value'=>$remaining]); ?>	
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
		
    });

	$('.add').click(function(){
			add_row();
	});
		
	 
	
	function add_row(){
			var tr=$("#sample_table tbody tr.main_tr").clone();
			$("#main_table tbody#main_tbody").append(tr); 
			rename_rows();
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
			i++;
		});
	}
	
	$(".calculation_amount").die().live('keyup',function(){
		calculation();
	});

	function calculation(){
		var grand_total = 0;		
		$("#main_table tbody#main_tbody tr.main_tr").each(function(){
			var quantity = parseFloat($(this).find("td:nth-child(3) input").val());
			if(!quantity){ quantity=0; }
			grand_total=grand_total+quantity;
			
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
				$("#set").html(data);
				$('.valid').attr('max',data);
				/* $(update).closest('div').find('#set').html(data);
				$(update).closest('tr').find('.stock_available').html(data);
				$(update).closest('tr').find('.valid').attr('max',data); */
			}
		});	
	});
});

</script>
		<table id="sample_table" style="display:none;" cellpadding="5" cellspacing="5">
			<tbody>
				<tr class="main_tr" class="tab">
					<td align="center" width="1px"></td>
				    <td>
						<?= $this->Form->input('item_id',array('options' => $items,'class'=>'form-control input-sm itm_chng','empty' => 'Select','label'=>false)) ?>
					</td>
					<td>
						<?php echo $this->Form->input('quantity', ['label' => false,'class' => 'form-control input-sm number valid calculation_amount','placeholder'=>'Quantity','value'=>0]); ?>	
					</td>
                    <td>
						<a class="btn btn-default delete-tr input-sm" href="#" role="button" style="margin-bottom: 1px;"><i class="fa fa-times"></i></a>
					</td>
				</tr>
			</tbody>
		</table>
		
		
		
		
		
		<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $transferInventoryVoucher->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $transferInventoryVoucher->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Transfer Inventory Vouchers'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Items'), ['controller' => 'Items', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Item'), ['controller' => 'Items', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Transfer Inventory Voucher Rows'), ['controller' => 'TransferInventoryVoucherRows', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Transfer Inventory Voucher Row'), ['controller' => 'TransferInventoryVoucherRows', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="transferInventoryVouchers form large-9 medium-8 columns content">
    <?= $this->Form->create($transferInventoryVoucher) ?>
    <fieldset>
        <legend><?= __('Edit Transfer Inventory Voucher') ?></legend>
        <?php
            echo $this->Form->control('voucher_no');
            echo $this->Form->control('item_id', ['options' => $items]);
            echo $this->Form->control('quantity');
            echo $this->Form->control('created_on');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
