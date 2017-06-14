<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * PurchaseBookings Controller
 *
 * @property \App\Model\Table\PurchaseBookingsTable $PurchaseBookings
 *
 * @method \App\Model\Entity\PurchaseBooking[] paginate($object = null, array $settings = [])
 */
class PurchaseBookingsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Grns', 'Vendors', 'JainThelaAdmins']
        ];
        $purchaseBookings = $this->paginate($this->PurchaseBookings);

        $this->set(compact('purchaseBookings'));
        $this->set('_serialize', ['purchaseBookings']);
    }

    /**
     * View method
     *
     * @param string|null $id Purchase Booking id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $purchaseBooking = $this->PurchaseBookings->get($id, [
            'contain' => ['Grns', 'Vendors', 'JainThelaAdmins', 'PurchaseBookingDetails']
        ]);

        $this->set('purchaseBooking', $purchaseBooking);
        $this->set('_serialize', ['purchaseBooking']);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $purchaseBooking = $this->PurchaseBookings->newEntity();
        if ($this->request->is('post')) {
            $purchaseBooking = $this->PurchaseBookings->patchEntity($purchaseBooking, $this->request->getData());
            if ($this->PurchaseBookings->save($purchaseBooking)) {
                $this->Flash->success(__('The purchase booking has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The purchase booking could not be saved. Please, try again.'));
        }
        $grns = $this->PurchaseBookings->Grns->find('list', ['limit' => 200]);
        $vendors = $this->PurchaseBookings->Vendors->find('list', ['limit' => 200]);
        $jainThelaAdmins = $this->PurchaseBookings->JainThelaAdmins->find('list', ['limit' => 200]);
        $this->set(compact('purchaseBooking', 'grns', 'vendors', 'jainThelaAdmins'));
        $this->set('_serialize', ['purchaseBooking']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Purchase Booking id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $purchaseBooking = $this->PurchaseBookings->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $purchaseBooking = $this->PurchaseBookings->patchEntity($purchaseBooking, $this->request->getData());
            if ($this->PurchaseBookings->save($purchaseBooking)) {
                $this->Flash->success(__('The purchase booking has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The purchase booking could not be saved. Please, try again.'));
        }
        $grns = $this->PurchaseBookings->Grns->find('list', ['limit' => 200]);
        $vendors = $this->PurchaseBookings->Vendors->find('list', ['limit' => 200]);
        $jainThelaAdmins = $this->PurchaseBookings->JainThelaAdmins->find('list', ['limit' => 200]);
        $this->set(compact('purchaseBooking', 'grns', 'vendors', 'jainThelaAdmins'));
        $this->set('_serialize', ['purchaseBooking']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Purchase Booking id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $purchaseBooking = $this->PurchaseBookings->get($id);
        if ($this->PurchaseBookings->delete($purchaseBooking)) {
            $this->Flash->success(__('The purchase booking has been deleted.'));
        } else {
            $this->Flash->error(__('The purchase booking could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
