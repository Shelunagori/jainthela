		
			<div class="row">
			
			<?php echo $this->Html->link('<div class="col-lg-2 col-md-2 col-sm-3 col-xs-6">
					<div class="dashboard-stat" style="background-color:#CDCDCD; height:40px">
						
						<div class="details">
							
						</div>
						<p class="more  tooltips" data-placement="bottom" data-original-title="" href="" style="background-color:#ffffff; color:#000; text-align:center"><b>Info Message</b>
						</p>
					</div>
				</div>','/PushNotifications/home?page=home',['escape'=>false]) ?>
				
				<?php echo $this->Html->link('<div class="col-lg-2 col-md-2 col-sm-3 col-xs-6">
					<div class="dashboard-stat" style="background-color:#888888;height:40px">
						
						<div class="details">
							
						</div>
						<p class="more  tooltips" data-placement="bottom" data-original-title="" href="" style="background-color:#ffffff; color:#000; text-align:center"><b>Bulk Booking</b>
						</p>
					</div>
				</div>','/PushNotifications/home?page=bulkbooking',['escape'=>false]) ?>
				
				
				<!--<?php echo $this->Html->link('
				<div class="col-lg-2 col-md-2 col-sm-3 col-xs-6">
					<div class="dashboard-stat  red-intense" style="height:40px">
						
						<div class="details" >
						
						</div><p class="more  tooltips" data-placement="bottom" data-original-title="" href="" style="background-color:#ffffff; color:#000; text-align:center; height:30px"><b>Bulk Booking</b>
						</p>
					</div>
				</div>
				</a>
				</div>','/PushNotifications/home?page=referfriend',['escape'=>false]) ?>-->
				
				
				<?php echo $this->Html->link('
				<div class="col-lg-2 col-md-2 col-sm-3 col-xs-6">
					<div class="dashboard-stat red-intense" style="height:40px">
						
						<div class="details">
						
						</div><p class="more  tooltips" data-placement="bottom" data-original-title="" href="" style="background-color:#ffffff; color:#000; text-align:center"><b>Add Money</b>
						</p>
					</div>
				</div>','/PushNotifications/home?page=addmoney',['escape'=>false]) ?>
				
				
				<?php echo $this->Html->link('
				<div class="col-lg-2 col-md-2 col-sm-3 col-xs-6">
					<div class="dashboard-stat green-haze" style="height:40px">
						
						<div class="details">
						
						</div><p class="more  tooltips" data-placement="bottom" data-original-title="" href="" style="background-color:#ffffff; color:#000; text-align:center"><b>View Cart</b>
						</p>
					</div>
				</div>	','/PushNotifications/home?page=viewcart',['escape'=>false]) ?>
				
				
				
				
				<?php echo $this->Html->link('
				<div class="col-lg-2 col-md-2 col-sm-3 col-xs-6">
					<div class="dashboard-stat purple-plum" style="height:40px">
						
						<div class="details">
						
						</div><p class="more  tooltips" data-placement="bottom" data-original-title="" href="" style="background-color:#ffffff; color:#000; text-align:center"><b>Combo Offers</b>
						</p>
					</div>
				</div>	','/PushNotifications/home?page=specialoffers',['escape'=>false]) ?>
				
				<?php echo $this->Html->link('
				<div class="col-lg-2 col-md-2 col-sm-3 col-xs-6">
					<div class="dashboard-stat red-intense" style="height:40px">
						
						<div class="details">
						
						</div><p class="more  tooltips" data-placement="bottom" data-original-title="" href="" style="background-color:#ffffff; color:#000; text-align:center"><b>Product Description</b>
						</p>
					</div>

				</div>','/PushNotifications/item_view',['escape'=>false]) ?>
			</div>

			<style>
.table>thead>tr>th{
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
						<i class="fa fa-book"></i> Notification History</span>
				</div>
				
			</div>
			<div class="portlet-body">
				<table class="table table-condensed table-hover table-bordered" id="main_tble">
					<thead>
						<tr>
							<th scope="col">Sr. No.</th>
							<th scope="col">Notification Date</th>
							<th scope="col">Image</th>
							<th scope="col">Message</th>
							<th scope="col">Type</th>
							<th scope="col">Total Send</th>
						</tr>
					</thead>
					<tbody>
						<?php
						$sr_no=0; foreach ($pushNotifications as $pushNotification): $sr_no++;
						?>
						<tr>
							<td><?= $sr_no ?></td>
							<td><?= $pushNotification->created_on ?></td>
							<td><?php if (!empty($pushNotification->image)) { ?><img src="<?php echo $pushNotification->image; ?>" style="width:100px; height:100px"><?php } else { echo 'No Image'; } ?></td>
							<td><?= h($pushNotification->message) ?></td> 
							<td><?= h($pushNotification->type) ?></td>
							<td><?=($pushNotification->push_notification_customers[0]->count_customer) ?></td>
						</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
			
				 
				