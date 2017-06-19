<?php
namespace App\Controller\Api;
use App\Controller\Api\AppController;
class CustomersController extends AppController
{
    public function registration()
    {
		$mobile_no=$this->request->query('mobile_no');
		$customerDetails = $this->Customers->find()->where(['mobile_no'=>$mobile_no]);
		$status=true;
		$error="";
		$this->set(compact('status', 'error', 'customerDetails'));
		$this->set('_serialize', ['status', 'error', 'customerDetails']);
    }
}
