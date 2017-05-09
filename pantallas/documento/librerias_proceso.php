<?php
$max_salida = 6; // Previene algun posible ciclo infinito limitando a 10 los ../
$ruta_db_superior = $ruta = "";
while ($max_salida > 0) {
    if (is_file($ruta . "db.php")) {
        $ruta_db_superior = $ruta; //Preserva la ruta superior encontrada
    }
    $ruta.="../";
    $max_salida--;
}
include_once($ruta_db_superior . "db.php");

function filtro_consulta_vista($iddoc,$destino){
			
	$enviados = busca_filtro_tabla("DISTINCT documento_iddocumento","asignacion","entidad_identidad=1 AND llave_entidad='".usuario_actual("funcionario_codigo")."' AND  estado='PENDIENTE' AND tarea_idtarea=2","",$conn);	
	
			
	$iddocumento=extrae_campo($enviados,"documento_iddocumento");
	$iddocumento=array_unique($iddocumento);	
	$iddocumento = implode(",",$iddocumento);
	
	if($enviados['numcampos']){
		return " (A.origen=".usuario_actual("funcionario_codigo")." OR A.destino=".usuario_actual("funcionario_codigo").") AND A.iddocumento NOT IN (".$iddocumento.") ";	
	}else{
		return "(A.origen=".usuario_actual("funcionario_codigo")." OR A.destino=".usuario_actual("funcionario_codigo").")";
	}
	
}

function filtro_consulta($iddoc){
	global $conn,$start;
	$destino =  usuario_actual("funcionario_codigo");
	$doc_usuario="SELECT DISTINCT iddocumento,1 as creado, d.fecha FROM buzon_salida s,documento d WHERE s.archivo_idarchivo=d.iddocumento AND s.nombre IN('BORRADOR', 'REVISADO', 'RESPONDIDO', 'TRAMITE', 'TRANSFERIDO', 'DEVOLUCION','APROBADO', 'TERMINADO', 'DELEGADO', 'DISTRIBUCION') AND d.estado IN('APROBADO', 'ACTIVO','ANULADO') AND s.origen ='".$destino."' ORDER BY d.fecha desc";
	$enviados = "SELECT DISTINCT documento_iddocumento FROM asignacion WHERE entidad_identidad=1 and llave_entidad='".$destino."' and  estado='PENDIENTE' and tarea_idtarea=2";
	$rs = phpmkr_query($doc_usuario);
	$vector=array();
	while($vector[]=phpmkr_fetch_array($rs));
	@phpmkr_free_result($rs);
	$rs2= phpmkr_query($enviados);
	$l_enviados=array();
	while($fila=phpmkr_fetch_array($rs2)){
		$l_enviados[]=$fila[0];
	}
	@phpmkr_free_result($rs2); 
	$resultados=array();
	foreach($vector as $fila){
		if(!in_array($fila[0],$l_enviados) && $fila[0]<>"")
	    $resultados[]=$fila[0];
	}   
	if($datos["numcampos"]){  
	   if(is_array($resultados)){
	   		$resultados=array_unique($resultados);
	     }
	}
	$count=count($resultados);
	if($count){
	  $start=0;
	  $resultados2=array_slice($resultados,@$_REQUEST["actual_row"],@$_REQUEST["rows"],true);
		return " AND iddocumento in (".implode(",",$resultados2).") ";
	}
	else{
    return " AND iddocumento in (0) ";
  }
}

function filtro_consulta_($iddoc){
	global $conn,$start;
	$destino=usuario_actual("funcionario_codigo");
	return "origen='".$destino."'";
}

function tabla_adicional_proceso(){
	$cadena="a.iddocumento=c.iddocumento and c.llave_entidad=".usuario_actual('funcionario_codigo');
	return($cadena);
}

function filtro_consulta_proceso($iddoc){
	global $conn;
	$destino=usuario_actual("funcionario_codigo");
	return($destino);
}
?>