<?php
/**
 * Controlador de los carritos
 */
class CartController extends Controller
{
	private $model;

	public function __construct()
	{
		$this->model = $this->model('Cart');
	}
	
	public function index($errors = [])
    {
        $session = new Session();
        if ($session->getLogin()) {
            $user_id = $session->getUserId();
            $cart = $this->model->getCart($user_id);
            $subTotal = $this->calcSub($cart);
            $discount = $this->calcDisc($cart);
            $send = $this->calcSend($cart);
            $total = $subTotal-$discount+$send;

            $data = [
                'title'    => 'Carrito',
                'menu'    => true,
                'user_id' => $user_id,
                'data'    => $cart,
                'errors' => $errors,
                'subtotal' => $subTotal,
                'discount' => $discount,
                'send' => $send,
                'total' => $total
            ];
            $this->view('carts/index', $data);
        } else {
            header('location:' . ROOT);
        }
    }

    private function calcSub($data)
    {
        $result=0;
        foreach ($data as $obj) {
            $result+=$obj->price * $obj->quantity;
        }
        return $result;
    }

    private function calcDisc($data)
    {
        $result=0;
        foreach ($data as $obj) {
            $result+=$obj->discount;
        }
        return $result;
    }

    private function calcSend($data)
    {
        $result=0;
        foreach ($data as $obj) {
            $result+=$obj->send;
        }
        return $result;
    }

	public function addProduct($product_id, $user_id)
	{
		$errors =[];

		if( ! $this->model->verifyProduct($product_id, $user_id)){
			if( ! $this->model->addProduct($product_id, $user_id)){
				array_push($errors, 'Error al introducir el producto al carrito');
			}
		}
		$this->index($errors);
	}

	public function update()
	{
		if(isset($_POST['rows']) && isset($_POST['user_id'])){
			$errors = [];
			$rows = $_POST['rows'];
			$user_id = $_POST['user_id'];

			for ($i=0; $i < $rows ; $i++) { 
				$product_id = $_POST['i'.$i];
				$quantity = $_POST['c'.$i];
				if( ! $this->model->update($user_id, $product_id, $quantity)){
					array_push($errors, 'Error al actualizar el producto');
				}
			}
			$this->index($errors);
		}
	}

	public function delete($product, $user)
	{
		$errors = [];

		if( ! $this->model->delete($product, $user)){
			array_push($errors, 'Error al borrar el producto del carrito');
		}
		$this->index($errors);
	}

	public function checkout()
	{
		$session = new Session();

		if($session->getLogin()){
			$user = $session->getUser();
			$data = [
				'title' => 'Carrito | Datos de envío',
				'subtitle'  => 'Carrito - Verificar datos de envío',
				'menu' => true,
				'data' => $user
			];
			$this->view('carts/address',$data);
		} else {
			$data = [
				'title' =>  'Carrito | checkout',
				'subtitle' => 'checkout - Iniciar sesion',
				'menu' => false
			];
		}
	}
	public function paymentmode()
	{
		$data = [
			'title' => 'Carrito | Forma de pago',
			'subtitle'  => 'Carrito | Elige la forma de pago',
			'menu' => true
		];
		$this->view('carts/paymentmode',$data);
	}

	

	public function verify()
	{
		$session = new Session();
		$user = $session->getUser();
		$cart = $this->model->getCart($user->id);
		$payment = $_POST['payment'] ?? '';

		$data = [
			'title' => 'Carrito | Verificar datos',
			'payment' => $payment,
			'user' => $user,
			'data' => $cart,
			'menu' => true
		];
		$this->view('carts/verify',$data);
	}

	public function thanks()
	{
		$session = new Session();
		$user = $session->getUser();

		if ($this->model->closeCart($user->id, 1)) {
			$data = [
				'title' => 'Carrito | Gracias por su compra',
				'user' => $user,
				'menu' => true
			];
			$this->view('carts/thanks',$data);
		} else {
			$data = [
				'title'	=> 'Error en la actualización de los productos del carrito',
				'menu'	=> true,
				'subtitle' => 'Error en la actualización de los productos del carrito',
				'text' => 'Hubo un problema al actualizar el carrito por favor intentelo más tarde',
				'color'	=> 'danger',
				'url'	=> 'shop',
				'colorButton' => 'danger',
				'textButton'  => 'Regresar'
			];
		}
	}
	public function sales()
	{
		$sales = $this->model->sales();
		$data = [
			'title' => 'Ventas',
			'menu' => false,
			'admin' => true,
			'data' => $sales
		];
		$this->view('admin/carts/index',$data);
	}

	public function show($date, $id)
	{
		$cart = $this->model->show($date, $id);

		$data = [
			'title'  => 'Detalle de la venta',
			'menu' => false,
			'admin' => true,
			'date'  => $date,
			'data' => $cart
		];
		$this->view('admin/carts/show',$data);
	}

	public function chartDailySales()
	{
		$sales = $this->model->dailySales();

		$data = [
			'title'  => 'Ventas diarias',
			'menu' => false,
			'admin' => true,
			'data' => $sales
		];
		$this->view('admin/carts/dailysales',$data);
	}
}