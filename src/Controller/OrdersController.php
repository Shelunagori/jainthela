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
      
		$orders = $this->Orders->find('all')->contain(['Customers']);
		
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
        $order = $this->Orders->get($id, [
            'contain' => ['Customers', 'PromoCodes', 'OrderDetails']
        ]);

        $this->set('order', $order);
        $this->set('_serialize', ['order']);
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
			$last_order_no = $this->Orders->find()->select(['order_no'])->order(['order_no'=>'DESC'])->where(['jain_thela_admin_id'=>$jain_thela_admin_id])->first();
			if($last_order_no){
				$order->order_no = $last_order_no->order_no+1;
			}else{
				$order->order_no=1;
			}
			
			$order->order_type=$order_type;
			$order->jain_thela_admin_id=$jain_thela_admin_id;
			$order->grand_total=$this->request->data['total_amount'];
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
		
       // $promoCodes = $this->Orders->PromoCodes->find('list');
		$item_fetchs = $this->Orders->Items->find()->where(['Items.jain_thela_admin_id' => $jain_thela_admin_id])->contain(['Units']);
		
		foreach($item_fetchs as $item_fetch){
			$item_name=$item_fetch->name;
			$alias_name=$item_fetch->alias_name;
			$unit_name=$item_fetch->unit->unit_name;
			$print_quantity=$item_fetch->print_quantity;
			$rates=$item_fetch->offline_sales_rate;
			$minimum_quantity_factor=$item_fetch->minimum_quantity_factor;
			$items[]= ['value'=>$item_fetch->id,'text'=>$item_name." (".$alias_name.")", 'print_quantity'=>$print_quantity, 'rates'=>$rates, 'minimum_quantity_factor'=>$minimum_quantity_factor, 'unit_name'=>$unit_name];
		}
		$this->loadModel('BulkBookingLeads');
        $bulk_Details = $this->BulkBookingLeads->find()->where(['id' => $bulkorder_id])->toArray();

        $this->set(compact('order', 'customers', 'items', 'order_type', 'bulk_Details', 'bulkorder_id'));
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
        $order = $this->Orders->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $order = $this->Orders->patchEntity($order, $this->request->getData());
            if ($this->Orders->save($order)) {
                $this->Flash->success(__('The order has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The order could not be saved. Please, try again.'));
        }
        $customers = $this->Orders->Customers->find('list', ['limit' => 200]);
        $promoCodes = $this->Orders->PromoCodes->find('list', ['limit' => 200]);
        $this->set(compact('order', 'customers', 'promoCodes'));
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
}
