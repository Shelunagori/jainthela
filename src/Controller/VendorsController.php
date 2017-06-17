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
		$jain_thela_admin_id=$this->Auth->User('jain_thela_admin_id');
		$vendors = $this->Vendors->find()->where(['Vendors.jain_thela_admin_id'=>$jain_thela_admin_id]);  
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
            'contain' => []
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
		$jain_thela_admin_id=$this->Auth->User('jain_thela_admin_id');
		if(!$id){
			$vendor = $this->Vendors->newEntity();
		}
       if ($this->request->is(['post'])) {
            $vendor = $this->Vendors->patchEntity($vendor, $this->request->data);
			$vendor->jain_thela_admin_id=$jain_thela_admin_id;
			if ($vendors_data=$this->Vendors->save($vendor)) { 
				  $vendor_id=$vendors_data->id;
				  $vendor_name=$vendors_data->name;
				
				$query = $this->Vendors->LedgerAccounts->query();
				$query->insert(['name', 'jain_thela_admin_id', 'vendor_id', 'account_group_id'])
						->values([
						'name' => $vendor_name,
						'jain_thela_admin_id' => $jain_thela_admin_id,
						'vendor_id' => $vendor_id,
						'account_group_id' => 1
						])
				->execute();

                $this->Flash->success(__('The vendor has been saved.'));
                 return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The vendor could not be saved. Please, try again.'));
        }
        $this->set(compact('vendor'));
        $this->set('_serialize', ['vendor']);
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
		$jain_thela_admin_id=$this->Auth->User('jain_thela_admin_id');
        $vendor = $this->Vendors->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $vendor = $this->Vendors->patchEntity($vendor, $this->request->getData());
            $vendor->jain_thela_admin_id=$jain_thela_admin_id;
			if ($vendors_data=$this->Vendors->save($vendor)) {
				
				$vendors_name=$vendors_data->name;
				$query=$this->Vendors->LedgerAccounts->query();
				$result = $query->update()
                    ->set(['name' => $vendors_name])
                    ->where(['vendor_id' => $id])
                    ->execute();
                $this->Flash->success(__('The vendor has been update.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The vendor could not be saved. Please, try again.'));
        }
        $this->set(compact('vendor'));
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
