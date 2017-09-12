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

function pre_ingresar_distribucion($iddoc,$campo_origen,$tipo_origen,$campo_destino,$tipo_destino,$estado_distribucion=1,$estado_recogida=0){
	global $conn,$ruta_db_superior;
		
	$datos_plantilla=busca_filtro_tabla("b.nombre_tabla","documento a,formato b","lower(a.plantilla)=lower(b.nombre) AND a.iddocumento=".$iddoc,"",$conn);	
	$nombre_tabla=$datos_plantilla[0]['nombre_tabla'];
			
	$datos_documento=busca_filtro_tabla($campo_origen.",".$campo_destino,$nombre_tabla,"documento_iddocumento=".$iddoc,"",$conn);
	if($datos_documento['numcampos']){
		
		$lista_destinos=explode(',',$datos_documento[0][$campo_destino]);
		for($i=0;$i<count($lista_destinos);$i++){
			$datos_distribucion=array();
			$datos_distribucion['origen']=$datos_documento[0][$campo_origen];
			$datos_distribucion['tipo_origen']=$tipo_origen;
			$datos_distribucion['destino']=$lista_destinos[$i];
			$datos_distribucion['tipo_destino']=$tipo_destino;
			$datos_distribucion['estado_distribucion']=$estado_distribucion;
			$datos_distribucion['estado_recogida']=$estado_recogida;
			
			$ingresar=ingresar_distribucion($iddoc,$datos_distribucion);
		}	
			
	} //fin if $datos_documento['numcampos']
}
function ingresar_distribucion($iddoc,$datos,$iddistribucion=0){
	global $conn,$ruta_db_superior;
	
	/*
	 * $iddoc = iddocumento de la tabla documento
	 * $datos
	 	* ['origen']   		---> iddependencia_cargo ó iddatos_ejecutor
	 	* ['tipo_origen']	---> 1,funcionario;2,ejecutor
	 	* ['destino']		---> iddependencia_cargo ó dependencia#, ó iddatos_ejecutor
	 	* ['tipo_destino']	---> 1,funcionario;2,ejecutor
	 	* ['estado_distribucion']  ---> 0,Pediente; 1,Por Distribuir; 2,En distribucion; 3,Finalizado
	 	* ['estado_recogida'] ---> 0, No; 1, Si
	 * $iddistribucion = si se desea ingresar la distribucion que una llave especifica, se usa para migrar viejas distribuciones a la nueva distribucion
	*/
	
	//--------------------------------------------------------
	
	//OBTENER RUTA_ORIGEN
	$idft_ruta_distribucion_origen=0;
	if($datos['tipo_origen']==1){
		$idft_ruta_distribucion_origen=obtener_ruta_distribucion($datos['origen']);
	}
	//OBTENER MENSAJERO_RUTA_ORIGEN
	$iddependencia_cargo_mensajero_origen=0;
	if($idft_ruta_distribucion_origen){
		$iddependencia_cargo_mensajero_origen=obtener_mensajero_ruta_distribucion($idft_ruta_distribucion_origen);
	}
	
	//---------------------------------------------------------------
	
	//ESTADO RECOGIDA
	$estado_recogida=0;
	if($datos['tipo_origen']==2){  //SI VIENE DE AFUERA
		$estado_recogida=1;
	}
	if(@$datos['estado_recogida']){ //SI NO REQUIEREN RECOGER
		$estado_recogida=1;
	}
	
	
	//ESTADO_DISTRIBUCION
	$estado_distribucion=0;
	if(@$datos['estado_distribucion']){
		$estado_distribucion=$datos['estado_distribucion'];
	}
	
	//FECHA DE CREACION
	$fecha_creacion=fecha_db_almacenar(date('Y-m-d H:i:s'),'Y-m-d H:i:s');
	
	//--------------------------------------------------------
	
	//ORGANIZAR DESTINOS DEPENDENCIA - ROLES
	$array_destinos=array();
	$es_dependencia=0;
	if( $datos['destino'][ (strlen($datos['destino'])-1) ] == '#' ){
		$es_dependencia=1;
	}
	if($es_dependencia){
		$array_destinos=obtener_funcionarios_dependencia_destino($datos['destino']);	
		
	}else{
		$array_destinos[]=$datos['destino'];
	}
	
	$array_iddistribucion=array();
	for($j=0;$j<count($array_destinos);$j++){
		
		//NUMERO DE DISTRIBUCION
		$numero_distribucion=obtener_numero_distribucion($iddoc);		
	
		//OBTENER RUTA_DESTINO
		$idft_ruta_distribucion_destino=0;
		if($datos['tipo_destino']==1){
			$idft_ruta_distribucion_destino=obtener_ruta_distribucion($array_destinos[$j]);
		}	
		//OBTENER MENSAJERO_RUTA_DESTINO
		$iddependencia_cargo_mensajero_destino=0;
		if($idft_ruta_distribucion_destino){
			$iddependencia_cargo_mensajero_destino=obtener_mensajero_ruta_distribucion($idft_ruta_distribucion_destino);
		}	
		
		//---------------------------------------------------------
		$campo_iddistribucion="";
		$valor_iddistribucion="";
		if($iddistribucion){
			$campo_iddistribucion="iddistribucion,";
			$valor_iddistribucion=$iddistribucion.",";			
		}
		
		
		//INSERTAR DISTRIBUCION
		$sqli="INSERT INTO distribucion
			(
				".$campo_iddistribucion."
				origen,
				tipo_origen,
				ruta_origen,
				mensajero_origen,
				
				destino,
				tipo_destino,
				ruta_destino,
				mensajero_destino,
				
				numero_distribucion,
				estado_distribucion,
				estado_recogida,
				
				documento_iddocumento,
				fecha_creacion
			) 
				VALUES 
			(
				".$valor_iddistribucion."
				".$datos['origen'].",
				".$datos['tipo_origen'].",
				".$idft_ruta_distribucion_origen.",
				".$iddependencia_cargo_mensajero_origen.",
				
				".$array_destinos[$j].",
				".$datos['tipo_destino'].",
				".$idft_ruta_distribucion_destino.",
				".$iddependencia_cargo_mensajero_destino.",
				
				".$numero_distribucion.",
				".$estado_distribucion.",
				".$estado_recogida.",
				
				".$iddoc.",
				".$fecha_creacion."
				
			)
				
		";	
		phpmkr_query($sqli);
		$array_iddistribucion[]=phpmkr_insert_id();
		
	}
	return($array_iddistribucion);
	
}
function obtener_ruta_distribucion($iddependencia_cargo){
	global $conn,$ruta_db_superior;	
	
	$dependencia_funcionario=busca_filtro_tabla("iddependencia","vfuncionario_dc","iddependencia_cargo=".$iddependencia_cargo,"",$conn);
	
	$ruta_distribucion=busca_filtro_tabla("a.idft_ruta_distribucion","ft_ruta_distribucion a, documento b, ft_dependencias_ruta c","a.documento_iddocumento=b.iddocumento AND lower(b.estado)='aprobado' AND a.idft_ruta_distribucion=c.ft_ruta_distribucion AND c.estado_dependencia=1 AND dependencia_asignada=".$dependencia_funcionario[0]['iddependencia'],"",$conn);

	$retorno=0;
	if($ruta_distribucion['numcampos']){
		$retorno=$ruta_distribucion[0]['idft_ruta_distribucion'];
	}
	return($retorno);
}
function obtener_mensajero_ruta_distribucion($idft_ruta_distribucion){
	global $conn,$ruta_db_superior;	
	
	$mensajero_ruta_distribucion=busca_filtro_tabla("c.mensajero_ruta","ft_ruta_distribucion a, documento b, ft_funcionarios_ruta c","a.documento_iddocumento=b.iddocumento AND lower(b.estado)='aprobado' AND a.idft_ruta_distribucion=c.ft_ruta_distribucion AND c.estado_mensajero=1 AND a.idft_ruta_distribucion=".$idft_ruta_distribucion,"",$conn);
	$retorno=0;
	if($mensajero_ruta_distribucion['numcampos']){
		$retorno=$mensajero_ruta_distribucion[0]['mensajero_ruta'];
	}
	return($retorno);	
		
}
function obtener_numero_distribucion($iddoc){
	global $conn,$ruta_db_superior;	
	
	$numero_radicado=busca_filtro_tabla("numero,estado","documento","iddocumento=".$iddoc,"",$conn);
	$distribuciones_iddoc=busca_filtro_tabla("iddistribucion","distribucion","documento_iddocumento=".$iddoc,"",$conn);
	$numero_distribucion=$numero_radicado[0]['numero'].'.'.($distribuciones_iddoc['numcampos']+1);
	return($numero_distribucion);
}
function obtener_funcionarios_dependencia_destino($iddependencia){
	global $conn;
	
	$array_funcionarios=array();
	$dependencia=str_replace("#", "", $iddependencia);
	$dependencia.=",".buscar_dependencias_hijas_distribucion($dependencia);
	$dependencia=trim($dependencia,',');
    $busca_funcionarios=busca_filtro_tabla("iddependencia_cargo","vfuncionario_dc","tipo_cargo=1 AND estado=1 AND estado_dc=1 AND estado_dep=1 AND iddependencia IN(".$dependencia.")","",$conn);
    for ($j=0; $j < $busca_funcionarios['numcampos']; $j++) { 
		$array_funcionarios[]=$busca_funcionarios[$j]['iddependencia_cargo'];
	}
	return($array_funcionarios);
}
function buscar_dependencias_hijas_distribucion($iddependencia){
	global $conn;
	$lista_hijas='';
	$busca_hijas=busca_filtro_tabla("iddependencia","dependencia","cod_padre=".$iddependencia,"",$conn);
	if($busca_hijas['numcampos']){
		for($i=0;$i<$busca_hijas['numcampos'];$i++){
			$lista_hijas.=$busca_hijas[$i]['iddependencia'].",";
			$lista_hijas.=buscar_dependencias_hijas_distribucion($busca_hijas[$i]['iddependencia']);
		}
	}
	return($lista_hijas);
}

