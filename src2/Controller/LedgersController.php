<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Ledgers Controller
 *
 * @property \App\Model\Table\LedgersTable $Ledgers
 *
 * @method \App\Model\Entity\Ledger[] paginate($object = null, array $settings = [])
 */
class LedgersController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['LedgerAccounts', 'PurchaseBookings', 'WalkinSales']
        ];
        $ledgers = $this->paginate($this->Ledgers);

        $this->set(compact('ledgers'));
        $this->set('_serialize', ['ledgers']);
    }

    /**
     * View method
     *
     * @param string|null $id Ledger id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $ledger = $this->Ledgers->get($id, [
            'contain' => ['LedgerAccounts', 'PurchaseBookings', 'WalkinSales']
        ]);

        $this->set('ledger', $ledger);
        $this->set('_serialize', ['ledger']);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $ledger = $this->Ledgers->newEntity();
        if ($this->request->is('post')) {
            $ledger = $this->Ledgers->patchEntity($ledger, $this->request->getData());
            if ($this->Ledgers->save($ledger)) {
                $this->Flash->success(__('The ledger has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The ledger could not be saved. Please, try again.'));
        }
        $ledgerAccounts = $this->Ledgers->LedgerAccounts->find('list', ['limit' => 200]);
        $purchaseBookings = $this->Ledgers->PurchaseBookings->find('list', ['limit' => 200]);
        $walkinSales = $this->Ledgers->WalkinSales->find('list', ['limit' => 200]);
        $this->set(compact('ledger', 'ledgerAccounts', 'purchaseBookings', 'walkinSales'));
        $this->set('_serialize', ['ledger']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Ledger id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $ledger = $this->Ledgers->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $ledger = $this->Ledgers->patchEntity($ledger, $this->request->getData());
            if ($this->Ledgers->save($ledger)) {
                $this->Flash->success(__('The ledger has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The ledger could not be saved. Please, try again.'));
        }
        $ledgerAccounts = $this->Ledgers->LedgerAccounts->find('list', ['limit' => 200]);
        $purchaseBookings = $this->Ledgers->PurchaseBookings->find('list', ['limit' => 200]);
        $walkinSales = $this->Ledgers->WalkinSales->find('list', ['limit' => 200]);
        $this->set(compact('ledger', 'ledgerAccounts', 'purchaseBookings', 'walkinSales'));
        $this->set('_serialize', ['ledger']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Ledger id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $ledger = $this->Ledgers->get($id);
        if ($this->Ledgers->delete($ledger)) {
            $this->Flash->success(__('The ledger has been deleted.'));
        } else {
            $this->Flash->error(__('The ledger could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
	
	public function AccountStatements()
	{
		$this->viewBuilder()->layout('index_layout');	
		$jain_thela_admin_id=$this->Auth->User('jain_thela_admin_id');
		$ledger_account_id=$this->request->query('ledger_account_id');
		if($ledger_account_id)
		{
			$Ledger_Account_data = $this->Ledgers->LedgerAccounts->get($ledger_account_id, [
               'contain' => ['AccountGroups'=>['AccountCategories']]
			]);
		
			$from = $this->request->query['From'];
			$To = $this->request->query['To'];
			$transaction_from_date= date('Y-m-d', strtotime($from));
			$transaction_to_date= date('Y-m-d', strtotime($To));
			
			if($from == '01-04-2017'){
				$OB = $this->Ledgers->find()->where(['ledger_account_id'=>$ledger_account_id,'transaction_date  '=>$transaction_from_date]);
				$opening_balance_ar=[];
			foreach($OB as $Ledger)
				{
					if($Ledger->voucher_source== "Opening Balance"){
						@$opening_balance_ar['debit']+=$Ledger->debit;
						@$opening_balance_ar['credit']+=$Ledger->credit;
					}
				}	
			}else{
				$OB = $this->Ledgers->find()->where(['ledger_account_id'=>$ledger_account_id,'transaction_date  <'=>$transaction_from_date]);
				$opening_balance_ar=[];
				foreach($OB as $Ledger)
					{
						
							@$opening_balance_ar['debit']+=$Ledger->debit;
							@$opening_balance_ar['credit']+=$Ledger->credit;
					}	
			}
			
			$Ledgers = $this->Ledgers->find()
				->where(['ledger_account_id'=>$ledger_account_id])
				->where(function($exp) use($transaction_from_date,$transaction_to_date){
					return $exp->between('transaction_date', $transaction_from_date, $transaction_to_date, 'date');
				})->order(['transaction_date' => 'DESC']);
		}  
			$ledger=$this->Ledgers->LedgerAccounts->find('list',
				['keyField' => function ($row) {
					return $row['id'];
				},
				'valueField' => function ($row) {
					if(!empty($row['alias'])){
						return  $row['name'] . ' (' . $row['alias'] . ')';
					}else{
						return $row['name'];
					}
					
				}])->where(['customer_id !='=>0]);
		
			$this->set(compact('Ledgers','ledger','ledger_account_id','Ledger_Account_data','transaction_from_date','transaction_to_date','opening_balance_ar'));

	}
}
