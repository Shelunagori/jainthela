<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * ItemLedgers Controller
 *
 * @property \App\Model\Table\ItemLedgersTable $ItemLedgers
 *
 * @method \App\Model\Entity\ItemLedger[] paginate($object = null, array $settings = [])
 */
class ItemLedgersController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Items', 'Franchises', 'PurchaseInwardVouchers']
        ];
        $itemLedgers = $this->paginate($this->ItemLedgers);

        $this->set(compact('itemLedgers'));
        $this->set('_serialize', ['itemLedgers']);
    }

    /**
     * View method
     *
     * @param string|null $id Item Ledger id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $itemLedger = $this->ItemLedgers->get($id, [
            'contain' => ['Items', 'Franchises', 'PurchaseInwardVouchers']
        ]);

        $this->set('itemLedger', $itemLedger);
        $this->set('_serialize', ['itemLedger']);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
		$this->viewBuilder()->layout('index_layout'); 
        $itemLedger = $this->ItemLedgers->newEntity();
        if ($this->request->is('post')) { 			
			$item_id=$this->request->data['item_id'];
			$quantities=$this->request->data['quantity'];
			$supplier_id=$this->request->data['supplier_id'];
			$warehouse_id=$this->request->data['warehouse_id'];
			$transaction_date=date('Y-m-d', strtotime($this->request->data['transaction_date'])); 
			$i=0;
			foreach($quantities as $value){ 
				$query = $this->ItemLedgers->query();
				$query->insert(['supplier_id', 'warehouse_id', 'transaction_date', 'item_id', 'quantity','status'])
						->values([
						'supplier_id' => 0,
						'warehouse_id' => $warehouse_id,
						'transaction_date' => $transaction_date,
						'item_id' => $item_id[$i],
						'quantity' => $value,
						'status' => 'out'
						])
				->execute();
				
				$query = $this->ItemLedgers->query();
				$query->insert(['supplier_id', 'warehouse_id', 'transaction_date', 'item_id', 'quantity','status'])
						->values([
						'supplier_id' => $supplier_id,
						'warehouse_id' => 0,
						'transaction_date' => $transaction_date,
						'item_id' => $item_id[$i],
						'quantity' => $value,
						'status' => 'in'
						])
				->execute();
				$i++;
			}			
			$this->Flash->success(__('The item ledger has been saved.'));
			return $this->redirect(['action' => 'index']);           
            $this->Flash->error(__('The item ledger could not be saved. Please, try again.'));
        }
        $items = $this->ItemLedgers->Items->find('list');
        $suppliers = $this->ItemLedgers->Suppliers->find('list');
        $franchises = $this->ItemLedgers->Franchises->find('list');
		$warehouses = $this->ItemLedgers->Warehouses->find('list');
        $purchaseInwardVouchers = $this->ItemLedgers->PurchaseInwardVouchers->find('list', ['limit' => 200]);
        $this->set(compact('itemLedger', 'items', 'suppliers', 'purchaseInwardVouchers', 'warehouses'));
        $this->set('_serialize', ['itemLedger']);
    }

	
	
	   public function stockReturn()
    {
		$this->viewBuilder()->layout('index_layout'); 
        $itemLedger = $this->ItemLedgers->newEntity();
        if ($this->request->is('post')) { 			
			$item_id=$this->request->data['item_id'];
			$quantities=$this->request->data['quantity'];
			$supplier_id=$this->request->data['supplier_id'];
			$warehouse_id=$this->request->data['warehouse_id'];
			$transaction_date=date('Y-m-d', strtotime($this->request->data['transaction_date'])); 
			$i=0;
			foreach($quantities as $value){ 
				$query = $this->ItemLedgers->query();
				$query->insert(['supplier_id', 'warehouse_id', 'transaction_date', 'item_id', 'quantity','status'])
						->values([
						'supplier_id' => 0,
						'warehouse_id' => $warehouse_id,
						'transaction_date' => $transaction_date,
						'item_id' => $item_id[$i],
						'quantity' => $value,
						'status' => 'in'
						])
				->execute();
				
				$query = $this->ItemLedgers->query();
				$query->insert(['supplier_id', 'warehouse_id', 'transaction_date', 'item_id', 'quantity','status'])
						->values([
						'supplier_id' => $supplier_id,
						'warehouse_id' => 0,
						'transaction_date' => $transaction_date,
						'item_id' => $item_id[$i],
						'quantity' => $value,
						'status' => 'out'
						])
				->execute();
				$i++;
			}
			$this->Flash->success(__('The item ledger has been saved.'));
			return $this->redirect(['action' => 'index']);           
            $this->Flash->error(__('The item ledger could not be saved. Please, try again.'));
        }
        $items = $this->ItemLedgers->Items->find('list');
        $suppliers = $this->ItemLedgers->Suppliers->find('list');
        $franchises = $this->ItemLedgers->Franchises->find('list');
		$warehouses = $this->ItemLedgers->Warehouses->find('list');
        $purchaseInwardVouchers = $this->ItemLedgers->PurchaseInwardVouchers->find('list', ['limit' => 200]);
        $this->set(compact('itemLedger', 'items', 'suppliers', 'purchaseInwardVouchers', 'warehouses'));
        $this->set('_serialize', ['itemLedger']);
    }

	
	
	public function ajaxStockReturn()
    {
			    $supplier_id=$this->request->data['supplier'];
				 
				$query = $this->ItemLedgers->find();
		$totalInCase = $query->newExpr()
			->addCase(
				$query->newExpr()->add(['status' => 'in']),
				$query->newExpr()->add(['quantity']),
				'integer'
			);
		$totalOutCase = $query->newExpr()
			->addCase(
				$query->newExpr()->add(['status' => 'out']),
				$query->newExpr()->add(['quantity']),
				'integer'
			);

		$query->select([
			'total_in' => $query->func()->sum($totalInCase),
			'total_out' => $query->func()->sum($totalOutCase),'id','item_id'
		])
		->where(['supplier_id'=>$supplier_id])
		->group('item_id')
		->autoFields(true)
		->contain(['Items']);
        $itemLedgers = ($query);
        $this->set(compact('itemLedgers'));
     }
    /**
     * Edit method
     *
     * @param string|null $id Item Ledger id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $itemLedger = $this->ItemLedgers->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $itemLedger = $this->ItemLedgers->patchEntity($itemLedger, $this->request->getData());
            if ($this->ItemLedgers->save($itemLedger)) {
                $this->Flash->success(__('The item ledger has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The item ledger could not be saved. Please, try again.'));
        }
        $items = $this->ItemLedgers->Items->find('list', ['limit' => 200]);
        $franchises = $this->ItemLedgers->Franchises->find('list', ['limit' => 200]);
        $purchaseInwardVouchers = $this->ItemLedgers->PurchaseInwardVouchers->find('list', ['limit' => 200]);
        $this->set(compact('itemLedger', 'items', 'franchises', 'purchaseInwardVouchers'));
        $this->set('_serialize', ['itemLedger']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Item Ledger id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $itemLedger = $this->ItemLedgers->get($id);
        if ($this->ItemLedgers->delete($itemLedger)) {
            $this->Flash->success(__('The item ledger has been deleted.'));
        } else {
            $this->Flash->error(__('The item ledger could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