function mostrar_listado_distribucion_documento($idformato,$iddoc){  
	global $conn,$ruta_db_superior;
	
	$distribuciones=busca_filtro_tabla("numero_distribucion,tipo_origen,origen,tipo_destino,destino,estado_distribucion,iddistribucion","distribucion","documento_iddocumento=".$iddoc,"",$conn);
	$tabla='';
	if($distribuciones['numcampos']){

	    $tabla='
	    	<table class="table table-bordered adicionar_campo" style="width: 100%; font-size:10px; text-align:left;" border="1">
	    	<tr>
	    		<th style="text-align:center;" colspan="4">DISTRIBUCI&Oacute;NES</th>
	    	</tr>
	    	<tr>
	    		<th style="text-align:center;">Estado</th>
	        	<th style="text-align:center;">No. Item</th>
	        	<th style="text-align:center;">Nombre origen</th>
	        	<th style="text-align:center;">Nombre destino</th>
	      	</tr>
	    ';
		
		for($i=0;$i<$distribuciones['numcampos'];$i++){
			$enlace_finalizar_distribucion=generar_enlace_finalizar_distribucion($distribuciones[$i]['iddistribucion']);
			
			$tabla.='
			<tr>
				<td style="text-align:center;"> '.ver_estado_distribucion($distribuciones[$i]['estado_distribucion']).$enlace_finalizar_distribucion.' </td>
				<td style="text-align:center;"> '.$distribuciones[$i]['numero_distribucion'].' </td>
				<td> 
					'.retornar_origen_destino_distribucion($distribuciones[$i]['tipo_origen'],$distribuciones[$i]['origen']).' 
					<br>
					'.retornar_ubicacion_origen_destino_distribucion($distribuciones[$i]['tipo_origen'],$distribuciones[$i]['origen']).'
				</td>
				<td> 
					'.retornar_origen_destino_distribucion($distribuciones[$i]['tipo_destino'],$distribuciones[$i]['destino']).' 
					<br>
					'.retornar_ubicacion_origen_destino_distribucion($distribuciones[$i]['tipo_destino'],$distribuciones[$i]['destino']).'
				</td>
			</tr>
			';
			
			
		}
		
		$tabla.='</table>';	
		$tabla.=generar_enlace_finalizar_distribucion(0,1);
	} //fin if numcampos
	echo($tabla);
}

