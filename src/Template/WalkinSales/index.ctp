<style>
.table>thead>tr>th, .table > tbody > tr > td{
	font-size:12px !important;
}
</style>
<div class="row">
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
					
					
				<input type="text" class="form-control input-sm pull-right" placeholder="Search..." id="search3"  style="width: 200px;">
				</div>
			</div>
			<div class="portlet-body">
			<?php $page_no=$this->Paginator->current('Orders'); $page_no=($page_no-1)*20; ?>
				<table class="table table-condensed table-hover table-bordered" id="main_tble">
					<thead>
						<tr>
									<tr> <th>Sr</th>
									<th>Order No.</th>
									<th>Transaction Date</th>
									<th >Seller</th>
									<th>Driver Name</th>
									<th style="text-align:right;">Total Amount</th>
									<!-- <th class="actions"><?= __('Actions') ?></th> -->
								</tr>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($walkinSales as $walkinSale): ?>
            <tr>
                <td><?= ++$page_no ?></td>
				 <td><a class="view_order" order_id="<?php echo $walkinSale->id; ?>" ><?= h($walkinSale->order_no) ?></a> </td>
                <td><?= h($walkinSale->transaction_date) ?></td>
                <td><?php if(!empty(h(@$walkinSale->warehouse_id))){echo 'Warehouse';} else { echo 'Driver'; }?></td>
				 <td><?php if(empty(h(@$walkinSale->driver_id))){echo '-';} else { ?><?= h(@$walkinSale->driver->name)?><?php } ?></td>
                <td align="right"><?= $this->Number->precision($walkinSale->total_amount,2) ?></td>
               <!--
				<td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $walkinSale->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $walkinSale->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $walkinSale->id], ['confirm' => __('Are you sure you want to delete # {0}?', $walkinSale->id)]) ?>
                </td>
				-->
            </tr>
            <?php endforeach; ?>
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
<div  class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel3" aria-hidden="false" style="display: none;" id="popup">
<div class="modal-backdrop fade in" ></div>
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-body">
				<p>
					 Body goes here...
				</p>
			</div>
		</div>
	</div>
</div>

