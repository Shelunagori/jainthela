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
			$file_name=$file['name'];
			$ext = substr(strtolower(strrchr($file['name'], '.')), 1); //get the extension
            $arr_ext = array('jpg', 'jpeg', 'png'); //set allowed extensions
            $setNewFileName = uniqid();
            $img_name= $setNewFileName.'.'.$ext;
			if(!empty($file_name)){
			$this->request->data['image']=$img_name;
			}if(empty($file_name)){
				
			}
            $comboOffer = $this->ComboOffers->patchEntity($comboOffer, $this->request->getData());
			$comboOffer->jain_thela_admin_id=$jain_thela_admin_id;
            if ($ComboOffers_data=$this->ComboOffers->save($comboOffer)) {
				$ComboOffers_id=$ComboOffers_data->id;
				$ComboOffers_name=$ComboOffers_data->name;
				$ComboOffers_print_rate=$ComboOffers_data->print_rate;
				$ComboOffers_discount_per=$ComboOffers_data->discount_per;
				$ComboOffers_sales_rate=$ComboOffers_data->sales_rate;
				$ComboOffers_image=$ComboOffers_data->image;
				
				if(in_array($ext, $arr_ext)) {
					move_uploaded_file($file['tmp_name'], WWW_ROOT . 'img/item_images/'.$img_name);
				  }
					$query = $this->ComboOffers->ComboOfferDetails->Items->query();
					$query->insert(['name', 'jain_thela_admin_id', 'sales_rate', 'is_combo', 'combo_offer_id', 'print_rate', 'discount_per', 'image', 'item_category_id', 'unit_id','minimum_quantity_factor','print_quantity','minimum_quantity_purchase'])
							->values([
							'name' => $ComboOffers_name,
							'jain_thela_admin_id' => $jain_thela_admin_id,
							'sales_rate' => $ComboOffers_sales_rate,
							'is_combo' => 'yes',
							'combo_offer_id' => $ComboOffers_id,
							'print_rate' => $ComboOffers_print_rate,
							'discount_per' => $ComboOffers_discount_per,
							'image' => $ComboOffers_image,
							'item_category_id' => 1,
							'unit_id' => 7,
							'minimum_quantity_factor' => 1,
							'print_quantity' => '1 Combo',
							'minimum_quantity_purchase' => 1
							])
					->execute();
                $this->Flash->success(__('The combo offer has been saved.'));
			
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The combo offer could not be saved. Please, try again.'));
        }
		$item_fetchs = $this->ComboOffers->ComboOfferDetails->Items->find()->where(['Items.jain_thela_admin_id' => $jain_thela_admin_id, 'Items.is_combo'=>'no', 'Items.freeze !='=>1])->contain(['Units']);
		foreach($item_fetchs as $item_fetch){
			$item_name=$item_fetch->name;
			$alias_name=$item_fetch->alias_name;
			$unit_name=$item_fetch->unit->unit_name;
			$print_quantity=$item_fetch->print_quantity;
			$rates=$item_fetch->sales_rate;
			$minimum_quantity_factor=$item_fetch->minimum_quantity_factor;
			$minimum_quantity_purchase=$item_fetch->minimum_quantity_purchase;
			$items[]= ['value'=>$item_fetch->id,'text'=>$item_name." (".$alias_name.")", 'print_quantity'=>$print_quantity, 'rates'=>$rates, 'minimum_quantity_factor'=>$minimum_quantity_factor, 'unit_name'=>$unit_name, 'minimum_quantity_purchase'=>$minimum_quantity_purchase];
		}
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
		$this->viewBuilder()->layout('index_layout');
		$jain_thela_admin_id=$this->Auth->User('jain_thela_admin_id');
		
        $comboOffer = $this->ComboOffers->get($id, [
            'contain' => ['ComboOfferDetails']
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
			$file = $this->request->data['image'];
			$file_name=$file['name'];
			$ext = substr(strtolower(strrchr($file['name'], '.')), 1); //get the extension
            $arr_ext = array('jpg', 'jpeg', 'png'); //set allowed extensions
            $setNewFileName = uniqid();
            $img_name= $setNewFileName.'.'.$ext;
			if(!empty($file_name)){
			$this->request->data['image']=$img_name;
			}if(empty($file_name)){
				
			}
			
            $comboOffer = $this->ComboOffers->patchEntity($comboOffer, $this->request->getData());
			
            if ($ComboOffers_data=$this->ComboOffers->save($comboOffer)) {
				$ComboOffers_id=$ComboOffers_data->id;
				$ComboOffers_name=$ComboOffers_data->name;
				$ComboOffers_print_rate=$ComboOffers_data->print_rate;
				$ComboOffers_discount_per=$ComboOffers_data->discount_per;
				$ComboOffers_sales_rate=$ComboOffers_data->sales_rate;
				$ComboOffers_image=$ComboOffers_data->image;
				
				if(!empty($file_name)){
				if(in_array($ext, $arr_ext)) {
					move_uploaded_file($file['tmp_name'], WWW_ROOT . 'img/item_images/'.$img_name);
				  }
				} 
				$query = $this->ComboOffers->ComboOfferDetails->Items->query();
				$result = $query->update()
                    ->set([
							'name' => $ComboOffers_name,
							'jain_thela_admin_id' => $jain_thela_admin_id,
							'sales_rate' => $ComboOffers_sales_rate,
							'is_combo' => 'yes',
							'combo_offer_id' => $ComboOffers_id,
							'print_rate' => $ComboOffers_print_rate,
							'discount_per' => $ComboOffers_discount_per,
							'image' => $ComboOffers_image,
							'item_category_id' => 1,
							'unit_id' => 7
							])
                    ->where(['combo_offer_id' => $ComboOffers_id])
                    ->execute();
                $this->Flash->success(__('The combo offer has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The combo offer could not be saved. Please, try again.'));
        }
		$item_fetchs = $this->ComboOffers->ComboOfferDetails->Items->find()->where(['Items.jain_thela_admin_id' => $jain_thela_admin_id, 'Items.is_combo'=>'no', 'Items.freeze !='=>1])->contain(['Units']);
		foreach($item_fetchs as $item_fetch){
			$item_name=$item_fetch->name;
			$alias_name=$item_fetch->alias_name;
			@$unit_name=$item_fetch->unit->unit_name;
			$print_quantity=$item_fetch->print_quantity;
			$rates=$item_fetch->offline_sales_rate;
			$minimum_quantity_factor=$item_fetch->minimum_quantity_factor;
			$minimum_quantity_purchase=$item_fetch->minimum_quantity_purchase;
			$items[]= ['value'=>$item_fetch->id,'text'=>$item_name." (".$alias_name.")", 'print_quantity'=>$print_quantity, 'rates'=>$rates, 'minimum_quantity_factor'=>$minimum_quantity_factor, 'unit_name'=>$unit_name, 'minimum_quantity_purchase'=>$minimum_quantity_purchase];
		}
        $this->set(compact('comboOffer', 'items'));
        $this->set('_serialize', ['comboOffer', 'items']);
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
