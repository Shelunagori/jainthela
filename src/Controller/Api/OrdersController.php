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
}
