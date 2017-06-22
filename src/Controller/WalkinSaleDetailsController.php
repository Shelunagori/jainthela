<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * WalkinSaleDetails Controller
 *
 * @property \App\Model\Table\WalkinSaleDetailsTable $WalkinSaleDetails
 *
 * @method \App\Model\Entity\WalkinSaleDetail[] paginate($object = null, array $settings = [])
 */
class WalkinSaleDetailsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['WalkinSales', 'Items']
        ];
        $walkinSaleDetails = $this->paginate($this->WalkinSaleDetails);
		$this->set(compact('walkinSaleDetails'));
        $this->set('_serialize', ['walkinSaleDetails']);
    }

   
    public function view($id = null)
    {
        $walkinSaleDetail = $this->WalkinSaleDetails->get($id, [
            'contain' => ['WalkinSales', 'Items']
        ]);

        $this->set('walkinSaleDetail', $walkinSaleDetail);
        $this->set('_serialize', ['walkinSaleDetail']);
    }

    
    public function add()
    {
        $walkinSaleDetail = $this->WalkinSaleDetails->newEntity();
        if ($this->request->is('post')) {
            $walkinSaleDetail = $this->WalkinSaleDetails->patchEntity($walkinSaleDetail, $this->request->getData());
            if ($this->WalkinSaleDetails->save($walkinSaleDetail)) {
                $this->Flash->success(__('The walkin sale detail has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The walkin sale detail could not be saved. Please, try again.'));
        }
        $walkinSales = $this->WalkinSaleDetails->WalkinSales->find('list', ['limit' => 200]);
        $items = $this->WalkinSaleDetails->Items->find('list', ['limit' => 200]);
        $this->set(compact('walkinSaleDetail', 'walkinSales', 'items'));
        $this->set('_serialize', ['walkinSaleDetail']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Walkin Sale Detail id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $walkinSaleDetail = $this->WalkinSaleDetails->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $walkinSaleDetail = $this->WalkinSaleDetails->patchEntity($walkinSaleDetail, $this->request->getData());
            if ($this->WalkinSaleDetails->save($walkinSaleDetail)) {
                $this->Flash->success(__('The walkin sale detail has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The walkin sale detail could not be saved. Please, try again.'));
        }
        $walkinSales = $this->WalkinSaleDetails->WalkinSales->find('list', ['limit' => 200]);
        $items = $this->WalkinSaleDetails->Items->find('list', ['limit' => 200]);
        $this->set(compact('walkinSaleDetail', 'walkinSales', 'items'));
        $this->set('_serialize', ['walkinSaleDetail']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Walkin Sale Detail id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $walkinSaleDetail = $this->WalkinSaleDetails->get($id);
        if ($this->WalkinSaleDetails->delete($walkinSaleDetail)) {
            $this->Flash->success(__('The walkin sale detail has been deleted.'));
        } else {
            $this->Flash->error(__('The walkin sale detail could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
