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
	public function whoami()
	{
		$session = new Session();
		
		if($session->getLogin()){
			$data = [
				'title' => 'Quienes somos',
				'menu' => true,
				'active' => 'whoami'
			];

			$this->view('shop/whoami', $data);

		} else {
			header('location:' . ROOT);
		}
	}
	
	public function contact()
	{
		$errors = [];
		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
			$name = $_POST['name'] ?? '';
			$email = $_POST['email'] ?? '';
			$message = $_POST['message'] ?? '';
			if ($name == '') {
				array_push($errors, 'El nombre es obligatorio');
			}
			if ($email == '') {
				array_push($errors, 'El correo electrónico es obligatorio');
			}
			if ($message == '') {
				array_push($errors, 'El mensaje es obligatorio');
			}
			if ( ! filter_var($email, FILTER_VALIDATE_EMAIL)) {
				array_push($errors, 'El correo electrónico no es correcto');
			}
			if (count($errors) == 0) {
				if ($this->model->sendEmail($name, $email, $message)) {
					$data = [
						'title'	=> 'Mensaje del usuario',
						'menu'	=> true,
						'subtitle' => 'Gracias por su mensaje',
						'text' => 'En breve recibirá noticias nuestras.',
						'color'	=> 'success',
						'url'	=> 'shop',
						'colorButton' => 'success',
						'textButton'  => 'Regresar'
					];
					$this->view('mensaje', $data);
				} else {
					$data = [
						'title'	=> 'Error en el envío del mensaje',
						'menu'	=> true,
						'subtitle' => 'Error en el envío del mensaje',
						'text' => 'Existió un problema al enviar el correo electrónico. Por favor, pruebe más tarde o comuníquese con nuestro servicio de soporte técnico.',
						'color'	=> 'danger',
						'url'	=> 'shop',
						'colorButton' => 'danger',
						'textButton'  => 'Regresar'
					];
					$this->view('mensaje', $data);
				}
			} else {
				$data = [
					'title'	=> 'Contacta con nosotros',
					'menu'	=> true,
					'active'=> 'contact',
					'errors'=> $errors
				];
				$this->view('shop/contact', $data);
			}
		} else {
			$session = new Session();
			if ($session->getLogin()) {
				$data = [
					'title'	=> 'Contacta con nosotros',
					'menu'	=> true,
					'active'=> 'contact'
				];
				$this->view('shop/contact', $data);
			} else {
				header('location:' . ROOT);
			}
		}
	}

}