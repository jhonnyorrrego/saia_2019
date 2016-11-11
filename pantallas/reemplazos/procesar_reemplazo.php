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
include_once($ruta_db_superior."db.php");
include_once($ruta_db_superior."class_transferencia.php");
include_once($ruta_db_superior."librerias_saia.php");

if(@$_REQUEST["idreemplazo_saia"]){
  if(@$_REQUEST["accion"]=="procesar_reemplazo"){
    $retorno=procesar_reemplazo($_REQUEST["idreemplazo_saia"]);
    if($_REQUEST["idbusqueda_componente"] && $retorno['exito']){
      redirecciona($ruta_db_superior."pantallas/busquedas/consulta_busqueda_reemplazo.php?idbusqueda_componente=".$_REQUEST["idbusqueda_componente"]."&idreemplazo=".$_REQUEST["idreemplazo_saia"]);
    }else{
    	print_r($retorno);
			die();
    }
  }
  if(@$_REQUEST["accion"]=="inactivar_reemplazo"){
    $retorno=inactivar_reemplazo($_REQUEST["idreemplazo_saia"]);
		if($_REQUEST["idbusqueda_componente"] && $retorno){
      abrir_url($ruta_db_superior."pantallas/busquedas/consulta_busqueda.php?idbusqueda_componente=".$_REQUEST["idbusqueda_componente"],"_self");
    }
  }
}

function procesar_reemplazo($idreemplazo){
	$retorno=array();
	$retorno['exito']=0;
  $reemplazo=busca_filtro_tabla("idreemplazo_saia,antiguo,nuevo,".fecha_db_obtener("fecha_inicio","Y-m-d")." as fecha_inicio,".fecha_db_obtener("fecha_fin","Y-m-d")." as fecha_fin,cargo_nuevo,estado,tipo_reemplazo,observaciones","reemplazo_saia","idreemplazo_saia=".$idreemplazo,"",$conn);
  $validar_reemplazo=validar_reemplazo($reemplazo);
  if($reemplazo["numcampos"] && $validar_reemplazo["exito"] && $reemplazo[0]["estado"]){
    $equivalencias_reemplazo=buscar_equivalencias_reemplazo($reemplazo[0]["antiguo"],$reemplazo[0]["nuevo"],$reemplazo);
    $documentos_pendientes=listado_documentos_reemplazo($reemplazo[0]["antiguo"],$reemplazo[0],$equivalencias_reemplazo["roles"]);
  	foreach($documentos_pendientes AS $key=>$valor){
      $reemplazos_existe=busca_filtro_tabla("A.idreemplazo_saia,A.antiguo,A.nuevo,".fecha_db_obtener("A.fecha_inicio","Y-m-d")." as fecha_inicio,".fecha_db_obtener("A.fecha_fin","Y-m-d")." as fecha_fin,A.cargo_nuevo,A.estado,A.tipo_reemplazo,A.observaciones,B.*","reemplazo_saia A,reemplazo_documento B","A.idreemplazo_saia=B.fk_idreemplazo_saia AND A.antiguo=".$reemplazo[0]["antiguo"]." AND A.nuevo=".$reemplazo[0]["nuevo"]." AND documento_iddocumento=".$valor,"",$conn);
      if(!$reemplazos_existe["numcampos"]){
        $sql2="INSERT INTO reemplazo_documento(documento_iddocumento,fk_idreemplazo_saia,estado,tipo_reemplazo_doc) VALUES(".$valor.",".$idreemplazo.",2,1)";
       	phpmkr_query($sql2);
				//ACTUALIZO LAS RUTAS DE LOS DOCUMENTOS
				if(count($equivalencias_reemplazo["roles"]) && count($equivalencias_reemplazo["funcionario_codigo"])){
		      actualizar_ruta_reemplazo($valor,$equivalencias_reemplazo);
		    }
      }
    }
    transferencia_delegado($reemplazo[0]["antiguo"],$reemplazo[0]["nuevo"],$idreemplazo);
    actualizar_funcionarios_reemplazo($equivalencias_reemplazo);
    insertar_reemplazo_expediente($idreemplazo);
    
    
    
    $retorno['exito']=1;
  }else if($validar_reemplazo["exito"]==0){
   $retorno['error']= $validar_reemplazo["error"];
  }
	return($retorno);
}


