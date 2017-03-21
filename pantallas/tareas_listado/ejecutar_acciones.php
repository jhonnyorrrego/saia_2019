<?php
  $max_salida=6; $ruta_db_superior=$ruta=""; while($max_salida>0){ if(is_file($ruta."db.php")){ $ruta_db_superior=$ruta;} $ruta.="../"; $max_salida--; } 
  include_once($ruta_db_superior."db.php");
    include_once($ruta_db_superior."formatos/librerias/funciones_generales.php");
  include_once($ruta_db_superior."pantallas/tareas_listado/librerias.php");
 
  
  //include_once($ruta_db_superior."pantallas/lib/valid.php");  
  //include_once($ruta_db_superior."pantallas/lib/when.php");
  use When\When;
if(@$_REQUEST["ejecutar_accion_tarea"]){  
  if(!@$_REQUEST["tipo_retorno"]){
    $_REQUEST["tipo_retorno"]=1;
  }
  if($_REQUEST["tipo_retorno"]){
    echo(json_encode($_REQUEST["ejecutar_accion_tarea"]()));
  }  
  else{
    $_REQUEST["ejecutar_accion_tarea"]();
  }
}

//------------------------------------

function descargar_anexo_nombre_original(){
	global $conn,$ruta_db_superior;

	include_once($ruta_db_superior."StorageUtils.php");
	include_once($ruta_db_superior.'filesystem/SaiaStorage.php');
	$idtareas_listado_anexos=@$_REQUEST['idtareas_listado_anexos'];  	
    $datos=busca_filtro_tabla("etiqueta,ruta","tareas_listado_anexos","idtareas_listado_anexos=".$idtareas_listado_anexos,"",$conn);
	$arr_almacen = StorageUtils::resolver_ruta($datos[0]["ruta"]);
	
	if($arr_almacen["clase"]->get_filesystem()->has($arr_almacen["ruta"])){
		$instancia = $arr_almacen["clase"];
		$fs = $instancia->get_filesystem();
		$archivo = $fs->get($arr_almacen["ruta"]);
		$tipo = $fs->mimeType($arr_almacen["ruta"]);

  	header("Content-Type: application/octet-stream");
  	header("Content-Disposition: attachment; filename=\"".html_entity_decode($datos[0]["etiqueta"])."\"");
		header("Content-Length: " . $archivo->getSize());
  	header("Content-transfer-encoding: binary");
		echo($archivo->getContent());		
	}else{
		return;
	}

	
  	exit;
}


function editar_eliminar_avance_tarea(){
	global $conn,$ruta_db_superior;
	$retorno=new stdClass;
	$retorno->exito=0;	
	
	if(@$_REQUEST['accion']){
		
		switch($_REQUEST['accion']){
			case 'eliminar':
				$retorno->mensaje="Inconvenientes al Eliminar el Avance";	
				$sql="DELETE from tareas_listado_tiempo WHERE idtareas_listado_tiempo=".intval($_REQUEST['idtareas_listado_tiempo']);
				phpmkr_query($sql);
				$busca_avance=busca_filtro_tabla("idtareas_listado_tiempo","tareas_listado_tiempo","idtareas_listado_tiempo=".$_REQUEST['idtareas_listado_tiempo'],"",$conn);
				if(!$busca_avance['numcampos']){
					$retorno->exito=1;	
					$retorno->mensaje="Avance Eliminado Satisfactoriamente";	
				}
				break;
			case 'cargar_info':
				$cargar_info=busca_filtro_tabla("comentario,fecha_inicio,estado_avance,".fecha_db_obtener('hora_inicio','H:i')." as hora_inicio,".fecha_db_obtener('hora_final','H:i')." AS hora_final","tareas_listado_tiempo","idtareas_listado_tiempo=".$_REQUEST['idtareas_listado_tiempo'],"",$conn);
				//fecha_db_obtener('a.fecha_limite','Y-m-d')." as x_fecha_limite
				if($cargar_info['numcampos']){
					$retorno->exito=1;	
					$retorno->comentario=$cargar_info[0]['comentario'];
					$retorno->fecha_inicio=$cargar_info[0]['fecha_inicio'];
					$retorno->hora_inicio=$cargar_info[0]['hora_inicio'];
					$retorno->hora_final=$cargar_info[0]['hora_final'];
					$retorno->estado_avance=$cargar_info[0]['estado_avance'];
				}
				break;	
			case 'editar_info':
				$idtareas_listado_tiempo=$_REQUEST['idtareas_listado_tiempo'];
				$tiempo_registrado=@$_REQUEST['tiempo_registrado'];
				$comentario=@$_REQUEST['comentario'];
				$fecha_inicio=@$_REQUEST['fecha_inicio'];
				$hora_inicio=@$_REQUEST['hora_inicio'];
				$hora_final=@$_REQUEST['hora_final'];
				$estado_avance=@$_REQUEST['estado_avance'];
				$sql="UPDATE tareas_listado_tiempo SET tiempo_registrado='".$tiempo_registrado."',comentario='".$comentario."',fecha_inicio='".$fecha_inicio."',hora_inicio='".$hora_inicio."',hora_final='".$hora_final."',estado_avance='".$estado_avance."' WHERE   idtareas_listado_tiempo=".$idtareas_listado_tiempo;
				phpmkr_query($sql);
				$retorno->exito=1;	
				$retorno->mensaje="Avance Editado Satisfactoriamente";
				break;	
		}	
	}
	return($retorno);
}

