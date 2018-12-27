<?php

/*$q =$_GET["q"];
if (!$q) return;*/
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
$select = 'distinct(idejecutor),nombre,identificacion,direccion,titulo,telefono,cargo,email';

if(@$_REQUEST["tipo"]){
  $tipo=@$_REQUEST["tipo"];
}else{
	$tipo="nombre";
}
if($tipo == 'codigo'){
	$tabla = ',datos_ejecutor';
	$where = ' and ejecutor_idejecutor=idejecutor';
	$select = 'distinct(idejecutor),nombre,identificacion';
}
$where_estado=' and estado=1';
$busqueda=busca_filtro_tabla("".$select,"ejecutor".$tabla,"lower(".$tipo.") LIKE lower('".$_REQUEST['nombre']."%')".$where.$where_estado,"",$conn);

if($busqueda['numcampos']){
	$html='<ul class="list-group">';
	for($i=0;$i<$busqueda["numcampos"];$i++){
		foreach ($busqueda[$i] as $key => $value) {
			if(!$busqueda[$i][$key]){
				$busqueda[$i][$key]='';
			}
		}	
		$html.="<li class='list-group-item' onclick=\"cargar_datos(".$busqueda[$i]["idejecutor"].",'".html_entity_decode($busqueda[$i]["nombre"])."','".$busqueda[$i]["identificacion"]."','".$busqueda[$i]["direccion"]."','".$busqueda[$i]["titulo"]."','".$busqueda[$i]["telefono"]."','".$busqueda[$i]["cargo"]."','".$busqueda[$i]["email"]."')\">".codifica_encabezado(html_entity_decode($busqueda[$i]["nombre"]))."</li>";	
			if($tipo == 'codigo'){
				$html.="<li onclick=\"cargar_datos(".$busqueda[$i]["idejecutor"].",'".html_entity_decode($busqueda[$i]["nombre"])."','".$busqueda[$i]["identificacion"]."','".$busqueda[$i]["direccion"]."','".$busqueda[$i]["codigo"]."')\">".codifica_encabezado(html_entity_decode($busqueda[$i]["nombre"]))."</li>";				
			}		
	 	/*echo $busqueda[$i]["idejecutor"]."|".(html_entity_decode(($busqueda[$i]["nombre"])))."|".$busqueda[$i]["identificacion"]."|".$q."|".codifica_encabezado(html_entity_decode($busqueda[$i]["nombre"]));
	  	//if($tipo == 'codigo')
	  	echo "|".$busqueda[$i]["codigo"];
	  	echo "\n";*/
	}
$html.="</ul>";
}else{
	$html='';
}
echo $html;

?>
