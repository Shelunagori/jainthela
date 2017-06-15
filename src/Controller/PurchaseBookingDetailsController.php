<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * PurchaseBookingDetails Controller
 *
 * @property \App\Model\Table\PurchaseBookingDetailsTable $PurchaseBookingDetails
 *
 * @method \App\Model\Entity\PurchaseBookingDetail[] paginate($object = null, array $settings = [])
 */
class PurchaseBookingDetailsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['PurchaseBookings', 'Items']
        ];
        $purchaseBookingDetails = $this->paginate($this->PurchaseBookingDetails);

        $this->set(compact('purchaseBookingDetails'));
        $this->set('_serialize', ['purchaseBookingDetails']);
    }

    /**
     * View method
     *
     * @param string|null $id Purchase Booking Detail id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $purchaseBookingDetail = $this->PurchaseBookingDetails->get($id, [
            'contain' => ['PurchaseBookings', 'Items']
        ]);

        $this->set('purchaseBookingDetail', $purchaseBookingDetail);
        $this->set('_serialize', ['purchaseBookingDetail']);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $purchaseBookingDetail = $this->PurchaseBookingDetails->newEntity();
        if ($this->request->is('post')) {
            $purchaseBookingDetail = $this->PurchaseBookingDetails->patchEntity($purchaseBookingDetail, $this->request->getData());
            if ($this->PurchaseBookingDetails->save($purchaseBookingDetail)) {
                $this->Flash->success(__('The purchase booking detail has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The purchase booking detail could not be saved. Please, try again.'));
        }
        $purchaseBookings = $this->PurchaseBookingDetails->PurchaseBookings->find('list', ['limit' => 200]);
        $items = $this->PurchaseBookingDetails->Items->find('list', ['limit' => 200]);
        $this->set(compact('purchaseBookingDetail', 'purchaseBookings', 'items'));
        $this->set('_serialize', ['purchaseBookingDetail']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Purchase Booking Detail id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $purchaseBookingDetail = $this->PurchaseBookingDetails->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $purchaseBookingDetail = $this->PurchaseBookingDetails->patchEntity($purchaseBookingDetail, $this->request->getData());
            if ($this->PurchaseBookingDetails->save($purchaseBookingDetail)) {
                $this->Flash->success(__('The purchase booking detail has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The purchase booking detail could not be saved. Please, try again.'));
        }
        $purchaseBookings = $this->PurchaseBookingDetails->PurchaseBookings->find('list', ['limit' => 200]);
        $items = $this->PurchaseBookingDetails->Items->find('list', ['limit' => 200]);
        $this->set(compact('purchaseBookingDetail', 'purchaseBookings', 'items'));
        $this->set('_serialize', ['purchaseBookingDetail']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Purchase Booking Detail id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $purchaseBookingDetail = $this->PurchaseBookingDetails->get($id);
        if ($this->PurchaseBookingDetails->delete($purchaseBookingDetail)) {
            $this->Flash->success(__('The purchase booking detail has been deleted.'));
        } else {
            $this->Flash->error(__('The purchase booking detail could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
