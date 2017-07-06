<?php
namespace App\Controller\Api;
use App\Controller\Api\AppController;
class DriversController extends AppController
{
	
	public function warehouseLogin()
    {
		$user_name=$this->request->query('user_name');
	    $password=$this->request->query('password');
	    $pwd=md5($password);
		
		if(!empty($user_name) && !empty($password))
		{
			
		        $warehouseDetails = $this->Warehouses->find()->where(['user_name'=>$user_name,'password'=>$pwd])->first();
				if($warehouseDetails){
				    
					$status=true;
					$error='Successfully Login';
					$this->set(compact('status', 'error', 'warehouseDetails'));
					$this->set('_serialize', ['status', 'error', 'warehouseDetails']);
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
public function warehousePushTokenUpdate()
    {
		$warehouse_id=$this->request->data('warehouse_id');
		$device_token=$this->request->data('device_token');
		
		$query = $this->Warehouses->query();
				$result = $query->update()
                    ->set([ 'device_token' => $device_token
							])
					->where(['id' => $warehouse_id])
					->execute();
		
		$status=true;
		$error="Token Updated Successfully";
        $this->set(compact('status', 'error'));
        $this->set('_serialize', ['status', 'error']);
    }
	public function warehouseLocationUpdate()
    {
		$warehouse_id=$this->request->query('warehouse_id');
		$lattitude=$this->request->query('lattitude');
		$longitude=$this->request->query('longitude');
		
		$query = $this->Warehouses->query();
				$result = $query->update()
                    ->set([ 'lattitude' => $lattitude,
					'longitude' => $longitude
					])
					->where(['id' => $warehouse_id])
					->execute();
		
		$status=true;
		$error="Locations Updated Successfully";
        $this->set(compact('status', 'error'));
        $this->set('_serialize', ['status', 'error']);
    }



}