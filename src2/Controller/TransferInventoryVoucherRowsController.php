<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * TransferInventoryVoucherRows Controller
 *
 * @property \App\Model\Table\TransferInventoryVoucherRowsTable $TransferInventoryVoucherRows
 *
 * @method \App\Model\Entity\TransferInventoryVoucherRow[] paginate($object = null, array $settings = [])
 */
class TransferInventoryVoucherRowsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['TransferInventoryVouchers', 'Items']
        ];
        $transferInventoryVoucherRows = $this->paginate($this->TransferInventoryVoucherRows);

        $this->set(compact('transferInventoryVoucherRows'));
        $this->set('_serialize', ['transferInventoryVoucherRows']);
    }

    /**
     * View method
     *
     * @param string|null $id Transfer Inventory Voucher Row id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $transferInventoryVoucherRow = $this->TransferInventoryVoucherRows->get($id, [
            'contain' => ['TransferInventoryVouchers', 'Items']
        ]);

        $this->set('transferInventoryVoucherRow', $transferInventoryVoucherRow);
        $this->set('_serialize', ['transferInventoryVoucherRow']);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $transferInventoryVoucherRow = $this->TransferInventoryVoucherRows->newEntity();
        if ($this->request->is('post')) {
            $transferInventoryVoucherRow = $this->TransferInventoryVoucherRows->patchEntity($transferInventoryVoucherRow, $this->request->getData());
            if ($this->TransferInventoryVoucherRows->save($transferInventoryVoucherRow)) {
                $this->Flash->success(__('The transfer inventory voucher row has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The transfer inventory voucher row could not be saved. Please, try again.'));
        }
        $transferInventoryVouchers = $this->TransferInventoryVoucherRows->TransferInventoryVouchers->find('list', ['limit' => 200]);
        $items = $this->TransferInventoryVoucherRows->Items->find('list', ['limit' => 200]);
        $this->set(compact('transferInventoryVoucherRow', 'transferInventoryVouchers', 'items'));
        $this->set('_serialize', ['transferInventoryVoucherRow']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Transfer Inventory Voucher Row id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $transferInventoryVoucherRow = $this->TransferInventoryVoucherRows->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $transferInventoryVoucherRow = $this->TransferInventoryVoucherRows->patchEntity($transferInventoryVoucherRow, $this->request->getData());
            if ($this->TransferInventoryVoucherRows->save($transferInventoryVoucherRow)) {
                $this->Flash->success(__('The transfer inventory voucher row has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The transfer inventory voucher row could not be saved. Please, try again.'));
        }
        $transferInventoryVouchers = $this->TransferInventoryVoucherRows->TransferInventoryVouchers->find('list', ['limit' => 200]);
        $items = $this->TransferInventoryVoucherRows->Items->find('list', ['limit' => 200]);
        $this->set(compact('transferInventoryVoucherRow', 'transferInventoryVouchers', 'items'));
        $this->set('_serialize', ['transferInventoryVoucherRow']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Transfer Inventory Voucher Row id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $transferInventoryVoucherRow = $this->TransferInventoryVoucherRows->get($id);
        if ($this->TransferInventoryVoucherRows->delete($transferInventoryVoucherRow)) {
            $this->Flash->success(__('The transfer inventory voucher row has been deleted.'));
        } else {
            $this->Flash->error(__('The transfer inventory voucher row could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
