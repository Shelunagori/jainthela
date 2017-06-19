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
	public function home()
    {
		$jain_thela_admin_id=$this->request->query('jain_thela_admin_id');
	    $itemCategories = $this->Items->ItemCategories->find('All')->where(['jain_thela_admin_id'=>$jain_thela_admin_id]);
		$status=true;
		$error="";
        $this->set(compact('status', 'error', 'itemCategories'));
        $this->set('_serialize', ['status', 'error', 'itemCategories']);
    }
	
	public function registration()
    {
		$mobile_no=$this->request->query('mobile_no');
	    $customerDetails = $this->Items->Customers->find()->where(['mobile_no'=>$mobile_no]);
		if(!empty($itemCategories))
		{
		$status=true;
		$error="";
        $this->set(compact('status', 'error', 'customerDetails'));
        $this->set('_serialize', ['status', 'error', 'customerDetails']);
		}
		else{
			$status=true;
		$error="";
        $this->set(compact('status', 'error', 'customerDetails'));
        $this->set('_serialize', ['status', 'error', 'customerDetails']);
		}
    }
	
	
	
	/* public function view()
    {
		$id=$this->request->query('id');
        $item = $this->Items->get($id);
		$status=true;
		$error="";
		$this->set(compact('status', 'error', 'item'));
        $this->set('_serialize', ['status', 'error', 'item']);
    } */
	
	/* public function add()
    {
		
		$status=true;
		$error="";
        $this->set(compact('status', 'error'));
        $this->set('_serialize', ['status', 'error']);
    }
	 */
	/* public function view()
    {
		
		$status=true;
		$error="view";
        $this->set(compact('status', 'error'));
        $this->set('_serialize', ['status', 'error']);
    } */
	/* public function updateJainCash()
    {
		
		$status=true;
		$error="updateJainCash";
        $this->set(compact('status', 'error'));
        $this->set('_serialize', ['status', 'error']);
    }
	 */
}