function generar_enlace_finalizar_distribucion($iddistribucion,$js=0){
	global $conn,$ruta_db_superior;
	
	$html='';
	if($js){
		$html='
		<script>
			$(document).ready(function(){
				$(".finalizar_item_usuario_actual").click(function(){
					if(confirm("'.codifica_encabezado(html_entity_decode('Esta seguro/a de finalizar la distribuci&oacute;n?')).'")){
						var iddistribucion=$(this).attr("iddistribucion");
						
				    	$.ajax({
				        	type:"POST",
				            dataType: "json",
				            url: "'.$ruta_db_superior.'distribucion/ejecutar_acciones_distribucion.php",
				            data: {
				            	iddistribucion:iddistribucion,
				            	ejecutar_accion:"finalizar_distribucion",
				            	finaliza_manual:1
				            },
				            success: function(datos){
				            	top.noty({text: "distribuci&oacute;n finalizada satisfactoriamente!",type: "success",layout: "topCenter",timeout:3500});
				                window.location.reload();
				        	}
				    	});	 //fin ajax
			    	} //fin if confirm						
				}); //fin if finalizar_item_usuario_actual
				
			});	//fin if document.ready
		</script>
		';		
	}
	
	if(!$js && $iddistribucion){

		//ROLES USUARIO _ACTUAL
		$funcionario_codigo_usuario_actual=usuario_actual('funcionario_codigo');
		$busca_roles_usuario_actual=busca_filtro_tabla("iddependencia_cargo","vfuncionario_dc","estado_dc=1 AND funcionario_codigo=".$funcionario_codigo_usuario_actual,"",$conn);
		$vector_roles_usuario_actual=extrae_campo($busca_roles_usuario_actual,'iddependencia_cargo',"U");
		
		$distribucion=busca_filtro_tabla("tipo_origen,estado_recogida,origen,tipo_destino,destino,estado_distribucion","distribucion","iddistribucion=".$iddistribucion,"",$conn);
		$diligencia=mostrar_diligencia_distribucion($distribucion[0]['tipo_origen'],$distribucion[0]['estado_recogida']);
		
		$retornar_enlace=0;
		switch($diligencia){
			case 'RECOGIDA':
				if(in_array($distribucion[0]['origen'], $vector_roles_usuario_actual)){
					$retornar_enlace=1;
				}
				break;
			case 'ENTREGA':
				if($distribucion[0]['tipo_destino']==1 && in_array($distribucion[0]['destino'], $vector_roles_usuario_actual) ){
					$retornar_enlace=1;
				}
				break;	
		}
		
		if($retornar_enlace && $distribucion[0]['estado_distribucion']!=3){
			$html='<br><a style="cursor:pointer;" class="finalizar_item_usuario_actual" iddistribucion='.$iddistribucion.'>Finalizar</a>';		
		}
		
	} //fin if js

	return($html);
}

//---------------------------------------------------------------------------------------------

//REPORTE DE DISTRIBUCION

function ver_documento_distribucion($iddocumento,$tipo_origen) {  //Radicado
	global $conn;
	
	$cadena_fecha_obtener=fecha_db_obtener('a.fecha','Y-m-d')." AS fecha";
	$datos_documento=busca_filtro_tabla("b.etiqueta,a.numero,".$cadena_fecha_obtener,"documento a, formato b","lower(a.plantilla)=lower(b.nombre) AND a.iddocumento=".$iddocumento,"",$conn);

	$numero=$datos_documento[0]['numero'];
	$fecha=$datos_documento[0]['fecha'];
	$array_tipo_origen=array(1=>'I',2=>'E');
	$cadena_mostrar=$fecha.'-'.$numero.'-'.$array_tipo_origen[$tipo_origen];
	$etiqueta_formato=$datos_documento[0]['etiqueta'].'<br>';
	$enlace_documento='<div class="link kenlace_saia" enlace="ordenar.php?key='.$iddocumento.'&amp;accion=mostrar&amp;mostrar_formato=1" conector="iframe" titulo="No Radicado '.$numero.'"><center><span class="badge">'.$etiqueta_formato.$cadena_mostrar.'</span></center></div>';
	
	return($enlace_documento);
} 

function ver_estado_distribucion($estado_distribucion){ //Estado
	$array_estado_distribucion=array('estado_distribucion'=>'Pendiente',0=>'Pendiente',1=>'Pendiente por distribuir',2=>'En distribuci&oacute;n',3=>'Finalizado');
	return($array_estado_distribucion[$estado_distribucion]);	
}

