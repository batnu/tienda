<?php include_once (VIEWS . 'header.php') ?>
<div class="card" id="container">
	<nav aria-label="breadcrumbs">
		<ol class="breadcrumb">
			<li class="breadcrumb-item">Iniciar sesión</li>
			<li class="breadcrumb-item"><a href="#">Datos de envío</a></li>
			<li class="breadcrumb-item"><a href="#">Forma de pago</a></li>
			<li class="breadcrumb-item"><a href="#">Comprobar datos</a></li>
		</ol>
	</nav>
	<h2><?= $data['subtitle'] ?></h2>
	<form class="text-left">
		<div class="form-group text-left">
			<label for="user">Usuario:</label>
			<input type="email" name="email" class="form-control" required
			placeholder="Introduce tu correo electrónico">
		</div>
		<div class="form-group text-left">
			<label for="password">Contraseña:</label>
			<input type="password" name="password" class="form-control" required placeholder="Introduce tu contraseña">
		</div>
		<div class="form-group">
			<a href="<?= ROOT ?>cart/address" class="btn btn-success">Enviar</a>
		</div>
	</form>
</div>
<?php include_once (VIEWS . 'footer.php') ?>