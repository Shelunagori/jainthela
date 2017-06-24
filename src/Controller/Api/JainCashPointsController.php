<?php
namespace App\Controller\Api;
use App\Controller\Api\AppController;
class JainCashPointsController extends AppController
{
    public function referral()
    {
		$jain_thela_admin_id=$this->request->query('jain_thela_admin_id');
		$customer_id=$this->request->query('customer_id');
		
		$referral_image = $this->JainCashPoints->Banners->find()
		->select(['image_url' => $this->JainCashPoints->Banners->find()->func()->concat(['http://13.126.58.104'.$this->request->webroot.'banners/','image' => 'identifier' ])])
		->where(['Banners.status'=>'Active','Banners.name'=>'referral'])
        ->autoFields(true)->first();
								
		$query = $this->JainCashPoints->find();
		$totalInCase = $query->newExpr()
			->addCase(
				$query->newExpr()->add(['order_id' => '0']),
				$query->newExpr()->add(['point']),
				'integer'
			);
		$totalOutCase = $query->newExpr()
			->addCase(
				$query->newExpr()->add(['order_id' => '0']),
				$query->newExpr()->add(['used_point']),
				'integer'
			);
			$query->select([
			'total_in' => $query->func()->sum($totalInCase),
			'total_out' => $query->func()->sum($totalOutCase),'id','customer_id'
		])
		->where(['JainCashPoints.customer_id' => $customer_id])
		->group('customer_id')
		->autoFields(true);
		foreach($query as $fetch_query)
		{
			$points=$fetch_query->total_in;
			$used_points=$fetch_query->total_out;
			$jain_cash_points=$points-$used_points;
		}
				$cart_count = $this->JainCashPoints->Carts->find('All')->where(['Carts.customer_id'=>$customer_id])->count();

		$status=true;
		$error="";
        $this->set(compact('status', 'error', 'jain_cash_points','cart_count','referral_image'));
        $this->set('_serialize', ['status', 'error', 'jain_cash_points','cart_count','referral_image']);
    }

}
