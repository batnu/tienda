<?php
/**
 * Controlador de administración de Productos
 */
class AdminProductController extends Controller
{
	private $model;
	public function __construct()
	{
		$this->model = $this->model('AdminProduct');
	}
	public function index()
	{
		$session = new Session();
		if ($session->getLoginAdmin()) {
			$products = $this->model->getProducts();
			$type = $this->model->getConfig('productType');
			$data = [
				'title'	=> 'Administración de Productos',
				'menu'	=> false,
				'admin'	=> true,
				'type'	=> $type,
				'data'	=> $products
			];
			$this->view('admin/products/index', $data);
		} else {
			header('location:' . ROOT . 'admin');
		}
	}
	public function create()
	{
		$errors = [];
		$dataForm = [];
		$typeConfig = $this->model->getConfig('productType');
		$statusConfig = $this->model->getConfig('productStatus');
		$catalogue = $this->model->getCatalogue();
		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
			//Recibimos la información del formulario
			$type = $_POST['type'] ?? '';
			$name = Validate::text($_POST['name'] ?? '');
			$description = Validate::text($_POST['description'] ?? '');
			$price = Validate::number($_POST['price'] ?? '');
			$discount = Validate::number($_POST['discount'] ?? '');
			$send = Validate::number($_POST['send'] ?? '');
			$image = Validate::file($_FILES['image']['name']);
			$published = $_POST['published'] ?? '';
			$relation1 = $_POST['relation1'] ?? 0;
			$relation2 = $_POST['relation2'] ?? 0;
			$relation3 = $_POST['relation3'] ?? 0;
			$mostSold = isset($_POST['mostSold']) ? '1' : '0';
			$new = isset($_POST['new']) ? '1' : '0';
			$status = $_POST['status'] ?? '';
			//books
			$author = Validate::text($_POST['author'] ?? '');
			$publisher = Validate::text($_POST['publisher'] ?? '');
			$pages = Validate::number($_POST['pages'] ?? '');
			//Courses
			$people = Validate::text($_POST['people'] ?? '');
			$objetives = Validate::text($_POST['objetives'] ?? '');
			$necesites = Validate::text($_POST['necesites'] ?? '');
			//Validamos la información
			if (empty($name)) {
				array_push($errors, 'El nombre del producto es requerido');
			}
			if (empty($description)) {
				array_push($errors, 'La descripción del producto es requerida');
			}
			if ( ! is_numeric($price)) {
				array_push($errors, 'El precio del producto debe de ser un número');
			}
			if ( ! is_numeric($discount)) {
				array_push($errors, 'El descuento del producto debe de ser un número');
			}
			if (! is_numeric($send)) {
				array_push($errors, 'Los gastos de envío del producto deben de ser numéricos');
			}
			if (is_numeric($price) && is_numeric($discount) && $price < $discount) {
				array_push($errors, 'El descuento no puede ser mayor que el precio');
			}
			if ( ! Validate::date($published)) {
				array_push($errors, 'La fecha o su formato no es correcto');
			} elseif (Validate::dateDif($published)) {
				array_push($errors, 'La fecha de publicación no puede ser posterior a hoy');
			}
			if ($type == 1) {
				if (empty($people)) {
					array_push($errors, 'El público objetivo del curso es obligatorio');
				}
				if (empty($objetives)) {
					array_push($errors, 'Los objetivos del curso son necesarios');
				}
				if (empty($necesites)) {
					array_push($errors, 'Los requisitos del curso son necesarios');
				}
			} elseif ($type == 2) {
				if (empty($author)) {
					array_push($errors, 'El autor del libro es necesario');
				}
				if (empty($publisher)) {
					array_push($errors, 'La editorial del libro es necesaria');
				}
				if ( ! is_numeric($pages)) {
					$pages = 0;
					array_push($errors, 'La cantidad de páginas de un libro debe de ser un número');
				}
			} else {
				array_push($errors, 'Debes seleccionar un tipo válido');
			}
			if ($image) {
				if (Validate::imageFile($_FILES['image']['tmp_name'])) {
					//Comenzamos a tratar la imagen una vez validada
					$image = strtolower($image);
					if (is_uploaded_file($_FILES['image']['tmp_name'])) {
						move_uploaded_file($_FILES['image']['tmp_name'], 'img/' . $image);
						Validate::resizeImage($image, 240);
					} else {
						array_push($errors, 'Error al subir el archivo de imagen');
					}
				} else {
					array_push($errors, 'El formato de imagen no es aceptado');
				}
			} else {
				array_push($errors, 'No he recibido la imagen');
			}
			
			//Creamos el array con los datos
			$dataForm = [
				'type'		=> $type,
				'name'		=> $name,
				'description'=> $description,
				'author'	=> $author,
				'publisher'	=> $publisher,
				'people'	=> $people,
				'objetives'	=> $objetives,
				'necesites'	=> $necesites,
				'price'		=> $price,
				'discount'	=> $discount,
				'send'		=> $send,
				'pages'		=> $pages,
				'published'	=> $published,
				'image'		=> $image,
				'mostSold'	=> $mostSold,
				'new'		=> $new,
				'relation1' => $relation1,
				'relation2' => $relation2,
				'relation3' => $relation3,
				'status'	=> $status
			];
			if (empty($errors)) {
				if ($this->model->createProduct($dataForm)) {
					header('location:' . ROOT . 'adminproduct');
				}
				array_push($errors, 'Se ha producido algún problema durante la inserción del registro en la BD');
			}
		}
		
