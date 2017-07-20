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
		$jain_thela_admin_id=$this->Auth->User('jain_thela_admin_id');
		 
        if ($this->request->is('post')) {
			$item_ledgers=$this->request->getData('item_ledgers');
			
			$driver_id=$this->request->data['driver_id'];
			$warehouse_id=$this->request->data['warehouse_id'];
			$transaction_date=date('Y-m-d', strtotime($this->request->data['transaction_date'])); 
			$i=0;
			
			foreach($item_ledgers as $item_ledger){
				$item_ledger=(object)$item_ledger;
				$quantity=$item_ledger->quantity;
				$item_id=$item_ledger->item_id;
				
				$query = $this->ItemLedgers->query();
				$query->insert(['driver_id', 'warehouse_id', 'transaction_date', 'item_id', 'quantity','status','jain_thela_admin_id', 'inventory_transfer'])
						->values([
						'driver_id' => 0,
						'warehouse_id' => $warehouse_id,
						'transaction_date' => $transaction_date,
						'item_id' => $item_id,
						'quantity' => $quantity,
						'status' => 'out',
						'jain_thela_admin_id' => $jain_thela_admin_id,
						'inventory_transfer' => 'yes'
						])
				->execute();
			
				$query = $this->ItemLedgers->query();
				$query->insert(['driver_id', 'warehouse_id', 'transaction_date', 'item_id', 'quantity','status', 'jain_thela_admin_id', 'inventory_transfer'])
						->values([
						'driver_id' => $driver_id,
						'warehouse_id' => 0,
						'transaction_date' => $transaction_date,
						'item_id' => $item_id,
						'quantity' => $quantity,
						'status' => 'In',
						'jain_thela_admin_id' => $jain_thela_admin_id,
						'inventory_transfer' => 'yes'
						])
				->execute();
			}
			$this->Flash->success(__('The item ledger has been saved.'));
			return $this->redirect(['action' => 'add']);
            $this->Flash->error(__('The item ledger could not be saved. Please, try again.'));
        }
		$item_fetchs = $this->ItemLedgers->Items->find()->where(['Items.jain_thela_admin_id' => $jain_thela_admin_id, 'Items.is_combo'=>'no', 'Items.is_virtual'=>'no', 'Items.freeze'=>0])->contain(['Units']);
			foreach($item_fetchs as $item_fetch){
			$item_name=$item_fetch->name;
			$alias_name=$item_fetch->alias_name;
			$print_quantity=$item_fetch->print_quantity;
			$unit_name=$item_fetch->unit->unit_name;
			$minimum_quantity_factor=$item_fetch->minimum_quantity_factor;
			$items[]= ['value'=>$item_fetch->id,'text'=>$item_name." (".$alias_name.")", 'print_quantity'=>$print_quantity, 'minimum_quantity_factor'=>$minimum_quantity_factor, 'unit_name'=>$unit_name];
		}
        $drivers = $this->ItemLedgers->Drivers->find('list')->where(['jain_thela_admin_id' => $jain_thela_admin_id]);
		$warehouses = $this->ItemLedgers->Warehouses->find('list')->where(['jain_thela_admin_id' => $jain_thela_admin_id]);
        $this->set(compact('itemLedger', 'items', 'drivers', 'warehouses'));
        $this->set('_serialize', ['itemLedger']);
    }

	public function stockReturn()
    {
		$this->viewBuilder()->layout('index_layout'); 
        $itemLedger = $this->ItemLedgers->newEntity();
		$jain_thela_admin_id=$this->Auth->User('jain_thela_admin_id');
        if ($this->request->is('post')) {
			$item_ledgers=$this->request->getData('item_ledgers');
			 
			$driver_id=$this->request->data['driver_id'];
			$warehouse_id=$this->request->data['warehouse_id'];			
			$transaction_date=date('Y-m-d', strtotime($this->request->data['transaction_date'])); 
			$i=0;
			foreach($item_ledgers as $item_ledger){
				$item_ledger=(object)$item_ledger;
				$item_ledger_quantity=$item_ledger->quantity;
				$total_quantity=$item_ledger->quantity+$item_ledger->waste;
				$item_id=$item_ledger->item_id;
				$waste=$item_ledger->waste;
				
				$query = $this->ItemLedgers->query();
				$query->insert(['driver_id', 'warehouse_id', 'transaction_date', 'item_id', 'quantity','status', 'jain_thela_admin_id', 'inventory_transfer'])
						->values([
						'driver_id' => 0,
						'warehouse_id' => $warehouse_id,
						'transaction_date' => $transaction_date,
						'item_id' => $item_id,
						'quantity' => $item_ledger_quantity,
						'status' => 'In',
						'jain_thela_admin_id' => $jain_thela_admin_id,
						'inventory_transfer' => 'yes'
						])
				->execute();	
				
				$query = $this->ItemLedgers->query();
				$query->insert(['driver_id', 'warehouse_id', 'transaction_date', 'item_id', 'quantity','status', 'jain_thela_admin_id', 'inventory_transfer'])
						->values([
						'driver_id' => $driver_id,
						'warehouse_id' => 0,
						'transaction_date' => $transaction_date,
						'item_id' => $item_id,
						'quantity' => $total_quantity,
						'status' => 'out',
						'jain_thela_admin_id' => $jain_thela_admin_id,
						'inventory_transfer' => 'yes'
						])
				->execute();
				
				$query = $this->ItemLedgers->query();
				$query->insert(['driver_id', 'warehouse_id', 'transaction_date', 'item_id', 'quantity','status', 'jain_thela_admin_id','different_driver_id', 'weight_variation', 'inventory_transfer'])
						->values([
						'driver_id' => 0,
						'warehouse_id' => 0,
						'transaction_date' => $transaction_date,
						'item_id' => $item_id,
						'quantity' => $waste,
						'status' => 'In',
						'jain_thela_admin_id' => $jain_thela_admin_id,
						'different_driver_id' => $driver_id,
						'weight_variation' => 1,
						'inventory_transfer' => 'yes'
						])
				->execute();
			}
			
			$this->Flash->success(__('The item ledger has been saved.'));
			return $this->redirect(['action' => 'stock_return']);         
            $this->Flash->error(__('The item ledger could not be saved. Please, try again.'));
        }
        $items = $this->ItemLedgers->Items->find('list')->where(['jain_thela_admin_id' => $jain_thela_admin_id]);
        $drivers = $this->ItemLedgers->Drivers->find('list')->where(['jain_thela_admin_id' => $jain_thela_admin_id]);
		$warehouses = $this->ItemLedgers->Warehouses->find('list')->where(['jain_thela_admin_id' => $jain_thela_admin_id]);
        $this->set(compact('itemLedger', 'items', 'drivers', 'warehouses'));
        $this->set('_serialize', ['itemLedger']);
    }

	public function ajaxStockReturn()
    {
		  $driver_id=$this->request->data['driver'];
		  $jain_thela_admin_id=$this->Auth->User('jain_thela_admin_id');
		  
 			$query = $this->ItemLedgers->find();
		$totalInCase = $query->newExpr()
			->addCase(
				$query->newExpr()->add(['status' => 'In']),
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
		->where(['ItemLedgers.driver_id' => $driver_id,'ItemLedgers.jain_thela_admin_id' => $jain_thela_admin_id])
		->group('item_id')
		->autoFields(true)
		->contain(['Items'=>['Units']]);
        $itemLedgers = ($query);
		//
		$count=$itemLedgers->count();
        $this->set(compact('itemLedgers','count'));
     }

public function DriverReport()
    {
		$this->viewBuilder()->layout('index_layout'); 
        $itemLedger = $this->ItemLedgers->newEntity();
		$jain_thela_admin_id=$this->Auth->User('jain_thela_admin_id');

        $items = $this->ItemLedgers->Items->find('list')->where(['jain_thela_admin_id' => $jain_thela_admin_id]);
        $drivers = $this->ItemLedgers->Drivers->find('list')->where(['jain_thela_admin_id' => $jain_thela_admin_id]);
		$warehouses = $this->ItemLedgers->Warehouses->find('list')->where(['jain_thela_admin_id' => $jain_thela_admin_id]);
        $this->set(compact('itemLedger', 'items', 'drivers', 'warehouses'));
        $this->set('_serialize', ['itemLedger']);
    }

	public function ajaxDriverReport()
    {
		  $driver_id=$this->request->data['driver'];
		  $jain_thela_admin_id=$this->Auth->User('jain_thela_admin_id');
		  
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
		->where(['ItemLedgers.driver_id' => $driver_id, 'ItemLedgers.jain_thela_admin_id' => $jain_thela_admin_id])
		->group('item_id')
		->autoFields(true)
		->contain(['Items']);
        $itemLedgers = ($query);
		$count=$itemLedgers->count();

        $this->set(compact('itemLedgers','count'));
     }

	 public function productReport()
    {
		$this->viewBuilder()->layout('index_layout'); 
        $itemLedger = $this->ItemLedgers->newEntity();
		$jain_thela_admin_id=$this->Auth->User('jain_thela_admin_id');

        $items = $this->ItemLedgers->Items->find('list')->where(['jain_thela_admin_id' => $jain_thela_admin_id]);
        $drivers = $this->ItemLedgers->Drivers->find('list')->where(['jain_thela_admin_id' => $jain_thela_admin_id]);
		$warehouses = $this->ItemLedgers->Warehouses->find('list')->where(['jain_thela_admin_id' => $jain_thela_admin_id]);
        $this->set(compact('itemLedger', 'items', 'drivers', 'warehouses'));
        $this->set('_serialize', ['itemLedger']);
    }

	 public function ajaxStockIssue()
    {
		  $warehouse_id=$this->request->data['warehouse_id'];
		  $jain_thela_admin_id=$this->Auth->User('jain_thela_admin_id');
		  
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
		->where(['ItemLedgers.warehouse_id' => $warehouse_id, 'ItemLedgers.jain_thela_admin_id' => $jain_thela_admin_id])
		->group('item_id')
		->autoFields(true)
		->contain(['Items']);
        $itemLedgers = ($query);
		$count=$itemLedgers->count();
        $this->set(compact('itemLedgers','count'));
     }


	public function ajaxStockAvailable()
    {
		$item_id=$this->request->data['itm_val'];
		$warehouse_id=$this->request->data['ware_house'];
		$jain_thela_admin_id=$this->Auth->User('jain_thela_admin_id');
		 
 			$query = $this->ItemLedgers->find();
		$totalInCase = $query->newExpr()
			->addCase(
				$query->newExpr()->add(['status' => 'In']),
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
		->where(['ItemLedgers.warehouse_id' => $warehouse_id, 'ItemLedgers.jain_thela_admin_id' => $jain_thela_admin_id, 'ItemLedgers.item_id' => $item_id])
		->group('item_id')
		->autoFields(true)
		->contain(['Items']);
        $itemLedgers = ($query);
		  foreach($itemLedgers as $itemLedger){
			   $available_stock=$itemLedger->total_in;
			   $stock_issue=$itemLedger->total_out;
			 echo @$remaining=$available_stock-$stock_issue;
		  }
		  exit;
     }
	 
	 
	 
	public function ajaxWarehouseStockAvailable()
    {
		$item_id=$this->request->data['itm_val'];
		$warehouse_id=$this->request->data['ware_house'];
		$jain_thela_admin_id=$this->Auth->User('jain_thela_admin_id');
		 
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
		->where(['ItemLedgers.warehouse_id' => $warehouse_id, 'ItemLedgers.jain_thela_admin_id' => $jain_thela_admin_id, 'ItemLedgers.item_id' => $item_id])
		->group('item_id')
		->autoFields(true)
		->contain(['Items']);
        $itemLedgers = ($query);
		  foreach($itemLedgers as $itemLedger){
			   $available_stock=$itemLedger->total_in;
			   $stock_issue=$itemLedger->total_out;
			 echo @$remaining=$available_stock-$stock_issue;
		  }
		  exit;
     }

	 

	public function reportShow()
    {
		$jain_thela_admin_id=$this->Auth->User('jain_thela_admin_id');
		$this->viewBuilder()->layout('index_layout');
		
		$query = $this->ItemLedgers->find();
		
		$totalInWarehouseCase = $query->newExpr()
			->addCase(
				$query->newExpr()->add(['status' => 'In', 'warehouse_id']),
				$query->newExpr()->add(['quantity']),
				'integer'
			);	
		$totalOutWarehouseCase = $query->newExpr()
			->addCase(
				$query->newExpr()->add(['status' => 'out', 'warehouse_id']),
				$query->newExpr()->add(['quantity']),
				'integer'
			);
		$totalInDriverCase = $query->newExpr()
			->addCase(
				$query->newExpr()->add(['status' => 'In', 'driver_id']),
				$query->newExpr()->add(['quantity']),
				'integer'
			);	
		$totalOutDriverCase = $query->newExpr()
			->addCase(
				$query->newExpr()->add(['status' => 'out', 'driver_id']),
				$query->newExpr()->add(['quantity']),
				'integer'
			);
		$query->select([
			'totalInWarehouse' => $query->func()->sum($totalInWarehouseCase),
			'totalOutWarehouse' => $query->func()->sum($totalOutWarehouseCase),
			'totalInDriver' => $query->func()->sum($totalInDriverCase),
			'totalOutDriver' => $query->func()->sum($totalOutDriverCase),'id','item_id'
		])
		->where(['ItemLedgers.jain_thela_admin_id'=>$jain_thela_admin_id])
		->group('item_id')
		->autoFields(true)
		->contain(['Items'=>['Units','itemCategories']]);
        
		$itemLedgers=$query;
		
		$this->set(compact('itemLedgers'));
    }

	public function itemStockUpdate()
    {
		$this->viewBuilder()->layout('index_layout'); 
		$jain_thela_admin_id=$this->Auth->User('jain_thela_admin_id'); 
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
		->where(['ItemLedgers.jain_thela_admin_id'=>$jain_thela_admin_id])
		->group('item_id')
		->autoFields(true)
		->contain(['Items'=>['Units','itemCategories']]);
        $itemLedgers = ($query);	
		foreach($itemLedgers as $itemLedger){
			$item_id=$itemLedger->item_id;
			$total_in=$itemLedger->total_in;
			$total_out=$itemLedger->total_out;
			$remaining_stock=$total_in-$total_out;
			$item_data = $this->ItemLedgers->Items->find()->where(['id'=>$item_id]);
				foreach($item_data as $item_data_fetch){
					$minimum_stock=$item_data_fetch->minimum_stock;
					if($remaining_stock<$minimum_stock){			
						$query=$this->ItemLedgers->Items->query();
						$result = $query->update()
							->set(['out_of_stock' => 1])
							->where(['id' => $item_id])
							->execute();
					}
				}
			} 
         $this->set(compact('itemLedgers'));
    }
	
	public function ajaxItemDetails($id = null)
    {
		$jain_thela_admin_id=$this->Auth->User('jain_thela_admin_id'); 
		   $query =$this->ItemLedgers->find();
		$totalInCase = $query->newExpr()
			->addCase(
				$query->newExpr()->add(['status' => 'In']),
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
		->where(['ItemLedgers.jain_thela_admin_id'=>$jain_thela_admin_id, 'item_id'=>$id])
		->group(['driver_id','warehouse_id'])
		->autoFields(true)
		->contain(['Items'=>['Units'], 'Drivers', 'Warehouses']);
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