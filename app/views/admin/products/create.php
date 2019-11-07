<?php include_once (VIEWS . 'header.php') ?>
<div class="card p-4 bg-light">
	<div class="card-header">
		<h1 class="text-center">Alta de un producto</h1>
	</div>
	<div class="card-body">
		<form action="<?= ROOT ?>adminproduct/create" method="POST">
			<div class="form-group text-left">
				<label for="type">Tipo de producto:</label>
				<select name="type" id="type" class="form-control">
					<option value="">Selecciona el tipo de producto</option>
					<?php foreach($data['type'] as $type): ?>
						<option value="<?= $type->value ?>">
							<?= $type->description ?>
						</option>
					<?php endforeach ?>
				</select>
			</div>
			<div class="form-group text-left">
				<label for="name">Nombre:</label>
				<input type="text" name="name" class="form-control" required placeholder="Escribe el nombre del producto" value="<?= isset($data['data']['name']) ? $data['data']['name'] : '' ?>">
			</div>
			<div class="form-group text-left">
				<label for="description">Descripcion:</label>
				<input type="text" name="description" class="form-control" required placeholder="Escribe la descripción del producto" value="<?= isset($data['data']['description']) ? $data['data']['description'] : '' ?>">
			</div>
			<div id="book">
				<div class="form-group text-left">
					<label for="author">Autor:</label>
					<input type="text" name="author" class="form-control" placeholder="Escribe el autor del libro" value="<?= isset($data['data']['author']) ? $data['data']['author'] : ''?>">
				</div>
				<div class="form-group text-left">
					<label for="publisher">Editorial:</label>
					<input type="text" name="publisher" class="form-control" placeholder="Escribe la editorial del libro" value="<?= isset($data['data']['publisher']) ? $data['data']['publisher'] : ''?>">
				</div>
				<div class="form-group text-left">
					<label for="pages">Páginas:</label>
					<input type="text" name="pages" class="form-control" placeholder="Escribe el numero de páginas del libro" value="<?= isset($data['data']['pages']) ? $data['data']['pages'] : ''?>">
				</div>
			</div>
			<div id="course">
				<div class="form-group text-left">
					<label for="people">Público objetivo:</label>
					<input type="text" name="people" class="form-control" placeholder="Escribe el público al que va dirigido el curso" value="<?= isset($data['data']['people']) ? $data['data']['people'] : ''?>">
				</div>
				<div class="form-group text-left">
					<label for="objetives">Objetivos:</label>
					<input type="text" name="objetives" class="form-control" placeholder="Escribe los objetivos del curso" value="<?= isset($data['data']['objetives']) ? $data['data']['objetives'] : ''?>">
				</div>
				<div class="form-group text-left">
					<label for="necesites">Conocimientos previos necesarios:</label>
					<input type="text" name="people" class="form-control" placeholder="Escribe los conocimientos previos necesarios" value="<?= isset($data['data']['necesites']) ? $data['data']['necesites'] : ''?>">
				</div>
			</div>
			<div class="form-group text-left">
				<label for="price">Precio del producto:</label>
				<input type="text" name="price" class="form-control" placeholder="Escribe el precio sin comas ni símbolos" value="<?= isset($data['data']['price']) ? $data['data']['price'] : ''?>">
			</div>
			<div class="form-group text-left">
				<input type="submit" value="Enviar" class="btn btn-success">
				<a href="<?= ROOT ?>adminproduct" class="btn btn-info">Cancelar</a>
			</div>
		</form>
	</div>
</div>
<?php include_once (VIEWS . 'footer.php') ?> 