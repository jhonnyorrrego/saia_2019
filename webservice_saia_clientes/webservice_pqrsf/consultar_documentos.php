<?php
session_start();
include_once ('define.php');
require_once ('lib/nusoap.php');

$cliente = new nusoap_client(SERVIDOR_REMOTO);
$resultado = $cliente -> call('consultar_pqr', array(json_encode($_REQUEST)));
$resultado = json_decode($resultado, true);
$table = '';
if ($resultado["exito"]) {
	if ($resultado["color_saia"]) {
		$bgcolor = $resultado["color_saia"];
	}
	$table .= '<tr><th>Fecha</th> <th>N&uacute;mero de Radicado</th> <th>PDF</th></tr>';
	foreach ($resultado["info"] as $fila) {
		$table .= '<tr>';
		$table .= '<td>' . $fila["fecha"] . '</td>';
		$table .= '<td>' . $fila["numero"] . '</td>';
		$table .= '<td><ul>';
		foreach ($fila["respuesta"] as $pdf) {
			if ($pdf == "Sin Respuesta") {
				$table .= '<li>' . $pdf . '</li>';
			} else {
				$search = array(
					":",
					" "
				);
				$replace = array(
					"_",
					"_"
				);
				$name = str_replace($search, $replace, $fila["fecha"]) . ".pdf";
				$ruta = 'temp_pdf/' . $name;
				file_put_contents($ruta, base64_decode($pdf));
				$table .= '<li><a href="' . $ruta . '" target="_blank">' . $name . '</a></li>';
				$_SESSION["temp_pdf_" . $_SESSION["idsession"]][] = $ruta;
			}
		}
		$table .= '</ul></td>';

		$table .= '</tr>';
	}
} else {
	$bgcolor = "#3f91f2";
	$table .= '<tr><td colspan="2"><strong>' . $resultado["msn"] . '</td></tr>';
}
?>
<table class="table table-bordered" style="border-collapse: collapse; width: 70%;text-align: center" border="1" align="center">
	<thead>
		<tr>
			<th colspan="3" style="background-color:<?php echo $bgcolor; ?>;color: #fff;text-align: center">CONSULTA DE DOCUMENTOS</th>
		</tr>
	</thead>
	<tbody>
		<?php echo $table; ?>
	</tbody>
</table>