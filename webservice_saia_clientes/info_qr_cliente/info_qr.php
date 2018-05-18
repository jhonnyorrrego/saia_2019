<?php
include_once ('lib/nusoap.php');
include_once ('define.php');

$cliente = new nusoap_client(SERVIDOR_INFO_QR);
$retorno = $cliente -> call('generar_html_info_qr', array(json_encode($_REQUEST["key_cripto"])));
$array = json_decode($retorno, true);
$table = '';
$logo = '';
$table2 = '';
if ($array["exito"]) {
	foreach ($array["info_tabla"] as $key => $value) {
		$table .= '<tr><th>' . str_replace("_", " ", $key) . '</th> <td>' . $value . '</td></tr>';
	}
	if ($array["logo"]) {
		$logo = "<img src='" . $array["logo"] . "' />";
	}
	if ($array["color_saia"]) {
		$bgcolor = $array["color_saia"];
	}

	if ($array["nombre_formato"] == "despacho_ingresados") {//Entrega Interna
		if ($array["iddoc"] && $array["idformato"]) {
			$request = array(
				"iddoc" => $array["iddoc"],
				"idformato" => $array["idformato"]
			);
			$consulta_items = $cliente -> call('items_novedad_despacho', array(json_encode($request)));
			$info_adicional = json_decode($consulta_items, true);
			if ($info_adicional["exito"]) {
				$table2 = '<table class="table table-bordered" style="border-collapse: collapse; width: 100%;" border="1">';
				$datos_item = $info_adicional["info_tabla"];
				$table2 .= '<tr style="background-color:' . $bgcolor . ';color: #fff;text-align: center"><th>TRAMITE</th> <th>TIPO</th> <th>RAD.ITEM</th> <th>FECHA DE RECIBO</th> <th>ORIGEN</th> <th>DESTINO</th><th>ASUNTO</th> <th>NOVEDAD</th></tr>';
				for ($i = 0; $i < $info_adicional["cant_item"]; $i++) {
					$table2 .= '<tr>';
					$table2 .= '<td>' . $datos_item[$i]["tramite"] . '</td>';
					$table2 .= '<td>' . $datos_item[$i]["tipo"] . '</td>';
					$table2 .= '<td>' . $datos_item[$i]["rad_item"] . '</td>';
					$table2 .= '<td>' . $datos_item[$i]["fecha_recibo"] . '</td>';
					$table2 .= '<td>' . $datos_item[$i]["origen"] . '</td>';
					$table2 .= '<td>' . $datos_item[$i]["destino"] . '</td>';
					$table2 .= '<td>' . $datos_item[$i]["asunto"] . '</td>';
					$table2 .= '<td>' . mb_strtolower($datos_item[$i]["novedad"]) . '</td>';
					$table2 .= '</tr>';
				}
				$table2 .= '</table>';
			}
		}
	}

} else {
	$bgcolor = "#3f91f2";
	$array["title"] = "EL CONTENIDO NO EST&Aacute; DISPONIBLE";
	$table .= '<tr><td colspan="2">Es posible que el enlace del navegador haya caducado o que la p&aacute;gina solo pueda verla personal autorizado.</td></tr>';
}
?>

<!doctype html>
<html lang="es">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<link rel="stylesheet" href="css/bootstrap.min.css" >
		<style>
			span, p, div, table {
				color: #333333;
				font-size: 11px;
			}
			td, th {
				border: 1px solid #b6b8b7;
			}
		</style>
		<title>Informaci&oacute;n del QR</title>
	</head>
	<body>
		<div class="container">
			<?php echo $logo;?>
			<table class="table table-bordered" style="border-collapse: collapse; width: 100%;" border="1">
				<thead>
					<tr>
						<th colspan="2" style="background-color:<?php echo $bgcolor;?>;color: #fff;text-align: center"><?php echo $array["title"]; ?></th>
					</tr>
				</thead>
				<tbody>
					<?php echo $table; ?>
				</tbody>
			</table>
			<?php echo $table2;?>
		</div>
		<script src="js/bootstrap.min.js"></script>
	</body>
</html>