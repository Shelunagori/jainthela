<?php 

	$date= date("d-m-Y"); 
	$time=date('h:i:a',time());

	$filename="Invoice_report_".$date.'_'.$time;
	$from_date=date('d-m-Y',strtotime($from_date));
	$to_date=date('d-m-Y',strtotime($to_date));
	
	 header ("Expires: 0");
	header ("Last-Modified: " . gmdate("D,d M YH:i:s") . " GMT");
	header ("Cache-Control: no-cache, must-revalidate");
	header ("Pragma: no-cache");
	header ("Content-type: application/vnd.ms-excel");
	header ("Content-Disposition: attachment; filename=".$filename.".xls");
	header ("Content-Description: Generated Report" ); 

?>		
				<table border="1">
				<tbody>
						<tr>
							<td width="2%">
								<?php echo $this->Form->input('warehouse', ['empty'=>'--Warehouses--','options' => $Warehouses,'label' => false,'class' => 'form-control input-sm select2me','placeholder'=>'Category','value'=> h(@$warehouse_id) ]); ?>
							</td>
							<td width="2%">
								<?php echo $this->Form->input('drivers', ['empty'=>'--Drivers--','options' => $Drivers,'label' => false,'class' => 'form-control input-sm select2me','placeholder'=>'Category','value'=> h(@$drivers_id) ]); ?>
							</td>
							<td width="2%">
								<?php echo $this->Form->input('type', ['empty'=>'--Type--','options' => $types,'label' => false,'class' => 'form-control input-sm select2me','placeholder'=>'Type','value'=> h(@$type) ]); ?>
							</td>
							<td width="5%">
							<?php if(!empty($from_date)){ ?>
								<input type="text" name="From" class="form-control input-sm date-picker" placeholder="Transaction From" value="<?php echo @date('d-m-Y', strtotime($from_date));  ?>"  data-date-format="dd-mm-yyyy">
							<?php }else{ ?>
								<input type="text" name="From" class="form-control input-sm date-picker" placeholder="Transaction From" value="<?php echo @date('d-m-Y');  ?>"  data-date-format="dd-mm-yyyy">
							<?php } ?>	
							</td>	
							<td width="5%">
							<?php if(!empty($to_date)){ ?>
								<input type="text" name="To" class="form-control input-sm date-picker" placeholder="Transaction To" value="<?php echo @date('d-m-Y', strtotime($to_date));  ?>"  data-date-format="dd-mm-yyyy" >
							<?php }else{ ?>
								<input type="text" name="To" class="form-control input-sm date-picker" placeholder="Transaction To" value="<?php echo @date('d-m-Y');  ?>"  data-date-format="dd-mm-yyyy" >
							<?php } ?>	
							</td>
							<td width="10%">
								<button type="submit" class="btn btn-success btn-sm"><i class="fa fa-filter"></i> Filter</button>
							</td>
							<td width="2%" align="right">
								<input type="text" class="form-control input-sm pull-right" placeholder="Search..." id="search3"  style="width: 200px;">
							</td>
						</tr>
					</tbody>
				</table>
				</form>
				<table class="table table-condensed table-hover table-bordered" id="main_tble">
					<thead>
						<tr> 
							<th>Sr</th>
							<th style="text-align:center;">Warehouse</th>
							<th style="text-align:center;">Driver</th>
							<th style="text-align:center;">Order No.</th>
							<th style="text-align:center;">Transaction Date</th>
							<th style="text-align:center;">Type</th>
							<th style="text-align:right;">Amount</th>
						</tr>
					</thead>
					<tbody>
						<?php $amount_total=0; $i=0;
							if(@$type=='Walkin'){
								foreach ($walkinSales as $walkinSale){ ?>
						<tr>
							<td>
								<?= h(++$i) ?>
							</td>
							<td align="center">
								<?php if(!empty(h(@$walkinSale->warehouse_id))){echo @$walkinSale->warehouse->name ;} else { echo "-"; }?>
							</td>
							<td align="center">
								<?php if(!empty(h(@$walkinSale->driver_id))){echo @$walkinSale->driver->name ;} else { echo "-"; }?>
							</td>
							<td align="center">
								<a class="view_walk" order_id="<?php echo @$walkinSale->id; ?>" ><?= h(@$walkinSale->order_no) ?></a>
							</td>
							<td align="center">
								<?= h(@$walkinSale->created_on) ?>
							</td>
							<td align="center">Walkin</td>
							<td align="right">
								<?= $this->Number->precision(@$walkinSale->total_amount,2); 
								$amount_total+=$walkinSale->total_amount;?>
							</td>
						</tr>
						<?php }}else if(@$type == 'Online'){
							 $i=$i; foreach($Orders as $order){ ?>
							<tr>
								<td>
									<?= h(++$i) ?>
								</td>
								<td align="center">
									<?php if(!empty(h(@$order->warehouse_id))){echo $order->warehouse->name ;} else { echo "-"; }?>
								</td>
								<td align="center">
									<?php if(!empty(h(@$order->driver_id))){echo $order->driver->name ;} else { echo "-"; }?>
								</td>
								<td align="center">
									<?php echo $this->Html->link($order->order_no,['controller'=>'Orders','action' => 'view', $order->id, 'print'],['target'=>'_blank']); ?>
						
								</td>
								<td align="center">
									<?= h(@$order->order_date) ?>
								</td>
								<td align="center">
									<?php if(@$order->order_type == 'Wallet' || @$order->order_type == 'Cod' || @$order->order_type == 'Online' || @$order->order_type == 'Offline' ){
										echo "Online";
									}?>
								</td>
								<td align="right">
									<?= $this->Number->precision($order->grand_total,2); 
									$amount_total+=$order->grand_total;?>
								</td>
							</tr>
							<?php }}
							 else if($type == 'Bulkorder'){
								$i=$i; foreach($Orders as $order){ ?>
								<tr>
									<td>
										<?= h(++$i) ?>
									</td>
									<td align="center">
										<?php if(!empty(h(@$order->warehouse_id))){echo $order->warehouse->name ;} else { echo "-"; }?>
									</td>
									<td align="center">
										<?php if(!empty(h(@$order->driver_id))){echo $order->driver->name ;} else { echo "-"; }?>
									</td>
									<td align="center">
										<?php echo $this->Html->link($order->order_no,['controller'=>'Orders','action' => 'view', $order->id, 'print'],['target'=>'_blank']); ?>
									</td>
									<td align="center">
										<?= h(@$order->order_date) ?>
									</td>
									<td align="center">
										<?php if(@$order->order_type == 'Wallet' || @$order->order_type == 'Cod' || @$order->order_type == 'Online' || @$order->order_type == 'Offline' ){
											echo "Online";
										}else {
											echo "BulkOrder";
										}?>
									</td>
									<td align="right">
										<?= $this->Number->precision($order->grand_total,2); 
										$amount_total+=$order->grand_total;?>
									</td>
								</tr>
							 <?php }}
									else{
										foreach ($walkinSales as $walkinSale){ ?>
									<tr>
										<td><?= h(++$i) ?></td>
										<td align="center"><?php if(!empty(h(@$walkinSale->warehouse_id))){echo @$walkinSale->warehouse->name ;} else { echo "-"; }?></td>
										<td align="center"><?php if(!empty(h(@$walkinSale->driver_id))){echo @$walkinSale->driver->name ;} else { echo "-"; }?></td>
										
										<td align="center">
											<a class="view_walk" order_id="<?php echo @$walkinSale->id; ?>" ><?= h(@$walkinSale->order_no) ?></a>
										</td>
										<td align="center"><?= h(@$walkinSale->created_on) ?></td>
										<td align="center">Walkin</td>
										<td align="right"><?= $this->Number->precision(@$walkinSale->total_amount,2); 
										$amount_total+=$walkinSale->total_amount;
										?></td>
									</tr>
									 <?php }
									foreach($Orders as $order){ ?>
									<tr>
										<td><?= h(++$i) ?></td>
										<td align="center"><?php if(!empty(h(@$order->warehouse_id))){echo $order->warehouse->name ;} else { echo "-"; }?></td>
										<td align="center"><?php if(!empty(h(@$order->driver_id))){echo $order->driver->name ;} else { echo "-"; }?></td>
										<td align="center">
											<?php echo $this->Html->link($order->order_no,['controller'=>'Orders','action' => 'view', $order->id, 'print'],['target'=>'_blank']); ?>
										</td>
										<td align="center"><?= h(@$order->order_date) ?></td>
										<td align="center">
										<?php if(@$order->order_type == 'Wallet' || @$order->order_type == 'Cod' || @$order->order_type == 'Online' || @$order->order_type == 'Offline' ){
											echo "Online";
										}else {
											echo "BulkOrder";
										}?>
										</td>
										<td align="right"><?= $this->Number->precision($order->grand_total,2); 
										$amount_total+=$order->grand_total;
										?></td>
									</tr><?php }} ?>
									<tr>
										<td align="right" colspan="6"><b>Total</b></td>
										<td align="right"><b><?php echo $this->Number->format($amount_total,['places'=>2]); ?></b></td>
									<tr>
								</tbody>
							</table>
				
