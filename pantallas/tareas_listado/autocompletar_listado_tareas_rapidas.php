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
include_once($ruta_db_superior."class.funcionarios.php");

if(isset($_REQUEST['nombre_lista'])){
	
	$datos=busca_filtro_tabla("a.idlistado_tareas,a.nombre_lista","listado_tareas a","a.creador_lista=".usuario_actual('idfuncionario')." AND lower(a.nombre_lista) LIKE'%".strtolower($_REQUEST['nombre_lista'])."%'","",$conn);

	$html="<ul>";
	if($datos['numcampos']){
		
		for($j=0;$j<$datos['numcampos'];$j++){;
			$descripcion=$datos[$j]['nombre_lista'];
			$html.="<li onclick=\"cargar_datos_listado_tareas(".$datos[$j]['idlistado_tareas'].",'".$descripcion."')\">".$descripcion."</li>";

		}

		if($html=="<ul>"){
			$html.="<li onclick=\"cargar_datos_listado_tareas(0)\">NO hay listados con el nombre ingresado</li>";
		}
		
	}else{
		$html.="<li onclick=\"cargar_datos_listado_tareas(0)\">NO hay listados con el nombre ingresado</li>";
	}

$html.="</ul>";
echo($html);
}	

?>