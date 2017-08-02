<?php
namespace App\Controller\Api;
use App\Controller\Api\AppController;
use Cake\ORM\TableRegistry;
class OrdersController extends AppController
{
    public function trackOrder()
    {
		$jain_thela_admin_id=$this->request->query('jain_thela_admin_id');
		$customer_id=$this->request->query('customer_id');
		$orders_data = $this->Orders->find()
						->where(['customer_id' => $customer_id, 'jain_thela_admin_id' => $jain_thela_admin_id, 'status' => 'In Process'])
						->order(['order_date' => 'DESC'])
						->contain(['OrderDetails'=>function($q){
							return $q->contain(['Items'])->limit(1);
						}])
						->autoFields(true);


					foreach($orders_data as $data)
					{
						$data->created_date=date('D M j, Y H:i a', strtotime($data->order_date));
						$data->order_date=date('D M j, Y H:i a', strtotime($data->order_date));
                        $data->delivery_date=date('D M j, Y H:i a', strtotime($data->delivery_date)); 

					}
						
		foreach($orders_data as $order){
			$order->image_url='http://app.jainthela.in'.$this->request->webroot.'img/item_images/'.@$order->order_details[0]->item->image;
			unset($order->order_details);
		}
		
		$status=true;
		$error="";
        $this->set(compact('status', 'error','orders_data'));
        $this->set('_serialize', ['status', 'error', 'orders_data']);
    }
	public function viewMyTrackOrder()
    {
		$jain_thela_admin_id=$this->request->query('jain_thela_admin_id');
		$customer_id=$this->request->query('customer_id');
		$order_id=$this->request->query('order_id');
		
		$orders_details_data = $this->Orders->get($order_id, ['contain'=>['OrderDetails'=>['Items'=>function($q){
               return $q->select(['image_path' => $q->func()->concat(['http://app.jainthela.in'.$this->request->webroot.'img/item_images/','image' => 'identifier' ])])->contain('Units')->autoFields(true);
			}]]]);
		
		
		
		$orders_details_data->curent_date=date('D M j, Y H:i a', strtotime($orders_details_data->curent_date));
	 	$orders_details_data->order_date=date('D M j, Y H:i a', strtotime($orders_details_data->order_date));
	    $orders_details_data->delivery_date=date('D M j, Y H:i a', strtotime($orders_details_data->delivery_date));
		
		 $c_a_id=$orders_details_data->customer_address_id;
		 $customer_addresses=$this->Orders->CustomerAddresses->find()
		->where(['CustomerAddresses.customer_id' => $customer_id, 'CustomerAddresses.id'=>$c_a_id])->first();
		
		 $cancellation_reasons=$this->Orders->CancelReasons->find();
		

		$status=true;
		$error="";
        $this->set(compact('status', 'error','orders_details_data','customer_addresses','cancellation_reasons'));
        $this->set('_serialize', ['status', 'error', 'orders_details_data','customer_addresses','cancellation_reasons']);
    }

	public function myOrder()
    {
		$jain_thela_admin_id=$this->request->query('jain_thela_admin_id');
		$customer_id=$this->request->query('customer_id');
		
		$orders_data = $this->Orders->find()
		->where(['customer_id' => $customer_id, 'jain_thela_admin_id' => $jain_thela_admin_id, 'status IN' => ['Delivered','Cancel'] ])
		->order(['order_date' => 'DESC'])
		->contain(['OrderDetails'=>function($q){
							return $q->contain(['Items'])->limit(1);
						}])
						->autoFields(true);
						
						
					foreach($orders_data as $data)
					{
						$data->created_date=date('D M j, Y H:i a', strtotime($data->order_date));
						$data->order_date=date('D M j, Y H:i a', strtotime($data->order_date));
                        $data->delivery_date=date('D M j, Y H:i a', strtotime($data->delivery_date)); 
					}
						
						
						
		foreach($orders_data as $order){
			$order->image_url='http://app.jainthela.in'.$this->request->webroot.'img/item_images/'.@$order->order_details[0]->item->image;
			unset($order->order_details);
		} 
		
 		$status=true;
		$error="";
        $this->set(compact('status', 'error','orders_data'));
        $this->set('_serialize', ['status', 'error', 'orders_data']);
    }
	
