<?php
$max_salida=6; // Previene algun posible ciclo infinito limitando a 10 los ../
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

$iddoc=$_REQUEST["iddoc"];
$idformato=$_REQUEST["idformato"];

if($iddoc){
	$sql1="update ft_plan_mejoramiento set estado_terminado='1' where documento_iddocumento=".$iddoc;
	phpmkr_query($sql1);
}
?>