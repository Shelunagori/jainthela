<?php
namespace App\Controller\Api;
use App\Controller\Api\AppController;
class ComboOffersController extends AppController
{
	public function comboOfferList()
    {
		$jain_thela_admin_id=$this->request->query('jain_thela_admin_id');
		
		$combo_lists = $this->ComboOffers->Items->find()->where(['jain_thela_admin_id' => $jain_thela_admin_id, 'is_combo' => 'yes' ]);
		
		$combo_lists->select(['image_url' => $combo_lists->func()->concat(['http://localhost'.$this->request->webroot.'img/item_images/','image' => 'identifier' ])])
             ->autoFields(true);
		$status=true;
		$error="";
        $this->set(compact('status', 'error','combo_lists'));
        $this->set('_serialize', ['status', 'error', 'combo_lists']);
    }

	public function comboOfferView()
    {
		$combo_offer_id=$this->request->query('combo_offer_id');
		$combo_views = $this->ComboOffers->ComboOfferDetails->find()->where(['ComboOfferDetails.combo_offer_id' => $combo_offer_id])->contain(['Items'=>['Units']]);
		$status=true;
		$error="";
        $this->set(compact('status', 'error','combo_views'));
        $this->set('_serialize', ['status', 'error', 'combo_views']);
    }

}