<?php
/**
 * Controlador para búsquedas
 */
class SearchController extends Controller
{
	private $model;
	public function __construct()
	{
		$this->model = $this->model('Search');
	}
	public function products()
	{
		$search = $_POST['search'] ?? '';
		if ($search != '') {
			$dataSearch = $this->model->getProducts($search);
			if (count($dataSearch) > 0) {
				$data = [
					'title'	=> 'Resultados de la búsqueda',
					'menu'	=> true,
					'data'	=> $dataSearch
				];
				$this->view('search/index', $data);
			} else {
				$data = [
					'title'	=> 'No hay productos',
					'menu'	=> true,
					'subtitle' => 'La consulta no devolvió resultados',
					'text' => 'No disponemos de ningún producto para la búsqueda ' . $search,
					'color'	=> 'danger',
					'url'	=> 'shop',
					'colorButton' => 'danger',
					'textButton'  => 'Regresar'
				];
				$this->view('mensaje', $data);
			}
			
		} else {
			header('location:' . ROOT);
		}
	}
}