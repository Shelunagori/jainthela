<?php
namespace App\Controller\Api;
use App\Controller\Api\AppController;
class ItemsController extends AppController
{
    public function item()
    {
		$jain_thela_admin_id=$this->request->query('jain_thela_admin_id');
		$item_category_id=$this->request->query('item_category_id');
		$customer_id=$this->request->query('customer_id');

        $items = $this->Items->find()->where(['Items.jain_thela_admin_id'=>$jain_thela_admin_id, 'Items.item_category_id'=>$item_category_id])->contain(['Units','Carts']);
		$items->select(['image_url' => $items->func()->concat(['http://13.126.58.104'.$this->request->webroot.'items/','image' => 'identifier' ])])
                                ->autoFields(true);
		$status=true;
		$error="";
        $this->set(compact('status', 'error', 'items'));
        $this->set('_serialize', ['status', 'error', 'items']);
    }

	 public function itemdescription()
    {
		$jain_thela_admin_id=$this->request->query('jain_thela_admin_id');
		$item_id=$this->request->query('item_id');
		$customer_id=$this->request->query('customer_id');
        $item_description = $this->Items->find()
		     ->where(['Items.jain_thela_admin_id'=>$jain_thela_admin_id, 'Items.id'=>$item_id])
		     ->contain(['Units', 'Carts']);
		$item_description->select(['image_url' => $item_description->func()->concat(['http://13.126.58.104'.$this->request->webroot.'items/','image' => 'identifier' ])])
             ->autoFields(true);		
		$status=true;
		$error="";
        $this->set(compact('status', 'error', 'item_description'));
        $this->set('_serialize', ['status', 'error', 'item_description']);
    }
	
}
