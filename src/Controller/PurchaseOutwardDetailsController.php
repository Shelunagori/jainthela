<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * PurchaseOutwardDetails Controller
 *
 * @property \App\Model\Table\PurchaseOutwardDetailsTable $PurchaseOutwardDetails
 *
 * @method \App\Model\Entity\PurchaseOutwardDetail[] paginate($object = null, array $settings = [])
 */
class PurchaseOutwardDetailsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['PurchaseOutwards', 'Items']
        ];
        $purchaseOutwardDetails = $this->paginate($this->PurchaseOutwardDetails);

        $this->set(compact('purchaseOutwardDetails'));
        $this->set('_serialize', ['purchaseOutwardDetails']);
    }

    /**
     * View method
     *
     * @param string|null $id Purchase Outward Detail id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $purchaseOutwardDetail = $this->PurchaseOutwardDetails->get($id, [
            'contain' => ['PurchaseOutwards', 'Items']
        ]);

        $this->set('purchaseOutwardDetail', $purchaseOutwardDetail);
        $this->set('_serialize', ['purchaseOutwardDetail']);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $purchaseOutwardDetail = $this->PurchaseOutwardDetails->newEntity();
        if ($this->request->is('post')) {
            $purchaseOutwardDetail = $this->PurchaseOutwardDetails->patchEntity($purchaseOutwardDetail, $this->request->getData());
            if ($this->PurchaseOutwardDetails->save($purchaseOutwardDetail)) {
                $this->Flash->success(__('The purchase outward detail has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The purchase outward detail could not be saved. Please, try again.'));
        }
        $purchaseOutwards = $this->PurchaseOutwardDetails->PurchaseOutwards->find('list', ['limit' => 200]);
        $items = $this->PurchaseOutwardDetails->Items->find('list', ['limit' => 200]);
        $this->set(compact('purchaseOutwardDetail', 'purchaseOutwards', 'items'));
        $this->set('_serialize', ['purchaseOutwardDetail']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Purchase Outward Detail id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $purchaseOutwardDetail = $this->PurchaseOutwardDetails->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $purchaseOutwardDetail = $this->PurchaseOutwardDetails->patchEntity($purchaseOutwardDetail, $this->request->getData());
            if ($this->PurchaseOutwardDetails->save($purchaseOutwardDetail)) {
                $this->Flash->success(__('The purchase outward detail has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The purchase outward detail could not be saved. Please, try again.'));
        }
        $purchaseOutwards = $this->PurchaseOutwardDetails->PurchaseOutwards->find('list', ['limit' => 200]);
        $items = $this->PurchaseOutwardDetails->Items->find('list', ['limit' => 200]);
        $this->set(compact('purchaseOutwardDetail', 'purchaseOutwards', 'items'));
        $this->set('_serialize', ['purchaseOutwardDetail']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Purchase Outward Detail id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $purchaseOutwardDetail = $this->PurchaseOutwardDetails->get($id);
        if ($this->PurchaseOutwardDetails->delete($purchaseOutwardDetail)) {
            $this->Flash->success(__('The purchase outward detail has been deleted.'));
        } else {
            $this->Flash->error(__('The purchase outward detail could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
