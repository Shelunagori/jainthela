<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * PushNotifications Controller
 *
 * @property \App\Model\Table\PushNotificationsTable $PushNotifications
 *
 * @method \App\Model\Entity\PushNotification[] paginate($object = null, array $settings = [])
 */
class PushNotificationsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
		$this->viewBuilder()->layout('index_layout');
       
    }
	

	public function home()
    {
		$this->viewBuilder()->layout('index_layout');
        $pushNotification = $this->PushNotifications->newEntity();
		$customers = $this->PushNotifications->Customers->find();
		$page = $this->request->getQuery('page');
		if($page=="home")
		{
		$deepLinks = $this->PushNotifications->DeepLinks->find()->where(['id'=>1])->first();}
		if($page=="bulkbooking")
		{
		$deepLinks = $this->PushNotifications->DeepLinks->find()->where(['id'=>2])->first();}
		if($page=="referfriend")
		{
		$deepLinks = $this->PushNotifications->DeepLinks->find()->where(['id'=>3])->first();}
		if($page=="addmoney")
		{
		$deepLinks = $this->PushNotifications->DeepLinks->find()->where(['id'=>4])->first();}
		if($page=="viewcart")
		{
		$deepLinks = $this->PushNotifications->DeepLinks->find()->where(['id'=>5])->first();}
		if($page=="specialoffers")
		{
		$deepLinks = $this->PushNotifications->DeepLinks->find()->where(['id'=>6])->first();}
		
        if ($this->request->is('post'))
			{
			$pushNotification = $this->PushNotifications->patchEntity($pushNotification, $this->request->data);
            $file = $this->request->data['image'];
			$ext = substr(strtolower(strrchr($file['name'], '.')), 1); //get the extension
            $arr_ext = array('jpg', 'jpeg', 'png'); //set allowed extensions
            $setNewFileName = uniqid();
            $pushNotification->image = $setNewFileName . '.' . $ext;
			if (in_array($ext, $arr_ext))
				{
					move_uploaded_file($file['tmp_name'], WWW_ROOT . '/PushNotifications/' . $setNewFileName . '.' . $ext);
				}
			$pushNotification->link_url = $deepLinks->link_url;
			if ($this->PushNotifications->save($pushNotification))
			  {
			   foreach($customers as $customer)
				{
					$pushNotificationCustomer = $this->PushNotifications->PushNotificationCustomers->newEntity(); 
					$pushNotificationCustomer->customer_id =$customer->id;
					$pushNotificationCustomer->push_notification_id =$pushNotification->id;
					$this->PushNotifications->PushNotificationCustomers->save($pushNotificationCustomer);
				}
				$this->Flash->success(__('The push notification saved.'));
			} 
			else {
				$this->Flash->error(__('The push notification could not be saved. Please, try again.'));
				}
			}
			$this->set('page', $page);
		$this->set('pushNotification', $pushNotification);
        $this->set('_serialize', ['pushNotification']);
		
	}
    /**
     * View method
     *
     * @param string|null $id Push Notification id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $this->viewBuilder()->layout('index_layout');
		$pushNotification = $this->PushNotifications->get($id, [
            'contain' => ['PushNotificationCustomer']
        ]);

        $this->set('pushNotification', $pushNotification);
        $this->set('_serialize', ['pushNotification']);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $pushNotification = $this->PushNotifications->newEntity();
        if ($this->request->is('post')) {
            $pushNotification = $this->PushNotifications->patchEntity($pushNotification, $this->request->getData());
            if ($this->PushNotifications->save($pushNotification)) {
                $this->Flash->success(__('The push notification has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The push notification could not be saved. Please, try again.'));
        }
        $this->set(compact('pushNotification'));
        $this->set('_serialize', ['pushNotification']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Push Notification id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $pushNotification = $this->PushNotifications->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $pushNotification = $this->PushNotifications->patchEntity($pushNotification, $this->request->getData());
            if ($this->PushNotifications->save($pushNotification)) {
                $this->Flash->success(__('The push notification has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The push notification could not be saved. Please, try again.'));
        }
        $this->set(compact('pushNotification'));
        $this->set('_serialize', ['pushNotification']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Push Notification id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $pushNotification = $this->PushNotifications->get($id);
        if ($this->PushNotifications->delete($pushNotification)) {
            $this->Flash->success(__('The push notification has been deleted.'));
        } else {
            $this->Flash->error(__('The push notification could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
