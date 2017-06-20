<?php
namespace App\Controller\Api;
use App\Controller\Api\AppController;
class ItemCategoriesController extends AppController
{
	public function home()
    {
		/// category ///
		$dir_url='http://13.126.58.104'.$this->request->webroot.'itemcategories/';
		$banner_url='http://13.126.58.104'.$this->request->webroot.'banners/';
		$jain_thela_admin_id=$this->request->query('jain_thela_admin_id');
	    $itemCategories = $this->ItemCategories->find('All')->where(['jain_thela_admin_id'=>$jain_thela_admin_id]);
		$itemCategories->dsir_url=$dir_url;
	    $banners = $this->ItemCategories->Banners->find('All')->where(['link_name'=>'offer', 'Banners.status'=>'active']);
		
		$query=$this->ItemCategories->Items->ItemLedgers->find();
		$popular_items=$query
						->select(['total_rows' => $query->func()->count('ItemLedgers.id'),'item_id',])
						->where(['inventory_transfer'=>'no','status'=>'out'])
						->group(['ItemLedgers.item_id'])
						->order(['total_rows'=>'DESC'])
						->limit(5)
						->contain(['Items'=>function($q){
							return $q->select(['name', 'image', 'sales_rate'])
									->contain(['Units'=>function($q){
										return $q->select(['longname','shortname']);
									}]);
						}]);

		$recently_bought=[];		
		$status=true;
		$error="";
        $this->set(compact('status', 'error', 'dir_url', 'banner_url', 'itemCategories', 'banners','popular_items','recently_bought'));
        $this->set('_serialize', ['status', 'error', 'dir_url', 'banner_url', 'itemCategories', 'banners', 'popular_items','recently_bought']);
    }
}
