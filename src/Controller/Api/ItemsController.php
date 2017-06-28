<?php
namespace App\Controller\Api;
use App\Controller\Api\AppController;
class ItemsController extends AppController
{
    public function item()
    {
		$jain_thela_admin_id=$this->request->query('jain_thela_admin_id');
		$item_category_id=$this->request->query('item_category_id');
		$item_sub_category_id=$this->request->query('item_sub_category_id');
		$customer_id=$this->request->query('customer_id');

		if($item_sub_category_id=='0')
		{
			$items = $this->Items->find()->where(['Items.jain_thela_admin_id'=>$jain_thela_admin_id, 'Items.item_category_id'=>$item_category_id])->contain(['Units','Carts'=>function($q) use($customer_id){
				return $q->where(['customer_id'=>$customer_id]);
			}]);
			$items->select(['image_url' => $items->func()->concat(['http://13.126.58.104'.$this->request->webroot.'img/item_images/','image' => 'identifier' ])])
                                ->autoFields(true);

		}
		else{
			
			$items = $this->Items->find()->where(['Items.jain_thela_admin_id'=>$jain_thela_admin_id, 'Items.item_category_id'=>$item_category_id, 'Items.item_sub_category_id'=>$item_sub_category_id])->contain(['Units','Carts']);
		$items->select(['image_url' => $items->func()->concat(['http://13.126.58.104'.$this->request->webroot.'img/item_images/','image' => 'identifier' ])])
                                ->autoFields(true);
		}
        
		$cart_count = $this->Items->Carts->find('All')->where(['Carts.customer_id'=>$customer_id])->count();
		$status=true;
		$error="";
        $this->set(compact('status', 'error', 'items','cart_count'));
        $this->set('_serialize', ['status', 'error', 'items','cart_count']);
    }

	 public function itemdescription()
    {
		$jain_thela_admin_id=$this->request->query('jain_thela_admin_id');
		$item_id=$this->request->query('item_id');
		$customer_id=$this->request->query('customer_id');
		$item_description = $this->Items->find()
							->select(['image_url' => $this->Items->find()->func()->concat(['http://13.126.58.104'.$this->request->webroot.'img/item_images/','image' => 'identifier' ])])
							->where(['Items.jain_thela_admin_id'=>$jain_thela_admin_id, 'Items.id'=>$item_id])
							->contain(['Units', 'Carts'])
							->autoFields(true)->first();
             
		
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
						return $q->select(['id','longname','shortname','is_deleted','jain_thela_admin_id']);
						}]);
						}]);
						$customer_also_bought->select(['image_url' => $customer_also_bought->func()->concat(['http://13.126.58.104'.$this->request->webroot.'img/item_images/','image' => 'identifier' ])]);
		
						$cart_count = $this->Items->Carts->find('All')->where(['Carts.customer_id'=>$customer_id])->count();
			 
		$status=true;
		$error="";
        $this->set(compact('status', 'error', 'item_description', 'customer_also_bought','cart_count'));
        $this->set('_serialize', ['status', 'error', 'item_description', 'customer_also_bought','cart_count']);
    }
	
	 public function viewAll()
    {
		$jain_thela_admin_id=$this->request->query('jain_thela_admin_id');
		$type=$this->request->query('type');
		$customer_id=$this->request->query('customer_id');

		if($type=='popular')
		{
			$query=$this->Items->ItemLedgers->find();
		$view_items=$query
						->select(['total_rows' => $query->func()->count('ItemLedgers.id'),'item_id',])
						->where(['inventory_transfer'=>'no','status'=>'out'])
						->group(['ItemLedgers.item_id'])
						->order(['total_rows'=>'DESC'])
						->limit(5)
						->contain(['Items'=>function($q){
							return $q->select(['name', 'image', 'sales_rate','minimum_quantity_factor','ready_to_sale', 'out_of_stock', 'print_rate', 'print_quantity', 'discount_per'])
									->contain(['Units'=>function($q){
										return $q->select(['id','longname','shortname','is_deleted','jain_thela_admin_id']);
									},'Carts'=>function($q){
										return $q->select(['cart_count']);
						}]);
						}]);
						$view_items->select(['image_url' => $view_items->func()->concat(['http://13.126.58.104'.$this->request->webroot.'img/item_images/','image' => 'identifier' ])]);
						
		}
		else if($type=='recently')
		{
				$querys=$this->Items->ItemLedgers->find();
				$view_items=$querys
						->select(['total_rows' => $querys->func()->count('ItemLedgers.id'),'item_id',])
						->where(['inventory_transfer'=>'no','status'=>'out'])
						->group(['ItemLedgers.item_id'])
						->order(['total_rows'=>'DESC'])
						->limit(5)
						->contain(['Items'=>function($q){
							return $q->select(['name', 'image', 'sales_rate','minimum_quantity_factor','ready_to_sale', 'out_of_stock', 'print_rate', 'print_quantity', 'discount_per'])
							->contain(['Units'=>function($q){
								return $q->select(['id','longname','shortname','is_deleted','jain_thela_admin_id']);
							},'Carts'=>function($q){
										return $q->select(['cart_count']);
						}]);
						}]);
						$view_items->select(['image_url' => $view_items->func()->concat(['http://13.126.58.104'.$this->request->webroot.'img/item_images/','image' => 'identifier' ])]);
		}
		else if($type='bought')
		{
        $querys=$this->Items->ItemLedgers->find();
				$view_items=$querys
						->select(['total_rows' => $querys->func()->count('ItemLedgers.id'),'item_id',])
						->where(['inventory_transfer'=>'no','status'=>'out'])
						->group(['ItemLedgers.item_id'])
						->order(['total_rows'=>'DESC'])
						->limit(5)
						->contain(['Items'=>function($q){
						return $q->select(['name', 'image', 'sales_rate','minimum_quantity_factor','ready_to_sale', 'out_of_stock', 'print_rate', 'print_quantity', 'discount_per'])
						->contain(['Units'=>function($q){
						                return $q->select(['id','longname','shortname','is_deleted','jain_thela_admin_id']);
						},'Carts'=>function($q){
										return $q->select(['cart_count']);
						}]);
						}]);
						$view_items->select(['image_url' => $view_items->func()->concat(['http://13.126.58.104'.$this->request->webroot.'img/item_images/','image' => 'identifier' ])]);
						
		}
        
		$cart_count = $this->Items->Carts->find('All')->where(['Carts.customer_id'=>$customer_id])->count();
		
		$status=true;
		$error="";
        $this->set(compact('status', 'error','cart_count', 'view_items'));
        $this->set('_serialize', ['status', 'error','cart_count', 'view_items']);
    }
	
	public function searchItem()
    {
		$jain_thela_admin_id=$this->request->query('jain_thela_admin_id');
		$item_query=$this->request->query('item_query');
		$customer_id=$this->request->query('customer_id');

        $search_items = $this->Items->find()
		->where(['Items.jain_thela_admin_id'=>$jain_thela_admin_id, 'Items.name LIKE' => '%'.$item_query.'%'])
		->contain(['Units','Carts']);
		$search_items->select(['image_url' => $search_items->func()->concat(['http://13.126.58.104'.$this->request->webroot.'img/item_images/','image' => 'identifier' ])])
                                ->autoFields(true);
		$status=true;
		$error="";
        $this->set(compact('status', 'error', 'search_items'));
        $this->set('_serialize', ['status', 'error', 'search_items']);
    }

	
}