function update_campos_tarea_listado(){
global $conn,$ruta_db_superior;
$retorno=new stdClass;
$retorno->exito=0;
$retorno->mensaje="Error al actualizar el campo ".$_REQUEST["campo"];
$exito=0;
if(@$_REQUEST["campos"] && $_REQUEST["idtareas_listado"]){
  $campos=explode(",",$_REQUEST["campos"]);
  $campo_valor=''; $ok=0;
  foreach($campos AS $key=>$value){
    $campo_valor[]=$value."=".$_REQUEST[$value];
		if($value=="progreso"){
			$progreso=intval($_REQUEST[$value]);
			$ok=1;
		}
  }
	if($progreso==100){
		$campo_valor[]="estado_tarea='EJECUCION'";

		$evaluador=busca_filtro_tabla("evaluador,nombre_tarea","tareas_listado t","t.idtareas_listado=".$_REQUEST["idtareas_listado"],"",$conn);
		if($evaluador["numcampos"]){
			if($evaluador[0]['evaluador']!=''){
				$funcionario=busca_filtro_tabla("funcionario_codigo","funcionario f","idfuncionario='".$evaluador[0]['evaluador']."'  and estado=1","",$conn);
				if($funcionario["numcampos"]){
				    
			        $parametro="?".base64_encode("idtareas_listado_unico=".$_REQUEST["idtareas_listado"]); 
		        	$ruta=PROTOCOLO_CONEXION.RUTA_PDF_LOCAL."/index.php";
			        $link="<a href='".$ruta.$parametro."' target='_blank'>Ver Tarea</a>";				    
				    
					$fun_cod=$funcionario[0]['funcionario_codigo'];
					$mensaje="Saludos,<br/><br/>Se registro un progreso de <strong>".$progreso."%</strong> a la tarea <strong>".$evaluador[0]["nombre_tarea"]."</strong><br/><br/>".$link;
					enviar_mensaje("","codigo",$fun_cod,"Tarea para Evaluar",$mensaje);
				}				
			}
		}		
	
	    	
		
	}else{
		$campo_valor[]="estado_tarea='EJECUCION'";
	}
	
	$retorno->sin_tiempo_registrado=0;
	$ejecutar_update=1;
	if($progreso==100){
		$tiempo_registrado=busca_filtro_tabla("SUM(tiempo_registrado) as tiempo_registrado","tareas_listado_tiempo","fk_tareas_listado=".$_REQUEST["idtareas_listado"],"",$conn);
		
		if($tiempo_registrado[0]['tiempo_registrado']==0){
			$ejecutar_update=0;
			$retorno->sin_tiempo_registrado=1;
		}
	}
	
	
	if($ejecutar_update){
	  
	  if($progreso==100){
            $tabla="tareas_progreso";
    		$fieldList=array();
    		$fieldList["funcionario_idfuncionario"] = usuario_actual('idfuncionario');	
    		$fieldList["fk_tareas_listado"] = $_REQUEST["idtareas_listado"];	
    		$fieldList["progreso"] = $progreso;	
    		$fieldList["fecha_progreso"] = date('Y-m-d H:i:s');	
    		$strsql = "INSERT INTO ".$tabla." (";
    		$strsql .= implode(",", array_keys($fieldList));			
    		$strsql .= ") VALUES ('";			
    		$strsql .= implode("','", array_values($fieldList));			
    		$strsql .= "')";	    
    	    phpmkr_query($strsql);	      
	  }

	    
	  $sql2="UPDATE tareas_listado SET ".implode(",",$campo_valor)." WHERE idtareas_listado=".$_REQUEST["idtareas_listado"];
	  $retorno->sql=$sql2;  
	  phpmkr_query($sql2);
	  $retorno->exito=1;
		if ($ok && $progreso>24){
			$seguidores=busca_filtro_tabla("seguidores,nombre_tarea","tareas_listado t","t.idtareas_listado=".$_REQUEST["idtareas_listado"],"",$conn);
			if($seguidores["numcampos"]){
				$funcionarios=busca_filtro_tabla("funcionario_codigo","funcionario f","idfuncionario in (".str_replace("#", "", $seguidores[0]["seguidores"]).") and estado=1","",$conn);
				if($funcionarios["numcampos"]){
				    
			        $parametro="?".base64_encode("idtareas_listado_unico=".$_REQUEST["idtareas_listado"]); 
		        	$ruta=PROTOCOLO_CONEXION.RUTA_PDF_LOCAL."/index.php";
			        $link="<a href='".$ruta.$parametro."' target='_blank'>Ver Tarea</a>";					    
				    
					$fun_cod=extrae_campo($funcionarios,"funcionario_codigo");
					$mensaje="Saludos,<br/><br/>Se registro un progreso de <strong>".$progreso."%</strong> a la tarea <strong>".$seguidores[0]["nombre_tarea"]."</strong><br/><br/>".$link;
					enviar_mensaje("","codigo",$fun_cod,"Nuevo Progreso Registrado",$mensaje);
				}
			}
		}		
	}

		
		
		
		
  if($campos[1]=='fecha_limite'){
  	$retorno->fecha_limite=@$_REQUEST["fecha_limite"];
  }
  $retorno->mensaje=@$_REQUEST["mensaje_exito"];
}
return($retorno);
}