function mostrar_diligencia_distribucion($tipo_origen,$estado_recogida){ //Diligencia

	if($estado_recogida=='estado_recogida'){
		$estado_recogida=0;
	}
	$diligencia='ENTREGA';
	if($tipo_origen==1 && !$estado_recogida){
		$diligencia='RECOGIDA';
	}
	
	return($diligencia);
}
function mostrar_tipo_radicado_distribucion($tipo_origen){
	//1 fun 2 eje
	$array_tipo_radicado=array(1=>'I',2=>'E');
	return($array_tipo_radicado[$tipo_origen]);
	
}
function mostrar_nombre_ruta_distribucion($tipo_origen,$estado_recogida,$ruta_origen,$ruta_destino,$tipo_destino){ //Ruta
	global $conn;
	
	if($estado_recogida=='estado_recogida'){ $estado_recogida=0; }
	if($ruta_origen=='ruta_origen'){ $ruta_origen=0; }
	if($ruta_destino=='ruta_destino'){ $ruta_destino=0; }
	
	$idft_ruta_distribucion=$ruta_destino; //ENTREGA
	if($tipo_origen==1 && !$estado_recogida){  //RECOGIDA
		$idft_ruta_distribucion=$ruta_origen;
	}
	
	$nombre_ruta_distribucion='Sin definir';
	if($idft_ruta_distribucion){
		$ruta_distribucion=busca_filtro_tabla("nombre_ruta","ft_ruta_distribucion","idft_ruta_distribucion=".$idft_ruta_distribucion,"",$conn);
		if($ruta_distribucion['numcampos']){
			$nombre_ruta_distribucion=$ruta_distribucion[0]['nombre_ruta'];
		}
	}
	
	if($tipo_destino==2 && $estado_recogida){ //DESTINO EXTERNO, NO TIENE RUTA SE PREDETERMINA NOMBRE
		$nombre_ruta_distribucion='Distribuci&oacute;n Externa';
	}
	
	return($nombre_ruta_distribucion);	
}

function select_mensajeros_ruta_distribucion($iddistribucion){ //Mensajero
	global $conn;
	
	$datos_distribucion=busca_filtro_tabla("tipo_origen,tipo_destino,estado_recogida,ruta_origen,ruta_destino,mensajero_origen,mensajero_destino,mensajero_empresad","distribucion","iddistribucion=".$iddistribucion,"",$conn);
	$atributos_input=' style="width:150px;" class="select_mensajeros_ditribucion" name="select_mensajeros_ditribucion_'.$iddistribucion.'" id="select_mensajeros_ditribucion_'.$iddistribucion.'" iddistribucion="'.$iddistribucion.'"';


	$diligencia=mostrar_diligencia_distribucion($datos_distribucion[0]['tipo_origen'],$datos_distribucion[0]['estado_recogida']);
	$upd='';
	switch($diligencia){
		case 'RECOGIDA':
			$select_mensajeros=generar_select_mensajeros_distribucion($atributos_input,$datos_distribucion[0]['tipo_origen'],$datos_distribucion[0]['ruta_origen'],$datos_distribucion[0]['mensajero_origen']);
			break;
		case 'ENTREGA':	
			$select_mensajeros=generar_select_mensajeros_distribucion($atributos_input,$datos_distribucion[0]['tipo_destino'],$datos_distribucion[0]['ruta_destino'],$datos_distribucion[0]['mensajero_destino'],$datos_distribucion[0]['mensajero_empresad']);		
			break;
	} //fin switch
	
	return($select_mensajeros);
	
}
function generar_select_mensajeros_distribucion($atributos_input,$tipo,$idft_ruta_distribucion=0,$selected=0,$empresa_transportadora=0){ 
	global $conn;	
	
	$html='<select '.$atributos_input.'>';
	
	if(!$selected){
		$html.='<option value="" selected>Seleccione...</option>';
	}
	
	if($tipo==1){  //internos
	
		if($idft_ruta_distribucion){ //mensajeros de la ruta de distribucion

			$mensajeros_ruta=busca_filtro_tabla("b.mensajero_ruta","ft_ruta_distribucion a, ft_funcionarios_ruta b","a.idft_ruta_distribucion=b.ft_ruta_distribucion AND estado_mensajero=1 AND a.idft_ruta_distribucion=".$idft_ruta_distribucion,"",$conn);
			//return($mensajeros_ruta['sql']);
			for($i=0;$i<$mensajeros_ruta['numcampos'];$i++){
				$selected_text='';
				if($selected){
					if($mensajeros_ruta[$i]['mensajero_ruta']==$selected){
						$selected_text='selected';
					}					
				}
				$posfijo_mensajero='-i';
				$cnombre_mensajero=busca_filtro_tabla("nombres,apellidos","vfuncionario_dc","iddependencia_cargo=".$mensajeros_ruta[$i]['mensajero_ruta'],"",$conn);
				$nombre_mensajero=$cnombre_mensajero[0]['nombres'].' '.$cnombre_mensajero[0]['apellidos'];
				$html.='<option value="'.$mensajeros_ruta[$i]['mensajero_ruta'].$posfijo_mensajero.'" '.$selected_text.'>'.$nombre_mensajero.'</option>';
			}
			
		}else{  //si no tiene ruta de distribucion y es tipo=1 (interno) el select sale vacio

	
		} //FIN: //si no tiene ruta de distribucion y es tipo=1 (interno) el select sale vacio
	
	}else{  //externos

    	$array_concat=array("nombres","' '","apellidos");
    	$cadena_concat=concatenar_cadena_sql($array_concat);
    	$mensajeros_externos=busca_filtro_tabla("iddependencia_cargo as id,".$cadena_concat." AS nombre","vfuncionario_dc","lower(cargo) LIKE 'mensajer%extern%' AND estado_dc=1","",$conn);
		
		$array_mensajeros_externos=array();
		for($me=0;$me<$mensajeros_externos['numcampos'];$me++){
			$array_mensajeros_externos[$me]['id']=$mensajeros_externos[$me]['id'].'-i';
			$array_mensajeros_externos[$me]['nombre']=$mensajeros_externos[$me]['nombre'];
		}

		$empresas_transportadoras=busca_filtro_tabla("idcf_empresa_trans as id,nombre","cf_empresa_trans","","",$conn);
		for($me=0;$me<$empresas_transportadoras['numcampos'];$me++){
			$array_mensajeros_externos[$me+$mensajeros_externos['numcampos']]['id']=$empresas_transportadoras[$me]['id'].'-e';
			$array_mensajeros_externos[$me+$mensajeros_externos['numcampos']]['nombre']=$empresas_transportadoras[$me]['nombre'];
		}

		if($selected){
			if($empresa_transportadora){
				$selected=$selected.'-e';
			}else{
				$selected=$selected.'-i';
			}			
		}		
		for($me=0;$me<count($array_mensajeros_externos);$me++){
			$selected_text='';
			if($selected){
				if($array_mensajeros_externos[$me]['id']==$selected){
					$selected_text='selected';
				}					
			}
			$html.="<option value='".$array_mensajeros_externos[$me]['id']."' ".$selected_text.">".$array_mensajeros_externos[$me]['nombre']."</option>";
		}  	
		
	} //FIN: externos
	
	$html.='</select>';
	
	return($html);
}