function validar_reemplazo($reemplazo,$fecha_ini='',$fecha_fin=''){
$retorno=array("exito"=>1);
if($fecha_ini==''){
  $fecha_ini=date("Y-m-d");
}
if($reemplazo["numcampos"]){
  if($fecha_ini<date("Y-m-d")){
    $retorno["exito"]=0;
    $retorno["error"][]="La fecha inicial no puede ser menor que hoy.";
  }
  if($reemplazo[0]["antiguo"]==''||$reemplazo[0]["antiguo"]==0){
    $retorno["exito"]=0;
    $retorno["error"][]="El funcionario a ser reemplazado no puede ser nulo.";
  }
}
return($retorno);
}

function listado_documentos_reemplazo($funcionario_codigo,$reemplazo,$equivalencia){
global $conn;
$resultados = array();
//PENDIENTES DE APROBAR ENTRE LAS FECHAS EN QUE ESTA INACTIVO EL FUNCIONARIO
$doc_usuario=busca_filtro_tabla("iddocumento","buzon_entrada A,documento B","A.archivo_idarchivo=B.iddocumento AND B.estado not in ('ELIMINADO','ANULADO') AND B.numero=0 AND (A.fecha>=".fecha_db_obtener("'".$reemplazo["fecha_inicio"]."'","Y-m-d")." AND A.fecha<=".fecha_db_obtener("'".$reemplazo["fecha_fin"]."'","Y-m-d").") AND (A.nombre ='POR_APROBAR' OR A.nombre='APROBADO' OR A.nombre='REVISADO') AND (A.origen=".$funcionario_codigo." OR A.destino=".$funcionario_codigo.")","GROUP BY B.iddocumento",$conn);
if ($doc_usuario["numcampos"]){
    for($i=0;$i<$doc_usuario["numcampos"];$i++){
    	$resultados[] = $doc_usuario[$i]["iddocumento"];
    }
}
//DOCUMENTOS PENDIENTES DE APROBAR QUE TIENE EL FUNCIONARIO
//SE TRABAJA SOBRE RUTA POR RENDIMIENTO DEBIDO A QUE BUZON SIEMPRE CONTIENE DEMASIADOS REGISTROS
$roles=array();
foreach($equivalencia AS $key=>$valor){
	$roles[]=$valor[0];
}

$doc_ruta=busca_filtro_tabla("r.idruta,d.iddocumento","ruta r, documento d","r.documento_iddocumento=d.iddocumento AND r.tipo='ACTIVO' AND ((r.origen=".$funcionario_codigo." AND tipo_origen=1) OR (r.origen in (".implode(",", $roles).") AND tipo_origen=5)) AND d.numero=0","",$conn);
for($i=0;$i<$doc_ruta['numcampos'];$i++){
	$doc_usuario_pend=busca_filtro_tabla("","buzon_entrada","nombre='POR_APROBAR' AND activo=1 and ruta_idruta=".$doc_ruta[$i]['idruta'],"",$conn);
	if ($doc_usuario_pend["numcampos"]){
		$resultados[] = $doc_ruta[$i]["iddocumento"];
	}
}
$por_aprobar = array_unique($resultados);
return($por_aprobar);
}

