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
include_once($ruta_db_superior."librerias_saia.php");
include_once($ruta_db_superior."formatos/librerias/funciones_generales.php");


function carga_nombre_solicita($idformato,$iddoc){
    global $conn;
	
	$datos=busca_filtro_tabla("A.nombres, A.apellidos, C.nombre","funcionario A,dependencia_cargo B,dependencia C","A.idfuncionario=B.funcionario_idfuncionario AND B.dependencia_iddependencia=C.iddependencia AND A.estado=1 AND B.estado=1 AND C.estado=1 AND A.funcionario_codigo=".usuario_actual("funcionario_codigo"),"",$conn);
	
	$funcionario=utf8_encode(html_entity_decode($datos[0]['nombres']." ".$datos[0]['apellidos']));
	
?>
	<script type="text/javascript">
		$(document).ready(function(){
			
			$("#usuario_que_solita").attr("value","<?php echo($funcionario)?>");
			$("#area").attr("value","<?php echo(utf8_encode(html_entity_decode($datos[0][2])));?>");
			$("#usuario_que_solita").parent().parent().hide();
			$("#area").parent().parent().hide();
			$("#MultiFile1").parent().parent().parent().hide();
			$("#fecha_elaboracion").parent().parent().hide();
			
			});
	</script>
<?php

}
//ocultar y mostrar el campo de anexos
function muestra_campo_anexos($idformato,$iddoc){
	global $conn;
	
?>
	<script type="text/javascript">
		$(document).ready(function(){
			$("#soportes_anexos0").click(function(){
				$("#MultiFile1").parent().parent().parent().show();
				
			});
			
			$("#soportes_anexos1").click(function(){
				$("#MultiFile1").parent().parent().parent().hide();
				
			});			
		});
	</script>
<?php
}
//cargar hijo en el mostrar----------------------------------------

function cargar_hijo_solucion($idformato,$iddoc){
	global $conn;
	
	$datos_solucion=busca_filtro_tabla("b.*","ft_mantenimiento_locativo a, ft_solucion_mantenimiento b","a.idft_mantenimiento_locativo=b.ft_mantenimiento_locativo and a.documento_iddocumento=".$iddoc,"",$conn);
	
	$fecha_firma=busca_filtro_tabla("fecha","buzon_salida","nombre='revisado' and archivo_idarchivo='".$datos_solucion[0]['documento_iddocumento']."'","",$conn);
	
	$fecha_firma2=busca_filtro_tabla("fecha","buzon_salida","nombre='aprobado' and archivo_idarchivo='".$datos_solucion[0]['documento_iddocumento']."'","",$conn);
  	
	$idformato_solucion_mantenimiento=busca_filtro_tabla("idformato","formato","lower (nombre) like 'solucion_mantenimiento'","",$conn);
	
	if($datos_solucion[0]['nombre_responsable']!=""){
		
	$mostrar_hijo='<table style="border-collapse: collapse; background-color: #b3b3b3; width: 100%; font-size: 10pt;" border="1">
	<tbody>
	<tr>
<td style="width: 100%;" colspan="2"><span><strong>Soluci&oacute;n</strong>&nbsp;'.mostrar_valor_campo("tipo",$idformato_solucion_mantenimiento[0]['idformato'],$datos_solucion[0]['documento_iddocumento'],1).'</span></td>
	</tr>
	<tr>
	<td style="width: 58%;">&nbsp;</td>
	<td style="width: 42%;"><strong>Pre-Requisitos de montaje</strong></td>
	</tr>
	<tr>
	<td><span ><strong>Nombre de responsable</strong>&nbsp;'.$datos_solucion[0]['nombre_responsable'].'</span></td>
	<td>&nbsp;'.$datos_solucion[0]['prerequisitos_montaje'].'</td>
	</tr>
	<tr>
	<td><span ><strong>Breve descripci&oacute;n soluci&oacute;n</strong></span></td>
	<td><span ><strong>Observaciones</strong></span></td>
	</tr>
	<tr>
	<td><strong>&nbsp;</strong><span>'.$datos_solucion[0]['descripcion_solucion'].'</span></td>
	<td>&nbsp;'.$datos_solucion[0]['observaciones'].'</td>
	</tr>
	<tr>
	<td><span ><strong>Anexos soluciones: </strong>'.mostrar_valor_campo("anexos_solucion",$idformato_solucion_mantenimiento[0]['idformato'],$datos_solucion[0]['documento_iddocumento'],1).'</span></td>
	<td>&nbsp;</td>
	</tr>
	<tr>
	<td><strong>Firmas y fechas&nbsp;&nbsp;'.($fecha_firma[1]['fecha']."&nbsp;&nbsp;&nbsp;".$fecha_firma[2]['fecha']).'</strong></td>
	<td style="text-align: right;"><span ><strong>Firma y fecha '.$fecha_firma2[0]['fecha'].' &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;</strong></span></td>
	</tr>
	<tr>
	<td colspan="2">
	</td>
	</tr>
	</tbody>
	</table>';
	
	echo($mostrar_hijo);
	
	//mostrar_estado_proceso($idformato_solucion_mantenimiento[0]['idformato'],$datos_solucion[0]['documento_iddocumento']);
	}

}



