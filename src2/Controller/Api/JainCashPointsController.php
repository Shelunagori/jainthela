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
		->select(['image_url' => $this->JainCashPoints->Banners->find()->func()->concat(['http://app.jainthela.in'.$this->request->webroot.'banners/','image' => 'identifier' ])])
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
		
		$referral_array = $this->JainCashPoints->Customers->find()->where(['Customers.id'=>$customer_id])->first();
		$referral_code=$referral_array->referral_code;
		
		$status=true;
		$error="";
        $this->set(compact('status', 'error', 'jain_cash_points','cart_count','referral_code','referral_image'));
        $this->set('_serialize', ['status', 'error', 'jain_cash_points','cart_count','referral_code','referral_image']);
    }
	
	public function referralUpdate()
    {
		$customer_id=$this->request->query('customer_id');
		$referral_code=$this->request->query('referral_code');
		$referral_code_exist = $this->JainCashPoints->Customers->find()
		->where(['Customers.referral_code'=>$referral_code])
        ->first();
		
		if($referral_code_exist)
		{
			$gain_customer=$referral_code_exist->id;
			$points='100';
			$queryj = $this->JainCashPoints->query();
					$queryj->insert(['customer_id', 'point'])
							->values([
							'customer_id' => $gain_customer,
							'point' => $points
							])
					->execute();
			
		$queryr = $this->JainCashPoints->ReferralDetails->query();
					$queryr->insert(['from_customer_id', 'to_customer_id','points'])
							->values([
							'from_customer_id' => $customer_id,
							'to_customer_id' => $gain_customer,
							'points' => $points
							])
					->execute();
					
		$status=true;
		$error="Thank You";
						
		}
		else{
		$status=false;
		$error="Sorry, you entered wrong referral code";
		}
        $this->set(compact('status', 'error'));
        $this->set('_serialize', ['status', 'error']);
    }
	
	public function jainCashDetails()
    {
		$jain_thela_admin_id=$this->request->query('jain_thela_admin_id');
		$customer_id=$this->request->query('customer_id');
		$jain_cash_details = $this->JainCashPoints->find()
		->where(['JainCashPoints.customer_id'=>$customer_id])
		->order(['id'=>'DESC'])
		->autoFields(true);
		
		foreach($jain_cash_details as $jaincash_data){
			
			if(empty($jaincash_data->order_id))
			{
				$jaincash_data->transaction_type='Added';
            }
			else if(!empty($jaincash_data->order_id)){
				$jaincash_data->transaction_type='Deduct';
			}
        $jaincash_data->create_date=date('D M j, Y H:i a', strtotime($jaincash_data->updated_on));

		} 
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
		
		
		if(empty($jain_cash_details->toArray()))
		{
			$status=false;
			$error="No Transaction details";
			$this->set(compact('status', 'error'));
			$this->set('_serialize', ['status', 'error']);
		}
		else
		{
			$status=true;
			$error="";
			$this->set(compact('status', 'error','jain_cash_details', 'jain_cash_points'));
			$this->set('_serialize', ['status', 'error','jain_cash_details','jain_cash_points']);
		}
		
    }

}