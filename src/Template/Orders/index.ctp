<style>
.table>thead>tr>th{
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
						<i class="fa fa-book"></i> Order</span>
				</div>
				<div class="actions">
					<?php echo $this->Html->link('<i class="fa fa-plus"></i> Add new','/Orders/Add/Offline',['escape'=>false,'class'=>'btn btn-default']) ?>
					&nbsp;
					<?php if($status=='process'){
						$class1="btn btn-xs blue";
						$class2="btn btn-default";
					}else {
						$class1="btn btn-default";
						$class2="btn btn-xs blue";
					}
					 ?> 
						<?php echo $this->Html->link('Pending',['controller'=>'Orders','action' => 'index?status=process'],['escape'=>false,'class'=>$class1]); ?>
						<?php echo $this->Html->link('All',['controller'=>'Orders','action' => 'index'],['escape'=>false,'class'=>$class2]); ?>&nbsp;
				
				</div>
			<div class="portlet-body">
			<?php if($status=='') { ?>
			<form method="GET" >
				<table width="50%" class="table table-condensed">
					<tbody>
						<tr>
							<td width="7%">
								<?php echo $this->Form->input('status', ['type'=>'hidden','label' => false,'class' => 'form-control input-sm','placeholder'=>'Order No','value'=> h(@$status) ]); ?>
								<?php echo $this->Form->input('order_no', ['type'=>'text','label' => false,'class' => 'form-control input-sm','placeholder'=>'Order No','value'=> h(@$order_no) ]); ?>
							</td>
							<td width="2%">
								<?php echo $this->Form->input('customer', ['empty'=>'--Customers--','options' => $Customer_data,'label' => false,'class' => 'form-control input-sm select2me','placeholder'=>'Category','value'=> h(@$customer_id) ]); ?>
							</td>
							<?php if(@$cur_type){ ?>
								<td width="2%">
									<?php echo $this->Form->input('order_type', ['empty'=>'--Type--','options' => $order_type,'label' => false,'class' => 'form-control input-sm select2me','placeholder'=>'Category','value'=> h(@$cur_type) ]); ?>
								</td>
							<?php }else if(@$order_types){ ?>
								<td width="2%">
									<?php echo $this->Form->input('order_type', ['empty'=>'--Type--','options' => $order_type,'label' => false,'class' => 'form-control input-sm select2me','placeholder'=>'Category','value'=> h(@$order_types) ]); ?>
								</td>
							<?php } else{ ?>
								<td width="2%">
									<?php echo $this->Form->input('order_type', ['empty'=>'--Type--','options' => $order_type,'label' => false,'class' => 'form-control input-sm select2me','placeholder'=>'Category','value'=> h(@$order_types) ]); ?>
								</td>
							<?php  } ?>	
							<?php if(@$cur_status){ ?>
							<td width="2%">
								<?php echo $this->Form->input('orderstatus', ['empty'=>'--Status--','options' => $OrderStatus,'label' => false,'class' => 'form-control input-sm select2me','placeholder'=>'Category','value'=> h(@$cur_status) ]); ?>
							</td>
							<?php }else if(@$orderstatus){ ?>
								<td width="2%">
								<?php echo $this->Form->input('orderstatus', ['empty'=>'--Status--','options' => $OrderStatus,'label' => false,'class' => 'form-control input-sm select2me','placeholder'=>'Category','value'=> h(@$orderstatus) ]); ?>
							</td>
							<?php } else{ ?>
								<td width="2%">
									<?php echo $this->Form->input('orderstatus', ['empty'=>'--Status--','options' => $OrderStatus,'label' => false,'class' => 'form-control input-sm select2me','placeholder'=>'Category','value'=> h(@$orderstatus) ]); ?>
								</td>
							<?php } ?>	
							<?php if(@$cur_date){ ?>
							<td width="5%">
								<input type="text" name="From" class="form-control input-sm date-picker" placeholder="Order From"  data-date-format="dd-mm-yyyy">
							</td>	
							<td width="5%">
								<input type="text" name="To" class="form-control input-sm date-picker" placeholder="Order To"   data-date-format="dd-mm-yyyy" >
								
							</td>
							<?php }else if((@$from_date) || (@$to_date)){ ?>
								<td width="5%">
									<input type="text" name="From" class="form-control input-sm date-picker" placeholder="Order From" value="<?php echo @$from_date;  ?>"  data-date-format="dd-mm-yyyy">
								</td>	
								<td width="5%">
									<input type="text" name="To" class="form-control input-sm date-picker" placeholder="Order To" value="<?php echo @$to_date;  ?>"  data-date-format="dd-mm-yyyy" >
									
								</td>
							<?php }else{ ?>
								<td width="5%">
									<input type="text" name="From" class="form-control input-sm date-picker" placeholder="Order From" value="<?php echo @$from_date;  ?>"  data-date-format="dd-mm-yyyy">
								</td>	
								<td width="5%">
									<input type="text" name="To" class="form-control input-sm date-picker" placeholder="Order To" value="<?php echo @$to_date;  ?>"  data-date-format="dd-mm-yyyy" >
							<?php } ?>
							<td width="10%">
								<button type="submit" class="btn btn-success btn-sm"><i class="fa fa-filter"></i> Filter</button>
							</td>
							
						</tr>
					</tbody>
				</table>
			</form>
			<?php } ?>
			<?php $page_no=$this->Paginator->current('Orders'); $page_no=($page_no-1)*20; ?>
				<table class="table table-condensed table-hover table-bordered" id="main_tble">
					<thead>
						<tr>
							<th scope="col">Sr. No.</th>
							<th scope="col">Order No.</th>
							<th scope="col">Customer Name</th>
							<!--<th scope="col">wallet Amount</th>-->
							<th scope="col">Locality</th>
							<th scope="col">Grand Total</th>
							<th scope="col">Order Type</th>
							<th scope="col">Order Date</th>
							<th scope="col">Delivery Date</th>
							<th scope="col">Delivery Time</th>
							<th scope="col">Status</th>
							<th scope="col" class="actions"><?= __('Actions') ?></th>
							<th scope="col">Edit</th>
						</tr>
					</thead>
					<tbody>
						<?php
						$sr_no=0; foreach ($orders as $order): 
						$delivery_date=date('d-m-Y', strtotime($order->delivery_date));
						@$actual_deliver_time=$order->actual_deliver_time; 
						if(!empty($actual_deliver_time)){
							$date_show=$delivery_date.' ('.$actual_deliver_time.')';
						}else if(empty($actual_deliver_time)){
							$date_show=$delivery_date;
						}
						$date_show;
						 
						$current_date=date('d-m-Y');
						$status=$order->status;
						?>
						<tr <?php if(($status=='In Process') || ($status=='In process')){ ?>style="background-color:#ffe4e4; "<?php } ?> >
							<td><?= ++$page_no ?></td>
							<td>
							<?php echo $this->Html->link($order->order_no,['controller'=>'Orders','action' => 'view', $order->id, 'print'],['target'=>'_blank']); ?>
						</td>
							<td>
							<?php
								$customer_name=$order->customer->name;
								$customer_mobile=$order->customer->mobile;
								
								$order_date=date('d-m-Y', strtotime($order->order_date));
								$prev_date=date('d-m-Y', strtotime('-1 day'));
								
								
							?>
								<?= h($customer_name.' ('.$customer_mobile.')') ?>
							</td>
							<!--<td align="right"><?= $this->Number->format($order->amount_from_wallet) ?></td>-->
							<td><?= h(@$order->customer_address->locality) ?></td>
							<td align="right"><?= $this->Number->format($order->grand_total) ?></td>
							<td><?= h($order->order_type) ?></td>
							<td><?php $q=explode(' ',$order->order_date); ?> <span style="font-size:11px;"><?php echo $q[0] ?></span></td>
							<td><span style="font-size:11px;"><?= h($date_show) ?></span></td>
							<td><span style="font-size:11px;"><?= h($order->delivery_time) ?></span></td>
							<td><?= h($status) ?></td>
							
							<td class="actions">
							<?php  if(($status=='In Process') || ($status=='In process')){ ?>
							   <!--a class="btn blue btn-xs get_orders" order_id="<?php //echo $order->id; ?>" ><i class="fa fa-shopping-cart"></i> Deliver</a-->
							   <a class="btn blue btn-xs dlvr" order_id="<?php echo $order->id; ?>" > <i class="fa fa-shopping-cart"></i> Deliver</a>
							   <a class="btn red btn-xs cncl" order_id="<?php echo $order->id; ?>" > <i class="fa fa-remove"></i> Cancel</a>
							   
							<?php } ?> 
							<?php  if(($status=='cancel') || ($status=='Cancel') || ($status=='Delivered')){ 
							       if(( $order_date == $current_date ) || ($order_date == $prev_date  )){
							?>
								<a class="btn green btn-xs undo" order_id="<?php echo $order->id; ?>" ><i class="fa fa-undo"></i> Mark as <b>In Process</b></a>
								
							<?php } }?>
							</td>
							<?php  if(($status=='In Process') || ($status=='In process')){ 
							if(( $order_date == $current_date ) || ($order_date == $prev_date  )){?>
								<td>
									<?= $this->Html->link(__('Edit'), ['action' => 'edit', $order->id]) ?>
								
								</td>
							<?php 	}else{ ?>
								<td></td>
							<?php }}else {?>
								<td></td>
							 <?php } ?>
							
						</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
				<div class="paginator">
					<ul class="pagination">
						<?= $this->Paginator->first('<< ' . __('first')) ?>
						<?= $this->Paginator->prev('< ' . __('previous')) ?>
						<?= $this->Paginator->numbers() ?>
						<?= $this->Paginator->next(__('next') . ' >') ?>
						<?= $this->Paginator->last(__('last') . ' >>') ?>
					</ul>
					<p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
				</div>
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
	
	var form3 = $('#content');
	var error3 = $('.alert-danger', form3);
	var success3 = $('.alert-success', form3);
	form3.validate({
		
		errorElement: 'span', //default input error message container
		errorClass: 'help-block help-block-error', // default input error message class
		focusInvalid: true, // do not focus the last invalid input
		rules: {
				
			},

		errorPlacement: function (error, element) { // render error placement for each input type
			if (element.parent(".input-group").size() > 0) {
				error.insertAfter(element.parent(".input-group"));
			} else if (element.attr("data-error-container")) { 
				error.appendTo(element.attr("data-error-container"));
			} else if (element.parents('.radio-list').size() > 0) { 
				error.appendTo(element.parents('.radio-list').attr("data-error-container"));
			} else if (element.parents('.radio-inline').size() > 0) { 
				error.appendTo(element.parents('.radio-inline').attr("data-error-container"));
			} else if (element.parents('.checkbox-list').size() > 0) {
				error.appendTo(element.parents('.checkbox-list').attr("data-error-container"));
			} else if (element.parents('.checkbox-inline').size() > 0) { 
				error.appendTo(element.parents('.checkbox-inline').attr("data-error-container"));
			} else {
				error.insertAfter(element); // for other inputs, just perform default behavior
			}
		},

		invalidHandler: function (event, validator) { //display error alert on form submit   
			success3.hide();
			error3.show();
		},

		highlight: function (element) { // hightlight error inputs
		   $(element)
				.closest('.form-group').addClass('has-error'); // set error class to the control group
		},

		unhighlight: function (element) { // revert the change done by hightlight
			$(element)
				.closest('.form-group').removeClass('has-error'); // set error class to the control group
		},

		success: function (label) {
			label
				.closest('.form-group').removeClass('has-error'); // set success class to the control group
		},

		submitHandler: function (form) {
			success3.show();
			error3.hide();
			form[0].submit(); // submit the form
		}

	});
	////
	$('.actual_quantity').die().live('keyup',function() {
	var actual_quantity=parseFloat($(this).val());
	if(!actual_quantity){ actual_quantity=0; }
	var minimum_quantity_factor=parseFloat($(this).attr('minimum_quantity_factor'));
	if(!minimum_quantity_factor){ minimum_quantity_factor=0; }
	var price=parseFloat($(this).attr('price'));
	if(!price){ price=0; }
	var total_quantity=Math.round((actual_quantity/minimum_quantity_factor)*price);
	
 	$(this).closest('tr').find('.amount').val(total_quantity);
 	});
	
	
	$('.view_order').die().live('click',function() {
		$('#popup').show();
		var order_id=$(this).attr('order_id');
		$('#popup').find('div.modal-body').html('Loading...');
		var url="<?php echo $this->Url->build(["controller" => "Orders", "action" => "view"]); ?>";
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
		var url="<?php echo $this->Url->build(["controller" => "Orders", "action" => "cancel_box"]); ?>";
		url=url+'/'+order_id;
		$.ajax({
			url: url,
			type: 'GET',
			dataType: 'text'
		}).done(function(response) {
			$('#popup').find('div.modal-body').html(response);
		});	
	});
	
	$('.dlvr').die().live('click',function() {
		$('#popup').show();
		var order_id=$(this).attr('order_id');
 		$('#popup').find('div.modal-body').html('Loading...');
		var url="<?php echo $this->Url->build(["controller" => "Orders", "action" => "ajax_deliver"]); ?>";
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
	
	$('.undo').die().live('click',function() {
		
		var order_id=$(this).attr('order_id');
		
		var url="<?php echo $this->Url->build(["controller" => "Orders", "action" => "undo_box"]); ?>";
		url=url+'/'+order_id;
		
		$.ajax({
			url: url,
			type: 'GET',
			dataType: 'text'
		}).done(function(response) {
			
			location.reload();
		});	
	});
	$('.close').die().live('click',function() {
		$('#popup').hide();
	});
	
	$('.goc').die().live('click',function() 
	{ 
		$('#data').html('<i style= "margin-top: 20px;" class="fa fa-refresh fa-spin fa-3x fa-fw"></i><b> Loading... </b>');
		var odr_id = $(this).attr("value");
 		var m_data = new FormData();
		m_data.append('odr_id',odr_id);
			
		$.ajax({
			url: "<?php echo $this->Url->build(["controller" => "Orders", "action" => "ajax_order_view"]); ?>",
			data: m_data,
			processData: false,
			contentType: false,
			type: 'POST',
			dataType:'text',
			success: function(data)   // A function to be called if request succeeds
			{
				$('#data').html(data);
			}	
		});	
	});
	////
	$('.get_order').die().live('click',function(event) {
				 //event.preventDefault();		
		var order_id=$(this).attr('order_id');
		var s1 = [];
		var s2 = [];
		var s3 = [];
		$("#main_table tbody#main_tbody tr.main_tr").each(function(){ 
			 var row = [];
			 var items = [];
			 var amounts = [];
			var actual_quantity = $(this).find("td:nth-child(4) .actual_quantity").val();
			var amount = $(this).find("td:nth-child(5) .amount").val();
			var item_id = $(this).find("td:nth-child(2) .item_id").val();
			row.push(actual_quantity);
			 s1.push(row);
			 items.push(item_id);
			 s2.push(items);
			 amounts.push(amount);
			 s3.push(amounts);
		});
			
		var output=multiply(s1);
		if(output){
			if(output!=0){ 
			$('.get_order').prop('disabled', true);
			$('.get_order').text('Delivered.....');
						var url="<?php echo $this->Url->build(['controller'=>'Orders','action'=>'updateOrders']); ?>";
						url=url+'/'+order_id+'/'+s2+'/'+s1+'/'+s3,
						$.ajax({
							url: url,
						}).done(function(response) {
							var order_id=$('.get_order').attr('order_id');
							var m_data = new FormData();
							m_data.append('order_id',order_id);
							
							$.ajax({
							url: "<?php echo $this->Url->build(["controller" => "Orders", "action" => "ajax_deliver_api"]); ?>",
							data: m_data,
							processData: false,
							contentType: false,
							type: 'POST',
							dataType:'text',
							success: function(data)   // A function to be called if request succeeds
							{
								location.reload();
								//$('.setup').html(data);
							}
							});
						});	
			}
		}else{
			alert('fill all actual quantity.');
		}
		
	});	
	
	function multiply(array) {
    var sum = 1;
    for (var i = 0; i < array.length; i++) {
        sum = sum * array[i];
    }
    return sum;
}

	
	////

});
</script>
<div  class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel3" aria-hidden="false" style="display: none;border:0px;" id="popup">
<div class="modal-backdrop fade in" ></div>
	<div class="modal-dialog modal-lg">
		<div class="modal-content" style="border:0px;">
			<div class="modal-body flip-scroll" style="height: auto;
    overflow-y: auto;" >
				<p >
					 Body goes here...
				</p>
			</div>
		</div>
	</div>
</div>