<?php
namespace App\Controller\Api;
use App\Controller\Api\AppController;
class FeedbacksController extends AppController
{
    public function FeedbackForm()
    {
		$jain_thela_admin_id=$this->request->data('jain_thela_admin_id');
		$customer_id=$this->request->data('customer_id');
		$name=$this->request->data('name');
		$mobile=$this->request->data('mobile');
		$email=$this->request->data('email');
		$comments=$this->request->data('comments');
		
			$query = $this->Feedbacks->query();
					$query->insert(['jain_thela_admin_id', 'customer_id', 'name', 'mobile', 'email', 'comments'])
							->values([
							'jain_thela_admin_id' => $jain_thela_admin_id,
							'customer_id' => $customer_id,
							'name' => $name,
							'mobile' => $mobile,
							'email' => $email,
							'comments' => $comments,
							])
					->execute();
		$status=true;
		$error="Thank You, Your Query Updated, we will contact soon.";
        $this->set(compact('status', 'error'));
        $this->set('_serialize', ['status', 'error']);
    }
}