	public function cancelOrder()
    {
		$jain_thela_admin_id=$this->request->query('jain_thela_admin_id');
		$customer_id=$this->request->query('customer_id');
		$order_id=$this->request->query('order_id');
		@$cancel_id=$this->request->query('cancel_id');
 		
   
				$odrer_datas=$this->Orders->get($order_id);
 				$o_date=$odrer_datas->order_date;
 				$amount_from_wallet=$odrer_datas->amount_from_wallet;
 				$amount_from_jain_cash=$odrer_datas->amount_from_jain_cash;
 				$amount_from_promo_code=$odrer_datas->amount_from_promo_code;
 				$online_amount=$odrer_datas->online_amount;
				$return_amount=$amount_from_wallet+$amount_from_jain_cash+$amount_from_promo_code+$online_amount;
				
				$order_cancel = $this->Orders->query();
					$result = $order_cancel->update()
						->set(['status' => 'Cancel',
						'cancel_id' => $cancel_id, 'order_date' => $o_date])
						->where(['id' => $order_id])
						->execute();
						
						
					$query = $this->Orders->Wallets->query();
					$query->insert(['customer_id', 'advance', 'narration', 'return_order_id'])
							->values([
							'customer_id' => $customer_id,
							'advance' => $return_amount,
							'narration' => 'Amount Return form Order',
							'return_order_id' => $order_id
							])
					->execute();
//end tis code///		

		
			$customer_details=$this->Orders->Customers->find()
			->where(['Customers.id' => $customer_id])->first();
			$mobile=$customer_details->mobile;

			$sms=str_replace(' ', '+', 'Your order has been cancelled.' );
			$working_key='A7a76ea72525fc05bbe9963267b48dd96';
			$sms_sender='JAINTE';
			$sms=str_replace(' ', '+', $sms);
			file_get_contents('http://alerts.sinfini.com/api/web2sms.php?workingkey='.$working_key.'&sender='.$sms_sender.'&to='.$mobile.'&message='.$sms.'');
		
		$status=true;
		$error="Thank you, your order has been cancelled.";
        $this->set(compact('status', 'error'));
        $this->set('_serialize', ['status', 'error']);
    }
	public function deliveredOrder()
    {
		$jain_thela_admin_id=$this->request->query('jain_thela_admin_id');
		$order_id=$this->request->query('order_id');
		$is_login=$this->request->query('is_login'); ///warehouse or driver///
		$driver_warehouse_id=$this->request->query('driver_warehouse_id');
		$transaction_date=date('Y-m-d');
		if($is_login=='warehouse')
		{
 			    $odrer_datas=$this->Orders->get($order_id);
				$o_date=$odrer_datas->otder_date;
			        $order_delivered = $this->Orders->query();
					$result = $order_delivered->update()
						->set(['status' => 'Delivered',
						'order_date' => $o_date])
						->where(['id' => $order_id])
						->execute();
		//end tis code///
                    
					$delivery_details=$this->Orders->OrderDetails->find()
					->where(['order_id' => $order_id]);
					foreach($delivery_details as $deliver_data)
					{
					 $item_type=$this->Orders->Items->find()
					->where(['Items.id' => $deliver_data->item_id])->first();
				      $is_virtual=$item_type->is_virtual;
					  $is_id=$item_type->id;
					  $parent_item_id=$item_type->parent_item_id;
					  $is_combo=$item_type->is_combo;
					  $combo_offer_id=$item_type->combo_offer_id;
					  
				  if($is_combo=='no')
				  {
					  if($is_virtual=='yes')
					  {
							$query = $this->Orders->ItemLedgers->query();
					        $query->insert(['jain_thela_admin_id', 'warehouse_id', 'item_id', 'rate', 'amount', 'quantity', 'inventory_transfer','transaction_date', 'order_id', 'status'])
							->values([
							'jain_thela_admin_id' => $jain_thela_admin_id,
							'warehouse_id' => $driver_warehouse_id,
							'item_id' => $parent_item_id,
							'rate' => $deliver_data->rate,
							'amount' => $deliver_data->amount,
							'quantity' => $deliver_data->actual_quantity,
							'inventory_transfer' => 'no',
							'transaction_date'=>$transaction_date,
							'order_id'=>$order_id,
							'status'=>'out'
							])
					        ->execute(); 
					  }
					  else if($is_virtual=='no'){
						  $query = $this->Orders->ItemLedgers->query();
					        $query->insert(['jain_thela_admin_id', 'warehouse_id', 'item_id', 'rate', 'amount','quantity', 'inventory_transfer','transaction_date','order_id', 'status'])
							->values([
							'jain_thela_admin_id' => $jain_thela_admin_id,
							'warehouse_id' => $driver_warehouse_id,
							'item_id' => $is_id,
							'rate' => $deliver_data->rate,
							'amount' => $deliver_data->amount,
							'quantity' => $deliver_data->actual_quantity,
							'inventory_transfer' => 'no',
							'transaction_date'=>$transaction_date,
							'order_id'=>$order_id,
							'status'=>'out'
							])
					        ->execute(); 
					  }
					 
					}
					else{
					  $combo_details=$this->Orders->ComboOfferDetails->find()
					->where(['ComboOfferDetails.combo_offer_id' => $combo_offer_id]);
					  foreach($combo_details as $combo_details_data)
					  {
					  $item_type=$this->Orders->Items->find()
					->where(['Items.id' => $combo_details_data->item_id])->first();
				      $is_virtual=$item_type->is_virtual;
					  $is_id=$item_type->id;
					  $parent_item_id=$item_type->parent_item_id;
					  $is_combo=$item_type->is_combo;
					  
					  if($is_virtual=='yes')
					  {
							$query = $this->Orders->ItemLedgers->query();
					        $query->insert(['jain_thela_admin_id', 'warehouse_id', 'item_id', 'quantity', 'inventory_transfer','transaction_date','order_id', 'status'])
							->values([
							'jain_thela_admin_id' => $jain_thela_admin_id,
							'warehouse_id' => $driver_warehouse_id,
							'item_id' => $parent_item_id,
							//'rate' => $combo_details_data->rate,
							'quantity' => $combo_details_data->quantity,
							'inventory_transfer' => 'no',
							'transaction_date'=>$transaction_date,
							'order_id'=>$order_id,
							'status'=>'out'
							])
					        ->execute(); 
					  }
					  else if($is_virtual=='no'){
						  $query = $this->Orders->ItemLedgers->query();
					        $query->insert(['jain_thela_admin_id', 'warehouse_id', 'item_id', 'quantity', 'inventory_transfer','transaction_date','order_id', 'status'])
							->values([
							'jain_thela_admin_id' => $jain_thela_admin_id,
							'warehouse_id' => $driver_warehouse_id,
							'item_id' => $is_id,
							//'rate' => $combo_details_data->rate,
							'quantity' => $combo_details_data->quantity,
							'inventory_transfer' => 'no',
							'transaction_date'=>$transaction_date,
							'order_id'=>$order_id,
							'status'=>'out'
							])
					        ->execute(); 
					  }  
					 }
					}
					  
				}
		}
		else if($is_login=='driver')
		{
			        
			        $order_delivered = $this->Orders->query();
					$result = $order_delivered->update()
						->set(['status' => 'Delivered'])
						->where(['id' => $order_id])
						->execute();
                    
					$delivery_details=$this->Orders->OrderDetails->find()
					->where(['order_id' => $order_id]);
					foreach($delivery_details as $deliver_data)
					{
					 $item_type=$this->Orders->Items->find()
					->where(['Items.id' => $deliver_data->item_id])->first();
				      $is_virtual=$item_type->is_virtual;
					  $is_id=$item_type->id;
					  $parent_item_id=$item_type->parent_item_id;
					  $is_combo=$item_type->is_combo;
					  $combo_offer_id=$item_type->combo_offer_id;
					  
				  if($is_combo=='no')
				  {
					  if($is_virtual=='yes')
					  {
							$query = $this->Orders->ItemLedgers->query();
					        $query->insert(['jain_thela_admin_id', 'driver_id', 'item_id', 'rate','amount', 'quantity', 'inventory_transfer','transaction_date','order_id', 'status'])
							->values([
							'jain_thela_admin_id' => $jain_thela_admin_id,
							'driver_id' => $driver_warehouse_id,
							'item_id' => $parent_item_id,
							'rate' => $deliver_data->rate,
							'amount' => $deliver_data->amount,
							'quantity' => $deliver_data->actual_quantity,
							'inventory_transfer' => 'no',
							'transaction_date'=>$transaction_date,
							'order_id'=>$order_id,
							'status'=>'out'
							])
					        ->execute(); 
					  }
					  else if($is_virtual=='no'){
						  $query = $this->Orders->ItemLedgers->query();
					        $query->insert(['jain_thela_admin_id', 'driver_id', 'item_id', 'rate', 'amount','quantity', 'inventory_transfer','transaction_date','order_id','status'])
							->values([
							'jain_thela_admin_id' => $jain_thela_admin_id,
							'driver_id' => $driver_warehouse_id,
							'item_id' => $is_id,
							'rate' => $deliver_data->rate,
							'amount' => $deliver_data->amount,
							'quantity' => $deliver_data->actual_quantity,
							'inventory_transfer' => 'no',
							'transaction_date'=>$transaction_date,
							'order_id'=>$order_id,
							'status'=>'out'
							])
					        ->execute(); 
					  }
					 
					}
					else{
					  $combo_details=$this->Orders->ComboOfferDetails->find()
					->where(['ComboOfferDetails.combo_offer_id' => $combo_offer_id]);
					  foreach($combo_details as $combo_details_data)
					  {
					  $item_type=$this->Orders->Items->find()
					->where(['Items.id' => $combo_details_data->item_id])->first();
				      $is_virtual=$item_type->is_virtual;
					  $is_id=$item_type->id;
					  $parent_item_id=$item_type->parent_item_id;
					  $is_combo=$item_type->is_combo;
					  
					  if($is_virtual=='yes')
					  {
							$query = $this->Orders->ItemLedgers->query();
					        $query->insert(['jain_thela_admin_id', 'driver_id', 'item_id', 'quantity', 'inventory_transfer','transaction_date','order_id','status'])
							->values([
							'jain_thela_admin_id' => $jain_thela_admin_id,
							'driver_id' => $driver_warehouse_id,
							'item_id' => $parent_item_id,
							//'rate' => $combo_details_data->rate,
							'quantity' => $combo_details_data->quantity,
							'inventory_transfer' => 'no',
							'transaction_date'=>$transaction_date,
							'order_id'=>$order_id,
							'status'=>'out'
							])
					        ->execute(); 
					  }
					  else if($is_virtual=='no'){
						  $query = $this->Orders->ItemLedgers->query();
					        $query->insert(['jain_thela_admin_id', 'driver_id', 'item_id', 'quantity', 'inventory_transfer','transaction_date','order_id', 'status'])
							->values([
							'jain_thela_admin_id' => $jain_thela_admin_id,
							'driver_id' => $driver_warehouse_id,
							'item_id' => $is_id,
							//'rate' => $combo_details_data->rate,
							'quantity' => $combo_details_data->quantity,
							'inventory_transfer' => 'no',
							'transaction_date'=>$transaction_date,
							'order_id'=>$order_id,
							'status'=>'out'
							])
					        ->execute(); 
					  }  
					 }
					}
					  
				}
		}
					$order_details=$this->Orders->find()
					->where(['id' => $order_id])->first();
					$order_no=$order_details->order_no;
					$grand_total=$order_details->grand_total;
					$customer_id=$order_details->customer_id;
					$delivery_date=date('D M j, Y H:i a', strtotime($order_details->delivery_date));
					
					$customer_details=$this->Orders->Customers->find()
					->where(['Customers.id' => $customer_id])->first();
					$mobile=$customer_details->mobile;
					$API_ACCESS_KEY=$customer_details->notification_key;
					$device_token=$customer_details->device_token;
					$device_token1=rtrim($device_token);
                    $time1=date('Y-m-d G:i:s');
					
 if(!empty($device_token1))
					{
					
	$msg = array
	(
	'message' 	=> 'Thank You, your order delivered successfully',
	'image' 	=> '',
	'button_text'	=> 'See Your Order',
    'link' => 'jainthela://my_order?id='.$order_details->id,	
    'notification_id'	=> 1,
	);

$url = 'https://fcm.googleapis.com/fcm/send';
$fields = array
(
	'registration_ids' 	=> array($device_token1),
	'data'			=> $msg
);
$headers = array
(
	'Authorization: key=' .$API_ACCESS_KEY,
	'Content-Type: application/json'
);

  //echo json_encode($fields);
  $ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
$result001 = curl_exec($ch);
if ($result001 === FALSE) {
	die('FCM Send Error: ' . curl_error($ch));
}
curl_close($ch);
					}  
					/*....................................*/

					$sms=str_replace(' ', '+', 'Thank You, Your order has been delivered successfully. your order no. is: '.$order_no.'' );
					$working_key='A7a76ea72525fc05bbe9963267b48dd96';
					$sms_sender='JAINTE';
					$sms=str_replace(' ', '+', $sms);
					file_get_contents('http://alerts.sinfini.com/api/web2sms.php?workingkey='.$working_key.'&sender='.$sms_sender.'&to='.$mobile.'&message='.$sms.'');
					
					
		$status=true;
		$error="Thank you, order delivered successfully.";
        $this->set(compact('status', 'error'));
        $this->set('_serialize', ['status', 'error']);
    }
	
