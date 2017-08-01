<?php
namespace App\Controller;
use App\Controller\AppController;
use Cake\Event\Event;
use Cake\View\View;
use Cake\ORM\TableRegistry;
use Cake\Validation\Validation;
use Cake\Routing\Router;
use Cake\Mailer\Email;
class UsersController extends AppController
{
	public function initialize()
	{
		parent::initialize();
		$this->Auth->allow(['logout', 'index']);
		$role_id=$this->Auth->User('role_id');
		$this->set(compact(['role_id']));
	}
	public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        // Allow users to register and logout.
        // You should not add the "login" action to allow list. Doing so would
        // cause problems with normal functioning of AuthComponent.
        $this->Auth->allow([ 'logout', 'login']);
    }
	
	public function logout()
	{
		//$this->Flash->success('You are now logged out.');
		return $this->redirect($this->Auth->logout());
	}
	
    public function login()
    {
		$this->viewBuilder()->layout('login_layout');
        if ($this->request->is('post')) 
		{
              $user = $this->Auth->identify();
		 
            if ($user) 
			{
				
                $this->Auth->setUser($user);
				//pr($user);exit;
				@header('location: Orders/dashboard');
				//return $this->redirect(['controller'=>'Homes','action' => 'index']);
				return $this->redirect(['controller'=>'Orders','action' => 'dashboard']);
            }
            $this->Flash->error_login(__('Invalid Username or Password'));
        }
    }
	public function index()
	{
		$this->viewBuilder()->layout('index_layout');
	}

}

