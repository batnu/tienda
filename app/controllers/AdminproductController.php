<?php

/**
 * Controlador de administracion de productos
 */
class AdminproductController extends Controller
{
	private $model;
	public function __construct()
	{
		$this->model = $this->model('AdminProduct');
	}

	public function index()
	{
		$session = new Session();
		if($session->getLogin()){
			$products = $this->model->getProducts();
			$type = $this->model->getConfig('productType');
			$data = [
				'title' => 'Administración de productos',
				'menu' => false,
				'admin' => true,
				'type' => $type,
				'data' => $products
			];
			
			$this->view('admin/products/index',$data);

		}else{
			header('location:'. ROOT .'admin');
		}
	}
	public function create()
	{
		$errors = [];
		$dataForm = [];
		$type = $this->model->getConfig('productType');
		$status = $this->model->getConfig('productStatus');
		$catalogue = $this->model->getCatalogue();

		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
			//Recibimps la informacion del formulario
			//$type = isset($_POST['type']) ? $_POST['type'] : '';
			//Este es equivalente a la de arriba 
			$type = isset($_POST['type']) ?? '';

			//validamos la informacion 
			//Creamos el array con los datos

			if (empty($errors)) {
				//enviamos datos al modelo
				if(empty($errors)){
					//Redirigimos al index de adminproduct
				}
			}
		}

		$data = [
			'title' => 'Administración de productos - Alta',
			'menu' => false,
			'admin' => true,
			'type' => $type,
			'status' => $status,
			'catalogue' => $catalogue,
			'errors' => $errors,
			'data' => $dataForm
		];
		$this->view('admin/products/create',$data);

	}
	public function update($id)
	{

	}
	public function delete($id)
	{

	}
}