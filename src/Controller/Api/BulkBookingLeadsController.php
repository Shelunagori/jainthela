<?php
namespace App\Controller\Api;
use App\Controller\Api\AppController;
class BulkBookingLeadsController extends AppController
{
    public function addBulkOrder()
    {
		$jain_thela_admin_id=$this->request->data('jain_thela_admin_id');
		$customer_id=$this->request->data('customer_id');
		$name=$this->request->data('name');
		$mobile=$this->request->data('mobile');
		$lead_description=$this->request->data('lead_description');
		$delivery_date=$this->request->data('delivery_date');
		$delivery_time=$this->request->data('delivery_time');
			$file = $this->request->data['image'];
			
			$file_name=$file['name'];
			$ext = substr(strtolower(strrchr($file['name'], '.')), 1); //get the extension
            $arr_ext = array('jpg', 'jpeg', 'png'); //set allowed extensions
            $setNewFileName = uniqid();
            $image_name= $setNewFileName.'.'.$ext;
			if(!empty($file_name)){
				$img_name=$image_name;
			}else if(empty($file_name)){
				$img_name='';
			}
			 if (in_array($ext, $arr_ext)) {
					move_uploaded_file($file['tmp_name'], WWW_ROOT . 'img/item_images/'.$img_name);
				  }

			$last_lead_no = $this->BulkBookingLeads->find()->select(['lead_no'])->where(['jain_thela_admin_id' => $jain_thela_admin_id])->order(['lead_no'=>'DESC'])->first();
			if($last_lead_no){
				$lead_no = $last_lead_no->lead_no+1;
			}else{
				$lead_no=1;
			}

			$query = $this->BulkBookingLeads->query();
					$query->insert(['name', 'mobile', 'lead_description','status', 'jain_thela_admin_id', 'lead_no', 'customer_id','delivery_date','delivery_time','image'])
							->values([
							'name' => $name,
							'mobile' => $mobile,
							'lead_description' => $lead_description,
							'status' => 'Open',
							'jain_thela_admin_id' => $jain_thela_admin_id,
							'lead_no' => $lead_no,
							'customer_id' => $customer_id,
							'delivery_date' => $delivery_date,
							'delivery_time' => $delivery_time,
							'image' => $img_name
							])
					->execute();

		/* $Bulk_Booking_data=$this->BulkBookingLeads->find()->where(['customer_id' => $customer_id])->order(['lead_no'=>'DESC'])->first(); */
		$status=true;
		$error="Thank You, your bulk order submitted.";
        $this->set(compact('status', 'error'));
        $this->set('_serialize', ['status', 'error']);
    }

}