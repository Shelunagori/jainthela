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
			
			$transaction_date=date('Y-m-d',strtotime($this->request->data['transaction_date']));
			$this->request->data['transaction_date']=$transaction_date;

            $purchaseOutward = $this->PurchaseOutwards->patchEntity($purchaseOutward, $this->request->getData());
			$last_voucher_no = $this->PurchaseOutwards->find()->select(['voucher_no'])->order(['voucher_no'=>'DESC'])->where(['jain_thela_admin_id'=>$jain_thela_admin_id])->first();
			if($last_voucher_no){
				$purchaseOutward->voucher_no = $last_voucher_no->voucher_no+1;
			}else{
				$purchaseOutward->voucher_no=1;
			}
			$purchaseOutward->jain_thela_admin_id=$jain_thela_admin_id;
			
            if ($this->PurchaseOutwards->save($purchaseOutward)) {
				$purchaseOutward_id=$purchaseOutward->id;
				$warehouse_id=$purchaseOutward->warehouse_id;
				
				$outward_details=$this->PurchaseOutwards->PurchaseOutwardDetails->find()->where(['purchase_outward_id' => $purchaseOutward_id]);
				
				foreach($outward_details as $outward_detail){
					
					$fetch_item_id=$outward_detail->item_id;
					$fetch_quantity=$outward_detail->quantity;
					$fetch_rate=$outward_detail->rate;
					
				$query = $this->PurchaseOutwards->ItemLedgers->query();
				$query->insert(['warehouse_id', 'transaction_date', 'item_id', 'quantity','status', 'jain_thela_admin_id', 'rate'])
						->values([
						'warehouse_id' => $warehouse_id,
						'transaction_date' => $transaction_date,
						'item_id' => $fetch_item_id,
						'quantity' => $fetch_quantity,
						'status' => 'out',
						'jain_thela_admin_id' => $jain_thela_admin_id,
						'rate' => $fetch_rate
						])
				->execute();
					
				}
                $this->Flash->success(__('The purchase outward has been saved.'));
				
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The purchase outward could not be saved. Please, try again.'));
        }
        $vendors = $this->PurchaseOutwards->Vendors->find('list', ['limit' => 200]);
        $jainThelaAdmins = $this->PurchaseOutwards->JainThelaAdmins->find('list', ['limit' => 200]);
		
		$item_fetchs = $this->PurchaseOutwards->PurchaseOutwardDetails->Items->find()->where(['Items.jain_thela_admin_id' => $jain_thela_admin_id, 'Items.is_combo'=>'no', 'Items.is_virtual'=>'no', 'Items.freeze'=>0])->contain(['Units']);
		foreach($item_fetchs as $item_fetch){
			$item_name=$item_fetch->name;
			$alias_name=$item_fetch->alias_name;
			$print_quantity=$item_fetch->print_quantity;
			$unit_name=$item_fetch->unit->unit_name;
			$minimum_quantity_factor=$item_fetch->minimum_quantity_factor;
			$items[]= ['value'=>$item_fetch->id,'text'=>$item_name." (".$alias_name.")", 'print_quantity'=>$print_quantity, 'minimum_quantity_factor'=>$minimum_quantity_factor, 'unit_name'=>$unit_name];
		}
		$warehouses = $this->PurchaseOutwards->Warehouses->find('list')->where(['jain_thela_admin_id' => $jain_thela_admin_id]);
        $this->set(compact('purchaseOutward', 'vendors', 'jainThelaAdmins', 'items', 'warehouses'));
        $this->set('_serialize', ['purchaseOutward', 'items', 'warehouses']);
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
