<?php include_once (VIEWS . 'header.php') ?>
<div class="card" id="container">
	<nav aria-label="breadcrumbs">
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="#">Iniciar sesión</a></li>
			<li class="breadcrumb-item"><a href="#">Datos de envío</a></li>
			<li class="breadcrumb-item">Forma de pago</li>
			<li class="breadcrumb-item"><a href="#">Comprobar datos</a></li>
		</ol>
	</nav>
	<div class="card-header">
		<h2><?= $data['subtitle'] ?></h2>
		<p>Por favor, elige la forma de pago</p>
	</div>
	<div class="card-body">
		<form action="<?= ROOT ?>cart/verify" method="POST">
			<div class="fogroup text-left">
				<div class="radio">
					<label><input type="radio" name="payment" value="cc1">Tarjeta de crédito MasterCard</label>
				</div>
				<div class="radio">
					<label><input type="radio" name="payment" value="cc2">Tarjeta de crédito Visa</label>
				</div>
				<div class="radio">
					<label><input type="radio" name="payment" value="dc">Tarjeta de débito</label>
				</div>
				<div class="radio">
					<label><input type="radio" name="payment" value="cash">Efectivo</label>
				</div>
				<div class="radio">
					<label><input type="radio" name="payment" value="paypal">PayPal</label>
				</div>
				<div class="radio">
					<label><input type="radio" name="payment" value="bitcoins">Bitcoins</label>
				</div>
				<div class="form-group text-left">
					<input type="submit" value="Enviar datos" class="btn btn-success">
				</div>
			</div>
		</form>
	</div>
</div>
<?php include_once (VIEWS . 'footer.php') ?>