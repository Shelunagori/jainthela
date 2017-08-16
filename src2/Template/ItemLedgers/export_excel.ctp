<?php 

	$date= date("d-m-Y"); 
	$time=date('h:i:a',time());

	$filename="Item_sale_report_".$date.'_'.$time;

	header ("Expires: 0");
	header ("Last-Modified: " . gmdate("D,d M YH:i:s") . " GMT");
	header ("Cache-Control: no-cache, must-revalidate");
	header ("Pragma: no-cache");
	header ("Content-type: application/vnd.ms-excel");
	header ("Content-Disposition: attachment; filename=".$filename.".xls");
	header ("Content-Description: Generated Report" );

?>		
				<table border="1">
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
					<?php $page_no=1; $amount_total=0;
					foreach ($ItemList as $itemLedger):
					$id=$itemLedger->id;
					$from_dates = date('d-m-Y');
					$to_dates = date('d-m-Y');
					$total_amount = @$order_online_rate[$itemLedger->id]+@$order_bulk_rate[$itemLedger->id]+@$walkins_sales_rate[$itemLedger->id];
					if(in_array($id , $Itemsexists))
					{
						if(@$total_amount != 0){
					?>
						<tr>
							<td><?= h(++$page_no) ?></td>
							<td>
								<?= h($itemLedger->name).'('.$itemLedger->alias_name.')'  ?>
							</td>
							<?php if(!empty(@$walkins_sales[$itemLedger->id])){ ?>
							<td>
								<?php if(!empty($from_date)){ ?>
								<?= $this->Html->link(@$walkins_sales[$itemLedger->id].$units[$itemLedger->id], ['controller' => 'WalkinSales', 'action' => 'walkinSaleDetails',$itemLedger->id,$from_date,$to_date ],array('escape'=>false,'target'=>'_blank')) ?>
								<?php }else{ ?>
								<?= $this->Html->link(@$walkins_sales[$itemLedger->id].$units[$itemLedger->id], ['controller' => 'WalkinSales', 'action' => 'walkinSaleDetails',$itemLedger->id,$from_dates,$to_dates],array('escape'=>false,'target'=>'_blank')) ?>
								<?php } ?>
							</td>
								<?php }else{ ?> 
							<td>
								<?php echo $this->Number->format(0,['places'=>2])?>
							</td>
								<?php } ?>
								<?php if(!empty(@$order_online[$itemLedger->id])){ ?>
							<td>
								<?php if(!empty($from_date)){ ?>
									<?= $this->Html->link(@$order_online[$itemLedger->id].$units[$itemLedger->id], ['controller' => 'Orders', 'action' => 'onlineSaleDetails',$itemLedger->id,$from_date,$to_date],array('escape'=>false,'target'=>'_blank')) ?>
								<?php }else{ ?>
									<?= $this->Html->link(@$order_online[$itemLedger->id].$units[$itemLedger->id], ['controller' => 'Orders', 'action' => 'onlineSaleDetails',$itemLedger->id,$from_dates,$to_dates],array('escape'=>false,'target'=>'_blank')) ?>
								<?php } ?>
							</td>
							<?php }else{ ?> 
							<td>
								<?php echo $this->Number->format(0,['places'=>2])?>
							</td>
								<?php } ?>
								<?php if(!empty(@$order_bulk[$itemLedger->id])){ ?>
							<td>
								<?php if(!empty($from_date)){ ?>
									<?= $this->Html->link(@$order_bulk[$itemLedger->id].$units[$itemLedger->id], ['controller' => 'Orders', 'action' => 'bulkSaleDetails',$itemLedger->id,$from_date,$to_date],array('escape'=>false,'target'=>'_blank')) ?>
								<?php }else{ ?>
									<?= $this->Html->link(@$order_bulk[$itemLedger->id].$units[$itemLedger->id], ['controller' => 'Orders', 'action' => 'bulkSaleDetails',$itemLedger->id,$from_dates,$to_dates],array('escape'=>false,'target'=>'_blank')) ?>
								<?php } ?>
							</td>
								<?php }else{ ?> 
							<td>
								<?php echo $this->Number->format(0,['places'=>2])?>
							</td>
								<?php } ?>
							<td>
								<?php echo $this->Number->format(@$order_online[$itemLedger->id]+@$order_bulk[$itemLedger->id]+@$walkins_sales[$itemLedger->id],['places'=>2]);?>
							</td>
							<td align="right">
								<?php echo $this->Number->format(@$total_amount,['places'=>2]);
								$amount_total+=@$order_online_rate[$itemLedger->id]+@$order_bulk_rate[$itemLedger->id]+@$walkins_sales_rate[$itemLedger->id]?>
							</td>
						</tr>
						
					<?php
					}}
						endforeach;?>
					<tr>
						<td align="right" colspan="6"><b>Total</b></td>
						<td align="right"><b><?php echo $this->Number->format($amount_total,['places'=>2]); ?></b></td>
					<tr>	
					</tbody>
				</table>
				
