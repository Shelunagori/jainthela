
<div class="col-md-12">
		<div class="col-md-4">
			<label class="col-md-6 control-label">Amount Receivable <span class="required" 	aria-required="true">*</span></label>
			<?php echo $this->Form->input('amount_receivable', ['label' => false,'class' => 'form-control input-sm','placeholder'=>'Amount','value'=>$receivable_amount,'readonly']); ?>
			
		</div>
		<div class="col-md-4">
				<label class="col-md-6 control-label">Amount Received <span class="required" 	aria-required="true">*</span></label>
				<?= $this->Form->input('amount_received',['label' => false,'class' => 'form-control input-sm','placeholder'=>'Amount','value'=>0]); ?> 
		</div>
</div>