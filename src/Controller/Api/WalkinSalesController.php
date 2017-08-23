<?php
namespace App\Controller\Api;
use App\Controller\Api\AppController;
use Cake\ORM\TableRegistry;
class WalkinSalesController extends AppController
{
   public function walkinBilling()
    {
		$jain_thela_admin_id=$this->request->data('jain_thela_admin_id');
		$is_login=$this->request->data('is_login'); ///warehouse or driver///
		$driver_warehouse_id=$this->request->data('driver_warehouse_id');
		$transaction_date=date('Y-m-d');
		$items_id=$this->request->data('item_id');//[]//
		$quantity=$this->request->data('quantity');//[]//
		$amount=$this->request->data('amount');//[]//
		$rate=$this->request->data('rate');//[]//
		$total_amount=$this->request->data('total_amount');
		$order_no=$this->request->data('order_no');
		$total_ids=sizeof($items_id);
		
		$order_count=$this->WalkinSales->find()->where(['order_no'=>$order_no])->count();
		if(empty($order_count)){	
			if($is_login=='warehouse')
			{	
	 $last_order_no = $this->WalkinSales->find()
			->order(['get_auto_no'=>'DESC'])->where(['warehouse_id'=>$driver_warehouse_id, 'transaction_date'=>$transaction_date])
			->first();
			
			if(!empty($last_order_no))
			{
			$getno=$last_order_no->get_auto_no+1;	
			}
			else{
				$getno=1;
			}
			
			

	$query = $this->WalkinSales->query();
					$query->insert(['warehouse_id', 'jain_thela_admin_id', 'total_amount', 'transaction_date','order_no','get_auto_no'])
							->values([
							'warehouse_id' => $driver_warehouse_id,
							'jain_thela_admin_id' => $jain_thela_admin_id,
							'total_amount' => $total_amount,
							'transaction_date' => $transaction_date,
							'order_no' => $order_no,
							'get_auto_no' =>$getno
							])
					->execute();
					
					 $walkin_ids = $this->WalkinSales->find()
			->select(['id'])
			->where(['order_no'=>$order_no])
			->first();
			$walkin_id=$walkin_ids->id;
					
		  for($i=0; $i<$total_ids; $i++)
		  {
		       $item_id=$items_id[$i];
               $item_quantity=$quantity[$i];
			   $item_rate=$rate[$i];
               $item_amount=$amount[$i];			   
			$query = $this->WalkinSales->WalkinSaleDetails->query();
					$query->insert(['walkin_sale_id','item_id', 'quantity', 'rate', 'amount'])
							->values([
							'walkin_sale_id'=> $walkin_id,
							'item_id' => $item_id,
							'quantity' => $item_quantity,
							'rate' => $item_rate,
							'amount' => $item_amount
							])
					->execute();
					
					
					$query = $this->WalkinSales->ItemLedgers->query();
					        $query->insert(['jain_thela_admin_id', 'warehouse_id', 'item_id', 'quantity', 'inventory_transfer','rate', 'amount', 'transaction_date','order_id', 'walkin_sales_id', 'status'])
							->values([
							'jain_thela_admin_id' => $jain_thela_admin_id,
							'warehouse_id' => $driver_warehouse_id,
							'item_id' => $item_id,
							'quantity' => $item_quantity,
							'inventory_transfer' => 'no',
							'rate' => $item_rate,
							'amount' => $item_amount,
							'transaction_date'=>$transaction_date,
							'order_id'=>0,
							'walkin_sales_id'=>$walkin_id,
							'status'=>'out'
							])
					        ->execute(); 
					
		  }
	    }
		else if($is_login=='driver')
		{	
	
	 $last_order_no = $this->WalkinSales->find()
			->order(['get_auto_no'=>'DESC'])->where(['driver_id'=>$driver_warehouse_id, 'transaction_date'=>$transaction_date])
			->first();
			if(!empty($last_order_no))
			{
				$getno=$last_order_no->get_auto_no+1;	
			}
			else{
				$getno=1;
			}
					$query = $this->WalkinSales->query();
					$query->insert(['driver_id', 'jain_thela_admin_id', 'total_amount', 'transaction_date','order_no','get_auto_no'])
							->values([
							'driver_id' => $driver_warehouse_id,
							'jain_thela_admin_id' => $jain_thela_admin_id,
							'total_amount' => $total_amount,
							'transaction_date' => $transaction_date,
							'order_no' => $order_no,
							'get_auto_no' =>$getno
							])
					->execute();
					
					 $walkin_ids = $this->WalkinSales->find()
			->select(['id'])
			->where(['order_no'=>$order_no])
			->first();
			$walkin_id=$walkin_ids->id;
			
					
		  for($i=0; $i<$total_ids; $i++)
		  {
		       $item_id=$items_id[$i];
               $item_quantity=$quantity[$i];
			   $item_rate=$rate[$i];
               $item_amount=$amount[$i];			   
			$query = $this->WalkinSales->WalkinSaleDetails->query();
					$query->insert(['walkin_sale_id','item_id', 'quantity', 'rate', 'amount'])
							->values([
							'walkin_sale_id'=> $walkin_id,
							'item_id' => $item_id,
							'quantity' => $item_quantity,
							'rate' => $item_rate,
							'amount' => $item_amount
							])
					->execute();
					
					
					
					
					$query = $this->WalkinSales->ItemLedgers->query();
					        $query->insert(['jain_thela_admin_id', 'driver_id', 'item_id', 'quantity', 'inventory_transfer','rate', 'amount', 'transaction_date','order_id', 'walkin_sales_id', 'status'])
							->values([
							'jain_thela_admin_id' => $jain_thela_admin_id,
							'driver_id' => $driver_warehouse_id,
							'item_id' => $item_id,
							'quantity' => $item_quantity,
							'inventory_transfer' => 'no',
							'rate' => $item_rate,
							'amount' => $item_amount,
							'transaction_date'=>$transaction_date,
							'order_id'=>0,
							'walkin_sales_id'=>$walkin_id,
							'status'=>'out'
							])
					        ->execute(); 
					
		  }
	    }
	}
		$status=true;
		$error="Thank You, bill submitted successfully";
        $this->set(compact('status', 'error'));
        $this->set('_serialize', ['status', 'error']);
    }
	
	
	public function walkinOrderNo()
    {
		$is_login=$this->request->query('is_login'); ///warehouse or driver///
		$driver_warehouse_id=$this->request->query('driver_warehouse_id');
		$curent_date=date('Y-m-d');
	
	if($is_login=='warehouse')
	{
	 $last_order_no = $this->WalkinSales->find()
			->select(['get_auto_no'])
			->order(['get_auto_no'=>'DESC'])->where(['warehouse_id'=>$driver_warehouse_id, 'transaction_date'=>$curent_date])
			->first();
			

			if(!empty($last_order_no)){
			$get_auto_no = h(str_pad(number_format($last_order_no->get_auto_no+1),6, '0', STR_PAD_LEFT));
			}else{
		    $get_auto_no=h(str_pad(number_format(1),6, '0', STR_PAD_LEFT));
			}
			$get_date=str_replace('-','',$curent_date);
			$order_no=h('WS'.$driver_warehouse_id.$get_date.$get_auto_no);//orderno///
	}
	else if($is_login=='driver')
	{
	 $last_order_no = $this->WalkinSales->find()
			->select(['get_auto_no'])
			->order(['get_auto_no'=>'DESC'])->where(['driver_id'=>$driver_warehouse_id, 'transaction_date'=>$curent_date])
			->first();

			if(!empty($last_order_no)){
			$get_auto_no = h(str_pad(number_format($last_order_no->get_auto_no+1),6, '0', STR_PAD_LEFT));
			}else{
		    $get_auto_no=h(str_pad(number_format(1),6, '0', STR_PAD_LEFT));
			}
			$get_date=str_replace('-','',$curent_date);
			$order_no=h('D'.$driver_warehouse_id.$get_date.$get_auto_no);//orderno///
	}
	$status=true;
		$error="";
        $this->set(compact('status', 'error', 'order_no'));
        $this->set('_serialize', ['status', 'error', 'order_no']);
	}
}
