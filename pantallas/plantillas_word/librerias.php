<?php
$max_salida = 10;
$ruta_db_superior = $ruta = "";
while ($max_salida > 0) {
	if (is_file($ruta . "db.php")) {
		$ruta_db_superior = $ruta;
	}
	$ruta .= "../";
	$max_salida--;
}
include_once ($ruta_db_superior . "db.php");

function listar_plantillas_word($id, $ruta, $nombre, $estado, $descripcion) {
	global $ruta_db_superior;
	$botones = '<a class="btn btn-mini tooltip_saia pull-right" title="Editar ' . $nombre . '" href="' . $ruta_db_superior . 'pantallas/plantillas_word/?idplantilla_word=' . $id . '"><i class="icon-pencil"></i></a>';
	$href = "anexosdigitales/parsea_accion_archivo.php?accion=descargar_ruta_json&ruta=" . base64_encode($ruta);
	if ($estado == 1) {
		$etiq_estado = "Activo";
		$botones .= '<a class="btn btn-mini tooltip_saia pull-right" title="Descargar" href="' . $ruta_db_superior . $href . '"><i class="icon-download"></i></a>';
	} else {
		$etiq_estado = "<span style='color:red'>Inactivo</span>";
	}
	$html = '<table style="width:100%">
			<tr>			
				<td><strong>' . $nombre . '</strong><br/><br/></td>
			</tr>
			<tr>
				<td>' . $descripcion . '<br/><br/></td>
			</tr>
			<tr>
				<td><strong>Estado: </strong>' . $etiq_estado . '</td>
			</tr>
			<tr>
				<td align="right">' . $botones . '</td>
			</tr>
		</table>';

	return $html;
}
