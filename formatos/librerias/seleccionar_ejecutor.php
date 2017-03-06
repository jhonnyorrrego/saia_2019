<?php
$q =$_GET["q"];
if (!$q) return;
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
$where = ' and ejecutor_idejecutor=idejecutor';
$tabla = ',datos_ejecutor';
$select = 'distinct(idejecutor),nombre,identificacion';

if(@$_REQUEST["tipo"])
  $tipo=@$_REQUEST["tipo"];
else $tipo="nombre";
if($tipo == 'codigo'){
	$tabla = ',datos_ejecutor';
	$where = ' and ejecutor_idejecutor=idejecutor';
	$select = 'distinct(idejecutor),nombre,identificacion';
}

$busqueda=busca_filtro_tabla("".$select,"ejecutor".$tabla,"lower(".$tipo.") LIKE lower('".$q."%')".$where,"",$conn);

for($i=0;$i<$busqueda["numcampos"];$i++){
  echo $busqueda[$i]["idejecutor"]."|".(html_entity_decode(($busqueda[$i]["nombre"])))."|".$busqueda[$i]["identificacion"]."|".$q."|".codifica_encabezado(html_entity_decode($busqueda[$i]["nombre"]));
  //if($tipo == 'codigo')
  	echo "|".$busqueda[$i]["codigo"];
  echo "\n";
}
return;
?>
