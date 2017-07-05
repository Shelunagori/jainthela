<?php
namespace App\Controller;
use Cake\Filesystem\Folder;
use Cake\Filesystem\File;
use App\Controller\AppController;


/**
 * BulkBookingLeads Controller
 *
 * @property \App\Model\Table\BulkBookingLeadsTable $BulkBookingLeads
 *
 * @method \App\Model\Entity\BulkBookingLead[] paginate($object = null, array $settings = [])
 */
class BulkBookingLeadsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index($status = Null)
    { 
		$this->viewBuilder()->layout('index_layout');
		$jain_thela_admin_id=$this->Auth->User('jain_thela_admin_id');
		
		if ($this->request->is(['patch', 'post', 'put'])) {
			$bulk_booking_lead_id=$this->request->data['bulk_booking_lead_id'];
			$reason=$this->request->data['reason'];
			$bulk_booking_lead=$this->BulkBookingLeads->get($bulk_booking_lead_id);
			$bulk_booking_lead->status='Closed';
			$bulk_booking_lead->reason=$reason;
			$this->BulkBookingLeads->save($bulk_booking_lead);
            //$this->Flash->sussess(__('The leads could not be saved. Please, try again.'));
        }		
		if($status==''){ $status='open'; }
		if($status=='open')
		{
			 $where = $status;
			 $bulkBookingLeads = $this->BulkBookingLeads->find()->where(['status' => 'Open','jain_thela_admin_id' => $jain_thela_admin_id ]);
		} 
		elseif($status=='close')
		{
			$where = $status;
			$bulkBookingLeads = $this->BulkBookingLeads->find()->where(['status' => 'Closed','jain_thela_admin_id' => $jain_thela_admin_id ]);
		}
		 
        $this->set(compact('bulkBookingLeads', 'status'));
        $this->set('_serialize', ['bulkBookingLeads']);
    }

    /**
     * View method
     *
     * @param string|null $id Bulk Booking Lead id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $bulkBookingLead = $this->BulkBookingLeads->get($id, [
            'contain' => ['JainThelaAdmins']
        ]);

        $this->set('bulkBookingLead', $bulkBookingLead);
        $this->set('_serialize', ['bulkBookingLead']);
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
		
        $bulkBookingLead = $this->BulkBookingLeads->newEntity();
        if ($this->request->is('post')) {
			
			$file = $this->request->data['image'];
			$file_name=$file['name'];
			$ext = substr(strtolower(strrchr($file['name'], '.')), 1); //get the extension
            $arr_ext = array('jpg', 'jpeg', 'png'); //set allowed extensions
            $setNewFileName = uniqid();		
            $img_name= $setNewFileName.'.'.$ext;
			if(!empty($file_name)){
				$this->request->data['image']=$img_name;
			}
			if(empty($file_name)){
				
			}
			
            $bulkBookingLead = $this->BulkBookingLeads->patchEntity($bulkBookingLead, $this->request->getData());
			$last_lead_no = $this->BulkBookingLeads->find()->select(['lead_no'])->where(['jain_thela_admin_id' => $jain_thela_admin_id])->order(['lead_no'=>'DESC'])->first();
			if($last_lead_no){
				$bulkBookingLead->lead_no = $last_lead_no->lead_no+1;
			}else{
				$bulkBookingLead->lead_no=1;
			}
			$bulkBookingLead->created_on=date('Y-m-d');
			$bulkBookingLead->delivery_date=date('Y-m-d', strtotime($this->request->data['delivery_date']));
			$bulkBookingLead->jain_thela_admin_id=$jain_thela_admin_id;
             if ($this->BulkBookingLeads->save($bulkBookingLead)) {	 
			 
			   if (in_array($ext, $arr_ext)) {
					move_uploaded_file($file['tmp_name'], WWW_ROOT . 'img/bulkbookingimages/'.$img_name);
				}
                $this->Flash->success(__('The bulk booking lead has been saved.'));
                 return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The bulk booking lead could not be saved. Please, try again.'));
        }
        $jainThelaAdmins = $this->BulkBookingLeads->JainThelaAdmins->find('list', ['limit' => 200]);
        $this->set(compact('bulkBookingLead', 'jainThelaAdmins','jain_thela_admin_id'));
        $this->set('_serialize', ['bulkBookingLead']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Bulk Booking Lead id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
		$this->viewBuilder()->layout('index_layout'); 
 		$jain_thela_admin_id=$this->Auth->User('jain_thela_admin_id');
		
        $bulkBookingLead = $this->BulkBookingLeads->get($id, [
            'contain' => []
        ]);
		$old_image_name=$bulkBookingLead->image;
        if ($this->request->is(['patch', 'post', 'put'])) {
			$file = $this->request->data['image'];
			$file_name=$file['name'];
			$ext = substr(strtolower(strrchr($file['name'], '.')), 1); //get the extension
            $arr_ext = array('jpg', 'jpeg', 'png'); //set allowed extensions
            $setNewFileName = uniqid();		
            $img_name= $setNewFileName.'.'.$ext;
			if(!empty($file_name)){
			$this->request->data['image']=$img_name;
			}else{
				$this->request->data['image']=$old_image_name;
			}
            $bulkBookingLead = $this->BulkBookingLeads->patchEntity($bulkBookingLead, $this->request->getData());
			$bulkBookingLead->created_on=date('Y-m-d', strtotime($this->request->data['created_on']));

            if ($this->BulkBookingLeads->save($bulkBookingLead)) {
				
				$bulkBookingLead->created_on=date('Y-m-d', strtotime($this->request->data['created_on']));
				$bulkBookingLead->jain_thela_admin_id=$jain_thela_admin_id;
				if(!empty($file_name)){
					if (in_array($ext, $arr_ext)) {
					move_uploaded_file($file['tmp_name'], WWW_ROOT . 'img/bulkbookingimages/'.$img_name);
					}   
				}
                $this->Flash->success(__('The bulk booking lead has been saved.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The bulk booking lead could not be saved. Please, try again.'));
			 
        }
        $jainThelaAdmins = $this->BulkBookingLeads->JainThelaAdmins->find('list', ['limit' => 200]);
        $this->set(compact('bulkBookingLead', 'jainThelaAdmins'));
        $this->set('_serialize', ['bulkBookingLead']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Bulk Booking Lead id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $bulkBookingLead = $this->BulkBookingLeads->get($id);
        if ($this->BulkBookingLeads->delete($bulkBookingLead)){
            $this->Flash->success(__('The bulk booking lead has been deleted.'));
        } else {
            $this->Flash->error(__('The bulk booking lead could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
