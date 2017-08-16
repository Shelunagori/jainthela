<style>

@media print{
	.maindiv{
		width:100% !important;
	}	
	
}
p{
margin-bottom: 0;
}
.table > thead > tr > th, .table > tbody > tr > th, .table > tfoot > tr > th, .table > thead > tr > td, .table > tbody > tr > td, .table > tfoot > tr > td {
    padding: 5px !important;
	font-family:Lato !important;
}
</style>

<style type="text/css" media="print">
@page {
    size: auto;   /* auto is the initial value */
    margin: 0px 0px 0px 0px;  /* this affects the margin in the printer settings */
}
</style>	
	<div style="border:solid 1px #c7c7c7;background-color: #FFF;padding:10px;margin-top: -10px;width: 100%;font-size:14px;" class="maindiv">	
	<button type="button" class="close hidden-print" data-dismiss="modal" aria-hidden="true"></button>
	<div align="center" style="color:#F98630; font-size: 16px;font-weight: bold;">WALK-IN NOTE</div>
	<div style="border:solid 2px #F98630; margin-bottom:15px;"></div>
	<table width="100%">
		<thead>
			<tr style="background-color:#fff; color:#000;">
				<td align="left" colspan="5">
					<b>
						Transaction Date : <?= h($walkinSales->transaction_date) ?>
					</b>
				</td>
				<td align="right" colspan="5">
					<b>
						Order No. : <?= $walkinSales->order_no ?>
					</b>
				</td>
			</tr>
	</table>
	<br/>
		<table class=" table-striped table-condensed table-hover  scroll" width="100%" border="0">
			<thead>
				
				<tr style="background-color:#F98630; color:#fff;">
					<th style="text-align:center;">#</th>
					<th style="text-align:center;">Image</th>
					<th style="text-align:left;">Item Name</th>
					<th style="text-align:center;">QTY</th>
					<th style="text-align:center;">Rate</th>
					<th style="text-align:center;">Amount</th>
				</tr>
			</thead>
			<tbody>
			<?php
$total=0;
$i=0;
			foreach ($walkinSales->walkin_sale_details as $walkinSale){
			$i++;
			$total+=$walkinSale->amount;
			$quantity=$walkinSale->quantity;
			$image = $walkinSale->item->image;
			$unit_name=$walkinSale->item->unit->unit_name;
			$show_quantity=$quantity.' '.$unit_name;
			?>
			<tr>
			<td  align="center"><?=h($i)?></td>
			<td align="center">
			<?php echo $this->Html->image('/img/item_images/'.$image, ['height' => '40px', 'width'=>'40px', 'class'=>'img-rounded img-responsive']); ?>
			</td>
			<td><?= h($walkinSale->item->name) ?></td>
			<td align="center"><?= h($show_quantity) ?></td>
			<td  align="center"><?=h($walkinSale->rate)?></td>
			<td align="center"><?=h($walkinSale->amount)?></td>
			</tr>
			
		<?php } ?>
		<tr style="background-color:#F5F5F5; border-top:1px solid #000; border-bottom:1px solid #000">
			<td colspan="4">&nbsp;</td>
			<td align="right"><b>Total Amount</b></td>
			<td align="center"><b><?= h($total) ?></b></td>
		</tr>
		<tfoot>
			<tr>
				<td colspan="6"><a class="btn  blue hidden-print margin-bottom-5 pull-right" onclick="javascript:window.print();">Print <i class="fa fa-print"></i></a>
				</td>
			</tr>
		</tfoot>

	</table>
	</div>
