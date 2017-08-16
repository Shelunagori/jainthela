<div class="portlet light bordered">
	<div class="portlet-title">
		<div class="caption">
			<i class="icon-globe font-blue-steel"></i>
			<span class="caption-subject font-blue-steel ">Bulk Sale For "<?php foreach ($ItemLedgers as $ItemLedger){ echo $ItemLedger->item->name.'('.$ItemLedger->item->alias_name.')'; break; } ?>"</span>
			<br/>
			<span class="caption-subject" align="right" style="margin-left: 406px;"><b> <?php echo date('d-m-Y',strtotime(@$from_date)); ?> To <?php echo  date('d-m-Y',strtotime(@$to_date)); ?></b></span>
		</div>
		<div class="portlet-body">
		
			<div class="row">
				<div class="col-md-12">
				<table class="table table-bordered table-striped table-hover">
					<thead>
						<tr>
							<th>Sr. No.</th>
							<th>Order No</th>
							<th>Quantity</th>
						</tr>
					</thead>
					<tbody>
					<?php if(sizeof($ItemLedgers->toArray())>0){ ?>
						<?php $unit; $total=0; $i=1; foreach($ItemLedgers as $ItemLedger){ ?> 
						<tr>
							<td><?= h($i++) ?></td>
							<td><?= h(@$ItemLedger->order->order_no) ?></td>
							<td><?= h(@$ItemLedger->quantity).$ItemLedger->item->unit->unit_name;
							@$total+=@$ItemLedger->quantity; 
							@$unit = @$ItemLedger->item->unit->unit_name;?></td>
						</tr>
						<?php } ?>
						<tr>
							<td colspan="2" align="right"><b>Total</b></td>
							<td><b><?php  echo $this->Number->format(@$total).@$unit ?></b></td>
						</tr>
					</tbody>
					<?php }else{ ?>
					<tbody>
					<tr>
							<td colspan="3">No Data Found</td>
					</tr>		
					</tbody>
					<?php  } ?>
				</table>
				
				</div>
			</div>
		</div>
	</div>
</div>