function buscar_equivalencias_reemplazo($origen,$destino,$reemplazo){
$retorno=array();
$retorno['msn']="";
$retorno["roles"]=array();
$funcionario_origen=busca_filtro_tabla("idfuncionario,nombres,apellidos,idcargo,cargo,iddependencia,dependencia,iddependencia_cargo,".fecha_db_obtener("fecha_final","Y-m-d")." AS fecha_final","vfuncionario_dc","funcionario_codigo=".$origen." AND estado=1 AND estado_dc=1","",$conn);
$funcionario_destino1=busca_filtro_tabla("idfuncionario,nombres,apellidos,idcargo,cargo,iddependencia,dependencia,iddependencia_cargo,".fecha_db_obtener("fecha_final","Y-m-d")." AS fecha_final","vfuncionario_dc","funcionario_codigo=".$destino." AND estado=1 AND estado_dc=1","",$conn);
$equivalencias=busca_filtro_tabla("A.*","reemplazo_equivalencia A,reemplazo_saia B","A.fk_idreemplazo_saia=B.idreemplazo_saia AND A.fk_idreemplazo_saia=".$reemplazo[0]["idreemplazo_saia"]." AND B.estado=1","",$conn);

if($funcionario_origen["numcampos"] && !$equivalencias["numcampos"]){
  $retorno["funcionario_codigo"]=array($origen,$destino);
  $sql2="INSERT INTO reemplazo_equivalencia(entidad_identidad,llave_entidad_origen,llave_entidad_destino,fk_idreemplazo_saia) VALUES(1,".$origen.",".$destino.",".$reemplazo[0]["idreemplazo_saia"].")";
  phpmkr_query($sql2);
  $retorno["idfuncionario"]=array($funcionario_origen[0]["idfuncionario"],$funcionario_destino1[0]["idfuncionario"]);
  $sql2="INSERT INTO reemplazo_equivalencia(entidad_identidad,llave_entidad_origen,llave_entidad_destino,fk_idreemplazo_saia) VALUES(0,".$funcionario_origen[0]["idfuncionario"].",".$funcionario_destino1[0]["idfuncionario"].",".$reemplazo[0]["idreemplazo_saia"].")";
  phpmkr_query($sql2);
  for($i=0;$i<$funcionario_origen["numcampos"];$i++){
      $funcionario_destino=busca_filtro_tabla("","vfuncionario_dc","funcionario_codigo=".$destino." AND iddependencia=".$funcionario_origen[$i]["iddependencia"]." AND (cargo='".str_replace(" (E)","",$funcionario_origen[$i]["cargo"])." (E)') AND estado=1 and estado_dc=1","",$conn);
      $cargoe=busca_filtro_tabla("","cargo","nombre ='".str_replace(" (E)","",$funcionario_origen[$i]["cargo"])." (E)'","",$conn);
      if(!$cargoe["numcampos"]){
        $cargo=busca_filtro_tabla("","cargo","idcargo=".$funcionario_origen[$i]["idcargo"],"",$conn);
        if(substr($cargo[0]["nombre"],-4)!=" (E)"){
          $sql2="INSERT INTO cargo(nombre,cod_padre,codigo_cargo,tipo,estado)VALUES('".$funcionario_origen[$i]["cargo"]." (E)','".$cargo[0]["cod_padre"]."','".$cargo[0]["codigo_cargo"]."','".$cargo[0]["tipo"]."',1)";
          phpmkr_query($sql2);
          $cargoe[0]["idcargo"]=phpmkr_insert_id();
          if($cargoe[0]["idcargo"]){
            $cargoe["numcampos"]=1;
            $retorno['msn'].='Cargo '.$funcionario_origen[$i]["cargo"].' (E) creado - ';
          }
        }else{
          $cargoe[0]["idcargo"]=$cargo[0]["idcargo"];
          $cargoe["numcampos"]=1;
          $retorno['msn'].='Cargo '.$funcionario_origen[$i]["cargo"].' (E) Seleccionado -';
        }
      }
      if($funcionario_destino["numcampos"]){
        $sql2="INSERT INTO reemplazo_equivalencia(entidad_identidad,llave_entidad_origen,llave_entidad_destino,fk_idreemplazo_saia) VALUES(5,".$funcionario_origen[$i]["iddependencia_cargo"].",".$funcionario_destino[0]["iddependencia_cargo"].",".$reemplazo[0]["idreemplazo_saia"].")";
        phpmkr_query($sql2);

        if(phpmkr_insert_id()){
          array_push($retorno["roles"],array($funcionario_origen[$i]["iddependencia_cargo"],$funcionario_destino[0]["iddependencia_cargo"]));
        }else{
          $retorno['msn'].='Error al cargar el funcionario: '.$funcionario_origen[$i]["nombres"]." ".$funcionario_origen[$i]["apellidos"]." -";
        }
      }else{
				if($reemplazo[0]['tipo_reemplazo']==2){// definitivo
					$fecha_fin_reemplazo=fecha_db_almacenar($funcionario_origen[$i]["fecha_final"],"Y-m-d");
				}else{//temporal
					$fecha_fin_reemplazo=fecha_db_almacenar($reemplazo[0]["fecha_fin"],"Y-m-d");
				}
        $sql2="INSERT INTO dependencia_cargo(funcionario_idfuncionario,dependencia_iddependencia,cargo_idcargo,estado,fecha_inicial,fecha_final,fecha_ingreso) VALUES(".$retorno["idfuncionario"][1].",".$funcionario_origen[$i]["iddependencia"].",".$cargoe[0]["idcargo"].",1,".fecha_db_almacenar($reemplazo[0]["fecha_inicio"],"Y-m-d").",".$fecha_fin_reemplazo.",".fecha_db_almacenar(date("Y-m-d"),"Y-m-d").")";
        phpmkr_query($sql2);
        $iddependencia_cargo=phpmkr_insert_id();
        if($iddependencia_cargo){
          $sql2="INSERT INTO reemplazo_equivalencia(entidad_identidad,llave_entidad_origen,llave_entidad_destino,fk_idreemplazo_saia) VALUES(5,".$funcionario_origen[$i]["iddependencia_cargo"].",".$iddependencia_cargo.",".$reemplazo[0]["idreemplazo_saia"].")";
          phpmkr_query($sql2);
          array_push($retorno["roles"],array($funcionario_origen[$i]["iddependencia_cargo"],$iddependencia_cargo));
        }else{
          $retorno['msn'].='Error al cargar el funcionario: '.$funcionario_origen[$i]["nombres"]." ".$funcionario_origen[$i]["apellidos"]." -";
        }
      }
  }
}else if($equivalencias["numcampos"]){
  for($i=0;$i<$equivalencias["numcampos"];$i++){
    if($equivalencias[$i]["entidad_identidad"]==0){
      $retorno["idfuncionario"]=array($equivalencias[$i]["llave_entidad_origen"],$equivalencias[$i]["llave_entidad_destino"]);
    }
    else if($equivalencias[$i]["entidad_identidad"]==1){
      $retorno["funcionario_codigo"]=array($equivalencias[$i]["llave_entidad_origen"],$equivalencias[$i]["llave_entidad_destino"]);
    }
    else if($equivalencias[$i]["entidad_identidad"]==5){
      array_push($retorno["roles"],array($equivalencias[$i]["llave_entidad_origen"],$equivalencias[$i]["llave_entidad_destino"]));
    }
  }
}
return($retorno);
}