	 public function placeOrder()
    {
		$jain_thela_admin_id=$this->request->data('jain_thela_admin_id');
		$customer_id=$this->request->data('customer_id');
		$wallet_amount=$this->request->data('wallet_amount');
		$jain_cash_amount=$this->request->data('jain_cash_amount');
		$customer_address_id=$this->request->data('customer_address_id');
		$delivery_time_id=$this->request->data('delivery_time_id');
		$online_amount=$this->request->data('online_amount');
		$total_amount=$this->request->data('total_amount');
		$delivery_charge1=$this->request->data('delivery_charge');
		$delivery_charge_id=$this->request->data('delivery_charge_id');
		$promo_code_amount=$this->request->data('promo_code_amount');
		$promo_code_id=$this->request->data('promo_code_id');
        $discount_percent=$this->request->data('discount_percent');
		$order_type=$this->request->data('order_type');
		$payment_status=$this->request->data('payment_status');
		$order_no=$this->request->data('order_no');
		$order_from=$this->request->data('order_from');
		$warehouse_id=1;
		$order = $this->Orders->newEntity();
		$curent_date=date('Y-m-d');
		$order_date=date('Y-m-d H:i:s');
		
		
		
		if($total_amount >=100)
		{
			$delivery_charge=0;
		}
		else{
			$delivery_charge=$delivery_charge1;
		}
		
				///////////////////////GET TIME/////////////////	
				$delivery_time_data = $this->Orders->DeliveryTimes->find()
				->where(['DeliveryTimes.id'=>$delivery_time_id])->first();
				$d_from=$delivery_time_data->time_from;
				$d_to=$delivery_time_data->time_to;
				$delivery_time=$d_from.$d_to;

				///////////////////////GET DELIVERY DATE/////////////////				
				$out_of_stock_data=$this->Orders->Carts->find()->where(['customer_id' => $customer_id]);
        		$counts=0;
				foreach($out_of_stock_data as $fetch_data)
				{
					$item_id=$fetch_data->item_id;
					$out_data=$this->Orders->Carts->Items->get($item_id);
					$d=$out_data->out_of_stock;
					$counts+=$d;
				}				
				$current_timess1=date('h', time());
				$current_timess2=date('i', time());
				$dots='.';
				$current_timess=$current_timess1.$dots.$current_timess2;
				$current_ampm=date('a', time());
				$start = "04";
				$end = "12";
	if($current_ampm=='pm' &&  $current_timess > $start  && $current_timess < $end || $counts>0) 
				{
				    $delivery_date=date('Y-m-d', strtotime('+1 day', strtotime($curent_date)));//delivery_date///
				}
    else{
				$delivery_date=date('Y-m-d');//delivery_date///
				}
		
			///////////////////////GET LAST ORDER NO/////////////////
			$last_order_no = $this->Orders->find()
			->select(['get_auto_no'])
			->order(['get_auto_no'=>'DESC'])->where(['jain_thela_admin_id'=>$jain_thela_admin_id, 'curent_date'=>$curent_date])
			->first();

			if(!empty($last_order_no)){
			$get_auto_no = h(str_pad(number_format($last_order_no->get_auto_no+1),6, '0', STR_PAD_LEFT));
			}else{
		    $get_auto_no=h(str_pad(number_format(1),6, '0', STR_PAD_LEFT));
			}
			$get_date=str_replace('-','',$curent_date);
			$exact_order_no=h('W'.$get_date.$get_auto_no);//orderno///

		///////////////////////INSERTION IN ORDER/////////////////
		$grand_total=$total_amount+$delivery_charge;
		$pay_amount=$grand_total-($wallet_amount+$jain_cash_amount+$online_amount+$promo_code_amount);
			
		$this->loadModel('Carts');
		$carts_data=$this->Carts->find()->where(['customer_id'=>$customer_id])->contain(['Items']);
		$i=0;
			foreach($carts_data as $carts_data_fetch)
			{
				$amount=$carts_data_fetch->cart_count*$carts_data_fetch->item->sales_rate;				
				$this->request->data['order_details'][$i]['item_id']=$carts_data_fetch->item_id;
				$this->request->data['order_details'][$i]['quantity']=$carts_data_fetch->quantity;
				$this->request->data['order_details'][$i]['rate']=$carts_data_fetch->item->sales_rate;
				$this->request->data['order_details'][$i]['amount']=$amount;
				$this->request->data['order_details'][$i]['is_combo']=$carts_data_fetch->is_combo;
				$i++;
			}
			$order = $this->Orders->patchEntity($order, $this->request->getData());
			$order->transaction_order_no=$order_no;
			$order->order_no=$exact_order_no;
			$order->customer_id=$customer_id;
			$order->jain_thela_admin_id=$jain_thela_admin_id;
			$order->amount_from_wallet=$wallet_amount;
			$order->customer_address_id=$customer_address_id;
			$order->amount_from_jain_cash=$jain_cash_amount;
			$order->amount_from_promo_code=$promo_code_amount;
			$order->total_amount=$total_amount;
			$order->grand_total=$grand_total;
			$order->pay_amount=$pay_amount;
			$order->online_amount=$online_amount;
			$order->delivery_charge=$delivery_charge;
			$order->delivery_charge_id=$delivery_charge_id;
			$order->promo_code_id=$promo_code_id;
			$order->order_type=$order_type;
			$order->discount_percent=$discount_percent;
			$order->status='In Process';
			$order->curent_date=$curent_date;
			$order->get_auto_no=$get_auto_no;
			$order->delivery_date=$delivery_date;
			$order->payment_status=$payment_status;
			$order->order_from=$order_from;
			$order->warehouse_id=$warehouse_id;
			$order->delivery_time=$delivery_time;
			$order->delivery_time_id=$delivery_time_id;
			$order->order_date=$order_date;
			$this->Orders->save($order);
			
			
			
			///////////////////////DELETED CART/////////////////
				$this->loadModel('Carts');
				$query = $this->Carts->query();
				$result = $query->delete()
					->where(['customer_id' => $customer_id])
					->execute(); 
			///////////////////////DELETED CART/////////////////
			
	        //////////WALLET UPDATION///////////////////
			if($wallet_amount>0)
			{
			$wallet_data=$this->Orders->find()->where(['customer_id'=>$customer_id,'transaction_order_no'=>$order_no])
			->first();
			$order_id=$wallet_data->id;
			$wallet_query = $this->Orders->Wallets->query();
					$wallet_query->insert(['order_id', 'consumed', 'customer_id'])
							->values([
							'order_id' => $order_id,
							'consumed' => $wallet_amount,
							'customer_id' => $customer_id
							])
					->execute();
            }
			///////////////////////WALLET UPDATION/////////////////
			
			
	    //////////SMS AND NOTIFICATIONS///////////////////
			
		$get_data = $this->Orders->find()
		->order(['id'=>'DESC'])->where(['jain_thela_admin_id'=>$jain_thela_admin_id, 'customer_id'=>$customer_id])
		->first();
		    $delivery_day_date=date('D M j', strtotime($get_data->delivery_date));
            $order_day_date=date('D M j, Y H:i a', strtotime($get_data->order_date));
            $c_date=$curent_date;
			$d_date=date('Y-m-d', strtotime($get_data->delivery_date));
			
			if($c_date==$d_date)
			{
				$isOrderType='Today';
			}
			else{
				$isOrderType='Next day';
			}
			
			$result=array('order_date'=>$order_day_date,
			'delivery_date'=>$delivery_day_date,
			'order_no'=>$get_data->order_no,
			'pay_amount'=>$get_data->pay_amount,
			'order_type'=>$get_data->order_type,
			'grand_total'=>$get_data->grand_total,
			'order_day'=>$isOrderType
			);
			
					$customer_details=$this->Orders->Customers->find()
					->where(['Customers.id' => $customer_id])->first();
					$mobile=$customer_details->mobile;
					$API_ACCESS_KEY=$customer_details->notification_key;
					$device_token=$customer_details->device_token;
					$device_token1=rtrim($device_token);
                    $time1=date('Y-m-d G:i:s');
					
					if(!empty($device_token1))
					{
					
	$msg = array
	(
	'message' 	=> 'Thank You, your order place successfully',
	'image' 	=> '',
	'button_text'	=> 'Track Your Order',
    'link' => 'jainthela://track_order?id='.$get_data->id,	
    'notification_id'	=> 1,
	);

$url = 'https://fcm.googleapis.com/fcm/send';
$fields = array
(
	'registration_ids' 	=> array($device_token1),
	'data'			=> $msg
);
$headers = array
(
	'Authorization: key=' .$API_ACCESS_KEY,
	'Content-Type: application/json'
);

  //echo json_encode($fields);
  $ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
$result001 = curl_exec($ch);
if ($result001 === FALSE) {
	die('FCM Send Error: ' . curl_error($ch));
}
curl_close($ch);
					}  
									
					if($get_data->driver_id>0)
					{
					$driver_warehouse_details=$this->Orders->Drivers->find()
					->where(['Drivers.id' => $driver_id])->first();
					$API_ACCESS_KEY1=$driver_warehouse_details->notification_key;
					$exact_device_token=$driver_warehouse_details->device_token;
					$device_token0=rtrim($device_token1);
                    }
					else if(($get_data->warehouse_id>0))
					{
					$driver_warehouse_details=$this->Orders->Warehouses->find()
					->where(['Warehouses.id' => $get_data->warehouse_id])->first();
					$API_ACCESS_KEY1=$driver_warehouse_details->notification_key;
					$exact_device_token=$driver_warehouse_details->device_token;
					$device_token0=rtrim($device_token1);
					}
					
					
					$customer_address_details=$this->Orders->CustomerAddresses->find()
					->where(['CustomerAddresses.id' => $get_data->customer_address_id])->first();
					$mobile_no=$customer_address_details->mobile;
					$billing_address=$customer_address_details->address;
					$billing_name=$customer_address_details->name;
					$billing_locality=$customer_address_details->locality;
					$billing_house_no=$customer_address_details->house_no;
			
	if(!empty($exact_device_token))
	{
			$msg = array
	(
	'title' 	=> 'Jainthela',
	'Message'	=> 'hello supplier',
	'billing_address'	=> $billing_house_no.', '.$billing_address.', ' .$billing_locality,
       'billing_name'	=> $billing_name,
	'order_no'	=> $get_data->order_no,
	'delivery_date'	=> $delivery_day_date,
	'id'	=> $get_data->id,
	'session_id'	=> $get_data->customer_id,
	'time'	=> $time1,
	'vibrate'	=> 1,
	'sound'		=> 1,
	);

$fields = array
(
	'registration_ids' 	=> array($exact_device_token),
	'data'			=> array("msg" =>$msg)
);
$headers = array
(
	'Authorization: key=' .$API_ACCESS_KEY1,
	'Content-Type: application/json'
);

$ch = curl_init();
curl_setopt( $ch,CURLOPT_URL, 'https://android.googleapis.com/gcm/send' );
curl_setopt( $ch,CURLOPT_POST, true );
curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode($fields) );
$result121 = curl_exec($ch );
curl_close($ch);
	}	 	$sms=str_replace(' ', '+', 'Thank You, Your order placed successfully. order no. is: '.$get_data->order_no.'. 
				Your order will be delivered on '.$delivery_day_date.' at '.$get_data->delivery_time.'. Bill Amount '.$pay_amount.' Please note amount of order may vary depending on the actual quantity delivered to you.');
				$working_key='A7a76ea72525fc05bbe9963267b48dd96';
				$sms_sender='JAINTE';
				$sms=str_replace(' ', '+', $sms);
				file_get_contents('http://alerts.sinfini.com/api/web2sms.php?workingkey='.$working_key.'&sender='.$sms_sender.'&to='.$mobile.'&message='.$sms.'');
				file_get_contents('http://alerts.sinfini.com/api/web2sms.php?workingkey='.$working_key.'&sender='.$sms_sender.'&to='.$mobile_no.'&message='.$sms.'');

	    /////SMS AND NOTIFICATIONS///////////////////
		$status=true;
		$error="Thank You, Your order has been placed.";
        $this->set(compact('status', 'error','result'));
        $this->set('_serialize', ['status', 'error', 'result']);
    }
	
