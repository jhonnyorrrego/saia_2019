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

$id=@$_REQUEST["id"];
$datos=explode("-",$id);
if($datos[1]=='caja'){
	abrir_url("caja/cajaview.php?key=".$datos[0],"_self");
}
if($datos[1]=='carpeta'){
	abrir_url("carpeta/folderview.php?key=".$datos[0],"_self");
}
?>