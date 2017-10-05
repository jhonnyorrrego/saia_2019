<?php
$max_salida=10; // Previene algun posible ciclo infinito limitando a 10 los ../
$ruta_db_superior=$ruta="";
while($max_salida>0){
	if(is_file($ruta."db.php")){
		$ruta_db_superior=$ruta; //Preserva la ruta superior encontrada
	}
	$ruta.="../";
	$max_salida--;
}

include_once(dirname(__FILE__)."/../../db.php");

function filtro_cod_arbol() {
	if(empty($_REQUEST["variable_busqueda"])) {
		return "";
	}
	return " AND a.cod_arbol like '" . $_REQUEST["variable_busqueda"] . "%'";
}

function filtro_expediente_doc() {
	if(empty($_REQUEST["variable_busqueda"])) {
		return "";
	}
	return " AND a.expediente_idexpediente = " . $_REQUEST["variable_busqueda"];
}