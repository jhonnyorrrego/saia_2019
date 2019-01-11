<?php
$max_salida = 6;
$ruta_db_superior = $ruta = "";
while ($max_salida > 0) {
	if (is_file($ruta . "db.php")) {
		$ruta_db_superior = $ruta;
	}
	$ruta .= "../";
	$max_salida--;
}

include_once ($ruta_db_superior . "db.php");
include_once ($ruta_db_superior . "librerias_saia.php");
echo (estilo_bootstrap());
$html="";
if (isset($_REQUEST["seguimiento_indicador"]) && $_REQUEST["seguimiento_indicador"]) {
	$target = "centro";
	$planes = busca_filtro_tabla("iddocumento,descripcion,numero", "seguimiento_planes,documento d", "iddocumento=plan_mejoramiento and d.estado not in ('ELIMINADO','ANULADO','ACTIVO') and idft_seguimiento_indicador=" . $_REQUEST["seguimiento_indicador"], "", $conn);
	if ($planes["numcampos"] == 0) {
		$html= "<br /><br />No existen planes relacionados con el seguimiento.";
	} else {
		$html.= '<table class="table table-bordered" style="border-collapse: collapse; width: 100%;" border="1">
		<tr><td colspan="3" class="encabezado_list">PLANES DE MEJORAMIENTO RELACIONADOS CON EL SEGUIMIENTO</td></tr>
		<tr class="encabezado_list">
		<td>N&Uacute;MERO</td>
		<td>DESCRIPCI&Oacute;N</td>
		<td></td>
		</tr>';
		for ($i = 0; $i < $planes["numcampos"]; $i++) {
			$html.= "<tr>
				<td style='text-align:center'>" . $planes[$i]["numero"] . "</td>
				<td>" . $planes[$i]["descripcion"] . "</td>
				<td><a href='".$ruta_db_superior."ordenar.php?mostrar_formato=1&key=" . $planes[$i]["iddocumento"] . "' target='_blank'>Ver</a></td>
			</tr>";
		}
		$html.= "</table>";
	}
}
echo $html
?>