function mostrar_planilla_diligencia_distribucion($iddistribucion){ //Planilla Asociada
	global $conn;		

	$planillas=busca_filtro_tabla("b.iddocumento,b.numero","ft_despacho_ingresados a, documento b, ft_item_despacho_ingres c","a.idft_despacho_ingresados=c.ft_despacho_ingresados AND a.documento_iddocumento=b.iddocumento AND lower(b.estado)='aprobado' AND c.ft_destino_radicacio=".$iddistribucion,"",$conn);
	$html="No tiene planilla asociada"; //Pendiente
	if($planillas['numcampos']){
		$html='';
		for($i=0;$i<$planillas['numcampos'];$i++){
			$html.='<div class="link kenlace_saia" enlace="ordenar.php?key='.$planillas[$i]['iddocumento'].'&amp;accion=mostrar&amp;mostrar_formato=1" conector="iframe" titulo="No Radicado '.$planillas[$i]['numero'].'"><center><span class="badge">'.$planillas[$i]['numero']."</span></center></div>\n";
		}
		
	}
	return($html);
}


function generar_check_accion_distribucion($iddistribucion){
	global $conn;
	
	$distribucion=busca_filtro_tabla("tipo_origen,estado_recogida,mensajero_origen,mensajero_destino","distribucion","iddistribucion=".$iddistribucion,"",$conn);
	$diligencia=mostrar_diligencia_distribucion($distribucion[0]['tipo_origen'],$distribucion[0]['estado_recogida']);
	$retornar_check=0;
	switch($diligencia){
		case 'RECOGIDA':
			if($distribucion[0]['mensajero_origen']){
				$retornar_check=1;	
			}
			break;
		case 'ENTREGA':	
			if($distribucion[0]['mensajero_destino']){
				$retornar_check=1;	
			}		
			break;
	} //fin switch	
	
	if(!$retornar_check){ //si es 1. Entregas Interna a ventanilla habilita el check no importa si tiene o no mensajero
		$idbusqueda_componente=@$_REQUEST['idbusqueda_componente'];
		$cnombre_componente=busca_filtro_tabla("nombre","busqueda_componente","idbusqueda_componente=".$idbusqueda_componente,"",$conn);
		$nombre_componente=$cnombre_componente[0]['nombre'];
		if($nombre_componente=='reporte_distribucion_general_sinrecogida'){
			$retornar_check=1;
		}
	}
	
	$checkbox='';
	if($retornar_check){
		$checkbox='<input type="checkbox" class="accion_distribucion" value="'.$iddistribucion.'">';
	}	
	return($checkbox);
}
function opciones_acciones_distribucion($datos){
	global $conn;
	
	$cnombre_componente=busca_filtro_tabla("nombre","busqueda_componente","idbusqueda_componente=".$datos['idbusqueda_componente'],"",$conn);
	$nombre_componente=$cnombre_componente[0]['nombre'];
	
	$cadena_acciones.="<select id='opciones_acciones_distribucion' class='pull-left btn btn-mini' style='height:22px; margin-left: 10px;'>";
		$cadena_acciones.="<option value=''>Acciones...</option>";
		
		if($nombre_componente=='reporte_distribucion_general_endistribucion' || $nombre_componente=='reporte_distribucion_general_pordistribuir'){
			$cadena_acciones.="<option value='boton_generar_planilla'>Generar Planilla</option>";
		}	
		
		if($nombre_componente=='reporte_distribucion_general_endistribucion'){
			$cadena_acciones.="<option value='boton_finalizar_entrega'>Finalizar Tr&aacute;mite</option>";
		}
		
		if($nombre_componente=='reporte_distribucion_general_sinrecogida'){
			$cadena_acciones.="<option value='boton_confirmar_recepcion_distribucion'>Confirmar Recepcion</option>";
		}		
			
		//SELECCIONAR Y QUITAR SELECCIONADOS
		$cadena_acciones.="<optgroup label='Seleccionar Distribuciones...'>";
		$cadena_acciones.="<option value='seleccionar_todos_accion_distribucion'>Todos</option>";
		$cadena_acciones.="<option value='quitar_seleccionados_accion_distribucion'>Niguno</option>";
		$cadena_acciones.="</optgroup>";
		//FIN SELECCIONAR Y QUITAR SELECCIONADOS	
				
	$cadena_acciones.="</select>";	

	return($cadena_acciones);
	
}



function mostrar_origen_distribucion($tipo_origen,$origen){
	global $conn;
	$nombre_origen=retornar_origen_destino_distribucion($tipo_origen,$origen);
	$nombre_origen.='<br>';
	$nombre_origen.=retornar_ubicacion_origen_destino_distribucion($tipo_origen,$origen);
	return($nombre_origen);
}
function mostrar_destino_distribucion($tipo_destino,$destino){
	global $conn;
	$nombre_destino=retornar_origen_destino_distribucion($tipo_destino,$destino);
	$nombre_destino.='<br>';
	$nombre_destino.=retornar_ubicacion_origen_destino_distribucion($tipo_destino,$destino);	
	return($nombre_destino);
}

