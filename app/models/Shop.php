<?php
/**
 *  Clase Shop
 */
class Shop
{
	private $db;
	
	function __construct()
	{
		$this->db = MySQLdb::getInstance()->getDatabase();
	}
}