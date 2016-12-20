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
include_once($ruta_db_superior."formatos/librerias_funciones_generales.php");
include_once($ruta_db_superior."librerias_saia.php");


$idft=$_REQUEST['idft'];
$estado=$_REQUEST['estado'];

$sql="UPDATE ft_dependencias_ruta SET estado_dependencia=$estado WHERE dependencia_asignada=$idft";
phpmkr_query($sql);

echo('<script>window.history.back(); window.location.reload();</script>');