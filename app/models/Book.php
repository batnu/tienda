<?php
/**
 * Modelo Libro
 */
class Book
{

	private $db;

	function __construct()
	{
		$this->db = MySQLdb::getInstance()->getDatabase();
	}

	public function getBook()
	{
		$sql = 'SELECT * FROM products WHERE deleted=0 AND type=2';
		$query = $this->db->prepare($sql);
		$query->execute();
		return $query->fetchAll(PDO::FETCH_OBJ);

	}
}