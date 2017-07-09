<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * WalkinSales Controller
 *
 * @property \App\Model\Table\WalkinSalesTable $WalkinSales
 *
 * @method \App\Model\Entity\WalkinSale[] paginate($object = null, array $settings = [])
 */
class WalkinSalesController extends AppController
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
		$walkinSales = $this->WalkinSales->find()->where(['WalkinSales.jain_thela_admin_id'=>$jain_thela_admin_id])->contain(['Drivers','Warehouses','WalkinSaleDetails'=>['Items'=>['Units']]]);
		
	   $this->set(compact('walkinSales'));
        $this->set('_serialize', ['walkinSales']);
    }

    /**
     * View method
     *
     * @param string|null $id Walkin Sale id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
		$this->viewBuilder()->layout('index_layout');
        $walkinSales = $this->WalkinSales->get($id, [
            'contain' => ['Drivers', 'Warehouses', 'WalkinSaleDetails'=>['Items'=>['Units']]]
        ]);

        $this->set('walkinSales', $walkinSales);
        $this->set('_serialize', ['walkinSales']);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
		$this->viewBuilder()->layout('index_layout');
		$jain_thela_admin_id=$this->Auth->User('jain_thela_admin_id');
		$walkinSale=$this->WalkinSales->newEntity();
        if ($this->request->is('post')) {
            $walkinSale = $this->WalkinSales->patchEntity($walkinSale, $this->request->getData());
			  $walkinSale->jain_thela_admin_id=$jain_thela_admin_id;
            if ($walkinsale_data=$this->WalkinSales->save($walkinSale)) {
					$walkinsale_id=$walkinsale_data->id;
					$walkinsale_total_amount=$walkinsale_data->total_amount;
					$transaction_date=$walkinsale_data->transaction_date;
					$query = $this->WalkinSales->Ledgers->query();
					$query->insert(['ledger_account_id', 'walkin_sale_id', 'debit', 'credit', 'transaction_date'])
							->values([
							'ledger_account_id' => 2,
							'walkin_sale_id' => $walkinsale_id,
							'debit' => $walkinsale_total_amount,
							'credit' => 0,
							'transaction_date' => $transaction_date
							])
					->execute();

					$query = $this->WalkinSales->Ledgers->query();
					$query->insert(['ledger_account_id', 'walkin_sale_id', 'debit', 'credit', 'transaction_date'])
							->values([
							'ledger_account_id' => 3,
							'walkin_sale_id' => $walkinsale_id,
							'debit' => 0,
							'credit' => $walkinsale_total_amount,
							'transaction_date' => $transaction_date
							])
					->execute();

					$this->Flash->success(__('The walkin sale has been saved.'));
					return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The walkin sale could not be saved. Please, try again.'));
        }
      //  $items_fetchs = $this->WalkinSales->WalkinSaleDetails->Items->find()->where(['jain_thela_admin_id' => $jain_thela_admin_id]);
		$item_fetchs = $this->WalkinSales->WalkinSaleDetails->Items->find()->where(['Items.jain_thela_admin_id'=>$jain_thela_admin_id, 'Items.is_combo'=>'no', 'Items.freeze'=>0, 'Items.is_virtual'=>'no'])->contain(['Units']);
		$items=[];
		foreach($item_fetchs as $item_fetch){
			$item_name=$item_fetch->name;
			$alias_name=$item_fetch->alias_name;
			@$unit_name=$item_fetch->unit->unit_name;
			$print_quantity=$item_fetch->print_quantity;
			$rates=$item_fetch->offline_sales_rate;
			$minimum_quantity_factor=$item_fetch->minimum_quantity_factor;
			$minimum_quantity_purchase=$item_fetch->minimum_quantity_purchase;
			$items[]= ['value'=>$item_fetch->id,'text'=>$item_name." (".$alias_name.")", 'print_quantity'=>$print_quantity, 'rates'=>$rates, 'minimum_quantity_factor'=>$minimum_quantity_factor, 'unit_name'=>$unit_name, 'minimum_quantity_purchase'=>$minimum_quantity_purchase];
		}
        $drivers = $this->WalkinSales->Drivers->find('list', ['limit' => 200]);
        $jainThelaAdmins = $this->WalkinSales->JainThelaAdmins->find('list');
		$warehouses = $this->WalkinSales->Warehouses->find('list')->where(['jain_thela_admin_id' => $jain_thela_admin_id]);
        $this->set(compact('walkinSale', 'drivers', 'jainThelaAdmins', 'warehouses', 'items'));
        $this->set('_serialize', ['walkinSale']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Walkin Sale id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $this->viewBuilder()->layout('index_layout');
		$walkinSale = $this->WalkinSales->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $walkinSale = $this->WalkinSales->patchEntity($walkinSale, $this->request->getData());
            if ($this->WalkinSales->save($walkinSale)) {
                $this->Flash->success(__('The walkin sale has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The walkin sale could not be saved. Please, try again.'));
        }
        $drivers = $this->WalkinSales->Drivers->find('list', ['limit' => 200]);
        $jainThelaAdmins = $this->WalkinSales->JainThelaAdmins->find('list', ['limit' => 200]);
        $warehouses = $this->WalkinSales->Warehouses->find('list', ['limit' => 200]);
        $this->set(compact('walkinSale', 'drivers', 'jainThelaAdmins', 'warehouses'));
        $this->set('_serialize', ['walkinSale']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Walkin Sale id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $walkinSale = $this->WalkinSales->get($id);
        if ($this->WalkinSales->delete($walkinSale)) {
            $this->Flash->success(__('The walkin sale has been deleted.'));
        } else {
            $this->Flash->error(__('The walkin sale could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
