<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * LedgerAccounts Controller
 *
 * @property \App\Model\Table\LedgerAccountsTable $LedgerAccounts
 *
 * @method \App\Model\Entity\LedgerAccount[] paginate($object = null, array $settings = [])
 */
class LedgerAccountsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['JainThelaAdmins', 'Vendors', 'AccountGroups']
        ];
        $ledgerAccounts = $this->paginate($this->LedgerAccounts);

        $this->set(compact('ledgerAccounts'));
        $this->set('_serialize', ['ledgerAccounts']);
    }

    /**
     * View method
     *
     * @param string|null $id Ledger Account id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $ledgerAccount = $this->LedgerAccounts->get($id, [
            'contain' => ['JainThelaAdmins', 'Vendors', 'AccountGroups']
        ]);

        $this->set('ledgerAccount', $ledgerAccount);
        $this->set('_serialize', ['ledgerAccount']);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $ledgerAccount = $this->LedgerAccounts->newEntity();
        if ($this->request->is('post')) {
            $ledgerAccount = $this->LedgerAccounts->patchEntity($ledgerAccount, $this->request->getData());
            if ($this->LedgerAccounts->save($ledgerAccount)) {
                $this->Flash->success(__('The ledger account has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The ledger account could not be saved. Please, try again.'));
        }
        $jainThelaAdmins = $this->LedgerAccounts->JainThelaAdmins->find('list', ['limit' => 200]);
        $vendors = $this->LedgerAccounts->Vendors->find('list', ['limit' => 200]);
        $accountGroups = $this->LedgerAccounts->AccountGroups->find('list', ['limit' => 200]);
        $this->set(compact('ledgerAccount', 'jainThelaAdmins', 'vendors', 'accountGroups'));
        $this->set('_serialize', ['ledgerAccount']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Ledger Account id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $ledgerAccount = $this->LedgerAccounts->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $ledgerAccount = $this->LedgerAccounts->patchEntity($ledgerAccount, $this->request->getData());
            if ($this->LedgerAccounts->save($ledgerAccount)) {
                $this->Flash->success(__('The ledger account has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The ledger account could not be saved. Please, try again.'));
        }
        $jainThelaAdmins = $this->LedgerAccounts->JainThelaAdmins->find('list', ['limit' => 200]);
        $vendors = $this->LedgerAccounts->Vendors->find('list', ['limit' => 200]);
        $accountGroups = $this->LedgerAccounts->AccountGroups->find('list', ['limit' => 200]);
        $this->set(compact('ledgerAccount', 'jainThelaAdmins', 'vendors', 'accountGroups'));
        $this->set('_serialize', ['ledgerAccount']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Ledger Account id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $ledgerAccount = $this->LedgerAccounts->get($id);
        if ($this->LedgerAccounts->delete($ledgerAccount)) {
            $this->Flash->success(__('The ledger account has been deleted.'));
        } else {
            $this->Flash->error(__('The ledger account could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
