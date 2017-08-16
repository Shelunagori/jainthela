<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * JainCashPoints Controller
 *
 * @property \App\Model\Table\JainCashPointsTable $JainCashPoints
 *
 * @method \App\Model\Entity\JainCashPoint[] paginate($object = null, array $settings = [])
 */
class JainCashPointsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Customers', 'Orders']
        ];
        $jainCashPoints = $this->paginate($this->JainCashPoints);

        $this->set(compact('jainCashPoints'));
        $this->set('_serialize', ['jainCashPoints']);
    }

    /**
     * View method
     *
     * @param string|null $id Jain Cash Point id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $jainCashPoint = $this->JainCashPoints->get($id, [
            'contain' => ['Customers', 'Orders']
        ]);

        $this->set('jainCashPoint', $jainCashPoint);
        $this->set('_serialize', ['jainCashPoint']);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $jainCashPoint = $this->JainCashPoints->newEntity();
        if ($this->request->is('post')) {
            $jainCashPoint = $this->JainCashPoints->patchEntity($jainCashPoint, $this->request->getData());
            if ($this->JainCashPoints->save($jainCashPoint)) {
                $this->Flash->success(__('The jain cash point has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The jain cash point could not be saved. Please, try again.'));
        }
        $customers = $this->JainCashPoints->Customers->find('list', ['limit' => 200]);
        $orders = $this->JainCashPoints->Orders->find('list', ['limit' => 200]);
        $this->set(compact('jainCashPoint', 'customers', 'orders'));
        $this->set('_serialize', ['jainCashPoint']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Jain Cash Point id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $jainCashPoint = $this->JainCashPoints->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $jainCashPoint = $this->JainCashPoints->patchEntity($jainCashPoint, $this->request->getData());
            if ($this->JainCashPoints->save($jainCashPoint)) {
                $this->Flash->success(__('The jain cash point has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The jain cash point could not be saved. Please, try again.'));
        }
        $customers = $this->JainCashPoints->Customers->find('list', ['limit' => 200]);
        $orders = $this->JainCashPoints->Orders->find('list', ['limit' => 200]);
        $this->set(compact('jainCashPoint', 'customers', 'orders'));
        $this->set('_serialize', ['jainCashPoint']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Jain Cash Point id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $jainCashPoint = $this->JainCashPoints->get($id);
        if ($this->JainCashPoints->delete($jainCashPoint)) {
            $this->Flash->success(__('The jain cash point has been deleted.'));
        } else {
            $this->Flash->error(__('The jain cash point could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
