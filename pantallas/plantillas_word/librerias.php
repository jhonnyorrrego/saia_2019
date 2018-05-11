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


function listar_plantillas_word($id, $ruta, $nombre, $estado, $descripcion,$extension) {
	global $ruta_db_superior;
	$botones = '<a class="btn btn-mini tooltip_saia pull-right" title="Editar ' . $nombre . '" href="' . $ruta_db_superior . 'pantallas/plantillas_word/?idplantilla_word=' . $id . '"><i class="icon-pencil"></i></a>';
		$ruta_anexo = json_decode($ruta);
		if (is_object($ruta_anexo)) {
			$tipo_almacenamiento = new SaiaStorage("plantilla_word");
			if ($tipo_almacenamiento -> get_filesystem() -> has($ruta_anexo -> ruta)) {
				$ruta64 = base64_encode($ruta);
				$href = "filesystem/mostrar_binario.php?ruta=" . $ruta64;
			}
		}
		if($estado==1){
			$botones .= '<a class="btn btn-mini tooltip_saia pull-right" title="Descargar" href="' . $ruta_db_superior . $href . '"><i class="icon-folder-open"></i></a>';
		}
		$html = '<table style="width:100%">
			<tr>			
				<td><strong>' . $etiqueta . '</strong></td>
			</tr>
			<tr>
				<td>' . $descripcion . '</td>
			</tr>
			<tr>
				<td align="right">' . $botones . '</td>
			</tr>
		</table>';
	
	return $html;
}