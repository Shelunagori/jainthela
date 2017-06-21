<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * PushNotificationCustomers Controller
 *
 * @property \App\Model\Table\PushNotificationCustomersTable $PushNotificationCustomers
 *
 * @method \App\Model\Entity\PushNotificationCustomer[] paginate($object = null, array $settings = [])
 */
class PushNotificationCustomersController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['PushNotifications', 'Customers']
        ];
        $pushNotificationCustomers = $this->paginate($this->PushNotificationCustomers);

        $this->set(compact('pushNotificationCustomers'));
        $this->set('_serialize', ['pushNotificationCustomers']);
    }

    /**
     * View method
     *
     * @param string|null $id Push Notification Customer id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $pushNotificationCustomer = $this->PushNotificationCustomers->get($id, [
            'contain' => ['PushNotifications', 'Customers']
        ]);

        $this->set('pushNotificationCustomer', $pushNotificationCustomer);
        $this->set('_serialize', ['pushNotificationCustomer']);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $pushNotificationCustomer = $this->PushNotificationCustomers->newEntity();
        if ($this->request->is('post')) {
            $pushNotificationCustomer = $this->PushNotificationCustomers->patchEntity($pushNotificationCustomer, $this->request->getData());
            if ($this->PushNotificationCustomers->save($pushNotificationCustomer)) {
                $this->Flash->success(__('The push notification customer has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The push notification customer could not be saved. Please, try again.'));
        }
        $pushNotifications = $this->PushNotificationCustomers->PushNotifications->find('list', ['limit' => 200]);
        $customers = $this->PushNotificationCustomers->Customers->find('list', ['limit' => 200]);
        $this->set(compact('pushNotificationCustomer', 'pushNotifications', 'customers'));
        $this->set('_serialize', ['pushNotificationCustomer']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Push Notification Customer id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $pushNotificationCustomer = $this->PushNotificationCustomers->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $pushNotificationCustomer = $this->PushNotificationCustomers->patchEntity($pushNotificationCustomer, $this->request->getData());
            if ($this->PushNotificationCustomers->save($pushNotificationCustomer)) {
                $this->Flash->success(__('The push notification customer has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The push notification customer could not be saved. Please, try again.'));
        }
        $pushNotifications = $this->PushNotificationCustomers->PushNotifications->find('list', ['limit' => 200]);
        $customers = $this->PushNotificationCustomers->Customers->find('list', ['limit' => 200]);
        $this->set(compact('pushNotificationCustomer', 'pushNotifications', 'customers'));
        $this->set('_serialize', ['pushNotificationCustomer']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Push Notification Customer id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $pushNotificationCustomer = $this->PushNotificationCustomers->get($id);
        if ($this->PushNotificationCustomers->delete($pushNotificationCustomer)) {
            $this->Flash->success(__('The push notification customer has been deleted.'));
        } else {
            $this->Flash->error(__('The push notification customer could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
