<?php
namespace App\Controller\Api;
use App\Controller\Api\AppController;
class OrdersController extends AppController
{
    public function trackOrder()
    {
		$jain_thela_admin_id=$this->request->query('jain_thela_admin_id');
		$customer_id=$this->request->query('customer_id');
		
		$orders = $this->Orders->find()->where(['customer_id' => $customer_id, 'jain_thela_admin_id' => $jain_thela_admin_id, 'status NOT IN' => array('Cancel','Delivered') ])->order(['order_date' => 'DESC']);
	
		$status=true;
		$error="";
        $this->set(compact('status', 'error','orders'));
        $this->set('_serialize', ['status', 'error', 'orders']);
    }
	
	public function viewMyTrackOrder()
    {
		$jain_thela_admin_id=$this->request->query('jain_thela_admin_id');
		$customer_id=$this->request->query('customer_id');
		$order_id=$this->request->query('order_id');
		
		$orders = $this->Orders->get($order_id, ['contain'=>['OrderDetails'=>['Items'=>['Units']]]]);
		 pr($orders->toArray());
		 exit;
		$status=true;
		$error="";
        $this->set(compact('status', 'error','carts'));
        $this->set('_serialize', ['status', 'error', 'carts']);
    }

}