function guardar_campos_tarea_listado_notas(){
$retorno=new stdClass;
$retorno->exito=0;
$retorno->mensaje="Error al Guardar";
$exito=0;
if(@$_REQUEST["campos"] && $_REQUEST["fk_tareas_listado"]){
  $campos=explode(",",$_REQUEST["campos"]);
  $campo_valor='';
  foreach($campos AS $key=>$value){
    $campo_valor[$value]="'".($_REQUEST[$value])."'";
  } 
	$fecha_actual=date("Y-m-d H:i");
  $sql2="INSERT INTO tareas_listado_notas (funcionario_idfuncionario,fecha_creacion, ".implode(",", array_keys($campo_valor)).") VALUES (".usuario_actual("idfuncionario").",".fecha_db_almacenar($fecha_actual,"Y-m-d H:i:s").",".implode(",",array_values($campo_valor)).")";
  $retorno->sql=$sql2;  
  phpmkr_query($sql2);
  $id_nota=phpmkr_insert_id();
  if($id_nota){
  	if($_REQUEST["enviar_correo"]==1){
		  $responsable=busca_filtro_tabla("co_participantes,seguidores,responsable_tarea,nombre_tarea,evaluador","tareas_listado t","t.idtareas_listado=".$_REQUEST["fk_tareas_listado"],"",$conn);
			if($responsable["numcampos"]){
				
				$funcionarios_enviar=$responsable[0]['responsable_tarea'].','.$responsable[0]['co_participantes'].','.$responsable[0]['seguidores'].','.$responsable[0]['evaluador'];
				
				$valor=explode(',',$funcionarios_enviar);
				$longitud=count($valor);
				for($i=0;$i<$longitud;$i++){
					if($valor[$i]==''){
						unset($valor[$i]); 
					}
				}
				$valor=array_values($valor);
				$valor=implode(',',$valor);
				$funcionarios_enviar=$valor;
				
				$funcionarios=busca_filtro_tabla("funcionario_codigo","funcionario f","idfuncionario in(".$funcionarios_enviar.") and estado=1","",$conn);
				if($funcionarios["numcampos"]){
					$funcionarios_enviar='';
					for($i=0;$i<$funcionarios["numcampos"];$i++){
						
						if($i+1==$funcionarios["numcampos"]){
							$funcionarios_enviar.=$funcionarios[$i]['funcionario_codigo'];
						}else{
							$funcionarios_enviar.=$funcionarios[$i]['funcionario_codigo'].',';
						}	
					}
					
					$funcionarios_enviar_vector=explode(',',$funcionarios_enviar);
					
			        $parametro="?".base64_encode("idtareas_listado_unico=".$_REQUEST["fk_tareas_listado"]); 
		        	$ruta=PROTOCOLO_CONEXION.RUTA_PDF_LOCAL."/index.php";
			        $link="<a href='".$ruta.$parametro."' target='_blank'>Ver Tarea</a>";
					
					$mensaje="Saludos,<br/><br/>Se ha adicionado una nota a la tarea <strong>".$responsable[0]["nombre_tarea"]."</strong><br/><br/>
					Fecha: ".$fecha_actual."<br/>
					NOTA: ".$_REQUEST["descripcion"]."<br/><br/>".$link;
					enviar_mensaje("","codigo",$funcionarios_enviar_vector,"Nueva Nota",$mensaje);
				}
			}
  	}
	  $retorno->exito=1;
	  $retorno->mensaje=@$_REQUEST["mensaje_exito"];
	 }
}
return($retorno);
}

function actualizar_prioridad_tareas(){
	$retorno=new stdClass;
	$retorno->exito=0;
	$retorno->mensaje="Error al actualizar la prioridad";
	$exito=0;
	if(isset($_REQUEST["prioridad"]) && $_REQUEST["idtarea"]){
	  $sql2="UPDATE tareas_listado SET prioridad='".$_REQUEST["prioridad"]."' WHERE idtareas_listado=".$_REQUEST["idtarea"];
	  $retorno->sql=$sql2;  
	  phpmkr_query($sql2);
	  $retorno->exito=1;
	  $retorno->mensaje=@$_REQUEST["mensaje_exito"];
	}
return($retorno);
}

