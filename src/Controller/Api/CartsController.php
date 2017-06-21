<?php
namespace App\Controller\Api;
use App\Controller\Api\AppController;
class CartsController extends AppController
{
    public function plusAddToCart()
    {
		$jain_thela_admin_id=$this->request->query('jain_thela_admin_id');
		$item_id=$this->request->query('item_id');
		$quantity=$this->request->query('quantity');
		$customer_id=$this->request->query('customer_id');
		$action_status=$this->request->query('action_status');
		$items = $this->Carts->Items->get($item_id);
		$item_add_quantity=$items->minimum_quantity_factor;
		$fetchs=$this->Carts->find()->where(['customer_id' => $customer_id, 'item_id' =>$item_id]);
		foreach($fetchs as $fetch){
			$update_id=$fetch->id;
			$old_quantity=$fetch->quantity;
		}
		if($action_status=='inc'){
			$update_quantity=$old_quantity+$item_add_quantity;
		}
		if($action_status=='dec'){
			$update_quantity=$old_quantity-$item_add_quantity;
		}
		if(empty($fetchs->toArray()))
		{
			$query = $this->Carts->query();
					$query->insert(['customer_id', 'item_id', 'quantity'])
							->values([
							'customer_id' => $customer_id,
							'item_id' => $item_id,
							'quantity' => $quantity
							])
					->execute();
		}else{
			
			$query = $this->Carts->query();
				$result = $query->update()
                    ->set(['quantity' => $update_quantity])
                    ->where(['id' => $update_id])
                    ->execute();			
		}
		pr($fetchs->toArray());
		exit;
		$status=true;
		$error="";
        $this->set(compact('status', 'error', 'items'));
        $this->set('_serialize', ['status', 'error', 'items']);
    }

	 public function item_description()
    {
		$jain_thela_admin_id=$this->request->query('jain_thela_admin_id');
		$item_id=$this->request->query('item_id');
        $items = $this->Items->find()
		->where(['Items.jain_thela_admin_id'=>$jain_thela_admin_id, 'Items.id'=>$item_id])
		->contain('ItemCategories', 'Units');
		$status=true;
		$error="";
        $this->set(compact('status', 'error', 'items', 'ItemCategories'));
        $this->set('_serialize', ['status', 'error', 'items', 'ItemCategories']);
    }
	
	
	
	
	
}
