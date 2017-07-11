<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Leads Controller
 *
 * @property \App\Model\Table\LeadsTable $Leads
 *
 * @method \App\Model\Entity\Lead[] paginate($object = null, array $settings = [])
 */
class LeadsController extends AppController
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
			$lead_id=$this->request->data['lead_id'];
			$reason=$this->request->data['reason'];
			$lead=$this->Leads->get($lead_id);
			$lead->status='Closed';
			$lead->reason=$reason;
			$this->Leads->save($lead);
            //$this->Flash->sussess(__('The leads could not be saved. Please, try again.'));
        }
		if($status==''){ $status='open'; }
        if($status=='open')
		{
			$leads = $this->Leads->find()->where(['status' => 'Open','jain_thela_admin_id' => $jain_thela_admin_id ]);
		} 
		elseif($status=='close')
		{
			$where = $status;
			$leads = $this->Leads->find()->where(['status' => 'Closed','jain_thela_admin_id' => $jain_thela_admin_id ]);
		}
        $this->set(compact('leads','status'));
        $this->set('_serialize', ['leads']);
    }

    /**
     * View method
     *
     * @param string|null $id Lead id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $lead = $this->Leads->get($id, [
            'contain' => ['JainThelaAdmins']
        ]);

        $this->set('lead', $lead);
        $this->set('_serialize', ['lead']);
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
		
        $lead = $this->Leads->newEntity();
        if ($this->request->is('post')) {
			$lead = $this->Leads->patchEntity($lead, $this->request->getData());
			$last_lead_no = $this->Leads->find()->select(['lead_no'])->where(['jain_thela_admin_id' => $jain_thela_admin_id])->order(['lead_no'=>'DESC'])->first();
			if($last_lead_no){
				$lead->lead_no = $last_lead_no->lead_no+1;
			}else{
				$lead->lead_no=1;
			}
			
			  $lead->created_on=date('Y-m-d', strtotime($this->request->data['created_on']));
			  $lead->jain_thela_admin_id=$jain_thela_admin_id;
             if ($this->Leads->save($lead)) {
                $this->Flash->success(__('The lead has been saved.'));
                  return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The lead could not be saved. Please, try again.'));
        }
        $jainThelaAdmins = $this->Leads->JainThelaAdmins->find('list', ['limit' => 200]);
        $this->set(compact('lead', 'jainThelaAdmins'));
        $this->set('_serialize', ['lead']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Lead id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
		$this->viewBuilder()->layout('index_layout'); 
 		$jain_thela_admin_id=$this->Auth->User('jain_thela_admin_id');
		
        $lead = $this->Leads->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $lead = $this->Leads->patchEntity($lead, $this->request->getData());
			  $lead->created_on=date('Y-m-d', strtotime($this->request->data['created_on']));
			  $lead->jain_thela_admin_id=$jain_thela_admin_id;
            if ($this->Leads->save($lead)) {
                $this->Flash->success(__('The lead has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The lead could not be saved. Please, try again.'));
        }
        $jainThelaAdmins = $this->Leads->JainThelaAdmins->find('list', ['limit' => 200]);
        $this->set(compact('lead', 'jainThelaAdmins'));
        $this->set('_serialize', ['lead']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Lead id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $lead = $this->Leads->get($id);
        if ($this->Leads->delete($lead)) {
            $this->Flash->success(__('The lead has been deleted.'));
        } else {
            $this->Flash->error(__('The lead could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
