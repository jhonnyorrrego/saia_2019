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
include_once($ruta_db_superior."db.php");
$datos=explode("-",@$_REQUEST["id"]);
$tipo=$datos[0];
$ruta="";
if($tipo=='pdf'){
    $dato=busca_filtro_tabla("","version_documento a","a.idversion_documento=".$datos[1],"",$conn);
    $ruta=$dato[0]["pdf"];
}else if($tipo=='anexo'){
    $dato=busca_filtro_tabla("","version_anexos a","a.idversion_anexos=".$datos[1],"",$conn);
    $ruta=$dato[0]["ruta"];
}else if($tipo=='pagina'){
    $dato=busca_filtro_tabla("","version_pagina a","a.idversion_pagina=".$datos[1],"",$conn);
    $ruta=$dato[0]["ruta"];
}else if($tipo=='vista'){
    $dato=busca_filtro_tabla("","version_vista a","a.idversion_vista=".$datos[1],"",$conn);
    $ruta=$dato[0]["pdf"];
}
abrir_url($ruta_db_superior.$ruta,"_self");
?>