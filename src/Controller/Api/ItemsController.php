<?php
namespace App\Controller\Api;
use App\Controller\Api\AppController;
class ItemsController extends AppController
{
    public function index()
    {
		$jain_thela_admin_id=1;
        $items = $this->Items->find()->where(['Items.jain_thela_admin_id'=>$jain_thela_admin_id])->contain(['ItemCategories', 'Units']);
		$status=true;
		$error="";
        $this->set(compact('status', 'error', 'items'));
        $this->set('_serialize', ['status', 'error', 'items']);
    }
	public function view()
    {
		$id=$this->request->query('id');
        $item = $this->Items->get($id);
		$status=true;
		$error="";
		$this->set(compact('status', 'error', 'item'));
        $this->set('_serialize', ['status', 'error', 'item']);
    }
	
	
}