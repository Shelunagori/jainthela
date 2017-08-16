<?php
foreach($order_details as $order_details){
	 ?>
	
	<div class="modal fade" id="delete<?= $order_id ?>" tabindex="-1" aria-hidden="true" style="padding-top:35px">
			<div class="modal-dialog modal-md">
				<div class="modal-content">
					<div class="modal-header">
						<span class="modal-title" style="font-size:14px; text-align:center">
							Details of Order No: 
						</span>
					</div>
					<div class="modal-footer">
						<div class="portlet-body">
							<?= $this->Form->create($order,['id'=>'form_sample_3']) ?>
							<div class="row">
								<div class="col-md-12">
									<label class="control-label col-md-3">Enter Your Reason <span class="required" aria-required="true">*</span></label>
									<?php echo $this->Form->control('reason',['required','rows'=>'1','type'=>'textarea','placeholder'=>'Enter Reason...','class'=>'form-control input-sm','label'=>false]); ?>
					<?php echo $this->Form->control('lead_id',['required','type'=>'hidden','class'=>'form-control input-sm','label'=>false, 'value'=>$order->id]); ?>
								</div>
							</div>
							<br/>
							<?= $this->Form->button($this->Html->tag('i', '', ['class'=>'']) . __('Close'),['class'=>'btn btn-danger','data-dismiss'=>'modal']); ?>
							<?= $this->Form->button($this->Html->tag('i', '', ['class'=>'']) . __(' Submit'),['class'=>'btn btn-success']); ?>
							<?= $this->Form->end() ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	
	
	
	
	
<?php } ?>


