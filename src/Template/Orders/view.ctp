<div style="">
<table class=" table-striped table-condensed table-hover  scroll" width="100%" border="0">
			<thead>
			<tr style="background-color:#fff; color:#000;"><td align="left" colspan="5"><b>
			Customer Order No.: <?= $order->order_no ?>
			</b></td></tr>
			
			<tr style="background-color:#fff; color:#000;"><td align="left" colspan="5">
			<b>Address: </b>RAMESHWAR PRASHAD GOUR,&nbsp;128<br><b>Mobile:</b> 7073657971<br>Near Pream Ice Cream,&nbsp;Shobhagpura<br>	
			
			</td></tr>
			  <tr style="background-color:#F98630; color:#fff;">
				<th style="text-align:center;"><label><strong>#</strong></label></th>
				<th style="text-align:center;"><label><strong>Image</strong></label></th>
					<th style="text-align:center;"><label><strong>Item Name</strong></label></th>
					<th style="text-align:center;"><label><strong>QTY</strong></label></th>
					<th style="text-align:center;"><label><strong>Amount</strong></label></th>
			  </tr>
			</thead>
			<tbody>
										  <tr style="background-color:#fff;"> <td>1</td>
					  <td align="center"><img src="/jainthela/catimage/1478927461.png" class="img-rounded img-responsive" width="40px" height="40px" alt=""></td>
			<td style="text-align:center;">Kaddu(pumpkin)</td>
			<td style="text-align:center;">1Kg</td>
			<td style="text-align:center;">30.00</td>
			</tr>
												  <tr style="background-color:#fff;"> <td>2</td>
					  <td align="center"><img src="/jainthela/catimage/1478926470.png" class="img-rounded img-responsive" width="40px" height="40px" alt=""></td>
			<td style="text-align:center;">Aaloo(Potato)</td>
			<td style="text-align:center;">2Kg</td>
			<td style="text-align:center;">28.00</td>
			</tr>
												  <tr style="background-color:#fff;"> <td>3</td>
					  <td align="center"><img src="/jainthela/catimage/1495490421.jpeg" class="img-rounded img-responsive" width="40px" height="40px" alt=""></td>
			<td style="text-align:center;">Khira(Cucumber)</td>
			<td style="text-align:center;">0.50Kg</td>
			<td style="text-align:center;">35.00</td>
			</tr>
												  <tr style="background-color:#fff;"> <td>4</td>
					  <td align="center"><img src="/jainthela/catimage/1495229939.jpeg" class="img-rounded img-responsive" width="40px" height="40px" alt=""></td>
			<td style="text-align:center;">Lahsun(Chhili)</td>
			<td style="text-align:center;">0.5Kg</td>
			<td style="text-align:center;">70.00</td>
			</tr>
												  <tr style="background-color:#fff;"> <td>5</td>
					  <td align="center"><img src="/jainthela/catimage/1493529333.jpeg" class="img-rounded img-responsive" width="40px" height="40px" alt=""></td>
			<td style="text-align:center;">Onion (pyaj)</td>
			<td style="text-align:center;">2Kg</td>
			<td style="text-align:center;">32.00</td>
			</tr>
												  <tr style="background-color:#fff;"> <td>6</td>
					  <td align="center"><img src="/jainthela/catimage/1493445532.jpeg" class="img-rounded img-responsive" width="40px" height="40px" alt=""></td>
			<td style="text-align:center;">kachi keri</td>
			<td style="text-align:center;">0.50Kg</td>
			<td style="text-align:center;">30.00</td>
			</tr>
												  <tr style="background-color:#fff;"> <td>7</td>
					  <td align="center"><img src="/jainthela/catimage/1495489757.jpeg" class="img-rounded img-responsive" width="40px" height="40px" alt=""></td>
			<td style="text-align:center;">Tindori</td>
			<td style="text-align:center;">0.50Kg</td>
			<td style="text-align:center;">30.00</td>
			</tr>
												   
					   
			
			
			
			
			
			
			<tr style="background-color:#fff; border-top:1px solid #000"><td colspan="3">&nbsp;</td><td align="right"><b>Amount</b></td>
			<td align="center"><b>255.00</b></td></tr>
			
								<tr style="background-color:#fff;"><td colspan="3">&nbsp;</td><td align="right"><b>Promo code</b></td>
			<td align="center"><b>-0</b></td></tr>
			
			<tr style="background-color:#fff;"><td colspan="3">&nbsp;</td><td align="right"><b>Delivery Charge</b></td>
			<td align="center"><b>0.00</b></td></tr>
			
			<tr style="background-color:#F5F5F5; border-top:1px solid #000; border-bottom:1px solid #000"><td colspan="3">&nbsp;</td><td align="right"><b>Total Amount</b></td>
			<td align="center"><b>255.00</b></td></tr>
			
			
			<tr style="background-color:#fff; border-top:1px solid #000"><td colspan="3">&nbsp;</td><td align="right"><b>Jain Cash</b></td>
			<td align="center"><b>0.00</b></td></tr>
			
			<tr style="background-color:#fff;"><td colspan="3">&nbsp;</td><td align="right"><b>Online Payment</b></td>
			<td align="center"><b>0.00</b></td></tr>
			
			<tr style="background-color:#fff;"><td colspan="3">&nbsp;</td><td align="right"><b>Wallet Payment</b></td>
			<td align="center"><b>0.00</b></td></tr>
			
			<tr style="background-color:#fff;"><td colspan="3">&nbsp;</td><td align="right"><b>Cash Payment</b></td>
			<td align="center"><b>0.00</b></td></tr>
			
			<tr style="background-color:#F5F5F5; border-top:1px solid #000; border-bottom:1px solid #000"><td colspan="3">&nbsp;</td><td align="right"><b>Total Paid</b></td>
			<td align="center"><b>0</b></td></tr>
		</tbody>
	</table>
