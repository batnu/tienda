<?php

/**
 * Panel de administración de la tienda
 */
class AdminshopController extends Controller
{	
	private $model;
	
	public function __construct()
	{
		$this->model = $this->model('AdminShop');
	}

	public function index() 
	{
		$session = new Session();
		if ($session->getLoginAdmin()) {
			$data = [
				'title' => 'Administración | Inicio',
				'subtitle' => 'Administración de la tienda',
				'admin' => true,
				'menu' => false
			];
		$this->view('admin/shop/index', $data);
		} else {
			header('location:' . ROOT . 'admin');
		}
		
	}
}