	public function pendingOrderList()
    {
		$jain_thela_admin_id=$this->request->query('jain_thela_admin_id');
		$driver_warehouse_id=$this->request->query('driver_warehouse_id');
		$is_login=$this->request->query('is_login');
		
		if($is_login=='warehouse')
		{
		$pending_order_data = $this->Orders->find()
						->where(['Orders.warehouse_id' => $driver_warehouse_id, 'Orders.jain_thela_admin_id' => $jain_thela_admin_id, 'Orders.status' =>'In Process'])
						->order(['order_date' => 'DESC'])
						->contain(['Customers','CustomerAddresses','OrderDetails'=>function($q){
							return $q->contain(['Items'])->limit(1);
						}])
						->autoFields(true);
						
					foreach($pending_order_data as $data)
					{
						if(!$data->customer_address){
							$data->customer_address=(object)[];
						}
						
						$data->created_date=date('D M j, Y H:i a', strtotime($data->order_date));
						$data->order_date=date('D M j, Y H:i a', strtotime($data->order_date));
                        $data->delivery_date=date('D M j, Y H:i a', strtotime($data->delivery_date)); 

					}
		
						
		foreach($pending_order_data as $order){
			$order->image_url='http://app.jainthela.in'.$this->request->webroot.'img/item_images/'.@$order->order_details[0]->item->image;
			unset($order->order_details);
		}	
		}
		else if($is_login=='driver')
		{
		
		$pending_order_data = $this->Orders->find()
						->select(['created_date' => $this->Orders->find()->func()->concat(['order_date' => 'identifier' ])])
						->where(['Orders.driver_id' => $driver_warehouse_id, 'Orders.jain_thela_admin_id' => $jain_thela_admin_id, 'Orders.status NOT IN' => array('Cancel','Delivered') ])
						->order(['order_date' => 'DESC'])
						->contain(['Customers','CustomerAddresses','OrderDetails'=>function($q){
							return $q->contain(['Items'])->limit(1);
						}])
						->autoFields(true);
						
					foreach($pending_order_data as $data)
					{
						$data->created_date=date('D M j, Y H:i a', strtotime($data->order_date));
						$data->order_date=date('D M j, Y H:i a', strtotime($data->order_date));
                        $data->delivery_date=date('D M j, Y H:i a', strtotime($data->delivery_date)); 

					}
						
						
		foreach($pending_order_data as $order){
			$order->image_url='http://app.jainthela.in'.$this->request->webroot.'img/item_images/'.@$order->order_details[0]->item->image;
			unset($order->order_details);
		}	
		}
		

		$status=true;
		$error="";
        $this->set(compact('status', 'error','pending_order_data'));
        $this->set('_serialize', ['status', 'error','pending_order_data']);
    }
	
