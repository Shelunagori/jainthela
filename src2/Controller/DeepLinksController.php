<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * DeepLinks Controller
 *
 * @property \App\Model\Table\DeepLinksTable $DeepLinks
 *
 * @method \App\Model\Entity\DeepLink[] paginate($object = null, array $settings = [])
 */
class DeepLinksController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $deepLinks = $this->paginate($this->DeepLinks);

        $this->set(compact('deepLinks'));
        $this->set('_serialize', ['deepLinks']);
    }

    /**
     * View method
     *
     * @param string|null $id Deep Link id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $deepLink = $this->DeepLinks->get($id, [
            'contain' => []
        ]);

        $this->set('deepLink', $deepLink);
        $this->set('_serialize', ['deepLink']);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $deepLink = $this->DeepLinks->newEntity();
        if ($this->request->is('post')) {
            $deepLink = $this->DeepLinks->patchEntity($deepLink, $this->request->getData());
            if ($this->DeepLinks->save($deepLink)) {
                $this->Flash->success(__('The deep link has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The deep link could not be saved. Please, try again.'));
        }
        $this->set(compact('deepLink'));
        $this->set('_serialize', ['deepLink']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Deep Link id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $deepLink = $this->DeepLinks->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $deepLink = $this->DeepLinks->patchEntity($deepLink, $this->request->getData());
            if ($this->DeepLinks->save($deepLink)) {
                $this->Flash->success(__('The deep link has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The deep link could not be saved. Please, try again.'));
        }
        $this->set(compact('deepLink'));
        $this->set('_serialize', ['deepLink']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Deep Link id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $deepLink = $this->DeepLinks->get($id);
        if ($this->DeepLinks->delete($deepLink)) {
            $this->Flash->success(__('The deep link has been deleted.'));
        } else {
            $this->Flash->error(__('The deep link could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
