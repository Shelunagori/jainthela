<div class="row">
		<div class="col-md-12">
			<div class="portlet">
		<div class="portlet-body"> 
			<?= $this->Form->create($pushNotification,['type' => 'file','id'=>'form_sample_3']) ?>
				<div class="portlet light bordered">
					<div class="portlet-title">
						<div class="caption">
							<span>
							<?php
							
							if($page=="home")
								{
								echo "<h3><B>Home </B></h3>";
								}
								if($page=="bulkbooking")
								{
								echo "<h3><B>Bulk Booking Notifications </B></h3>";}
								if($page=="referfriend")
								{
								echo "<h3><B>Refer a Friend Notifications </B></h3>";}
								if($page=="addmoney")
								{
								echo "<h3><B>Add Money Notifications </B></h3>";}
								if($page=="viewcart")
								{
								echo "<h3><B>View Cart Notifications </B></h3>";}
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
										 <?= $this->Form->input('message',['class'=>'form-control input-sm','label'=>false,'placeholder'=>'','rows'=>'3','style'=>'resize: none;']) ?>
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
							<?= $this->Form->button($this->html->tag('i', '', ['class'=>'fa fa-plus']) . __(' Submit'),['class'=>'btn btn-success','id'=>'submitbtn']); ?>
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
