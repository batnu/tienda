<?php  
/**
 * Controlador Login
 */
class LoginController extends Controller
{
	
	private $model;

	public function __construct() 
	{
		$this->model = $this->model('Login');
	}

	public function index()
	{
		$dataForm = [];
		if (isset($_COOKIE['shoplogin'])) {
			$value = explode('|', $_COOKIE['shoplogin']);
			$dataForm = [
				'user' => $value[0],
				'password' => $value[1],
				'remember' => 'on'
			];
		} 
		$data = [
			'title'	=> 'Login',
			'menu'	=> false,
			'data' => $dataForm
		];
		$this->view('login', $data);
	}

	public function olvido()
	{

		$errors = [];

		if ($_SERVER['REQUEST_METHOD'] == 'POST') {

			$email = $_POST['email'] ?? '';
			if ($email == '') {
				array_push($errors, 'El correo electrónico es requerido');
			}
			if ( ! filter_var($email, FILTER_VALIDATE_EMAIL)) {
				array_push($errors, 'El correo electrónico no es válido');
			}
			if (count($errors) == 0) {
				if ( ! $this->model->existsEmail($email)) {
					array_push($errors, 'El correo electrónico no está registrado');
				} else {
					if ($this->model->sendEmail($email)) {
						$data = [
							'title'	=> 'Cambio de contraseña de acceso',
							'menu'	=> false,
							'subtitle' => 'Cambio de contraseña de acceso a la web',
							'text' => 'Se ha enviado un correo a <b>' . $email . '</b> para que pueda cambiar su contraseña. No olvide revisar su carpeta de SPAM. Cualquier duda que tenga puede comunicarse con nosotros.',
							'color'	=> 'success',
							'url'	=> 'login',
							'colorButton' => 'success',
							'textButton'  => 'Regresar'
						];
						$this->view('mensaje', $data);
					} else {
						$data = [
							'title'	=> 'Error',
							'menu'	=> false,
							'subtitle' => 'Error en el envío del correo electrónico',
							'text' => 'Existió un problema al enviar el correo electrónico. Por favor, pruebe más tarde o comuníquese con nuestro servicio de soporte técnico',
							'color'	=> 'danger',
							'url'	=> 'login',
							'colorButton' => 'danger',
							'textButton'  => 'Regresar'
						];
						$this->view('mensaje', $data);
					}
				}
			}
		}
		$data = [
			'title'	=> 'Recordar contraseña',
			'menu'	=> false,
			'subtitle' => '¿Olvidaste tu contraseña?',
			'errors' => $errors
		];
		$this->view('olvido', $data);
	}

	public function registro()
	{
		$errors = [];
		$dataForm = [];
		
		if ($_SERVER['REQUEST_METHOD'] == 'POST') {

			$first_name = $_POST['first_name'] ?? '';
			$last_name_1 = $_POST['last_name_1'] ?? '';
			$last_name_2 = $_POST['last_name_2'] ?? '';
			$email = $_POST['email'] ?? '';
			$password1 = $_POST['password1'] ?? '';
			$password2 = $_POST['password2'] ?? '';
			$address = $_POST['address'] ?? '';
			$city = $_POST['city'] ?? '';
			$state = $_POST['state'] ?? '';
			$postcode = $_POST['postcode'] ?? '';
			$country = $_POST['country'] ?? '';

			$dataForm = [
					'first_name'	=> $first_name,
					'last_name_1'	=> $last_name_1,
					'last_name_2'	=> $last_name_2,
					'password'		=> $password1,
					'email'			=> $email,
					'address'		=> $address,
					'city'			=> $city,
					'state'			=> $state,
					'postcode'		=> $postcode,
					'country'		=> $country
			];

			if ($first_name == '') {
				$errors['first_name'] = 'El nombre es requerido';
			} 
			if ($last_name_1 == '') {
				$errors['last_name_1'] = 'El primer apellido es requerido';
			}
			if ($email == '') {
				$errors['email'] = 'El correo electrónico es requerido';
			}
			if ($password1 == '') {
				$errors['password1'] = 'La contraseña es requerida';
			}
			if ($password2 == '') {
				$errors['password2'] = 'Debe repetir la contraseña';
			}
			if ($address == '') {
				$errors['address'] = 'La dirección es requerida';
			}
			if ($city == '') {
				$errors['city'] = 'La ciudad es requerida';
			}
			if ($state == '') {
				$errors['state'] = 'La provincia es requerida';
			}
			if ($postcode == '') {
				$errors['postcode'] = 'El código postal es requerido';
			}
			if ($country == '') {
				$errors['country'] = 'El país es requerido';
			}
			if ($password1 != $password2) {
				$errors['password'] = 'Ambas contraseñas deben ser iguales';
			}
			if (($email != '') && (! filter_var($email, FILTER_VALIDATE_EMAIL))) {
				$errors['email'] = 'El correo electronico no es valido';
			}
	
			if (count($errors) == 0) {
				if ($this->model->createUser($dataForm)) {
					$data = [
						'title' => 'Bienvenid@',
						'subtitle' => 'Bienvenido a la tienda virtual',
						'menu' => false,
						'color' => 'success',
						'text' => 'Gracias por registrarse con nosotros',
						'colorButton' => 'success',
						'textButton' => 'Inicio', 
						'url' => 'menu'
					];
					$this->view('mensaje', $data);

				} else {
					$data = [
						'title' => 'Error en el registro',
						'subtitle' => 'Error en el proceso de registro de usuario',
						'menu' => false,
						'color' => 'danger',
						'text' => 'Existe un error en el registro.
						Posiblemente ya existe ese correo electrónico en nuestra base de datos',
						'colorButton' => 'danger',
						'textButton' => 'Regresar', 
						'url' => 'login'
					];
					$this->view('mensaje', $data);
				}
			} 
		}
		$data = [
				'title' => 'Registro',
				'menu' => false,
				'errors' => $errors,
				'data' => $dataForm
		];	

		$this->view('register', $data);
	}

