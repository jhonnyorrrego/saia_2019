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
include_once($ruta_db_superior."librerias_saia.php");

if(@$_REQUEST['ejecutar_funcion']){
   $_REQUEST["ejecutar_funcion"]();
}


function set_categoria(){
    global $conn;
    
    
	$tabla="";
	$fieldList=array();
	$fieldList["cod_padre"] = 2;	
	$fieldList["nombre"] = "'".decodifica_encabezado(htmlentities($_REQUEST['nombre']))."'"; 
	$fieldList["descripcion"] = "'".decodifica_encabezado(htmlentities($_REQUEST['descripcion']))."'";
	
	$strsql = "INSERT INTO ".$tabla." (fecha,";
	$strsql .= implode(",", array_keys($fieldList));			
	$strsql .= ") VALUES (".fecha_db_almacenar(date('Y-m-d'),'Y-m-d').",";			
	$strsql .= implode(",", array_values($fieldList));			
	$strsql .= ")";
    
    print_r($strsql);
    
    die();    
    
}


?>