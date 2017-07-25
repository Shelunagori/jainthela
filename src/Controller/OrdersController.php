<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Orders Controller
 *
 * @property \App\Model\Table\OrdersTable $Orders
 *
 * @method \App\Model\Entity\Order[] paginate($object = null, array $settings = [])
 */
class OrdersController extends AppController
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
		$curent_date=date('Y-m-d');
		
		$this->paginate = [
            'contain' => ['Customers']
        ];
        $orders = $this->paginate($this->Orders->find('all')
		->order(['Orders.id'=>'DESC'])
		->where(['jain_thela_admin_id'=>$jain_thela_admin_id])
		->contain(['CustomerAddresses']));
		
        $this->set(compact('orders'));
        $this->set('_serialize', ['orders']);
    }

	public function manageOrder()
    {
		$this->viewBuilder()->layout('index_layout');
		$jain_thela_admin_id=$this->Auth->User('jain_thela_admin_id');
		$curent_date=date('Y-m-d');
		$orders = $this->Orders->find('all')->order(['Orders.id'=>'DESC'])->where(['jain_thela_admin_id'=>$jain_thela_admin_id, 'curent_date'=>$curent_date, 'Orders.status'=>'In process'])->contain(['Customers']);
		
        $this->set(compact('orders'));
        $this->set('_serialize', ['orders']);
    }
	
    /**
     * View method
     *
     * @param string|null $id Order id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
		$this->viewBuilder()->layout('');
        $order = $this->Orders->get($id, [
            'contain' => ['Customers', 'PromoCodes', 'OrderDetails'=>['Items'=>['Units']], 'CustomerAddresses']
        ]);
        $this->set('order', $order);
        $this->set('_serialize', ['order']);
    }
	
	public function cancelBox($id = null)
    {
		$this->viewBuilder()->layout('');
        $order = $this->Orders->get($id);
		$CancelReasons=$this->Orders->CancelReasons->find('list');
		if ($this->request->is(['patch', 'post', 'put'])) {
			$cancel_id=$this->request->data['cancel_id'];
			$Orders=$this->Orders->get($id);
			$Orders->status='Cancel';
			$Orders->cancel_id=$cancel_id;
			$this->Orders->save($Orders);
			
			return $this->redirect(['action' => 'index']);
		}
        $this->set('order', $order);
        $this->set('CancelReasons', $CancelReasons);
        $this->set('_serialize', ['order', 'CancelReasons']);
    }

	public function ajaxDeliver($id = null)
    {
		$this->viewBuilder()->layout('');
         $order = $this->Orders->get($id, [
            'contain' => ['Customers']
        ]);
        $this->set('order', $order);
        $this->set('_serialize', ['order']);
    }
	
	public function undoBox($id = null)
    {
		$Orders = $this->Orders->get($id);
		$Orders->status='In Process';
		$Orders->cancel_id=0;
		 if ($this->Orders->save($Orders)) {
            $this->Flash->success(__('The Order has been reopened.'));
        } else {
            $this->Flash->error(__('The Order could not be Reopened. Please, try again.'));
        }
		return $this->redirect(['action' => 'index']);
		
    }
	public function ajaxOrderView()
    {
		$order_id=$this->request->data['odr_id'];
		$jain_thela_admin_id=$this->Auth->User('jain_thela_admin_id'); 
		$order_details=$this->Orders->OrderDetails->find()->where(['order_id'=>$order_id])->contain(['Items'=>['Units']]);

		pr($order_details->toArray());  
 		$this->set('order_details', $order_details);
 		$this->set('order_id', $order_id);
        $this->set('_serialize', ['order_details', 'order_id']);
		 
	}

	public function ajaxDeliverApi()
    {
		$order_id=$this->request->data['order_id'];
		$jain_thela_admin_id=$this->Auth->User('jain_thela_admin_id');
		$this->set(compact('jain_thela_admin_id', 'order_id'));
        $this->set('_serialize', ['jain_thela_admin_id', 'order_id']);
	}
    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add($order_type = Null,$bulkorder_id = Null)
    {
		
		@$bulkorder_id;
		$this->viewBuilder()->layout('index_layout');
		$jain_thela_admin_id=$this->Auth->User('jain_thela_admin_id');
        $order = $this->Orders->newEntity();
        if ($this->request->is('post')) {
            $order = $this->Orders->patchEntity($order, $this->request->getData());
			$curent_date=date('Y-m-d');

			$last_order_no = $this->Orders->find()->select(['order_no', 'get_auto_no'])->order(['order_no'=>'DESC'])->where(['jain_thela_admin_id'=>$jain_thela_admin_id, 'curent_date'=>$curent_date])->first();

			if(!empty($last_order_no)){
			$get_auto_no = h(str_pad(number_format($last_order_no->get_auto_no+1),6, '0', STR_PAD_LEFT));
			$next_get_auto_no=$last_order_no->get_auto_no+1;
			}else{
		    $get_auto_no=h(str_pad(number_format(1),6, '0', STR_PAD_LEFT));
			echo $next_get_auto_no=1;
			}
			$get_date=str_replace('-','',$curent_date);
			$exact_order_no=h('W'.$get_date.$get_auto_no);//orderno///
			
			$order->order_no=$exact_order_no;
 			$order->curent_date=$curent_date;
			$order->get_auto_no=$next_get_auto_no;
			$order->order_type=$order_type;
			$order->jain_thela_admin_id=$jain_thela_admin_id;
			$order->grand_total=$this->request->data['total_amount'];
			$order->delivery_date=date('Y-m-d', strtotime($this->request->data['delivery_date']));

            if ($this->Orders->save($order)) {

                $this->Flash->success(__('The order has been saved.'));

                return $this->redirect(['action' => 'index']);
            }

            $this->Flash->error(__('The order could not be saved. Please, try again.'));
        }
        $customer_fetchs = $this->Orders->Customers->find('all');
		foreach($customer_fetchs as $customer_fetch){
			$customer_name=$customer_fetch->name;
			$customer_mobile=$customer_fetch->mobile;
			$customers[]= ['value'=>$customer_fetch->id,'text'=>$customer_name." (".$customer_mobile.")"];
		}
		$deliverytime_fetchs = $this->Orders->DeliveryTimes->find('all');
		foreach($deliverytime_fetchs as $deliverytime_fetch){
			$time_id=$deliverytime_fetch->id;
			$time_from=$deliverytime_fetch->time_from;
			$time_to=$deliverytime_fetch->time_to;
			$delivery_time[]= ['value'=>$time_id,'text'=>$time_from." - ".$time_to];
		}
       // $promoCodes = $this->Orders->PromoCodes->find('list');
		$item_fetchs = $this->Orders->Items->find()->where(['Items.jain_thela_admin_id' => $jain_thela_admin_id, 'Items.freeze !='=>1])->contain(['Units']);

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
		$this->loadModel('BulkBookingLeads');
        $bulk_Details = $this->BulkBookingLeads->find()->where(['id' => $bulkorder_id])->toArray();

        $this->set(compact('order', 'customers', 'items', 'order_type', 'bulk_Details', 'bulkorder_id','delivery_time'));
        $this->set('_serialize', ['order']);
    }
	/**
     * Ajax method
     **/
	public function ajaxCustomerDiscount()
    {
		$this->viewBuilder()->layout('ajax');
		$jain_thela_admin_id=$this->Auth->User('jain_thela_admin_id');
		$customer = $this->Orders->Customers->get($this->request->data['customer_id']);
		$this->set(compact('customer'));
	}
    /**
     * Edit method
     *
     * @param string|null $id Order id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
		$this->viewBuilder()->layout('index_layout');
		$jain_thela_admin_id=$this->Auth->User('jain_thela_admin_id');
		$curent_date=date('Y-m-d');
		
        $order = $this->Orders->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $order = $this->Orders->patchEntity($order, $this->request->getData());
			$order->grand_total=$this->request->data['total_amount'];
			$order->delivery_date=date('Y-m-d', strtotime($this->request->data['delivery_date']));

            if ($this->Orders->save($order)) {
                $this->Flash->success(__('The order has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The order could not be saved. Please, try again.'));
        }
		$item_fetchs = $this->Orders->Items->find()->where(['Items.jain_thela_admin_id' => $jain_thela_admin_id, 'Items.freeze !='=>1])->contain(['Units']);

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
        $customer_fetchs = $this->Orders->Customers->find('all');
		foreach($customer_fetchs as $customer_fetch){
			$customer_name=$customer_fetch->name;
			$customer_mobile=$customer_fetch->mobile;
			$customers[]= ['value'=>$customer_fetch->id,'text'=>$customer_name." (".$customer_mobile.")"];
		}
		$deliverytime_fetchs = $this->Orders->DeliveryTimes->find('all');
		foreach($deliverytime_fetchs as $deliverytime_fetch){
			$time_id=$deliverytime_fetch->id;
			$time_from=$deliverytime_fetch->time_from;
			$time_to=$deliverytime_fetch->time_to;
			$delivery_time[]= ['value'=>$time_id,'text'=>$time_from." - ".$time_to];
		}
        $promoCodes = $this->Orders->PromoCodes->find('list', ['limit' => 200]);
        $OrderDetails = $this->Orders->OrderDetails->find()->where(['order_id'=>$id]);
        $this->set(compact('order', 'customers', 'promoCodes', 'OrderDetails', 'items','delivery_time'));
        $this->set('_serialize', ['order']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Order id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $order = $this->Orders->get($id);
        if ($this->Orders->delete($order)) {
            $this->Flash->success(__('The order has been deleted.'));
        } else {
            $this->Flash->error(__('The order could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
	
	public function onlineSaleDetails($item_id=null){
		$this->viewBuilder()->layout('index_layout');
		$jain_thela_admin_id=$this->Auth->User('jain_thela_admin_id');
		
		$from_date = $this->request->query('From');
		$to_date = $this->request->query('To');
		
		$where =[];
		if(!empty($from_date)){
			$from_date=date("Y-m-d",strtotime($this->request->query('From')));
			$where['Orders.delivery_date >=']=$from_date;
		}
		if(!empty($to_date)){
			$to_date=date("Y-m-d",strtotime($this->request->query('To')));
			$where['Orders.delivery_date <=']=$to_date;
		}
		$where1 =[];
		if(empty($from_date)){
			$from_date=date("Y-m-01");
			$where1['Orders.delivery_date >=']=$from_date;
		}
		if(empty($to_date)){
			$to_date=date('Y-m-d');
			$where1['Orders.delivery_date <=']=$to_date;
		}
		if(!empty($where)){
			$onlineSales = $this->Orders->OrderDetails->find()->contain(['Orders'=>function ($q) use($where){
				return $q->where(['order_type IN'=>['Cod','Online','Wallet','cod','Offline']])->where($where)
				;
			},'Items'=>['Units']])->where(['OrderDetails.item_id'=>$item_id])->order(['Orders.id'=>'Desc']);
		}else{
			$onlineSales = $this->Orders->OrderDetails->find()->contain(['Orders'=>function ($q) use($where1){
				return $q->where(['order_type IN'=>['Cod','Online','Wallet','cod','Offline']])->where($where1)
				;
			},'Items'=>['Units']])->where(['OrderDetails.item_id'=>$item_id])->order(['Orders.id'=>'Desc']);
		}
		//pr($onlineSales->toArray());exit;
		 $this->set(compact('onlineSales','from_date','to_date'));
        $this->set('_serialize', ['onlineSales']);
	}
	
	public function bulkSaleDetails($item_id=null){
		$this->viewBuilder()->layout('index_layout');
		$jain_thela_admin_id=$this->Auth->User('jain_thela_admin_id');
		
		$from_date = $this->request->query('From');
		$to_date = $this->request->query('To');
		
		$where =[];
		if(!empty($from_date)){
			$from_date=date("Y-m-d",strtotime($this->request->query('From')));
			$where['Orders.delivery_date >=']=$from_date;
		}
		if(!empty($to_date)){
			$to_date=date("Y-m-d",strtotime($this->request->query('To')));
			$where['Orders.delivery_date <=']=$to_date;
		}
		
		$where1 =[];
		if(empty($from_date)){
			$from_date=date("Y-m-01");
			$where1['Orders.delivery_date >=']=$from_date;
		}
		if(empty($to_date)){
			$to_date=date('Y-m-d');
			$where1['Orders.delivery_date <=']=$to_date;
		}
		if(!empty($where)){
			$bulkSales = $this->Orders->OrderDetails->find()->contain(['Orders'=>function ($q) use($where){
				return $q->where(['order_type IN'=>['Bulkorder']])->where($where);
			},'Items'=>['Units']])->where(['OrderDetails.item_id'=>$item_id])->order(['Orders.id'=>'Desc']);
		}else{
			$bulkSales = $this->Orders->OrderDetails->find()->contain(['Orders'=>function ($q) use($where1){
				return $q->where(['order_type IN'=>['Bulkorder']])->where($where1);
			},'Items'=>['Units']])->where(['OrderDetails.item_id'=>$item_id])->order(['Orders.id'=>'Desc']);
		}	
		//pr($bulkSales->toArray());exit;
		 $this->set(compact('bulkSales','from_date','to_date'));
        $this->set('_serialize', ['bulkSales']);
	}
}
