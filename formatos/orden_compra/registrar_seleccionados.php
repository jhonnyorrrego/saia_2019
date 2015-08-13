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
$sql1="UPDATE ft_valores_item_recepcion SET estado='2' WHERE idft_valores_item_recepcion=".$id;
phpmkr_query($sql1);
?>