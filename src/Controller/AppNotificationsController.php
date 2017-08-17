<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * AppNotifications Controller
 *
 * @property \App\Model\Table\AppNotificationsTable $AppNotifications
 *
 * @method \App\Model\Entity\AppNotification[] paginate($object = null, array $settings = [])
 */
class AppNotificationsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
		$this->viewBuilder()->layout('index_layout');
        $appNotifications = $this->AppNotifications->find()->order(['created_on'=>'DESC'])->contain(['AppNotificationCustomers' => function($q) {
								$q->select([
									 'AppNotificationCustomers.app_notification_id',
									 'count_customer' => $q->func()->count('AppNotificationCustomers.app_notification_id')
								])
								->group(['AppNotificationCustomers.app_notification_id']);

								return $q;
							}]);
		$this->set('appNotifications', $appNotifications);
		$this->set('_serialize', ['appNotifications']);
    }
	
	
	
	public function home()
    {
		$this->viewBuilder()->layout('index_layout');
        $appNotification = $this->AppNotifications->newEntity();
		$customers = $this->AppNotifications->Customers->find();
		$page = $this->request->getQuery('page');
		if($page=="home")
		{
		$deepLinks = $this->AppNotifications->DeepLinks->find()->where(['id'=>1])->first();
		}
		if($page=="bulkbooking")
		{
		
		$deepLinks = $this->AppNotifications->DeepLinks->find()->where(['id'=>2])->first();}
		if($page=="referfriend")
		{
		$deepLinks = $this->AppNotifications->DeepLinks->find()->where(['id'=>3])->first();}
		if($page=="addmoney")
		{
		
		$deepLinks = $this->AppNotifications->DeepLinks->find()->where(['id'=>4])->first();}
		if($page=="viewcart")
		{
		
		$deepLinks = $this->AppNotifications->DeepLinks->find()->where(['id'=>5])->first();}
		if($page=="specialoffers")
		{
		
		$deepLinks = $this->AppNotifications->DeepLinks->find()->where(['id'=>6])->first();}
		
        if ($this->request->is('post'))
			{
				$appNotification = $this->AppNotifications->patchEntity($appNotification, $this->request->data);
				$file = $this->request->data['image'];
				$file_name=$file['name'];
				
				if(!empty($file_name))
				{
				$ext = substr(strtolower(strrchr($file['name'], '.')), 1); //get the extension
				$arr_ext = array('jpg', 'jpeg', 'png'); //set allowed extensions
				$setNewFileName = uniqid();
				$appNotification->image = 'http://app.jainthela.in'.$this->request->webroot.'Notify_images/'.$setNewFileName . '.' .$ext;
				
				if (in_array($ext, $arr_ext))
				{
					 
						move_uploaded_file($file['tmp_name'], WWW_ROOT . '/Notify_images/' . $setNewFileName . '.' . $ext);
				}
			}

			else{
					$appNotification->image = 'http://app.jainthela.in'.$this->request->webroot.'Notify_images/jainthela.jpg';
			}
			

			$appNotification->app_link = $deepLinks->link_url;
			$appNotification->screen_type = $deepLinks->link_name; 
			if ($push_data=$this->AppNotifications->save($appNotification))
			  {
				  if($page=="viewcart")
				  {
				  $this->loadModel('Carts');
				  $customerscart = $this->Carts->find()
				   ->select(['customer_id'])
				  ->group(['customer_id'])
				  ->autoFields(true);
				  if(!empty($customerscart->toArray()))
					{
						foreach($customerscart as $customer1)
						{
							$appNotificationCustomer = $this->AppNotifications->AppNotificationCustomers->newEntity(); 
							$appNotificationCustomer->customer_id =$customer1->customer_id;
							$appNotificationCustomer->app_notification_id =$push_data->id;
							$this->AppNotifications->AppNotificationCustomers->save($appNotificationCustomer);
						}
						$id=$appNotification->id;
						$this->Flash->success(__('The push notification saved.'));
						$this->redirect(['action' => 'sendProgress/' . $id]);
					}
				  else{
				$this->Flash->error(__('Right now no customers who added items in their cart.'));
				  }
				  
				  }
				  else
				  {
			    foreach($customers as $customer)
				 {
					$appNotificationCustomer = $this->AppNotifications->AppNotificationCustomers->newEntity(); 
					$appNotificationCustomer->customer_id =$customer->id;
					$appNotificationCustomer->app_notification_id =$push_data->id;
					$this->AppNotifications->AppNotificationCustomers->save($appNotificationCustomer);
				 }
				 
				 $id=$appNotification->id;
				$this->Flash->success(__('The app notification saved.'));
				$this->redirect(['action' => 'sendProgress/' . $id]);
				  }
				
			} 
			else {
				$this->Flash->error(__('The app notification could not be saved. Please, try again.'));
				}
			}
			$this->set('page', $page);
		$this->set('appNotification', $appNotification);
        $this->set('_serialize', ['appNotification']);
		
	}
		
		
	
	public function ItemView()
    {
		$this->viewBuilder()->layout('index_layout');
        $appNotification = $this->AppNotifications->newEntity();
		
		$customers = $this->AppNotifications->Customers->find();
		$this->loadModel('Items');
		$item_fetchs=$this->Items->find()->where(['freeze'=>0,'ready_to_sale'=>'Yes']);
		$path = 'http://app.jainthela.in'.$this->request->webroot.'img/item_images/';
		foreach($item_fetchs as $item_fetch){
			$item_name=$item_fetch->name;
			$alias_name=$item_fetch->alias_name;
			@$image=$item_fetch->image;
			$final_image_full_path=$path.$image;
			$Items[]= ['value'=>$item_fetch->id,'text'=>$item_name." (".$alias_name.")", 'image'=>$final_image_full_path];
		}

		$deepLinks = $this->AppNotifications->DeepLinks->find()->where(['id'=>7])->first();
         if ($this->request->is('post'))
			{
			$appNotification = $this->AppNotifications->patchEntity($appNotification, $this->request->data);
            
			$appNotification->app_link = $deepLinks->link_url;
			$appNotification->screen_type = 'Product Description';
		
			if ($push_data=$this->AppNotifications->save($appNotification))
			  {
			   foreach($customers as $customer)
				{
					$appNotificationCustomer = $this->AppNotifications->AppNotificationCustomers->newEntity();
					$appNotificationCustomer->customer_id =$customer->id;
					$appNotificationCustomer->app_notification_id =$push_data->id;
					$this->AppNotifications->AppNotificationCustomers->save($appNotificationCustomer);
				}
				$id=$appNotification->id;
				$this->Flash->success(__('The app notification saved.'));
			 $this->redirect(['action' => 'sendProgress/' . $id]);
			} 
			else {
				$this->Flash->error(__('The app notification could not be saved. Please, try again.'));
				}
			}
		$this->set('appNotification', $appNotification);
		$this->set('Items', $Items);
        $this->set('_serialize', ['appNotification', 'Items']);
		
	}
	
	
	
	public function sendProgress($id = null)
    {
		$this->viewBuilder()->layout('index_layout');
		$this->set('id', $id);   
    }
	public function checkNotify($id)
    {
		$this->viewBuilder()->layout(null);
		$appNotifications = $this->AppNotifications->AppNotificationCustomers->find()->where(['sent'=>0,'app_notification_id'=>$id])->contain(['Customers'])->limit(1);
		$appNotifications_data = $this->AppNotifications->find()->where(['id'=>$id])->first();
		
		$screen_type=$appNotifications_data->screen_type;
		 
		$item_id=$appNotifications_data->item_id;
		$image=$appNotifications_data->image;
		if($screen_type=='Product Description'){

			$created_link=$appNotifications_data->app_link.'?item_id='.$item_id;
			
		}else{
			$created_link=$appNotifications_data->app_link;
		}
		foreach($appNotifications as $appNotification)
		{
			  $API_ACCESS_KEY=$appNotification->customer->notification_key;
				$device_token=$appNotification->customer->device_token;
				  $device_token1=rtrim($device_token);
					
                if(!empty($device_token))
					 
					$msg = array
							(
							'message'     =>$appNotifications_data->message,
							'image'     =>'',
							'link'    => $created_link,
							'notification_id'    => $item_id,
							);
						
						$url = 'https://fcm.googleapis.com/fcm/send';
						$fields = array
						(
							'registration_ids'     => array($device_token),
							'data'            => @$msg,
						);
						$headers = array
						(
							'Authorization: key=' .$API_ACCESS_KEY,
							'Content-Type: application/json'
						);

						  json_encode($fields);
						  $ch = curl_init();
						curl_setopt($ch, CURLOPT_URL, $url);
						curl_setopt($ch, CURLOPT_POST, true);
						curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
						curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
						curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
						curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
						curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
						$result = curl_exec($ch);
						if ($result === FALSE) {
							//die('FCM Send Error: ' . curl_error($ch));
						}
						curl_close($ch);
						$l[]=$result;
						//return $l;  
						
						
						$query = $this->AppNotifications->AppNotificationCustomers->query();
						$query->update()
							->set(['sent'=>1])
							->where(['id' => $appNotification->id])
							->execute();
		}
		$total_records = $this->AppNotifications->AppNotificationCustomers->find()->where(['app_notification_id'=>$id])->count();
		$total_converted_records = $this->AppNotifications->AppNotificationCustomers->find()->where(['sent'=>1,'app_notification_id'=>$id])->count();
		$converted_per=($total_converted_records*100)/$total_records;
		    if($converted_per==100){ $again_call_ajax="NO";
                                   }
									else{$again_call_ajax="YES";}
			die(json_encode(array("again_call_ajax"=>$again_call_ajax,"converted_per"=>$converted_per)));
   }

    /**
     * View method
     *
     * @param string|null $id App Notification id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
	 
	   public function view($id = null)
    {
        $this->viewBuilder()->layout('index_layout');
		$appNotification = $this->AppNotifications->get($id, [
            'contain' => ['AppNotificationCustomer']
        ]);

        $this->set('appNotification', $appNotification);
        $this->set('_serialize', ['appNotification']);
    }
 

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $appNotification = $this->AppNotifications->newEntity();
        if ($this->request->is('post')) {
            $appNotification = $this->AppNotifications->patchEntity($appNotification, $this->request->getData());
            if ($this->AppNotifications->save($appNotification)) {
                $this->Flash->success(__('The app notification has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The app notification could not be saved. Please, try again.'));
        }
        
        $this->set(compact('appNotification', 'items'));
        $this->set('_serialize', ['appNotification']);
    }

	 
    /**
     * Edit method
     *
     * @param string|null $id App Notification id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $appNotification = $this->AppNotifications->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $appNotification = $this->AppNotifications->patchEntity($appNotification, $this->request->getData());
            if ($this->AppNotifications->save($appNotification)) {
                $this->Flash->success(__('The app notification has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The app notification could not be saved. Please, try again.'));
        }
        $this->set(compact('appNotification', 'items'));
        $this->set('_serialize', ['appNotification']);
    }

    /**
     * Delete method
     *
     * @param string|null $id App Notification id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $appNotification = $this->AppNotifications->get($id);
        if ($this->AppNotifications->delete($appNotification)) {
            $this->Flash->success(__('The app notification has been deleted.'));
        } else {
            $this->Flash->error(__('The app notification could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
