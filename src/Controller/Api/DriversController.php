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
	
}
