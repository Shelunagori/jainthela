<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Grns Controller
 *
 * @property \App\Model\Table\GrnsTable $Grns
 *
 * @method \App\Model\Entity\Grn[] paginate($object = null, array $settings = [])
 */
class GrnsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index($status = Null)
    {
		$this->viewBuilder()->layout('index_layout');
		$jain_thela_admin_id=$this->Auth->User('jain_thela_admin_id');
        
		if($status=='open' || $status=='')
		{	$status='open';
			$grns = $this->Grns->find()->where(['Grns.jain_thela_admin_id'=>$jain_thela_admin_id, 'purchase_booked'=>'No'])->order(['Grns.id'=>'DESC'])->contain(['Vendors', 'Warehouses']);
		} 
		elseif($status=='closed')
		{
			$status='closed';
			$grns = $this->Grns->find()->where(['Grns.jain_thela_admin_id'=>$jain_thela_admin_id, 'purchase_booked'=>'Yes'])->order(['Grns.id'=>'DESC'])->contain(['Vendors', 'Warehouses']);
		}
		
        $this->set(compact(['grns','status']));
        $this->set('_serialize', ['grns']);
    }

    /**
     * View method
     *
     * @param string|null $id Grn id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
		$this->viewBuilder()->layout('index_layout');
		$jain_thela_admin_id=$this->Auth->User('jain_thela_admin_id');
		
        $grn = $this->Grns->get($id, [
            'contain' => ['Vendors','Warehouses','GrnDetails'=>['Items'=>['Units']]]
        ]);
		
        $this->set('grn', $grn);
		
        $this->set('_serialize', ['grn']);
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
        $grn = $this->Grns->newEntity();
        if ($this->request->is('post')) {
            $grn = $this->Grns->patchEntity($grn, $this->request->getData());
			$last_grn_no = $this->Grns->find()->select(['grn_no'])->order(['grn_no'=>'DESC'])->where(['jain_thela_admin_id'=>$jain_thela_admin_id])->first();
			if($last_grn_no){
				$grn->grn_no = $last_grn_no->grn_no+1;
			}else{
				$grn->grn_no=1;
			}
			$grn->jain_thela_admin_id=$jain_thela_admin_id;
			
            if ($this->Grns->save($grn)) {
				
				foreach($grn->grn_details as $grn_detail){
					$query = $this->Grns->ItemLedgers->query();
					$query->insert(['jain_thela_admin_id', 'driver_id', 'grn_id', 'item_id', 'warehouse_id', 'rate', 'status', 'quantity', 'transaction_date'])
						->values([
							'jain_thela_admin_id' => $jain_thela_admin_id,
							'driver_id' => 0,
							'grn_id' => $grn->id,
							'item_id' => $grn_detail->item_id,
							'warehouse_id' => $grn->warehouse_id,
							'rate' => 0,
							'status' => 'In',
							'quantity' => $grn_detail->quantity,
							'transaction_date' => $grn->transaction_date,
							'rate_updated' => 'No'
						]);
					$query->execute();
				}
                $this->Flash->success(__('The grn has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The grn could not be saved. Please, try again.'));
        }
        $vendors = $this->Grns->Vendors->find('list');
        $warehouses = $this->Grns->ItemLedgers->Warehouses->find('list')->where(['jain_thela_admin_id'=>$jain_thela_admin_id]);
			$item_fetchs = $this->Grns->GrnDetails->Items->find()->where(['Items.jain_thela_admin_id' => $jain_thela_admin_id, 'Items.is_combo'=>'no', 'Items.is_virtual'=>'no', 'Items.freeze'=>0])->contain(['Units']);
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
        $this->set(compact('grn', 'vendors', 'items', 'warehouses'));
        $this->set('_serialize', ['grn']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Grn id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
		$this->viewBuilder()->layout('index_layout');
		$city_id=$this->Auth->User('city_id');
        $grn = $this->Grns->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $grn = $this->Grns->patchEntity($grn, $this->request->getData());
            if ($this->Grns->save($grn)) {
                $this->Flash->success(__('The grn has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The grn could not be saved. Please, try again.'));
        }
        $vendors = $this->Grns->Vendors->find('list', ['limit' => 200]);
        $cities = $this->Grns->Cities->find('list', ['limit' => 200]);
        $this->set(compact('grn', 'vendors', 'cities'));
        $this->set('_serialize', ['grn']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Grn id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $grn = $this->Grns->get($id);
        if ($this->Grns->delete($grn)) {
            $this->Flash->success(__('The grn has been deleted.'));
        } else {
            $this->Flash->error(__('The grn could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
