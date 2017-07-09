<?php
namespace App\Controller\Api;
use App\Controller\Api\AppController;
class ItemSubCategoriesController extends AppController
{
    public function itemsubcategory()
    {
		$jain_thela_admin_id=$this->request->query('jain_thela_admin_id');
		$item_category_id=$this->request->query('item_category_id');
		$customer_id=$this->request->query('customer_id');

		
        $item_sub_category = $this->ItemSubCategories->find()
		->where(['ItemSubCategories.item_category_id'=>$item_category_id])->toArray();
		
		
		$item_sub_category[]=array('id'=>0, 'item_category_id'=>$item_category_id, 'name'=>'All');
		
		
		sort($item_sub_category);
		$cart_count = $this->ItemSubCategories->Carts->find('All')->where(['Carts.customer_id'=>$customer_id])->count();
		
		
		
		$status=true;
		if(sizeof($item_sub_category)==1){
			$status=false;
		}
		$error="";
        $this->set(compact('status', 'error', 'item_sub_category','cart_count'));
        $this->set('_serialize', ['status', 'error', 'item_sub_category','cart_count']);
    }
}
