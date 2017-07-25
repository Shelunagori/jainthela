<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Wallets Controller
 *
 * @property \App\Model\Table\WalletsTable $Wallets
 *
 * @method \App\Model\Entity\Wallet[] paginate($object = null, array $settings = [])
 */
class WalletsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $this->viewBuilder()->layout('index_layout');
		$jain_thela_admin_id=$this->Auth->User('jain_thela_admin_id');
	  $wallets = $this->Wallets->find()->where(['WalkinSales.jain_thela_admin_id'=>$jain_thela_admin_id])->contain(['Customers', 'Plans', 'Orders']);
		$this->set(compact('wallets'));
        $this->set('_serialize', ['wallets']);
    }
		
			
	 public function wallet()
    {
        $this->viewBuilder()->layout('index_layout');
		$wallets = $this->Wallets->find()->where(['Wallets.plan_id != '=>0])->contain(['Customers', 'Plans', 'Orders']);
        $this->set('_serialize', ['wallets']);
    }
	 public function viewAll()
    {
        $this->viewBuilder()->layout('index_layout');
		$wallets = $this->Wallets->find()->contain(['Customers', 'Plans', 'Orders'])->distinct(['Wallets.customer_id']);
		$final_output1=[];
		$final_output2=[];
		/* foreach($wallets as $wallet)
		{
			
			$wallets_datas=$this->Wallets->find()->where(['Wallets.customer_id'=>$wallet->customer_id])->contain(['Customers', 'Plans', 'Orders']);
			
			 foreach($wallets_datas as $wallets_data )
			{
				$final_output1[$wallets_data->customer_id]=$wallets_data->plan->name;
			} 
		} */
		
		$this->set(compact('wallets','final_output1'));
			$this->set('_serialize', ['wallets']);
	}
	 public function consumed()
    {
        $this->viewBuilder()->layout('index_layout');
		$wallets = $this->Wallets->find()->where(['Wallets.plan_id '=>0])->contain(['Customers', 'Plans', 'Orders']);
		
		$this->set(compact('wallets'));
        $this->set('_serialize', ['wallets']);
    }
    /**
     * View method
     *
     * @param string|null $id Wallet id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $this->viewBuilder()->layout('index_layout');
		
		$wallet = $this->Wallets->get($id, [
            'contain' => ['Customers', 'Plans', 'Orders']
        ]);

        $this->set('wallet', $wallet);
        $this->set('_serialize', ['wallet']);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
		 $this->viewBuilder()->layout('index_layout');
        $wallet = $this->Wallets->newEntity();
        if ($this->request->is('post')) {
            $wallet = $this->Wallets->patchEntity($wallet, $this->request->getData());
			
            if ($this->Wallets->save($wallet)) {
                $this->Flash->success(__('The wallet has been added.'));

                return $this->redirect(['action' => 'add']);
            }
            $this->Flash->error(__('The wallet could not be saved. Please, try again.'));
        }
        
		$customers_data = $this->Wallets->Customers->find('all');
			foreach($customers_data as $customer){
				$customer_name=$customer->name;
				$customer_mobile=$customer->mobile;
				$customers[]= ['value'=>$customer->id,'text'=>$customer_name." (".$customer_mobile.")"];
			}
        $this->set(compact('wallet', 'customers'));
        $this->set('_serialize', ['wallet']);
    }

	public function checksubtract($customer_id){
		//$this->viewBuilder()->layout('');
		
		$query = $this->Wallets->find();
		$totalInCase = $query->newExpr()
			->addCase(
				$query->newExpr()->add(['advance > ' => 0]),
				$query->newExpr()->add(['advance']),
				'integer'
			); 
		$totalOutCase = $query->newExpr()
			->addCase(
				$query->newExpr()->add(['consumed > ' => 0]),
				$query->newExpr()->add(['consumed']),
				'integer'
			);
			$query->select([
			'total_advanced' => $query->func()->sum($totalInCase),
			'total_consumed' => $query->func()->sum($totalOutCase),'id','customer_id'
		])
		->where(['Wallets.customer_id' => $customer_id])
		->autoFields(true);
		$wallets = ($query);
		foreach($wallets as $wallet){
			
			 $total_advanced=$wallet->total_advanced;
			$total_consumed=$wallet->total_consumed;
			 echo $remaining=$total_advanced-$total_consumed;
			exit;
		}
	}
	public function remove(){
		 $this->viewBuilder()->layout('index_layout');
        $wallet = $this->Wallets->newEntity();
        if ($this->request->is('post')) {
            $wallet = $this->Wallets->patchEntity($wallet, $this->request->getData());
			
            if ($this->Wallets->save($wallet)) {
                $this->Flash->success(__('The wallet has been removed.'));

                return $this->redirect(['action' => 'remove']);
            }
            $this->Flash->error(__('The wallet could not be saved. Please, try again.'));
        }
        
		
		
		//pr($wallets_data->toArray());exit;
		$customers_data = $this->Wallets->Customers->find('all');
			foreach($customers_data as $customer){
				$customer_name=$customer->name;
				$customer_mobile=$customer->mobile;
				$customers[]= ['value'=>$customer->id,'text'=>$customer_name." (".$customer_mobile.")"];
			}
        $this->set(compact('wallet', 'customers','wallets'));
        $this->set('_serialize', ['wallet']);
	}
    /**
     * Edit method
     *
     * @param string|null $id Wallet id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $wallet = $this->Wallets->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $wallet = $this->Wallets->patchEntity($wallet, $this->request->getData());
            if ($this->Wallets->save($wallet)) {
                $this->Flash->success(__('The wallet has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The wallet could not be saved. Please, try again.'));
        }
        $customers = $this->Wallets->Customers->find('list', ['limit' => 200]);
        $plans = $this->Wallets->Plans->find('list', ['limit' => 200]);
        $orders = $this->Wallets->Orders->find('list', ['limit' => 200]);
        $this->set(compact('wallet', 'customers', 'plans', 'orders'));
        $this->set('_serialize', ['wallet']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Wallet id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $wallet = $this->Wallets->get($id);
        if ($this->Wallets->delete($wallet)) {
            $this->Flash->success(__('The wallet has been deleted.'));
        } else {
            $this->Flash->error(__('The wallet could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
