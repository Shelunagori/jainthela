<div class="portlet light bordered">
	<div class="portlet-title">
		<div class="caption">
			<i class="icon-globe font-blue-steel"></i>
			
			<span class="caption-subject font-blue-steel ">Walk In Sale "<?php foreach ($walkinSales as $walkinSale){ echo $walkinSale->item->name; break; } ?>"</span>
		</div>
		<div class="portlet-body">
		
		<div class="row">
				<div class="col-md-12">
				<table class="table table-bordered table-striped table-hover">
					<thead>
						<tr>
							<th>Sr. No.</th>
							<th>Supplier Name</th>
							<th>Order No</th>
							<th>Transaction Date</th>
							<th>Quantity</th>
							
						</tr>
					</thead>
					<tbody>
						<?php if(sizeof($walkinSales->toArray())>0){ ?>
						<?php $total=0; $unit; $i=1; foreach($walkinSales as $walkinSale){ ?> 
						<tr>
							<td><?= h($i++) ?></td>
							<?php if(@$walkinSale->walkin_sale->driver_id !=0){ ?>
							<td><?= h(@$walkinSale->walkin_sale->driver->name) ?></td>
							<?php }else if(@$walkinSale->walkin_sale->warehouse_id !=0){ ?>
							<td><?= h(@$walkinSale->walkin_sale->warehouse->name) ?></td>
							<?php }?>
							<td><?= h(@$walkinSale->walkin_sale->order_no) ?></td>
							<td><?= h(@$walkinSale->walkin_sale->transaction_date) ?></td>
							<td><?= h(@$walkinSale->quantity).@$walkinSale->item->unit->unit_name ;
							@$total+=@$walkinSale->quantity;
							@$unit=@$walkinSale->item->unit->unit_name;
							?></td>
							
						</tr>
						<?php } ?>
						<tr>
							<td colspan="4" align="right"><b>Total</b></td>
							<td><b><?php  echo $this->Number->format(@$total).@$unit ?></b></td>
						</tr>
					</tbody>
					<?php }else{ ?>
					<tbody>
					<tr>
							<td colspan="5">No Data Found</td>
					</tr>		
					</tbody>
					<?php  } ?>
				</table>
				
				</div>
			</div>
		</div>
	</div>
</div>