<?php  

/**
 * Clase para las sesiones
 */
class Session
{
	private $login = false;
	private $loginAdmin = false;
	private $user;
	private $admin;
	private $cartTotal;

	function __construct()
	{
		session_start();
		if(isset($_SESSION['user'])) {
			$this->user = $_SESSION['user'];
			$this->login = true;
			if (isset($this->user->id)) {
				$_SESSION['cartTotal'] = $this->cartTotal();
				$this->cartTotal = $_SESSION['cartTotal'];
			}
		}elseif (isset($_SESSION['admin'])) {
			$this->admin = $_SESSION['admin'];
			$this->loginAdmin = true;
		} else {
			unset($this->user);
			$this->login = false;
			unset($this->admin);
			$this->loginAdmin = false;
		}
	}

	public function loginAdmin($admin)
	{
		$this->admin = $admin;
		$_SESSION['admin'] = true;
		$this->loginAdmin = true;
	}

	public function login($user) 
	{
		$this->user = $user;
		$_SESSION['user'] = $user;
		$this->login = true;
	}

	public function logout()
	{
		unset($_SESSION['user']);
		unset($this->user);
		session_destroy();
		$this->login = false;
	}
	public function logoutAdmin()
	{
		unset($_SESSION['admin']);
		unset($this->admin);
		session_destroy();
		$this->loginAdmin = false;
	}

	public function getLoginAdmin()
	{
		return $this->loginAdmin;
	}

	public function getLogin()
	{
		return $this->login;
	}

	public function getUser()
	{
		return $this->user;
	}
	public function getAdmin()
	{
		return $this->admin;
	}
	public function getUserId()
	{
		return $this->user->id;
	}
	public function getAdminId()
	{
		return $this->admin->id;
	}
	private function cartTotal()
	{
		$db = MySQLdb::getInstance()->getDatabase();
		$sql = 'SELECT sum(c.quantity*p.price) - sum(c.discount) + sum(c.send) as total FROM carts c ,products p WHERE c.product_id = p.id AND c.user_id =:user AND state=0';
		$query = $db->prepare($sql);
		$query->execute([':user' => $this->getUserId()]);
		$data = $query->fetch(PDO::FETCH_OBJ);
		//$db->close();
		return ($data->total ?? 0);
	}
}


?>