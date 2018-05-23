<?php
$max_salida = 6;
$ruta_db_superior = $ruta = "";
while ($max_salida > 0) {
	if (is_file($ruta . "db.php")) {
		$ruta_db_superior = $ruta;
	} $ruta .= "../";
	$max_salida--;
}
include_once ($ruta_db_superior . "db.php");
$retorno = array("campos" => '');

$etiquetas_validas = array(
	'text',
	'radio',
	'checkbox',
	'arbol',
	'select',
	'fecha',
	'spin',
	'valor',
	'hidden'
);

if (@$_REQUEST["idformato"]) {
	$campos = busca_filtro_tabla("", "campos_formato", "formato_idformato=" . $_REQUEST["idformato"] . " AND etiqueta_html IN('" . implode("','", $etiquetas_validas) . "') AND (banderas NOT LIKE 'pk' OR banderas IS NULL)AND nombre NOT IN('encabezado','documento_iddocumento','firma')", "", $conn);
	if ($campos["numcampos"]) {
		$retorno["sql"] = $campos["sql"];
		$html = '<select name="fk_campos_formato" id="fk_campos_formato">';
		$html .= '<option value="">Por favor seleccione</option>';
		for ($i = 0; $i < $campos["numcampos"]; $i++) {
			$html .= '<option data-type="'.$campos[$i]["etiqueta_html"].'" value="' . $campos[$i]["idcampos_formato"] . '" >' . $campos[$i]["etiqueta"] . " (" . $campos[$i]["etiqueta_html"] . ")" . '</option>';
		}
		$html .= '</select>';
		$retorno["campos"] = $html;
	}
}
echo(json_encode($retorno));
?>