function transferencia_delegado($origen,$destino,$idreemplazo){
$doc_usuario = busca_filtro_tabla("distinct documento_iddocumento", "asignacion", "entidad_identidad=1 and llave_entidad = '".$origen."' and tarea_idtarea=2 and estado = 'PENDIENTE'", "", $conn);
	for($i=0;$i<$doc_usuario["numcampos"];$i++){
	  $datos["archivo_idarchivo"]=$doc_usuario[$i]["documento_iddocumento"];
	  $datos["nombre"]="DELEGADO";
	  $datos["tipo_destino"]=1;
	  $datos["origen"]=$origen;
	  $destino_tramite=array($destino);
	  transferir_archivo_prueba($datos,$destino_tramite,"","");
	  $sql2="INSERT INTO reemplazo_documento(documento_iddocumento,fk_idreemplazo_saia,estado,tipo_reemplazo_doc)VALUES(".$doc_usuario[$i]["documento_iddocumento"].",".$idreemplazo.",2,2)";
	  phpmkr_query($sql2);
	}
}


function actualizar_ruta_reemplazo($iddocumento,$equivalencias){
	if($equivalencias["funcionario_codigo"][0]&&$equivalencias["funcionario_codigo"][1]){
	  $sql2="UPDATE buzon_entrada SET origen=".$equivalencias["funcionario_codigo"][1]." WHERE archivo_idarchivo=".$iddocumento." AND origen=".$equivalencias["funcionario_codigo"][0]." AND nombre='POR_APROBAR' AND activo=1";
	  phpmkr_query($sql2);

	  $sql2="UPDATE buzon_entrada SET destino=".$equivalencias["funcionario_codigo"][1]." WHERE archivo_idarchivo=".$iddocumento." AND destino=".$equivalencias["funcionario_codigo"][0]." AND nombre='POR_APROBAR' AND activo=1";
	  phpmkr_query($sql2);
	  $buzon_anterior=busca_filtro_tabla("ruta_idruta","buzon_entrada","archivo_idarchivo=".$iddocumento." and destino=".$equivalencias["funcionario_codigo"][1]." AND nombre='POR_APROBAR' AND activo=1","",$conn); // utilizado para la devolucion
	  if($buzon_anterior['numcampos']){
	  	$ruta_anterior=busca_filtro_tabla("idruta","ruta","documento_iddocumento=".$iddocumento." and idruta<".$buzon_anterior[0]['ruta_idruta'],"idruta desc",$conn);
			$sql2="UPDATE buzon_entrada SET origen=".$equivalencias["funcionario_codigo"][1]." WHERE archivo_idarchivo=".$iddocumento." AND origen=".$equivalencias["funcionario_codigo"][0]." AND nombre='REVISADO' and ruta_idruta=".$ruta_anterior[0]['idruta'];
			phpmkr_query($sql2);
	  }
	}

	foreach($equivalencias["roles"] AS $key=>$valor){
		$actualiza_ruta=busca_filtro_tabla("idruta","ruta r, buzon_entrada b","r.idruta=b.ruta_idruta AND r.tipo='ACTIVO' AND b.nombre='POR_APROBAR' AND r.documento_iddocumento=".$iddocumento." AND r.origen=".$valor[0]." AND r.tipo_origen=5 AND b.activo=1 ","",$conn);
	  if($actualiza_ruta['numcampos']){// si en buzon ya ha sido aprobado por el funcionario NO cambio la ruta
	  	$sql2="UPDATE ruta SET origen=".$valor[1]." WHERE documento_iddocumento=".$iddocumento." AND origen=".$valor[0]." AND tipo_origen=5 and tipo='ACTIVO'";
	  	phpmkr_query($sql2);
	  }

	  $sql2="UPDATE ruta SET destino=".$valor[1]." WHERE documento_iddocumento=".$iddocumento." AND destino=".$valor[0]." AND tipo_destino=5 and tipo='ACTIVO'";
	  phpmkr_query($sql2);
	}
	$sql3="UPDATE ruta SET origen='".$equivalencias["funcionario_codigo"][1]."' WHERE origen=".$equivalencias["funcionario_codigo"][0]." AND tipo_origen=1 and tipo='ACTIVO' and documento_iddocumento=".$iddocumento;
	phpmkr_query($sql3);
	$sql4="UPDATE ruta SET destino='".$equivalencias["funcionario_codigo"][1]."' WHERE destino=".$equivalencias["funcionario_codigo"][0]." AND tipo_destino=1 and tipo='ACTIVO' and documento_iddocumento=".$iddocumento;
	phpmkr_query($sql4);
}

