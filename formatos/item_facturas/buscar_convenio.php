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
if(isset($_REQUEST['nombre_convenio'])){
	$datos=busca_filtro_tabla("","cf_convenios","estado=1 and (nombre like '%".$_REQUEST['nombre_convenio']."%')","",$conn);
	$html="<ul>";
	if($datos['numcampos']){
		for($i=0;$i<$datos['numcampos'];$i++){
			$html.="<li onclick=\"cargar_datos(".$datos[$i]['idcf_convenios'].",'".ucfirst(utf8_encode(html_entity_decode($datos[$i]['nombre'])))."')\">
		".ucfirst(utf8_encode(html_entity_decode($datos[$i]['nombre'])))."</li>";
		}
	}else{
		$html.="<li onclick=\"cargar_datos(0)\">No hay coincidencias</li>";
	}
	$html.="</ul>";
	echo $html;	
}
?>