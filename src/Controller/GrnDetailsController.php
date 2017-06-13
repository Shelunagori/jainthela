<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * GrnDetails Controller
 *
 * @property \App\Model\Table\GrnDetailsTable $GrnDetails
 *
 * @method \App\Model\Entity\GrnDetail[] paginate($object = null, array $settings = [])
 */
class GrnDetailsController extends AppController
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
        $grnDetails = $this->paginate($this->GrnDetails);

        $this->set(compact('grnDetails'));
        $this->set('_serialize', ['grnDetails']);
    }

    /**
     * View method
     *
     * @param string|null $id Grn Detail id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $grnDetail = $this->GrnDetails->get($id, [
            'contain' => ['Items']
        ]);

        $this->set('grnDetail', $grnDetail);
        $this->set('_serialize', ['grnDetail']);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $grnDetail = $this->GrnDetails->newEntity();
        if ($this->request->is('post')) {
            $grnDetail = $this->GrnDetails->patchEntity($grnDetail, $this->request->getData());
            if ($this->GrnDetails->save($grnDetail)) {
                $this->Flash->success(__('The grn detail has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The grn detail could not be saved. Please, try again.'));
        }
        $items = $this->GrnDetails->Items->find('list', ['limit' => 200]);
        $this->set(compact('grnDetail', 'items'));
        $this->set('_serialize', ['grnDetail']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Grn Detail id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $grnDetail = $this->GrnDetails->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $grnDetail = $this->GrnDetails->patchEntity($grnDetail, $this->request->getData());
            if ($this->GrnDetails->save($grnDetail)) {
                $this->Flash->success(__('The grn detail has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The grn detail could not be saved. Please, try again.'));
        }
        $items = $this->GrnDetails->Items->find('list', ['limit' => 200]);
        $this->set(compact('grnDetail', 'items'));
        $this->set('_serialize', ['grnDetail']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Grn Detail id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $grnDetail = $this->GrnDetails->get($id);
        if ($this->GrnDetails->delete($grnDetail)) {
            $this->Flash->success(__('The grn detail has been deleted.'));
        } else {
            $this->Flash->error(__('The grn detail could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
