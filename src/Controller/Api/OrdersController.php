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
						->where(['customer_id' => $customer_id, 'jain_thela_admin_id' => $jain_thela_admin_id, 'status NOT IN' => array('Cancel','Delivered') ])
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
               return $q->select(['image_path' => $q->func()->concat(['htp://app.jainthela.in'.$this->request->webroot.'img/item_images/','image' => 'identifier' ])])->contain('Units')->autoFields(true);
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
		->where(['customer_id' => $customer_id, 'jain_thela_admin_id' => $jain_thela_admin_id, 'status' => 'Delivered' ])
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
		$cancel_id=$this->request->query('cancel_id');
				$order_cancel = $this->Orders->query();
					$result = $order_cancel->update()
						->set(['status' => 'Cancel',
						'cancel_id' => $Cancel_id])
						->where(['id' => $order_id])
						->execute();
		
		$status=true;
		$error="Thank you, your order has been cancelled.";
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
		$delivery_charge=$this->request->data('delivery_charge');
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
		
						
		        $out_of_stock_data=$this->Orders->Carts->find()->where(['customer_id' => $customer_id]);
        		$counts=0;
				foreach($out_of_stock_data as $fetch_data)
				{
					$item_id=$fetch_data->item_id;
					$out_data=$this->Orders->Carts->Items->get($item_id);
					$d=$out_data->out_of_stock;
					$counts+=$d;
				}
				
		if($counts>0)
		{
		    $delivery_date=date('Y-m-d', strtotime('+1 day', strtotime($curent_date)));//delivery_date///
        }
		else{
			
			$delivery_date=date('Y-m-d');//delivery_date///
		}
		
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
			$this->Orders->save($order);
			
			
			
				$this->loadModel('Carts');
				$query = $this->Carts->query();
				$result = $query->delete()
					->where(['customer_id' => $customer_id])
					->execute(); 
			
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
						->where(['Orders.warehouse_id' => $driver_warehouse_id, 'Orders.jain_thela_admin_id' => $jain_thela_admin_id, 'Orders.status NOT IN' => array('Cancel','Delivered') ])
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
               return $q->select(['image_path' => $q->func()->concat(['htp://app.jainthela.in'.$this->request->webroot.'img/item_images/','image' => 'identifier' ])])->contain('Units')->autoFields(true);
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
		 $customer_addresses=$this->Orders->CustomerAddresses->find()
		->where(['CustomerAddresses.customer_id' => $customer_id, 'CustomerAddresses.id'=>$c_a_id])->first();
		
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
               return $q->select(['image_path' => $q->func()->concat(['htp://app.jainthela.in'.$this->request->webroot.'img/item_images/','image' => 'identifier' ])])->contain('Units')->autoFields(true);
			}]]]);	
			
			
		$status=true;
		$error="Thank You";
        $this->set(compact('status', 'error','Order_details'));
        $this->set('_serialize', ['status', 'error','Order_details']);
    }
}
