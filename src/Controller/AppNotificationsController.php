<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * AppNotifications Controller
 *
 * @property \App\Model\Table\AppNotificationsTable $AppNotifications
 *
 * @method \App\Model\Entity\AppNotification[] paginate($object = null, array $settings = [])
 */
class AppNotificationsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Items']
        ];
        $appNotifications = $this->paginate($this->AppNotifications);

        $this->set(compact('appNotifications'));
        $this->set('_serialize', ['appNotifications']);
    }

    /**
     * View method
     *
     * @param string|null $id App Notification id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $appNotification = $this->AppNotifications->get($id, [
            'contain' => ['Items']
        ]);

        $this->set('appNotification', $appNotification);
        $this->set('_serialize', ['appNotification']);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $appNotification = $this->AppNotifications->newEntity();
        if ($this->request->is('post')) {
            $appNotification = $this->AppNotifications->patchEntity($appNotification, $this->request->getData());
            if ($this->AppNotifications->save($appNotification)) {
                $this->Flash->success(__('The app notification has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The app notification could not be saved. Please, try again.'));
        }
        $items = $this->AppNotifications->Items->find('list', ['limit' => 200]);
        $this->set(compact('appNotification', 'items'));
        $this->set('_serialize', ['appNotification']);
    }

    /**
     * Edit method
     *
     * @param string|null $id App Notification id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $appNotification = $this->AppNotifications->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $appNotification = $this->AppNotifications->patchEntity($appNotification, $this->request->getData());
            if ($this->AppNotifications->save($appNotification)) {
                $this->Flash->success(__('The app notification has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The app notification could not be saved. Please, try again.'));
        }
        $items = $this->AppNotifications->Items->find('list', ['limit' => 200]);
        $this->set(compact('appNotification', 'items'));
        $this->set('_serialize', ['appNotification']);
    }

    /**
     * Delete method
     *
     * @param string|null $id App Notification id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $appNotification = $this->AppNotifications->get($id);
        if ($this->AppNotifications->delete($appNotification)) {
            $this->Flash->success(__('The app notification has been deleted.'));
        } else {
            $this->Flash->error(__('The app notification could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
