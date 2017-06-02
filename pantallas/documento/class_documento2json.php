<?php
$max_salida = 6;
$ruta_db_superior = $ruta = "";
while($max_salida > 0) {
	if (is_file($ruta . "db.php")) {
		$ruta_db_superior = $ruta;
	}
	$ruta .= "../";
	$max_salida--;
}
include_once ($ruta_db_superior . 'pantallas/documento/class_documento_elastic.php');
// Ejemplo de uso de la clase
ini_set("display_errors", true);
if ($_REQUEST["id"]) {
	$d2j = new DocumentoElastic($_REQUEST["id"]);
	switch ($_REQUEST["accion"]) {
		case "indexar" :
			//$d2j->asignar_iddocumento($_REQUEST["id"]);
			print_r($d2j->crear_indice_saia());
			break;
		case "indexar_documento":
			print_r($d2j->indexar_elasticsearch_completo());
			break;
		case "buscar" :
			if (@$_REQUEST["tabla"] && @$_REQUEST["campo"] && @$_REQUEST["criterio"]) {
				$busqueda = array(
						$_REQUEST["tabla"] . "." . $_REQUEST["campo"] => $_REQUEST["criterio"]
				);
				$retorno = $d2j->buscar_elasticsearch($busqueda);
				print_r($retorno);
			} else {
				die("No es posible realizar la busqueda con los criterios indicados ");
			}
			break;
		case "buscar_all" :
			$param = '';
			$retorno = $d2j->buscar_elasticsearch_all($param);
			print_r($retorno);
			break;
		case "verificar_indice" :
			if ($_REQUEST["indice"] && $_REQUEST["tipo_dato"]) {
				$retorno = $d2j->get_cliente_elasticsearch()->verificar_indice($_REQUEST["indice"], $_REQUEST["id"], $_REQUEST["tipo_dato"]);
				print_r($retorno);
			} else {
				print_r($_REQUEST);
				die("No es posible verificar los datos con los registros enviados");
			}
			break;
		case "borrar_all" :
			$retorno = $d2j->borrar_elasticsearch_all();
			print_r($retorno);
			break;
	}
} else if($_REQUEST["accion"] == "indexar_completo") {
	$elastic = new DocumentoElastic(null);
	$elastic->crear_indice_saia();
	//consultar todos los documentos que son padre
	$documentos = busca_filtro_tabla("d.iddocumento", "documento d, formato f", "upper(f.nombre)=d.plantilla and f.cod_padre = 0", "d.iddocumento", $conn);
	for($i=0; $i < $documentos["numcampos"]; $i++) {
		$d2j= new DocumentoElastic($documentos[$i]["iddocumento"]);
		$d2j->indexar_elasticsearch_completo();
	}
} else {
	die("Por favor ingrese el id");
}
?>