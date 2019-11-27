<?php include_once (VIEWS . 'header.php') ?>

<div class="card p-4 bg-light">
	<div class="card-header">
		<h1 class="text-center">Detalle de la Venta</h1>
	</div>
	<div class="card-body">
		<table class="table table-striped text-center">
			<thead>
				<th>Nombre</th>
				<th>Fecha</th>
				<th>Precio</th>
				<th>Cantidad</th>
				<th>Descuento</th>
				<th>Envío</th>
				<th>Total</th>
			</thead>
			<tbody>
				<?php foreach ($data['data'] as $sale) : ?>
					<tr>
						<td class="text-center"><?= $sale->name ?></td>
						<td class="text-center"><?= substr($data['date'], 0, 10) ?></td>
						<td class="text-rigth"><?= number_format($sale->price, 2) ?>&euro;</td>
						<td class="text-right"><?= number_format($sale->quantity, 2) ?>&euro;</td>
						<td class="text-right"><?= number_format($sale->discount, 2) ?>&euro;</td>
						<td class="text-right"><?= number_format($sale->send, 2) ?>&euro;</td>
						<td class="text-right"><?= number_format($sale->price * $sale->quantity - $sale->discount + $sale->send, 2)?>&euro;</td>
					</tr>
				<?php endforeach ?>
			</tbody>
		</table>
	</div>
	<div class="card-footer">
		<a href="<?= ROOT ?>cart/sales" class="btn btn-success">Regresar</a>
	</div>
</div>

<?php include_once (VIEWS . 'footer.php') ?>
