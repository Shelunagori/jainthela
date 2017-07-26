<div style="">
	<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
		<table class=" table-striped table-condensed table-hover  scroll" width="100%" border="0">
			<thead>
				<tr style="background-color:#fff; color:#000;">
					<td align="left" colspan="5">
						<b>
							<?php 
								$order_id=$order->id;
								$order_no=$order->order_no;
								$customer_name=$order->customer->name;
								$customer_mobile=$order->customer->mobile;
								$order_date=date('d-m-Y h:i a', strtotime($order->order_date));
							?>								
							Deliver Order of Customer: <?= h($customer_name.' ('.$customer_mobile.')') ?>
						</b>
					</td>
				</tr>
				</thead>
				<tbody>
					<tr>
						<td>
							<div class="portlet-body">
							Do you want to confirm Deliver Order No.: <?= h(@$order_no) ?>
						<br/><br/>
						<div align="right" >
							<a class="btn blue btn-xs get_order" order_id="<?php echo $order_id; ?>" ><i class="fa fa-shopping-cart"></i> Deliver</a>
						</div>
					</div>
				</td>
			</tr>
				</tbody>
		</table>
</div>