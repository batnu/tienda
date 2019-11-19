<?php
/**
 * Controlador e libros
 */
class BooksController extends Controller
{
	private $model;

	function __construct()
	{
		$this->model = $this->model('Book');
	}	
	public function index()
	{
		$session = new Session();

		if ($session->getLogin()) {
			$books = $this->model->getBook();
			$data = [
				'title' => 'Cursos en linea',
				'menu' => true,
				'data' => $books,
				'active' => 'books'
			];

			$this->view('books/index', $data);
		} else{
			header('location:' . ROOT);
		}
	}
	
}