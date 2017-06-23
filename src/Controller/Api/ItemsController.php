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
		$items->select(['image_url' => $items->func()->concat(['http://13.126.58.104'.$this->request->webroot.'img/item_images/','image' => 'identifier' ])])
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
		$item_description->select(['image_url' => $item_description->func()->concat(['http://13.126.58.104'.$this->request->webroot.'img/item_images/','image' => 'identifier' ])])
             ->autoFields(true);


$querys=$this->Items->ItemLedgers->find();
				$customer_also_bought=$querys
						->select(['total_rows' => $querys->func()->count('ItemLedgers.id'),'item_id',])
						->where(['inventory_transfer'=>'no','status'=>'out'])
						->group(['ItemLedgers.item_id'])
						->order(['total_rows'=>'DESC'])
						->limit(5)
						->contain(['Items'=>function($q){
						return $q->select(['name', 'image', 'sales_rate','minimum_quantity_factor','ready_to_sale', 'out_of_stock', 'print_rate', 'print_quantity', 'discount_per'])
						->contain(['Units'=>function($q){
						return $q->select(['longname','shortname']);
						}]);
						}]);
						$customer_also_bought->select(['image_url' => $customer_also_bought->func()->concat(['http://13.126.58.104'.$this->request->webroot.'img/item_images/','image' => 'identifier' ])]);
		
						$cart_count = $this->Items->Carts->find('All')->where(['Carts.customer_id'=>$customer_id])->count();

			 
		$status=true;
		$error="";
        $this->set(compact('status', 'error', 'item_description', 'customer_also_bought'));
        $this->set('_serialize', ['status', 'error', 'item_description', 'customer_also_bought']);
    }
	
}
