<?php
$max_salida=10; // Previene algun posible ciclo infinito limitando a 10 los ../
$ruta_db_superior=$ruta="";
while($max_salida>0)
{
	if(is_file($ruta."db.php"))
	{
		$ruta_db_superior=$ruta; //Preserva la ruta superior encontrada
	}
	$ruta.="../";
	$max_salida--;
}
include_once($ruta_db_superior."db.php");
include_once($ruta_db_superior."formatos/librerias/funciones_generales.php");

$iddocumento=$_REQUEST['iddocumento'];
$sql1="UPDATE ft_confir_negoci_vehiculo SET accesorios_vehiculo='0' WHERE documento_iddocumento=".$iddocumento;
//print_r($sql1);
phpmkr_query($sql1);
?>