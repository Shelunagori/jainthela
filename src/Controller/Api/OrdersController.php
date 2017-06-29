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
						->select(['created_date' => $this->Orders->find()->func()->concat(['order_date' => 'identifier' ])])
						->select(['image_url' => $this->Orders->find()->func()->concat(['http://13.126.58.104'.$this->request->webroot.'img/item_images/no_image.png'])])
						->where(['customer_id' => $customer_id, 'jain_thela_admin_id' => $jain_thela_admin_id, 'status NOT IN' => array('Cancel','Delivered') ])
						->order(['order_date' => 'DESC'])
						->autoFields(true);
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
		->select(['created_date' => $this->Orders->find()->func()->concat(['order_date' => 'identifier' ])])
		->select(['image_url' => $this->Orders->find()->func()->concat(['http://13.126.58.104'.$this->request->webroot.'img/item_images/no_image.png'])])
		->where(['customer_id' => $customer_id, 'jain_thela_admin_id' => $jain_thela_admin_id, 'status' => 'Delivered' ])->order(['order_date' => 'DESC'])
		->autoFields(true);
		 
		/* foreach($orders_data as $orders_data_fetch){
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
		} */
		//echo $order_id=$orders_data->id;
 		$status=true;
		$error="";
        $this->set(compact('status', 'error','orders_data'));
        $this->set('_serialize', ['status', 'error', 'orders_data']);
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
		$order = $this->Orders->newEntity();
		
		
		
		
		if($place_order=='yes'){
			
		$payable_amount=$total_amount-($wallet_amount+$jain_cash_amount);
		
			$last_order_no = $this->Orders->find()->select(['order_no'])->order(['order_no'=>'DESC'])->where(['jain_thela_admin_id'=>$jain_thela_admin_id])->first();
			if(!empty($last_order_no)){
				$order_no = $last_order_no->order_no+1;
			}else{
				$order_no=1;
			}
			$this->loadModel('Carts');
		$carts_data=$this->Carts->find()->where(['customer_id'=>$customer_id])->contain(['Items']);
		
		$i=0;
			foreach($carts_data as $carts_data_fetch)
			{
				
				$amount=$carts_data_fetch->quantity*$carts_data_fetch->item->sales_rate;
				
				$this->request->data['order_details'][$i]['item_id']=$carts_data_fetch->item_id;
				$this->request->data['order_details'][$i]['quantity']=$carts_data_fetch->quantity;
				$this->request->data['order_details'][$i]['rate']=$carts_data_fetch->item->sales_rate;
				$this->request->data['order_details'][$i]['amount']=$amount;
				$i++;
			}
			$order = $this->Orders->patchEntity($order, $this->request->data());
			
			$order->order_no=$order_no;
			$this->Orders->save($order);
			
			
				$this->loadModel('Carts');
				$query = $this->Carts->query();
				$result = $query->delete()
					->where(['customer_id' => $customer_id])
					->execute();
			
		}
	
		$status=true;
		$error="";
        $this->set(compact('status', 'error','orders_data', 'order_type'));
        $this->set('_serialize', ['status', 'error', 'orders_data', 'order_type']);
    }
}
