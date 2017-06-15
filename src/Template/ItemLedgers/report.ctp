<div class="row">
		<div class="col-md-12">
			<div class="portlet">
		<div class="portlet-body"> 
				<div class="portlet light bordered">
					<div class="portlet-body form">
					<!-- BEGIN FORM-->
							<div class="row">
<<<<<<< HEAD
								<h3 style="text-align:center;">STOCK REPORT</h3>
								<div class="col-md-12">
									<div class="col-md-4">
										<label class="col-md-6 control-label">Drivers <span class="required" 	aria-required="true">*</span></label>
										<?= $this->Form->input('driver_id',array('options' => $drivers,'class'=>'form-control input-sm select2me chng
										','empty' => 'Select','label'=>false)) ?>
									</div>
									<div class="col-md-4">
											<label class="col-md-6 control-label">Warehouses <span class="required" 	aria-required="true">*</span></label>
											<?= $this->Form->input('warehouse_id',array('options' => $warehouses,'class'=>'form-control input-sm select2me','empty' => 'Select','label'=>false)) ?>
										</div>
								 </div>
								 <div class="col-md-12"><br></div>
							</div>
						<!-- END FORM-->
						<div id="data">
=======
								<table id="main_table" class="table table-condensed table-bordered">
		<thead>
			<tr align="center">
				<td width="10%">
					<label>Sr<label>
				</td>
				<td width="40%">
					<label>Item<label>
				</td>
				<td width="20%">
					<label>Current Stock<label>
				</td>
				
			</tr>
		</thead>
		<tbody id='main_tbody' class="tab">
		<?php foreach($itemLedgers as $itemLedger){
				$total_in=$itemLedger->total_in;
				$total_out=$itemLedger->total_out;
				$remaining=$total_in-$total_out;
				@$i++;
			?>
			<tr class="main_tr" class="tab">
				<td align="center" width="1px"><?= $i ?>.</td>
				<td align="center">
					<?= $itemLedger->item->name ?>
				</td>	
				<td align="center">
					<?= $remaining ?>
				</td>
				
			</tr>
			<?php } ?>
		</tbody>
	</table>
>>>>>>> 6bac077441685b2bf29b30bfdaa6e9bafa22529a
						
						</div>
						<div class="row" style="padding-top:5px;">
							<div class="col-md-4"></div>
							<div class="col-md-4"></div>
							<div class="col-md-4"> </div>
						</div>
						 
					</div>
				</div>
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
				franchise_id:{
					required: true,				
				},
				warehouses_id:{
					required: false,
				},
				purchase_inward_voucher_id:{
					required: false,
				},
				created_on:{
					required: false,
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
					$(this).find("td:nth-child(2) select").select2().attr({name:"item_id[]", id:"item_id"}).rules('add', {
								required: true
							}); 
					$(this).find("td:nth-child(3) input").attr({name:"quantity[]", id:"quantity"}).rules('add', {
								required: true
							}); 
					i++;
				});
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
	
<<<<<<< HEAD
	$('.chng').die().live('change',function() 
	{ 
		var driver =$(this).val();
 		var m_data = new FormData();
		
			m_data.append('driver',driver);
			
		$.ajax({
			url: "<?php echo $this->Url->build(["controller" => "ItemLedgers", "action" => "ajax_report"]); ?>",
			data: m_data,
			processData: false,
			contentType: false,
			type: 'POST',
			dataType:'text',
			success: function(data)   // A function to be called if request succeeds
			{
				$('#data').html(data);
			}	
		});
	});
	
=======
>>>>>>> 6bac077441685b2bf29b30bfdaa6e9bafa22529a
});
</script>