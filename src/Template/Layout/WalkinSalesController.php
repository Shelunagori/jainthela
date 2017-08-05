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
    public function index($status=null)
    {
		$this->viewBuilder()->layout('index_layout');
        $jain_thela_admin_id=$this->Auth->User('jain_thela_admin_id');
		
		$status = $this->request->query('status');
		$order_no = $this->request->query('order_no');
		$from_date = $this->request->query('From');
		$to_date = $this->request->query('To');
		
		$drivers_id = $this->request->query('drivers');
		 $this->set(compact('order_no','from_date','to_date','drivers_id'));
		$where=[];
		
		if(!empty($order_no)){
			$where['WalkinSales.order_no Like'] = '%'.$order_no.'%';
		}
		if(!empty($from_date)){ 
			
		$where['WalkinSales.transaction_date >=']=date("Y-m-d",strtotime($from_date));
		}
		if(!empty($to_date)){
			
			$where['WalkinSales.transaction_date <='] = date("Y-m-d",strtotime($to_date));
		}
		/* if(!empty($seller)){
			$where[''] = '%'.$seller.'%';
		} */
		if(!empty($drivers_id)){
			$where['Drivers.id'] = $drivers_id;
		}
		
		if($status=='yes'){$today = date('Y-m-d');
			$walkinSales = $this->WalkinSales->find()->where(['WalkinSales.jain_thela_admin_id'=>$jain_thela_admin_id,'WalkinSales.transaction_date'=>$today])->where($where)->contain(['Drivers','Warehouses','WalkinSaleDetails'=>['Items'=>['Units']]])->order(['WalkinSales.transaction_date'=>'Desc']);
		}else{
			$walkinSales = $this->WalkinSales->find()->where($where)->where(['WalkinSales.jain_thela_admin_id'=>$jain_thela_admin_id])->contain(['Drivers','Warehouses','WalkinSaleDetails'=>['Items'=>['Units']]])->order(['WalkinSales.transaction_date'=>'Desc']);
		}
		
		$Drivers = $this->WalkinSales->Drivers->find('list');
		
	   $this->set(compact('walkinSales','Drivers','order_no','from_date','to_date','drivers_id'));
        $this->set('_serialize', ['walkinSales']);
    }

	public function invoiceReports()
    {
		$url=$this->request->here();
		$url=parse_url($url,PHP_URL_QUERY);
		
		$this->viewBuilder()->layout('index_layout');
        $jain_thela_admin_id=$this->Auth->User('jain_thela_admin_id');
		
		
		$warehouse_id = $this->request->query('warehouse');
		$drivers_id = $this->request->query('drivers');
		$from_date = $this->request->query('From');
		$type = $this->request->query('type');
		$to_date = $this->request->query('To');
		//pr($type);exit;
		$where =[];
		if(!empty($from_date)){
			$from_date=date("Y-m-d",strtotime($this->request->query('From')));
			$where['WalkinSales.transaction_date >=']=$from_date;
		}
		if(!empty($to_date)){ 
			$to_date=date("Y-m-d",strtotime($this->request->query('To')));
			$where['WalkinSales.transaction_date <=']=$to_date;
		}
		if(!empty($drivers_id)){
			$where['Drivers.id']=$drivers_id;
		}
		if(!empty($warehouse_id)){
			$where['Warehouses.id']=$warehouse_id;
		}
		
		
		$where1 =[];
		if(!empty($from_date)){
			$from_date=date("Y-m-d",strtotime($this->request->query('From')));
			$from_date= $from_date.' 00:00:00';
			$where1['Orders.delivery_date >=']=$from_date;
		}
		if(!empty($to_date)){
			$to_date=date("Y-m-d",strtotime($this->request->query('To')));
			$to_date= $to_date.' 23:59:59';
			$where1['Orders.delivery_date <=']=$to_date;
		}
		if(!empty($drivers_id)){
			$where1['Drivers.id']=$drivers_id;
		}
		if(!empty($warehouse_id)){
			$where1['Warehouses.id']=$warehouse_id;
		}
		
		
			if($type == 'Walkin'){
				if(!empty($where)){
					$walkinSales = $this->WalkinSales->find()->where(['WalkinSales.jain_thela_admin_id'=>$jain_thela_admin_id])
							   ->where($where)->contain(['Drivers','Warehouses','WalkinSaleDetails']);
				}
				
		}else if($type == 'Online'){  //pr($type);exit;
			if(!empty($where1)){ //echo"sdf";exit;
				$Orders = 	$this->WalkinSales->Orders->find()->contain(['Drivers','Warehouses','OrderDetails'])
						->where($where1)->where(['Orders.status IN'=>'Delivered','order_type NOT IN'=>'Bulkorder']);
			}			
		}
		else if($type == 'Bulkorder'){  //pr($type);exit;
			if(!empty($where1)){ //echo"sdf";exit;
				$Orders = 	$this->WalkinSales->Orders->find()->contain(['Drivers','Warehouses','OrderDetails'])
						->where($where1)->where(['Orders.status IN'=>'Delivered','order_type IN'=>'Bulkorder']);
			}			
		}
		else{ 
				if(!empty($where)){
					$walkinSales = $this->WalkinSales->find()->where(['WalkinSales.jain_thela_admin_id'=>$jain_thela_admin_id])
							   ->where($where)->contain(['Drivers','Warehouses','WalkinSaleDetails']);
				}
				if(!empty($where1)){
				$Orders = 	$this->WalkinSales->Orders->find()->contain(['Drivers','Warehouses','OrderDetails'])
						->where($where1)->where(['Orders.status IN'=>'Delivered','order_type NOT IN'=>'Bulkorder']);
			}
			
		}	
		
		$Drivers = $this->WalkinSales->Drivers->find('list');
		$Warehouses = $this->WalkinSales->Warehouses->find('list');
		$types=[];
		$types=[['text'=>'Walkin','value'=>'Walkin'],['text'=>'Online','value'=>'Online'],['text'=>'Bulkorder','value'=>'Bulkorder']];
		$this->set('_serialize', ['walkinSales']);
		$this->set(compact('walkinSales','Orders','from_date','to_date','Warehouses','Drivers','drivers_id','warehouse_id','type','types','url'));
		
    }

	public function exportExcel()
	{
		$this->viewBuilder()->layout('');
		$jain_thela_admin_id=$this->Auth->User('jain_thela_admin_id');
		$warehouse_id = $this->request->query('warehouse');
		$drivers_id = $this->request->query('drivers');
		$from_date = $this->request->query('From');
		$type = $this->request->query('type');
		$to_date = $this->request->query('To');
		//pr($type);exit;
		$where =[];
		if(!empty($from_date)){
			$from_date=date("Y-m-d",strtotime($this->request->query('From')));
			$where['WalkinSales.transaction_date >=']=$from_date;
		}
		if(!empty($to_date)){ 
			$to_date=date("Y-m-d",strtotime($this->request->query('To')));
			$where['WalkinSales.transaction_date <=']=$to_date;
		}
		if(!empty($drivers_id)){
			$where['Drivers.id']=$drivers_id;
		}
		if(!empty($warehouse_id)){
			$where['Warehouses.id']=$warehouse_id;
		}
		
		
		$where1 =[];
		if(!empty($from_date)){
			$from_date=date("Y-m-d",strtotime($this->request->query('From')));
			$from_date= $from_date.' 00:00:00';
			$where1['Orders.delivery_date >=']=$from_date;
		}
		if(!empty($to_date)){
			$to_date=date("Y-m-d",strtotime($this->request->query('To')));
			$to_date= $to_date.' 23:59:59';
			$where1['Orders.delivery_date <=']=$to_date;
		}
		if(!empty($drivers_id)){
			$where1['Drivers.id']=$drivers_id;
		}
		if(!empty($warehouse_id)){
			$where1['Warehouses.id']=$warehouse_id;
		}
		
			if($type == 'Walkin'){
				if(!empty($where)){
					$walkinSales = $this->WalkinSales->find()->where(['WalkinSales.jain_thela_admin_id'=>$jain_thela_admin_id])
							   ->where($where)->contain(['Drivers','Warehouses','WalkinSaleDetails']);
				}
				
		}else if($type == 'Online'){  //pr($type);exit;
			if(!empty($where1)){ //echo"sdf";exit;
				$Orders = 	$this->WalkinSales->Orders->find()->contain(['Drivers','Warehouses','OrderDetails'])
						->where($where1)->where(['Orders.status IN'=>'Delivered','order_type NOT IN'=>'Bulkorder']);
			}			
		}
		else if($type == 'Bulkorder'){  //pr($type);exit;
			if(!empty($where1)){ //echo"sdf";exit;
				$Orders = 	$this->WalkinSales->Orders->find()->contain(['Drivers','Warehouses','OrderDetails'])
						->where($where1)->where(['Orders.status IN'=>'Delivered','order_type IN'=>'Bulkorder']);
			}			
		}
		else{ 
				if(!empty($where)){
					$walkinSales = $this->WalkinSales->find()->where(['WalkinSales.jain_thela_admin_id'=>$jain_thela_admin_id])
							   ->where($where)->contain(['Drivers','Warehouses','WalkinSaleDetails']);
				}
				if(!empty($where1)){
				$Orders = 	$this->WalkinSales->Orders->find()->contain(['Drivers','Warehouses','OrderDetails'])
						->where($where1)->where(['Orders.status IN'=>'Delivered','order_type NOT IN'=>'Bulkorder']);
			}
			
		}	
		
		$Drivers = $this->WalkinSales->Drivers->find('list');
		$Warehouses = $this->WalkinSales->Warehouses->find('list');
		$types=[];
		$types=[['text'=>'Walkin','value'=>'Walkin'],['text'=>'Online','value'=>'Online'],['text'=>'Bulkorder','value'=>'Bulkorder']];
		$this->set(compact('walkinSales','Orders','from_date','to_date','Warehouses','Drivers','drivers_id','warehouse_id','type','types'));
		$this->set('_serialize', ['walkinSales']);
	}
	
	public function showSearch(){
		$this->viewBuilder()->layout('');
		$Drivers = $this->WalkinSales->Drivers->find('list');
		$Warehouses = $this->WalkinSales->Warehouses->find('list');
		$this->set(compact('walkinSales','Orders','from_date','to_date','Warehouses','Drivers','drivers_id','warehouse_id'));
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
        if ($this->request->is('post')) 
		{
			$warehouse_id = $this->request->data['warehouse_id'];
			@$driver_id = $this->request->data['driver_id'];
			
			$walkinSale = $this->WalkinSales->patchEntity($walkinSale, $this->request->getData());
			$curent_date=date('Y-m-d');
			$get_date=str_replace('-','',$curent_date);
			if(!empty($warehouse_id))
			{
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
				$order_no=h('WS'.$warehouse_id.$get_date.$get_auto_no);
			}
			else{
				$last_order_no = $this->WalkinSales->find()
				->select(['get_auto_no'])
				->order(['get_auto_no'=>'DESC'])->where(['driver_id'=>$driver_id, 'transaction_date'=>$curent_date])
				->first();
				
				if(!empty($last_order_no)){
					$get_auto_no = h(str_pad(number_format($last_order_no->get_auto_no+1),6, '0', STR_PAD_LEFT));
					$get_no=$last_order_no->get_auto_no+1;
				}else{
					$get_auto_no=h(str_pad(number_format(1),6, '0', STR_PAD_LEFT));
					$get_no=1;
				}
				$order_no=h('D'.$driver_id.$get_date.$get_auto_no);
			}
		
			
			//orderno///
			$walkinSale->jain_thela_admin_id=$jain_thela_admin_id;
			$walkinSale->order_no=$order_no;
			$walkinSale->get_auto_no=$get_no;
		
            if ($walkinsale_data=$this->WalkinSales->save($walkinSale)) { 
			foreach($walkinSale->walkin_sale_details as $walkin_sale_detail){
				$itemledgers = $this->WalkinSales->ItemLedgers->newEntity();
				$itemledgers->walkin_sales_id=$walkin_sale_detail['walkin_sale_id'];
				$itemledgers->jain_thela_admin_id=$jain_thela_admin_id;
				$itemledgers->warehouse_id=$walkinSale->warehouse_id;
				$itemledgers->item_id = $walkin_sale_detail['item_id'];
				$itemledgers->quantity = $walkin_sale_detail['quantity'];
				$itemledgers->rate = $walkin_sale_detail['rate'];
				$itemledgers->status = 'out';
				$itemledgers->transaction_date = $walkinSale->transaction_date;
				
				$this->WalkinSales->ItemLedgers->save($itemledgers);
			}
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
	
	public function walkinSaleDetails($item_id=null,$from_date=null,$to_date=null){
		
		$this->viewBuilder()->layout('index_layout');
		$jain_thela_admin_id=$this->Auth->User('jain_thela_admin_id');
		
		$walkinSales=$this->WalkinSales->ItemLedgers->find()
					->where(['item_id'=>$item_id,'walkin_sales_id !='=>0,'order_id'=>0,'ItemLedgers.transaction_date >='=>$from_date,'ItemLedgers.transaction_date <='=>$to_date])
					->contain(['WalkinSales'=>function($q){
						return $q->contain(['Drivers','Warehouses']);
					},'Items'=>['Units']])
					->order(['WalkinSales.id'=>'DESC']);
		
		/* $walkinSales = $this->WalkinSales->WalkinSaleDetails->find()->contain(['WalkinSales'=>function ($q) use($where){
				return $q->contain(['Drivers','Warehouses'])->where($where);
			},'Items'=>['Units']])->where(['WalkinSaleDetails.item_id IN'=>$item_ids])->order(['WalkinSales.id'=>'DESC']); */
		
	//	pr($walkinSales->toArray());
		 $this->set(compact('walkinSales','from_date','to_date'));
        $this->set('_serialize', ['walkinSales']);
	}
}
