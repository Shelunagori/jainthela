<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Vendors Controller
 *
 * @property \App\Model\Table\VendorsTable $Vendors
 *
 * @method \App\Model\Entity\Vendor[] paginate($object = null, array $settings = [])
 */
class VendorsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index($id=null)
    {
		
		$this->viewBuilder()->layout('index_layout');
		$vendors = $this->Vendors->find()->where(['freeze !=' => 1])->contain(['Franchises']);  
		//$franchises = $this->Vendors->Franchises->find('list', ['limit' => 200]);
        $this->set(compact('vendors'));
        $this->set('_serialize', ['vendors']);
    }

    /**
     * View method
     *
     * @param string|null $id Vendor id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $vendor = $this->Vendors->get($id, [
            'contain' => ['Franchises']
        ]);

        $this->set('vendor', $vendor);
        $this->set('_serialize', ['vendor']);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add($id=null)
    {
        $this->viewBuilder()->layout('index_layout');
		if(!$id){
			$vendors = $this->Vendors->newEntity();
		}
       if ($this->request->is(['post'])) {
            $vendors = $this->Vendors->patchEntity($vendors, $this->request->getData());
            if ($this->Vendors->save($vendors)) {
                $this->Flash->success(__('The vendor has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The vendor could not be saved. Please, try again.'));
        }
		$franchises = $this->Vendors->Franchises->find('list', ['limit' => 200]);
        $this->set(compact('vendors', 'franchises'));
        $this->set('_serialize', ['vendors']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Vendor id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
		$this->viewBuilder()->layout('index_layout');
        $vendor = $this->Vendors->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $vendor = $this->Vendors->patchEntity($vendor, $this->request->getData());
            if ($this->Vendors->save($vendor)) {
                $this->Flash->success(__('The vendor has been update.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The vendor could not be saved. Please, try again.'));
        }
        $franchises = $this->Vendors->Franchises->find('list', ['limit' => 200]);
        $this->set(compact('vendor', 'franchises'));
        $this->set('_serialize', ['vendor']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Vendor id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $vendor = $this->Vendors->get($id);
		
		$vendor->freeze=1;
        if ($this->Vendors->save($vendor)) {
            $this->Flash->success(__('The item has been freezed.'));
        } else {
            $this->Flash->error(__('The item could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
