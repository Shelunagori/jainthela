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
	 public function ajaxView($id = null)
    {
		$this->viewBuilder()->layout('');
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
			
			$warehouse_id = $this->request->data['warehouse_id'];
            $walkinSale = $this->WalkinSales->patchEntity($walkinSale, $this->request->getData());
			$curent_date=date('Y-m-d');
			
			$last_order_no = $this->WalkinSales->find()
			->select(['get_auto_no'])
			->order(['get_auto_no'=>'DESC'])->where(['warehouse_id'=>$warehouse_id, 'transaction_date'=>$curent_date])
			->first();
			
			if(!empty($last_order_no)){
				$get_auto_no = h(str_pad(number_format($last_order_no->get_auto_no+1),6, '0', STR_PAD_LEFT));
				$get_no=$last_order_no->get_auto_no+1;
			}else{
				$get_auto_no=h(str_pad(number_format(1),6, '0', STR_PAD_LEFT));
				$get_no=1;
			}
			$get_date=str_replace('-','',$curent_date);
			$order_no=h('W'.$warehouse_id.$get_date.$get_auto_no);//orderno///
			
			$walkinSale->jain_thela_admin_id=$jain_thela_admin_id;
			$walkinSale->order_no=$order_no;
			$walkinSale->get_auto_no=$get_no;
			
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
		$jain_thela_admin_id=$this->Auth->User('jain_thela_admin_id');
		$walkinSale = $this->WalkinSales->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $walkinSale = $this->WalkinSales->patchEntity($walkinSale, $this->request->getData());
            if ($walkinsale_data=$this->WalkinSales->save($walkinSale)) {
				
				$walkinsale_id=$walkinsale_data->id;
					$walkinsale_total_amount=$walkinsale_data->total_amount;
					$transaction_date=$walkinsale_data->transaction_date;
					
					$query = $this->WalkinSales->Ledgers->query();
					$result = $query->update()
							->set([
							'ledger_account_id' => 2,
							'debit' => $walkinsale_total_amount,
							'credit' => 0,
							'transaction_date' => $transaction_date
							])
							->where(['walkin_sale_id' => $id, 'ledger_account_id'=>2])
					->execute();

					$query = $this->WalkinSales->Ledgers->query();
					$result = $query->update()
							->set([
							'ledger_account_id' => 3,
							'debit' => 0,
							'credit' => $walkinsale_total_amount,
							'transaction_date' => $transaction_date
							])
							->where(['walkin_sale_id' => $id, 'ledger_account_id'=>3])
					->execute();

                $this->Flash->success(__('The walkin sale has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The walkin sale could not be saved. Please, try again.'));
        }
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
        $jainThelaAdmins = $this->WalkinSales->JainThelaAdmins->find('list', ['limit' => 200]);
        $warehouses = $this->WalkinSales->Warehouses->find('list', ['limit' => 200]);
		$WalkinSaleDetails=$this->WalkinSales->WalkinSaleDetails->find()->where(['walkin_sale_id'=>$id])->contain(['Items'=>['Units']]);
        $this->set(compact('walkinSale', 'drivers', 'jainThelaAdmins', 'warehouses', 'WalkinSaleDetails', 'items'));
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
	
	public function walkinSaleDetails($item_id=null){
		$this->viewBuilder()->layout('index_layout');
		$jain_thela_admin_id=$this->Auth->User('jain_thela_admin_id');
		
		$from_date = $this->request->query('From');
		$to_date = $this->request->query('To');
		
		$where =[];
		if(!empty($from_date)){
			$from_date=date("Y-m-d",strtotime($this->request->query('From')));
			$where['Orders.transaction_date >=']=$from_date;
		}
		if(!empty($to_date)){
			$to_date=date("Y-m-d",strtotime($this->request->query('To')));
			$where['Orders.transaction_date <=']=$to_date;
		}
		$walkinSales = $this->WalkinSales->WalkinSaleDetails->find()->contain(['WalkinSales'=>function ($q) use($where){
			return $q->contain(['Drivers','Warehouses'])->where($where);
		},'Items'=>['Units']])->where(['WalkinSaleDetails.item_id'=>$item_id]);
	//	pr($walkinSales->toArray());
		 $this->set(compact('walkinSales'));
        $this->set('_serialize', ['walkinSales']);
	}
}
