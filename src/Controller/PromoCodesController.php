<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * PromoCodes Controller
 *
 * @property \App\Model\Table\PromoCodesTable $PromoCodes
 *
 * @method \App\Model\Entity\PromoCode[] paginate($object = null, array $settings = [])
 */
class PromoCodesController extends AppController
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
		$promoCode = $this->PromoCodes->newEntity();
        if ($this->request->is(['patch', 'post', 'put'])) {
            $promoCode = $this->PromoCodes->patchEntity($promoCode, $this->request->getData());
			$promoCode->jain_thela_admin_id=$jain_thela_admin_id;
			$promoCode->status='Active';
            if ($this->PromoCodes->save($promoCode)) {
                $this->Flash->success(__('The promo code has been saved.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The promo code could not be saved. Please, try again.'));
        }
        $promoCodes = $this->PromoCodes->find()->where(['PromoCodes.jain_thela_admin_id'=>$jain_thela_admin_id]);
        $itemCategories = $this->PromoCodes->ItemCategories->find('list', ['limit' => 200])->where(['jain_thela_admin_id'=>$jain_thela_admin_id]);
        $this->set(compact('promoCode', 'promoCodes', 'itemCategories'));
		$this->set('_serialize', ['promoCode']);
        $this->set('_serialize', ['promoCodes']);
    }
	
	public function ajaxStatusPromoCode($status,$status_id)
    {
		        $query=$this->PromoCodes->query();
				$result = $query->update()
                    ->set(['status' => $status])
                    ->where(['id' => $status_id])
                    ->execute();
    }

    /**
     * View method
     *
     * @param string|null $id Promo Code id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $promoCode = $this->PromoCodes->get($id, [
            'contain' => ['ItemCategories', 'JainThelaAdmins', 'Orders']
        ]);

        $this->set('promoCode', $promoCode);
        $this->set('_serialize', ['promoCode']);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $promoCode = $this->PromoCodes->newEntity();
        if ($this->request->is('post')) {
            $promoCode = $this->PromoCodes->patchEntity($promoCode, $this->request->getData());
            if ($this->PromoCodes->save($promoCode)) {
                $this->Flash->success(__('The promo code has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The promo code could not be saved. Please, try again.'));
        }
        $itemCategories = $this->PromoCodes->ItemCategories->find('list', ['limit' => 200]);
        $jainThelaAdmins = $this->PromoCodes->JainThelaAdmins->find('list', ['limit' => 200]);
        $this->set(compact('promoCode', 'itemCategories', 'jainThelaAdmins'));
        $this->set('_serialize', ['promoCode']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Promo Code id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $promoCode = $this->PromoCodes->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $promoCode = $this->PromoCodes->patchEntity($promoCode, $this->request->getData());
            if ($this->PromoCodes->save($promoCode)) {
                $this->Flash->success(__('The promo code has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The promo code could not be saved. Please, try again.'));
        }
        $itemCategories = $this->PromoCodes->ItemCategories->find('list', ['limit' => 200]);
        $jainThelaAdmins = $this->PromoCodes->JainThelaAdmins->find('list', ['limit' => 200]);
        $this->set(compact('promoCode', 'itemCategories', 'jainThelaAdmins'));
        $this->set('_serialize', ['promoCode']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Promo Code id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $promoCode = $this->PromoCodes->get($id);
        if ($this->PromoCodes->delete($promoCode)) {
            $this->Flash->success(__('The promo code has been deleted.'));
        } else {
            $this->Flash->error(__('The promo code could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
