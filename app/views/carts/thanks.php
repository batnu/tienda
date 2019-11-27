<?php include_once (VIEWS . 'header.php') ?>

<div class="card" id="container">
	<nav aria-label="breadcrumbs">
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="#">Iniciar sesión</a></li>
			<li class="breadcrumb-item"><a href="#">Datos de envío</a></li>
			<li class="breadcrumb-item"><a href="#">Forma de pago</a></li>
			<li class="breadcrumb-item"><a href="#">Comprobar datos</a></li>
			<li class="breadcrumb-item">Gracias</li>
		</ol>
	</nav>
	<h2>Gracias por visitarnos y hacer su compra</h2>
	<h3>¡Que tenga un gran día!</h3>
	<br>
	&nbsp;
	<br>
	<h3>Sus amigos de ShopMVC</h3>
	<br>
	<div class="text-left">
		<a href=" <?= ROOT ?>shop" class="btn btn-success">Regresar a la tienda</a>
	</div>	
</div>

<?php include_once (VIEWS . 'footer.php') ?>
