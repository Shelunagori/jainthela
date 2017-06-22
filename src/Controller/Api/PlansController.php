<?php
namespace App\Controller\Api;
use App\Controller\Api\AppController;
class PlansController extends AppController
{
    public function plan()
    {
		$jain_thela_admin_id=$this->request->query('jain_thela_admin_id');
		$customer_id=$this->request->query('customer_id');
		
        $plan_details = $this->Plans->find()->where(['Plans.status'=>'Active']);
		$plan_image = $this->Plans->Banners->find()->where(['Banners.status'=>'Active','Banners.name'=>'plan']);
		$plan_image->select(['image_url' => $plan_image->func()->concat(['http://13.126.58.104'.$this->request->webroot.'banners/','image' => 'identifier' ])])
                                ->autoFields(true);
								
		


		$query = $this->Plans->Wallets->find();
		$totalInCase = $query->newExpr()
			->addCase(
				$query->newExpr()->add(['order_id' => '0']),
				$query->newExpr()->add(['advance']),
				'integer'
			);
		$totalOutCase = $query->newExpr()
			->addCase(
				$query->newExpr()->add(['plan_id' => '0']),
				$query->newExpr()->add(['consumed']),
				'integer'
			);
			$query->select([
			'total_in' => $query->func()->sum($totalInCase),
			'total_out' => $query->func()->sum($totalOutCase),'id','customer_id'
		])
		->where(['Wallets.customer_id' => $customer_id])
		->group('customer_id')
		->autoFields(true);
		foreach($query as $fetch_query)
		{
			$advance=$fetch_query->total_in;
			$consumed=$fetch_query->total_out;
			$wallet_balance=$advance-$consumed;
		}
		
		$status=true;
		$error="";
        $this->set(compact('status', 'error', 'wallet_balance', 'plan_image', 'plan_details'));
        $this->set('_serialize', ['status', 'error', 'wallet_balance', 'plan_image', 'plan_details']);
    }

}
