<?php
namespace App\Controller\Api;
use App\Controller\Api\AppController;
class ItemcategoriesController extends AppController
{
 
	public function index()
    {
		$jain_thela_admin_id=$this->request->query('jain_thela_admin_id');
	    $itemCategories = $this->ItemCategories->find('All')->where(['jain_thela_admin_id'=>$jain_thela_admin_id]);
		$status=true;
		$error="";
        $this->set(compact('status', 'error', 'itemCategories'));
        $this->set('_serialize', ['status', 'error', 'itemCategories']);
    }
	
	public function registration()
    {
		$mobile_no=$this->request->query('mobile_no');
	    $customerDetails = $this->Items->Customers->find()->where(['mobile_no'=>$mobile_no]);
		if(!empty($itemCategories))
		{
		$status=true;
		$error="";
        $this->set(compact('status', 'error', 'customerDetails'));
        $this->set('_serialize', ['status', 'error', 'customerDetails']);
		}
		else{
			$status=true;
		$error="";
        $this->set(compact('status', 'error', 'customerDetails'));
        $this->set('_serialize', ['status', 'error', 'customerDetails']);
		}
    }
	
}