</div>

<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Order'), ['action' => 'edit', $order->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Order'), ['action' => 'delete', $order->id], ['confirm' => __('Are you sure you want to delete # {0}?', $order->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Orders'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Order'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Customers'), ['controller' => 'Customers', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Customer'), ['controller' => 'Customers', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Promo Codes'), ['controller' => 'PromoCodes', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Promo Code'), ['controller' => 'PromoCodes', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Order Details'), ['controller' => 'OrderDetails', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Order Detail'), ['controller' => 'OrderDetails', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="orders view large-9 medium-8 columns content">
    <h3><?= h($order->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Customer') ?></th>
            <td><?= $order->has('customer') ? $this->Html->link($order->customer->name, ['controller' => 'Customers', 'action' => 'view', $order->customer->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Promo Code') ?></th>
            <td><?= $order->has('promo_code') ? $this->Html->link($order->promo_code->id, ['controller' => 'PromoCodes', 'action' => 'view', $order->promo_code->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Order Type') ?></th>
            <td><?= h($order->order_type) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Status') ?></th>
            <td><?= h($order->status) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($order->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Order No') ?></th>
            <td><?= $this->Number->format($order->order_no) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Jain Thela Admin Id') ?></th>
            <td><?= $this->Number->format($order->jain_thela_admin_id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Amount From Wallet') ?></th>
            <td><?= $this->Number->format($order->amount_from_wallet) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Amount From Jain Cash') ?></th>
            <td><?= $this->Number->format($order->amount_from_jain_cash) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Amount From Promo Code') ?></th>
            <td><?= $this->Number->format($order->amount_from_promo_code) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Total Amount') ?></th>
            <td><?= $this->Number->format($order->total_amount) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Order Date') ?></th>
            <td><?= h($order->order_date) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Order Details') ?></h4>
        <?php if (!empty($order->order_details)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Order Id') ?></th>
                <th scope="col"><?= __('Item Id') ?></th>
                <th scope="col"><?= __('Quantity') ?></th>
                <th scope="col"><?= __('Rate') ?></th>
                <th scope="col"><?= __('Amount') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($order->order_details as $orderDetails): ?>
            <tr>
                <td><?= h($orderDetails->id) ?></td>
                <td><?= h($orderDetails->order_id) ?></td>
                <td><?= h($orderDetails->item_id) ?></td>
                <td><?= h($orderDetails->quantity) ?></td>
                <td><?= h($orderDetails->rate) ?></td>
                <td><?= h($orderDetails->amount) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'OrderDetails', 'action' => 'view', $orderDetails->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'OrderDetails', 'action' => 'edit', $orderDetails->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'OrderDetails', 'action' => 'delete', $orderDetails->id], ['confirm' => __('Are you sure you want to delete # {0}?', $orderDetails->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
