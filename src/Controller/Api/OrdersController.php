<?php
namespace App\Controller\Api;
use App\Controller\Api\AppController;
class OrdersController extends AppController
{
    public function trackOrder()
    {
		$jain_thela_admin_id=$this->request->query('jain_thela_admin_id');
		$customer_id=$this->request->query('customer_id');
		
		$orders_data = $this->Orders->find()->where(['customer_id' => $customer_id, 'jain_thela_admin_id' => $jain_thela_admin_id, 'status NOT IN' => array('Cancel','Delivered') ])->order(['order_date' => 'DESC']);
	
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
               return $q->select(['image_path' => $q->func()->concat(['htp://localhost'.$this->request->webroot.'img/item_images/','image' => 'identifier' ])])->contain('Units')->autoFields(true);
			}]]]);
		$created_date=date('D M j, Y H:i a', strtotime($orders_details_data->order_date));
		$orders_details_data->created_date=$created_date;
		$status=true;
		$error="";
        $this->set(compact('status', 'error','orders_details_data'));
        $this->set('_serialize', ['status', 'error', 'orders_details_data']);
    }

	public function myOrder()
    {
		$jain_thela_admin_id=$this->request->query('jain_thela_admin_id');
		$customer_id=$this->request->query('customer_id');
		
		$orders_data = $this->Orders->find()->where(['customer_id' => $customer_id, 'jain_thela_admin_id' => $jain_thela_admin_id, 'status' => 'Delivered' ])->order(['order_date' => 'DESC']);
		 
		foreach($orders_data as $orders_data_fetch){
			 $order_id=$orders_data_fetch->id;
			echo $delivery_date=date('D M j, Y H:i a', strtotime($orders_data_fetch->delivery_date));
			$orders_data->orders_delivery_date=$delivery_date;

		$orders_details_data = $this->Orders->get($order_id, ['contain'=>['OrderDetails'=>['Items'=>function($q){
               return $q->select(['image_path' => $q->func()->concat(['htp://localhost'.$this->request->webroot.'img/item_images/','image' => 'identifier' ])])->contain('Units')->autoFields(true);
			}]]]);
			$order_fetch=$orders_details_data->order_details;
			foreach($order_fetch as $order_fetch_data){
				
				$image=$order_fetch_data->image_path;
			}
			$orders_data->image=$image;
		}
		//echo $order_id=$orders_data->id;
	 
		$status=true;
		$error="";
        $this->set(compact('status', 'error','orders_data', 'image'));
        $this->set('_serialize', ['status', 'error', 'orders_data', 'image']);
    }
	
	 public function placeOrder()
    {
		$jain_thela_admin_id=$this->request->data('jain_thela_admin_id');
		$customer_id=$this->request->data('customer_id');
		$place_order=$this->request->data('place_order');
		$wallet_amount=$this->request->data('wallet_amount');
		$jain_cash_amount=$this->request->data('jain_cash_amount');
		$customer_address_id=$this->request->data('customer_address_id');
		$order_time=$this->request->data('order_time');
		$online_amount=$this->request->data('online_amount');
		$total_amount=$this->request->data('total_amount');
		$promo_code_amount=$this->request->data('promo_code_amount');
		$promo_code_id=$this->request->data('promo_code_id');
		$address_id=$this->request->data('address_id');
		$order_type=$this->request->data('order_type');
		
		if($place_order=='yes'){
			
		$payable_amount=$total_amount-($wallet_amount+$jain_cash_amount);
		$this->loadModel('Carts');
		$carts_data=$this->Carts->find()->where(['customer_id'=>$customer_id]);
			$last_order_no = $this->Orders->find()->select(['order_no'])->order(['order_no'=>'DESC'])->where(['jain_thela_admin_id'=>$jain_thela_admin_id])->first();
			if(!empty($last_order_no)){
				$order_no = $last_order_no->order_no+1;
			}else{
				$order_no=1;
			}
				$query = $this->Orders->query();
					$query->insert(['order_no', 'jain_thela_admin_id', 'customer_id', 'amount_from_wallet', 'amount_from_jain_cash', 'amount_from_promo_code', 'total_amount', 'online_amount', 'promo_code_id', 'pay_amount', 'customer_address_id', 'order_type'])
							->values([
							'order_no' => $order_no,
							'jain_thela_admin_id' => $jain_thela_admin_id,
							'customer_id' => $customer_id,
							'amount_from_wallet' => $wallet_amount,
							'amount_from_jain_cash' => $jain_cash_amount,
							'amount_from_promo_code' => $promo_code_amount,
							'total_amount' => $total_amount,
							'online_amount' => $online_amount,
							'promo_code_id' => $promo_code_id,
							'pay_amount' => $payable_amount,
							'customer_address_id' => $address_id,
							'order_type' => $order_type
							])
					->execute();

					echo $order_id=$query->lastInsertId('Orders');
					exit;
			foreach($carts_data as $carts_data_fetch){
				
				$item_id=$carts_data_fetch->item_id;
				$quantity=$carts_data_fetch->quantity;
				$rate=$carts_data_fetch->rate;
				$amount=$carts_data_fetch->amount;
				
				$query = $this->Orders->OrderDetails->query();
					$query->insert(['order_id', 'item_id', 'quantity', 'rate', 'amount'])
							->values([
							'order_id' => @$order_id,
							'item_id' => $item_id,
							'quantity' => $quantity,
							'rate' => $rate,
							'amount' => $amount
							])
					->execute();
					 	 
			}
				$this->loadModel('Carts');
				$query = $this->Carts->query();
				$result = $query->delete()
					->where(['customer_id' => $customer_id])
					->execute();
			exit;
		}
	
		$status=true;
		$error="";
        $this->set(compact('status', 'error','orders_data', 'order_type'));
        $this->set('_serialize', ['status', 'error', 'orders_data', 'order_type']);
    }
}
