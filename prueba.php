<?php
public function create()
	{
		$errors = [];
		$dataForm = [];

		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
			$name = $_POST['name'] ?? '';
			$email = $_POST['email'] ?? '';
			$password1 = $_POST['password1'] ?? '';
			$password2 = $_POST['password2'] ?? '';
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
			}
		}
		$data = [
			'title'	=> 'Administración de Usuarios - Alta',
			'menu'	=> false,
			'admin'	=> true,
			'data' => $dataForm,
			'errors' => $errors
		];
			
		$this->view('admin/users/create', $data);
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

	/* mejoras :
	- comprar un producto mas de una vez
	*/