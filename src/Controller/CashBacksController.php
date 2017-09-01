<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * CashBacks Controller
 *
 * @property \App\Model\Table\CashBacksTable $CashBacks
 *
 * @method \App\Model\Entity\CashBack[] paginate($object = null, array $settings = [])
 */
class CashBacksController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
	public function initialize()
	{
		parent::initialize();
		$this->Auth->allow();
	}
	
	
	public function cashBackTermCondition()
    {
		 $this->viewBuilder()->layout(''); 
	}	
    public function index()
    {
		$url=$this->request->here();
		$url=parse_url($url,PHP_URL_QUERY);
		
       	$this->viewBuilder()->layout('index_layout');
		
		$cashBacks = $this->CashBacks->find()->order(['cash_back_no' => 'DESC'])
		->where(['ready_to_win'=>'yes'])
		->contain(['Customers']);
		foreach($cashBacks->toArray() as $data)
		{
		$c_id=$data->customer->id;
		if(!empty($data->customer->name))
		{
		$data->customer->name=$data->customer->name;
		}
		else{
		$fetch_customer_name = $this->CashBacks->CustomerAddresses->find()
		->where(['CustomerAddresses.customer_id'=>$c_id, 'default_address'=>1])
		->first();
		@$data->customer->name=$fetch_customer_name->name;
		}
        }
		
		$this->set(compact('url'));
		$this->set('cashBacks', $cashBacks);
        $this->set('_serialize', ['cashBacks']);
    }

	public function exportExcel()
	{
		$this->viewBuilder()->layout('');
		$jain_thela_admin_id=$this->Auth->User('jain_thela_admin_id');
		
		$cashBacks = $this->CashBacks->find()->order(['cash_back_no' => 'DESC'])
		->where(['ready_to_win'=>'yes'])
		->contain(['Customers']);
		foreach($cashBacks->toArray() as $data)
		{
			$c_id=$data->customer->id;
			if(!empty($data->customer->name))
			{
				$data->customer->name=$data->customer->name;
			}else
			{
				$fetch_customer_name = $this->CashBacks->CustomerAddresses->find()
										->where(['CustomerAddresses.customer_id'=>$c_id, 'default_address'=>1])
										->first();
				@$data->customer->name=$fetch_customer_name->name;
			}
        }
		
		$this->set('cashBacks', $cashBacks);
        $this->set('_serialize', ['cashBacks']);
	}
	
	public function sendNotification()
    {
	$fetch_cashback_win_details = $this->CashBacks->find()->order(['created_on' => 'DESC'])
		->where(['won'=>'yes', 'flag'=>2, 'sms_sent'=>'no','claim'=>'no'])
		->contain(['Customers'])
		->autoFields(true);
		//pr($fetch_cashback_win_details->toArray());
		foreach($fetch_cashback_win_details->toArray() as $customer_details)
		{
			$cashback_id=$customer_details->id;
			$cashback_amount=$customer_details->amount;
			$name=$customer_details->customer->name;
			$mobile=$customer_details->customer->mobile;
            $API_ACCESS_KEY=$customer_details->customer->notification_key;
			
            $device_token=$customer_details->customer->device_token;
            $device_token1=rtrim($device_token);
            $time1=date('Y-m-d G:i:s');

				if(!empty($device_token1))
				{

					$msg = array
					(
					'message'     => 'Congratulation ,you won Rs '.$cashback_amount.' Cashback.',
					'image'     => '',
					'button_text'    => 'Track Your Order',
					'link' => 'jainthela://cashback',
					'notification_id'    => 1,
					);

					$url = 'https://fcm.googleapis.com/fcm/send';
					$fields = array
					(
						'registration_ids'     => array($device_token1),
						'data'            => $msg
					);
					$headers = array
					(
						'Authorization: key=' .$API_ACCESS_KEY,
						'Content-Type: application/json'
					);

					  //echo json_encode($fields);
					 $ch = curl_init();
					curl_setopt($ch, CURLOPT_URL, $url);
					curl_setopt($ch, CURLOPT_POST, true);
					curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
					curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
					curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
					curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
					curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
					$result001 = curl_exec($ch);
					if ($result001 === FALSE) {
						die('FCM Send Error: ' . curl_error($ch));
					}
					curl_close($ch);
					
					$sms=str_replace(' ', '+', 'Congratulation '.$name.' ,you won Rs'.$cashback_amount.'Cashback. For Claim your cashback go to jainthela app . ');
					$working_key='A7a76ea72525fc05bbe9963267b48dd96';
					$sms_sender='JAINTE';
					$sms=str_replace(' ', '+', $sms);
					file_get_contents('http://alerts.sinfini.com/api/web2sms.php?workingkey='.$working_key.'&sender='.$sms_sender.'&to='.$mobile.'&message='.$sms.'');
					
					
					$query=$this->CashBacks->query();
					$result = $query->update()
                    ->set(['sms_sent' => 'yes'])
                    ->where(['id' => $cashback_id])
                    ->execute();
					
					
				}
		}
		 $this->Flash->success(__('The Notification has been sent.'));
		return $this->redirect(['action' => 'cashBackWinner']);
		exit;	
	}
	
	
	public function cashBackWinner()
    {
		$url=$this->request->here();
		$url=parse_url($url,PHP_URL_QUERY);
		
       	$this->viewBuilder()->layout('index_layout');

		$fetch_cashback_win_details = $this->CashBacks->find()->order(['CashBacks.created_on' => 'DESC'])
										->where(['won'=>'yes', 'flag'=>2])
										->contain(['Customers'])
										->autoFields(true);
		
		foreach($fetch_cashback_win_details->toArray() as $data)
		{
		$c_id=$data->customer->id;
		if(!empty($data->customer->name))
		{
		$data->customer->name=$data->customer->name;
		}
		else{
		$fetch_customer_name = $this->CashBacks->CustomerAddresses->find()
		->where(['CustomerAddresses.customer_id'=>$c_id, 'default_address'=>1])
		->first();
		@$data->customer->name=$fetch_customer_name->name;
		}
        }
		
		$this->set(compact( 'url', 'fetch_cashback_win_details'));
		
        $this->set('_serialize', ['fetch_cashback_win_details']); 
    }
	
	public function exportWinner()
	{
		$this->viewBuilder()->layout(''); 
		$fetch_cashback_win_details = $this->CashBacks->find()->order(['CashBacks.created_on' => 'DESC'])
										->where(['won'=>'yes', 'flag'=>2])
										->contain(['Customers'])
										->autoFields(true);
		
		foreach($fetch_cashback_win_details->toArray() as $data)
		{
		$c_id=$data->customer->id;
		if(!empty($data->customer->name))
		{
		$data->customer->name=$data->customer->name;
		}
		else{
		$fetch_customer_name = $this->CashBacks->CustomerAddresses->find()
		->where(['CustomerAddresses.customer_id'=>$c_id, 'default_address'=>1])
		->first();
		@$data->customer->name=$fetch_customer_name->name;
		}
        }
		
		$this->set(compact( 'url', 'fetch_cashback_win_details'));
		
        $this->set('_serialize', ['fetch_cashback_win_details']); 
	}	
    /**
     * View method
     *
     * @param string|null $id Cash Back id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $cashBack = $this->CashBacks->get($id, [
            'contain' => ['Customers']
        ]);

        $this->set('cashBack', $cashBack);
        $this->set('_serialize', ['cashBack']);
    }
	
	public function updateData($id = null)
    {
		$this->viewBuilder()->layout('index_layout'); 
		$jain_thela_admin_id=1;
		
		$cash_back_details=$this->CashBacks->Users->find()->where(['jain_thela_admin_id'=>$jain_thela_admin_id]);
		 
		foreach($cash_back_details as $cash_back_detail){
			$cash_back_percentage=$cash_back_detail->cash_back_percentage;
			$cash_back_amount=$cash_back_detail->cash_back_amount;
			$cash_back_limit=$cash_back_detail->cash_back_limit;
		}
		
		$orders_details=$this->CashBacks->Orders->find()->where(['status'=>'Delivered', 'cash_back_flag'=>'no']);
	foreach($orders_details as $orders_detail){
		
		$order_no=$orders_detail->order_no;
		$customer_id=$orders_detail->customer_id;
		$grand_total=$orders_detail->grand_total;

		  $remaining=$grand_total;
	 if($grand_total>=$cash_back_amount){ 
		 do{
			   @$count+=1;
         $remaining=$grand_total-$cash_back_amount;
		 
		 $last_cash_back_no = $this->CashBacks->find()->select(['cash_back_no'])->order(['id'=>'DESC'])->first();
		 $last_cash_back_no_data=$last_cash_back_no->cash_back_no;
		 if(!empty($last_cash_back_no_data)){
				$cash_back_no = $last_cash_back_no_data+1;
			}else{
				$cash_back_no=1;
			}
		 $query = $this->CashBacks->query();
				$query->insert(['cash_back_no', 'customer_id', 'order_no', 'amount', 'ready_to_win', 'cash_back_percentage', 'cash_back_limit', 'flag'])
						->values([
						'cash_back_no' => $cash_back_no,
						'customer_id' => $customer_id,
						'order_no' => $order_no,
						'amount' => $cash_back_amount,
						'ready_to_win' => 'yes',
						'cash_back_percentage' => $cash_back_percentage,
						'cash_back_limit' => $cash_back_limit,
						'flag' => 1
						])
				->execute();
         $grand_total=$remaining;
    }while($remaining>$cash_back_amount);
		  $grand_total;
		  
		   $cash_back_claims = $this->CashBacks->find()->where(['customer_id'=>$customer_id, 'amount <'=>$cash_back_amount])->order(['id'=>'ASC'])->first();
		   
		   $updated_id=$cash_back_claims->id;
	   if($updated_id){
		   $last_amount=$cash_back_claims->amount;
		  $updated_amount=$grand_total+$last_amount;
		   if($updated_amount<$cash_back_amount){
			$query = $this->CashBacks->query();
				$result = $query->update()
                    ->set(['amount' => $updated_amount])
                    ->where(['id' => $updated_id])
                    ->execute();
		   }
		   else{
			   $updata_data_details=$this->CashBacks->find()->where(['id'=>$updated_id]);
				foreach($updata_data_details as $updata_data_detail){
					
					$updt_customer_id=$updata_data_detail->customer_id;
					$updt_order_no=$updata_data_detail->order_no;
				}
				
		$last_cash_back_no = $this->CashBacks->find()->select(['cash_back_no'])->order(['id'=>'DESC'])->first();
		 $last_cash_back_no_data=$last_cash_back_no->cash_back_no;
			if(!empty($last_cash_back_no_data)){
				$cash_back_no = $last_cash_back_no_data+1;
			}else{
				$cash_back_no=1;
			}
			 	
				
			  $query = $this->CashBacks->query();
				$query->insert(['cash_back_no', 'customer_id', 'order_no', 'amount', 'ready_to_win', 'cash_back_percentage', 'cash_back_limit', 'flag'])
						->values([
						'cash_back_no' => $cash_back_no,
						'customer_id' => $updt_customer_id,
						'order_no' => $updt_order_no,
						'amount' => $cash_back_amount,
						'ready_to_win' => 'yes',
						'cash_back_percentage' => $cash_back_percentage,
						'cash_back_limit' => $cash_back_limit,
						'flag' => 1
						])
				->execute();
				
				$query = $this->CashBacks->query();
				$result = $query->delete()
				->where(['id' => $updated_id])
				->execute();
				
				$set_new_remaining_amount=$updated_amount-$cash_back_amount;
				if($set_new_remaining_amount>=$cash_back_amount){
					$flag=1;
				}else{
					$flag=0;
				}
				 $last_cash_back_no = $this->CashBacks->find()->select(['cash_back_no'])->order(['id'=>'DESC'])->first();
					 $last_cash_back_no_data=$last_cash_back_no->cash_back_no;
					if(!empty($last_cash_back_no_data)){
							$cash_back_no = $last_cash_back_no_data+1;
						}else{
							$cash_back_no=1;
						}
					 $query = $this->CashBacks->query();
							$query->insert(['cash_back_no', 'customer_id', 'order_no', 'amount', 'cash_back_percentage', 'cash_back_limit', 'flag'])
									->values([
									'cash_back_no' => $cash_back_no,
									'customer_id' => $customer_id,
									'order_no' => $order_no,
									'amount' => $set_new_remaining_amount,
									'cash_back_percentage' => $cash_back_percentage,
									'cash_back_limit' => $cash_back_limit,
									'flag' => $flag
									])
							->execute();
		   }
		   
	   }else{
		   
		  $last_cash_back_no = $this->CashBacks->find()->select(['cash_back_no'])->order(['id'=>'DESC'])->first();
		 $last_cash_back_no_data=$last_cash_back_no->cash_back_no;
		if(!empty($last_cash_back_no_data)){
				$cash_back_no = $last_cash_back_no_data+1;
			}else{
				$cash_back_no=1;
			}
		 $query = $this->CashBacks->query();
				$query->insert(['cash_back_no', 'customer_id', 'order_no', 'amount', 'cash_back_percentage', 'cash_back_limit'])
						->values([
						'cash_back_no' => $cash_back_no,
						'customer_id' => $customer_id,
						'order_no' => $order_no,
						'amount' => $grand_total,
						'cash_back_percentage' => $cash_back_percentage,
						'cash_back_limit' => $cash_back_limit
						])
				->execute();
		}
		
		
			$query = $this->CashBacks->Orders->query();
				$result = $query->update()
                    ->set(['cash_back_flag' => 'yes'])
                    ->where(['order_no' => $order_no])
                    ->execute();
		} 
	}
		
 exit;

   }
	
	

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
	 
	 
	public function updateWinners($id = null)
    {
		$this->viewBuilder()->layout('index_layout'); 
		$jain_thela_admin_id=$this->Auth->User('jain_thela_admin_id');
 		$cash_back_fetchs=$this->CashBacks->find()->where(['ready_to_win' => 'yes', 'won' => 'no']);
		$k=0;
		//pr($cash_back_fetchs->toArray());
		 
 		 foreach($cash_back_fetchs as $cash_back_fetch){
			 $k++;
			 $customer_id=$cash_back_fetch->customer_id;
			 $cash_back_limit=$cash_back_fetch->cash_back_limit;
			 $cash_back_percentage=$cash_back_fetch->cash_back_percentage;
			 $update_id=$cash_back_fetch->id; 
			  
			 $cash_back_count_limit=$this->CashBacks->find()->where(['ready_to_win' => 'yes', 'won' => 'no', 'flag'=>1])->count();
			  if($cash_back_count_limit>=$cash_back_limit){ 
				 $update_limit_datas=$this->CashBacks->find('all',['limit'=>$cash_back_limit])->where(['ready_to_win' => 'yes', 'won' => 'no', 'flag'=>1]);
				 $i=0;
				  $count_check=$update_limit_datas->count();
				 
				 if($count_check>=$cash_back_limit){
					 
					foreach($update_limit_datas as $update_limit_data){
						 $i++;
						 $update_limit_id=$update_limit_data->id;
						 $update_limits=$update_limit_data->cash_back_limit;
						 if($cash_back_limit<$i){ 
							break;
							}
							$update_limit_id; 
							$query = $this->CashBacks->query();
							$result = $query->update()
								->set(['flag'=>2])
								->where(['id' => $update_limit_id])
								->execute();
						}
		 
					
						 $updating_details=$this->CashBacks->find()->where(['ready_to_win' => 'yes', 'won' => 'no'])->Order(['id'=>'ASC'])->first();
						 $today=date('Y-m-d');
							$final_update_id=$updating_details->id;
							$query = $this->CashBacks->query();
							$result = $query->update()
								->set(['won' => 'yes', 'flag'=>2, 'winning_date'=>$today])
								->where(['id' => $final_update_id])
								->execute();
							 
				} 
			  }   
		 }
		 exit;
    }

	
    public function add()
    {
		$this->viewBuilder()->layout('index_layout'); 
        $cashBack = $this->CashBacks->newEntity();
		$jain_thela_admin_id=$this->Auth->User('jain_thela_admin_id');
        if ($this->request->is('post')) {
            $cashBack = $this->CashBacks->patchEntity($cashBack, $this->request->getData());
            if ($this->CashBacks->save($cashBack)) {
                $this->Flash->success(__('The cash back has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The cash back could not be saved. Please, try again.'));
        }
        $customers = $this->CashBacks->Customers->find('list', ['limit' => 200]);
        $this->set(compact('cashBack', 'customers'));
        $this->set('_serialize', ['cashBack']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Cash Back id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $cashBack = $this->CashBacks->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $cashBack = $this->CashBacks->patchEntity($cashBack, $this->request->getData());
            if ($this->CashBacks->save($cashBack)) {
                $this->Flash->success(__('The cash back has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The cash back could not be saved. Please, try again.'));
        }
        $customers = $this->CashBacks->Customers->find('list', ['limit' => 200]);
        $this->set(compact('cashBack', 'customers'));
        $this->set('_serialize', ['cashBack']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Cash Back id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $cashBack = $this->CashBacks->get($id);
        if ($this->CashBacks->delete($cashBack)) {
            $this->Flash->success(__('The cash back has been deleted.'));
        } else {
            $this->Flash->error(__('The cash back could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
