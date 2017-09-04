<div class="row">
		<div class="col-md-12">
			<div class="portlet">
		<div class="portlet-body"> 
			<?= $this->Form->create($itemLedger,['id'=>'form_sample_3']) ?>
				<div class="portlet light bordered">
					<div class="portlet-title">
						<div class="caption">
							<i class="font-purple-intense"></i>
							<span class="caption-subject font-purple-intense ">
							<i class="fa fa-book"></i> Stock Return</span>
						</div>
					</div>
					<div class="portlet-body form">
					<!-- BEGIN FORM-->
							<div class="row">
								<div class="col-md-12">
									<div class="col-md-4">
										<label class="col-md-6 control-label">Drivers <span class="required" 	aria-required="true">*</span></label>
										<?= $this->Form->input('driver_id',array('options' => $drivers,'class'=>'chng form-control input-sm select2me driver_id','empty' => 'Select','label'=>false)) ?>
									</div>
									<div class="col-md-4">
											<label class="col-md-6 control-label">Warehouses <span class="required" 	aria-required="true">*</span></label>
											<?= $this->Form->input('warehouse_id',array('options' => $warehouses,'class'=>'form-control input-sm ','label'=>false)) ?>
										</div>
										 
									<div class="col-md-2">
										<label class="control-label">Date <span class="required" aria-require>*</span></label>
										
										<?php echo $this->Form->control('transaction_date',['placeholder'=>'dd-mm-yyyy','class'=>'form-control input-sm date-picker','data-date-format'=>'dd-mm-yyyy','label'=>false,'type'=>'text','value'=>date('d-m-Y')]); ?>
									</div>
									<div class="col-md-2" style="padding-top:17px;">
										<label class="control-label">&nbsp;</label>
										<?= $this->Form->button($this->Html->tag('i', '', ['class'=>'fa fa-search']) . __(' Go'),['class'=>'btn btn-success go','type'=>'button']); ?>
									</div>
									
								 </div>
								 <div class="col-md-12">
									<div id="result_ajax" style="display:none;">
						
									</div>
									
								</div>
								
								<div class="col-md-12">
									</br></br>
								</div>
							</div>
						<!-- END FORM-->
						<div id="data">
						
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
				driver_id:{
					required: true			
				},
				warehouses_id:{
					required: false
				},
				created_on:{
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
	  ///
	 
		
		  $("#main_table tbody#main_tbody tr.main_tr").each(function(){ 
				 var remaning = $(this).find("td:nth-child(3) .remaining").val();
				alert(remaning);
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
	$('.driver_id').on("change",function() {
		var driver_id=$(this).val();
		$("#result_ajax").hide();
		$('#data').hide();
		$("#result_ajax").html('<div align="center"><?php echo $this->Html->image('/img/wait.gif', ['alt' => 'wait']); ?> Loading</div>');
		var url="<?php echo $this->Url->build(['controller'=>'ItemLedgers','action'=>'amount_receivable']); ?>";
		url=url+'/'+driver_id,
		$.ajax({
			url: url,
		}).done(function(response) {
			$("#result_ajax").html(response);
		});
	});
	
	$('.go').die().live('click',function() 
	{ 
		$('#data').html('<i style= "margin-top: 20px;" class="fa fa-refresh fa-spin fa-3x fa-fw"></i><b> Loading... </b>');
		var driver = $("#driver-id").val();
 		var m_data = new FormData();
		m_data.append('driver',driver);
			
		$.ajax({
			url: "<?php echo $this->Url->build(["controller" => "ItemLedgers", "action" => "ajax_stock_return"]); ?>",
			data: m_data,
			processData: false,
			contentType: false,
			type: 'POST',
			dataType:'text',
			success: function(data)   // A function to be called if request succeeds
			{ 
				$("#result_ajax").show();
				$('#data').html(data);
				$('#data').show();
				$("#main_table tbody#main_tbody tr.main_tr").each(function(){ 
				 var remaning = $(this).find("td:nth-child(3) .remaining").val();
				 var quantity = $(this).find("td:nth-child(4) .quantity").val();
				 var wieght  = parseFloat(remaning - quantity);
				 $('.quant').val(parseFloat(wieght.toFixed()));
				 $('.quantity').live('keyup',function(){
					 $("#main_table tbody#main_tbody tr.main_tr").each(function(){ 
					  var quantity = $(this).find("td:nth-child(4) .quantity").val();
					   var remaning = $(this).find("td:nth-child(3) .remaining").val();
					var wieght  = remaning - quantity;
					
					$(this).find("td:nth-child(5) .quant").val(wieght.toFixed(2));
					 });	
				 });	
				
			});
				
			 	
			}	
		});	
	});
	
});
</script>