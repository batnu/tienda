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
			
			$mostSold = $this->model->getMostSold();
			$news = $this->model->getNews();

			$data = [
				'title'	=> 'Bienvenid@ a nuestra tienda',
				'menu'	=> true,
				'subtitle' => 'Los + de lo +',
				'subtitle2' => 'Los + nuevos',
				'data' => $mostSold,
				'news' => $news
			];
		
			$this->view('shop/index', $data);
		} else {
			header('location:' . ROOT);
		}		
	}

	public function logout()
	{
		$session = new Session();
		$session->logout();
		header('location:' . ROOT);
	}

	public function show($id, $back = '')
	{
		$product = $this->model->getProductById($id);
		$data = [
			'title' => 'Detalle del producto',
			'subtitle' => $product->name,
			'menu' => true,
			'admin' => false,
			'data' => $product,
			'back' => $back
		];	

		$this->view('shop/show',$data);

	}
}