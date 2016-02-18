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

$archivo=DB."_log_".str_replace("-", "_",$_REQUEST['fecha']).".txt";
$cadena=file_get_contents($ruta_db_superior."../evento/".$archivo);

$datos=explode("|", $cadena);
$html="<table width:100% border=1>";
$html.="<tr><td>idevento</td> <td>funcionario_codigo</td> <td>Fecha</td> <td>Accion</td> <td>Tabla</td> <td>Estado</td> <td>idregistro</td> <td>detalle</td> <td>sql</td></tr>";

foreach($datos as $dato=>$valor){
 $html.="<tr>";
 $valor2=explode("|||", $valor);
 foreach ($valor2 as $key => $value) {
     $html.="<td>".$value."</td>";
 }
 $html.="</tr>";
}
$html.="</table>";
echo $html;
?>