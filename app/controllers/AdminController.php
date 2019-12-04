<?php  

/**
 * Clase para la administracion
 */
class AdminController extends Controller
{
	private $model;

	public function __construct()
	{
		$this->model = $this->model('Admin');
	}

	public function index() 
	{
		$data = [
			'title' => 'Administración',
			'subtitle' => 'Modulo de administración',
			'menu' => false
		];

		$this->view('admin/index', $data);
	}

	public function verifyUser() 
	{
		$errors = [];
		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
			$email = isset($_POST['user']) ? $_POST['user'] : '';
			$password = isset($_POST['password']) ? $_POST['password'] : '';
			$dataForm = [
				'email'	=> $email,
				'password' => $password
			];
			if (empty($email)) {
				array_push($errors, 'El correo del usuario es obligatorio');
			}
			if ( ! filter_var($email, FILTER_VALIDATE_EMAIL)) {
				array_push($errors, 'El correo electrónico no es válido');
			}
			if (empty($password)) {
				array_push($errors, 'La contraseña es obligatoria');
			}
			if (count($errors) == 0) {
				$errors = $this->model->verifyUser($dataForm);
				if (count($errors) == 0) {
					$session = new Session();

					$session->loginAdmin($dataForm);

					header('location:' . ROOT . 'Adminshop');
				}
			}
		}
		$data = [
			'title'	=> 'Administración',
			'menu'	=> false,
			'admin'	=> true,
			'subtitle' => 'Modulo de administración',
			'errors'=> $errors
		];
		$this->view('admin/index2', $data);
	}
	public function logout()
	{
		$session = new Session();
		$session->logoutAdmin();
		header('location:'.ROOT.'admin');
	}
}


?>