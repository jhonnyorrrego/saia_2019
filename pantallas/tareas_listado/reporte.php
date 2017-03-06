<?php
$max_salida=10; // Previene algun posible ciclo infinito limitando a 10 los ../
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
include_once($ruta_db_superior."pantallas/lib/librerias_fechas.php");


function mostrar_funcionarios_1($idfuncionarios){
	global $conn,$ruta_db_superior;
	$separados= explode(",", $idfuncionarios);
	for ($i=0; $i < count($separados) ; $i++) { 
		$serie=busca_filtro_tabla("","funcionario","idfuncionario=".$separados[$i],"",$conn);
		
		$primer_nombre=explode(' ',$serie[0]['nombres']);
		$primer_nombre=$primer_nombre[0];
		$primer_apellido=explode(' ',$serie[0]['apellidos']);
		$primer_apellido=$primer_apellido[0];
	
		$primer_apellido=substr($primer_apellido,0,1);
		
		if($i+1==count($separados) ){
			$cadena.=$primer_nombre." ".$primer_apellido;
		}else{
			$cadena.=$primer_nombre." ".$primer_apellido.",";
		}
		
	}
	$cadena=ucwords(strtolower($cadena));
	return $cadena;	
}


function nombre_tarea_lista($listado_tareas_fk){
	global $conn,$ruta_db_superior;
	
	if($listado_tareas_fk==-1){
		return('Sin lista asignada a&uacute;n');
	}
	
	$lista= busca_filtro_tabla("","listado_tareas","idlistado_tareas=".$listado_tareas_fk,"",$conn);
	//$nombre_lista=substr($lista[0]['nombre_lista'],0,45);
	$nombre_lista=$lista[0]['nombre_lista'];
	$nombre_lista=strtolower($nombre_lista);
	$nombre_lista=ucwords($nombre_lista);
	return $nombre_lista;	
}

function mostrar_tiempo_transcurrido($idtareas_listado){
	global $conn,$ruta_db_superior;

	$dato_tiempo=busca_filtro_tabla('SUM(tiempo_registrado) AS total_tiempo','tareas_listado_tiempo','fk_tareas_listado='.$idtareas_listado,'',$conn);
	$total_tiempo=intval($dato_tiempo[0]["total_tiempo"]);	
	
	if ($total_tiempo){
		return '<span id="time_transcurrido_'.$idtareas_listado.'"> '.conversor_segundos_hm($total_tiempo).'</span>';
	} 
	else{
		return('<span id="time_transcurrido_'.$idtareas_listado.'">&nbsp;0</span>');
	}	
}

function mostrar_prioridad_tarea_reporte($idtarea,$prioridad,$progreso,$tipo_mostrar=0){
	global $conn,$ruta_db_superior;

	if($prioridad=='prioridad'){
		$prioridad="0";
	}
	if($progreso=='progreso'){
		$progreso=0;
	}

	$cadena="";	
	if($prioridad =="0"){ 
		$cadena="<i id='icon-prioridad_".$idtarea."' class='icon-flag-amarillo'  data-toggle='tooltip' title='Baja'></i> " ;
		$cadena2="Baja";
	}
	if($prioridad =="1"){
		$cadena="<i id='icon-prioridad_".$idtarea."' class='icon-flag-naranja' data-toggle='tooltip' title='Media'></i> ";
		$cadena2="Media";
	}
	if($prioridad =="2"){
		$cadena="<i id='icon-prioridad_".$idtarea."' class='icon-flag-morado' data-toggle='tooltip' title='Alta'></i>  ";
		$cadena2="Alta";
	}
	if($prioridad =="3"){
		$cadena="<i id='icon-prioridad_".$idtarea."' class='icon-flag-rojo' data-toggle='tooltip' title='Cr&iacute;tica'></i> ";
		$cadena2="Cr&iacute;tica";
	}

	$cadena="<span class='contenedor_prioridad_tarea'>".$cadena."</span>";
	if($tipo_mostrar==1){
		$cadena=$cadena2;
	}
	return $cadena;


}

function trar_hora_minuto(){
	return date("H:i");
}

