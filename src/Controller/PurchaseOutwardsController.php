<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * PurchaseOutwards Controller
 *
 * @property \App\Model\Table\PurchaseOutwardsTable $PurchaseOutwards
 *
 * @method \App\Model\Entity\PurchaseOutward[] paginate($object = null, array $settings = [])
 */
class PurchaseOutwardsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
		$this->viewBuilder()->layout('index_layout');

		$purchaseOutwards = $this->PurchaseOutwards->find()->contain(['Vendors', 'JainThelaAdmins']);
        $this->set(compact('purchaseOutwards'));
        $this->set('_serialize', ['purchaseOutwards']);
    }

    /**
     * View method
     *
     * @param string|null $id Purchase Outward id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
		$this->viewBuilder()->layout('index_layout');
        $purchaseOutward = $this->PurchaseOutwards->get($id, [
            'contain' => ['Vendors', 'JainThelaAdmins', 'PurchaseOutwardDetails'=>['Items'=>['Units']]]
        ]);
        $this->set('purchaseOutward', $purchaseOutward);
        $this->set('_serialize', ['purchaseOutward']);
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
        $purchaseOutward = $this->PurchaseOutwards->newEntity();
		
        if ($this->request->is('post')) {
			$this->request->data['transaction_date']=date('Y-m-d',strtotime($this->request->data['transaction_date']));

            $purchaseOutward = $this->PurchaseOutwards->patchEntity($purchaseOutward, $this->request->getData());
			$last_voucher_no = $this->PurchaseOutwards->find()->select(['voucher_no'])->order(['voucher_no'=>'DESC'])->where(['jain_thela_admin_id'=>$jain_thela_admin_id])->first();
			if($last_voucher_no){
				$purchaseOutward->voucher_no = $last_voucher_no->voucher_no+1;
			}else{
				$purchaseOutward->voucher_no=1;
			}
			$purchaseOutward->jain_thela_admin_id=$jain_thela_admin_id;
            if ($this->PurchaseOutwards->save($purchaseOutward)) {
                $this->Flash->success(__('The purchase outward has been saved.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The purchase outward could not be saved. Please, try again.'));
        }
        $vendors = $this->PurchaseOutwards->Vendors->find('list', ['limit' => 200]);
        $jainThelaAdmins = $this->PurchaseOutwards->JainThelaAdmins->find('list', ['limit' => 200]);
		$items = $this->PurchaseOutwards->PurchaseOutwardDetails->Items->find('list')->where(['jain_thela_admin_id' => $jain_thela_admin_id]);
        $this->set(compact('purchaseOutward', 'vendors', 'jainThelaAdmins', 'items'));
        $this->set('_serialize', ['purchaseOutward', 'items']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Purchase Outward id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $purchaseOutward = $this->PurchaseOutwards->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $purchaseOutward = $this->PurchaseOutwards->patchEntity($purchaseOutward, $this->request->getData());
            if ($this->PurchaseOutwards->save($purchaseOutward)) {
                $this->Flash->success(__('The purchase outward has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The purchase outward could not be saved. Please, try again.'));
        }
        $vendors = $this->PurchaseOutwards->Vendors->find('list', ['limit' => 200]);
        $jainThelaAdmins = $this->PurchaseOutwards->JainThelaAdmins->find('list', ['limit' => 200]);
        $this->set(compact('purchaseOutward', 'vendors', 'jainThelaAdmins'));
        $this->set('_serialize', ['purchaseOutward']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Purchase Outward id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $purchaseOutward = $this->PurchaseOutwards->get($id);
        if ($this->PurchaseOutwards->delete($purchaseOutward)) {
            $this->Flash->success(__('The purchase outward has been deleted.'));
        } else {
            $this->Flash->error(__('The purchase outward could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
