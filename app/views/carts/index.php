<?php include_once(VIEWS . 'header.php') ?>


<h2 class="text-center">Carrito de compras</h2>
<form action="<?= ROOT ?>cart/update" method="POST">
	<table class="table table-stripped" width="100%">
		<tr>
			<th width="12%">Producto</th>
			<th width="58%">Descripción</th>
			<th width="2%">Cantidad</th>
			<th width="10%">Precio</th>
			<th width="10%">Subtotal</th>
			<th width="2%">&nbsp;</th>
			<th width="6%">Borrar</th>
		</tr>
		<?php foreach ($data['data'] as $key => $value): ?>
			<tr>
				<td><img src="<?= ROOT ?>img/<?= $value->image ?>" width="105" alt="<?= $value->name ?>"></td>
				<td><b><?= $value->name ?></b> <?= substr(html_entity_decode($value->description), 0, 100) ?>...</td>
				<td class="text-right"><input type="number" name="c<?= $key ?>" class="text-right" value="<?= number_format($value->quantity,0) ?>" min="1" max="99"><input type="hidden" name="i<?= $key ?>" value="<?= $value->product ?>"></td>
				<td class="text-right"><?= number_format($value->price,2)?>&euro;</td>
				<td class="text-right"><?= number_format($value->quantity * $value->price, 2)?>&euro;</td>
				<td>&nbsp;</td>
				<td class="text-right"><a href="<?= ROOT ?>cart/delete/<?= $value->product ?>/<?= $value->user ?>" class="btn btn-danger"><i class="far fa-trash-alt"></i></a></td>
			</tr>
		<?php endforeach ?>
		<input type="hidden" name="rows" value="<?= count($data['data']) ?>">
		<input type="hidden" name="user_id" value="<?= $user_id ?>">
	</table>
	<hr>
	<table width="100%" class="text-right">
		<tr>
			<td width="80%"></td>
			<td width="10%">Subtotal:</td>
			<td width="10%"><?= number_format($data['subtotal'],2)?>&euro;</td>
		</tr>
		<tr>			
			<td width="80%"></td>
			<td width="10%">Descuento:</td>
			<td width="10%"><?= number_format($data['discount'],2)?>&euro;</td>
		</tr>
		<tr>
			<td width="80%"></td>
			<td width="10%">Envío:</td>
			<td width="10%"><?= number_format($data['send'],2)?>&euro;</td>
		</tr>
		<tr>
			<td width="80%"></td>
			<td width="10%">Total:</td>
			<td width="10%"><?= number_format($data['total'],2)?>&euro;</td>
		</tr>
		<tr>
			<td><a href="<?= ROOT ?>shop" class="btn btn-info" role="button">Seguir comprando</a></td>
			<td><input type="submit" class="btn btn-info" role="button" value="Recalcular"></td>
			<td><a href="<?= ROOT ?>cart/checkout" class="btn btn-success" role="button">Pagar</a></td>
		</tr>
	</table>
</form>
<?php include_once(VIEWS . 'footer.php') ?>
