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

if (isset($_REQUEST['valor']) && $_REQUEST['opt'] == 1) {
	$parte="";
	if(isset($_REQUEST["seleccionados"]) && $_REQUEST["seleccionados"]!=""){
		$parte=" and idfuncionario not in (".$_REQUEST["seleccionados"].")";
	}
	
	$_REQUEST['valor']=(htmlentities($_REQUEST['valor'], ENT_QUOTES, "UTF-8"));

	$datos = busca_filtro_tabla("idfuncionario as id," . concatenar_cadena_sql(array("nombres", "' -'", "apellidos")) . " as descripcion", "funcionario f", "f.estado=1 and f.idfuncionario<>".$_REQUEST["propietario"].$parte." and (f.nombres like '%" . $_REQUEST["valor"] . "%' OR f.apellidos like '%" . $_REQUEST["valor"] . "%')", "", $conn);
	$html = "<ul>";
	if ($datos['numcampos']) {
		for ($i = 0; $i < $datos['numcampos']; $i++) {
			$html .= "<li onclick=\"cargar_datos(" . $datos[$i]['id'] . ",'" . $datos[$i]['descripcion'] . "')\">" . $datos[$i]['descripcion'] . "</li>";
		}
	} else {
		$html .= "<li onclick=\"cargar_datos(0)\">NO hay coincidencias</li>";
	}
	$html .= "</ul>";
	echo $html;
}

?>