		$data = [
			'title'	=> 'Administración de Productos - Alta',
			'menu'	=> false,
			'admin'	=> true,
			'type'	=> $typeConfig,
			'status'=> $statusConfig,
			'catalogue' => $catalogue,
			'errors'=> $errors,
			'data'	=> $dataForm
		];
		$this->view('admin/products/create', $data);
	}
	public function update($id)
	{
		$errors = [];
		$typeConfig = $this->model->getConfig('productType');
		$statusConfig = $this->model->getConfig('productStatus');
		$catalogue = $this->model->getCatalogue();
		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
			//Recibimos la información del formulario
			$type = $_POST['type'] ?? '';
			$name = Validate::text($_POST['name'] ?? '');
			$description = Validate::text($_POST['description'] ?? '');
			$price = Validate::number($_POST['price'] ?? '');
			$discount = Validate::number($_POST['discount'] ?? '');
			$send = Validate::number($_POST['send'] ?? '');
			$image = Validate::file($_FILES['image']['name']);
			$published = $_POST['published'] ?? '';
			$relation1 = $_POST['relation1'] ?? 0;
			$relation2 = $_POST['relation2'] ?? 0;
			$relation3 = $_POST['relation3'] ?? 0;
			$mostSold = isset($_POST['mostSold']) ? '1' : '0';
			$new = isset($_POST['new']) ? '1' : '0';
			$status = $_POST['status'] ?? '';
			//books
			$author = Validate::text($_POST['author'] ?? '');
			$publisher = Validate::text($_POST['publisher'] ?? '');
			$pages = Validate::number($_POST['pages'] ?? '');
			//Courses
			$people = Validate::text($_POST['people'] ?? '');
			$objetives = Validate::text($_POST['objetives'] ?? '');
			$necesites = Validate::text($_POST['necesites'] ?? '');
			//Validamos la información
			if (empty($name)) {
				array_push($errors, 'El nombre del producto es requerido');
			}
			if (empty($description)) {
				array_push($errors, 'La descripción del producto es requerida');
			}
			if ( ! is_numeric($price)) {
				array_push($errors, 'El precio del producto debe de ser un número');
			}
			if ( ! is_numeric($discount)) {
				array_push($errors, 'El descuento del producto debe de ser un número');
			}
			if (! is_numeric($send)) {
				array_push($errors, 'Los gastos de envío del producto deben de ser numéricos');
			}
			if (is_numeric($price) && is_numeric($discount) && $price < $discount) {
				array_push($errors, 'El descuento no puede ser mayor que el precio');
			}
			if ( ! Validate::date($published)) {
				array_push($errors, 'La fecha o su formato no es correcto');
			} elseif (Validate::dateDif($published)) {
				array_push($errors, 'La fecha de publicación no puede ser posterior a hoy');
			}
			if ($type == 1) {
				if (empty($people)) {
					array_push($errors, 'El público objetivo del curso es obligatorio');
				}
				if (empty($objetives)) {
					array_push($errors, 'Los objetivos del curso son necesarios');
				}
				if (empty($necesites)) {
					array_push($errors, 'Los requisitos del curso son necesarios');
				}
			} elseif ($type == 2) {
				if (empty($author)) {
					array_push($errors, 'El autor del libro es necesario');
				}
				if (empty($publisher)) {
					array_push($errors, 'La editorial del libro es necesaria');
				}
				if ( ! is_numeric($pages)) {
					$pages = 0;
					array_push($errors, 'La cantidad de páginas de un libro debe de ser un número');
				}
			} else {
				array_push($errors, 'Debes seleccionar un tipo válido');
			}
			if ($image) {
				if (Validate::imageFile($_FILES['image']['tmp_name'])) {
					//Comenzamos a tratar la imagen una vez validada
					$image = strtolower($image);
					if (is_uploaded_file($_FILES['image']['tmp_name'])) {
						move_uploaded_file($_FILES['image']['tmp_name'], 'img/' . $image);
						Validate::resizeImage($image, 240);
					} else {
						array_push($errors, 'Error al subir el archivo de imagen');
					}
				} else {
					array_push($errors, 'El formato de imagen no es aceptado');
				}
			}
			
			//Creamos el array con los datos
			$dataForm = [
				'id' 		=> $id,
				'type'		=> $type,
				'name'		=> $name,
				'description'=> $description,
				'author'	=> $author,
				'publisher'	=> $publisher,
				'people'	=> $people,
				'objetives'	=> $objetives,
				'necesites'	=> $necesites,
				'price'		=> $price,
				'discount'	=> $discount,
				'send'		=> $send,
				'pages'		=> $pages,
				'published'	=> $published,
				'image'		=> $image,
				'mostSold'	=> $mostSold,
				'new'		=> $new,
				'relation1' => $relation1,
				'relation2' => $relation2,
				'relation3' => $relation3,
				'status'	=> $status
			];
			if (empty($errors)) {
				if ($this->model->updateProduct($dataForm)) {
					header('location:' . ROOT . 'adminproduct');
				}
				array_push($errors, 'Se ha producido algún problema durante la actualización en la BD');
			}
		}
		
		$product = $this->model->getProductById($id);

		$data = [
			'title'	=> 'Administración de Productos - Modificación',
			'menu'	=> false,
			'admin'	=> true,
			'type'	=> $typeConfig,
			'status'=> $statusConfig,
			'catalogue' => $catalogue,
			'errors'=> $errors,
			'product'	=> $product
		];
		$this->view('admin/products/update', $data);
	}
	public function delete($id)
	{
		$errors = [];
		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
			$errors = $this->model->delete($id);
			if (empty($errors)) {
				header('location:' . ROOT . 'adminproduct');
			}
		}
		$product = $this->model->getProductById($id);
		$typeConfig = $this->model->getConfig('productType');
		$data = [
			'title'	=> 'Administración de usuarios | Eliminación',
			'menu'	=> false,
			'admin'	=> true,
			'data'	=> $product,
			'type'=> $typeConfig,
			'errors'=> $errors
		];
		$this->view('admin/products/delete', $data);
	}
}