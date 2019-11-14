<?php
/**
 * Modelo curso
 */
class Course
{

	private $db;

	function __construct()
	{
		$this->db = MySQLdb::getInstance()->getDatabase();
	}

	public function getCourses()
	{
		$sql = 'SELECT * FROM products WHERE deleted=0 AND type=1';
		$query = $this->db->prepare($sql);
		$query->execute();
		return $query->fetchAll(PDO::FETCH_OBJ);

	}
}