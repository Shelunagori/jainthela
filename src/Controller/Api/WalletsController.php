<?php
namespace App\Controller\Api;
use App\Controller\Api\AppController;
class WalletsController extends AppController
{
    public function walletDetails()
    {
		$jain_thela_admin_id=$this->request->query('jain_thela_admin_id');
		$customer_id=$this->request->query('customer_id');
		$wallet_details = $this->Wallets->find()
		->where(['Wallets.customer_id'=>$customer_id])
		->contain(['Plans'])
		->autoFields(true);
		foreach($wallet_details as $fetch_wallet_details)
		{
			if(empty($fetch_wallet_details->plan_id))
			{
				$transaction_type='Deduct';
            }
			else if(!empty($fetch_wallet_details->plan_id)){
				$transaction_type='Added';
			}
		  $wallet_details->select(['transaction_type' => $wallet_details->func()->concat([$transaction_type])]);
		}
		
		
		
		
		
		
		
		
		if(empty($wallet_details->toArray()))
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
			$this->set(compact('status', 'error','wallet_details'));
			$this->set('_serialize', ['status', 'error','wallet_details']);
		}
		
    }

}
