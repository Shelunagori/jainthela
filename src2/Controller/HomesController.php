<?php
namespace App\Controller;
class HomesController extends AppController
{
	public function index()
    {
        $this->viewBuilder()->layout('index_layout');
		$this->loadModel('CashBacks');
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
		@$data->customer->name=$fetch_customer_name->name;
        }
		
        
		$this->loadModel('Users');
		 $cashback_info = $this->CashBacks->Users->find()
		->where(['Users.jain_thela_admin_id'=>1])
		->autoFields(true);
		
		$this->set('fetch_cashback_win_details', $fetch_cashback_win_details);
		$this->set('cashback_info', $cashback_info);
        $this->set('_serialize', ['fetch_cashback_win_details']); 
    }
}

