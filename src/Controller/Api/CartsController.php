<?php
namespace App\Controller\Api;
use App\Controller\Api\AppController;
class CartsController extends AppController
{
    public function plusAddToCart()
    {
		$jain_thela_admin_id=$this->request->data('jain_thela_admin_id');
		$item_id=$this->request->data('item_id');
		$quantity=$this->request->data('quantity');
		$customer_id=$this->request->data('customer_id');
		$items = $this->Carts->Items->get($item_id);
		$item_add_quantity=$items->minimum_quantity_factor;
		$fetchs=$this->Carts->find()->where(['customer_id' => $customer_id, 'item_id' =>$item_id]);
		foreach($fetchs as $fetch){
			$update_id=$fetch->id;
		}
		$update_quantity=$item_add_quantity*$quantity;
		if(empty($fetchs->toArray()))
		{
			$query = $this->Carts->query();
					$query->insert(['customer_id', 'item_id', 'quantity', 'cart_count'])
							->values([
							'customer_id' => $customer_id,
							'item_id' => $item_id,
							'quantity' => $update_quantity,
							'cart_count' => $quantity
							])
					->execute();
		}else{
			$cart=$this->Carts->get($update_id);	
			$query = $this->Carts->query();
				$result = $query->update()
                    ->set(['Carts.quantity' => $update_quantity, 'Carts.cart_count' => $quantity])
                    ->where(['id' => $update_id])
                    ->execute();
		}
		$carts=$this->Carts->find()->where(['customer_id' => $customer_id, 'item_id' =>$item_id])->contain(['Items']);
		$status=true;
		$error="";
        $this->set(compact('status', 'error','carts'));
        $this->set('_serialize', ['status', 'error', 'carts']);
    }
	
	public function fetchAddToCart()
    {
		$jain_thela_admin_id=$this->request->data('jain_thela_admin_id');
		$item_id=$this->request->data('item_id');
		$quantity=$this->request->data('quantity');
		$customer_id=$this->request->data('customer_id');
		$tag=$this->request->data('tag');
		if($tag=='add'){
			$items = $this->Carts->Items->get($item_id);
			$item_add_quantity=$items->minimum_quantity_factor;
			$fetchs=$this->Carts->find()->where(['customer_id' => $customer_id, 'item_id' =>$item_id]);
			foreach($fetchs as $fetch){
				$update_id=$fetch->id;
			}
			$update_quantity=$item_add_quantity*$quantity;
			if(empty($fetchs->toArray()))
			{
				$query = $this->Carts->query();
						$query->insert(['customer_id', 'item_id', 'quantity', 'cart_count'])
								->values([
								'customer_id' => $customer_id,
								'item_id' => $item_id,
								'quantity' => $update_quantity,
								'cart_count' => $quantity
								])
						->execute();
			}else{
				$cart=$this->Carts->get($update_id);	
				$query = $this->Carts->query();
					$result = $query->update()
						->set(['Carts.quantity' => $update_quantity, 'Carts.cart_count' => $quantity])
						->where(['id' => $update_id])
						->execute();
			}
			$carts=$this->Carts->find()->where(['customer_id' => $customer_id])->contain(['Items'=>['Units']]);
		}
		else if($tag=='remove'){
			$query = $this->Carts->query();
				$result = $query->delete()
					->where(['item_id' => $item_id, 'customer_id' => $customer_id])
					->execute();
					$carts=$this->Carts->find()->where(['customer_id' => $customer_id])->contain(['Items'=>['Units']]);
		}
		else if($tag=='cart'){
			$carts=$this->Carts->find()->where(['customer_id' => $customer_id])->contain(['Items'=>['Units']]);

		}
		
		$Customers = $this->Carts->Customers->get($customer_id, [
            'contain' => ['JainCashPoints'=>function($query){
				return $query->select([
					'total_point' => $query->func()->sum('point'),
					'total_used_point' => $query->func()->sum('used_point'),'customer_id'
				]);
			},'Wallets'=>function($query){
				return $query->select([
					'total_advance' => $query->func()->sum('advance'),
					'total_consumed' => $query->func()->sum('consumed'),'customer_id',
				]);
			},'Orders'=>function($query){
				return $query->select([
					
					'total_order' => $query->func()->count('customer_id'),'customer_id',
				]);
			}
				]
        ]);
		foreach($Customers->wallets as $Customer_data_wallet){
		  $wallet_total_advance=$Customer_data_wallet->total_advance;
		  $wallet_total_consumed=$Customer_data_wallet->total_consumed;
		  $remaining_wallet_amount=$wallet_total_advance-$wallet_total_consumed;
		}
		foreach($Customers->jain_cash_points as $Customer_data_jain_cash){
		  $jain_cash_total_point=$Customer_data_jain_cash->total_point;
		  $jain_cash_total_used_point=$Customer_data_jain_cash->total_consumed;
		  $remaining_jain_cash_point=$jain_cash_total_point-$jain_cash_total_used_point;

		}
		$status=true;
		$error="";
        $this->set(compact('status', 'error', 'remaining_wallet_amount', 'remaining_jain_cash_point', 'carts'));
        $this->set('_serialize', ['status', 'error', 'remaining_wallet_amount', 'remaining_jain_cash_point', 'carts']);
    }

}
