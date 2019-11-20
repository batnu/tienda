<?php
/**
 * Administración de usuarios
 */
class AdminUserController extends Controller
{
	private $model;
	
	public function __construct()
	{
		$this->model = $this->model('AdminUser');
	}
	public function index()
	{
		$session = new Session();
		if ($session->getLogin()) {
			$users = $this->model->getUsers();
			$data = [
				'title'	=> 'Administración de Usuarios',
				'menu'	=> false,
				'admin'	=> true,
				'data'	=> $users
			];
			$this->view('admin/users/index', $data);
		} else {
			header('location:' . ROOT . 'admin');
		}
	}
	public function create()
	{
		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
			$errors = [];
			$name = isset($_POST['name']) ? $_POST['name'] : '';
			$email = isset($_POST['email']) ? $_POST['email'] : '';
			$password1 = isset($_POST['password1']) ? $_POST['password1'] : '';
			$password2 = isset($_POST['password2']) ? $_POST['password2'] : '';
			$dataForm = [
				'name' => $name,
				'email' => $email,
				'password' => $password1
			];
			if (empty($name)) {
				array_push($errors, 'En nombre del usuario es obligatorio');
			}
			if (empty($email)) {
				array_push($errors, 'El correo del usuario es obligatorio');
			}
			if ( ! filter_var($email, FILTER_VALIDATE_EMAIL)) {
				array_push($errors, 'El correo electrónico no es válido');
			}
			if (empty($password1)) {
				array_push($errors, 'La contraseña es obligatoria');
			}
			if ($password1 != $password2) {
				array_push($errors, 'Las contraseñas deben ser iguales');
			}
			if (count($errors) == 0) {
				
				if ($this->model->createAdminUser($dataForm)) {
					header('location:' . ROOT . 'adminuser');
				} else {
					$data = [
						'title'	=> 'Error en la creación del usuario administrador',
						'menu'	=> false,
						'subtitle' => 'Error al crear el administrador',
						'text' => 'Existió un error al crear un nuevo administrador',
						'color'	=> 'danger',
						'url'	=> 'adminuser',
						'colorButton' => 'danger',
						'textButton'  => 'Volver'
					];
					$this->view('mensaje', $data);
				}
			} else {
				$data = [
					'title'	=> 'Administración de Usuarios - Alta',
					'menu'	=> false,
					'admin'	=> true,
					'data'	=> $dataForm,
					'errors'=> $errors
				];
				
				$this->view('admin/users/create', $data);
			}
		} else {
			$data = [
				'title'	=> 'Administración de Usuarios - Alta',
				'menu'	=> false,
				'admin'	=> true
			];
			
			$this->view('admin/users/create', $data);
		}
	}
	public function update($id)
	{
		$errors = [];
		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
			$name = isset($_POST['name']) ? $_POST['name'] : '';
			$email = isset($_POST['email']) ? $_POST['email'] : '';
			$password1 = isset($_POST['password1']) ? $_POST['password1'] : '';
			$password2 = isset($_POST['password2']) ? $_POST['password2'] : '';
			$status = isset($_POST['status']) ? $_POST['status'] : '';
			if (empty($name)) {
				array_push($errors, 'El nombre del administrador es obligatorio');
			}
			if (empty($email)) {
				array_push($errors, 'El correo electrónico del administrador es obligatorio');
			}
			if ($status == '') {
				array_push($errors, 'Debe seleccionar un estado para el usuario');
			}
			if ( ! empty($password1) || ! empty($password2)) {
				if ($password1 != $password2) {
					array_push($errors, 'Las contraseñas no coinciden');
				}
			}
			if (count($errors) == 0) {
				$dataForm = [
					'id'	=> $id,
					'name'	=> $name,
					'email'	=> $email,
					'password' => $password1,
					'status'=> $status
				];
				$errors = $this->model->setUser($dataForm);
				if (empty($errors)) {
					header('location:' . ROOT . 'adminuser');
				}
			}
		}
		$user = $this->model->getUserById($id);
		$status = $this->model->getConfig('adminStatus');
		$data = [
			'title'	=> 'Administración de usuarios | Modificar',
			'menu'	=> false,
			'admin'	=> true,
			'data'	=> $user,
			'status'=> $status,
			'errors'=> $errors
		];
		$this->view('admin/users/update', $data);
	}
	public function delete($id)
	{
		$errors = [];
		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
			$errors = $this->model->delete($id);
			if (empty($errors)) {
				header('location:' . ROOT . 'adminuser');
			}
		}
		$user = $this->model->getUserById($id);
		$status = $this->model->getConfig('adminStatus');
		$data = [
			'title'	=> 'Administración de usuarios | Eliminación',
			'menu'	=> false,
			'admin'	=> true,
			'data'	=> $user,
			'status'=> $status,
			'errors'=> $errors
		];
		$this->view('admin/users/delete', $data);
	}
}