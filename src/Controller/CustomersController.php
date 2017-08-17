<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Customers Controller
 *
 * @property \App\Model\Table\CustomersTable $Customers
 *
 * @method \App\Model\Entity\Customer[] paginate($object = null, array $settings = [])
 */
class CustomersController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
		$this->viewBuilder()->layout('index_layout');
		$customers = $this->Customers->find();  
		
        $this->set(compact('customers'));
        $this->set('_serialize', ['customers']);
    }

    /**
     * View method
     *
     * @param string|null $id Customer id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id)
    {
		$this->viewBuilder()->layout('index_layout'); 
		$jain_thela_admin_id=$this->Auth->User('jain_thela_admin_id');
		$id;
		$Customers = $this->Customers->get($id, [
            'contain' => ['JainCashPoints'=>function($query){
				return $query->select([
					'total_point' => $query->func()->sum('point'),
					'total_used_point' => $query->func()->sum('used_point'),'customer_id'
				]);
			},'Wallets'=>function($query){
				return $query->select([
					'total_advance' => $query->func()->sum('advance'),
					'total_consumed' => $query->func()->sum('consumed'),'customer_id',
				]);
			},'Orders'=>function($query){
				return $query->select([
					
					'total_order' => $query->func()->count('customer_id'),'customer_id',
				]);
			}
				]
        ]);
		$jain_cash_gains=$this->Customers->ReferralDetails->find()->where(['from_customer_id'=>$id])->contain(['fromCustomer']);
		$jain_cash_uses=$this->Customers->JainCashPoints->find()->where(['JainCashPoints.customer_id'=>$id, 'order_id !='=>0])->contain(['Customers', 'Orders']);
		
		$wallet_advances=$this->Customers->Wallets->find()->where(['Wallets.customer_id'=>$id,'Wallets.order_id ='=>0])->contain(['Customers', 'Orders', 'Plans']);
		$wallet_consumes=$this->Customers->Wallets->find()->where(['Wallets.customer_id'=>$id,'Wallets.plan_id ='=> 0])->contain(['Customers', 'Orders']);
		$Orders=$this->Customers->Orders->find()->where(['Orders.customer_id'=>$id]);
        $this->set(compact('Customers', 'status', 'id', 'jain_cash_gains', 'jain_cash_uses', 'wallet_advances', 'wallet_consumes', 'Orders'));
        $this->set('_serialize', ['Customers', 'jain_cash_gains', 'jain_cash_uses', 'wallet_advances', 'wallet_consumes', 'Orders']);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add($id=null)
    {
        $this->viewBuilder()->layout('index_layout');
		$jain_thela_admin_id=$this->Auth->User('jain_thela_admin_id');
		$customer = $this->Customers->newEntity();
		if ($this->request->is(['post'])) {
			$customer->status='completed';
			$customer->first_time_win_status='No';
			$customer->notification_key='AAAAXmNqxY4:APA91bG0X6RHVhwJKXUQGNSSCas44hruFdR6_CFd6WHPwx9abUr-WsrfEzsFInJawElgrp24QzaE4ksfmXu6kmIL6JG3yP487fierMys5byv-I1agRtMPIoSqdgCZf8R0iqsnds-u4CU';
            $customer= $this->Customers->patchEntity($customer, $this->request->getData());
            if ($this->Customers->save($customer)) {
                $this->Flash->success(__('The customer has been saved.'));
                return $this->redirect(['action' => 'index','controller'=>'CustomerAddresses/index/'.$customer->id]);
            }
            $this->Flash->error(__('The customer could not be saved. Please, try again.'));
        }
        $this->set(compact('customer'));
        $this->set('_serialize', ['customer']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Customer id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
		$this->viewBuilder()->layout('index_layout');
        $customer = $this->Customers->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $customer = $this->Customers->patchEntity($customer, $this->request->getData());
            if ($this->Customers->save($customer)) {
                $this->Flash->success(__('The customer has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The customer could not be saved. Please, try again.'));
        }
        $this->set(compact('customer'));
        $this->set('_serialize', ['customer']);
    }

	public function customerDetail($id=Null)
    {
		$this->viewBuilder()->layout('index_layout'); 
		$jain_thela_admin_id=$this->Auth->User('jain_thela_admin_id');
		
		$customers = $this->Customers->get($id, [
            'contain' => ['JainCashPoints'=>function($query){
				return $query->select([
					'total_point' => $query->func()->sum('point'),
					'total_used_point' => $query->func()->sum('used_point'),'customer_id'
				]);
			},'Wallets'=>function($query){
				return $query->select([
					'total_advance' => $query->func()->sum('advance'),
					'total_consumed' => $query->func()->sum('consumed'),'customer_id'
				]);
			},'Orders']
        ]);		
		
        $this->set(compact('customers'));
        $this->set('_serialize', ['customers']);
    }


	public function ajaxCustomerReport()
    {
		$this->viewBuilder()->layout('ajax'); 
		$jain_thela_admin_id=$this->Auth->User('jain_thela_admin_id');
		
		$customer = $this->Customers->get($this->request->data['customer_id'], [
            'contain' => ['JainCashPoints'=>function($query){
				return $query->select([
					'total_point' => $query->func()->sum('point'),
					'total_used_point' => $query->func()->sum('used_point'),'customer_id'
				]);
			},'Wallets'=>function($query){
				return $query->select([
					'total_advance' => $query->func()->sum('advance'),
					'total_consumed' => $query->func()->sum('consumed'),'customer_id'
				]);
			},'Orders']
        ]);
		
		$this->set(compact('customer'));
    }


	public function defaultAddress($id = null)
    { 
		$this->viewBuilder()->layout('');
		
		if(empty($id)){
			echo ''; exit;
		}
		$defaultAddress = $this->Customers->CustomerAddresses->find('all')->where(['customer_id' => $id,'default_address' => 1])->order(['CustomerAddresses.id'=>'DESC'])->first();
		if(!empty($defaultAddress)){
			echo $defaultAddress->house_no.$defaultAddress->address." - ".$defaultAddress->locality;
			exit;
		}else{
			echo " ";   exit;
		}
    }
	
	public function defaultAddress1($id = null)
    { 
		$this->viewBuilder()->layout('');
		
		if(empty($id)){
			echo ''; exit;
		}
		$defaultAddress = $this->Customers->CustomerAddresses->find('all')->where(['customer_id' => $id,'default_address' => 1])->order(['CustomerAddresses.id'=>'DESC'])->first();
		if(!empty($defaultAddress)){
			echo $defaultAddress->id;			
			exit;
		}else{
			echo " ";   exit;
		}
    }
	
	public function addressList($id = null)
    {
		$this->viewBuilder()->layout('ajax_layout');
		
		if(empty($id)){
			echo 'Please Select Customer First.'; exit;
		}
        $customer = $this->Customers->get($id, [
            'contain' => ['CustomerAddresses']
        ]);
		
		
        $this->set('customer', $customer);
        $this->set('_serialize', ['customer']);
    }
	
    /**
     * Delete method
     *
     * @param string|null $id Customer id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $customer = $this->Customers->get($id);
        if ($this->Customers->delete($customer)) {
            $this->Flash->success(__('The customer has been deleted.'));
        } else {
            $this->Flash->error(__('The customer could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
	
	public function sendMessage()
    {
	$customers = $this->Customers->find(); 
	foreach($customers->toArray() as $customer)
		{
			$customer_id=$customer->id;
			$mobile=$customer->mobile;
			$sms=str_replace(' ', '+', 'Enjoy this monsoon with Jainthela cashback offer. Order from Jainthela
App & get 100 % cashback. order fresh fruits & vegetables
https://goo.gl/RFnBP8 offer valid till August 2017 T&c apply.');
					$working_key='A7a76ea72525fc05bbe9963267b48dd96';
					$sms_sender='JAINTE';
					$sms=str_replace(' ', '+', $sms);
					file_get_contents('http://alerts.sinfini.com/api/web2sms.php?workingkey='.$working_key.'&sender='.$sms_sender.'&to='.$mobile.'&message='.$sms.'');
					
		}
		exit;
	}
}
