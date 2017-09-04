<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * StockReturnVouchers Controller
 *
 * @property \App\Model\Table\StockReturnVouchersTable $StockReturnVouchers
 *
 * @method \App\Model\Entity\StockReturnVoucher[] paginate($object = null, array $settings = [])
 */
class StockReturnVouchersController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
		
		$url=$this->request->here();
		$url=parse_url($url,PHP_URL_QUERY);
		
		$this->viewBuilder()->layout('index_layout'); 
		$jain_thela_admin_id=$this->Auth->User('jain_thela_admin_id'); 
		
		$from=$this->request->query('from');
		$to=$this->request->query('to');
		$driver_id=$this->request->query('driver_id');
		if(!empty($from)){
			$where['StockReturnVouchers.created_on_date >=']=date('Y-m-d',strtotime($from));
		}
		if(!empty($to)){
			$where['StockReturnVouchers.created_on_date <=']=date('Y-m-d',strtotime($to));
		}
		if(!empty($driver_id)){
			$where['StockReturnVouchers.driver_id']=$driver_id;
		}
 		$where['StockReturnVouchers.jain_thela_admin_id'] = $jain_thela_admin_id;
       
	   $this->paginate = [
            'contain' => ['Drivers']
        ];
        $stockReturnVouchers = $this->paginate($this->StockReturnVouchers->find()
			->where($where)
			->order(['StockReturnVouchers.id'=> 'DESC']));
		$drivers=$this->StockReturnVouchers->Drivers->find('list');
        $this->set(compact('stockReturnVouchers','drivers','url'));
        $this->set('_serialize', ['stockReturnVouchers']);
    }
	public function exportExcel()
    {
		$jain_thela_admin_id=$this->Auth->User('jain_thela_admin_id'); 
		
		$from=$this->request->query('from');
		$to=$this->request->query('to');
		$driver_id=$this->request->query('driver_id');
		if(!empty($from)){
			$where['StockReturnVouchers.created_on_date >=']=date('Y-m-d',strtotime($from));
		}
		if(!empty($to)){
			$where['StockReturnVouchers.created_on_date <=']=date('Y-m-d',strtotime($to));
		}
		if(!empty($driver_id)){
			$where['StockReturnVouchers.driver_id']=$driver_id;
		}
 		$where['StockReturnVouchers.jain_thela_admin_id'] = $jain_thela_admin_id;
       
	   $this->paginate = [
            'contain' => ['Drivers']
        ];
        $stockReturnVouchers = $this->paginate($this->StockReturnVouchers->find()
			->where($where)
			->order(['StockReturnVouchers.id'=> 'DESC']));
		$drivers=$this->StockReturnVouchers->Drivers->find('list');
        $this->set(compact('stockReturnVouchers','drivers'));
        $this->set('_serialize', ['stockReturnVouchers']);
    }
    /**
     * View method
     *
     * @param string|null $id Stock Return Voucher id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
		$url=$this->request->here();
		$url=parse_url($url,PHP_URL_QUERY);
		
		$this->viewBuilder()->layout('index_layout'); 
		$jain_thela_admin_id=$this->Auth->User('jain_thela_admin_id'); 
		
        $stockReturnVoucher = $this->StockReturnVouchers->get($id, [
            'contain' => ['Drivers','ItemLedgers'=>['Items'=>['Units']]]
        ]);
		
        $this->set('stockReturnVoucher', $stockReturnVoucher);
        $this->set('_serialize', ['stockReturnVoucher']);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $stockReturnVoucher = $this->StockReturnVouchers->newEntity();
        if ($this->request->is('post')) {
            $stockReturnVoucher = $this->StockReturnVouchers->patchEntity($stockReturnVoucher, $this->request->getData());
            if ($this->StockReturnVouchers->save($stockReturnVoucher)) {
                $this->Flash->success(__('The stock return voucher has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The stock return voucher could not be saved. Please, try again.'));
        }
        $drivers = $this->StockReturnVouchers->Drivers->find('list', ['limit' => 200]);
        $jainThelaAdmins = $this->StockReturnVouchers->JainThelaAdmins->find('list', ['limit' => 200]);
        $this->set(compact('stockReturnVoucher', 'drivers', 'jainThelaAdmins'));
        $this->set('_serialize', ['stockReturnVoucher']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Stock Return Voucher id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $stockReturnVoucher = $this->StockReturnVouchers->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $stockReturnVoucher = $this->StockReturnVouchers->patchEntity($stockReturnVoucher, $this->request->getData());
            if ($this->StockReturnVouchers->save($stockReturnVoucher)) {
                $this->Flash->success(__('The stock return voucher has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The stock return voucher could not be saved. Please, try again.'));
        }
        $drivers = $this->StockReturnVouchers->Drivers->find('list', ['limit' => 200]);
        $jainThelaAdmins = $this->StockReturnVouchers->JainThelaAdmins->find('list', ['limit' => 200]);
        $this->set(compact('stockReturnVoucher', 'drivers', 'jainThelaAdmins'));
        $this->set('_serialize', ['stockReturnVoucher']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Stock Return Voucher id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $stockReturnVoucher = $this->StockReturnVouchers->get($id);
        if ($this->StockReturnVouchers->delete($stockReturnVoucher)) {
            $this->Flash->success(__('The stock return voucher has been deleted.'));
        } else {
            $this->Flash->error(__('The stock return voucher could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
