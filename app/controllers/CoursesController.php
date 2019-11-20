<?php
/**
 * Controlador para los cursos
 */
class CoursesController extends Controller
{
	private $model;

	public function __construct()
	{
		$this->model = $this->model('Course');
	}

	public function index()
	{
		$session = new Session();

		if ($session->getLogin()) {
			$courses = $this->model->getCourses();
			$data = [
				'title' => 'Cursos en linea',
				'menu' => true,
				'data' => $courses,
				'active' => 'courses'
			];

			$this->view('courses/index', $data);
		} else{
			header('location:' . ROOT);
		}
	}
}