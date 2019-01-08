<?php
session_start();
include_once ('define.php');
require_once ('lib/nusoap.php');

$cliente = new nusoap_client(SERVIDOR_REMOTO);
$resultado = $cliente -> call('consultar_datos_contrato', array(json_encode($_REQUEST)));
$resultado = json_decode($resultado, true);
$table = '<div style="box-shadow:5px 5px 13px 5px #0f0e0e;padding:20px;">';
if ($resultado["exito"]) {
	$cant = count($resultado["datos"]);
	$datos = $resultado["datos"];
	for ($i = 0; $i < $cant; $i++) {
		$table .= '<table class="table table-bordered" style="border-collapse: collapse; width: 100%;text-align: center" border="1" align="center">
		<thead>
			<tr>
				<th colspan="3" style="background-color:' . $resultado["color_saia"] . ';color: #fff;text-align: center">INFORMACI&Oacute;N GENERAL DEL CONTRATO</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td><strong>Naturaleza del Contrato</strong></td>
				<td>' . $datos[$i]["naturaleza_contrato"] . '</td>
				<td rowspan="4">' . $datos[$i]["qr"] . '</td>
			</tr>
			
			<tr>
				<td><strong>Estado</strong></td>
				<td>' . $datos[$i]["estado_contrato"] . '</td>
			</tr>
			
			<tr>
				<td><strong>Fecha inicio del contrato</strong></td>
				<td>' . $datos[$i]["fecha_inicio"] . '</td>
			</tr>
			
			<tr>
				<td><strong>Fecha de finalizaci&oacute;n del contrato</strong></td>
				<td>' . $datos[$i]["fecha_fin"] . '</td>
			</tr>
		</tbody>
	</table>';

		$cant_hijos = count($datos[$i]["datos_hijos"]);
		if ($cant_hijos) {
			$datos_hijos = $datos[$i]["datos_hijos"];
			for ($j = 0; $j < $cant_hijos; $j++) {
				$parte .= '<tr>';
				$parte .= '<td>' . $datos_hijos[$j]["nombre_documento"] . '</td>';
				$parte .= '<td>' . $datos_hijos[$j]["nombre_serie"] . '</td>';
				$parte .= '<td>' . $datos_hijos[$j]["fecha_vencimiento"] . '</td>';

				if ($datos_hijos[$j]["anexo"] != "") {
					$parte .= '<td><ul>';
					$search = array(" ");
					$replace = array("_", );
					$ruta = 'temp_pdf/' . str_replace($search, $replace, $datos_hijos[$j]["etiqueta_anexo"]);
					file_put_contents($ruta, base64_decode($datos_hijos[$j]["anexo"]));
					$parte .= '<li><a href="' . $ruta . '" target="_blank">' . $datos_hijos[$j]["etiqueta_anexo"] . '</a></li>';
					$_SESSION["temp_pdf_" . $_SESSION["idsession"]][] = $ruta;
					$parte .= '</ul></td>';
				} else {
					$parte .= '<td></td>';
				}
				$parte .= '<td>' . $datos_hijos[$j]["estado_docs"] . '</td>';
				$parte .= '</tr>';
			}

			$table .= '<table class="table table-bordered" style="border-collapse: collapse; width: 100%;text-align: center" border="1" align="center">
		<thead>
			<tr>
				<th colspan="5" style="background-color:' . $resultado["color_saia"] . ';color: #fff;text-align: center">DOCUMENTOS DEL CONTRATO</th></tr>
		</thead>
		<tbody>
			<tr>
				<th style="text-align:center;">Nombre Documento</th>
				<th style="text-align:center;">Tipo de Documento</th>
				<th style="text-align:center;">Vencimiento</th>
				<th style="text-align:center;">Anexo</th>
				<th style="text-align:center;">Estado</th>
				</tr>' . $parte . '
		</tbody>
	</table>.<hr/>';
		}
	}
} else {
	$bgcolor = "";
	$table .= '<table class="table table-bordered" style="border-collapse: collapse; width: 100%;text-align: center" border="1" align="center">
		<thead>
			<tr>
				<th style="background-color:#3f91f2;color: #fff;text-align: center">INFORMACI&Oacute;N GENERAL DEL CONTRATO</th></tr>
		</thead>
		<tr><td>' . $resultado["msn"] . '</td></tr>
		</table>';
}
$table .= '</div>';
echo $table;
?>
