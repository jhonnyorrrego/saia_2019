<?php
$max_salida = 10;
$ruta_db_superior = $ruta = '';

while ($max_salida > 0) {
	if (is_file($ruta . 'db.php')) {
		$ruta_db_superior = $ruta;
	}

	$ruta .= '../';
	$max_salida--;
}

$params = json_encode([
	'baseUrl' => $ruta_db_superior,
	'documentId' => $_REQUEST['documentId']
]);
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Document</title>
</head>

<body>
	<div class="container-fluid px-0">
		<div class="row mx-0 px-0">
			<div class="col-12 table-responsive px-0">
				<table class="table table-bordered table-striped">
					<thead class="thead-light">
						<tr>
							<th class="text-center bold">De</th>
							<th class="text-center bold">Para</th>
							<th class="text-center bold">Opciones de firma</th>
						</tr>
					</thead>
					<tbody id="table_body"></tbody>
					<tfoot>
						<tr>
							<td colspan="3">
								<button class="btn btn-complete btn-block" id="save_route">Guardar</button>
							</td>
						</tr>
					</tfoot>
				</table>
			</div>
		</div>
		<div class="row mx-0 px-0 pt-2">
			<div class="col">
				<button class="btn btn-warning btn-sm" id="save_route">Reasignar Responsables</button>
			</div>
			<div class="col">
				<button class="btn btn-success btn-sm" id="save_route">Firma única de quien prepara</button>
			</div>
		</div>
	</div>
	<script src="<?= $ruta_db_superior ?>views/documento/js/responsables.js" data-route='<?= $params ?>'></script>
</body>

</html>