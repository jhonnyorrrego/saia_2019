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
include_once($ruta_db_superior."formatos/librerias/funciones_generales.php");
include_once($ruta_db_superior."formatos/librerias/funciones_formatos_generales.php");
include_once($ruta_db_superior."librerias_saia.php");

function editar_documento_responsable_direccion_control_interno($idformato,$iddoc){
	global $conn, $ruta_db_superior;
	
	if($_REQUEST["tipo"] != 5){
	
		$direccion_control_interno = busca_filtro_tabla("nombres, apellidos, funcionario_codigo","vfuncionario_dc","lower(cargo) like'profesional%universitario%grado%22' and lower(dependencia) like'direccion%control%interno' and estado=1 and estado_dep=1 and estado_dc=1","",$conn);	
	
		$enlace = '<a href="'.$ruta_db_superior.'formatos/monitoreo_revision/editar_monitoreo_revision.php?iddoc='.$iddoc.'&idformato='.$idformato.'" >Editar monitoreo y revision</a>';					
					

		$ejecutor=busca_filtro_tabla("ejecutor","documento","iddocumento=".$iddoc,"",$conn);
	
	$area=busca_filtro_tabla("b.area_responsable","ft_monitoreo_revision a, ft_riesgos_proceso b","a.ft_riesgos_proceso=b.idft_riesgos_proceso and a.documento_iddocumento=".$iddoc,"",$conn);  
  $funcionario=busca_filtro_tabla("funcionario_codigo","vfuncionario_dc","iddependencia in (".$area[0]["area_responsable"].")","group by funcionario_codigo",$conn);
	

	  	echo($enlace);

	}	
}

function obtener_numero_riesgo($idformato, $iddoc){
	global $conn;
		
	if($_REQUEST["anterior"]){
		$riesgo = busca_filtro_tabla("a.consecutivo","ft_riesgos_proceso a, documento b","a.documento_iddocumento=b.iddocumento and  a.documento_iddocumento=".$_REQUEST["anterior"],"",$conn);
	}elseif($_REQUEST["iddoc"]){
		$riesgo = busca_filtro_tabla("a.consecutivo","ft_riesgos_proceso a, documento b, ft_monitoreo_revision c","a.documento_iddocumento=b.iddocumento and a.idft_riesgos_proceso=c.ft_riesgos_proceso and  c.documento_iddocumento=".$_REQUEST["iddoc"],"",$conn);
		
		$datos_documento = obtener_datos_documento($_REQUEST["iddoc"]);		
		
		$direccion_control_interno = busca_filtro_tabla("nombres, apellidos, funcionario_codigo","vfuncionario_dc","lower(cargo) like'profesional%universitario%grado%22' and lower(dependencia) like'direccion%control%interno' and estado=1 and estado_dep=1 and estado_dc=1","",$conn);			
		
	
	}	
	
	echo("<td><input type='text' name='numero_riesgo' id='numero_riesgo' value='".$riesgo[0]["consecutivo"]."' readonly></td>");	
}


