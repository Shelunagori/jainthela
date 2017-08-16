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
	    
		$plan_image = $this->Plans->Banners->find()
		->select(['image_url' => $this->Plans->Banners->find()->func()->concat(['http://app.jainthela.in'.$this->request->webroot.'banners/','image' => 'identifier' ])])
		->where(['Banners.status'=>'Active','Banners.name'=>'plan'])
        ->autoFields(true)->first();
		

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
	
		if(empty($query->toArray()))
		{
			$wallet_balance=0;
		}
		else
		{
			foreach($query as $fetch_query)
		      {
			$advance=$fetch_query->total_in;
			$consumed=$fetch_query->total_out;
			$wallet_balance=$advance-$consumed;
		      }
		}
		$cart_count = $this->Plans->Carts->find('All')->where(['Carts.customer_id'=>$customer_id])->count();
		$auto_order_no = $this->Plans->AutoOrderNos->find();
		foreach($auto_order_no as $fetch_auto_order_no)
		{
            $wallet_order_id=$fetch_auto_order_no->no;
		}
		
		        $new_order_no=$wallet_order_id+1;
		        $query = $this->Plans->AutoOrderNos->query();
					$result = $query->update()
						->set(['no' => $new_order_no])
						->where(['id' => 1])
						->execute();
						
				
if(!empty($plan_details->toArray()))
{
$status=true;
		$error="";
        $this->set(compact('status', 'error', 'wallet_balance','cart_count','wallet_order_id','plan_image', 'plan_details'));
        $this->set('_serialize', ['status', 'error', 'wallet_balance','cart_count','wallet_order_id','plan_image', 'plan_details']);
}	
else{
	$status=false;
		$error="";
        $this->set(compact('status', 'error', 'wallet_balance','cart_count','wallet_order_id','plan_image', 'plan_details'));
        $this->set('_serialize', ['status', 'error', 'wallet_balance','cart_count','wallet_order_id','plan_image', 'plan_details']);
}
		}

}
