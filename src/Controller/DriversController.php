<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Drivers Controller
 *
 * @property \App\Model\Table\DriversTable $Drivers
 *
 * @method \App\Model\Entity\Driver[] paginate($object = null, array $settings = [])
 */
class DriversController extends AppController
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
        
        $drivers = $this->paginate($this->Drivers);

        $this->set(compact('drivers'));
        $this->set('_serialize', ['drivers']);
    }

	public function driverLocation()
    {
		$this->viewBuilder()->layout('index_layout');
		$jain_thela_admin_id=$this->Auth->User('jain_thela_admin_id');
		$current_date=date('Y-m-d');

      
		$query=$this->Drivers->DriverLocations->find();
		$query->select(['id' => $query->func()->max('DriverLocations.id')])
		->group(['driver_id']);
		$ids=[];
		foreach($query as $data){
			$ids[]=$data->id;
		}
		$driver_details = $this->Drivers->DriverLocations->find()
							->where(['DriverLocations.id IN'=>$ids,'DriverLocations.lattitude !='=>'','DriverLocations.longitude !='=>''])
							->contain(['Drivers']);
		
		$drivers=$this->Drivers->find('list');
        $this->set(compact('driver_details', 'drivers'));
        $this->set('_serialize', ['driver_details', 'drivers']);
    }
	
    /**
     * View method
     *
     * @param string|null $id Driver id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $driver = $this->Drivers->get($id, [
            'contain' => ['Cities']
        ]);

        $this->set('driver', $driver);
        $this->set('_serialize', ['driver']);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add($id=null)
    {
		$this->viewBuilder()->layout('index_layout');
		$jain_thela_admin_id=$this->Auth->User('jain_thela_admin_id');
		if(!$id){
			$driver = $this->Drivers->newEntity();
		}else{
			 $driver = $this->Drivers->get($id, [
            'contain' => []
			]);
		}
        if ($this->request->is(['patch', 'post', 'put'])) {
			$password=md5($this->request->data('password'));
            $driver = $this->Drivers->patchEntity($driver, $this->request->getData());
            $driver->jain_thela_admin_id=$jain_thela_admin_id;
            $driver->device_token='AAAAXmNqxY4:APA91bG0X6RHVhwJKXUQGNSSCas44hruFdR6_CFd6WHPwx9abUr-WsrfEzsFInJawElgrp24QzaE4ksfmXu6kmIL6JG3yP487fierMys5byv-I1agRtMPIoSqdgCZf8R0iqsnds-u4CU';
            $driver->password=$password;
			if ($this->Drivers->save($driver)) {
                $this->Flash->success(__('The driver has been saved.'));
                return $this->redirect(['action' => 'add']);
            }
            $this->Flash->error(__('The driver could not be saved. Please, try again.'));
        }
		$driver_details = $this->paginate($this->Drivers);

       // $cities = $this->Drivers->Cities->find('list', ['limit' => 200]);
        $this->set(compact('driver', 'driver_details', 'id'));
        $this->set('_serialize', ['driver', 'driver_details', 'id']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Driver id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
		$this->viewBuilder()->layout('index_layout');
		$city_id=$this->Auth->User('city_id');
        $driver = $this->Drivers->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $driver = $this->Drivers->patchEntity($driver, $this->request->getData());
            $driver->city_id=$city_id;
			if ($this->Drivers->save($driver)) {
                $this->Flash->success(__('The driver has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The driver could not be saved. Please, try again.'));
        }
        $cities = $this->Drivers->Cities->find('list', ['limit' => 200]);
        $this->set(compact('driver', 'cities'));
        $this->set('_serialize', ['driver']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Driver id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $driver = $this->Drivers->get($id);
        if ($this->Drivers->delete($driver)) {
            $this->Flash->success(__('The driver has been deleted.'));
        } else {
            $this->Flash->error(__('The driver could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'add']);
    }
}
