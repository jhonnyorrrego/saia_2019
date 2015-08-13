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
include_once($ruta_db_superior."formatos/librerias/estilo_formulario.php");
$id=$_REQUEST["id"];
$contenido=busca_filtro_tabla("","contenidos_carrusel a","idcontenidos_carrusel=".$id,"",$conn);
$tabla='';
$tabla.='<table style="width:100%;font-family:arial">';
$tabla.='<tr><td class="encabezado" style="text-align:center">Informaci&oacute;n adicional</td></tr>';
$tabla.='<tr><td>'.$contenido[0]["contenido"].'</td></tr>';
$tabla.='</table>';
echo $tabla;
?>