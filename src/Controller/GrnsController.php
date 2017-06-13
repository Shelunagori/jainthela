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
    public function index()
    {
		$this->viewBuilder()->layout('index_layout');
		$city_id=$this->Auth->User('city_id');
        $this->paginate = [
            'contain' => ['Vendors', 'Cities']
        ];
        $grns = $this->paginate($this->Grns);

        $this->set(compact('grns'));
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
		$city_id=$this->Auth->User('city_id');
        $grn = $this->Grns->get($id, [
            'contain' => ['Vendors', 'Cities']
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
		$city_id=$this->Auth->User('city_id');
        $grn = $this->Grns->newEntity();
        if ($this->request->is('post')) {
            $grn = $this->Grns->patchEntity($grn, $this->request->getData());
			$last_grn_no = $this->Grns->find()->select(['grn_no'])->order(['grn_no'=>'DESC'])->where(['city_id'=>$city_id])->first();
			if($last_grn_no){
				$grn->grn_no = $last_grn_no->grn_no+1;
			}else{
				$grn->grn_no=1;
			}
			$grn->city_id=$city_id;
			//pr($grn); exit;
            if ($this->Grns->save($grn)) {
				foreach($grn->grn_details as $grn_detail){
					$query = $this->Grns->ItemLedgers->query();
					$query->insert(['item_id', 'city_id', 'rate', 'status', 'quantity', 'transaction_date', 'grn_id', 'rate_updated'])
						->values([
							'item_id' => $grn_detail->item_id,
							'city_id' => $city_id,
							'rate' => 0,
							'status' => 'In',
							'quantity' => $grn_detail->quantity,
							'transaction_date' => $grn->transaction_date,
							'grn_id' => $grn->id,
							'rate_updated' => 'No'
						]);
					$query->execute();
				}
                $this->Flash->success(__('The grn has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The grn could not be saved. Please, try again.'));
        }
        $vendors = $this->Grns->Vendors->find('list', ['limit' => 200]);
        $items = $this->Grns->GrnDetails->Items->find('list');
        $this->set(compact('grn', 'vendors', 'cities', 'items'));
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