function actualizar_funcionarios_reemplazo($equivalencias_reemplazo){
	if($equivalencias_reemplazo["idfuncionario"][0]){
	  $sql2="UPDATE funcionario SET estado=0 WHERE idfuncionario=".$equivalencias_reemplazo["idfuncionario"][0];
	  phpmkr_query($sql2);
	}
	foreach($equivalencias_reemplazo["roles"] AS $key=>$valor){
	  if($equivalencias_reemplazo["roles"][$key][0]){
	    $sql2="UPDATE dependencia_cargo SET estado=0 WHERE iddependencia_cargo=".$equivalencias_reemplazo["roles"][$key][0];
	    phpmkr_query($sql2);
	  }
	}
}

function inactivar_reemplazo($idreemplazo){
$equivalencia=array();
$equivalencia["roles"]=array();
$equivalencias=busca_filtro_tabla("","reemplazo_equivalencia","fk_idreemplazo_saia=".$idreemplazo,"",$conn);

if($equivalencias["numcampos"]){
  for($i=0;$i<$equivalencias["numcampos"];$i++){
    switch($equivalencias[$i]["entidad_identidad"]){
      case 1: //actualizar el funcionario
        $sql2="UPDATE funcionario SET estado=1 WHERE funcionario_codigo=".$equivalencias[$i]["llave_entidad_origen"];
				phpmkr_query($sql2);
        $equivalencia["funcionario_codigo"][0]=$equivalencias[$i]["llave_entidad_destino"];
        $equivalencia["funcionario_codigo"][1]=$equivalencias[$i]["llave_entidad_origen"];
      break;
      case 5: //actualizar el rol
        $sql2="UPDATE dependencia_cargo SET estado=0 WHERE iddependencia_cargo=".$equivalencias[$i]["llave_entidad_destino"];
        phpmkr_query($sql2);
        $sql2="UPDATE dependencia_cargo SET estado=1 WHERE iddependencia_cargo=".$equivalencias[$i]["llave_entidad_origen"];
				phpmkr_query($sql2);
				array_push($equivalencia["roles"],array($equivalencias[$i]["llave_entidad_destino"],$equivalencias[$i]["llave_entidad_origen"]));
      break;
    }
  }
}
//tipo_reemplazo_doc=1 son los documentos que se les realiza un reemplazo en ruta, 2 para los que se realiza un reemplazo en transferencia de pendientes
$documentos_ruta=busca_filtro_tabla("A.iddocumento","documento A,reemplazo_documento B","A.iddocumento=B.documento_iddocumento AND fk_idreemplazo_saia=".$idreemplazo." AND B.tipo_reemplazo_doc=1 AND A.estado not in ('ELIMINADO','ANULADO') AND A.numero=0","",$conn);
if($documentos_ruta["numcampos"]){
  for($i=0;$i<$documentos_ruta["numcampos"];$i++){
    actualizar_ruta_reemplazo($documentos_ruta[$i]['iddocumento'],$equivalencia);
  }
}
$documentos_pendientes=busca_filtro_tabla("B.documento_iddocumento","asignacion A,reemplazo_documento B","A.documento_iddocumento=B.documento_iddocumento AND fk_idreemplazo_saia=".$idreemplazo." AND A.llave_entidad=".$equivalencia["funcionario_codigo"][0],"",$conn);
if($documentos_pendientes["numcampos"]){
  for($i=0;$i<$documentos_pendientes["numcampos"];$i++){
    $datos["archivo_idarchivo"]=$documentos_pendientes[$i]["documento_iddocumento"];
    $datos["nombre"]="DELEGADO";
    $datos["tipo_destino"]=1;
    $datos["origen"]=$equivalencia["funcionario_codigo"][0];
    $destino_tramite=array($equivalencia["funcionario_codigo"][1]);
    transferir_archivo_prueba($datos,$destino_tramite,"","");
  }
}

$sql_delete="DELETE B.* FROM reemplazo_saia A,reemplazo_documento B WHERE A.idreemplazo_saia=B.fk_idreemplazo_saia AND A.idreemplazo_saia=".$idreemplazo;
phpmkr_query($sql_delete);


inactivar_reemplazo_expedientes($idreemplazo);

$sql2="UPDATE reemplazo_saia SET estado=0 WHERE idreemplazo_saia=".$idreemplazo;
phpmkr_query($sql2);
return(true);
}

