<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * CustomerAddresses Controller
 *
 * @property \App\Model\Table\CustomerAddressesTable $CustomerAddresses
 *
 * @method \App\Model\Entity\CustomerAddress[] paginate($object = null, array $settings = [])
 */
class CustomerAddressesController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index($customer_id=null, $id=null)
    {
		$this->viewBuilder()->layout('index_layout'); 
		$jain_thela_admin_id=$this->Auth->User('jain_thela_admin_id');
		if(!$id){
			$customerAddress = $this->CustomerAddresses->newEntity();
		}else{
				$customerAddress = $this->CustomerAddresses->get($id, [
				'contain' => []
			]);
		}
		
		if ($this->request->is(['patch', 'post', 'put'])) {
            $customerAddress = $this->CustomerAddresses->patchEntity($customerAddress, $this->request->getData());
			$customerAddress->customer_id=$customer_id;
            if ($this->CustomerAddresses->save($customerAddress)) {
                $this->Flash->success(__('The Address has been saved.'));
                return $this->redirect(['action' => 'index/'.$customer_id]);
            }
            $this->Flash->error(__('The Address could not be saved. Please, try again.'));
        }
		
		
        $this->paginate = [
            'contain' => ['Customers']
        ];
        $customerAddresses = $this->CustomerAddresses->find()->where(['customer_id'=>$customer_id])->contain(['Customers']);

        $this->set(compact('customerAddresses', 'customerAddress', 'customer_id', 'id'));
        $this->set('_serialize', ['customerAddresses', 'customerAddress', 'customer_id', 'id']);
    }

	public function saveAddress($customer_id,$name,$mobile,$house_no,$address,$locality,$default_address){
		
		
		$customerAddressexists = $this->CustomerAddresses->find()->where(['customer_id'=>$customer_id]);
		
		if(sizeof($customerAddressexists->toArray())>0){
			$customerAddress = $this->CustomerAddresses->newEntity();
				  $customerAddress = $this->CustomerAddresses->patchEntity($customerAddress, $this->request->getData());
						$query = $this->CustomerAddresses->query();
					$query->update()
						->set(['default_address' => 0])
						->where(['customer_id' => $customer_id])
						->execute();
						$query = $this->CustomerAddresses->query();
						$query->insert(['customer_id', 'name', 'mobile', 'house_no','address','locality','default_address'])
									->values([
										'customer_id' => $customer_id,
										'name' => $name,
										'mobile' => $mobile,
										'house_no' => $house_no,
										'address' => $address,
										'locality' => $locality,
										'default_address' => 1
									]);
					$query->execute();	
					
		}else{
		$customerAddress = $this->CustomerAddresses->newEntity();
				  $customerAddress = $this->CustomerAddresses->patchEntity($customerAddress, $this->request->getData());
						$query = $this->CustomerAddresses->query();
						$query->insert(['customer_id', 'name', 'mobile', 'house_no','address','locality','default_address'])
									->values([
										'customer_id' => $customer_id,
										'name' => $name,
										'mobile' => $mobile,
										'house_no' => $house_no,
										'address' => $address,
										'locality' => $locality,
										'default_address' => 1
									]);
					$query->execute();	
		}			
				exit;
	}
	
	
	public function adddefaultAddress($customer_id,$address_id){
		$query = $this->CustomerAddresses->query();
				$query->update()
						->set(['default_address' => 0])
						->where(['customer_id'=>$customer_id])
						->execute();
						
		$query = $this->CustomerAddresses->query();
					$query->update()
						->set(['default_address' => 1])
						->where(['id'=>$address_id])
						->execute();
						exit;
	}
    /**
     * View method
     *
     * @param string|null $id Customer Address id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $customerAddress = $this->CustomerAddresses->get($id, [
            'contain' => ['Customers']
        ]);

        $this->set('customerAddress', $customerAddress);
        $this->set('_serialize', ['customerAddress']);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $customerAddress = $this->CustomerAddresses->newEntity();
        if ($this->request->is('post')) {
            $customerAddress = $this->CustomerAddresses->patchEntity($customerAddress, $this->request->getData());
            if ($this->CustomerAddresses->save($customerAddress)) {
                $this->Flash->success(__('The customer address has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The customer address could not be saved. Please, try again.'));
        }
        $customers = $this->CustomerAddresses->Customers->find('list', ['limit' => 200]);
        $this->set(compact('customerAddress', 'customers'));
        $this->set('_serialize', ['customerAddress']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Customer Address id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $customerAddress = $this->CustomerAddresses->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $customerAddress = $this->CustomerAddresses->patchEntity($customerAddress, $this->request->getData());
            if ($this->CustomerAddresses->save($customerAddress)) {
                $this->Flash->success(__('The customer address has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The customer address could not be saved. Please, try again.'));
        }
        $customers = $this->CustomerAddresses->Customers->find('list', ['limit' => 200]);
        $this->set(compact('customerAddress', 'customers'));
        $this->set('_serialize', ['customerAddress']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Customer Address id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($customer_id=null, $id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $customerAddress = $this->CustomerAddresses->get($id);
        if ($this->CustomerAddresses->delete($customerAddress)) {
            $this->Flash->success(__('The customer address has been deleted.'));
        } else {
            $this->Flash->error(__('The customer address could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index/'.$customer_id]);
    }
}
