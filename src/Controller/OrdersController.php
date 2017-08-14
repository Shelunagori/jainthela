<?php
namespace App\Controller;
use Cake\Event\Event;
use Cake\View\View;
use Cake\Routing\Router;
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
	public function initialize()
	{
		parent::initialize();
		$this->Auth->allow(['logout']);
		$role_id=$this->Auth->User('role_id');
		$this->set(compact(['role_id']));
	}
	public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        // Allow users to register and logout.
        // You should not add the "login" action to allow list. Doing so would
        // cause problems with normal functioning of AuthComponent.
        $this->Auth->allow([ 'logout', 'login']);
    }
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
	 
	public function dashboard()
    { 
		$this->viewBuilder()->layout('index_layout');
		$curent_date=date('Y-m-d');
		$query = $this->Orders->find();
		
		$totalOrder=$query
		->select([
		'count' => $query->func()->count('id'),
		'total_amount' => $query->func()->sum('Orders.grand_total')])
		->where(['Orders.delivery_date' => $curent_date])->first();
		
		$this->set(compact('totalOrder'));
		
		$query = $this->Orders->find();
		$inProcessOrder=$query->select([
		'count' => $query->func()->count('id'),
		'total_amount' => $query->func()->sum('Orders.grand_total')])
		->where(['Orders.delivery_date' => $curent_date, 'Orders.status' => 'In Process'])->first();
		$this->set(compact('inProcessOrder'));
		
		$this->loadModel('WalkinSales');
		$query = $this->WalkinSales->find();
		$walkinsales=$query->select([
		'count' => $query->func()->count('id'),
		'total_amount' => $query->func()->sum('total_amount')]) 
		->where(['WalkinSales.transaction_date' => $curent_date])->first();
		$this->set(compact('walkinsales'));
		
		$query = $this->Orders->find();
		$deliveredOrder=$query->select([
		'count' => $query->func()->count('id'),
		'total_amount' => $query->func()->sum('Orders.grand_total')])
		->where(['Orders.delivery_date' => $curent_date, 'Orders.status' => 'Delivered'])->first();
		$this->set(compact('deliveredOrder'));
		
		
		$query = $this->Orders->find();
		$cancelOrder=$query->select([
		'count' => $query->func()->count('id'),
		'total_amount' => $query->func()->sum('Orders.grand_total')])
		->where(['Orders.delivery_date' => $curent_date, 'Orders.status' => 'Cancel'])->first();
		$this->set(compact('cancelOrder'));
		
		$query = $this->Orders->find();
		$bulkOrder=$query->select([
		'count' => $query->func()->count('id'),
		'total_amount' => $query->func()->sum('Orders.grand_total')])
		->where(['Orders.delivery_date' => $curent_date, 'Orders.order_type' => 'Bulkorder', 'Orders.status' => 'In Process'])->first();
		$this->set(compact('bulkOrder'));
		$curent_date=date('Y-m-d');
		$orders = $this->Orders->find('all')->order(['Orders.id'=>'DESC'])->where(['curent_date'=>$curent_date, 'Orders.status'=>'In process'])->contain(['Customers']);
		$this->set(compact('orders'));
        $this->set('_serialize', ['orders']);
    }
	
    public function index($status=null,$type=null)
    {
		$this->viewBuilder()->layout('index_layout');
		$jain_thela_admin_id=$this->Auth->User('jain_thela_admin_id');
		$curent_date=date('Y-m-d');
		$status = $this->request->query('status');
		$type = $this->request->query('type');
		$order_no = $this->request->query('order_no');
		$customer_id = $this->request->query('customer');
		$order_types = $this->request->query('order_type');
		$orderstatus = $this->request->query('orderstatus');
		$from_date = $this->request->query('From');
		$to_date = $this->request->query('To');
		$where =[];
		
		if(!empty($order_no)){
			$where['Orders.order_no Like']='%'.$order_no.'%';
		}
		if(!empty($customer_id)){
			$where['Orders.customer_id']=$customer_id;
			
		}
		if(!empty($order_types)){
			$where['Orders.order_type']=$order_types;
		}
		if(!empty($orderstatus)){
			$where['Orders.status']=$orderstatus;
		}
		if(!empty($from_date)){ 
			$where['Orders.curent_date >=']=date('Y-m-d',strtotime($from_date));
		}
		if(!empty($to_date)){
			$where['Orders.curent_date <=']=date('Y-m-d',strtotime($to_date));
		}
		//pr($where); exit;
		//pr($where);exit;
		 $this->paginate = [
            'contain' => ['Customers']
        ];
		
		if($status == 'process'){ 
							$where['Orders.status']='In Process';
							$cur_date = date('d-m-Y');
							$orders =$this->paginate($this->Orders->find('all')
							->where($where)
							->order(['Orders.id'=>'DESC'])
							->where(['jain_thela_admin_id'=>$jain_thela_admin_id])
							->contain(['CustomerAddresses']));
							$cur_status = 'In Process';
							 $this->set(compact('orders','cur_status','cur_date','status'));
		}else if($status == 'delivered'){
							$where['Orders.status']='Delivered';
							$cur_date = date('d-m-Y');
							$orders =$this->paginate($this->Orders->find('all')
							->where($where)
							->order(['Orders.id'=>'DESC'])
							->where(['jain_thela_admin_id'=>$jain_thela_admin_id,'Orders.curent_date'=>$cur_date])
							->contain(['CustomerAddresses']));
							$cur_status = 'Delivered';
							
							 $this->set(compact('orders','cur_status','cur_date','status'));
		}else
			 if($status == 'cancel'){
							$where['Orders.status']='Cancel';
							$cur_date = date('d-m-Y');
							$orders =$this->paginate($this->Orders->find('all')
							->where($where)
							->order(['Orders.id'=>'DESC'])
							->where(['jain_thela_admin_id'=>$jain_thela_admin_id,'Orders.curent_date'=>$cur_date])
							->contain(['CustomerAddresses']));
							$cur_status = 'Cancel';
			
							$this->set(compact('orders','cur_status','cur_date','status'));
		}else if($type == 'bulkorder'){ 
							$where['Orders.order_type']='Bulkorder';
							$cur_date = date('d-m-Y');
							$orders =$this->paginate($this->Orders->find('all')
							->where($where)
							->order(['Orders.id'=>'DESC'])
							->where(['jain_thela_admin_id'=>$jain_thela_admin_id,'Orders.curent_date'=>$cur_date])
							->contain(['CustomerAddresses']));
							$cur_type = 'Bulkorder';
							
							 $this->set(compact('orders','cur_date','cur_type'));
		}else if($status == 'yes'){
							$cur_date = date('d-m-Y');
							$orders =$this->paginate($this->Orders->find('all')
							->where($where)
							->order(['Orders.id'=>'DESC'])
							->where(['jain_thela_admin_id'=>$jain_thela_admin_id,'Orders.curent_date'=>$cur_date])
							->contain(['CustomerAddresses']));
							$this->set(compact('orders','cur_date','cur_type'));
		}else{
							
							$orders =$this->paginate($this->Orders->find('all')
							->where($where)
							->order(['Orders.id'=>'DESC'])
							->where(['jain_thela_admin_id'=>$jain_thela_admin_id])
							->contain(['CustomerAddresses']));
		}
       
		//pr($orders->toArray()); exit;
		$Customers = $this->Orders->Customers->find();
		$Customer_data=[];
		foreach($Customers as $Customer){
			$Customer_data[$Customer->id]= $Customer->name.'('.$Customer->mobile.')';
		}
		$order_type=[];
		$order_type=[['text'=>'Bulkorder','value'=>'Bulkorder'],['text'=>'Cod','value'=>'Cod'],['text'=>'Offline','value'=>'Offline'],['text'=>'Online','value'=>'Online'],['text'=>'Wallet','value'=>'Wallet']];
		
		$OrderStatus=[];
		$OrderStatus=[['text'=>'Cancel','value'=>'Cancel'],['text'=>'Delivered','value'=>'Delivered'],['text'=>'In Process','value'=>'In Process']];
        $this->set(compact('orders','Customer_data','order_type','OrderStatus','order_no','customer_id','order_types','orderstatus','from_date','to_date','status'));
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
	
	  public function report($id = null)
    {
		$this->viewBuilder()->layout('index_layout');
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
		$order_date=$order->order_date;
		$delivery_date=$order->delivery_date;
		$delivery_charge=$order->delivery_charge;
		$total_amount=$order->total_amount;
		$curent_date=$order->curent_date;
		$amount_from_wallet=$order->amount_from_wallet;
		$online_amount=$order->online_amount;
		$amount_from_jain_cash=$order->amount_from_jain_cash;
		$amount_from_promo_code=$order->amount_from_promo_code;
		$paid_amount=$amount_from_wallet+$online_amount+$amount_from_jain_cash+$amount_from_promo_code;
		$online_amount=$order->online_amount;
		$customer_id=$order->customer_id;
		$CancelReasons=$this->Orders->CancelReasons->find('list');
		if ($this->request->is(['patch', 'post', 'put'])) {
			$cancel_id=$this->request->data['cancel_id'];
			$Orders=$this->Orders->get($id);
			$Orders->order_date=$order_date;
			$Orders->delivery_date=$delivery_date;
			$Orders->curent_date=$curent_date;
			$Orders->status='Cancel';
			$Orders->cancel_id=$cancel_id;
			$this->Orders->save($Orders);
			$grand_total=$total_amount+$delivery_charge;
			$remaining_amount=$grand_total-$paid_amount;
			$remaining_paid_amount=$paid_amount-$grand_total;
			
			$this->Orders->Wallets->deleteAll(['return_order_id'=>$Orders->id]);
			
			if($remaining_amount>=0){
				$return_amount=$paid_amount;
			}
			else if($remaining_paid_amount>0){
				$return_amount=$paid_amount;
			}
			if($return_amount>0){
			$query = $this->Orders->Wallets->query();
					$query->insert(['customer_id', 'advance', 'narration', 'return_order_id'])
							->values([
							'customer_id' => $customer_id,
							'advance' => $return_amount,
							'narration' => 'Amount Return form Order',
							'return_order_id' => $id
							])
					->execute();
			}
			return $this->redirect(['action' => 'index']);
		}
        $this->set('order', $order);
        $this->set('CancelReasons', $CancelReasons);
        $this->set('_serialize', ['order', 'CancelReasons']);
    }

	public function ajaxDeliver($id = null)
    {
		$this->viewBuilder()->layout('');
         $Orders = $this->Orders->get($id, [
            'contain' => ['Customers', 'OrderDetails'=>['Items'=>['Units']]]
        ]);
        $this->set('Orders', $Orders);
        $this->set('_serialize', ['Orders']);
    }
	
	public function updateOrders($order_id = null,$item_id = null,$actual_quantity=null,$amount = null){
		
		$quantity=explode(',',$actual_quantity);
		$items=explode(',',$item_id);
		$item_amount=explode(',',$amount);
		$x=0;
		$final_amount=0;
		foreach($items as $item){ 
			$qty = $quantity[$x];
			$amt = $item_amount[$x];
			$final_amount+=$amt;
				$query = $this->Orders->OrderDetails->query();
					$query->update()
							->set(['actual_quantity' => $qty, 'amount' => $amt])
							->where(['item_id'=>$item,'order_id'=>$order_id])
							->execute();
				$x++;		
		}
		$Orders = $this->Orders->get($order_id);
		$customer_id=$Orders->customer_id;
		$amount_from_wallet=$Orders->amount_from_wallet;
		$amount_from_jain_cash=$Orders->amount_from_jain_cash;
		$amount_from_promo_code=$Orders->amount_from_promo_code;
		$online_amount=$Orders->online_amount;
		$paid_amount=$amount_from_wallet+$amount_from_jain_cash+$amount_from_promo_code+$online_amount;
		
		$total_amount=$final_amount;
		if($total_amount<100){
			$delivery_charge=100;
		}else{
			$delivery_charge=0;
		}
		$pay_amount=$Orders->pay_amount;
		$final_amount;
		
			$grand_total=$total_amount+$delivery_charge;
			$remaining_amount=$grand_total-$paid_amount;
			$remaining_paid_amount=$paid_amount-$grand_total;
 			$this->Orders->Wallets->deleteAll(['return_order_id'=>$order_id]);
			
			if($remaining_amount>=0){
				$return_amount=0;
				$real_pay_amount=$remaining_amount;
			}
			else if($remaining_paid_amount>0){
				$return_amount=$remaining_paid_amount;
				$real_pay_amount=0;
				
			if($return_amount>0){
			$query = $this->Orders->Wallets->query();
					$query->insert(['customer_id', 'advance', 'narration', 'return_order_id'])
							->values([
							'customer_id' => $customer_id,
							'advance' => $return_amount,
							'narration' => 'Amount Return form Order',
							'return_order_id' => $order_id
							])
					->execute();
			}
			}
				$query = $this->Orders->query();
					$query->update()
							->set(['total_amount' => $total_amount,'grand_total' => $grand_total,'delivery_charge' => $delivery_charge,'pay_amount' => $real_pay_amount])
							->where(['id' => $order_id])
							->execute();
		
		exit;
	}
	
	public function undoBox($id = null)
    {
		$Orders = $this->Orders->get($id);
		$order_date=$Orders->order_date;
		$Orders->status='In Process';
		$Orders->order_date=$order_date;
		$Orders->cancel_id=0;
		
		$delivery_date=$Orders->delivery_date;
		$delivery_charge=$Orders->delivery_charge;
		$total_amount=$Orders->total_amount;
		$curent_date=$Orders->curent_date;
		$amount_from_wallet=$Orders->amount_from_wallet;
		$online_amount=$Orders->online_amount;
		$amount_from_jain_cash=$Orders->amount_from_jain_cash;
		$amount_from_promo_code=$Orders->amount_from_promo_code;
		$paid_amount=$amount_from_wallet+$online_amount+$amount_from_jain_cash+$amount_from_promo_code;
		$online_amount=$Orders->online_amount;
		$customer_id=$Orders->customer_id;
		
			$grand_total=$total_amount+$delivery_charge;
			$remaining_amount=$grand_total-$paid_amount;
			$remaining_paid_amount=$paid_amount-$grand_total;
 			$this->Orders->Wallets->deleteAll(['return_order_id'=>$id]);
			
		 if ($this->Orders->save($Orders)) {
			 
			if($remaining_amount>=0){
				$return_amount=0;
			}
			else if($remaining_paid_amount>0){
				$return_amount=$remaining_paid_amount;
			if($return_amount>0){
			$query = $this->Orders->Wallets->query();
					$query->insert(['customer_id', 'advance', 'narration', 'return_order_id'])
							->values([
							'customer_id' => $customer_id,
							'advance' => $return_amount,
							'narration' => 'Amount Return form Order',
							'return_order_id' => $id
							])
					->execute();
			}
			}
			
			$this->Orders->ItemLedgers->deleteAll(['order_id'=>$Orders->id]);
			
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

		//pr($order_details->toArray());  
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
	 
	public function bulkorderAdd($order_type = Null,$bulkorder_id = Null)
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
			if($order_type == 'Bulkorder'){
				$order->order_type=$order_type;
			}else{
				$order->order_type='Cod';
			}
			$order->jain_thela_admin_id=$jain_thela_admin_id;
			$order->grand_total=$this->request->data['total_amount'];
			$order->delivery_date=date('Y-m-d', strtotime($this->request->data['delivery_date']));
			
            if ($orderDetails = $this->Orders->save($order)) {
				/* $send_data = $orderDetails->id ;
				$order_detail_fetch=$this->Orders->get($send_data);
				$order_no=$order_detail_fetch->order_no;
				$delivery_date=date('Y-m-d', strtotime($order_detail_fetch->delivery_date));
			
				$customer_id=$order_detail_fetch->customer_id;
				$customer_details=$this->Orders->Customers->find()
                    ->where(['Customers.id' => $customer_id])->first();
                    $mobile=$customer_details->mobile;
                    $API_ACCESS_KEY=$customer_details->notification_key;
                    $device_token=$customer_details->device_token;
                    $device_token1=rtrim($device_token);
                    $time1=date('Y-m-d G:i:s');

					if(!empty($device_token1))
					{

					$msg = array
					(
					'message'     => 'Thank you, Your order has been successfully placed.',
					'image'     => '',
					'button_text'    => 'Track Your Order',
					'link' => 'jainthela://track_order?id='.$send_data,
					'notification_id'    => 1,
					);

					$url = 'https://fcm.googleapis.com/fcm/send';
					$fields = array
					(
						'registration_ids'     => array($device_token1),
						'data'            => $msg
					);
					$headers = array
					(
						'Authorization: key=' .$API_ACCESS_KEY,
						'Content-Type: application/json'
					);

					  //echo json_encode($fields);
					  $ch = curl_init();
					curl_setopt($ch, CURLOPT_URL, $url);
					curl_setopt($ch, CURLOPT_POST, true);
					curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
					curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
					curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
					curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
					curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
					$result001 = curl_exec($ch);
					if ($result001 === FALSE) {
						die('FCM Send Error: ' . curl_error($ch));
					}
					curl_close($ch);
				} */
				
				$customer = $this->Orders->Customers->get($order->customer_id);
				$ledgerAccount = $this->Orders->LedgerAccounts->newEntity();
				$ledgerAccount->name = $customer->name.$customer->mobile;
				$ledgerAccount->customer_id = $order->customer_id;
				$ledgerAccount->account_group_id = '5';
				$ledgerAccount->jain_thela_admin_id = $jain_thela_admin_id;
				$this->Orders->LedgerAccounts->save($ledgerAccount);
					$ledgers = $this->Orders->Ledgers->newEntity();
					$ledgers->ledger_account_id	 = $ledgerAccount->id;
					$ledgers->debit = $order->grand_total;
					$ledgers->credit = '0';
					$this->Orders->Ledgers->save($ledgers);

					$ledgers = $this->Orders->Ledgers->newEntity();
					$ledgers->ledger_account_id	 = 9;
					$ledgers->debit = $order->amount_from_wallet;
					$ledgers->credit = '0';
					if($order->amount_from_wallet > 0){
					$this->Orders->Ledgers->save($ledgers);
					}
					
					$ledgers = $this->Orders->Ledgers->newEntity();
					$ledgers->ledger_account_id	 = 8;
					$ledgers->debit = '0';
					$ledgers->credit = ($order->grand_total+$order->amount_from_wallet);
					$this->Orders->Ledgers->save($ledgers);
				
				$this->Flash->success(__('The order has been saved.'));
				if($order_type == 'Bulkorder'){
					return $this->redirect(['action' => 'report/'.$send_data]);
				}else{
					return $this->redirect(['action' => 'index']);
				}
               
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
		$item_fetchs = $this->Orders->Items->find()->where(['Items.jain_thela_admin_id' => $jain_thela_admin_id, 'Items.freeze !='=>1, 'Items.ready_to_sale' => 'Yes'])->contain(['Units']);

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
		
		$warehouses = $this->Orders->Warehouses->find('list')->where(['jain_thela_admin_id' => $jain_thela_admin_id]);
       
        $this->set(compact('order', 'customers', 'items', 'order_type', 'bulk_Details', 'bulkorder_id','delivery_time','warehouses'));
        $this->set('_serialize', ['order']);
    }
	
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
			if($order_type == 'Bulkorder'){
				$order->order_type=$order_type;
			}else{
				$order->order_type='Cod';
			}
			$order->jain_thela_admin_id=$jain_thela_admin_id;
			//$order->grand_total=$this->request->data['total_amount'];
			$order->delivery_date=date('Y-m-d', strtotime($this->request->data['delivery_date']));
			$order->order_date=date('Y-m-d H:i:s');
			//pr($order);exit;
            if ($orderDetails = $this->Orders->save($order)) {
				if($order->amount_from_wallet>0){
				$query = $this->Orders->Wallets->query();
					$query->insert(['customer_id', 'consumed', 'order_id'])
							->values([
							'customer_id' => $order->customer_id,
							'consumed' => $order->amount_from_wallet,
							'order_id' => $orderDetails->id
							])
					->execute();
				}
				/*
			  	$send_data = $orderDetails->id ;
				$order_detail_fetch=$this->Orders->get($send_data);
				$order_no=$order_detail_fetch->order_no;
				$delivery_date=date('Y-m-d', strtotime($order_detail_fetch->delivery_date));
			
				$customer_id=$order_detail_fetch->customer_id;
				$customer_details=$this->Orders->Customers->find()
                    ->where(['Customers.id' => $customer_id])->first();
                    $mobile=$customer_details->mobile;
                    $API_ACCESS_KEY=$customer_details->notification_key;
                    $device_token=$customer_details->device_token;
                    $device_token1=rtrim($device_token);
                    $time1=date('Y-m-d G:i:s');

					if(!empty($device_token1))
					{

					$msg = array
					(
					'message'     => 'Thank you, Your order has been successfully placed.',
					'image'     => '',
					'button_text'    => 'Track Your Order',
					'link' => 'jainthela://track_order?id='.$send_data,
					'notification_id'    => 1,
					);
					
					$url = 'https://fcm.googleapis.com/fcm/send';
					$fields = array
					(
						'registration_ids'     => array($device_token1),
						'data'            => $msg
					);
					$headers = array
					(
						'Authorization: key=' .$API_ACCESS_KEY,
						'Content-Type: application/json'
					);

					json_encode($fields);
					$ch = curl_init();
					curl_setopt($ch, CURLOPT_URL, $url);
					curl_setopt($ch, CURLOPT_POST, true);
					curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
					curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
					curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
					curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
					curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
					$result001 = curl_exec($ch);
					
					if ($result001 === FALSE) {
						die('FCM Send Error: ' . curl_error($ch));
					}
					curl_close($ch);
				}  
				*/
				$customer = $this->Orders->Customers->get($order->customer_id);
				$ledgerAccount = $this->Orders->LedgerAccounts->newEntity();
				$ledgerAccount->name = $customer->name.$customer->mobile;
				$ledgerAccount->customer_id = $order->customer_id;
				$ledgerAccount->account_group_id = '5';
				$ledgerAccount->jain_thela_admin_id = $jain_thela_admin_id;
				$this->Orders->LedgerAccounts->save($ledgerAccount);
				
				
				
					$ledgers = $this->Orders->Ledgers->newEntity();
					$ledgers->ledger_account_id	 = $ledgerAccount->id;
					$ledgers->debit = $order->grand_total;
					$ledgers->credit = '0';
					$this->Orders->Ledgers->save($ledgers);

					$ledgers = $this->Orders->Ledgers->newEntity();
					$ledgers->ledger_account_id	 = 9;
					$ledgers->debit = $order->amount_from_wallet;
					$ledgers->credit = '0';
					if($order->amount_from_wallet > 0){
					$this->Orders->Ledgers->save($ledgers);
					}
					
					$ledgers = $this->Orders->Ledgers->newEntity();
					$ledgers->ledger_account_id	 = 8;
					$ledgers->debit = '0';
					$ledgers->credit = ($order->grand_total+$order->amount_from_wallet);
					$this->Orders->Ledgers->save($ledgers);
				
				$this->Flash->success(__('The order has been saved.'));
				if($order_type == 'Bulkorder'){
					//return $this->redirect(['action' => 'report/'.$send_data]);
					return $this->redirect(['action' => 'index']);
				}else{
					return $this->redirect(['action' => 'index']);
				}
               
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
		$item_fetchs = $this->Orders->Items->find()->where(['Items.jain_thela_admin_id' => $jain_thela_admin_id, 'Items.freeze !='=>1, 'Items.ready_to_sale' => 'Yes'])->contain(['Units']);

		foreach($item_fetchs as $item_fetch){
			$item_name=$item_fetch->name;
			$alias_name=$item_fetch->alias_name;
			@$unit_name=$item_fetch->unit->unit_name;
			$print_quantity=$item_fetch->print_quantity;
			$rates=$item_fetch->offline_sales_rate;
			$sales_rates=$item_fetch->sales_rate;
			$minimum_quantity_factor=$item_fetch->minimum_quantity_factor;
			$minimum_quantity_purchase=$item_fetch->minimum_quantity_purchase;
			$is_combo=$item_fetch->is_combo;
			
			$items[]= ['value'=>$item_fetch->id,'text'=>$item_name." (".$alias_name.")", 'print_quantity'=>$print_quantity, 'rates'=>$rates,'sales_rate' =>$sales_rates,'minimum_quantity_factor'=>$minimum_quantity_factor, 'unit_name'=>$unit_name, 'minimum_quantity_purchase'=>$minimum_quantity_purchase,'is_combo' => $is_combo];
		}
		$this->loadModel('BulkBookingLeads');
        $bulk_Details = $this->BulkBookingLeads->find()->where(['id' => $bulkorder_id])->toArray();
		$warehouses = $this->Orders->Warehouses->find('list')->where(['jain_thela_admin_id' => $jain_thela_admin_id]);
        $this->set(compact('order', 'customers', 'items', 'order_type', 'bulk_Details', 'bulkorder_id','delivery_time','tax', 'warehouses'));
        $this->set('_serialize', ['order', 'warehouses']);
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
            'contain' => ['Customers'=>['CustomerAddresses']]
        ]);
		 
		//pr($order->customer->customer_addresses[0]['address']); exit;
		$amount_from_wallet=$order->amount_from_wallet;
		$amount_from_jain_cash=$order->amount_from_jain_cash;
		$amount_from_promo_code=$order->amount_from_promo_code; 
		$online_amount=$order->online_amount; 
		$customer_id=$order->customer_id;
		$order_date=$order->order_date;
		$discount_perc=$order->discount_percent;
		$paid_amount=$amount_from_wallet+$amount_from_jain_cash+$amount_from_promo_code+$online_amount;
        if ($this->request->is(['patch', 'post', 'put'])) {
             $order = $this->Orders->patchEntity($order, $this->request->getData());
			$total_amount=$this->request->data['total_amount'];
			$delivery_charge=$this->request->data['delivery_charge'];
			$grand_total=$this->request->data['grand_total'];
			$remaining_amount=$grand_total-$paid_amount;
			$remaining_paid_amount=$paid_amount-$grand_total;
			$this->Orders->Wallets->deleteAll(['return_order_id'=>$id]);
			if($remaining_amount>=0){
				$order->pay_amount=$remaining_amount;
			}
			else if($remaining_paid_amount>0){
				$order->pay_amount=0;
				
				$query = $this->Orders->Wallets->query();
					$query->insert(['customer_id', 'advance', 'narration', 'return_order_id'])
							->values([
							'customer_id' => $customer_id,
							'advance' => $remaining_paid_amount,
							'narration' => 'Amount Return form Order',
							'return_order_id' => $id
							])
					->execute();
			}
			//$order->grand_total=$grand_total;
			$order->order_date=$order_date;
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
			$sales_rates=$item_fetch->sales_rate;
			$minimum_quantity_factor=$item_fetch->minimum_quantity_factor;
			$minimum_quantity_purchase=$item_fetch->minimum_quantity_purchase;
			$is_combo=$item_fetch->is_combo;
			$items[]= ['value'=>$item_fetch->id,'text'=>$item_name." (".$alias_name.")", 'print_quantity'=>$print_quantity, 'rates'=>$rates,'sales_rate' =>$sales_rates,'minimum_quantity_factor'=>$minimum_quantity_factor, 'unit_name'=>$unit_name, 'minimum_quantity_purchase'=>$minimum_quantity_purchase,'is_combo' => $is_combo];
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

        $OrderDetails = $this->Orders->OrderDetails->find()->where(['order_id'=>$id])->contain(['Items'=>['Units']]);
		$warehouses = $this->Orders->Warehouses->find('list')->where(['jain_thela_admin_id' => $jain_thela_admin_id]);
        $this->set(compact('order', 'customers', 'promoCodes', 'OrderDetails', 'items','delivery_time', 'warehouses'));
        $this->set('_serialize', ['order', 'warehouses']);

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
	
	public function onlineSaleDetails($item_id=null,$from_date=null,$to_date=null){
				$this->viewBuilder()->layout('index_layout');
		$jain_thela_admin_id=$this->Auth->User('jain_thela_admin_id');
		
		
		
		
		$ItemLedgers=$this->Orders->ItemLedgers->find()
					->where(['item_id'=>$item_id,'order_id !='=>0,'transaction_date >='=>$from_date,'transaction_date <='=>$to_date])
					->contain(['Orders','Items'=>['Units']])
					->order(['Orders.id'=>'DESC']);
					
					//pr($ItemLedgers->toArray());exit;
		/* $SumQty=0;
		foreach($ItemLedgers as $ItemLedger){
			if($ItemLedger->order->order_type!='Bulkorder '){
				$SumQty+=$ItemLedger->quantity;
			}
		} 
		*/
		$this->set(compact('ItemLedgers','from_date','to_date'));
		
	}
	
	public function bulkSaleDetails($item_id=null,$from_date=null,$to_date=null){
		
		$this->viewBuilder()->layout('index_layout');
		$jain_thela_admin_id=$this->Auth->User('jain_thela_admin_id');
		
		
		$ItemLedgers=$this->Orders->ItemLedgers->find()
					->where(['item_id'=>$item_id,'order_id !='=>0,'transaction_date >='=>$from_date,'transaction_date <='=>$to_date])
					->contain(['Orders','Items'=>['Units']])
					->order(['Orders.id'=>'DESC'])
					->where(['order_type IN'=>['Bulkorder']]);
		
			/* $bulkSales = $this->Orders->OrderDetails->find()->contain(['Orders'=>function ($q)use($where) {
				return $q->where(['order_type IN'=>['Bulkorder']])->where($where);
			},'Items'=>['Units']])->where(['OrderDetails.item_id'=>$item_id])->order(['Orders.id'=>'Desc']); */
		
		//pr($bulkSales->toArray());exit;
		$this->set(compact('ItemLedgers','from_date','to_date'));
        $this->set('_serialize', ['bulkSales']);
	}
	
	public function firstOrderDiscount(){
		
		$jain_thela_admin_id=$this->Auth->User('jain_thela_admin_id');
		$this->loadModel('Users');
		$user_deatils=$this->Users->get($jain_thela_admin_id);
		$first_order_discount_amount=$user_deatils->first_order_discount_amount;
		$customer_details=$this->Orders->Customers->find()
				->where(['first_time_win_status'=> 'No']);
		
		 foreach($customer_details as $customer_detail){
					$customer_id=$customer_detail->id;
					$mobile=$customer_detail->mobile;
					$API_ACCESS_KEY=$customer_detail->notification_key;
					$device_token=$customer_detail->device_token;
					$device_token1=rtrim($device_token);
					$time1=date('Y-m-d G:i:s');
				
				  $order_count=$this->Orders->find()
					->where(['customer_id'=>$customer_id, 
							'grand_total >='=>100,
							'status'=> 'Delivered'])
							->count();
							
					$order_details=$this->Orders->find()
					->where(['customer_id'=>$customer_id, 
							'grand_total >='=>100,
							'status'=> 'Delivered'])
							->select(['id'])
							->order(['id'=>'ASC'])
							->first();
					@$order_id=$order_details->id;
					
			 if($order_count>0){
						$query=$this->Orders->Wallets->query();
						$query->insert(['customer_id', 'return_order_id', 'narration', 'plan_id', 'advance'])
						->values([
							'customer_id' => $customer_id,
							'return_order_id' => $order_id,
							'narration' => 'First Order Discount',
							'plan_id' => 19,
							'advance' => $first_order_discount_amount
						]);
						$query->execute();
						
						$query1=$this->Orders->Customers->query();
						$result = $query1->update()
						->set(['first_time_win_status' => 'Yes'])
						->where(['id' => $customer_id])
						->execute();
						
						$query2=$this->Orders->query();
						$result1 = $query2->update()
						->set(['first_order_discount_flag' => 'Yes'])
						->where(['id' => $order_id])
						->execute();
						 
					if(!empty($device_token1))
					{
					
						$msg = array
						(
						'message' 	=> 'Congratulations You Won Rs. 100 Cash Back for Your First Order',
						'image' 	=> '',
						'button_text'	=> 'Check Wallet',
						'link' => 'jainthela://home',	
						'notification_id'	=> 1,
						);

						$url = 'https://fcm.googleapis.com/fcm/send';
						$fields = array
						(
							'registration_ids' 	=> array($device_token1),
							'data'			=> $msg
						);
						$headers = array
						(
							'Authorization: key=' .$API_ACCESS_KEY,
							'Content-Type: application/json'
						);

						  //echo json_encode($fields);
						  $ch = curl_init();
						curl_setopt($ch, CURLOPT_URL, $url);
						curl_setopt($ch, CURLOPT_POST, true);
						curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
						curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
						curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
						curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
						curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
						$result001 = curl_exec($ch);
						if ($result001 === FALSE) {
							die('FCM Send Error: ' . curl_error($ch));
						}
						curl_close($ch);
					}
					
					
				$sms=str_replace(' ', '+', 'Congratulations You Won Rs. 100 Cash Back for Your First Order');
				$working_key='A7a76ea72525fc05bbe9963267b48dd96';
				$sms_sender='JAINTE';
				$sms=str_replace(' ', '+', $sms);
				file_get_contents('http://alerts.sinfini.com/api/web2sms.php?workingkey='.$working_key.'&sender='.$sms_sender.'&to='.$mobile.'&message='.$sms.'');

	    /////SMS AND NOTIFICATIONS///////////////////
					 	
			 }
		 }
		 exit;
	}
}
