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

$_REQUEST["idtareas_listado"]=494;


	  $involucrados=busca_filtro_tabla("responsable_tarea,co_participantes,seguidores,evaluador","tareas_listado","idtareas_listado=".$_REQUEST["idtareas_listado"],"",$conn);
	  
	  $funcod_involucrados=array();
	  array_push($funcod_involucrados,$involucrados[0]['responsable_tarea']);
	  array_push($funcod_involucrados,$involucrados[0]['evaluador']);
	  
	  
	  $funcod_involucrados= array_merge ( $funcod_involucrados, explode(',',$involucrados[0]['co_participantes']) );
      $funcod_involucrados=array_merge ( $funcod_involucrados, explode(',',$involucrados[0]['seguidores']) );
      $funcod_involucrados=array_unique($funcod_involucrados);
      $funcod_involucrados=array_values($funcod_involucrados);
      print_r($funcod_involucrados);
     
?>