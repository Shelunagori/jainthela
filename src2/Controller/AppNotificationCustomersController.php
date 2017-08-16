<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * AppNotificationCustomers Controller
 *
 * @property \App\Model\Table\AppNotificationCustomersTable $AppNotificationCustomers
 *
 * @method \App\Model\Entity\AppNotificationCustomer[] paginate($object = null, array $settings = [])
 */
class AppNotificationCustomersController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['AppNotifications', 'Customers']
        ];
        $appNotificationCustomers = $this->paginate($this->AppNotificationCustomers);

        $this->set(compact('appNotificationCustomers'));
        $this->set('_serialize', ['appNotificationCustomers']);
    }

    /**
     * View method
     *
     * @param string|null $id App Notification Customer id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $appNotificationCustomer = $this->AppNotificationCustomers->get($id, [
            'contain' => ['AppNotifications', 'Customers']
        ]);

        $this->set('appNotificationCustomer', $appNotificationCustomer);
        $this->set('_serialize', ['appNotificationCustomer']);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $appNotificationCustomer = $this->AppNotificationCustomers->newEntity();
        if ($this->request->is('post')) {
            $appNotificationCustomer = $this->AppNotificationCustomers->patchEntity($appNotificationCustomer, $this->request->getData());
            if ($this->AppNotificationCustomers->save($appNotificationCustomer)) {
                $this->Flash->success(__('The app notification customer has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The app notification customer could not be saved. Please, try again.'));
        }
        $appNotifications = $this->AppNotificationCustomers->AppNotifications->find('list', ['limit' => 200]);
        $customers = $this->AppNotificationCustomers->Customers->find('list', ['limit' => 200]);
        $this->set(compact('appNotificationCustomer', 'appNotifications', 'customers'));
        $this->set('_serialize', ['appNotificationCustomer']);
    }

    /**
     * Edit method
     *
     * @param string|null $id App Notification Customer id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $appNotificationCustomer = $this->AppNotificationCustomers->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $appNotificationCustomer = $this->AppNotificationCustomers->patchEntity($appNotificationCustomer, $this->request->getData());
            if ($this->AppNotificationCustomers->save($appNotificationCustomer)) {
                $this->Flash->success(__('The app notification customer has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The app notification customer could not be saved. Please, try again.'));
        }
        $appNotifications = $this->AppNotificationCustomers->AppNotifications->find('list', ['limit' => 200]);
        $customers = $this->AppNotificationCustomers->Customers->find('list', ['limit' => 200]);
        $this->set(compact('appNotificationCustomer', 'appNotifications', 'customers'));
        $this->set('_serialize', ['appNotificationCustomer']);
    }

    /**
     * Delete method
     *
     * @param string|null $id App Notification Customer id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $appNotificationCustomer = $this->AppNotificationCustomers->get($id);
        if ($this->AppNotificationCustomers->delete($appNotificationCustomer)) {
            $this->Flash->success(__('The app notification customer has been deleted.'));
        } else {
            $this->Flash->error(__('The app notification customer could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