function actualizar_calificacion(){
	$stars=array(1=>'&#9733;',2=>'&#9733;&#9733;',3=>'&#9733;&#9733;&#9733;',4=>'&#9733;&#9733;&#9733;&#9733;',5=>'&#9733;&#9733;&#9733;&#9733;&#9733;');
	
			
	$retorno=new stdClass;
	$retorno->exito=0;
	if(isset($_REQUEST["calificacion"]) && @$_REQUEST["idtareas_listado"]){
	  $sql2="UPDATE tareas_listado SET estado_tarea='TERMINADO',calificacion='".$_REQUEST["calificacion"]."' WHERE idtareas_listado=".$_REQUEST["idtareas_listado"];
	  phpmkr_query($sql2);
	  
	  
	  //DESARROLLO RECURRENCIA AUTOMATICA
	  
	  $idtareas_listado_recurrencia=@$_REQUEST['idtareas_listado'];
	  $datos_recurrencia=busca_filtro_tabla("","tareas_listado_recur a, tareas_listado b","a.fk_tareas_listado=b.idtareas_listado AND a.fk_tareas_listado=".$idtareas_listado_recurrencia,"",$conn);
	  if(!$datos_recurrencia['numcampos']){
	  	$papa_recurrencia=busca_filtro_tabla("","tareas_listado a, tareas_listado_recur b","a.fk_tarea_recurrencia=b.fk_tareas_listado AND a.idtareas_listado=".$idtareas_listado_recurrencia,"",$conn);
		  if($papa_recurrencia['numcampos']){
		  	$idtareas_listado_recurrencia=$papa_recurrencia[0]['fk_tarea_recurrencia'];
		  }
	  }
	  $retorno->exito_recurrencia=generar_tarea_recurrencia($idtareas_listado_recurrencia);
	  //FIN DESARROLLO RECURRENCIA AUTOMATICA
	  
	  
	  $observaciones="";
	  if(@$_REQUEST['observaciones']){
	  	$observaciones=$_REQUEST['observaciones'];
	  }
	  $fecha_hora=date('Y-m-d H:i:s');
	  $sql="INSERT INTO tareas_listado_evalua (fk_tareas_listado,funcionario_idfuncionario,calificacion,fecha_hora,observaciones) VALUES ('".$_REQUEST["idtareas_listado"]."','".usuario_actual('idfuncionario')."','".$_REQUEST["calificacion"]."','".$fecha_hora."','".$observaciones."') ";
	  $retorno->fecha_hora=$fecha_hora;
	  
	  phpmkr_query($sql);
	  
	  //ENVIO DE EMAIL
	  
	  
	  $involucrados=busca_filtro_tabla("responsable_tarea,co_participantes,seguidores,evaluador,nombre_tarea","tareas_listado","idtareas_listado=".$_REQUEST["idtareas_listado"],"",$conn);
	  
	  $idfun_involucrados=array();
	  array_push($idfun_involucrados,$involucrados[0]['responsable_tarea']);
	  array_push($idfun_involucrados,$involucrados[0]['evaluador']);
	  $idfun_involucrados= array_merge ( $idfun_involucrados, explode(',',$involucrados[0]['co_participantes']) );
      $idfun_involucrados=array_merge ( $idfun_involucrados, explode(',',$involucrados[0]['seguidores']) );
      $idfun_involucrados=array_unique($idfun_involucrados);
      $idfun_involucrados=array_values($idfun_involucrados);
      $funcod_invo=busca_filtro_tabla("funcionario_codigo","funcionario","idfuncionario IN(".implode(',',$idfun_involucrados).")","",$conn);
      $fun_cods=extrae_campo($funcod_invo,'funcionario_codigo','U');

	  $parametro="?".base64_encode("idtareas_listado_unico=".$_REQUEST["idtareas_listado"]); 
	  $ruta=PROTOCOLO_CONEXION.RUTA_PDF_LOCAL."/index.php";
	  $link="<a href='".$ruta.$parametro."' target='_blank'>Ver Tarea</a>";      
      
      $mensaje='
        Saludos,
        <br/>
        <br/>
        Se ha calificado la tarea <b>'.$involucrados[0]['nombre_tarea'].'</b> en la cual usted se encuentra involucrado.
        <br/>
        <br/>
        <b>Calificaci&oacute;n:</b> &nbsp; '.$stars[$_REQUEST["calificacion"]].'
        <br/>
        <b>Observaci&oacute;n:</b> '.$observaciones.'
        <br/>
        <br/>
        '.$link.'
      ';
	    enviar_mensaje("","codigo",$fun_cods,"Nueva Tarea Calificada",$mensaje);
	  
	  
	  
	  
	  $retorno->calificacion_stars=$stars[$_REQUEST["calificacion"]];
	  $retorno->exito=1;
	}
	return($retorno);
}
function semana_dia($fecha_calcular) {
  $date = new Datetime($fecha_calcular);
  $cardinalidad = (0 | ($date->format("d") / 7));
  if($cardinalidad==3){
    $intervalo=new DateInterval("P".(1)."w");
    $date->add($intervalo);
    $cardinalidad_temp=(0 | $date->format("d")/7);
    if($cardinalidad_temp == 0)
      $cardinalidad=-1; 
  }
  if($cardinalidad==4){
    $cardinalidad=-1;
  }
  return $cardinalidad;
}
 
