<?php include_once (VIEWS . 'header.php') ?>

<div class="card p-4 bg-light">
	<div class="card-header">
		<h1 class="text-center">Ventas por usuario y día</h1>
	</div>
	<div class="card-body">
		<table class="table table-striped text-center">
			<thead>
				<th>Id</th>
				<th>Fecha</th>
				<th>Valor</th>
				<th>Descuento</th>
				<th>Envío</th>
				<th>Total</th>
				<th>Detalle</th>
			</thead>
			<tbody>
				<?php foreach ($data['data'] as $sale) : ?>
					<tr>
						<td class="text-center"><?= $sale->user_id ?></td>
						<td class="text-center"><?= substr($sale->date, 0, 10) ?></td>
						<td class="text-rigth"><?= number_format($sale->cost, 2) ?>&euro;</td>
						<td class="text-right"><?= number_format($sale->discount, 2) ?>&euro;</td>
						<td class="text-right"><?= number_format($sale->send, 2) ?>&euro;</td>
						<td class="text-right"><?= number_format($sale->cost - $sale->discount + $sale->send, 2) ?>&euro;</td>
						<td><a href="<?= ROOT ?>cart/show/<?= substr($sale->date, 0, 10) ?>/<?= $sale->user_id ?>"> Ver venta</a></td>
					</tr>
				<?php endforeach ?>
			</tbody>
		</table>
	</div>
	<div class="card-footer">
		<a href="<?= ROOT ?>cart/chartdailysales" class="btn btn-success">Gráfico de ventas por día</a>
	</div>
</div>

<?php include_once (VIEWS . 'footer.php') ?>
