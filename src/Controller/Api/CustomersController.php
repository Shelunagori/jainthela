<?php

namespace App\Controller\Api;
use App\Controller\Api\AppController;
class CustomersController extends AppController
{
    public function registration()
    {
		$error="";
	    $mobile_no=$this->request->query('mobile_no');
	    $otp=$this->request->query('otp');
		$signup=$this->request->query('status');
		
		
		if(!empty($mobile_no) && empty($otp) && empty($signup))
		{
			
		        $customerDetails = $this->Customers->find()->where(['mobile'=>$mobile_no,'status'=>'completed'])->first();
				if($customerDetails){
				    $id=$customerDetails->id;
					$new_signup='no';
					$random=(string)mt_rand(1000,9999);
					$sms=str_replace(' ', '+', 'Your one time OTP for Jainthela App is: '.$random.'');
					$working_key='A7a76ea72525fc05bbe9963267b48dd96';
					$sms_sender='JAINTE';
					$sms=str_replace(' ', '+', $sms);
					file_get_contents('http://alerts.sinfini.com/api/web2sms.php?workingkey='.$working_key.'&sender='.$sms_sender.'&to='.$mobile_no.'&message='.$sms.'');
					
					$customerDetails = $this->Customers->get($customerDetails->id);
					$customerDetails->otp=$random;
					$this->Customers->save($customerDetails);
					$status=true;
				}else{
					
					$customerDetails = $this->Customers->find()->where(['mobile'=>$mobile_no,'status'=>'incompleted'])->first();
					if($customerDetails)
					{
						$id=$customerDetails->id;
						$new_signup='no';
						$random=(string)mt_rand(1000,9999);
						$sms=str_replace(' ', '+', 'Your one time OTP for Jainthela App is: '.$random.'');
						$working_key='A7a76ea72525fc05bbe9963267b48dd96';
						$sms_sender='JAINTE';
						$sms=str_replace(' ', '+', $sms);
						file_get_contents('http://alerts.sinfini.com/api/web2sms.php?workingkey='.$working_key.'&sender='.$sms_sender.'&to='.$mobile_no.'&message='.$sms.'');
						
						$customerDetails = $this->Customers->get($customerDetails->id);
						$customerDetails->otp=$random;
						$this->Customers->save($customerDetails);
						$status=true;	
					}
					else{
							$customer = $this->Customers->newEntity();
							$customer->mobile=$mobile_no;
							$customer->status='incompleted';
							$random=(string)mt_rand(1000,9999);
							$customer->otp=$random;
							$sms=str_replace(' ', '+', 'Your one time OTP for Jainthela App is: '.$random.'');
							$working_key='A7a76ea72525fc05bbe9963267b48dd96';
							$sms_sender='JAINTE';
							$sms=str_replace(' ', '+', $sms);
							file_get_contents('http://alerts.sinfini.com/api/web2sms.php?workingkey='.$working_key.'&sender='.$sms_sender.'&to='.$mobile_no.'&message='.$sms.'');
							if($this->Customers->save($customer)){
								$new_signup='yes';
								$status=true;
								$customerDetails=$this->Customers->get($customer->id);
							}else{
								$status=false;
								$error="Customer registration failed.";
							}
					  }
					
				}
				$this->set(compact('status', 'error', 'new_signup', 'customerDetails'));
		        $this->set('_serialize', ['status', 'error', 'new_signup', 'customerDetails']);
		}
		else if(!empty($mobile_no) && !empty($otp) && !empty($signup))
		{
			
			if($signup=='completed')
			{
			$customerDetails = $this->Customers->find()->where(['mobile'=>$mobile_no, 'otp'=>$otp, 'status'=>'completed'])->first();
				if($customerDetails)
				{
					$customerDetails->already_login=true;
					$status=true;
					$new_signup='';
					$error='Successfully Login';
					$this->set(compact('status', 'error', 'new_signup', 'customerDetails'));
					$this->set('_serialize', ['status', 'error', 'new_signup', 'customerDetails']);
				}
				else
				{
					$status=false;
					$error="Sorry, you entered Wrong OTP, try again";
					$this->set(compact('status', 'error'));
					$this->set('_serialize', ['status', 'error']);
				}
			}
			else if($signup=='incompleted'){
				
			$customerDetails = $this->Customers->find()->where(['mobile'=>$mobile_no, 'otp'=>$otp, 'status'=>'incompleted'])->first();
				if($customerDetails)
				{
					$customerDetails = $this->Customers->get($customerDetails->id);
				    $customerDetails->status='completed';
					$customerDetails->referral_code=$customerDetails->id;
					$this->Customers->save($customerDetails);
					$customerDetails->already_login=false;
					$status=true;
					$new_signup='';
					$error='Successfully Login';
					$this->set(compact('status', 'error', 'new_signup', 'customerDetails'));
					$this->set('_serialize', ['status', 'error', 'new_signup', 'customerDetails']);
				}
				else
				{
					$status=false;
					$error="Sorry, you entered Wrong OTP, try again";
					$this->set(compact('status', 'error'));
					$this->set('_serialize', ['status', 'error']);
				}
			}
			
			
		}
		else
		{
			$status=false;
			$error="Enter Mobile No.";
			$this->set(compact('status', 'error'));
		    $this->set('_serialize', ['status', 'error']);
			
		}
    }
}
