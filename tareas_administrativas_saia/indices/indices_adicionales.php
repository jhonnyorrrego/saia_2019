<?php
$max_salida = 10; // Previene algun posible ciclo infinito limitando a 10 los ../
$ruta_db_superior = $ruta = "";
while($max_salida > 0) {
	if (is_file($ruta . "db.php")) {
		$ruta_db_superior = $ruta; // Preserva la ruta superior encontrada
	}
	$ruta .= "../";
	$max_salida--;
}
include_once ($ruta_db_superior . "db.php");
$array_create = array();
$array_alter = array();

$tablas = busca_filtro_tabla("table_name", "DBA_TABLES", "OWNER='" . strtoupper('SAIA') . "'", "", $conn);

$tablespace = "SAIA_DATOS";
$creados = array();
for($i = 0; $i < $tablas["numcampos"]; $i++) {

	// $tablas[$i]["table_name"]="DATOS_EJECUTOR";

	$campos_formatos = busca_filtro_tabla("column_name", "all_tab_columns", "table_name='" . strtoupper($tablas[$i]["table_name"]) . "'", "", $conn);
	// $campos_formatos = busca_filtro_tabla("col.name column_name", "sys.columns col", "col.object_id='" . $tablas[$i]["object_id"] . "' and " . "not EXISTS(select null FROM sys.indexes ind JOIN sys.index_columns ic ON ind.object_id = ic.object_id and ind.index_id = ic.index_id " . "where ic.object_id = col.object_id and ic.column_id = col.column_id)", "", $conn);

	// echo("<br/>--------<br/>--".$tablas[$i]["table_name"]."<br/>-------------<br/>");
	for($j = 0; $j < $campos_formatos["numcampos"]; $j++) {

		// Quitar los prefijos de 3 o menos caracteres al nombre de la tabla
		$p_nom_tab = preg_replace("/^([a-zA-Z]{2,3}_)(.*)/", "$2", $tablas[$i]["table_name"]);
		if (strlen($p_nom_tab) > 20) {
			$p_nom_tab = substr($p_nom_tab, 0, 19);
		}

		// Quitar los prefijos de 3 o menos caracteres al nombre del campo
		$p_nom_camp = preg_replace("/^([a-zA-Z]{2,3}_)(.*)/", "$2", $campos_formatos[$j]["column_name"]);
		// $p_nom_camp = ltrim($p_nom_camp, 'id');

		$inicial_campo = substr($p_nom_camp, 0, 10);

		$nombre_indice = $p_nom_tab . "_" . $inicial_campo;
		if (in_array($nombre_indice, $creados)) {
			$nombre_indice = $p_nom_tab . "_" . $p_nom_camp;
		}

		$sentencia = "";
		if (preg_match("/^ft/i", $campos_formatos[$j]["column_name"]) === 1) {
			$sentencia = ("CREATE INDEX I_" . $nombre_indice . "  ON " . ($tablas[$i]["table_name"]) . " (" . ($campos_formatos[$j]["column_name"]) . ");<br/>");
		}
		if (preg_match("/serie/i", $campos_formatos[$j]["column_name"]) === 1) {
			$sentencia = ("CREATE INDEX I_" . $nombre_indice . "  ON " . ($tablas[$i]["table_name"]) . " (" . ($campos_formatos[$j]["column_name"]) . ");<br/>");
		}
		if (preg_match("/destino/i", $campos_formatos[$j]["column_name"]) === 1) {
			$sentencia = ("CREATE INDEX I_" . $nombre_indice . "  ON " . ($tablas[$i]["table_name"]) . " (" . ($campos_formatos[$j]["column_name"]) . ");<br/>");
		}

		if (preg_match("/_id(?!.*serie)(?!.*documento)/i", $campos_formatos[$j]["column_name"]) === 1) {
			echo ("CREATE INDEX I_" . $nombre_indice . "  ON " . ($tablas[$i]["table_name"]) . " (" . ($campos_formatos[$j]["column_name"]) . ");<br/>");
		}
		if (!empty($sentencia)) {
			$creados[] = $nombre_indice;
			echo $sentencia;
		}
	}
}

// DOCUMENTO
echo ("CREATE INDEX I_ASIGNACION_LL on ASIGNACION (LLAVE_ENTIDAD);<br/>");
echo ("CREATE INDEX I_DOCUMENTO_ES on DOCUMENTO (ESTADO);<br/>");
echo ("CREATE INDEX I_DOCUMENTO_PL on DOCUMENTO (PLANTILLA);<br/>");
echo ("CREATE INDEX I_DOCUMENTO_EJ on DOCUMENTO (EJECUTOR);<br/>");
echo ("CREATE INDEX I_DOCUMENTO_FE on DOCUMENTO (FECHA);<br/>");
