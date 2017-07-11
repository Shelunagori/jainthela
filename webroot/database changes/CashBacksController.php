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
        $this->paginate = [
            'contain' => ['Customers']
        ];
        $cashBacks = $this->paginate($this->CashBacks);

        $this->set(compact('cashBacks'));
        $this->set('_serialize', ['cashBacks']);
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
		 
		 $last_cash_back_no = $this->CashBacks->find()->select(['cash_back_no'])->order(['cash_back_no'=>'DESC'])->first();
		 $last_cash_back_no_data=$last_cash_back_no->cash_back_no;
		 if($last_cash_back_no_data){
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
		  
		   $cash_back_claims = $this->CashBacks->find()->where(['customer_id'=>$customer_id, 'amount <'=>$cash_back_amount])->order(['cash_back_no'=>'ASC'])->first();
		   
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
			   $query = $this->CashBacks->query();
				$result = $query->update()
                    ->set(['amount' => $cash_back_amount, 'ready_to_win' => 'yes', 'flag'=>1])
                    ->where(['id' => $updated_id])
                    ->execute();
					
				$set_new_remaining_amount=$updated_amount-$cash_back_amount;
				if($set_new_remaining_amount>=$cash_back_amount){ 
					$flag=1;
				}else{
					$flag=0;
				}
				 $last_cash_back_no = $this->CashBacks->find()->select(['cash_back_no'])->order(['cash_back_no'=>'DESC'])->first();
					 $last_cash_back_no_data=$last_cash_back_no->cash_back_no;
					 if($last_cash_back_no_data){
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
		   
		  $last_cash_back_no = $this->CashBacks->find()->select(['cash_back_no'])->order(['cash_back_no'=>'DESC'])->first();
		 $last_cash_back_no_data=$last_cash_back_no->cash_back_no;
		 if($last_cash_back_no_data){
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
 		 foreach($cash_back_fetchs as $cash_back_fetch){
			 $k++;
			 $customer_id=$cash_back_fetch->customer_id;
			 $cash_back_limit=$cash_back_fetch->cash_back_limit;
			 $cash_back_percentage=$cash_back_fetch->cash_back_percentage;
			 $update_id=$cash_back_fetch->id; 
			 
			 $cash_back_count_limit=$this->CashBacks->find()->where(['customer_id'=>$customer_id, 'ready_to_win' => 'yes', 'won' => 'no', 'flag'=>1])->count();
			  if($cash_back_count_limit>=$cash_back_limit){ 
				 $update_limit_datas=$this->CashBacks->find('all',['limit'=>$cash_back_limit])->where(['customer_id'=>$customer_id, 'ready_to_win' => 'yes', 'won' => 'no', 'flag'=>1]);
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
		 
					$query = $this->CashBacks->query();
					$result = $query->update()
						->set(['won' => 'yes', 'flag'=>2])
						->where(['id' => $update_id])
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
