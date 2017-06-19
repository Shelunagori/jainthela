<div class="row">
		<div class="col-md-12">
			<div class="portlet">
		<div class="portlet-body"> 
			
				<div class="portlet light bordered">
					<div class="portlet-title">
						<div class="caption">
							<span>
								<B>Customer Detail Report</B>
							</span>
						</div>
					</div>
					<div class="portlet-body form">
					<!-- BEGIN FORM-->
							<div class="row">
								<div class="col-md-12">
									<div class="col-md-4">
										<label class="col-md-6 control-label">Customer <span class="required" 	aria-required="true">*</span></label>
										<?= $this->Form->input('customer_id',array('options' => $Customers,'class'=>'chng form-control input-sm select2me','empty' => 'Select','label'=>false)) ?>
									</div>								
									<div class="col-md-2" style="padding-top:21px;">
										<label class="control-label">&nbsp;</label>
										<?= $this->Form->button($this->Html->tag('i', '', ['class'=>'fa fa-search']) . __(' Go'),['class'=>'btn btn-success go','type'=>'button']); ?>
									</div>								
								 </div>
								 <div class="col-md-12"><br></div>
							</div>
						<!-- END FORM-->
						<div id="data"> </div>						
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
	 
	
	
	$('.go').die().live('click',function() 
	{ 
		$('#data').html('<i style= "margin-top: 20px;" class="fa fa-refresh fa-spin fa-3x fa-fw"></i><b> Loading... </b>');
		var customer = $(this).val();
 		var m_data = new FormData();
		m_data.append('customer_id',customer);
			
		$.ajax({
			url: "<?php echo $this->Url->build(["controller" => "Customers", "action" => "ajax_customer_report"]); ?>",
			data: m_data,
			processData: false,
			contentType: false,
			type: 'POST',
			dataType:'text',
			success: function(data)   // A function to be called if request succeeds
			{
a
				$('#data').html(data);
			}	
		});	
	});
});
</script>