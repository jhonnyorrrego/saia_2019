<?php

$max_salida=6; // Previene algun posible ciclo infinito limitando a 10 los ../
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
include_once($ruta_db_superior."formatos/librerias/funciones_generales.php");


function mostrar_fecha_retiro_retirados($idformato,$iddoc){
	global $conn,$ruta_db_superior;
	
	$datos=busca_filtro_tabla("","ft_inventario_retirados","documento_iddocumento=".$iddoc,"",$conn);
	$fecha=explode("-",$datos[0]['fecha_retiro']);
	echo $fecha[0];
	
}

function mostrar_fecha_inicial_retirados($idformato,$iddoc){
	global $conn,$ruta_db_superior;
	
	$datos=busca_filtro_tabla("","ft_inventario_retirados","documento_iddocumento=".$iddoc,"",$conn);
	$fecha=explode("-",$datos[0]['fecha_extrema_inicia']);
	echo $fecha[0];
	
}

function mostrar_fecha_final_retirados($idformato,$iddoc){
	global $conn,$ruta_db_superior;
	
	$datos=busca_filtro_tabla("","ft_inventario_retirados","documento_iddocumento=".$iddoc,"",$conn);
	$fecha=explode("-",$datos[0]['fecha_extrema_final']);
	echo $fecha[0];
	
}