function retornar_ubicacion_origen_destino_distribucion($tipo,$valor){
	global $conn;
	
	$ubicacion='';
	if($tipo==1){  //iddependencia_cargo
		$datos=busca_filtro_tabla("cargo,dependencia","vfuncionario_dc","iddependencia_cargo=".$valor,"",$conn);
		$ubicacion='<b>Dependencia:</b> '.$datos[0]['dependencia'].'<br><b>Cargo: </b> '.$datos[0]['cargo'].'';
	}else{  //iddatos_ejecutor
		$datos=busca_filtro_tabla("direccion,cargo","ejecutor a, datos_ejecutor b","a.idejecutor=b.ejecutor_idejecutor AND b.iddatos_ejecutor=".$valor,"",$conn);
		$ubicacion='<b>Direcci&oacute;n:</b> '.$datos[0]['direccion'].'<br><b>Cargo: </b> '.$datos[0]['cargo'].'';
	}
	return($ubicacion);		
}

function retornar_origen_destino_distribucion($tipo,$valor){
	global $conn;
	
	if($tipo==1){  //iddependencia_cargo
		$datos=busca_filtro_tabla("nombres,apellidos","vfuncionario_dc","iddependencia_cargo=".$valor,"",$conn);
		$nombre=$datos[0]['nombres'].' '.$datos[0]['apellidos'];
	}else{  //iddatos_ejecutor
		$datos=busca_filtro_tabla("nombre","ejecutor a, datos_ejecutor b","a.idejecutor=b.ejecutor_idejecutor AND b.iddatos_ejecutor=".$valor,"",$conn);
		$nombre=$datos[0]['nombre'];
	}
	return($nombre);	
		
}
function condicion_adicional_distribucion(){
	global $conn;
	
	$condicion_adicional="";
	
	$funcionario_codigo_usuario_actual=usuario_actual('funcionario_codigo');
	$cargo_administrador_mensajeria=busca_filtro_tabla("funcionario_codigo","vfuncionario_dc"," lower(cargo) LIKE 'administrador%de%mensajer%a' AND estado_dc=1 AND funcionario_codigo=".$funcionario_codigo_usuario_actual,"",$conn);	
	$administrador_mensajeria=0;
	if($cargo_administrador_mensajeria['numcampos']){
		$administrador_mensajeria=1;
	}
	
	if(!$administrador_mensajeria){ //si no es un administrador filtramos como si fuera un mensajero
	
		$rol_funcionario=busca_filtro_tabla("iddependencia_cargo","vfuncionario_dc","funcionario_codigo='".$funcionario_codigo_usuario_actual."' AND estado_dc=1","",$conn);
		$lista_roles_funcionarios='';
		for($i=0;$i<$rol_funcionario['numcampos'];$i++){
			$lista_roles_funcionarios.=$rol_funcionario[$i]['iddependencia_cargo'];
			if( ($i+1)!=$rol_funcionario['numcampos'] ){
				$lista_roles_funcionarios.=',';
			}
		} //fin rol funcionario
		
		$condicion_adicional.=" AND ( (a.tipo_origen=1 AND a.estado_recogida<>1 AND a.mensajero_origen IN(".$lista_roles_funcionarios.") ) OR  (a.mensajero_empresad=0 AND a.mensajero_destino IN(".$lista_roles_funcionarios.") AND a.estado_recogida=1  ) ) ";
		
		
	} // FIN: si no es un administrador filtramos como si fuera un mensajero
	
	
	if(@$_REQUEST['variable_busqueda']){
		
		$vector_variable_busqueda=explode('|',$_REQUEST['variable_busqueda']);
		
		//FILTRO POR RUTA DE DISTRIBUCION
		if($vector_variable_busqueda[0]=='idft_ruta_distribucion' && $vector_variable_busqueda[1]){
						
			//CONDICION RUTA ORIGEN		
			$condicion_adicional.=" AND ( (a.tipo_origen=1 AND a.estado_recogida<>1 AND a.ruta_origen=".$vector_variable_busqueda[1].")";
			
			//CONDICION RUTA DESTINO
			$condicion_adicional.=" OR ( a.tipo_destino=1 AND a.ruta_destino=".$vector_variable_busqueda[1]." AND a.estado_recogida=1  ) )";
			
		} //fin if $vector_variable_busqueda[0]=='idft_ruta_distribucion'
		
		//FILTRO POR MENSAJERO
		if($vector_variable_busqueda[0]=='filtro_mensajero_distribucion' && $vector_variable_busqueda[1]){
			
			$mensajero_tipo=explode('-',$vector_variable_busqueda[1]);
			
			if($mensajero_tipo[1]=='i'){
				//CONDICION mensajero origen	
				$condicion_adicional.=" AND ( (a.tipo_origen=1 AND a.estado_recogida<>1 AND a.mensajero_origen=".$mensajero_tipo[0].") OR ";					
			}else{
				$condicion_adicional.="  AND ( ";
			}
			
			//CONDICION mensajero destino
			$coondicion_tipo_mensajero_destino=0;
			if($mensajero_tipo[1]=='e'){
				$coondicion_tipo_mensajero_destino=1;
			}
			$condicion_adicional.="  (a.mensajero_empresad=".$coondicion_tipo_mensajero_destino." AND a.mensajero_destino=".$mensajero_tipo[0]." AND a.estado_recogida=1  ) )";
			
		} //fin if $vector_variable_busqueda[0]=='filtro_mensajero_distribucion'
		
		
	} //fin if $_REQUEST['variable_busqueda']
	
	return($condicion_adicional);
}

//---------------------------------------------------------------------------------------------

//RUTAS DE DISTRIBUCION