function info_finaliza($ejecuta_proxima,$tareas_listado){
	global $conn,$ruta_db_superior;
	
  switch($tareas_listado[0]["finaliza_el"]){
    case "3":
      //FALTA ESTA PARTE POR CAMBIAR PARA EMPEZAR A PROBAR
      $fecha_finaliza_el=new DateTime($tareas_listado[0]["finaliza_el_fecha"]);
      if($ejecuta_proxima>=$fecha_finaliza_el){
        $ejecuta_proxima=null;
      }  
      break;
	case "2": //al cabo de
		
		$datos_recurrencia=busca_filtro_tabla("finaliza_el_repeticiones","tareas_listado_recur","fk_tareas_listado=".$tareas_listado[0]["idtareas_listado"],"",$conn);
		$recurrencias_generadas=busca_filtro_tabla("","tareas_listado","fk_tarea_recurrencia=".$tareas_listado[0]["idtareas_listado"],"",$conn);
		
		if($recurrencias_generadas['numcampos']+1==$datos_recurrencia[0]['finaliza_el_repeticiones']){
			 $ejecuta_proxima=null;
		}
		break;
	
	
	
  }
  return($ejecuta_proxima);
}
function calcula_ejecuta_proxima($idtareas_listado){
  $days = array('Domingo','Lunes','Martes','Miercoles','Jueves','Viernes','Sabado');
  $prefixes =array('Primer', 'Segundo', 'Tercer','Cuarto');  
  $tareas_listado=busca_filtro_tabla("","tareas_listado A, tareas_listado_recur B","A.idtareas_listado=B.fk_tareas_listado AND A.idtareas_listado=".$idtareas_listado,"",$conn);
  $periodo=array(1=>"D",3=>"w",4=>"M",5=>"Y");
  $ejecuta_hasta='';
  //existe recurrencia
  if($tareas_listado["numcampos"] && $tareas_listado[0]["ejecuta_proxima"]!=''){
    $dia=new DateTime($tareas_listado[0]["ejecuta_proxima"]);
    //SEMANA  
    if($tareas_listado[0]["recurrencia"]==3){
      $periodo[$tareas_listado[0]["recurrencia"]]="D";
      $tareas_listado[0]["repetir_cada"]*=7;
    }
    $intervalo=new DateInterval("P".$tareas_listado[0]["repetir_cada"].$periodo[$tareas_listado[0]["recurrencia"]]);
    $ejecuta_proxima=$dia->add($intervalo);
    $ejecuta_proxima=info_finaliza($ejecuta_proxima,$tareas_listado);
    switch($tareas_listado[0]["recurrencia"]){
      case "3":
        $selected = array();
        $dias = explode(",",$tareas_listado[0]["dias_semana"]);
        $dia_day=$dia->format("w");
        $dia_select='';
        for($i=0;$i<count($dias);$i++){
          array_push($selected,$days[$dias[$i]]);
        }
        //busca la primer ocurrencia mayor al dia 
        for($i=0;$i<count($dias);$i++){
          if($dias[$i]>=$dia_day && $dia_select===''){
            $dia_select=$dias[$i];
          }
        }
        //Si no existe ocurrencia mayor al dia se busca en todos los menores 
        if($dia_select===''){
          for($i=0;$i<count($dias);$i++){
            if(($dias[$i]+7)>=$dia_day && $dia_select==''){
              $dia_select=$dias[$i];
            }
          }
        }
        $nuevo_dia=null;
        $intervalo=new DateInterval("P".($dia_select-$dia_day)."D");
        $nuevo_dia=$dia;
        $nuevo_dia->add($intervalo);
        $intervalo=new DateInterval("P".($tareas_listado[0]["repetir_cada"])."W");
        $ejecuta_proxima=info_finaliza($nuevo_dia,$tareas_listado);
      break;
      case "4":
        if($tareas_listado[0]['repetir_mes']==2){
          $nuevo_dia=new DateTime($tareas_listado[0]["ejecuta_proxima"]);
          $empieza=new DateTime($tareas_listado[0]["ejecuta_proxima"]);
          $semana_dia_mes=semana_dia($tareas_listado[0]["ejecuta_proxima"]);
          if($semana_dia_mes==-1){
            $fin_mes=$dia;
            $intervalo=new DateInterval("P".($tareas_listado[0]["repetir_cada"])."M");
            $fin_mes->add($intervalo);
            $fin=new DateTime($fin_mes->format('Y-m-t'));
            $cant_dias=($fin->format("w")-$dia->format("w"));
            $intervalo=new DateInterval("P".($cant_dias)."D");
            $nuevo_dia=$fin_mes->sub($intervalo)->format("Y-m-d");
            if(cant_dias<0){
              $intervalo=new DateInterval("P".(1)."W");
              $nuevo_dia->sub($intervalo);
              $nuevo_dia=$nuevo_dia;
            }
          }
          else{
            $intervalo=new DateInterval("P".($tareas_listado[0]["repetir_cada"])."M");
            $nuevo_dia->add($intervalo);
            
            $nuevo_dia->setDate($nuevo_dia->format("Y"),$nuevo_dia->format("m"),"01");
            $temp_dia=$empieza->format("w")-$nuevo_dia->format("w");
            if($temp_dia<0){
              $temp_dia+=7;
            }
            $intervalo=new DateInterval("P".($temp_dia)."D");
            $nuevo_dia->add($intervalo);
            $intervalo=new DateInterval("P".($semana_dia_mes*7)."D");
            $nuevo_dia->add($intervalo);
          }
        }
        $ejecuta_proxima=info_finaliza($nuevo_dia,$tareas_listado);
      break;
    }
  return($ejecuta_proxima);
  }
  return(null);
}

function obtenter_tiempo_tareas(){
	$retorno=new stdClass;
	$retorno->exito=0;
	$tiempo=restarhoras($_REQUEST["hora_ini"],$_REQUEST["hora_fin"]);
	if($tiempo){
		$retorno->exito=1;
		$retorno->tiempo=$tiempo;
	}else{
		$retorno->mensaje="Error al actualizar el tiempo";
	}
	return($retorno);
}

function obtenter_fecha_final_tareas(){
	$retorno=new stdClass;
	$retorno->exito=0;
	$tiempo=sumas_restar_tiempos(date($_REQUEST["hora_inicial"]),"H:i",$_REQUEST["hora"],$_REQUEST["minutos"],0,"+");
	if($tiempo){
		$retorno->exito=1;
		$retorno->tiempo=$tiempo;
	}else{
		$retorno->mensaje="Error al actualizar fecha final";
	}
	return($retorno);
}

function sumas_restar_tiempos($fecha="",$formato="H:i:s",$hora=0,$minutos=0,$segundos=0,$operacion="+"){
	if($fecha==""){
		$fecha=date($formato);
	}	
	$nuevafecha = strtotime ($operacion.$hora.' hour '.$operacion.$minutos.' minute '.$operacion.$segundos.' second', strtotime ( $fecha ) ) ;
	$nuevafecha = date ( $formato , $nuevafecha );
	return $nuevafecha;
}

function restarhoras($horaini,$horafin){
	$horai=substr($horaini,0,2);
	$mini=substr($horaini,3,2);
	$segi=substr($horaini,6,2);
 
	$horaf=substr($horafin,0,2);
	$minf=substr($horafin,3,2);
	$segf=substr($horafin,6,2);
 
	$ini=((($horai*60)*60)+($mini*60)+$segi);
	$fin=((($horaf*60)*60)+($minf*60)+$segf);
 
	$dif=$fin-$ini;
 
	$difh=floor($dif/3600);
	$difm=floor(($dif-($difh*3600))/60);
	$difs=$dif-($difm*60)-($difh*3600);
	return date("H-i-s",mktime($difh,$difm,$difs));
}


