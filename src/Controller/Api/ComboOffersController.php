<?php
namespace App\Controller\Api;
use App\Controller\Api\AppController;
class ComboOffersController extends AppController
{
    public function index()
    {
	 
		  $jain_thela_admin_id=$this->request->query('jain_thela_admin_id');
		 
         $items = $this->ComboOffers->ComboOfferDetails->Items->find()->where(['Items.jain_thela_admin_id'=>$jain_thela_admin_id, 'Items.combo ='=>'yes']);
		 
		$status=true;
		$error="";
        $this->set(compact('status', 'error', 'items'));
        $this->set('_serialize', ['status', 'error', 'items']);
    }

}