function actualizar_dependencia_ruta_distribucion($idft_ruta_distribucion,$iddependencia,$estado){
	global $conn;
	
	/*
	 * $estado = 1 -> activo ; 2-> inactivo 
	*/
	
	$busca_distribuciones_origen=busca_filtro_tabla("a.iddistribucion","distribucion a, documento b, vfuncionario_dc c","a.documento_iddocumento=b.iddocumento AND lower(b.estado)='aprobado' AND a.estado_distribucion<>3 AND a.tipo_origen=1 AND a.estado_recogida=0 AND c.iddependencia_cargo=a.origen AND c.iddependencia=".$iddependencia,"",$conn);
	
	$busca_distribuciones_destino=busca_filtro_tabla("a.iddistribucion","distribucion a, documento b, vfuncionario_dc c","a.documento_iddocumento=b.iddocumento AND lower(b.estado)='aprobado' AND a.estado_distribucion<>3 AND a.tipo_destino=1 AND c.iddependencia_cargo=a.destino AND c.iddependencia=".$iddependencia,"",$conn);
	
	//ASIGNO O RETIRO RUTA DE DISTRIBUCION, SEGUN SI ACTIVAN O INACTIVAN UNA DEPENDENCIA EN UNA RUTA DE DISTRIBUCION.
	
	if($estado==1){   //ASIGNO RUTA DE DISTRIBUCION A LAS DISTRIBUCIONES
		
		//ACTUALIZACION_ORIGEN (RECOGIDA)
		for($i=0;$i<$busca_distribuciones_origen['numcampos'];$i++){
			$iddistribucion=$busca_distribuciones_origen[$i]['iddistribucion'];
			$upro=" UPDATE distribucion SET mensajero_origen=0,ruta_origen=".$idft_ruta_distribucion." WHERE iddistribucion=".$iddistribucion;
			phpmkr_query($upro);
		}
		
		//ACTUALIZACION_DESTINO (ENTREGA)
		for($i=0;$i<$busca_distribuciones_destino['numcampos'];$i++){
			$iddistribucion=$busca_distribuciones_destino[$i]['iddistribucion'];
			$uprd=" UPDATE distribucion SET mensajero_destino=0,ruta_destino=".$idft_ruta_distribucion." WHERE iddistribucion=".$iddistribucion;
			phpmkr_query($uprd);
		}		
		
	} //fin if $estado==1
	
	if($estado==2){   //RETIRO RUTA DE DISTRIBUCION A LAS DISTRIBUCIONES
	
		//ACTUALIZACION_ORIGEN (RECOGIDA)
		for($i=0;$i<$busca_distribuciones_origen['numcampos'];$i++){
			$iddistribucion=$busca_distribuciones_origen[$i]['iddistribucion'];
			$upro=" UPDATE distribucion SET mensajero_origen=0,ruta_origen=0 WHERE iddistribucion=".$iddistribucion;
			phpmkr_query($upro);
		}
		
		//ACTUALIZACION_DESTINO (ENTREGA)
		for($i=0;$i<$busca_distribuciones_destino['numcampos'];$i++){
			$iddistribucion=$busca_distribuciones_destino[$i]['iddistribucion'];
			$uprd=" UPDATE distribucion SET mensajero_destino=0,ruta_destino=0 WHERE iddistribucion=".$iddistribucion;
			phpmkr_query($uprd);
		}	
			
	} //fin if $estado==2
	
	
}  //fin function actualizar_dependencia_ruta_distribucion()


function actualizar_mensajero_ruta_distribucion($idft_ruta_distribucion,$iddependencia_cargo_mensajero,$estado){
	global $conn;
	
	
	if($estado==2){ //SI INACTIVAN EL MENSAJERO, LO RETIRO DE LAS DISTRIBUCIONES
	
		//ACTUALIZACION_ORIGEN (RECOGIDA)
		$busca_distribuciones_mensajero_origen=busca_filtro_tabla("a.iddistribucion","distribucion a, documento b","a.documento_iddocumento=b.iddocumento AND lower(b.estado)='aprobado' AND a.estado_distribucion<>3 AND a.tipo_origen=1 AND a.estado_recogida=0 AND mensajero_origen=".$iddependencia_cargo_mensajero." AND a.ruta_origen=".$idft_ruta_distribucion,"",$conn);	
		
		for($i=0;$i<$busca_distribuciones_mensajero_origen['numcampos'];$i++){
			$iddistribucion=$busca_distribuciones_mensajero_origen[$i]['iddistribucion'];
			$upro=" UPDATE distribucion SET mensajero_origen=0 WHERE iddistribucion=".$iddistribucion;
			phpmkr_query($upro);				
		}
		
		//ACTUALIZACION_DESTINO (ENTREGA)
		$busca_distribuciones_mensajero_destino=busca_filtro_tabla("a.iddistribucion","distribucion a, documento b","a.documento_iddocumento=b.iddocumento AND lower(b.estado)='aprobado' AND a.estado_distribucion<>3 AND a.tipo_destino=1 AND mensajero_destino=".$iddependencia_cargo_mensajero." AND a.ruta_destino=".$idft_ruta_distribucion,"",$conn);	
		
		for($i=0;$i<$busca_distribuciones_mensajero_destino['numcampos'];$i++){
			$iddistribucion=$busca_distribuciones_mensajero_destino[$i]['iddistribucion'];
			$uprd=" UPDATE distribucion SET mensajero_destino=0 WHERE iddistribucion=".$iddistribucion;
			phpmkr_query($uprd);				
		}

		
	} //fin if $estado==2
	
	
	if($estado==3){ //ASIGNA UN MENSAJERO A LAS DISTRIBUCIONES QUE NO TIENEN MENSAJERO ASIGNADO
		
		//ACTUALIZACION_ORIGEN (RECOGIDA)
		$busca_distribuciones_mensajero_origen=busca_filtro_tabla("a.iddistribucion","distribucion a, documento b","a.documento_iddocumento=b.iddocumento AND lower(b.estado)='aprobado' AND a.estado_distribucion<>3 AND a.tipo_origen=1 AND a.estado_recogida=0 AND a.mensajero_origen=0 AND a.ruta_origen=".$idft_ruta_distribucion,"",$conn);	
		
		for($i=0;$i<$busca_distribuciones_mensajero_origen['numcampos'];$i++){
			$iddistribucion=$busca_distribuciones_mensajero_origen[$i]['iddistribucion'];
			$upro=" UPDATE distribucion SET mensajero_origen=".$iddependencia_cargo_mensajero." WHERE iddistribucion=".$iddistribucion;
			phpmkr_query($upro);				
		}
				
		//ACTUALIZACION_DESTINO (ENTREGA)
		$busca_distribuciones_mensajero_destino=busca_filtro_tabla("a.iddistribucion","distribucion a, documento b","a.documento_iddocumento=b.iddocumento AND lower(b.estado)='aprobado' AND a.estado_distribucion<>3 AND a.tipo_destino=1 AND a.mensajero_destino=0 AND a.ruta_destino=".$idft_ruta_distribucion,"",$conn);	
		
		for($i=0;$i<$busca_distribuciones_mensajero_destino['numcampos'];$i++){
			$iddistribucion=$busca_distribuciones_mensajero_destino[$i]['iddistribucion'];
			$uprd=" UPDATE distribucion SET mensajero_destino=".$iddependencia_cargo_mensajero." WHERE iddistribucion=".$iddistribucion;
			phpmkr_query($uprd);				
		}

		
	} //fin if $estado==3
	
	
} //fin function actualizar_mensajero_ruta_distribucion()