function registrar_tiempo_tarea_listado(){
	$retorno=new stdClass;
	$retorno->exito=0;
	$retorno->mensaje="Error al registrar el tiempo de la tarea ";
	$exito=0;
	$estado_tarea=busca_filtro_tabla("","tareas_listado","idtareas_listado=".$_REQUEST["idtarea"],"",$conn);
	if($estado_tarea[0]["estado_tarea"]=="TERMINADO"){
			$retorno->mensaje="La tarea ha sido Terminada, NO se permiten mas avances";
	}else{
		if(@$_REQUEST["tiempo_tarea"] && $_REQUEST["idtarea"]){
		  $sql2="INSERT INTO tareas_listado_tiempo(fk_tareas_listado,tiempo_registrado, funcionario_idfuncionario,fecha_inicio,hora_inicio,hora_final,comentario,estado_avance) VALUES(".$_REQUEST["idtarea"].",".$_REQUEST["tiempo_tarea"].",".usuario_actual("idfuncionario").",".fecha_db_almacenar($_REQUEST["fecha_inicial"],"Y-m-d").",'".$_REQUEST["hora_inicio"]."','".$_REQUEST["hora_final"]."','".$_REQUEST["comentario"]."','".$_REQUEST["estado"]."')";
		  $retorno->sql=$sql2;  
		  phpmkr_query($sql2);
		  $retorno->idregistro=phpmkr_insert_id();
		  if($retorno->idregistro){
		  	$update_estado="UPDATE tareas_listado SET estado_tarea='".$_REQUEST["estado"]."' WHERE idtareas_listado=".$_REQUEST["idtarea"];
				phpmkr_query($update_estado);
	
		    $retorno->exito=1;
		    $retorno->mensaje=@$_REQUEST["mensaje_exito"];
		  }
		}
	}
	return($retorno);
}

function delete_tarea_listado(){
	global $conn,$ruta_db_superior;
	
	include_once($ruta_db_superior."StorageUtils.php");
	include_once($ruta_db_superior.'filesystem/SaiaStorage.php');
	
	$retorno=new stdClass;
	$retorno->exito=0;
	$retorno->mensaje="Error al eliminar";
	$exito=0;
	if($_REQUEST["idtareas_listado"]!=""){
		$tipo_almacenamiento = new SaiaStorage(RUTA_BACKUP_ELIMINADOS);
		$idlistado_tareas=busca_filtro_tabla('listado_tareas_fk','tareas_listado','idtareas_listado='.$_REQUEST["idtareas_listado"],'',$conn);
		$listado_tareas_fk=$idlistado_tareas[0]['listado_tareas_fk'];
		$sql2="DELETE FROM tareas_listado WHERE idtareas_listado=".$_REQUEST["idtareas_listado"];
		phpmkr_query($sql2);
		$verifica=busca_filtro_tabla("","tareas_listado","idtareas_listado=".$_REQUEST["idtareas_listado"],"",$conn);
		if($verifica["numcampos"]==0){
			$anexos=busca_filtro_tabla("ruta","tareas_listado_anexos","fk_tareas_listado=".$_REQUEST["idtareas_listado"],"",$conn);
			for($i=0;$i<$anexos["numcampos"];$i++){
				$arr_almacen = StorageUtils::resolver_ruta($anexos[$i]["ruta"]);
				$nombre_anexo=basename($arr_almacen["ruta"]);
				$ruta_eliminados="anexos_tareas/".$listado_tareas_fk."/".$_REQUEST["idtareas_listado"]."/";
				$resultado=$arr_almacen['clase']->copiar_contenido($tipo_almacenamiento, $arr_almacen["ruta"], $ruta_eliminados.$nombre_anexo);
				$arr_almacen['clase']->get_filesystem()->delete($arr_almacen["ruta"]);
						 	$sql_anexos="DELETE FROM tareas_listado_anexos WHERE idtareas_listado_anexos=".$anexos[$i]["idtareas_listado_anexos"];
							phpmkr_query($sql_anexos);
			}
		 	$sql_tiempo="DELETE FROM tareas_listado_tiempo WHERE fk_tareas_listado=".$_REQUEST["idtareas_listado"];
			phpmkr_query($sql_tiempo);
		 	$sql_notas="DELETE FROM tareas_listado_notas WHERE fk_tareas_listado=".$_REQUEST["idtareas_listado"];
			phpmkr_query($sql_notas);
			$retorno->exito=1;
			$retorno->mensaje="Se ha eliminado la tarea con &eacute;xito"; 
		}
	}
	return($retorno);
}

function calcular_color_dias_fecha_limite(){
	global $conn,$ruta_db_superior;
	
 	include_once($ruta_db_superior."pantallas/lib/librerias_fechas.php");	
	$retorno=new stdClass;
	$retorno->exito=0;
	
				
	if($_REQUEST['idtareas_listado']!=''){
		
			$datos_tarea=busca_filtro_tabla('fecha_limite','tareas_listado','idtareas_listado='.$_REQUEST['idtareas_listado'],'',$conn);
			
			$date = $datos_tarea[0]['fecha_limite'];

			
			$color='';
			$aviso='';
			$interval=resta_dos_fechas_saia($date);
			if($interval->invert==1){
				if($interval->days>5){
					$color='#306609';   //verde
					$aviso='<b>Falta: '.$interval->days.'</b> dias';    
				}else if($interval<=5){
					$color='#CCCC21';   //amarillo
					if($interval->days==0){
						$aviso='<b>Hoy</b>';
					}else{
						$aviso='<b>Falta: '.$interval->days.'</b> dias';
					}
				}
			}else{
				if($interval->days==0){ 
					$color='#CCCC21';  //amarillo
					if($interval->days==0){ 
						$aviso='<b>Hoy</b>';
					}else{
						$aviso='<b>Falta: '.$interval->days.'</b> dias';
					}					
					
				}else{
					$color='#FF0000';   //rojo
					$aviso='<b>Hace: '.$interval->days.'</b> dias';	
				}	
			}
			
			$retorno->color=$color;
			$retorno->aviso=$aviso;
			$retorno->fecha_limite=$datos_tarea[0]['fecha_limite'];;
			$retorno->exito=1;
	}
	else{
		return($retorno);
	}			
	return($retorno);
}

