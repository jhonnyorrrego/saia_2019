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


$date = date( "Y-m-d" );
$ayer = date( "Y-m-d", strtotime( "-1 day", strtotime( $date ) ) );   	
	
$where_adicional="(responsable_tarea=".usuario_actual('idfuncionario')." )";
$where_restriccion=" AND generica=0 AND listado_tareas_fk<>-1 AND (fecha_planeada<>'0000-00-00 00:00:00' AND fecha_planeada IS NOT NULL) ";
$tareas_pendientes_dia=busca_filtro_tabla(fecha_db_obtener('fecha_planeada','Y-m-d').' AS fecha_planeada,idtareas_listado','tareas_listado',$where_adicional.$where_restriccion.' AND '.fecha_db_obtener('fecha_planeada','Y-m-d').'="'.$ayer.'"','',$conn);
			
			
			
$restar_avances_dia=0;
for($i=0;$i<$tareas_pendientes_dia['numcampos'];$i++){
				
	$avances_registrados_dia=busca_filtro_tabla("","tareas_listado_tiempo","fk_tareas_listado=".$tareas_pendientes_dia[$i]['idtareas_listado']." AND funcionario_idfuncionario=".usuario_actual('idfuncionario')." AND ".fecha_db_obtener('fecha_registro','Y-m-d')."='".$ayer."'","",$conn);
				
	if($avances_registrados_dia['numcampos']){
		$restar_avances_dia++;
	}
}
$cantidad_tareas_pendienties_dia=$tareas_pendientes_dia['numcampos']-$restar_avances_dia;
if($cantidad_tareas_pendienties_dia>0){
	
	$plural='';
	if($cantidad_tareas_pendienties_dia>1){
		$plural='s';
	}
	
	$mensaje=('<span class="badge" id="contenedor_cantidad_tareas_pendientes_dia">Usted tiene '.$cantidad_tareas_pendienties_dia.' tarea'.$plural.' planeada'.$plural.' sin registrar avance ayer '.$ayer.'</span>');
}



echo(json_encode( array('cantidad'=>$cantidad_tareas_pendienties_dia,'mensaje'=>$mensaje) ));

?>