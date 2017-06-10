<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Franchises Controller
 *
 * @property \App\Model\Table\FranchisesTable $Franchises
 *
 * @method \App\Model\Entity\Franchise[] paginate($object = null, array $settings = [])
 */
class FranchisesController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Cities']
        ];
        $franchises = $this->paginate($this->Franchises);

        $this->set(compact('franchises'));
        $this->set('_serialize', ['franchises']);
    }

    /**
     * View method
     *
     * @param string|null $id Franchise id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $franchise = $this->Franchises->get($id, [
            'contain' => ['Cities', 'FranchiseItemCategories']
        ]);

        $this->set('franchise', $franchise);
        $this->set('_serialize', ['franchise']);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
		$this->viewBuilder()->layout('index_layout');
        $franchise = $this->Franchises->newEntity();
        if ($this->request->is('post')) {
            $franchise = $this->Franchises->patchEntity($franchise, $this->request->getData());
			
            if ($this->Franchises->save($franchise)) {
                $this->Flash->success(__('The franchise has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The franchise could not be saved. Please, try again.'));
        }
        $cities = $this->Franchises->Cities->find('list', ['limit' => 200]);
        $ItemCategories = $this->Franchises->ItemCategories->find('list');
        $this->set(compact('franchise', 'cities', 'ItemCategories'));
        $this->set('_serialize', ['franchise']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Franchise id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $franchise = $this->Franchises->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $franchise = $this->Franchises->patchEntity($franchise, $this->request->getData());
            if ($this->Franchises->save($franchise)) {
                $this->Flash->success(__('The franchise has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The franchise could not be saved. Please, try again.'));
        }
        $cities = $this->Franchises->Cities->find('list', ['limit' => 200]);
        $this->set(compact('franchise', 'cities'));
        $this->set('_serialize', ['franchise']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Franchise id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $franchise = $this->Franchises->get($id);
        if ($this->Franchises->delete($franchise)) {
            $this->Flash->success(__('The franchise has been deleted.'));
        } else {
            $this->Flash->error(__('The franchise could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