	public function viewMyPendingOrder()
    {
		$jain_thela_admin_id=$this->request->query('jain_thela_admin_id');
		$customer_id=$this->request->query('customer_id');
		$order_id=$this->request->query('order_id');
		
		

              
		
		$view_pending_details_data = $this->Orders->get($order_id, ['contain'=>['OrderDetails'=>['Items'=>function($q){
			 return $q->select(['image_path' => $q->func()->concat(['http://app.jainthela.in'.$this->request->webroot.'img/item_images/','image' => 'identifier' ])])
			   ->contain('Units')
			   ->autoFields(true);
			}]]]);
			
			
		$view_pending_details_data->curent_date=date('D M j, Y H:i a', strtotime($view_pending_details_data->curent_date));
	 	$view_pending_details_data->order_date=date('D M j, Y H:i a', strtotime($view_pending_details_data->order_date));
	    $view_pending_details_data->delivery_date=date('D M j, Y H:i a', strtotime($view_pending_details_data->delivery_date));
			
		$details=$view_pending_details_data->order_details;
		$i=0;
		$minimum_value=1;
		foreach($details as $carts_data_fetch)
			{
			$exact_amount=$minimum_value/$carts_data_fetch->item->minimum_quantity_factor*$carts_data_fetch->rate;
			$carts_data_fetch->exact_amount=$exact_amount;
			}

		 $c_a_id=$view_pending_details_data->customer_address_id;
		 $customer_addresses1=$this->Orders->CustomerAddresses->find()
		->where(['CustomerAddresses.customer_id' => $customer_id, 'CustomerAddresses.id'=>$c_a_id])->first();
		

		$customer_addresses1->address = $customer_addresses1->house_no.' '.$customer_addresses1->landmark.' '.$customer_addresses1->address.', '.$customer_addresses1->locality;
			

	if(empty($customer_addresses1))
		{
			$customer_addresses=(object)[];
		}
		else{
			$customer_addresses=$customer_addresses1;
		}
		
		
		
		//(object)[]
		
		
		 $customer_details=$this->Orders->Customers->find()
		->where(['Customers.id' => $customer_id])->first();
		
		$cancellation_reasons=$this->Orders->CancelReasons->find();
		
		$status=true;
		$error="";
        $this->set(compact('status', 'error','view_pending_details_data','customer_details','customer_addresses','cancellation_reasons'));
        $this->set('_serialize', ['status', 'error', 'view_pending_details_data','customer_details','customer_addresses','cancellation_reasons']);
    }
	
