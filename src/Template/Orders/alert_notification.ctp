<?php
$orders_quantity;
$notification_quantity;
if($orders_quantity>$notification_quantity){
	@$new_order=$orders_quantity-$notification_quantity;
?>
				<div style="border:solid 1px #c7c7c7;background-color: #FFF;padding:10px;margin-top: -10px;width: 100%;font-size:14px;" class="maindiv">	
				<button type="button" class="close hidden-print" data-dismiss="modal" aria-hidden="true"></button>
				<div align="center" style="color:#F98630; font-size: 16px;font-weight: bold;">ORDERS Notification</div>
					<h3><?= h($new_order) ?> New Order Push</h3>
				</div>
 
<?php } ?>