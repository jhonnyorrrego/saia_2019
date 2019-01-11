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

if(@$_REQUEST['categoria']){
	$datos=busca_filtro_tabla("DISTINCT ".$_REQUEST['campo'],$_REQUEST['tabla'],$_REQUEST['campo']." LIKE ('".$_REQUEST['categoria']."%')");
	$html="<ul>";
	if($datos['numcampos']){ 
		for($i=0;$i<$datos['numcampos'];$i++){
			$html.="<li onclick=\"cargar_datos('".$datos[$i][$_REQUEST['campo']]."','".$_REQUEST['campo']."','".$_REQUEST['div']."')\">
			".$datos[$i][$_REQUEST['campo']]."</li>";
		}
	}
	else{
		$html.="<li>No hay coincidencias</li>";
	}
	$html.="</ul>";
	echo $html;	
}
