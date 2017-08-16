<?php
namespace App\Controller\Api;
use App\Controller\Api\AppController;
class CashBacksController extends AppController
{

     public function cashBackDetails()
    {
		$customer_id=$this->request->query('customer_id');
		$jain_thela_admin_id=$this->request->query('jain_thela_admin_id');
		$fetch_cashback_details = $this->CashBacks->find()
		->where(['ready_to_win'=>'yes','customer_id'=>$customer_id])
		->autoFields(true);
		
		
		foreach($fetch_cashback_details as $cash)
		{
			if($cash->won=='yes' && $cash->flag==2 && $cash->claim=='no'){
				$cash->is_claim='win';
			}else if($cash->won=='yes' && $cash->flag==2 && $cash->claim=='yes'){
				$cash->is_claim='claimed';
			}else if($cash->won=='no'){
				$cash->is_claim='wait';
			}
		}
          
		 $fetch_cashback_win_details = $this->CashBacks->find()
		->where(['won'=>'yes', 'flag'=>2])
		->contain(['Customers'])
		->autoFields(true);
		
		
		foreach($fetch_cashback_win_details->toArray() as $data)
		{
		$c_id=$data->customer->id;
		$fetch_customer_name = $this->CashBacks->CustomerAddresses->find()
		->where(['CustomerAddresses.customer_id'=>$c_id, 'default_address'=>1])
		->first();
		if(!empty($fetch_customer_name->name))
		{
			$data->customer->name=$fetch_customer_name->name;
		}
		else{
			$fetch_customer_names = $this->CashBacks->Customers->find()
		->where(['Customers.id'=>$c_id])
		->first();
			$data->customer->name=$fetch_customer_names->name;
		}
		
		
        }
        
		 $cashback_info = $this->CashBacks->Users->find()
		->where(['Users.jain_thela_admin_id'=>$jain_thela_admin_id])
		->autoFields(true);
		
		
		$status=true;
		$error="";
		$cash_back_line="Jain Thela Offer 100% CashBack on every order of Rs. 300";
        $this->set(compact('status', 'error','message','cashback_info','fetch_cashback_details','fetch_cashback_win_details'));
        $this->set('_serialize', ['status', 'error','message','cashback_info', 'fetch_cashback_details','fetch_cashback_win_details','cash_back_line']);
   
    }
	public function claimOnCashBack()
    {
		$customer_id=$this->request->query('customer_id');
		$cash_back_id=$this->request->query('cash_back_id');
		
		$query = $this->CashBacks->query();
				$result = $query->update()
				->set(['claim' => 'yes'])
				->where(['id' => $cash_back_id, 'customer_id' => $customer_id])
				->execute();
				
		$fetch_cashback_win_details = $this->CashBacks->find()
		->where(['customer_id'=>$customer_id, 'id'=>$cash_back_id])->first();
		$fetch_cashback_win_details->amount;
		$fetch_cashback_win_details->cash_back_percentage;
		$percent=100;
		$advance=round($fetch_cashback_win_details->amount*$fetch_cashback_win_details->cash_back_percentage/$percent);
			$query = $this->CashBacks->Wallets->query();
					$query->insert(['plan_id', 'advance', 'customer_id', 'order_no'])
							->values([
							'plan_id' => 9,
							'advance' => $advance,
							'customer_id' => $customer_id,
							'order_no' => 0
							])
					->execute();
		
		$status=true;
		$error="Congratulations, You have claimed successfully, Check your wallet.";
        $this->set(compact('status', 'error'));
        $this->set('_serialize', ['status', 'error']);
   
    }

    
}
