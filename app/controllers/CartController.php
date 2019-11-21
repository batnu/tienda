<?php
/**
 * Controlador de los carritos
 */
class CartController extends Controller
{
	private $model;

	public function __construct()
	{
		$this->model = $this->model('Cart');
	}
	
	public function index()
	{
		$session = new Session();
		if($session->getLogin()){
			$user_id = $session->getUserId();
			$cart = $this->model->getCart($user_id);

			$data = [
				'title' =>  'Carrito',
				'menu' => true,
				'user_id' => $user_id,
				'data' => $cart
			];
			$this->view('carts/index', $data);
		} else {
			header('location:'. ROOT);
		}
	}

	public function addProduct($product_id, $user_id)
	{
		$errors =[];

		if( ! $this->model->verifyProduct($product_id, $user_id)){
			if( ! $this->model->addProduct($product_id, $user_id)){
				array_push($errors, 'Error al introducir el producto al carrito');
			}
		}
		$this->index();
	}
}