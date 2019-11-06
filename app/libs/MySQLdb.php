<?php
/**
 * Manejo de la base de datos
 */
class MySQLdb
{
	private $host = 'mysql';
	private $user = 'homestead';
	private $pass = 'secret';
	private $dbname = 'tienda';

	//Metodo singleton(Para que solo haya 1 objeto de dicha clase)

	//Creamos la variable para instanciar
	private static $instance = null;
	//creamos la variable de base de datos
	private $db = null;

	//Constructor privado para no poder ser llamado desde fuera de la clase
	private function __construct()
	{
		$options = [
			PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
			PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING,
		];

		try {
			$this->db = new PDO(
				'mysql:host=' . $this->host . '; dbname=' . $this->dbname, 
				$this->user, 
				$this->pass, 
				$options
			);

		} catch (PDOException $e) {
			exit('La base de datos esta inaccesible');
		}
	}

	public static function getInstance() 
	{
		//Para acceder a un atributo static de la clase se utiliza self::
		if (is_null(self::$instance)){
			self::$instance = new MySQLdb();
		}

		return self::$instance;
	}

	public function getDatabase()
	{
		return $this->db;
	}

}
?>