function crear_tarea_recurrencia(){
	global $conn,$ruta_db_superior;
	
	$retorno=new stdClass;
	$retorno->exito=0;
	
	if(@$_REQUEST['idtareas_listado']!=''){
		$retorno->exito=generar_tarea_recurrencia($_REQUEST['idtareas_listado']);	
	}
	return($retorno);

}

function generar_tarea_recurrencia($idtareas_listado){
	global $conn,$ruta_db_superior;
	
	$retorno=0;
	$fechas_tarea=busca_filtro_tabla(fecha_db_obtener('a.fecha_limite','Y-m-d')." as x_fecha_limite,".fecha_db_obtener('a.fecha_inicio','Y-m-d')." as x_fecha_inicio","tareas_listado a","a.idtareas_listado=".$idtareas_listado,"",$conn);
	$datos_tarea=busca_filtro_tabla("","tareas_listado a","a.idtareas_listado=".$idtareas_listado,"",$conn);
	$datos_recurrencia=busca_filtro_tabla("","tareas_listado_recur","(ejecuta_proxima IS NOT NULL AND ejecuta_proxima<>'0000-00-00') AND fk_tareas_listado=".$idtareas_listado,"",$conn);
	
	if($datos_recurrencia['numcampos']){
		
		$fecha_inicial=$fechas_tarea[0]['x_fecha_inicio'];
		$fecha_final=$fechas_tarea[0]['x_fecha_limite'];
		$dias_diferencia=resta_fechasphp($fecha_inicial,$fecha_final);
		
		$fecha_final_f = strtotime ( "+".$dias_diferencia." day" , strtotime ( $datos_recurrencia[0]['ejecuta_proxima'] ) ) ;	
		$nuevafecha = date ( 'Y-m-d' , $fecha_final_f );			
		
		
		$keys=array_keys($datos_tarea[0]);
		$keys_restriccion=array('idtareas_listado','fecha_creacion','fecha_inicio','progreso','calificacion','fk_tarea_recurrencia','fecha_limite','estado_tarea');
		$values_restriccion=array('',date('Y-m-d'),$datos_recurrencia[0]['ejecuta_proxima'],0,0,$datos_tarea[0]['idtareas_listado'],$nuevafecha,'PENDIENTE');
		$sql_keys="(";
		$sql_values=" VALUES (";
		
		for($i=0;$i<count($keys);$i++){
			if( !is_numeric($keys[$i]) && !in_array($keys[$i],$keys_restriccion)){
					$sql_keys.=$keys[$i].",";	
					$sql_values.="'".$datos_tarea[0][$keys[$i]]."',";						
			}
		}
		for($i=1;$i<count($keys_restriccion);$i++){
			if($i+1==count($keys_restriccion)){
				$sql_keys.=$keys_restriccion[$i].")";
				$sql_values.="'".$values_restriccion[$i]."')";							
			}else{
				$sql_keys.=$keys_restriccion[$i].",";
				$sql_values.="'".$values_restriccion[$i]."',";						
			}			
		}		
		$sql="INSERT INTO tareas_listado ".$sql_keys.$sql_values;
		
		phpmkr_query($sql);
		
		$proxima_ejecucion=calcula_ejecuta_proxima($idtareas_listado);
		
		if($proxima_ejecucion){
			$sql_update_recurrencia="UPDATE tareas_listado_recur SET ejecuta_proxima='".$proxima_ejecucion->format("Y-m-d")."' WHERE fk_tareas_listado=".$idtareas_listado;			
		}else{
			$sql_update_recurrencia="UPDATE tareas_listado_recur SET ejecuta_proxima=NULL WHERE fk_tareas_listado=".$idtareas_listado;			
		}

		phpmkr_query($sql_update_recurrencia);
		$retorno=1;	
	}	
	return($retorno);	
}


function actualizar_etiquetas_tarea(){
	global $conn,$ruta_db_superior;
	
	$retorno=new stdClass;
	$retorno->exito=0;
	
	if(@$_REQUEST['idtareas_listado']){

		$etiquetas_tarea=busca_filtro_tabla("a.idtareas_listado_etiquetas","tareas_listado_etiquetas a, etiqueta b","a.tareas_listado_fk=".$_REQUEST["idtareas_listado"]." AND a.etiqueta_idetiqueta=b.idetiqueta AND b.funcionario=".usuario_actual('funcionario_codigo'),"",$conn);
		$cadena_etiquetas_tarea=implode(',',extrae_campo($etiquetas_tarea,'idtareas_listado_etiquetas'));
		$sql1="DELETE FROM tareas_listado_etiquetas WHERE idtareas_listado_etiquetas IN(".$cadena_etiquetas_tarea.")";
		phpmkr_query($sql1);
		
		
		if(@$_REQUEST['etiquetas']){
			$valor=explode(',',$_REQUEST['etiquetas']);
			$longitud=count($valor);
			for($i=0;$i<$longitud;$i++){
				if($valor[$i]==''){
					unset($valor[$i]); 
				}
			}
			$valor=array_values($valor);
			$vector_etiquetas=$valor;
			
			$sql2="INSERT INTO tareas_listado_etiquetas (tareas_listado_fk,etiqueta_idetiqueta) VALUES ";
			for($i=0;$i<count($vector_etiquetas);$i++){
				$sql2.="('".$_REQUEST['idtareas_listado']."','".$vector_etiquetas[$i]."')";
				if($i+1!=count($vector_etiquetas)){
					$sql2.=",";
				}
			}		
			phpmkr_query($sql2);	
		}		
		$retorno->exito=1;
	}
	return($retorno);
		
}


