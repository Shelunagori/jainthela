<?php
namespace App\Controller\Api;
use App\Controller\Api\AppController;
use Cake\I18n\Time;
class PromoCodesController extends AppController
{
    public function varifyPromoCodes()
    {
		echo $today=date('Y-m-d H:i:s');
		echo $time = Time::now();

		/* $jain_thela_admin_id=$this->request->query('jain_thela_admin_id');
		$promo_code=$this->request->query('promo_code');
		$customer_id=$this->request->query('customer_id');

        $items = $this->PromoCodes->find()->where(['PromoCodes.jain_thela_admin_id'=>$jain_thela_admin_id, 'PromoCodes.item_category_id'=>$item_category_id])->contain(['Units','Carts']);
		$items->select(['image_url' => $items->func()->concat(['http://13.126.58.104'.$this->request->webroot.'items/','image' => 'identifier' ])])
                                ->autoFields(true);
		$status=true;
		$error="";
        $this->set(compact('status', 'error', 'items'));
        $this->set('_serialize', ['status', 'error', 'items']); */
    }
}