function obtener_nombre_riesgo($idformato, $iddoc){
	global $conn;
	
	if($_REQUEST["anterior"]){
		$riesgo = busca_filtro_tabla("a.riesgo","ft_riesgos_proceso a, documento b","a.documento_iddocumento=b.iddocumento and  a.documento_iddocumento=".$_REQUEST["anterior"],"",$conn);
	}elseif($_REQUEST["iddoc"]){
		$riesgo = busca_filtro_tabla("a.riesgo","ft_riesgos_proceso a, documento b, ft_monitoreo_revision c","a.documento_iddocumento=b.iddocumento and a.idft_riesgos_proceso=c.ft_riesgos_proceso and  c.documento_iddocumento=".$_REQUEST["iddoc"],"",$conn);
	}	
	echo("<td>
			".strip_tags(html_entity_decode($riesgo[0]["riesgo"]))."
			<input type='hidden' name='nombre_riesgo' id='nombre_riesgo' value='".strip_tags(html_entity_decode($riesgo[0]["riesgo"]))."' readonly>
		  </td>");	

}

function obtener_controles_existentes_riesgo($idformato, $iddoc){
	global $conn;
	
	if($_REQUEST["anterior"]){
		$control_riesgos = busca_filtro_tabla("c.idft_control_riesgos, c.descripcion_control","ft_riesgos_proceso a, documento b, ft_control_riesgos c, documento d","a.idft_riesgos_proceso=c.ft_riesgos_proceso and a.documento_iddocumento=b.iddocumento and c.documento_iddocumento=d.iddocumento and lower(d.estado) not in('eliminado','anulado') and a.documento_iddocumento=".$_REQUEST["anterior"],"",$conn);
		
		
		
	}elseif($_REQUEST["iddoc"]){
		$calificacion_controles = busca_filtro_tabla("controles_existentes","ft_monitoreo_revision","documento_iddocumento=".$_REQUEST["iddoc"],"",$conn);		
			
		$calificacion_controles = (array) json_decode(html_entity_decode($calificacion_controles[0]["controles_existentes"]));											
	
		$control_riesgos = busca_filtro_tabla("d.idft_control_riesgos, d.descripcion_control","ft_riesgos_proceso a, documento b, ft_monitoreo_revision c, ft_control_riesgos d, documento e","a.documento_iddocumento=b.iddocumento and a.idft_riesgos_proceso=c.ft_riesgos_proceso and a.idft_riesgos_proceso=d.ft_riesgos_proceso and d.documento_iddocumento=e.iddocumento and lower(e.estado) not in('eliminado','anulado') and c.documento_iddocumento=".$_REQUEST["iddoc"],"dbms_lob.substr(d.descripcion_control,50,1) desc",$conn);		
	}
	
	$div ="<table class='controles_existentes' border='0' style='border-collapse:collapse; width: 100%;'>";
	for ($i=0; $i < $control_riesgos["numcampos"]; $i++) { 
		$div .="
					<tr id='".$control_riesgos[$i]["idft_control_riesgos"]."'>
						<td>".strip_tags(codifica_encabezado(html_entity_decode($control_riesgos[$i]["descripcion_control"])))."</td>
						<td>			   
							&nbsp;&nbsp;Si <input type='radio' id='".$control_riesgos[$i]["idft_control_riesgos"]."' name='".$control_riesgos[$i]["idft_control_riesgos"]."' value='1'>
							No <input type='radio' id='".$control_riesgos[$i]["idft_control_riesgos"]."' name='".$control_riesgos[$i]["idft_control_riesgos"]."' value='0'>
						</td>
					</tr>
			   "; 
	}
	$div .="</table>";	
	$div .="<input type='hidden' id='controles_existentes' name='controles_existentes' value=''>";
	echo("<td>".$div."</td>");
?>
<script type="text/javascript">
	$(document).ready(function(){
		
		var controles = {};	
		var calificacion_controles = <?php echo(json_encode($calificacion_controles)); ?>;		
		
		if(calificacion_controles){
			$.each(calificacion_controles, function(index, value){						
				$('.controles_existentes input[name="'+index+'"][value="'+value+'"]').attr("checked", true);	
			});
			
			$('.controles_existentes input').each(function(index, value){
				controles[value.id] = calificacion_controles[value.id];					
			});
		}else{
			$('.controles_existentes input').each(function(index, value){
				controles[value.id] = '';					
			});	
		}
		
		controles = JSON.stringify(controles);
		$("#controles_existentes").val(controles);
		
		$(".controles_existentes input").change(function(){
			controles = JSON.parse(controles);
			controles[$(this).attr("id")] = $(this).val();		
			controles = JSON.stringify(controles);
			$("#controles_existentes").val(controles);
		});
	})
</script>
<?php	
}

function obtener_acciones_propuestas_riesgo($idformato, $iddoc){
	global $conn;
	
	if($_REQUEST["anterior"]){
		$acciones_riesgos = busca_filtro_tabla("c.idft_acciones_riesgo, c.acciones_accion","ft_riesgos_proceso a, documento b, ft_acciones_riesgo c, documento d","a.idft_riesgos_proceso=c.ft_riesgos_proceso and a.documento_iddocumento=b.iddocumento and c.documento_iddocumento=d.iddocumento and lower(d.estado) not in('eliminado','anulado') and a.documento_iddocumento=".$_REQUEST["anterior"],"c.acciones_accion desc",$conn);
	}elseif($_REQUEST["iddoc"]){
		$cumplimiento_acciones = busca_filtro_tabla("acciones_propuestas","ft_monitoreo_revision","documento_iddocumento=".$_REQUEST["iddoc"],"",$conn);	
		$cumplimiento_acciones = (array) json_decode(html_entity_decode($cumplimiento_acciones[0]["acciones_propuestas"]));	
		
		$acciones_riesgos = busca_filtro_tabla("d.idft_acciones_riesgo, d.acciones_accion","ft_riesgos_proceso a, documento b, ft_monitoreo_revision c, ft_acciones_riesgo d, documento e","a.documento_iddocumento=b.iddocumento and a.idft_riesgos_proceso=c.ft_riesgos_proceso and a.idft_riesgos_proceso=d.ft_riesgos_proceso and d.documento_iddocumento=e.iddocumento and lower(e.estado) not in('eliminado','anulado') and c.documento_iddocumento=".$_REQUEST["iddoc"],"d.acciones_accion desc",$conn);
	}

	$div ="<table class='acciones_propuestas' border='0' style='border-collapse:collapse;'>";
	for ($i=0; $i < $acciones_riesgos["numcampos"]; $i++) { 
		$div .="
					<tr id='".$acciones_riesgos[$i]["idft_control_riesgos"]."'>
						<td>".strip_tags(codifica_encabezado(html_entity_decode($acciones_riesgos[$i]["acciones_accion"])))."</td>
						<td>
							&nbsp;&nbsp;Si <input type='radio' id='".$acciones_riesgos[$i]["idft_acciones_riesgo"]."' name='".$acciones_riesgos[$i]["idft_acciones_riesgo"]."' value='1'>
							No <input type='radio' id='".$acciones_riesgos[$i]["idft_acciones_riesgo"]."' name='".$acciones_riesgos[$i]["idft_acciones_riesgo"]."' value='0'>
						</td>
					</tr>
			   "; 
	}
	$div .="</table>";	
	$div .="<input type='hidden' id='acciones_propuestas' name='acciones_propuestas' value=''>";
	echo("<td>".$div."</td>");
?>
<script type="text/javascript">
	$(document).ready(function(){
		
		var acciones = {};	
		var cumplimiento_acciones = <?php echo(json_encode($cumplimiento_acciones)); ?>;	
		
		if(cumplimiento_acciones){
			$.each(cumplimiento_acciones, function(index, value){						
				$('.acciones_propuestas input[name="'+index+'"][value="'+value+'"]').attr("checked", true);	
			});	
			
			$('.acciones_propuestas input').each(function(index, value){									
				acciones[value.id] = cumplimiento_acciones[value.id];
			});
		}else{
			$('.acciones_propuestas input').each(function(index, value){									
				acciones[value.id] = '';
			});
		}	
				
		acciones = JSON.stringify(acciones);
		$("#acciones_propuestas").val(acciones);
		
		$(".acciones_propuestas input").change(function(){
			acciones = JSON.parse(acciones);
			acciones[$(this).attr("id")] = $(this).val();		
			acciones = JSON.stringify(acciones);
			$("#acciones_propuestas").val(acciones);
		});
	})
</script>
<?php	
}

function mostrar_controles_existentes_riesgo($idformato, $iddoc){
	global $conn;	
	
	$calificacion_controles = busca_filtro_tabla("controles_existentes","ft_monitoreo_revision","documento_iddocumento=".$iddoc,"",$conn);	
	$calificacion_controles = json_decode(html_entity_decode($calificacion_controles[0]["controles_existentes"]));		
	
	$control_riesgos = busca_filtro_tabla("d.idft_control_riesgos, d.descripcion_control","ft_riesgos_proceso a, documento b, ft_monitoreo_revision c, ft_control_riesgos d, documento e","a.documento_iddocumento=b.iddocumento and a.idft_riesgos_proceso=c.ft_riesgos_proceso and a.idft_riesgos_proceso=d.ft_riesgos_proceso and d.documento_iddocumento=e.iddocumento and lower(e.estado) not in('eliminado','anulado') and c.documento_iddocumento=".$iddoc,"",$conn);	
	
	
	
	
	$tabla ="<table border='1' style='border-collapse:collapse; width:100%; border-style:solid;border-width:1px;'>";
	for ($i=0; $i < $control_riesgos["numcampos"]; $i++) { 
		$tabla .= "
					<tr>
						<td style='width: 305px;'>".strip_tags(codifica_encabezado(html_entity_decode($control_riesgos[$i]["descripcion_control"])))."</td>
						<td>
				  ";
				  switch ($calificacion_controles->$control_riesgos[$i]["idft_control_riesgos"]) {
					  case 1:
						 $tabla .= "Si"; 
					  break;
					  case 0:
						 $tabla .= "No"; 
					  break;					  
					  default:
						  $tabla .= "";
					  break;
				  }
		$tabla .= "</td>
					</tr>
			   "; 
	}
	$tabla .="</table>";	
	
	echo($tabla);	
}

function mostrar_acciones_propuestas_riesgo($idformato, $iddoc){
	global $conn;
	
	$cumplimiento_acciones = busca_filtro_tabla("acciones_propuestas","ft_monitoreo_revision","documento_iddocumento=".$iddoc,"",$conn);
	
	$cumplimiento_acciones = json_decode(html_entity_decode($cumplimiento_acciones[0]["acciones_propuestas"]));	
	
	$acciones_riesgos = busca_filtro_tabla("d.idft_acciones_riesgo, d.acciones_accion","ft_riesgos_proceso a, documento b, ft_monitoreo_revision c, ft_acciones_riesgo d, documento e","a.documento_iddocumento=b.iddocumento and a.idft_riesgos_proceso=c.ft_riesgos_proceso and a.idft_riesgos_proceso=d.ft_riesgos_proceso and d.documento_iddocumento=e.iddocumento and lower(e.estado) not in('eliminado','anulado') and c.documento_iddocumento=".$iddoc,"",$conn);	
	
	$tabla ="<table border='1' style='border-collapse:collapse; width:100%;'>";
	for ($i=0; $i < $acciones_riesgos["numcampos"]; $i++) { 
		$tabla .= "
					<tr>
						<td style='width: 305px;'>".strip_tags(codifica_encabezado(html_entity_decode($acciones_riesgos[$i]["acciones_accion"])))."</td>
						<td>
				  ";
				switch ($cumplimiento_acciones->$acciones_riesgos[$i]["idft_acciones_riesgo"]) {
				  case 1:
					 $tabla .= "Si"; 
				  break;
				  case 0:
					 $tabla .= "No"; 
				  break;					  
				  default:
					  $tabla .= "";
				  break;
				}
		$tabla .= "					
						</td>
					</tr>
			   "; 
	}
	$tabla .="</table>";	
	echo($tabla);	
}

function validar_tipo_seleccion_monitoreo($idformato, $iddoc){
	global $conn;	
	if($_REQUEST["iddoc"]){
		$calificacion_controles = busca_filtro_tabla("cambio_identificacion,cambios_analisis,controles_nuevos","ft_monitoreo_revision","documento_iddocumento=".$_REQUEST["iddoc"],"",$conn);	
	}	
?>
<script type="text/javascript">
	$(document).ready(function(){
		
		if(parseInt("<?php echo($calificacion_controles[0]["cambio_identificacion"]);?>") !== 1){
			$("#descripcion_cambio").parent().parent().hide();
			$("#descripcion_cambio").removeClass("required");	
		}
		
		if(parseInt("<?php echo($calificacion_controles[0]["cambios_analisis"]);?>") !== 1){
			$("#descripcion_analisis").parent().parent().hide();
			$("#descripcion_analisis").removeClass("required");	
		}
		
		if(parseInt("<?php echo($calificacion_controles[0]["cambios_analisis"]);?>") !== 1){
			$("#descripcion_ncontrol").parent().parent().hide();
			$("#descripcion_ncontrol").removeClass("required");	
		}		
		
		$("input[name='cambio_identificacion']").change(function(){			
			if(parseInt($(this).val()) === 1){				
				$("#descripcion_cambio").parent().parent().show();
				$("#descripcion_cambio").addClass("required");				
			}else{				
				$("#descripcion_cambio").parent().parent().hide();
				$("#descripcion_cambio").removeClass("required");
			}
		});
		
		$("input[name='cambios_analisis']").change(function(){			
			if(parseInt($(this).val()) === 1){				
				$("#descripcion_analisis").parent().parent().show();
				$("#descripcion_analisis").addClass("required");				
			}else{				
				$("#descripcion_analisis").parent().parent().hide();
				$("#descripcion_analisis").removeClass("required");
			}
		});
		
		$("input[name='controles_nuevos']").change(function(){			
			if(parseInt($(this).val()) === 1){				
				$("#descripcion_ncontrol").parent().parent().show();
				$("#descripcion_ncontrol").addClass("required");				
			}else{				
				$("#descripcion_ncontrol").parent().parent().hide();
				$("#descripcion_ncontrol").removeClass("required");
			}
		});
		
		
		
	})
</script>
<?php
}
function fecha_bloqueada_monitoreo($idformato,$iddoc){//A.A
	echo "<td><input type='text' name='fecha_monitoreo' value='".date('Y-m-d')."' readonly='readonly'/></td>";
}
?>