<?php include_once 'header.php' ?>
<div class="card p-4 bg-light">
	<div class="card-header">
		<h1 class="text-center">Registro</h1>
	</div>
	<div class="card-body">
		<form action="<?= ROOT ?>login/registro" method="POST">
			<div class="form-group text-left">
				<label for="first_name">Nombre:</label>
				<input type="text" name="first_name" id="first_name" class="form-control"  placeholder="Escriba su nombre" value="<?= isset($data['data']['first_name']) ? $data['data']['first_name'] : '' ?>">
				<?php if (isset($data['errors']['first_name'])): ?>
				<p class="alert alert-danger mt-2"> <?= $data['errors']['first_name'] ?></p>
				<?php endif ?>
			</div>
			<div class="form-group text-left">
				<label for="last_name_1">Apellido 1:</label>
				<input type="text" name="last_name_1" id="last_name_1" class="form-control"  placeholder="Escriba su primer apellido" value="<?= isset($data['data']['last_name_1']) ? $data['data']['last_name_1'] : '' ?>">
				<?php if (isset($data['errors']['last_name_1'])): ?>
				<p class="alert alert-danger mt-2"> <?= $data['errors']['last_name_1'] ?></p>
				<?php endif ?>
			</div>
			<div class="form-group text-left">
				<label for="last_name_2">Apellido 2:</label>
				<input type="text" name="last_name_2" id="last_name_2" class="form-control" placeholder="Escriba su segundo apellido" value="<?= isset($data['data']['last_name_2']) ? $data['data']['last_name_2'] : '' ?>">
			</div>
			<div class="form-group text-left">
				<label for="email">Correo Electrónico:</label>
				<input type="email" name="email" id="email" class="form-control"  placeholder="Escriba su correo electrónico" value="<?= isset($data['data']['email']) ? $data['data']['email'] : '' ?>">
				<?php if (isset($data['errors']['email'])): ?>
				<p class="alert alert-danger mt-2"> <?= $data['errors']['email'] ?></p>
				<?php endif ?>
			</div>
			<div class="form-group text-left">
				<label for="password1">Contraseña:</label>
				<input type="password" name="password1" id="password1" class="form-control"  placeholder="Escriba su contraseña">
				<?php if (isset($data['errors']['password1'])): ?>
				<p class="alert alert-danger mt-2"> <?= $data['errors']['password1'] ?></p>
				<?php endif ?>
				
			</div>

			<div class="form-group text-left">
				<label for="password2">Repita su contraseña:</label>
				<input type="password" name="password2" id="password2" class="form-control"  placeholder="Repita su contraseña">
				<?php if (isset($data['errors']['password2'])): ?>
				<p class="alert alert-danger mt-2"> <?= $data['errors']['password2'] ?></p>
				<?php endif ?>
				<?php if (isset($data['errors']['password'])): ?>
				<p class="alert alert-danger mt-2"> <?= $data['errors']['password'] ?></p>
				<?php endif ?>
			</div>
			<div class="form-group text-left">
				<label for="address">Dirección:</label>
				<input type="text" name="address" id="address" class="form-control"  placeholder="Escriba su dirección" value="<?= isset($data['data']['address']) ? $data['data']['address'] : '' ?>">
				<?php if (isset($data['errors']['address'])): ?>
				<p class="alert alert-danger mt-2"> <?= $data['errors']['address'] ?></p>
				<?php endif ?>
			</div>
			<div class="form-group text-left">
				<label for="city">Ciudad:</label>
				<input type="text" name="city" id="city" class="form-control"  placeholder="Escriba su ciudad" value="<?= isset($data['data']['city']) ? $data['data']['city'] : '' ?>">
				<?php if (isset($data['errors']['city'])): ?>
				<p class="alert alert-danger mt-2"> <?= $data['errors']['city'] ?></p>
				<?php endif ?>
			</div>
			<div class="form-group text-left">
				<label for="state">Provincia:</label>
				<input type="text" name="state" id="state" class="form-control"  placeholder="Escriba su provincia" value="<?= isset($data['data']['state']) ? $data['data']['state'] : '' ?>">
				<?php if (isset($data['errors']['state'])): ?>
				<p class="alert alert-danger mt-2"> <?= $data['errors']['state'] ?></p>
				<?php endif ?>
			</div>
			<div class="form-group text-left">
				<label for="postcode">Código Postal:</label>
				<input type="text" name="postcode" id="postcode" class="form-control"  placeholder="Escriba su código postal" value="<?= isset($data['data']['postcode']) ? $data['data']['postcode'] : '' ?>">
				<?php if (isset($data['errors']['postcode'])): ?>
				<p class="alert alert-danger mt-2"> <?= $data['errors']['postcode'] ?></p>
				<?php endif ?>
			</div>
			<div class="form-group text-left">
				<label for="country">País:</label>
				<input type="text" name="country" id="country" class="form-control"  placeholder="Escriba su país:" value="<?= isset($data['data']['country']) ? $data['data']['country'] : '' ?>">
				<?php if (isset($data['errors']['country'])): ?>
				<p class="alert alert-danger mt-2"> <?= $data['errors']['country'] ?></p>
				<?php endif ?>
			</div>
			<div class="form-group text-left">
				<input type="submit" value="Enviar datos" class="btn btn-success">
				<a href="<?= ROOT ?>login/" class="btn btn-info">Cancelar</a>
			</div>
		</form>
	</div>
</div>
<?php include_once 'footer.php' ?>