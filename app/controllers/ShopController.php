<?php
/**
 * Controlador Shop para la tienda
 */
class ShopController extends Controller
{
	private $model;
	
	function __construct()
	{
		$this->model = $this->model('Shop');
	}
	public function index()
	{
		$session = new Session();

		if ($session->getLogin()) {
			$data = [
				'title'	=> 'Bienvenid@ a nuestra tienda',
				'menu'	=> false
			];
		
			$this->view('shop/index', $data);
		} else {
			header('location:' . ROOT);
		}

		
	}
}