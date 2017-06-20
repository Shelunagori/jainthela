<?php
namespace App\Controller\Api;
use App\Controller\Api\AppController;
class ItemsController extends AppController
{
    public function item()
    {
		$jain_thela_admin_id=$this->request->query('jain_thela_admin_id');
        $items = $this->Items->find()
		->where(['Items.jain_thela_admin_id'=>$jain_thela_admin_id])
		->contain('ItemCategories', 'Units');
		$status=true;
		$error="";
        $this->set(compact('status', 'error', 'items', 'ItemCategories'));
        $this->set('_serialize', ['status', 'error', 'items', 'ItemCategories']);
    }
}
