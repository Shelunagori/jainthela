<style>
.table>thead>tr>th, .table > tbody > tr > td{
	font-size:12px !important;
}
 @media print
   {
     .printdata{
		 display:none;
	 }
   }

</style>
<div class="row printdata">
	<div class="col-md-12">
		<div class="portlet light bordered">
			<div class="portlet-title">
				<div class="caption">
					<i class="font-purple-intense"></i>
					<span class="caption-subject font-purple-intense ">
						<i class="fa fa-plus"></i> Walkin Sales
					</span>
				</div>
				<div class="actions">
					<?php echo $this->Html->link('<i class="fa fa-plus"></i> Add new','/WalkinSales/Add',['escape'=>false,'class'=>'btn btn-default']) ?>
				</div>
			<div class="portlet-body">
				<form method="GET" >
				<table width="50%" class="table table-condensed">
					<tbody>
						<tr>
							<td width="7%">
								<?php echo $this->Form->input('order_no', ['type'=>'text','label' => false,'class' => 'form-control input-sm','placeholder'=>'Order No','value'=> @$order_no ]); ?>
							</td>
							<?php if((@$from_date) || (@$to_date)){ ?>
								<td width="5%">
									<input type="text" name="From" class="form-control input-sm date-picker" placeholder="From" value="<?php echo @$from_date;  ?>"  data-date-format="dd-mm-yyyy">
								</td>	
								<td width="5%">
									<input type="text" name="To" class="form-control input-sm date-picker" placeholder="To" value="<?php echo $to_date;  ?>"  data-date-format="dd-mm-yyyy" >
									
								</td>
							<?php }else{ ?>
								<td width="5%">
									<input type="text" name="From" class="form-control input-sm date-picker" placeholder=" From" value="<?php echo @$from_date;  ?>"  data-date-format="dd-mm-yyyy">
								</td>	
								<td width="5%">
									<input type="text" name="To" class="form-control input-sm date-picker" placeholder=" To" value="<?php echo @$to_date;  ?>"  data-date-format="dd-mm-yyyy" >
							<?php } ?>
							
							
							<td width="2%">
								<?php echo $this->Form->input('drivers', ['empty'=>'--Drivers--','options' => $Drivers,'label' => false,'class' => 'form-control input-sm select2me','placeholder'=>'Category','value'=> @$drivers_id ]); ?>
							</td>
							
							<td width="10%">
								<button type="submit" class="btn btn-success btn-sm"><i class="fa fa-filter"></i> Filter</button>
							</td>
							
						</tr>
					</tbody>
				</table>
			</form>
				<table class="table table-condensed table-hover table-bordered" id="main_tble">
					<thead>
						<tr>
							<th>Sr</th>
							<th>Order No.</th>
							<th>Transaction Date</th>
							<th >Seller</th>
							<th>Driver Name</th>
							<th style="text-align:right;">Total Amount</th>
							<th class="actions"><?= __('Actions') ?></th>
						</tr>
					</thead>
					<tbody>
					<?php $page_no=0; foreach ($walkinSales as $walkinSale): ?>
						<tr>
							<td>
								<?= ++$page_no ?>
							</td>
							<td>
								<a class="view_order" order_id="<?php echo $walkinSale->id; ?>" ><?= h($walkinSale->order_no) ?></a> 
							</td>
							<td>
								<?= h($walkinSale->transaction_date) ?>
							</td>
							<td>
								<?php if(!empty(h(@$walkinSale->warehouse_id))){echo 'Warehouse';} else { echo 'Driver'; }?>
							</td>
							<td>
								<?php if(empty(h(@$walkinSale->driver_id))){echo '-';} else { ?><?= h(@$walkinSale->driver->name)?><?php } ?>
							</td>
							<td align="right">
								<?= $this->Number->precision($walkinSale->total_amount,2) ?>
							</td>
						   <td class="actions">
							 	 <?= $this->Form->postLink(__('Cancel'), ['action' => 'cancelBox', $walkinSale->id], ['confirm' => __('Are you sure you want to Cancel Order {0}?', $walkinSale->order_no)]) ?>
							</td>
						</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
			</div>
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
<script>
$(document).ready(function() {
	$('.view_order').die().live('click',function() {
			

		$('#popup').show();
		var order_id=$(this).attr('order_id');
		$('#popup').find('div.modal-body').html('Loading...');
		var url="<?php echo $this->Url->build(["controller" => "WalkinSales", "action" => "ajaxView"]); ?>";
		url=url+'/'+order_id;
		

		$.ajax({
			url: url,
			type: 'GET',
			dataType: 'text'
		}).done(function(response) {
			$('#popup').find('div.modal-body').html(response);
		});	
	});
	$('.close').die().live('click',function() {
		$('#popup').hide();
	});
	
	$('.cncl').die().live('click',function() {
		$('#popup').show();
		var order_id=$(this).attr('order_id');
 		$('#popup').find('div.modal-body').html('Loading...');
		var url="<?php echo $this->Url->build(["controller" => "WalkinSales", "action" => "cancel_box"]); ?>";
		url=url+'/'+order_id;
		$.ajax({
			url: url,
			type: 'GET',
			dataType: 'text'
		}).done(function(response) {
			$('#popup').find('div.modal-body').html(response);
		});	
	});
	$('.close').die().live('click',function() {
		$('#popup').hide();
	});
	
});
</script>
<div  class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel3" aria-hidden="false" style="display: none;border:0px;" id="popup">
<div class="modal-backdrop fade in" ></div>
	<div class="modal-dialog">
		<div class="modal-content" style="border:0px;">
			<div class="modal-body" >
				<p >
					 Body goes here...
				</p>
			</div>
		</div>
	</div>
</div>

