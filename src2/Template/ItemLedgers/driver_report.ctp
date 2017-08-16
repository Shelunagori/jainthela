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
							<i class="fa fa-book"></i> Driver Report</span>
						</div>
						
					</div>
					<div class="portlet-body form">
					<!-- BEGIN FORM-->
							<div class="row">
								<div class="col-md-12">
									<div class="col-md-4">
										<label class="col-md-6 control-label">Drivers <span class="required" 	aria-required="true">*</span></label>
										<?= $this->Form->input('driver_id',array('options' => $drivers,'class'=>'chng form-control input-sm select2me','empty' => 'Select','label'=>false)) ?>
									</div>
									<div class="col-md-4">
										<label class="col-md-6 control-label">Warehouses <span class="required" 	aria-required="true">*</span></label>
										<?= $this->Form->input('warehouse_id',array('options' => $warehouses,'class'=>'form-control input-sm ','label'=>false)) ?>
									</div>									
									<div class="col-md-2" style="padding-top:17px;">
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
	
	$('.go').die().live('click',function() 
	{ 
		$('#data').html('<i style= "margin-top: 20px;" class="fa fa-refresh fa-spin fa-3x fa-fw"></i><b> Loading... </b>');
		var driver = $("#driver-id").val();
 		var m_data = new FormData();
		m_data.append('driver',driver);
			
		$.ajax({
			url: "<?php echo $this->Url->build(["controller" => "ItemLedgers", "action" => "ajax_driver_report"]); ?>",
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
});
</script>