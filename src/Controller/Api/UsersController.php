<?php
namespace App\Controller\Api;
use App\Controller\Api\AppController;
class UsersController extends AppController
{
     public function flash()
	{
		$faq = $this->Users->TermConditions->find()->where(['TermConditions.term_name'=>'faq'])->first();
		$privacy = $this->Users->TermConditions->find()->where(['TermConditions.term_name'=>'privacy'])->first();
		$tcs = $this->Users->TermConditions->find()->where(['TermConditions.term_name'=>'tcs'])->first();
		$aboutus = $this->Users->TermConditions->find()->where(['TermConditions.term_name'=>'aboutus'])->first();
		$company_details = $this->Users->CompanyDetails->find()->first();
		$status=true;
		$error="";
		$this->set(compact('status', 'error', 'faq', 'privacy', 'tcs', 'aboutus', 'company_details'));
		$this->set('_serialize', ['status', 'error', 'faq', 'privacy', 'tcs', 'aboutus', 'company_details']);
	}
}