function inactivar_reemplazo_expedientes($idreemplazo_saia){
    global $conn,$ruta_db_superior;
    $reemplazo_saia=busca_filtro_tabla("","reemplazo_saia","estado=1 AND idreemplazo_saia=".$idreemplazo_saia,"",$conn);
    $idfuncionario_antiguo=busca_filtro_tabla("idfuncionario","funcionario","funcionario_codigo=".$reemplazo_saia[0]['antiguo'],"",$conn);
    $idfuncionario_nuevo=busca_filtro_tabla("idfuncionario","funcionario","funcionario_codigo=".$reemplazo_saia[0]['nuevo'],"",$conn);    
    $reemplazo_expedientes=busca_filtro_tabla("expediente_idexpediente,idreemplazo_expediente","reemplazo_expediente","estado=1 AND fk_idreemplazo_saia=".$idreemplazo_saia,"",$conn);
    $idexpedientes_reemplazo=implode(',',extrae_campo($reemplazo_expedientes,'expediente_idexpediente'));
    $idreemplazo_expedientes=implode(',',extrae_campo($reemplazo_expedientes,'idreemplazo_expediente'));
    
    $sql3="UPDATE reemplazo_expediente SET estado=0 WHERE idreemplazo_expediente IN(".$idreemplazo_expedientes.")";
    phpmkr_query($sql3);
    $sql4="UPDATE entidad_expediente SET llave_entidad=".$idfuncionario_antiguo[0]['idfuncionario']." WHERE estado=1 AND entidad_identidad=1 AND expediente_idexpediente IN(".$idexpedientes_reemplazo.")  AND llave_entidad=".$idfuncionario_nuevo[0]['idfuncionario'];
}

