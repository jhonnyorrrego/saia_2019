<?php    
// Inicialiacin de las variables del calendario del planeador
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
include_once($ruta_db_superior."pantallas/lib/librerias_fechas.php");
$arreglo=array("exito"=>0);
$idfuncionario=usuario_actual('idfuncionario');

$where_adicional=" AND (a.responsable_tarea=".$idfuncionario."  OR (a.co_participantes LIKE '%,".$idfuncionario."' OR a.co_participantes LIKE'".$idfuncionario.",%' OR a.co_participantes LIKE'%,".$idfuncionario.",%' OR a.co_participantes='".$idfuncionario."' OR a.co_participantes=".$idfuncionario." )) AND b.funcionario_idfuncionario=".$idfuncionario;

$where_restriccion=" AND a.generica=0 AND a.listado_tareas_fk<>-1 AND (b.fecha_planeada<>'0000-00-00 00:00:00' AND b.fecha_planeada IS NOT NULL) ";


$datos=busca_filtro_tabla("a.nombre_tarea,a.fecha_limite,a.idtareas_listado,b.fecha_planeada,b.fecha_planeada_fin","tareas_listado a LEFT JOIN tareas_planeadas b ON a.idtareas_listado=b.fk_tareas_listado"," b.fecha_planeada>= ".fecha_db_obtener("'".$_REQUEST["start"]."'","Y-m-d")." AND b.fecha_planeada <= ".fecha_db_obtener("'".$_REQUEST["end"]."'","Y-m-d").$where_adicional.$where_restriccion,"GROUP BY a.idtareas_listado",$conn);




if($datos["numcampos"]){
  $arreglo["exito"]=1;
  $arreglo["rows"]=array();
  for($i=0;$i<$datos["numcampos"];$i++){
    $interval=resta_dos_fechas_saia($datos[$i]['fecha_limite']);
    if($interval->invert==1){
      if($interval->days>5){
        $color='#306609';   //verde
      }else if($interval<=5){
        $color='#CCCC21';   //amarillo
      }
    }else{
      if($interval->days==0){
        $color='#CCCC21';  //amarillo
      }else{
        $color='#FF0000';   //rojo
      }
    } 
    //$url="pantallas/tareas_listado/principal_listados_tareas_calendarios.php?rol_tareas=tarea_unica&click=tareas&idtareas_listado_unico=".$datos[$i]["idtareas_listado"];
    $componente_tareas=busca_filtro_tabla("idbusqueda_componente","busqueda_componente"," lower(nombre)='tareas_listado_reporte' ","",$conn);
  $url="pantallas/busquedas/consulta_busqueda_subtareas_listado.php?idbusqueda_componente=".$componente_tareas[0]['idbusqueda_componente']."&ocultar_subtareas=1&rol_tareas=tarea_unica&click=tareas&idtareas_listado_unico=".$datos[$i]["idtareas_listado"];
    array_push($arreglo["rows"],array("id"=>$datos[$i]["idtareas_listado"],"titulo"=>codifica_encabezado(html_entity_decode($datos[$i]["nombre_tarea"]))."\n(".$datos[$i]["fecha_limite"].")","inicio"=>$datos[$i]["fecha_planeada"],"fin"=>$datos[$i]["fecha_planeada_fin"],"url"=>$url,"color"=>$color,"hs"=>1));
  } 
}
echo(json_encode($arreglo));
?>