function actualizar_fecha_planeada(){
	global $conn,$ruta_db_superior;

	$retorno=new stdClass;
	$retorno->exito=0;
	
	if(@$_REQUEST['fecha_planeada'] && @$_REQUEST['idtareas_listado']){
		//$sql="UPDATE tareas_listado SET fecha_planeada='".$_REQUEST['fecha_planeada']."' WHERE idtareas_listado=".$_REQUEST['idtareas_listado'];	
		//phpmkr_query($sql);
		$idfuncionario=usuario_actual('idfuncionario');
		$busca_responsable=busca_filtro_tabla("","tareas_listado","idtareas_listado=".$_REQUEST['idtareas_listado']." AND responsable_tarea=".$idfuncionario,"",$conn);
		

		
		
		if($busca_responsable['numcampos']){ //responsable
		    $strsql='';
		    $sql1='';
		    $busca_tarea_planeada=busca_filtro_tabla("idtareas_planeadas","tareas_planeadas","rol_tareas='responsable' AND fk_tareas_listado=".$_REQUEST['idtareas_listado']." AND funcionario_idfuncionario=".$idfuncionario,"",$conn);
		    if($busca_tarea_planeada['numcampos']){
		        
		        $fecha_planeada=explode('T',$_REQUEST['fecha_planeada']);
	        	$_REQUEST['fecha_planeada']=$fecha_planeada[0].' '.$fecha_planeada[1];		        
		        $sql1="UPDATE tareas_planeadas SET fecha_planeada='".$_REQUEST['fecha_planeada']."',fecha_planeada_fin='".@$_REQUEST['fecha_planeada_fin']."' WHERE idtareas_planeadas=".$busca_tarea_planeada[0]['idtareas_planeadas'];
		        phpmkr_query($sql1);
		    }else{
        		$tabla="tareas_planeadas";
        		$fieldList=array();
        		$fieldList["funcionario_idfuncionario"] = $idfuncionario;
        		$fieldList["fk_tareas_listado"] = $_REQUEST['idtareas_listado'];
        		$fieldList["rol_tareas"] = "responsable";
        	    $fieldList["fecha_planeada"] = $_REQUEST['fecha_planeada'];	
        	    $fieldList['fecha_planeada_fin']=@$_REQUEST['fecha_planeada_fin'];
        		
        		$strsql = "INSERT INTO ".$tabla." (";
        		$strsql .= implode(",", array_keys($fieldList));			
        		$strsql .= ") VALUES ('";			
        		$strsql .= implode("','", array_values($fieldList));			
        		$strsql .= "')";	
        		phpmkr_query($strsql);		        
		    }
		     $retorno->sql_insert=$strsql;	
		     $retorno->sql_update=$sql1;	
		     $retorno->exito=1;	
		} 
		
		$busca_coparticipante=busca_filtro_tabla("","tareas_listado","idtareas_listado=".$_REQUEST['idtareas_listado']." AND (co_participantes LIKE '%,".$idfuncionario."' OR co_participantes LIKE'".$idfuncionario.",%' OR co_participantes LIKE'%,".$idfuncionario.",%' OR co_participantes='".$idfuncionario."' OR co_participantes=".$idfuncionario." )","",$conn);
		if($busca_coparticipante['numcampos']){ //coparticipante
		
		    $busca_tarea_planeada=busca_filtro_tabla("idtareas_planeadas","tareas_planeadas","rol_tareas='coparticipante' AND fk_tareas_listado=".$_REQUEST['idtareas_listado']." AND funcionario_idfuncionario=".$idfuncionario,"",$conn);
		    if($busca_tarea_planeada['numcampos']){
		        $fecha_planeada=explode('T',$_REQUEST['fecha_planeada']);
	        	$_REQUEST['fecha_planeada']=$fecha_planeada[0].' '.$fecha_planeada[1];		        
		        $sql1="UPDATE tareas_planeadas SET fecha_planeada='".$_REQUEST['fecha_planeada']."',fecha_planeada_fin='".@$_REQUEST['fecha_planeada_fin']."' WHERE idtareas_planeadas=".$busca_tarea_planeada[0]['idtareas_planeadas'];
		        phpmkr_query($sql1);
		    }else{		
		
        		$tabla="tareas_planeadas";
        		$fieldList=array();
        		$fieldList["funcionario_idfuncionario"] = $idfuncionario;
        		$fieldList["fk_tareas_listado"] = $_REQUEST['idtareas_listado'];
        		$fieldList["rol_tareas"] = "coparticipante";
        	    $fieldList["fecha_planeada"] = $_REQUEST['fecha_planeada'];	
        	    $fieldList['fecha_planeada_fin']=@$_REQUEST['fecha_planeada_fin'];
        		
        		$strsql = "INSERT INTO ".$tabla." (";
        		$strsql .= implode(",", array_keys($fieldList));			
        		$strsql .= ") VALUES ('";			
        		$strsql .= implode("','", array_values($fieldList));			
        		$strsql .= "')";	
        		phpmkr_query($strsql);
		    }
		    $retorno->exito=1;
		    $retorno->sql_insert=$strsql;	
		    $retorno->sql_update=$sql1;		    
		} 		
	}	
    return($retorno);
}



?>
