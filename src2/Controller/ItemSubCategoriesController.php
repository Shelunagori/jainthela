<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * ItemSubCategories Controller
 *
 * @property \App\Model\Table\ItemSubCategoriesTable $ItemSubCategories
 *
 * @method \App\Model\Entity\ItemSubCategory[] paginate($object = null, array $settings = [])
 */
class ItemSubCategoriesController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['ItemCategories']
        ];
        $itemSubCategories = $this->paginate($this->ItemSubCategories);

        $this->set(compact('itemSubCategories'));
        $this->set('_serialize', ['itemSubCategories']);
    }

    /**
     * View method
     *
     * @param string|null $id Item Sub Category id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $itemSubCategory = $this->ItemSubCategories->get($id, [
            'contain' => ['ItemCategories', 'Items']
        ]);

        $this->set('itemSubCategory', $itemSubCategory);
        $this->set('_serialize', ['itemSubCategory']);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $itemSubCategory = $this->ItemSubCategories->newEntity();
        if ($this->request->is('post')) {
            $itemSubCategory = $this->ItemSubCategories->patchEntity($itemSubCategory, $this->request->getData());
            if ($this->ItemSubCategories->save($itemSubCategory)) {
                $this->Flash->success(__('The item sub category has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The item sub category could not be saved. Please, try again.'));
        }
        $itemCategories = $this->ItemSubCategories->ItemCategories->find('list', ['limit' => 200]);
        $this->set(compact('itemSubCategory', 'itemCategories'));
        $this->set('_serialize', ['itemSubCategory']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Item Sub Category id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $itemSubCategory = $this->ItemSubCategories->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $itemSubCategory = $this->ItemSubCategories->patchEntity($itemSubCategory, $this->request->getData());
            if ($this->ItemSubCategories->save($itemSubCategory)) {
                $this->Flash->success(__('The item sub category has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The item sub category could not be saved. Please, try again.'));
        }
        $itemCategories = $this->ItemSubCategories->ItemCategories->find('list', ['limit' => 200]);
        $this->set(compact('itemSubCategory', 'itemCategories'));
        $this->set('_serialize', ['itemSubCategory']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Item Sub Category id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $itemSubCategory = $this->ItemSubCategories->get($id);
        if ($this->ItemSubCategories->delete($itemSubCategory)) {
            $this->Flash->success(__('The item sub category has been deleted.'));
        } else {
            $this->Flash->error(__('The item sub category could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