//---------------------------------------------------------------------------------------------





function filtro_mensajero_distribucion(){
    global $ruta_db_superior, $conn;
    
	
	$select="";
	$funcionario_codigo_usuario_actual=usuario_actual('funcionario_codigo');
	$cargo_administrador_mensajeria=busca_filtro_tabla("funcionario_codigo","vfuncionario_dc"," lower(cargo) LIKE 'administrador%de%mensajer%a' AND estado_dc=1 ","",$conn);
	
	$ver_select=false;
	for($i=0;$i<$cargo_administrador_mensajeria['numcampos'];$i++){
		if( $cargo_administrador_mensajeria[$i]['funcionario_codigo']==$funcionario_codigo_usuario_actual ){
			$ver_select=true;
		}
	}
	
	if($ver_select){

	    $select="<select class='pull-left btn btn-mini dropdown-toggle' style='height:22px; margin-left: 10px;' name='filtro_mensajero_distribucion' id='filtro_mensajero_distribucion'>";
	    $select.="<option value=''>Todos Los Mensajeros</option>";
		$array_concat=array("nombres","' '","apellidos");
		$cadena_concat=concatenar_cadena_sql($array_concat);
	    $datos=busca_filtro_tabla("iddependencia_cargo, ".$cadena_concat." AS nombre","vfuncionario_dc","lower(cargo)='mensajero' AND estado_dc=1","",$conn);
		
		//if($vector_variable_busqueda[0]=='filtro_mensajero_distribucion' && $vector_variable_busqueda[1]){
		$vector_variable_busqueda=explode('|',@$_REQUEST['variable_busqueda']);
		$vector_mensajero_tipo=explode('-',$vector_variable_busqueda[1]);
	   	$filtrar_mensajero=@$vector_variable_busqueda[1];
		
	    for($i=0;$i<$datos['numcampos'];$i++){
	        $selected='';	
			if($vector_variable_busqueda[0]=='filtro_mensajero_distribucion' && $vector_variable_busqueda[1] && $vector_mensajero_tipo[1]=='i'){
				if($filtrar_mensajero){
					if($filtrar_mensajero==$datos[$i]['iddependencia_cargo']."-i"){
						$selected='selected';
					}
				}	
			}	
	        $select.="<option value='".$datos[$i]['iddependencia_cargo']."-i' ".$selected.">".$datos[$i]['nombre']."&nbsp;-&nbsp;Mensajero</option>";
			
	    }
	
		$mensajeros_externos=busca_filtro_tabla("iddependencia_cargo, ".$cadena_concat." AS nombre","vfuncionario_dc","lower(cargo) LIKE 'mensajer%extern%' AND estado_dc=1","",$conn);
		
	    for($i=0;$i<$mensajeros_externos['numcampos'];$i++){
	        $selected='';	
			if($vector_variable_busqueda[0]=='filtro_mensajero_distribucion' && $vector_variable_busqueda[1] && $vector_mensajero_tipo[1]=='i'){
				if($filtrar_mensajero){
					if($filtrar_mensajero==$mensajeros_externos[$i]['iddependencia_cargo']."-i"){
						$selected='selected';
					}
				}	
			}	
	        $select.="<option value='".$mensajeros_externos[$i]['iddependencia_cargo']."-i' ".$selected.">".$mensajeros_externos[$i]['nombre']."&nbsp;-&nbsp;Mensajero Externo</option>";
			
	    }

		$empresas_transportadoras=busca_filtro_tabla("idcf_empresa_trans as id,nombre","cf_empresa_trans","","",$conn);
	    for($i=0;$i<$empresas_transportadoras['numcampos'];$i++){
	        $selected='';	
	        if($vector_variable_busqueda[0]=='filtro_mensajero_distribucion' && $vector_variable_busqueda[1] && $vector_mensajero_tipo[1]=='e'){
				if($filtrar_mensajero){
					if($filtrar_mensajero==$empresas_transportadoras[$i]['id']."-e"){
						$selected='selected';
					}
				}	
			}	
	        $select.="<option value='".$empresas_transportadoras[$i]['id']."-e' ".$selected.">".$empresas_transportadoras[$i]['nombre']."&nbsp;-&nbsp;Empresa Transportadora</option>";
			
	    }		
	    $select.="</select>";
		
	} //fin if $ver_select	
	
    return $select;	
	
}

?>