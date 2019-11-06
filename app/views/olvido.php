<?php include_once 'header.php'?>
<div class="card p-4 bg-light">
	<h1 class="text-center"><?= $data['subtitle'] ?></h1>

	<div class="text-body">
		<form action="<?= ROOT ?>login/olvido" method ="POST">
			<div class="form-group text-left">
				<label for="email">Correo electrónico</label>
				<input type="email" name="email" id="email" class="form-control">
			</div>
			<div class="form-group text-left">
				<input type="submit" value="Enviar" class="btn btn-success">
				<a href="<?= ROOT  ?>login" class="btn btn-info">Regresar</a>
			</div>

		</form>
	</div>
	<div class="card-footer">
		<div class="row">
			<p>Recibiras un correo electrónico, comrpueba tu bandeja de spam</p>
		</div>
	</div>
</div>

<?php include_once 'footer.php' ?>