function traer_ruta_superior(){
	global $conn,$ruta_db_superior;
	
	return $ruta_db_superior;
}

function generar_rand(){
	return(rand());
}


function generar_linea_calificacion($idtareas_listado,$calificacion,$progreso){
	global $conn,$ruta_db_superior;
           $retorno_calif = '
            	<input type="text" name="rating_'.$idtareas_listado.'" id="rating_'.$idtareas_listado.'" value="'.$calificacion.'"/> 
            	<ul >
            ';
            for ($j = 1; $j < 6; $j++) {
              $checked='';	
              $required = "";
              if ($j == 1) {
                $required = ' required';
              }
              $checked = "";
              if ($j <= $calificacion) {
                $checked = 'estrella_seleccionada';
              }
			  
			  $retorno_calif.='
			  <li data-toggle="tooltip" title="'.$j.'" style="cursor:pointer;" class="estrellas '.$checked.' " id="'.$idtareas_listado.'_calificacion_'.$j.'"   name="calificacion_' .$idtareas_listado. '" value="' . $j . '"  class="calificacion '.$required.' '.$checked.' " idtareas_listado="'.$idtareas_listado.'" onmouseover="highlightStar_'.$idtareas_listado.'('.$j.');" onmouseout="removeHighlight_'.$idtareas_listado.'();" onClick="addRating_'.$idtareas_listado.'('.$j.');">&#9733;</li>
			  ';
			$retorno_calif.='
				<script>
				function highlightStar_'.$idtareas_listado.'(obj) {
					var valor = obj;
					for(i=0;i<6;i++){
						if(i+1<=valor){
							$(\'#'.$idtareas_listado.'_calificacion_\'+(i+1)+\'\').addClass(\'estrella_seleccionada\');
						}else{
							$(\'#'.$idtareas_listado.'_calificacion_\'+(i+1)+\'\').removeClass(\'estrella_seleccionada\');
						}
					}						
				 }
				  function removeHighlight_'.$idtareas_listado.'() {
					
					var valor = $(\'#rating_'.$idtareas_listado.'\').val();
					for(i=0;i<6;i++){
						if(i+1<=valor){
							$(\'#'.$idtareas_listado.'_calificacion_\'+(i+1)+\'\').addClass(\'estrella_seleccionada\');
						}else{
							$(\'#'.$idtareas_listado.'_calificacion_\'+(i+1)+\'\').removeClass(\'estrella_seleccionada\');
						}
					}	
				  }
				  function addRating_'.$idtareas_listado.'(obj) {
				      $(\'#'.$idtareas_listado.'_calificacion_\'+obj+\'\').addClass(\'estrella_seleccionada\');
				      $(\'#rating_'.$idtareas_listado.'\').val( $(\'#'.$idtareas_listado.'_calificacion_\'+obj+\'\').attr(\'value\') );
					  
					  var observaciones=$(\'#observaciones_calificacion_'.$idtareas_listado.'\').val();
					  var calificacion=$(\'#'.$idtareas_listado.'_calificacion_\'+obj+\'\').attr(\'value\');
					  
						$.ajax({
	                        type:"POST",
	                        dataType: "json",
	                        url: "{*traer_ruta_superior*}pantallas/tareas_listado/ejecutar_acciones.php",
	                        data: {
	                        				tipo_retorno:2,
	                        				ejecutar_accion_tarea:"actualizar_calificacion",
	                                        idtareas_listado:'.$idtareas_listado.',
	                                        observaciones:observaciones,
	                                        calificacion:calificacion
	                        },
	                        success: function(datos){
								   
	                        		$("#progreso'.$idtareas_listado.',#prioridades'.$idtareas_listado.',#fecha'.$idtareas_listado.'").css("display", "none");
									$("#observaciones_calificacion_'.$idtareas_listado.'").val("");
									notificacion_saia("Calificacion Registrada Satisfactoriamente","success","",4000);
									
									if(datos.exito_recurrencia){
										notificacion_saia("Recurrencia Generada Satisfactoriamente","success","",4000);
									}
									
									if ( $("#historial_calificaciones_'.$idtareas_listado.'").length > 0 ) {
										var add_tabla="<tr><td></td><td>"+datos.fecha_hora+"</td><td>"+datos.calificacion_stars+"</td><td>"+observaciones+"</td></tr>";
										if($("#encabezado_historial_calificaciones_'.$idtareas_listado.'").length == 0){
											var encabezado="<tr id=\'encabezado_historial_calificaciones_'.$idtareas_listado.'\'><th>Funcionario</th><th>Fecha y Hora</th><th>Calificacion</th><th>Observaci&oacute;n</th></tr>";
											$("#historial_calificaciones_'.$idtareas_listado.'").after(encabezado);
										}
										
										$("#encabezado_historial_calificaciones_'.$idtareas_listado.'").after(add_tabla);
									}

									
	                        }
	                    }); 					   
				  }
				</script>			
			';					  

            }
            $retorno_calif.= '<script>$("#rating_'.$idtareas_listado.'").hide();</script>';
            $retorno_calif.='</ul>';
			$retorno_calif.='<textarea style="margin-left: 20px;" placeholder="Observaciones..." id="observaciones_calificacion_'.$idtareas_listado.'"></textarea>';
			
			$calificaciones_tarea=busca_filtro_tabla("","tareas_listado_evalua","fk_tareas_listado=".$idtareas_listado,"fecha_hora DESC",$conn);
			
			$stars=array(1=>'&#9733;',2=>'&#9733;&#9733;',3=>'&#9733;&#9733;&#9733;',4=>'&#9733;&#9733;&#9733;&#9733;',5=>'&#9733;&#9733;&#9733;&#9733;&#9733;');
			
			$retorno_calif.='<table class="table table-bordered" id="historial_calificaciones_'.$idtareas_listado.'">';
			if($calificaciones_tarea['numcampos']){
				$retorno_calif.='
						<tr id="encabezado_historial_calificaciones_'.$idtareas_listado.'">
							<th>Funcionario</th>
							<th>Fecha y Hora</th>
							<th>Calificacion</th>
							<th>Observaci&oacute;n</th>
							</tr>
				';				
				for($i=0;$i<$calificaciones_tarea['numcampos'];$i++){
					
					$retorno_calif.='<tr>';
					if($i==0){
						$fun_calificacion=busca_filtro_tabla("nombres,apellidos","funcionario","idfuncionario=".$calificaciones_tarea[$i]['funcionario_idfuncionario'],"",$conn);
						
						$nombre_fun_calificacion=ucwords(strtolower($fun_calificacion[0]['nombres'].' '.$fun_calificacion[0]['apellidos']));
						$retorno_calif.='
							<td style="vertical-align:middle;" rowspan="'.($calificaciones_tarea['numcampos']).'" id="funcionario_historial_calificaciones_'.$idtareas_listado.'">
								'.$nombre_fun_calificacion.'
							</td>
						';						
					}
					$retorno_calif.='<td>'.$calificaciones_tarea[$i]['fecha_hora'].'</td>';
					$retorno_calif.='<td>'.$stars[$calificaciones_tarea[$i]['calificacion']].'</td>';
					$retorno_calif.='<td>'.codifica_encabezado(html_entity_decode($calificaciones_tarea[$i]['observaciones'])).'</td>';
					$retorno_calif.='</tr>';
				}
				
			}
			$retorno_calif.='</table>';
			
			
			$ajax='
			    <script>
			        $("#calificacion'.$idtareas_listado.'").click(function(){
                        $.ajax({
                            type:"POST",
                            dataType: "json",
                            url: "{*traer_ruta_superior*}pantallas/tareas_listado/mostrar_informacion_opcion.php",
                            data:{opcion:14,idtareas_listado:'.$idtareas_listado.'},
                            success: function(datos){
                            	$("#tab9_'.$idtareas_listado.'").html(datos.valor);  
                            } 
                        });  			            
			        });
			    </script>
			';
			
			if($progreso=='progreso'){
				$progreso=0;
			}
			if($progreso==100){
			    $retorno_calif.=$ajax;
				return($retorno_calif);	
			}else{
				return('<div class="alert alert-warning" style="text-align:center; font-size:10pt;"><b>ATENCI&Oacute;N!</b> <br/> La tarea debe tener un progreso del 100% para ser calificada, actualmente se encuentra al '.$progreso.'%</div>'.$ajax);
			}
			
            
}

/*
function mostrar_cantidad_subtareas($idtareas_listado){
	global $conn,$ruta_db_superior;
	
	$subtareas=busca_filtro_tabla('','tareas_listado','cod_padre='.$idtareas_listado,'',$conn);
	$cadena='<span id="cantidad_subtareas_'.$idtareas_listado.'" class="badge">'.$subtareas['numcampos'].'</span>&nbsp;';
	return($cadena);	
}   
*/

function condicion_tareas_listado(){ 
	global $conn,$ruta_db_superior; 
	
	//llega la variable @$_REQUEST['rol_tareas'], se manda desde index_actualizacion.php o desde tareas_listado/listar_procesos.php
	

	if(@$_REQUEST['rol_tareas']){
		switch($_REQUEST['rol_tareas']){
			case 'todos':
				$condicion="a.cod_padre=0 AND a.estado_tarea<>'TERMINADO' AND (a.responsable_tarea=".usuario_actual('idfuncionario');
				$condicion.=" OR FIND_IN_SET('".usuario_actual('idfuncionario')."', a.co_participantes)";
				$condicion.=" OR FIND_IN_SET('".usuario_actual('idfuncionario')."', a.seguidores)";
				$condicion.=" OR a.evaluador=".usuario_actual('idfuncionario');
				$condicion.=")";				
				break;
			case 'seguidor':
				$condicion="a.cod_padre=0 AND a.estado_tarea<>'TERMINADO' AND (a.listado_tareas_fk<>-1 AND  FIND_IN_SET('".usuario_actual('idfuncionario')."', a.seguidores) )";
				break;
				
			case 'coparticipante':
				$condicion="a.cod_padre=0 AND a.estado_tarea<>'TERMINADO' AND (a.listado_tareas_fk<>-1 AND  FIND_IN_SET('".usuario_actual('idfuncionario')."', a.co_participantes) )";
				break;	
			case 'responsable':
				$condicion="a.cod_padre=0 AND a.estado_tarea<>'TERMINADO' AND (a.listado_tareas_fk<>-1 AND  a.responsable_tarea=".usuario_actual('idfuncionario')." )";
				break;	
 			case 'evaluador':
				$condicion="a.cod_padre=0 AND a.estado_tarea<>'TERMINADO' AND (a.listado_tareas_fk<>-1 AND  a.evaluador=".usuario_actual('idfuncionario')." )";
				break;	
 			case 'tareas_rapidas':
				$condicion="a.cod_padre=0  AND (a.listado_tareas_fk=-1 AND  a.creador_tarea=".usuario_actual('idfuncionario')." )";
				break;				
 			case 'tareas_vencidas':
 				$fecha=date('Y-m-d');
				$fecha_final = strtotime ( "-1 day" , strtotime ( $fecha ) ) ;	
				$fecha_validar = date ( 'Y-m-d' , $fecha_final ); 			
				$condicion="a.fecha_limite<>'0000-00-00' AND a.cod_padre=0  AND (a.listado_tareas_fk<>-1 AND a.estado_tarea IN('PENDIENTE','EJECUCION') AND a.fecha_limite<='".$fecha_validar."' AND a.responsable_tarea=".usuario_actual('idfuncionario')." )";
				break;	
 			case 'tareas_terminadas':
				$condicion="a.cod_padre=0  AND (a.estado_tarea='TERMINADO' AND a.listado_tareas_fk<>-1  AND a.responsable_tarea=".usuario_actual('idfuncionario')." )";
				break;
 			case 'tarea_unica':
				$condicion=" a.idtareas_listado=".@$_REQUEST['idtareas_listado_unico'];
				break;	
			case 'tarea_generica':
				$condicion=" a.generica=1";	
				break;				
			default:
				$condicion='1=1';	
				break;											
		}	
		
		
		if(@$_REQUEST['filtro_macroproceso']){ //filtro macroproceso
			
			$condicion_macro_proceso=" AND b.macro_proceso IN(".$_REQUEST['filtro_macroproceso'].")";
			$condicion.=$condicion_macro_proceso;
		}
		if(@$_REQUEST['filtro_macroproceso_proceso']){  //filtro macroproceso/proceso
			$condicion.=" AND  b.macro_proceso=".$_REQUEST['filtro_macroproceso_proceso'];
		}		
		if(@$_REQUEST['listado_tareas_fk']){  //filtro macroproceso/proceso/listado_tareas_fk
			$condicion.=" AND  a.listado_tareas_fk=".$_REQUEST['listado_tareas_fk'];
		}		
		if($_REQUEST['rol_tareas']!='tarea_generica'){
			$condicion.=" AND a.generica=0"; //TAREAS PREDETERMINADA NO LAS MUESTRA
		}
		
		if(@$_REQUEST['filtro_etiqueta']){
			 $condicion.=" AND c.etiqueta_idetiqueta=".$_REQUEST['filtro_etiqueta'];
		}
		
	}else{
		$condicion='1=1';
	}
 
	return($condicion);	
}

function traer_usuario_actual(){
	return(usuario_actual('idfuncionario'));
}


function ocultar_tarea_terminada($idtareas_listado,$estado_tarea,$evaluador,$creador_tarea,$listado_tareas_fk="",$generica=''){
	global $conn,$ruta_db_superior;
	
	$cadena='<style>';
	if($estado_tarea=='TERMINADO'){   //SI LA TAREA ESTA TERMINADA
		$cadena.='
				#editar_tarea_'.$idtareas_listado.',#eliminar_tarea_'.$idtareas_listado.',#progreso'.$idtareas_listado.',#prioridades'.$idtareas_listado.',#fecha'.$idtareas_listado.'{
					display:none;
				}
				#bprogreso'.$idtareas_listado.',#bprioridades'.$idtareas_listado.',#bfecha'.$idtareas_listado.'{
					display:none;
				}		
		';
	}
	if(usuario_actual('idfuncionario')!=$evaluador){  //SOLO PUEDE EVALUAR LA PERSONA SELECCIONADA COMO EVALUADOR
		$cadena.='
				#calificacion'.$idtareas_listado.',#bcalificacion'.$idtareas_listado.'{
					display:none;
				}
				#fecha'.$idtareas_listado.',#bfecha'.$idtareas_listado.'{
					display:none;
				}
				#editar_tarea_'.$idtareas_listado.'{
					display:none;
				}				
		';
	}else{  //SOLO EDITA EL EVALUADOR
	    $cadena.='
				#editar_tarea_'.$idtareas_listado.'{
					display:block;
				}	    
	    ';
	}
	if(usuario_actual('idfuncionario')!=$creador_tarea){   //SOLO PUEDE ELIMINAR LA TAREA QUIEN LA CREO
		$cadena.='
				#eliminar_tarea_'.$idtareas_listado.'{
					display:none;
				}
		';			
	}
	if($listado_tareas_fk!=""){
		if($listado_tareas_fk==-1){   //SI ES UNA TAREA RAPIDA NO PUEDE ACCEDER A SUBTAREAS
			$cadena.='
					#mostrar_subtareas_'.$idtareas_listado.'{
						display:none;
					}
			';			
		}
	}
	if($generica!=''){
		if($generica==1){
			$cadena.='
				.info_tareas,.menu_componentes,.contenedor_cantidad_tareas{
					display:none;
				}					
			';			
		}
	}
	
	$cadena.='</style>';
	return($cadena);
}


function mostrar_enlaces_tareas_listado($idtareas_listado){
	global $conn,$ruta_db_superior;
	
	
	$mensaje_segun=' Tarea';
	if(@$_REQUEST['ocultar_subtareas']){
		$mensaje_segun=' Subtarea';
	}

	$cadena='';
	/*
	if(!@$_REQUEST['ocultar_subtareas']){
		$subtareas=busca_filtro_tabla('','tareas_listado','cod_padre='.$idtareas_listado,'',$conn);
		$cantidad='<div class="pull-right kenlace_saia contenedor_cantidad_tareas" style="cursor:pointer" data-toggle="tooltip" title="Subtareas" titulo="Subtareas" title="Subtareas" enlace="pantallas/busquedas/consulta_busqueda_subtareas_listado.php?idtareas_listado='.$idtareas_listado.'&idbusqueda_componente=221&ocultar_subtareas=1" conector="iframe">';
		$cantidad.='<span id="cantidad_subtareas_'.$idtareas_listado.'" class="badge">'.$subtareas['numcampos'].'</span>&nbsp;';
		$cantidad.='</div>';
		$cadena.='&nbsp;&nbsp; '.$cantidad.'';		
	}
	*/
	
	$cadena.='
	
	  <div data-toggle="tooltip" class="btn btn-mini pull-right eliminar_tarea" title="Eliminar" titulo="Eliminar" idtarea="'.$idtareas_listado.'" id="eliminar_tarea_'.$idtareas_listado.'">
	    <i class="icon-trash"></i>
	  </div>
	  
	  <div data-toggle="tooltip" class="btn btn-mini kenlace_saia pull-right" title="Editar '.$mensaje_segun.'" titulo="Editar '.$mensaje_segun.'" enlace="pantallas/tareas_listado/editar_tareas_listado.php?pestana=kp2&idtareas_listado='.$idtareas_listado.'" id="editar_tarea_'.$idtareas_listado.'" conector="iframe">
	    <i class="icon-pencil"></i>
	  </div>	
	
	
	';

	return($cadena);
}


function mostrar_informacion_recurrencia($idtareas_listado,$fk_tarea_recurrencia){
	global $conn,$ruta_db_superior;
	
	$cadena='
	<script>
		$("#recurrencia'.$idtareas_listado.',#brecurrencia'.$idtareas_listado.'").click(function(){
              $.ajax({
                type:"POST",
                dataType: "json",
                url: "{*traer_ruta_superior*}pantallas/tareas_listado/mostrar_informacion_opcion.php",
                data:{opcion:11,idtareas_listado:'.$idtareas_listado.'},
                success: function(datos){
				   $("#contenedor_resumen_recurrencia_'.$idtareas_listado.'").remove();	
                  $("#tab10_'.$idtareas_listado.'").append(datos.valor);
                } 
                });
		});
	</script>
	
	';
	
	return($cadena);	
	
}


function mostrar_informacion_seguidores($idtareas_listado){
	
	
	
	$cadena='
	<script>
		$("#seguidores'.$idtareas_listado.',#bseguidores'.$idtareas_listado.'").click(function(){
              $.ajax({
                type:"POST",
                dataType: "json",
                url: "{*traer_ruta_superior*}pantallas/tareas_listado/mostrar_informacion_opcion.php",
                data:{opcion:12,idtareas_listado:'.$idtareas_listado.'},
                success: function(datos){
				  $("#mostrar_resumen_seguidores_'.$idtareas_listado.'").remove(); 
                  $("#tab11_'.$idtareas_listado.'").append(datos.valor);
				  
				 
                } 
                });
		});
	</script>
	
	';
	return($cadena);	
	
}



function mostrar_informacion_etiquetas($idtareas_listado){
	$cadena='
	<script>
		$("#etiquetas'.$idtareas_listado.',#betiquetas'.$idtareas_listado.'").click(function(){
              $.ajax({
                type:"POST",
                dataType: "json",
                url: "{*traer_ruta_superior*}pantallas/tareas_listado/mostrar_informacion_opcion.php",
                data:{opcion:13,idtareas_listado:'.$idtareas_listado.'},
                success: function(datos){
					$("#mostrar_informacion_etiquetas_'.$idtareas_listado.'").remove(); 
                	$("#tab12_'.$idtareas_listado.'").append(datos.valor);  
                } 
                });
		});
	</script>
	
	';
	return($cadena);	
}



function mostrar_fecha_vencimiento($fecha_limite,$idtareas_listado){
	global $conn,$ruta_db_superior;

	if($fecha_limite!='fecha_limite'){	

		$accion='';
		$interval=resta_dos_fechas_saia($fecha_limite);
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
	
		$cadena='
				<span class="contenedor_fecha_vencimiento " id="contenedor_fecha_vencimiento_'.$idtareas_listado.'" style="background-color:'.$color.';">&nbsp;'.$fecha_limite.'&nbsp;</span>	
		';
		
		if($fecha_limite=='0000-00-00'){
			return('');
		}else{
			
			$datos_tarea=busca_filtro_tabla("estado_tarea","tareas_listado","idtareas_listado=".$idtareas_listado,"",$conn);
			
			if($datos_tarea[0]['estado_tarea']=='TERMINADO'){
				return('');
			}else{
				return($cadena);
			}
			
			
		}	

	}
	else{
		return('');
	}	
}

function mostrar_fecha_inicio($fecha_inicio,$idtareas_listado){
	global $conn,$ruta_db_superior;

	if($fecha_inicio!='fecha_inicio'){	
		$cadena='
				<span class="contenedor_fecha_inicio encabezado_list" id="contenedor_fecha_inicio_'.$idtareas_listado.'">&nbsp;'.$fecha_inicio.'&nbsp;</span>	
				<br>
		';
		
		return($cadena);
	}
	else{
		return('');
	}	
}

function mostrar_dias_fecha_vencimiento($fecha_limite,$idtareas_listado){
	global $conn,$ruta_db_superior;
	
	if($fecha_limite!='fecha_limite'){

		$accion='';
		$interval=resta_dos_fechas_saia($fecha_limite);
		if($interval->invert==1){
			if($interval->days>5){  //verde
				$aviso='<b>Falta: '.$interval->days.'</b> dias';    
			}else if($interval<=5){ //amarillo
				if($interval->days==0){
					$aviso='<b>Hoy</b>';
				}else{
					$aviso='<b>Falta: '.$interval->days.'</b> dias';
				}
			}
		}else{
			if($interval->days==0){ //amarillo
				if($interval->days==0){ 
					$aviso='<b>Hoy</b>';
				}else{
					$aviso='<b>Falta: '.$interval->days.'</b> dias';
				}
			}else{   //rojo
				$aviso='<b>Hace: '.$interval->days.'</b> dias';	
			}	
		}
	
		$cadena='
				<span id="contenedor_dias_fecha_vencimiento_'.$idtareas_listado.'" >'.$aviso.'</span>	
		';
	
		
		if($fecha_limite=='0000-00-00'){
			return('');
		}else{
			$datos_tarea=busca_filtro_tabla("estado_tarea","tareas_listado","idtareas_listado=".$idtareas_listado,"",$conn);
			
			if($datos_tarea[0]['estado_tarea']=='TERMINADO'){
				return('');
			}else{
				return($cadena);
			}
		}	
			
	
	}
	else{
		return('');
	}	
}

function mostrar_estado_tarea($estado_tarea,$progreso,$idtarea){
			
		$estado_tarea=strtolower($estado_tarea);
		$estado_tarea=ucwords($estado_tarea);
		
		if($progreso=='progreso'){
			$progreso='0';
		}
		//$cadena='<span>'.$estado_tarea."</span> &nbsp;<span class='contenedor_progreso_tarea' id='progreso_titulo_".$idtarea."' style='vertical-align:bottom;'>".$progreso."%</span>";
			$cadena="<span class='contenedor_progreso_tarea' id='progreso_titulo_".$idtarea."' style='vertical-align:bottom;'>".$progreso."%</span>";
	return $cadena;		
	
	
	
}



function generar_semaforo_planeador($fecha_limite){
	global $conn,$ruta_db_superior;
	
	if($fecha_limite!='fecha_limite'){
		$interval=resta_dos_fechas_saia($fecha_limite);
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
	
		if($fecha_limite<>'0000-00-00 00:00:00'){
			return("style='border-color:".$color.";background-color:".$color."' color='".$color."' ");
		}else{
			return("");
		}			
					
	}else{
		return("");
	}
	

		
}


function mostrar_previa_nombre_tarea($nombre_tarea){
	
	$pos = strpos($nombre_tarea, 'acute;');
	$rango=array(17,18,19,20,21,22);
	if(in_array($pos, $rango)){
		$pos = strpos($nombre_tarea, '&');
		$previa=substr($nombre_tarea,0,$pos);
	}else{
		$previa=substr($nombre_tarea,0,20);
	}
	$previa=ucfirst(strtolower($previa));
	if(strlen($nombre_tarea)>20){
		$previa.='...';
	}	
	//return($previa);
	
	return(ucfirst(strtolower($nombre_tarea)));
}

function mostrar_cantidad_subtareas($idtareas_listado){
	 global $conn;
	 
	if(!@$_REQUEST['ocultar_subtareas']){
	    
	    
	    $componente_subtareas=busca_filtro_tabla("idbusqueda_componente","busqueda_componente"," lower(nombre)='subtareas_listado' ","",$conn);
	    
		$subtareas=busca_filtro_tabla('','tareas_listado','generica=0 AND cod_padre='.$idtareas_listado,'',$conn);
		$cantidad='<span class="kenlace_saia contenedor_cantidad_tareas" style="cursor:pointer" data-toggle="tooltip" title="Subtareas" titulo="Subtareas" title="Subtareas" enlace="pantallas/busquedas/consulta_busqueda_subtareas_listado2.php?idtareas_listado='.$idtareas_listado.'&idbusqueda_componente='.$componente_subtareas[0]['idbusqueda_componente'].'&ocultar_subtareas=1" conector="iframe">';
		$cantidad.='<span id="cantidad_subtareas_'.$idtareas_listado.'" class="badge">'.$subtareas['numcampos'].'</span>&nbsp;';
		$cantidad.='</span>';
		$cadena.=''.$cantidad.'';	
		return($cadena);	
	}	
}


function filtrar_calendario_planeador(){
    global $conn,$ruta_db_superior;
    $condicion='';
    if(@$_REQUEST['variable_busqueda']){
    	$vector_variable_busqueda=explode('|',@$_REQUEST['variable_busqueda']);
    	for($i=0;$i<count($vector_variable_busqueda);$i++){
    		$vector_valores=explode('@',$vector_variable_busqueda[$i]);
    		switch($vector_valores[0]){
    			case 'listado_tareas_fk':
    				$vector_listado_tareas_fk=explode(',',$vector_valores[1]);
    				$listado_tareas_fk=busca_filtro_tabla("idlistado_tareas","listado_tareas","macro_proceso=".$vector_listado_tareas_fk[0],"",$conn);
    				$condicion.=" AND a.listado_tareas_fk IN(".implode(',',extrae_campo($listado_tareas_fk,'idlistado_tareas','U')).")";
    				break;
    			default:
    				break;	
    		}
    	}
    }
    return($condicion);
}

function generar_slider_progreso($idtareas_listado,$progreso){
    
    
    $retorno='
            <div class="layout-slider slider_saia">
              <input id="slider_'.$idtareas_listado.'" type="slider" name="porcentaje_'.$idtareas_listado.'" value="'.$progreso.'" class="slider_saia_value" idtarea="'.$idtareas_listado.'" />
            </div>
            <script type="text/javascript" charset="utf-8">
                $("#slider_'.$idtareas_listado.'").slider({ from: 0, to: 100, step: 1, round: 1, dimension: "&nbsp;%", skin: "round", callback: function( value ){save_progreso_tarea('.$idtareas_listado.',value);} });
            </script>
    ';
    
			$ajax='
			    <script>
			        $("#progreso'.$idtareas_listado.'").click(function(){
                        $.ajax({
                            type:"POST",
                            dataType: "json",
                            url: "{*traer_ruta_superior*}pantallas/tareas_listado/mostrar_informacion_opcion.php",
                            data:{opcion:15,idtareas_listado:'.$idtareas_listado.'},
                            success: function(datos){
                                $("#tab1_'.$idtareas_listado.'").html("");
                            	$("#tab1_'.$idtareas_listado.'").html(datos.valor);  
                            } 
                        });  			            
			        });
			    </script>
			';    
    
    return($retorno.$ajax);
    
}


?>