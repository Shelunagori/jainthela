<?php $url_excel="/?".$url; ?>
<div class="portlet light bordered">
	<div class="portlet-title">
		<div class="caption">
			<i class="icon-globe font-blue-steel"></i>
			<span class="caption-subject font-blue-steel uppercase">Item Wise Sales Report</span>
		</div>
		<div class="actions">
			<?php echo $this->Html->link( '<i class="fa fa-file-excel-o"></i> Excel', '/ItemLedgers/Export-Excel/'.@$url_excel.'',['class' =>'btn btn-sm green tooltips pull-right','target'=>'_blank','escape'=>false,'data-original-title'=>'Download as excel']); ?>
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
								<input type="text" name="From" class="form-control input-sm date-picker" placeholder="Transaction From" value="<?php echo date('d-m-Y');  ?>"  data-date-format="dd-mm-yyyy">
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
								<button type="submit" class="btn btn-success btn-sm"><i class="fa fa-filter"></i> Filter</button>
							</td>
							<td width="2%" align="right">
								<input type="text" class="form-control input-sm pull-right" placeholder="Search..." id="search3"  style="width: 200px;">
							</td>
						</tr>
					</tbody>
				</table>
			</form>
		<!-- BEGIN FORM-->
		<div class="row ">
			<div class="col-md-12">
			<?php $page_no=0; ?>
				<table class="table table-bordered table-striped table-hover" id="main_tble">
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
					$from_dates = date('d-m-Y');
					$to_dates = date('d-m-Y');
					$total_amount = @$order_online_rate[$itemLedger->id]+@$order_bulk_rate[$itemLedger->id]+@$walkins_sales_rate[$itemLedger->id];
					if(in_array($id , $Itemsexists))
					{
						//if(@$total_amount != 0){
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
					} //}
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
<?php echo $this->Html->script('/assets/global/plugins/jquery.min.js'); ?>
<script>
var $rows = $('#main_tble tbody tr');
	$('#search3').on('keyup',function() {
		var val = $.trim($(this).val()).replace(/ +/g, ' ').toLowerCase();
		var v = $(this).val();
		if(v){ 
			$rows.show().filter(function() {
				var text = $(this).text().replace(/\s+/g, ' ').toLowerCase();
	
				return !~text.indexOf(val);
			}).hide();
		}else{
			$rows.show();
		}
	});
</script>