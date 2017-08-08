<?php
$max_salida=6; // Previene algun posible ciclo infinito limitando a 10 los ../
$ruta_db_superior=$ruta="";
while($max_salida>0){
  if(is_file($ruta."db.php")){
    $ruta_db_superior=$ruta; //Preserva la ruta superior encontrada
  }
  $ruta.="../";
  $max_salida--;
}
include_once($ruta_db_superior."db.php");
include_once($ruta_db_superior."librerias_saia.php");

$busca_formatos_eliminar=busca_filtro_tabla("idformato,nombre","formato","nombre not in('carta','memorando','radicacion_entrada','vision_calidad','mision_calidad','politica_calidad','objetivos_calidad','proceso','caracterizacion','procedimientos','formatos_proceso','indicadores','instructivos','guias','manuales','otros','radicacion_salida')","",$conn); //Formatos base en la instalacion

for($i=0;$i<$busca_formatos_eliminar['numcampos'];$i++){
	$elimina_campos_formato="DELETE FROM campos_formato WHERE formato_idformato=".$busca_formatos_eliminar[$i]['idformato'];
	echo($elimina_campos_formato);
	echo ("<br />");

	$busca_funciones_formato=busca_filtro_tabla("","funciones_formato","formato='".$busca_formatos_eliminar[$i]['idformato']."'","",$conn);

	for($j=0;$j<$busca_funciones_formato['numcampos'];$j++){
		echo ("FUNCIONES DEL FORMATO ".$busca_formatos_eliminar[$i]['nombre']." ".$busca_formatos_eliminar[$i]['idformato']);
		echo ("<br />");
		echo ($busca_funciones_formato[$j]['nombre_funcion']." ".$busca_funciones_formato[$j]['idfunciones_formato']);
		echo ("<br />");
		if($busca_funciones_formato[$j]['ruta']=='funciones.php'){
			echo ("RUTA: ".$ruta_db_superior.FORMATOS_CLIENTE.$busca_formatos_eliminar[$i]["nombre"]."/funciones.php");
		}else{
			echo ("RUTA: ".$ruta_db_superior."/".$busca_formatos_eliminar[$i]["nombre"]);
		}
		echo ("<br />");
		$elimina_funcion_formato="DELETE FROM funciones_formato WHERE idfunciones_formato=".$busca_funciones_formato[$j]['idfunciones_formato'];
		echo($elimina_funcion_formato);
		echo ("<br />");
		phpmkr_query($elimina_funcion_formato);
	}
	phpmkr_query($elimina_campos_formato);
	echo ("<br />");
	$elimina_formato="DELETE FROM formato WHERE idformato=".$busca_formatos_eliminar[$i]['idformato'];
	phpmkr_query($elimina_formato);
	echo($elimina_formato);
	echo ("<br />");
	echo("--------------------------------------------------------------------------------------");
	echo ("<br />");
}
echo("FORMATOS ELIMINADOS");
?>