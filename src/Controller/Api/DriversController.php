<?php
namespace App\Controller\Api;
use App\Controller\Api\AppController;
class DriversController extends AppController
{
    public function supplierLocations()
    {
		$jain_thela_admin_id=$this->request->query('jain_thela_admin_id');
		$customer_id=$this->request->query('customer_id');
		$Supplier_locations = $this->Drivers->find()->where(['Drivers.jain_thela_admin_id'=>$jain_thela_admin_id]);
		$status=true;
		$error="";
        $this->set(compact('status', 'error', 'Supplier_locations'));
        $this->set('_serialize', ['status', 'error', 'Supplier_locations']);
    }
	
	public function supplierLogin()
    {
		$user_name=$this->request->query('user_name');
	    $password=$this->request->query('password');
	    $pwd=md5($password);
		
		if(!empty($user_name) && !empty($password))
		{
			
		        $driverDetails = $this->Drivers->find()->where(['user_name'=>$user_name,'password'=>$pwd])->first();
				if($driverDetails){
				    
					$status=true;
					$error='Successfully Login';
					$this->set(compact('status', 'error', 'driverDetails'));
					$this->set('_serialize', ['status', 'error', 'driverDetails']);
				}
				else
				{
					$status=false;
					$error="Sorry, Entered user name and password are incorrect. Try again.";
					$this->set(compact('status', 'error'));
					$this->set('_serialize', ['status', 'error']);
				}
        }
		else
		{
					$status=false;
					$error="Sorry, Entered user name and password are incorrect. Try agian.";
					$this->set(compact('status', 'error'));
					$this->set('_serialize', ['status', 'error']);
		}
}
}