<?php

/**
 * 
 */
class AdminShop
{
	private $db;

	function __construct()
	{
		$this->db = MySQLdb::getInstance()->getDatabase();
	}
}