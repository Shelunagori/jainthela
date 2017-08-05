<style>
.table>thead>tr>th{
	font-size:12px !important;
}
</style>
<div class="row">
	<div class="col-md-12">
	<?= $this->Form->create($itemLedger,['id'=>'form_sample_3']) ?>
	
		<div class="portlet light bordered">
			<div class="portlet-title">
				<div class="caption">
					<i class="icon-globe font-blue-steel"></i>
					<span class="caption-subject font-blue-steel uppercase">Wastage Vouchers
					</span>
				</div>
				<div class="actions">
					<input type="text" class="form-control input-sm pull-right" placeholder="Search..." id="search3" style="width: 200px;">
				</div>
			</div>
			<div class="portlet-body">
				<div class="row">
					<div class="col-md-12">
						<!-- <div class="col-md-2">
							<label class="control-label">Transaction Date <span class="required" aria-require>*</span></label>
						</div> -->
						<div class="col-md-3">	
							<?php echo $this->Form->control('transaction_date',['placeholder'=>'Transaction Date','class'=>'form-control input-sm date-picker','data-date-format'=>'dd-mm-yyyy','label'=>false,'type'=>'text','required']); ?>
							
						</div>
						
					</div>
					<div class="col-md-12"><br/></div>
				</div>		
				<table class="table table-condensed table-hover table-bordered" id="main_table">
					<thead>
						<tr>
							<th>Sr</th>
							<th>Items</th>
							<th>Warehouse Current Stock</th>
							<th>Warehouse Actual/Modified Stock</th>
							<th>Wastage Quantity</th>
						</tr>
					</thead>
					<tbody id="main_tbody">
						<?php $i=0; foreach ($Items as $item): ?>	
						<tr class="main_tr">
							<td><?php echo ++$i; $i--; ?></td>
                            <td>
								<?php
								$item_name=$item->name;
								$alias_name=$item->alias_name;
								?>
								<?= h(@$item_name. ' ('.$alias_name.')') ?>
								
								<?php echo  $this->Form->control('item_ledgers['.$i.'][item_id]',['type'=>'hidden','class'=>'form-control input-sm input-small items', 'value'=>$item->id]); ?>
							</td>
							
							<td align="center">
								<?php if(!empty(@$remainingStock[$item->id])){
									echo @$remainingStock[$item->id].$itemUnit[$item->id];
									 echo  $this->Form->control('item_ledgers['.$i.'][remainingStock]',['class'=>'form-control input-sm remainingStock','value'=>@$remainingStock[$item->id],'label'=>false,'type'=>'hidden']); 
								}else{
									echo "-";
								} ?>
							</td>
							<td>
								<?php echo  $this->Form->control('item_ledgers['.$i.'][itemquantity]',['class'=>'form-control input-sm quantity','max'=>@$remainingStock[$item->id],'label'=>false,'placeholder'=>'Actual Quantity']); ?>
							</td>
							<td>
								<?php echo  $this->Form->control('item_ledgers['.$i.'][quantity]',['class'=>'form-control input-sm wastage','placeholder'=>'Wastage Quantity','label'=>false,'max'=>@$remainingStock[$item->id]]); ?>
							</td>
						</tr>
						<?php $i++; endforeach; ?>
						
						
					</tbody>
				</table>
				<div align="center">
					<?= $this->Form->button($this->Html->tag('i', '', ['class'=>'fa fa-plus']) . __('Wastage Vouchers'),['class'=>'btn btn-success','id'=>'submitbtn']); ?>
				</div>
			</div>
		</div>
		<?= $this->Form->end() ?>
	</div>
</div>
<?php echo $this->Html->script('/assets/global/plugins/jquery.min.js'); ?>

<script>
$(document).ready(function(){
	var form3 = $('#form_sample_3');
	var error3 = $('.alert-danger', form3);
	var success3 = $('.alert-success', form3);
	form3.validate({
		
		errorElement: 'span', //default input error message container
		errorClass: 'help-block help-block-error', // default input error message class
		focusInvalid: true, // do not focus the last invalid input
		rules: {
				
				transaction_date:{
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
	/////
	$('.quantity').die().live('keyup',function(){
		$("#main_table tbody#main_tbody tr.main_tr").each(function(){ 

			var remainingStock = $(this).find("td:nth-child(3) .remainingStock").val();
			var modified_qty = $(this).find("td:nth-child(4) input").val();
			
			if(modified_qty >= remainingStock){ 
				var result = parseInt(0);
				$(this).find("td:nth-child(5) .wastage").val(result);
			}
			else if(!modified_qty == ' ' ){
				var total = remainingStock-modified_qty;
				if(isNaN(total)) {
					total=0;
					$(this).find("td:nth-child(5) .wastage").val(total.toFixed(2));
					alert("These Item not in Stock");
				}else{
					$(this).find("td:nth-child(5) .wastage").val(total.toFixed(2));
				}
			}
		});
	});
	
	$('.wastage').die().live('keyup',function(){
		$("#main_table tbody#main_tbody tr.main_tr").each(function(){ 

			var remainingStock = $(this).find("td:nth-child(3) .remainingStock").val();
			var wastage = $(this).find("td:nth-child(5) input").val();
			if(wastage >= remainingStock){ 
				var result = parseInt(0);
				$(this).find("td:nth-child(4) .quantity").val(result);
			}
			else if(!wastage == ' ' ){
				var total = remainingStock-wastage;
				if(isNaN(total)) {
					total=0;
					$(this).find("td:nth-child(4) .quantity").val(total.toFixed(2));
					alert("These Item not in Stock");
				}else{
					$(this).find("td:nth-child(4) .quantity").val(total.toFixed(2));
				}
			}
			
		
		});
	});
	
	
	
	///
	var $rows = $('#main_table tbody tr');
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
		
});
</script>