	public function driverBilling()
    {
		//$jain_thela_admin_id=$this->request->data('jain_thela_admin_id');
		//$item_id=$this->request->data('item_id');
		$id=$this->request->data('id');//[]//
		$quantity=$this->request->data('quantity');//[]//
		$amount=$this->request->data('amount');//[]//
		$total_amount=$this->request->data('total_amount');
		$pay_amount=$this->request->data('pay_amount');
		$delivery_charge=$this->request->data('delivery_charge');
		//$driver_id=$this->request->data('driver_id');
		$order_id=$this->request->data('order_id');
		
		$total_ids=sizeof($id);
		
		
		
		$grand_total=$total_amount+$delivery_charge;
		$fetchs=$this->Orders->find()->where(['id' =>$order_id])->first();
			$query = $this->Orders->query();
				$result = $query->update()
                    ->set(['total_amount' => $total_amount, 'grand_total' => $grand_total, 'pay_amount' => $pay_amount])
                    ->where(['id' => $order_id])
                    ->execute();
		
		
		for($i=0; $i<$total_ids; $i++)
		{
		       $order_details_id=$id[$i];
               $item_quantity=$quantity[$i];
               $item_amount=$amount[$i];			   
			$querys = $this->Orders->OrderDetails->query();
				$results = $querys->update()
                    ->set(['actual_quantity' => $item_quantity, 'amount' => $item_amount])
                    ->where(['id' => $order_details_id])
                    ->execute();
		}
	
		$Order_details = $this->Orders->get($order_id, ['contain'=>['OrderDetails'=>['Items'=>function($q){
               return $q->select(['image_path' => $q->func()->concat(['http://app.jainthela.in'.$this->request->webroot.'img/item_images/','image' => 'identifier' ])])->contain('Units')->autoFields(true);
			}]]]);	
			
			$order_detail_fetch=$this->Orders->get($order_id);
			$customer_id=$order_detail_fetch->customer_id;
			 $customer_details=$this->Orders->Customers->find()
                    ->where(['Customers.id' => $customer_id])->first();
                    $mobile=$customer_details->mobile;
                    $API_ACCESS_KEY=$customer_details->notification_key;
                    $device_token=$customer_details->device_token;
                    $device_token1=rtrim($device_token);
                    $time1=date('Y-m-d G:i:s');

    if(!empty($device_token1))
    {

    $msg = array
    (
    'message'     => 'Your order has been ready to delivery',
    'image'     => '',
    'button_text'    => 'Track Your Order',
    'link' => 'jainthela://track_order?id='.$order_id,
    'notification_id'    => 1,
    );

$url = 'https://fcm.googleapis.com/fcm/send';
$fields = array
(
    'registration_ids'     => array($device_token1),
    'data'            => $msg
);
$headers = array
(
    'Authorization: key=' .$API_ACCESS_KEY,
    'Content-Type: application/json'
);

  //echo json_encode($fields);
  $ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
$result001 = curl_exec($ch);
if ($result001 === FALSE) {
    die('FCM Send Error: ' . curl_error($ch));
}
curl_close($ch);
        }
			
			
			
		$status=true;
		$error="Thank You";
        $this->set(compact('status', 'error','Order_details'));
        $this->set('_serialize', ['status', 'error','Order_details']);
    }
	
