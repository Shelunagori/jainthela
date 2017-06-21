<?php
namespace App\Controller\Api;
use App\Controller\Api\AppController;
class ComboOffersController extends AppController
{
    public function index()
    {
<<<<<<< HEAD
		echo $jain_thela_admin_id=$this->request->query('jain_thela_admin_id');
		exit;
        $items = $this->Items->find()->where(['Items.jain_thela_admin_id'=>$jain_thela_admin_id])->contain(['ItemCategories', 'Units']);
=======
	 
		  $jain_thela_admin_id=$this->request->query('jain_thela_admin_id');
		 
         $items = $this->ComboOffers->ComboOfferDetails->Items->find()->where(['Items.jain_thela_admin_id'=>$jain_thela_admin_id, 'Items.combo ='=>'yes']);
		 
>>>>>>> 8ad41ceb2ec85f2b846b3156a3e5d37a6c786214
		$status=true;
		$error="";
        $this->set(compact('status', 'error', 'items'));
        $this->set('_serialize', ['status', 'error', 'items']);
    }

}