function insertar_reemplazo_expediente($idreemplazo_saia){
    global $conn,$ruta_db_superior;
    
    $reemplazo_saia=busca_filtro_tabla("","reemplazo_saia","estado=1 AND idreemplazo_saia=".$idreemplazo_saia,"",$conn);
    $idfuncionario_antiguo=busca_filtro_tabla("idfuncionario","funcionario","funcionario_codigo=".$reemplazo_saia[0]['antiguo'],"",$conn);
    $idfuncionario_nuevo=busca_filtro_tabla("idfuncionario","funcionario","funcionario_codigo=".$reemplazo_saia[0]['nuevo'],"",$conn);
    
    $permisos_expedientes_antiguo=busca_filtro_tabla("identidad_expediente","entidad_expediente","estado=1 AND entidad_identidad=1 AND llave_entidad=".$idfuncionario_antiguo[0]['idfuncionario'],"",$conn);
    $identidad_expediente=implode(",",extrae_campo($permisos_expedientes_antiguo,'identidad_expediente'));
    
    $sql3="INSERT INTO reemplazo_expediente (fk_idreemplazo_saia,fk_identidad_expediente,estado) VALUES (".$idreemplazo_saia.",'".$identidad_expediente."',1)";
    phpmkr_query($sql3);
    $sql4="UPDATE entidad_expediente SET llave_entidad=".$idfuncionario_nuevo[0]['idfuncionario']." WHERE fk_identidad_expediente IN(".$identidad_expediente.")";
    phpmkr_query($sql4);
}
function actualiza_ruta_devolucion($idreemplazo,$iddocumento,$idruta){
	global $conn;
	$reemplazo=busca_filtro_tabla("idreemplazo_saia,tipo_reemplazo,".fecha_db_obtener("fecha_inicio","Y-m-d")." AS fecha_inicio,".fecha_db_obtener("fecha_fin","Y-m-d")." AS fecha_fin","reemplazo_saia","idreemplazo_saia=".$idreemplazo,"",$conn);
	$equivalencias_reemplazo=buscar_equivalencias_reemplazo($reemplazo[0]["antiguo"],$reemplazo[0]["nuevo"],$reemplazo);
	$activo_buzon="UPDATE buzon_entrada SET activo=1 WHERE nombre='POR_APROBAR' and archivo_idarchivo=".$iddocumento." and ruta_idruta=".$idruta;
	phpmkr_query($activo_buzon);
	actualizar_ruta_reemplazo($iddocumento,$equivalencias_reemplazo);
}
?>