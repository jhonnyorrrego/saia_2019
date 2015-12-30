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
include_once($ruta_db_superior."pantallas/lib/librerias_fechas.php");


function ver_mostrar_documento($iddoc){
	global $conn, $ruta_db_superior;
	
    $dato=busca_filtro_tabla("","ft_salida_planta A, documento B ","A.documento_iddocumento=B.iddocumento AND B.estado<>'ELIMINADO' AND B.iddocumento=".$iddoc,"",$conn);

	
return('<div class="link kenlace_saia" enlace="ordenar.php?key='.$iddoc.'&amp;accion=mostrar&amp;mostrar_formato=1" titulo="Datos Solicitante" conector="iframe"><span class="badge">'.$dato[0]["numero"].'</span></div>');		
	
}


function nombres_apellidos_solicitante($iddependencia_cargo){
	global $conn, $ruta_db_superior;
	
    $dato=busca_filtro_tabla("nombres, apellidos","vfuncionario_dc","iddependencia_cargo=".$iddependencia_cargo,"",$conn);

	
return($dato[0]['nombres'].' '.$dato[0]['apellidos']);		
	
}

function ver_fecha_hora_salida($iddoc){
	global $conn, $ruta_db_superior;
	
 $dato=busca_filtro_tabla("","ft_salida_planta A, documento B ","A.documento_iddocumento=B.iddocumento AND B.estado<>'ELIMINADO' AND B.iddocumento=".$iddoc,"",$conn);

	
return($dato[0]['fecha_salida'].' '.$dato[0]['hora_salida']);		
	
}
function ver_fecha_hora_entrada($iddoc){
	global $conn, $ruta_db_superior;
	
 $dato=busca_filtro_tabla("","ft_salida_planta A, documento B ","A.documento_iddocumento=B.iddocumento AND B.estado<>'ELIMINADO' AND B.iddocumento=".$iddoc,"",$conn);

	
return($dato[0]['fecha_entrada'].' '.$dato[0]['hora_entrada']);		
	
}

function mostrar_motivo($motivo,$iddoc){
	global $conn, $ruta_db_superior;
	
 $dato=busca_filtro_tabla("","serie","idserie=".$motivo,"",$conn);
 
 $campo_oculto=busca_filtro_tabla("","ft_salida_planta A, documento B ","A.documento_iddocumento=B.iddocumento AND B.estado<>'ELIMINADO' AND B.iddocumento=".$iddoc,"",$conn);
	
return($dato[0]['nombre'].'<br>'.$campo_oculto[0]['motivo_permiso']);		
	
}

function funcion_estado($iddoc){
	global $conn, $ruta_db_superior;
  $paso_actual=busca_filtro_tabla("","paso_documento A, paso B","A.paso_idpaso=B.idpaso AND A.documento_iddocumento=".$iddoc."","fecha_asignacion DESC",$conn);
  
  $buscar_penultimo=busca_filtro_tabla("origen","paso_enlace a","diagram_iddiagram=".$paso_actual[0]["diagram_iddiagram"]." and destino='-2'","",$conn);
  $cadena=$paso_actual[0]["nombre_paso"];
  
  if($paso_actual[0]["paso_idpaso"]==$buscar_penultimo[0]["origen"] && $paso_actual[0]["estado_paso_documento"]==4){
  	$cadena.='<br /> <input type="button" id="terminar_actividad'.$iddoc.'" value="Boton" class="terminar_actividad" iddoc="'.$iddoc.'" idpaso="'.$buscar_penultimo[0]["origen"].'" title="Terminar actividad" titulo="Terminar actividad">
  	<script>
  	$("#terminar_actividad'.$iddoc.'").click(function(){
  		var idpaso=$(this).attr("idpaso");
			var boton=$(this);
			$.ajax({
				type:\'POST\',
				url:\''.$ruta_db_superior.'formatos/salida_planta/terminar_ultimo_paso.php\',
				data:\'idpaso=\'+idpaso+\'&iddoc='.$iddoc.'\',
				success:function(html){
					boton.hide();
				}
			});
  	});
  	</script>
  	';
  }
  return($cadena);
}











function total_solicitudes(){
	global $conn;
	$info=busca_filtro_tabla("","ft_salida_planta","","",$conn);

	$html='<div style="text-align:center; font-family:Georgia;">';
	$html.='<span style="line-height: 100px;font-size:60px; font-weight:bold;">'.$info['numcampos'].'</span>';
	$html.="</div>";
	
	return($html);
}

?>