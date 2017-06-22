<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * ComboOffers Controller
 *
 * @property \App\Model\Table\ComboOffersTable $ComboOffers
 *
 * @method \App\Model\Entity\ComboOffer[] paginate($object = null, array $settings = [])
 */
class ComboOffersController extends AppController
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
        $comboOffers = $this->paginate($this->ComboOffers);
        $this->set(compact('comboOffers'));
        $this->set('_serialize', ['comboOffers']);
    }

    /**
     * View method
     *
     * @param string|null $id Combo Offer id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
		$this->viewBuilder()->layout('index_layout');
	   $comboOffers = $this->ComboOffers->get($id, [
            'contain' => ['ComboOfferDetails'=>['Items'=>['Units']]]
        ]);

        $this->set('comboOffers', $comboOffers);
        $this->set('_serialize', ['comboOffer']);
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
		
        $comboOffer = $this->ComboOffers->newEntity();
        if ($this->request->is('post')) {
			$file = $this->request->data['image'];		 
			$ext = substr(strtolower(strrchr($file['name'], '.')), 1); //get the extension
            $arr_ext = array('jpg', 'jpeg', 'png'); //set allowed extensions
            $setNewFileName = uniqid();
            $img_name= $setNewFileName.'.'.$ext;
			$this->request->data['image']=$img_name;
			
            $comboOffer = $this->ComboOffers->patchEntity($comboOffer, $this->request->getData());
			$comboOffer->jain_thela_admin_id=$jain_thela_admin_id;
            if ($ComboOffers_data=$this->ComboOffers->save($comboOffer)) {
				$ComboOffers_name=$ComboOffers_data->name;
				$ComboOffers_sales_rate=$ComboOffers_data->sales_rate;
				
				if (in_array($ext, $arr_ext)) {
					move_uploaded_file($file['tmp_name'], WWW_ROOT . 'img/item_images/'.$img_name);
				  }
				  
					$query = $this->ComboOffers->ComboOfferDetails->Items->query();
					$query->insert(['name', 'jain_thela_admin_id', 'sales_rate', 'combo'])
							->values([
							'name' => $ComboOffers_name,
							'jain_thela_admin_id' => $jain_thela_admin_id,
							'sales_rate' => $ComboOffers_sales_rate,
							'combo' => 'yes'
							])
					->execute();
                $this->Flash->success(__('The combo offer has been saved.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The combo offer could not be saved. Please, try again.'));
        }
		$items = $this->ComboOffers->ComboOfferDetails->Items->find('list')->where(['jain_thela_admin_id' => $jain_thela_admin_id, 'combo =' => 'no']);		

        $this->set(compact('comboOffer', 'items'));
        $this->set('_serialize', ['comboOffer', 'items']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Combo Offer id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $comboOffer = $this->ComboOffers->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $comboOffer = $this->ComboOffers->patchEntity($comboOffer, $this->request->getData());
            if ($this->ComboOffers->save($comboOffer)) {
                $this->Flash->success(__('The combo offer has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The combo offer could not be saved. Please, try again.'));
        }
        $this->set(compact('comboOffer'));
        $this->set('_serialize', ['comboOffer']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Combo Offer id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $comboOffer = $this->ComboOffers->get($id);
        if ($this->ComboOffers->delete($comboOffer)) {
            $this->Flash->success(__('The combo offer has been deleted.'));
        } else {
            $this->Flash->error(__('The combo offer could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
