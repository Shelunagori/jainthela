<style>
	tfoot {
    display: table-footer-group;
    vertical-align: middle;
    border-color: inherit;
}
label{
	margin-bottom: 1px !important;
}
</style>
<div style="">
	<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
		<table class=" table-striped table-condensed table-hover  scroll" width="100%" border="0">
			<thead>
				<tr style="background-color:#fff; color:#000;">
					<td align="left" class="modal-header" colspan="5">
						<b>
							<?php 
								
								$order_id=$Orders->id;
								$order_no=$Orders->order_no;
								$customer_name=$Orders->customer->name;
								$customer_mobile=$Orders->customer->mobile;
								$order_date=date('d-m-Y h:i a', strtotime($Orders->order_date));
							?>								
							Deliver Order of Customer: <?= h(ucwords($customer_name).' ('.$customer_mobile.')') ?>
						</b>
					</td>
					
				</tr>
				</thead>
				<tbody>
					<tr>
						<td>
							<div class="portlet-body">
							
								<table class="table table-condensed table-bordered" id="main_table">
									
									<thead>
										<tr align="center">
											<td width="12%">
												<label>Sr<label>
											</td>
											<td width="40%">
												<label>Item<label>
											</td>
											<td width="10%">
												<label>Quantity<label>
											</td>
											<td width="20%">
												<label>Actual Quantity<label>
											</td>
											<td width="20%">
												<label>Amount<label>
											</td>
											
										</tr>
									</thead>
									<tbody id='main_tbody' class="tab">
										
										<?php $i=1; $k=0;  
										
										foreach($Orders->order_details as $order_detail){ 
										
											 $minimum_quantity_factor=$order_detail->item->minimum_quantity_factor;
											 $price=$order_detail->rate;
											 $real_amount=$order_detail->amount;
										?>
											<tr class="main_tr tab">
												<td align="center">
													<?= h($i++)?>
												</td>
												<td align="center">
													<?php echo $this->Form->input('order_details['.$k.'][item_id]', ['type'=>'hidden','label' => false,'class' => 'form-control input-sm number item_id','value'=>@$order_detail->item_id]); ?>
													<?= h(@$order_detail->item->name.'('.$order_detail->item->alias_name.')')?>
												</td>
												<td align="center">
													<?php echo $this->Form->input('order_details['.$k.'][quantity]', ['type'=>'hidden','label' => false,'class' => 'form-control input-sm number ','value'=>@$order_detail->quantity]); ?>
													<?= h(@$order_detail->quantity)?>
												</td>
												
												<td align="center">
													<?php echo $this->Form->input('order_details['.$k.'][actual_quantity]', ['label' => false,'class' => 'form-control input-sm number actual_quantity','min'=>1,'value'=>@$order_detail->actual_quantity, 'minimum_quantity_factor'=>$minimum_quantity_factor, 'price' => $price]); ?>
													<label class="error"></label>
												</td>
												
												<td align="center">
													<?php echo $this->Form->input('order_details['.$k.'][amount]', ['label' => false,'class' => 'form-control input-sm number amount','min'=>0.01,'value'=>$real_amount]); ?>
													<label class="error"></label>
												</td>
											</tr>
										<?php $k++; }  ?>	
										
									</tbody>
								</table>		
						
							</div>
						</td>
					</tr>
				</tbody>
				
				<tfoot>
					
					<tr>
						<td align="right">
							<a class="btn blue get_order" id="submits" order_id="<?php echo $order_id; ?>" ><i class="fa fa-shopping-cart"></i> Deliver</a>
						</td>
					</tr>
				</tfoot>	
		</table>
		
</div>