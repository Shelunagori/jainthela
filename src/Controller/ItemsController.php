<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Items Controller
 *
 * @property \App\Model\Table\ItemsTable $Items
 *
 * @method \App\Model\Entity\Item[] paginate($object = null, array $settings = [])
 */
class ItemsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
		$this->viewBuilder()->layout('index_layout');
		$jain_thela_admin_id=$this->Auth->User('jain_thela_admin_id');
        $items = $this->Items->find()->contain(['ItemCategories', 'Units']);

        $this->set(compact('items'));
        $this->set('_serialize', ['items']);
    }
	
	public function defineSaleRate()
    {
		$this->viewBuilder()->layout('index_layout');
		$jain_thela_admin_id=$this->Auth->User('jain_thela_admin_id');
		$items = $this->Items->newEntity();
		
		if ($this->request->is(['post', 'put'])) {
			$items=$this->request->getData('items');
			foreach($items as $item){
				$item=(object)$item;
				$query = $this->Items->query();
                    //$query->update(['promote_date', 'due_amount', amount', 'discount', 'end_date'])
                    $query->update()
                            ->set([
                            'print_rate' => $item->print_rate,
                            'ready_to_sale' => $item->ready_to_sale,
                            'discount_per' => $item->discount_per,
                            'sales_rate' => $item->sales_rate
                            ])
                            ->where(['id'=>$item->item_id])
                    ->execute();
			}
			$this->Flash->success(__('Item rates have updated successfully.'));
		 }
	
		$items = $this->Items->find()->where(['Items.jain_thela_admin_id'=>$jain_thela_admin_id])->contain(['ItemCategories', 'Units']);
		$this->set(compact('items', 'itemCategories', 'units'));
        $this->set('_serialize', ['items']);
		
    }

    /**
     * View method
     *
     * @param string|null $id Item id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $item = $this->Items->get($id, [
            'contain' => ['ItemCategories', 'Units']
        ]);

        $this->set('item', $item);
        $this->set('_serialize', ['item']);
    }
    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
		$this->viewBuilder()->layout('index_layout');
		$jain_thela_admin_id=$this->Auth->User('jain_thela_admin_id');
        $item = $this->Items->newEntity();
        if ($this->request->is('post')) {
			$file = $this->request->data['image'];		 
			$ext = substr(strtolower(strrchr($file['name'], '.')), 1); //get the extension
            $arr_ext = array('jpg', 'jpeg', 'png'); //set allowed extensions
            $setNewFileName = uniqid();
            $img_name= $setNewFileName.'.'.$ext;
			$this->request->data['image']=$img_name;
			
            $item = $this->Items->patchEntity($item, $this->request->getData());
            $item->jain_thela_admin_id=$jain_thela_admin_id;
			if ($this->Items->save($item)) {
                $this->Flash->success(__('The item has been saved.'));
		
				  if (in_array($ext, $arr_ext)) {
					move_uploaded_file($file['tmp_name'], WWW_ROOT . 'img/item_images/'.$img_name);
				  }
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The item could not be saved. Please, try again.'));
        }
        $itemCategories = $this->Items->ItemCategories->find('list')->where(['is_deleted'=>0,'jain_thela_admin_id'=>$jain_thela_admin_id]);
        $units = $this->Items->Units->find('list', ['limit' => 200])->where(['is_deleted'=>0]);
        $this->set(compact('item', 'itemCategories', 'units'));
        $this->set('_serialize', ['item']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Item id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
		$this->viewBuilder()->layout('index_layout');
		$jain_thela_admin_id=$this->Auth->User('jain_thela_admin_id');
        $item = $this->Items->get($id, [
            'contain' => []
        ]);
		$old_image_name=$item->image;
        if ($this->request->is(['patch', 'post', 'put'])) {
			$file = $this->request->data['image'];		 
			$ext = substr(strtolower(strrchr($file['name'], '.')), 1); //get the extension
            $arr_ext = array('jpg', 'jpeg', 'png'); //set allowed extensions
            $setNewFileName = uniqid();		
            $img_name= $setNewFileName.'.'.$ext;
			if(!empty($img_name)){
			$this->request->data['image']=$img_name;
			}else{
				$this->request->data['image']=$old_image_name;
			}
            $item = $this->Items->patchEntity($item, $this->request->getData());
            $item->jain_thela_admin_id=$jain_thela_admin_id;
			if ($this->Items->save($item)) {
				if(!empty($img_name)){
					if (in_array($ext, $arr_ext)) {
					move_uploaded_file($file['tmp_name'], WWW_ROOT . 'img/item_images/'.$img_name);
					}   
				}
                $this->Flash->success(__('The item has been saved.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The item could not be saved. Please, try again.'));
        }
        $itemCategories = $this->Items->ItemCategories->find('list', ['limit' => 200]);
        $units = $this->Items->Units->find('list', ['limit' => 200]);
        $this->set(compact('item', 'itemCategories', 'units'));
        $this->set('_serialize', ['item']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Item id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $item = $this->Items->get($id);
		$item->freeze=1;
        if ($this->Items->save($item)) {
            $this->Flash->success(__('The item has been freezed.'));
        } else {
            $this->Flash->error(__('The item could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
