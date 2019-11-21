<?php include_once (VIEWS . 'header.php') ?>
<div class="card" id="container">
	<nav aria-label="breadcrumbs">
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="#">Iniciar sesión</a></li>
			<li class="breadcrumb-item">Datos de envío</li>
			<li class="breadcrumb-item"><a href="#">Forma de pago</a></li>
			<li class="breadcrumb-item"><a href="#">Comprobar datos</a></li>
		</ol>
	</nav>
	<div class="card-header">
		<h1>Datos de envío</h1>
		<p>Por favor, compruebe los datos de envío y cambie lo necesario</p>
	</div>
	<div class="card-body">
		<form action="<?= ROOT ?>cart/paymentmode" method="POST">
			<div class="form-group text-left">
				<label for="first_name">Nombre:</label>
				<input type="text" name="first_name" id="first_name" class="form-control" required value="<?= $data['data']->first_name ?>">
			</div>
			<div class="form-group text-left">
				<label for="last_name_1">Apellido 1:</label>
				<input type="text" name="last_name_1" id="last_name_1" class="form-control" required value="<?= $data['data']->last_name_1 ?>">
			</div>
			<div class="form-group text-left">
				<label for="last_name_2">Apellido 2:</label>
				<input type="text" name="last_name_2" id="last_name_2" class="form-control" value="<?= $data['data']->last_name_2 ?>">
			</div>
			<div class="form-group text-left">
				<label for="email">Correo Electrónico:</label>
				<input type="email" name="email" id="email" class="form-control" required value="<?= $data['data']->email ?>">
			</div>
			<div class="form-group text-left">
				<label for="address">Dirección:</label>
				<input type="text" name="address" id="address" class="form-control" required value="<?= $data['data']->address ?>">
			</div>
			<div class="form-group text-left">
				<label for="city">Ciudad:</label>
				<input type="text" name="city" id="city" class="form-control" required value="<?= $data['data']->city ?>">
			</div>
			<div class="form-group text-left">
				<label for="state">Provincia:</label>
				<input type="text" name="state" id="state" class="form-control" required value="<?= $data['data']->state ?>">
			</div>
			<div class="form-group text-left">
				<label for="postcode">Código Postal:</label>
				<input type="text" name="zipcode" id="zipcode" class="form-control" required value="<?= $data['data']->zipcode ?>">
			</div>
			<div class="form-group text-left">
				<label for="country">País:</label>
				<input type="text" name="country" id="country" class="form-control" required value="<?= $data['data']->country ?>">
			</div>
			<div class="form-group text-left">
				<input type="submit" value="Confirmar Dirección" class="btn btn-success">
			</div>
		</form>
	</div>
</div>
<?php include_once (VIEWS . 'footer.php') ?>