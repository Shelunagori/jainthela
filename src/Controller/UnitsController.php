<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Cities Controller
 *
 * @property \App\Model\Table\CitiesTable $Cities
 *
 * @method \App\Model\Entity\Unit[] paginate($object = null, array $settings = [])
 */
class UnitsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index($id=null)
    {
		$this->viewBuilder()->layout('index_layout');
		$city_id=$this->Auth->User('city_id');
		if(!$id){
			$unit = $this->Units->newEntity();
		}else{
			$unit = $this->Units->get($id, [
				'contain' => []
			]);
		}
		
        if ($this->request->is(['patch', 'post', 'put'])) {
            $unit = $this->Units->patchEntity($unit, $this->request->getData());
            if ($this->Units->save($unit)) {
                $this->Flash->success(__('The unit has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The unit could not be saved. Please, try again.'));
        }
		
        
        $units = $this->Units->find()->where(['is_deleted !=' => 1]);

        $this->set(compact('unit', 'units'));
		$this->set('_serialize', ['unit']);
        $this->set('_serialize', ['units']);
    }

    /**
     * View method
     *
     * @param string|null $id Unit id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
		
        $unit = $this->Units->get($id, [
            'contain' => []
        ]);

        $this->set('unit', $unit);
        $this->set('_serialize', ['unit']);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
		$this->viewBuilder()->layout('index_layout');
		
        $unit = $this->Units->newEntity();
        if ($this->request->is('post')) {
            $unit = $this->Units->patchEntity($unit, $this->request->getData());
            if ($this->Units->save($unit)) {
                $this->Flash->success(__('The unit has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The unit could not be saved. Please, try again.'));
        }
        $this->set(compact('unit'));
        $this->set('_serialize', ['unit']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Unit id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $unit = $this->Units->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $unit = $this->Units->patchEntity($unit, $this->request->getData());
            if ($this->Units->save($unit)) {
                $this->Flash->success(__('The unit has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The unit could not be saved. Please, try again.'));
        }
        $this->set(compact('unit'));
        $this->set('_serialize', ['unit']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Unit id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $unit = $this->Units->get($id);
		$this->request->data['is_deleted']=1;
		
		if($this->request->is(['patch', 'post', 'put']))
		{
		$unit = $this->Units->patchEntity($unit, $this->request->getData());
        if ($this->Units->save($unit)) {
            $this->Flash->success(__('The unit has been deleted.'));
        } else {
            $this->Flash->error(__('The unit could not be deleted. Please, try again.'));
        }
		}

        return $this->redirect(['action' => 'index']);
    }
}
