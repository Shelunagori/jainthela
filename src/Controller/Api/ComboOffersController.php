<?php
namespace App\Controller\Api;
use App\Controller\Api\AppController;
class ComboOffersController extends AppController
{
	public function comboOfferList()
    {
		$jain_thela_admin_id=$this->request->query('jain_thela_admin_id');
		$customer_id=$this->request->query('customer_id');
		
		$combo_lists = $this->ComboOffers->Items->find()->where(['jain_thela_admin_id' => $jain_thela_admin_id, 'is_combo' => 'yes' ]);
		
		$combo_lists->select(['image_url' => $combo_lists->func()->concat(['http://localhost'.$this->request->webroot.'img/item_images/','image' => 'identifier' ])])
             ->autoFields(true);
			 
		$cart_count = $this->ComboOffers->Carts->find('All')->where(['Carts.customer_id'=>$customer_id])->count();

		$status=true;
		$error="";
        $this->set(compact('status', 'error','cart_count','combo_lists'));
        $this->set('_serialize', ['status', 'error','cart_count','combo_lists']);
    }

	public function comboOfferView()
    {
		$combo_offer_id=$this->request->query('combo_offer_id');
		$customer_id=$this->request->query('customer_id');
		$combo_views = $this->ComboOffers->ComboOfferDetails->find()->where(['ComboOfferDetails.combo_offer_id' => $combo_offer_id])->contain(['Items'=>['Units']]);
		
		$cart_count = $this->ComboOffers->Carts->find('All')->where(['Carts.customer_id'=>$customer_id])->count();

		$status=true;
		$error="";
        $this->set(compact('status', 'error','combo_views','cart_count'));
        $this->set('_serialize', ['status', 'error', 'combo_views','cart_count']);
    }

}