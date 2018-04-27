<?php
include_once ("db.php");

$modulos = busca_filtro_tabla("", "modulo", "cod_padre=1522", "orden", $conn);
$items_fila = 3;

if (@$_REQUEST["tipo_modulo"] == "planes_mejoramiento") {
	$texto = "HALLAZGOS POR AREA RESPONSABLE:</b>
	<select id='area_responsable' onchange='if(this.value!=\"\") window.location=\"listado_hallazgos.php?tipo=dependencia&dependencia=\"+this.value;'>
  <option value=''>Seleccionar...</option>";
	$dependencias = busca_filtro_tabla("nombre,iddependencia", "dependencia", "estado=1 and tipo=1", "nombre", $conn);
	for ($i = 0; $i < $dependencias["numcampos"]; $i++){
		$texto .= "<option value='" . $dependencias[$i]["iddependencia"] . "'>" . $dependencias[$i]["nombre"] . "</option>";
	}
	$texto .= "</select><br /><br />";
}

$texto .= '<table border="1px" style="border-collapse:collapse;"><tr>';
for ($i = 0, $j = 0; $i < $modulos["numcampos"]; $i++) {
	if ($modulos[$i]["enlace"] <> "#") {
		$texto .= '<td title="' . $modulos[$i]["ayuda"] . '" align="center" >
			<a href="' . $modulos[$i]["enlace"] . $adicional . '" target="' . $modulos[$i]["destino"] . '"><b>' . $modulos[$i]["etiqueta"] . '</b><br /><br /><img style="width:60px;height:60px;" src="' . $modulos[$i]["imagen"] . '" border="0px";>
		</td>';
		$j++;
		if (($j % $items_fila == 0) && $j > 0) {
			$texto .= '</tr><tr>';
		}
	}
}
for ($j; ($j % $items_fila) != 0 && $j > 0; $j++) {
	$texto .= "<td>&nbsp;</td>";
}
$texto .= '</tr></table>'; 
echo($texto);
?>