	public function itemCancel()
    {
		//$jain_thela_admin_id=$this->request->query('jain_thela_admin_id');
		$mainid=$this->request->query('id');
		$order_id=$this->request->query('order_id');
		    
			
            $detail_amount=$this->Orders->OrderDetails->find()
			->where(['id' => $mainid])->first();
			$amount=$detail_amount->amount;
				$query = $this->Orders->OrderDetails->query();
				$result = $query->delete()
					->where(['id' => $mainid])
					->execute(); 			
					
			$order_data=$this->Orders->find()
			->where(['id' => $order_id])->first();
			
			$total_amount=$order_data->total_amount-$amount;
            $grand_total=$total_amount+$order_data->delivery_charge;
			$pay_amount=($grand_total) - (($order_data->amount_from_wallet) + ($order_data->amount_from_jain_cash) + ($order_data->amount_from_promo_code) + ($order_data->online_amount));
			
			if($pay_amount>=0)
			{
			$paid_amount=$pay_amount;
			//update order amount in order//
			$querys = $this->Orders->query();
						 $results = $querys->update()
						->set(['total_amount'=>$total_amount, 
						'grand_total'=>$grand_total, 'pay_amount'=>$paid_amount])
						->where(['id' => $order_id])
						->execute();
			}
			else{
				$paid_amount=0;
				$add_amount=str_replace('-','',$pay_amount);
				if($order_data->amount_from_wallet>0 && $order_data->online_amount==0)
				{
					$minus_from_wallet=$order_data->amount_from_wallet-$add_amount;
					if($minus_from_wallet>=0)
					{
						$add_from_wallet=$minus_from_wallet;  
						//update wallet amount in order - $add_from_wallet//
						//update wallet amount in wallet - $add_from_wallet//
						 $querys = $this->Orders->query();
						 $results = $querys->update()
						->set(['amount_from_wallet' => $add_from_wallet, 'total_amount'=>$total_amount, 
						'grand_total'=>$grand_total, 'pay_amount'=>$paid_amount])
						->where(['id' => $order_id])
						->execute();
						
						if($add_from_wallet>0)
						{
						$wallet_query = $this->Orders->Wallets->query();
						$result_1 = $wallet_query->update()
						->set(['consumed' => $add_from_wallet])
						->where(['Wallets.order_id' => $order_id])
						->execute();	
						}
						else{
							$wallet_query = $this->Orders->Wallets->query();
						$result_1 = $wallet_query->delete()
						->where(['Wallets.order_id' => $order_id])
						->execute();
						}

					}
					else{
					$add_from_wallet=0;
					//update wallet amount in order - $add_from_wallet//
					$querys = $this->Orders->query();
						 $results = $querys->update()
						->set(['amount_from_wallet' => $add_from_wallet, 'total_amount'=>$total_amount, 
						'grand_total'=>$grand_total, 'pay_amount'=>$paid_amount])
						->where(['id' => $order_id])
						->execute();
					
					$new_add_from_wallet=str_replace('-','',$minus_from_wallet);
					
					//delete wallet entry amount in wallet - via order_id//	
                       $wallet_query = $this->Orders->Wallets->query();
						$result_1 = $wallet_query->delete()
						->where(['Wallets.order_id' => $order_id])
						->execute();					
					}
				}
				else if($order_data->amount_from_wallet==0 && $order_data->online_amount>0)
				{
					$add_from_online=$order_data->online_amount-$add_amount;
					//update online amount in order - $add_from_online//
					$querys = $this->Orders->query();
						 $results = $querys->update()
						->set(['total_amount'=>$total_amount, 
						'grand_total'=>$grand_total, 'pay_amount'=>$paid_amount, 'online_amount'=>$add_from_online])
						->where(['id' => $order_id])
						->execute();
					
					//insert wallet amount in wallet - $add_amount//
					
					$wallet_query = $this->Orders->Wallets->query();
					$wallet_query->insert(['plan_id', 'advance', 'customer_id','cancel_to_wallet_online'])
							->values([
							'plan_id' => 19,
							'advance' => $add_amount,
							'customer_id' => $order_data->customer_id,
							'cancel_to_wallet_online'=> 'added',
							])
					->execute();
				}
				else if($order_data->amount_from_wallet>0 && $order_data->online_amount>0)
				{
					$minus_from_wallet=$order_data->amount_from_wallet-$add_amount;
					if($minus_from_wallet>=0)
					{
					$add_from_wallet=$minus_from_wallet;  
					//update wallet amount in order - $add_from_wallet//
					//update wallet amount in wallet - $add_from_wallet//
					
					
					 $querys = $this->Orders->query();
						 $results = $querys->update()
						->set(['amount_from_wallet' => $add_from_wallet, 'total_amount'=>$total_amount, 
						'grand_total'=>$grand_total, 'pay_amount'=>$paid_amount])
						->where(['id' => $order_id])
						->execute();
						
						if($add_from_wallet>0)
						{
						$wallet_query = $this->Orders->Wallets->query();
						$result_1 = $wallet_query->update()
						->set(['consumed' => $add_from_wallet])
						->where(['Wallets.order_id' => $order_id])
						->execute();	
						}
						else{
							$wallet_query = $this->Orders->Wallets->query();
						$result_1 = $wallet_query->delete()
						->where(['Wallets.order_id' => $order_id])
						->execute();
						}					
					}
					else{
					$add_from_wallet=0;
					//update wallet amount in order - $add_from_wallet//
					$new_add_from_wallet=str_replace('-','',$minus_from_wallet);
					$add_from_online=$order_data->online_amount-$new_add_from_wallet;
					//update online amount in order - $add_from_online//
					
					     $querys = $this->Orders->query();
						 $results = $querys->update()
						->set(['amount_from_wallet' => $add_from_wallet, 'total_amount'=>$total_amount, 
						'grand_total'=>$grand_total, 'pay_amount'=>$paid_amount, 'online_amount'=>$add_from_online])
						->where(['id' => $order_id])
						->execute();

                        //delete wallet entry amount in wallet - via order_id//							
						$wallet_query = $this->Orders->Wallets->query();
						$result_1 = $wallet_query->delete()
						->where(['Wallets.order_id' => $order_id])
						->execute();
						
					//insert wallet amount in wallet - $new_add_from_wallet//
					$wallet_query = $this->Orders->Wallets->query();
					$wallet_query->insert(['plan_id', 'advance', 'customer_id','cancel_to_wallet_online'])
							->values([
							'plan_id' => 19,
							'advance' => $new_add_from_wallet,
							'customer_id' => $order_data->customer_id,
							'cancel_to_wallet_online'=> 'added',
							])
					->execute();
									
					}
				}
			}
			
		$status=true;
		$error="Item Cancelled.";
        $this->set(compact('status', 'error'));
        $this->set('_serialize', ['status', 'error']);
    }	
	
}
