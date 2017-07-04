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
		$jain_thela_admin_id=$this->Auth->User('jain_thela_admin_id');
		
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
				$query->insert(['cash_back_no', 'customer_id', 'order_no', 'amount'])
						->values([
						'cash_back_no' => $cash_back_no,
						'customer_id' => $customer_id,
						'order_no' => $order_no,
						'amount' => $cash_back_amount
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
		   
			$query = $this->CashBacks->query();
				$result = $query->update()
                    ->set(['amount' => $updated_amount])
                    ->where(['id' => $updated_id])
                    ->execute();
					
					
	   }else{
		   
		  $last_cash_back_no = $this->CashBacks->find()->select(['cash_back_no'])->order(['cash_back_no'=>'DESC'])->first();
		 $last_cash_back_no_data=$last_cash_back_no->cash_back_no;
		 if($last_cash_back_no_data){
				$cash_back_no = $last_cash_back_no_data+1;
			}else{
				$cash_back_no=1;
			}
		 $query = $this->CashBacks->query();
				$query->insert(['cash_back_no', 'customer_id', 'order_no', 'amount'])
						->values([
						'cash_back_no' => $cash_back_no,
						'customer_id' => $customer_id,
						'order_no' => $order_no,
						'amount' => $grand_total
						])
				->execute();
		}
		
		
			$query = $this->CashBacks->Orders->query();
				$result = $query->update()
                    ->set(['cash_back_flag' => 'yes'])
                    ->where(['order_no' => $order_no])
                    ->execute();
					
		
	 } 
	 exit;
			
		 

		}
		
        $cashBack = $this->CashBacks->get($id, [
            'contain' => ['Customers']
        ]);

        $this->set('cashBack', $cashBack);
        $this->set('_serialize', ['cashBack']);
    }
	
	

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
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