	public function changePassword($id)
	{
		$errors = [];
		
		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
			
			$password1 = isset($_POST['password1']) ? $_POST['password1'] : '';
			$password2 = isset($_POST['password2']) ? $_POST['password2'] : '';
			if ($password1 == '') {
				array_push($errors, 'La contraseña es requerida');
			}
			if ($password2 == '') {
				array_push($errors, 'Debe repetir la contraseña');
			}
			if ($password1 != $password2) {
				array_push($errors, 'Ambas contraseñas deben ser iguales');
			}
			if (count($errors) == 0) {
				if ($this->model->changePassword($id, $password1)) {
					$data = [
						'title'	=> 'Modificar contraseña',
						'menu'	=> false,
						'subtitle' => 'Modificación de la contraseña de acceso',
						'text' => 'La contraseña ha sido cambiada correctamente. Bienvenido de nuevo.',
						'color'	=> 'success',
						'url'	=> 'login',
						'colorButton' => 'success',
						'textButton'  => 'Regresar'
					];
					$this->view('mensaje', $data);
				} else {
					$data = [
						'title'	=> 'Error de contraseña',
						'menu'	=> false,
						'subtitle' => 'Error en la modificación de la contraseña de acceso',
						'text' => 'Existió un error al modificar la contraseña en la base de datos',
						'color'	=> 'danger',
						'url'	=> 'login',
						'colorButton' => 'danger',
						'textButton'  => 'Regresar'
					];
					$this->view('mensaje', $data);
				}
			}
		} 

		$data = [
			'title'	=> 'Cambio de contraseña',
			'menu'	=> false,
			'data'	=> $id,
			'subtitle' => 'Cambio de contraseña de acceso',
			'errors' => $errors
		];
		$this->view('changepassword', $data);
	}
	
	public function verifyUser()
	{
		
		$errors = [];
		$user = isset($_POST['user']) ? $_POST['user'] : '';
		$password = isset($_POST['password']) ? $_POST['password'] : '';
		$remember = isset($_POST['remember']) ? 'on' : 'off';
		if ($user == '') {
			$errors['email'] = 'El correo electrónico es requerido';
		}
		if ($password == '') {
			$errors['password'] = 'La contraseña es requerida';
		}
		$dataForm = [
			'user'	=> $user,
			'password' => $password,
			'remember'	=> $remember
		];
		if (count($errors) == 0) {
			$errors = $this->model->verifyUser($user, $password);
			if (count($errors) == 0) {
				$value = $user . '|' . $password;
				if ($remember == 'on') {
					$date = time() + (60*60*24*7);
				} else {
					$date = time() -1;
				}
				setcookie('shoplogin', $value, $date, ROOT);
				$session = new Session();
				$dataUser = $this->model->getUserByEmail($user);

				$session->login($dataUser);
				header('location:' . ROOT . 'shop');
			} else {
				$data = [
					'title'	=> 'Login',
					'menu'	=> false,
					'errors' => $errors,
					'data'	=> $dataForm
				];
				$this->view('login', $data);
			}
		} else {
			$data = [
				'title'	=> 'Login',
				'menu'	=> false,
				'errors' => $errors,
				'data'	=> $dataForm
			];
			$this->view('login', $data);
		}
	}
}


?>