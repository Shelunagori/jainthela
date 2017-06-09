<?php
namespace App\Controller;
class HomesController extends AppController
{
	public function index()
    {
       $this->viewBuilder()->layout('index_layout');
	   
		
    }
	
}