function ruta_firma($idformato,$iddoc){
		
	include_once($ruta_db_superior."formatos/librerias/funciones_formatos_generales.php");
	
	$datos_solucion=busca_filtro_tabla("jefe_area,aprovacion_logistica","ft_mantenimiento_locativo" ,"documento_iddocumento=".$iddoc,"",$conn);
	
	$jefe=busca_filtro_tabla("funcionario_codigo","vfuncionario_dc","iddependencia_cargo=".$datos_solucion[0]['jefe_area'],"",$conn);
	
	$logistica=busca_filtro_tabla("funcionario_codigo","vfuncionario_dc","iddependencia_cargo=".$datos_solucion[0]['aprovacion_logistica'],"",$conn);
	
	$ruta=array();
	array_push($ruta,array("funcionario"=>usuario_actual('funcionario_codigo'),"tipo_firma"=>0));
	array_push($ruta,array("funcionario"=>$logistica[0]['funcionario_codigo'],"tipo_firma"=>1));
	array_push($ruta,array("funcionario"=>$jefe[0]['funcionario_codigo'],"tipo_firma"=>1));	

	if(count($ruta)>0){
			
		$radicador_salida=busca_filtro_tabla("origen","buzon_entrada","archivo_idarchivo=".$iddoc,"idtransferencia 	desc",$conn);
				
		array_push($ruta,array("funcionario"=>$radicador_salida[0][0],"tipo_firma"=>0)); 
		phpmkr_query("update buzon_entrada set activo=0 where archivo_idarchivo=".$iddoc." and nombre='POR_APROBAR'");
		
		insertar_ruta_aprobacion_documento($ruta,$iddoc);  	
	}	
}

function transferencia_formato($idformato,$iddoc){
  global $conn;
    /*	
	$lider=busca_filtro_tabla("iddependencia_cargo","vfuncionario_dc","cargo='lider'","",$conn);

	$auxiliar=busca_filtro_tabla("iddependencia_cargo","vfuncionario_dc","cargo='auxiliar de inventario'","",$conn);*/
	$destino="208@209";
 
 	transferencia_automatica($idformato,$iddoc,$destino,1,"Se ha modificado el Total General del Documento");
		
}

function fecha_primera_firma($idformato,$iddoc){
	global $conn;
	
		
	$fecha_firma=busca_filtro_tabla("fecha","buzon_salida","nombre='revisado' and archivo_idarchivo='".$iddoc."'","",$conn);
	print_r($fecha_firma[1]["fecha"]);
	
	
}

function fecha_segunda_firma($idformato,$iddoc){
	global $conn;
	
		
	$fecha_firma=busca_filtro_tabla("fecha","buzon_salida","nombre='aprobado' and archivo_idarchivo='".$iddoc."'","",$conn);
	print_r($fecha_firma[0]["fecha"]);
	
	
}


?>