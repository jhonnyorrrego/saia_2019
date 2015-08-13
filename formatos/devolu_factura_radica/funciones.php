<?php
$max_salida=6; // Previene algun posible ciclo infinito limitando a 10 los ../
$ruta_db_superior=$ruta="";
while($max_salida>0)
{
if(is_file($ruta."db.php")){
$ruta_db_superior=$ruta; //Preserva la ruta superior encontrada
}
$ruta.="../";
$max_salida--;
}
include_once($ruta_db_superior."db.php");
include_once($ruta_db_superior."formatos/librerias/funciones_generales.php");
include_once($ruta_db_superior."formatos/librerias/funciones_formatos_generales.php");

//MOSTRAR
//********************
function mostrar_informacion_proveedor($idformato,$iddoc){
	global $conn;
}

function muestra_anexos_devolucion($idformato,$iddoc){
	global $conn;
}

function ver_dependencia($idformato,$iddoc){
	global $conn;
	$dep=busca_filtro_tabla("v.dependencia","ft_devolucion_factura df,vfuncionario_dc v","v.iddependencia_cargo=df.dependencia and df.documento_iddocumento=".$iddoc,"",$conn);
	echo ($dep[0]['dependencia']);
}
?> 