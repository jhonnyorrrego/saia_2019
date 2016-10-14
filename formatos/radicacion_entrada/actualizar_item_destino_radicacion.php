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
$id=$_REQUEST['id'];
$observacion=$_REQUEST['observaciones'];
$iddoc=$_REQUEST['iddoc'];

for ($i=0; $i < count($id) ; $i++) { 
	$sql="UPDATE ft_destino_radicacion SET observacion_destino={$observacion[$i]} WHERE idft_destino_radicacion={$id[$i]}";
	phpmkr_query($sql);
	$sql1="UPDATE ft_radicacion_entrada SET despachado=1 WHERE documento_iddocumento=$iddoc";
	phpmkr_query($sql1);
}
echo('<script>window.history.back();</script>');