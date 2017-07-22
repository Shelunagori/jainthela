<div class="portlet light bordered">
	<div class="portlet-title">
		<div class="caption">
			<i class="icon-globe font-blue-steel"></i>
			<span class="caption-subject font-blue-steel uppercase">Item Wise Sales Report</span>
		</div>
		<div class="portlet-body form">
			<form method="GET" >
				<table width="50%" class="table table-condensed">
					<tbody>
						<tr>
							<td width="2%">
							<?php if(!empty($from_date)){ ?>
								<input type="text" name="From" class="form-control input-sm date-picker" placeholder="Transaction From" value="<?php echo @date('d-m-Y', strtotime($from_date));  ?>"  data-date-format="dd-mm-yyyy">
							<?php }else{ ?>
								<input type="text" name="From" class="form-control input-sm date-picker" placeholder="Transaction From" value="<?php echo date('01-m-Y');  ?>"  data-date-format="dd-mm-yyyy">
							<?php } ?>	
							</td>	
							<td width="2%">
							<?php if(!empty($to_date)){ ?>
								<input type="text" name="To" class="form-control input-sm date-picker" placeholder="Transaction To" value="<?php echo @date('d-m-Y', strtotime($to_date));  ?>"  data-date-format="dd-mm-yyyy" >
							<?php }else{ ?>
								<input type="text" name="To" class="form-control input-sm date-picker" placeholder="Transaction To" value="<?php echo date('d-m-Y');  ?>"  data-date-format="dd-mm-yyyy" >
							<?php } ?>	
							</td>
							<td width="10%">
								<button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-filter"></i> Filter</button>
							</td>
						</tr>
					</tbody>
				</table>
			</form>
		<!-- BEGIN FORM-->
		<div class="row ">
			<div class="col-md-12">
			<?php $page_no=$this->Paginator->current('Ledgers'); $page_no=($page_no-1)*20; ?>
				<table class="table table-bordered table-striped table-hover">
					<thead>
						<tr>
							<th>Sr.No.</th>
							<th>Item Name</th>
							<th>WalkIn Sale</th>
							<th>Online Sale</th>
							<th>Counter Sale/Bulk Sale</th>
							<th>Total Sale</th>
							<th style="text-align:right;">Amount</th>
						</tr>
					</thead>
					<tbody>
					<?php $amount_total=0;
					foreach ($ItemList as $itemLedger):
					$id=$itemLedger->id;
					
					if(in_array($id , $Itemsexists))
					{
					?>
						<tr>
							<td><?= h(++$page_no) ?></td>
							<td><?= h($itemLedger->name).'('.$itemLedger->alias_name.')' ?></td>
							<?php if(!empty(@$order_offline[$itemLedger->id])){ ?>
							<td>
							<?= $this->Html->link(@$order_offline[$itemLedger->id], ['controller' => 'WalkinSales', 'action' => 'walkinSaleDetails',$itemLedger->id]) ?>
							</td>
							<?php }else{ ?> 
							<td><?php echo $this->Number->format(0,['places'=>2])?></td>
							<?php } ?>
							<?php if(!empty(@$order_online[$itemLedger->id])){ ?>
							<td>
							<?= $this->Html->link(@$order_online[$itemLedger->id], ['controller' => 'WalkinSales', 'action' => 'walkinSaleDetails',$itemLedger->id]) ?>
							</td>
							<?php }else{ ?> 
							<td><?php echo $this->Number->format(0,['places'=>2])?></td>
							<?php } ?>
							<?php if(!empty(@$order_bulk[$itemLedger->id])){ ?>
							<td>
							<?= $this->Html->link(@$order_bulk[$itemLedger->id], ['controller' => 'WalkinSales', 'action' => 'walkinSaleDetails',$itemLedger->id]) ?>
							</td>
							<?php }else{ ?> 
							<td><?php echo $this->Number->format(0,['places'=>2])?></td>
							<?php } ?>
							<td><?php echo $this->Number->format(@$order_online[$itemLedger->id]+@$order_bulk[$itemLedger->id]+@$order_offline[$itemLedger->id],['places'=>2]);?></td>
							<td align="right"><?php echo $this->Number->format(@$order_online_rate[$itemLedger->id]+@$order_bulk_rate[$itemLedger->id]+@$order_offline_rate[$itemLedger->id],['places'=>2]);
							$amount_total+=@$order_online_rate[$itemLedger->id]+@$order_bulk_rate[$itemLedger->id]+@$order_offline_rate[$itemLedger->id]?></td>
						</tr>
						
					<?php
					}
						endforeach;?>
					<tr>
						<td align="right" colspan="6"><b>Total</b></td>
						<td align="right"><b><?php echo $this->Number->format($amount_total,['places'=>2]); ?></b></td>
					<tr>	
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>