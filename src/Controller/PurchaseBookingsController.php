<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * PurchaseBookings Controller
 *
 * @property \App\Model\Table\PurchaseBookingsTable $PurchaseBookings
 *
 * @method \App\Model\Entity\PurchaseBooking[] paginate($object = null, array $settings = [])
 */
class PurchaseBookingsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
		$this->viewBuilder()->layout('index_layout');
        $this->paginate = [
            'contain' => ['Grns', 'Vendors', 'JainThelaAdmins']
        ];
        $purchaseBookings = $this->paginate($this->PurchaseBookings);

        $this->set(compact('purchaseBookings'));
        $this->set('_serialize', ['purchaseBookings']);
    }

    /**
     * View method
     *
     * @param string|null $id Purchase Booking id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $purchaseBooking = $this->PurchaseBookings->get($id, [
            'contain' => ['Grns', 'Vendors', 'JainThelaAdmins', 'PurchaseBookingDetails']
        ]);

        $this->set('purchaseBooking', $purchaseBooking);
        $this->set('_serialize', ['purchaseBooking']);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add($grn_id = null)
    {
		$this->viewBuilder()->layout('index_layout');
		$grn = $this->PurchaseBookings->Grns->get($grn_id, [
            'contain' => ['GrnDetails'=>['Items'], 'Vendors', 'JainThelaAdmins']
        ]);
		$jain_thela_admin_id=$this->Auth->User('jain_thela_admin_id');
        $purchaseBooking = $this->PurchaseBookings->newEntity();
        if ($this->request->is('post')) { 
            $purchaseBooking = $this->PurchaseBookings->patchEntity($purchaseBooking, $this->request->getData());
			
			$last_voucher_no = $this->PurchaseBookings->find()->select(['voucher_no'])->order(['voucher_no'=>'DESC'])->where(['jain_thela_admin_id'=>$jain_thela_admin_id])->first();
			if($last_voucher_no){
				$purchaseBooking->voucher_no = $last_voucher_no->voucher_no+1;
			}else{
				$purchaseBooking->voucher_no=1;
			}
			$purchaseBooking->jain_thela_admin_id=$jain_thela_admin_id;
			$purchaseBooking->vendor_id=$grn->vendor_id;
			$purchaseBooking->grn_id=$grn->id;
            if ($this->PurchaseBookings->save($purchaseBooking)) {
				
				$query=$this->PurchaseBookings->Grns->query();
				$result = $query->update()
                    ->set(['purchase_booked' => 'Yes'])
                    ->where(['id' => $grn_id])
                    ->execute();
					
                $this->Flash->success(__('The purchase booking has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
			
            $this->Flash->error(__('The purchase booking could not be saved. Please, try again.'));
        }
       
		//pr($grn);
		//exit;
       
        $this->set(compact('purchaseBooking', 'grn'));
        $this->set('_serialize', ['purchaseBooking']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Purchase Booking id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $purchaseBooking = $this->PurchaseBookings->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $purchaseBooking = $this->PurchaseBookings->patchEntity($purchaseBooking, $this->request->getData());
            if ($this->PurchaseBookings->save($purchaseBooking)) {
                $this->Flash->success(__('The purchase booking has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The purchase booking could not be saved. Please, try again.'));
        }
        $grns = $this->PurchaseBookings->Grns->find('list', ['limit' => 200]);
        $vendors = $this->PurchaseBookings->Vendors->find('list', ['limit' => 200]);
        $jainThelaAdmins = $this->PurchaseBookings->JainThelaAdmins->find('list', ['limit' => 200]);
        $this->set(compact('purchaseBooking', 'grns', 'vendors', 'jainThelaAdmins'));
        $this->set('_serialize', ['purchaseBooking']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Purchase Booking id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $purchaseBooking = $this->PurchaseBookings->get($id);
        if ($this->PurchaseBookings->delete($purchaseBooking)) {
            $this->Flash->success(__('The purchase booking has been deleted.'));
        } else {
            $this->Flash->error(__('The purchase booking could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
