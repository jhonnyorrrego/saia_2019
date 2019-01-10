<?php    
// Inicialiacin de las variables del calendario del planeador

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
include_once($ruta_db_superior."pantallas/lib/librerias_fechas.php");
$arreglo=array("exito"=>0);

$fun=usuario_actual('idfuncionario');
$where_adicional=" AND FIND_IN_SET('".usuario_actual('idfuncionario')."', seguidores)";
$where_restriccion=" AND generica=0 AND cod_padre=0 AND listado_tareas_fk<>-1 AND estado_tarea NOT IN('CANCELADA','STAND BY','TERMINADO') AND progreso<>100";
$datos=busca_filtro_tabla("","tareas_listado"," fecha_inicio> ".fecha_db_obtener("'".$_REQUEST["start"]."'","Y-m-d")." AND fecha_limite < ".fecha_db_obtener("'".$_REQUEST["end"]."'","Y-m-d").$where_adicional.$where_restriccion,"",$conn);



//print_r($datos);
if($datos["numcampos"]){
	$arreglo["exito"]=1;
	$arreglo["rows"]=array();
	for($i=0;$i<$datos["numcampos"];$i++){
		$funcionarios=busca_filtro_tabla("","vfuncionario_dc","idfuncionario IN(".$datos[$i]["responsable_tarea"].")","",$conn);
		if($funcionarios["numcampos"]){
			$responsables=array();
			for($j=0;$j<$funcionarios["numcampos"];$j++){
				$primer_nombre=explode(' ',$funcionarios[$j]["nombres"]);
				$primer_apellido=explode(' ',$funcionarios[$j]["apellidos"]);
				$nombre_fun=$primer_nombre[0].' '.$primer_apellido[0];
				$nombre_fun=strtolower($nombre_fun);
				$nombre_fun=ucwords($nombre_fun);
				$nombre_fun=html_entity_decode($nombre_fun);
				$nombre_fun=codifica_encabezado($nombre_fun);
				array_push($responsables,$nombre_fun);
			}
		}
		
		$interval=resta_dos_fechas_saia($datos[$i]['fecha_limite']);
		if($interval->invert==1){
			if($interval->days>5){
				$color='#306609';   //verde
			}else if($interval<=5){
				$color='#B5B545';   //amarillo
			}
			
		}else{
			if($interval->days==0){
				$color='#B5B545';  //amarillo
			}else{
				$color='#FF0000';   //rojo
			}
			
		}
		
		//$url="pantallas/tareas_listado/principal_listados_tareas_calendarios.php?rol_tareas=tarea_unica&click=tareas&idtareas_listado_unico=".$datos[$i]["idtareas_listado"];
		$componente_tareas=busca_filtro_tabla("idbusqueda_componente","busqueda_componente"," lower(nombre)='tareas_listado_reporte' ","",$conn);
		$url="pantallas/busquedas/consulta_busqueda_subtareas_listado.php?idbusqueda_componente=".$componente_tareas[0]['iidbusqueda_componente']."&ocultar_subtareas=1&rol_tareas=tarea_unica&click=tareas&idtareas_listado_unico=".$datos[$i]["idtareas_listado"];
		
		array_push($arreglo["rows"],array("id"=>$datos[$i]["idtareas_listado"],"titulo"=>$datos[$i]["nombre_tarea"]."\n(".implode(",",$responsables).")","inicio"=>$datos[$i]["fecha_limite"],"fin"=>$datos[$i]["fecha_limite"],"url"=>$url,"color"=>$color,"hs"=>1));
	}	
}


echo(json_encode($arreglo));
?>