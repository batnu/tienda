<?php

/**
 * Modelo de carrito
 */
class Cart
{
	private $db;

	public function __construct()
	{
		$this->db = MySQLdb::getInstance()->getDatabase();

	}
	public function verifyProduct($product_id, $user_id)
	{
		$sql = 'SELECT * FROM carts WHERE product_id=:product_id AND user_id=:user_id';
		$query = $this->db->prepare($sql);
		$params = [
			':product_id' => $product_id,
			':user_id' => $user_id
		];
		$query->execute($params);
		return $query->rowCount();
	}

	public function addProduct($product_id, $user_id)
	{
		$sql = 'SELECT * FROM products WHERE id=:id';
		$query =$this->db->prepare($sql);
		$query->execute([':id' => $product_id]);
		$product = $query->fetch(PDO::FETCH_OBJ);

		$sql2 = 'INSERT INTO carts(state, user_id, product_id, quantity, discount, send, date) VALUES(:state, :user_id, :product_id, :quantity, :discount, :send, :date)';
		$query2 = $this->db->prepare($sql2);
		$params = [
			':state' => 0 ,
			':user_id' => $user_id,
			':product_id' => $product_id,
			':quantity' => 1,
			':discount' => $product->discount,
			':send' => $product->send,
			':date' => date('Y-m-d H:i:s')
		];
		$query2->execute($params);
		return $query2->rowCount();
	}

	public function getCart($user_id)
	{
		$sql = 'SELECT c.user_id as user, c.product_id as product, c.quantity as quantity, c.send as send, c.discount as discount, p.price as price, p.image as image, p.name as name, p.description as description FROM carts as c, products as p WHERE c.user_id =:user_id AND state = 0 AND c.product_id = p.id';
		$query = $this->db->prepare($sql);
		$query->execute([':user_id' => $user_id]);
		return $query->fetchAll(PDO::FETCH_OBJ);
	}
}