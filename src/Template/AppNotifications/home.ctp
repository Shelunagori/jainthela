<div class="row">
		<div class="col-md-12">
			<div class="portlet">
		<div class="portlet-body"> 
			<?= $this->Form->create($appNotification,['type' => 'file','id'=>'form_sample_3']) ?>
				<div class="portlet light bordered">
					<div class="portlet-title">
						<div class="caption">
							<span>
							<?php
							
							if($page=="home")
								{
								echo "<h3><B>Send Push Notifications </B></h3>";
								}
								if($page=="bulkbooking")
								{
								echo "<h3><B>Bulk Booking Notifications to Customers </B></h3>";}
								if($page=="referfriend")
								{
								echo "<h3><B>Refer a Friend Notifications to Customers </B></h3>";}
								if($page=="addmoney")
								{
								echo "<h3><B>Add Money Notifications to Customers</B></h3>";}
								if($page=="viewcart")
								{
								echo "<h3><B>Cart item Notification to Customers</B></h3>";}
								if($page=="specialoffers")
								{
								echo "<h3><B>Special Offers Notification </B></h3>";}
							?>
							</span>
						</div>
					</div>
					<div class="portlet-body form">
					<!-- BEGIN FORM-->
							<div class="row">
								
								
								 <div class="col-md-12">
									<div class="form-group">
										<label class="col-md-6 control-label">Message <span class="required" 	aria-required="true">*</span></label>
										 <?= $this->Form->input('message',['class'=>'form-control input-sm','id'=>'msg','label'=>false,'placeholder'=>'','rows'=>'3','style'=>'resize: none;']) ?>
									</div>	 
								</div>
								 <br></div><br><br>
								 <div class="row">
									<div class="col-md-4">
										<div class="form-group">
											<label class="control-label">Image <span class="required" aria-required="true">*</span></label>
											<?php echo $this->Form->input('image', ['type' => 'file','label' => false]);?>
										</div>
									</div>
								</div>
						<!-- END FORM-->
					 
						<div align="center">
						<a class="btn red btn-md" id="notify" rel="tooltip" title="Delete"  data-toggle="modal" href="#delete1"><i class="fa fa-plus">  Send</i></a>
							<div class="modal fade" id="delete1" tabindex="-1" aria-hidden="true" style="padding-top:35px">
								<div class="modal-dialog modal-md">
									<div class="modal-content">
										<div class="modal-header">
											<span class="modal-title" style="font-size:14px; text-align:center">Are you sure, you want to Send this Notification?</span>
										</div>
										<div class="modal-footer">
										<div class="portlet-body">
								<div class="row">
									<div class="col-md-12" style="text-align:left; font-size:14px;">
										Message : <span id="showmsg"> </span>
										
									</div>
								</div>
								<br/>				
								<?= $this->Form->button($this->Html->tag('i', '', ['class'=>'']) . __('Close'),['class'=>'btn btn-danger','data-dismiss'=>'modal']); ?>
								<?= $this->Form->button($this->Html->tag('i', '', ['class'=>'fa fa-plus']) . __(' Submit'),['class'=>'btn btn-success','id'=>'submitbtn']); ?>
								<?= $this->Form->end() ?>
							</div>
										</div>
									</div>
								</div>
							</div>
										
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
	$('#notify').on('click',function() {
		var valshow = $('#msg').val();
		$('#showmsg').html(valshow);
	});
});
</script>