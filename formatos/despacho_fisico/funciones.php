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
include_once($ruta_db_superior."pantallas/documento/librerias_tramitados.php");
include_once($ruta_db_superior."formatos/librerias/encabezado_pie_pagina.php");
include_once($ruta_db_superior."class_transferencia.php");
echo(librerias_validar_formulario());
echo(librerias_notificaciones());
echo (librerias_jquery("1.7"));
//------------------------------Adicionar------------------------------------//
function campos_ocultos_despacho($idformato,$iddoc){
	global $conn,$ruta_db_superior;
	$valores=trim($_REQUEST['docs'],',');
	$hoy=date("Y-m-d");
	?>
	<script>
		$(document).ready(function (){
			var valores='<?php echo $valores;?>';
			if(valores=='' || valores==0){
				//alerta("Por favor seleccione documentos");
				notificacion_saia('<b>ATENCI&Oacute;N</b><br>Por favor seleccione documentos','warning','',4000);
			}else{
				$("input[name=docs_seleccionados]").val('<?php echo $valores;?>');
				$("input[name=fecha_despacho]").val('<?php echo $hoy;?>');
			}
		});
		$("#formulario_formatos").validate({
				submitHandler: function(form){
					var seguro=confirm("Esta seguro de realizar el despacho?");
					if(seguro){				
						form.submit();
					}else{
						$('input[type=button]').hide();
						$("#continuar").show();
						return false;
					}
				}
		});
	</script>
	<?php 
}
//----------------------------------Mostrar-------------------------------------//
function mostrar_seleccionados_despacho($idformato,$iddoc){
	global $conn,$ruta_db_superior,$documentos;
	$seleccionado=busca_filtro_tabla("","ft_despacho_fisico","documento_iddocumento=".$iddoc,"",$conn);
	$documentos=explode(",",$seleccionado[0]['docs_seleccionados']);
	$docs=array_filter($documentos);
	$texto='';
	$documentos=busca_filtro_tabla("","documento A"," A.iddocumento in(".implode(",",$docs).")","",$conn);
	if($documentos[0]["tipo_radicado"]==1){
		$texto.=reporte_entradas2($idformato,$iddoc);
		echo($texto);
	}else if($documentos[0]["tipo_radicado"]==2 || $documentos[0]['plantilla']=='RESPUESTA_PQRSF'){
		$texto.=reporte_salidas2($idformato,$iddoc);
		echo($texto); 
	}
}
//------------------------------Posterior aprobar------------------------------------//
function generar_pdf_despacho($idformato,$iddoc){
	global $conn,$ruta_db_superior;
	/*$ch = curl_init();
	$fila = "http://".RUTA_PDF_LOCAL."/html2ps/public_html/demo/html2ps.php?plantilla=".strtolower($datos_formato[0]["nombre_formato"])."&iddoc=".$iddoc."&conexion_remota=1";
	$fila = "http://".RUTA_PDF_LOCAL."/class_impresion.php?iddoc=".$iddoc."&LOGIN=".$_SESSION["LOGIN".LLAVE_SAIA]."&usuario_actual=".$_SESSION["usuario_actual"]."&LLAVE_SAIA=".LLAVE_SAIA;
	curl_setopt($ch, CURLOPT_URL,$fila); 
	curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);
	curl_setopt($ch, CURLOPT_VERBOSE, true); 
	curl_setopt($ch, CURLOPT_STDERR, $abrir);
	$contenido=curl_exec($ch);
	curl_close ($ch);*/
	$seleccionado=busca_filtro_tabla("","ft_despacho_fisico,documento","documento_iddocumento=iddocumento and documento_iddocumento=".$iddoc,"",$conn);	
	if($seleccionado[0]['mensajero']==0 || $seleccionado[0]['mensajero']==''){
		$sql1_mensajero="UPDATE ft_despacho_fisico SET mensajero='".usuario_actual('idfuncionario')."' where idft_despacho_fisico=".$seleccionado[0]['idft_despacho_fisico'];
		phpmkr_query($sql1_mensajero);
		$seleccionado=busca_filtro_tabla("","ft_despacho_fisico,documento","documento_iddocumento=iddocumento and documento_iddocumento=".$iddoc,"",$conn);
	}
	$mensajero=$seleccionado[0]['mensajero'];
	
	$documentos=explode(",",$seleccionado[0]['docs_seleccionados']);
	$tipo_despacho=1;
	$j=0;
	$cant=count($documentos);
	for($i=0;$i<$cant;$i++){
		if($documentos[$i]){
			$documento_mns = busca_filtro_tabla("descripcion,plantilla,ejecutor,numero", "documento", "iddocumento=".$documentos[$i], "", $conn);
			$sql1_salidas="INSERT INTO salidas(documento_iddocumento,responsable,fecha_despacho,tipo_despacho,notas,radicado_despacho) VALUES ('".$documentos[$i]."','".$mensajero."',".fecha_db_almacenar(date("Y-m-d H:i:s"),"Y-m-d H:i:s").",'".$tipo_despacho."','Despacho realizado por despacho fisico.','".$seleccionado[0]['numero']."')";
			phpmkr_query($sql1_salidas);
			$id=phpmkr_insert_id();
			if($id){
				$j++;
			}
			$funcionario=busca_filtro_tabla("","vfuncionario_dc","idfuncionario=".$mensajero,"",$conn);
			$datos["origen"] = usuario_actual("funcionario_codigo");
			$datos["archivo_idarchivo"] = $documentos[$i];
			$datos["tipo_destino"] =1;
			$datos["ver_notas"]=1;
			$datos["tipo_origen"]=1;    
			$datos["tipo"] = "";
			$datos["nombre"] = "DISTRIBUCION";
			$otros["notas"] = "'Consecutivo despacho: ".$seleccionado[0]["numero"]."<br/>Responsable o mensajero: ".$funcionario[0]['nombres']." ".$funcionario[0]['apellidos']."'";
			transferir_archivo_prueba($datos, array($documento_mns[0]["ejecutor"]), $otros);
		}
	}
	if($j==$i){
		//alerta("Despachos realizados");
		notificacion_saia('Despachos realizados','success','',4000);
	}
	abrir_url($ruta_db_superior."class_impresion.php?iddoc=".$iddoc,"_self");
	die();
}

function reporte_entradas2($idformato,$iddoc){
	global $conn,$documentos;
	$logo=busca_filtro_tabla("valor","configuracion","nombre='logo'","",$conn);
	$texto.='<table style="border-collapse:collapse;width:100%" border="1px">';
	$texto.='<tr style="height:120px">';
	$texto.='<td style="text-align:center;" colspan="2"><img src="'.PROTOCOLO_CONEXION.RUTA_PDF.'/'.$logo[0]['valor'].'" width="125px" heigth="83px"></td>';
	$texto.='<td style="text-align:center" colspan="4"><b>CONTROL DE ENTREGA DE DOCUMENTOS RECIBO Y RADICACI&Oacute;N DE CORRESPONDENCIA</b></td>';
	$texto.='<td style="text-align:right" colspan="2"><b>C&Oacute;DIGO:GF-01</b><br/>RADICADO: '.formato_numero($idformato,$iddoc,1).'</td>';
	$texto.='</tr>';
	$texto.='<tr>';
	$texto.='<td colspan="2"><b>VERSI&Oacute;N:1</b></td>';
	$texto.='<td colspan="2"><b>FECHA DE EMISI&Oacute;N:'.date('d/m/Y').'</b></td>';
	$texto.='<td colspan="2"><b>FECHA ULTIMO CAMBIO:</b></td>';
	$texto.='<td colspan="2"><b>PAGINA:</b></td>';
	$texto.='</tr>';
	$texto.='</table>';
	$texto.='<br />';
	$texto.='<table style="border-collapse:collapse;width:100%" border="1px">';
	$texto.='<tr style="height:70px">';
	$texto.='<td style="text-align:center"><b>No Orden</b></td>';
	$texto.='<td style="text-align:center"><b>No Radicado</b></td>';
	$texto.='<td style="text-align:center"><b>Fecha de Radicado</b></td>';
	$texto.='<td style="text-align:center;width:10%"><b>Remitente</b></td>';
	$texto.='<td style="text-align:center"><b>Asunto</b></td>';
	$texto.='<td style="text-align:center"><b>Fecha entrega</b></td>';
	$texto.='<td style="text-align:center"><b>Area</b></td>';
	$texto.='<td style="text-align:center"><b>Nombre</b></td>';
	$texto.='</tr>';
	for($i=0;$i<$documentos["numcampos"];$i++){
		$texto.='<tr>';
		$texto.='<td style="text-align:center">&nbsp;</td>';
		$texto.='<td style="text-align:center">'.$documentos[$i]["numero"].'</td>';
		$texto.='<td style="text-align:center;">'.$documentos[$i]["fecha"].'</td>';
		$texto.='<td style="text-align:left;">'.remitente_entrada($documentos[$i]["iddocumento"]).'</td>';
		$texto.='<td style="text-align:left;">'.($documentos[$i]["descripcion"]).'</td>';
		$texto.='<td style="text-align:center;">&nbsp;</td>';
		$texto.='<td style="text-align:center;">&nbsp;</td>';
		$texto.='<td style="text-align:center;">&nbsp;</td>';
		$texto.='</tr>';
	}
	$texto.='</table>';
	return($texto);
}
function reporte_salidas2($idformato,$iddoc){
	global $conn,$documentos,$ruta_db_superior;
	$documentos2=busca_filtro_tabla("","documento A,ft_despacho_fisico","documento_iddocumento=iddocumento and A.iddocumento =".$iddoc,"",$conn);
	$funcionario=busca_filtro_tabla("","vfuncionario_dc","idfuncionario=".$documentos2[0]['mensajero'],"",$conn);
	$texto='';
	$logo=busca_filtro_tabla("valor","configuracion","nombre='logo'","",$conn);
	$texto.='<table style="border-collapse:collapse;width:100%" border="1px">';
	$texto.='<tr style="height:120px">';
	$texto.='<td style="text-align:center;" colspan="3"><br/><br/><img src="'.PROTOCOLO_CONEXION.RUTA_PDF.'/'.$logo[0]['valor'].'" width="125px" heigth="83px"></td>';
	//$texto.='<td style="text-align:center;" colspan="3"><img src="'.PROTOCOLO_CONEXION.RUTA_PDF.'/imagenes/logo_demo755-20160224.jpg"></td>';
	$texto.='<td style="text-align:center;" colspan="8"><br/><br/><br/><br/><b>CONTROL DE ENTREGA DE DOCUMENTOS RECIBO Y RADICACI&Oacute;N DE CORRESPONDENCIA</b></td>';
	$texto.='<td style="text-align:center;" colspan="4"><br/><br/><br/><br/><b>C&Oacute;DIGO:GF-01<br/>RADICADO: '.formato_numero($idformato,$iddoc,1).'</b></td>';
	$texto.='</tr>';
	$texto.='<tr>';
	$texto.='<td colspan="3"><b>VERSI&Oacute;N:1</b></td>';
	$texto.='<td colspan="4"><b>FECHA DE EMISI&Oacute;N:'.date('d/m/Y').'</b></td>';
	$texto.='<td colspan="4"><b>FECHA ULTIMO CAMBIO:</b></td>';
	$texto.='<td colspan="4"><b>PAGINA:</b></td>';
	$texto.='</tr>';
	$texto.='<tr>';
	$texto.='<td colspan="15"><b>MENSAJERO O ENCARGADO: '.$funcionario[0]['nombres'].' '.$funcionario[0]['apellidos'].'</b></td>';
	$texto.='</tr>';
	$texto.='</table>';
	$texto.='<br />';
	$texto.='<table style="border-collapse:collapse;width:100%;" border="1px">';
	$texto.='<tr style="height:70px">';
	$texto.='<td style="text-align:center;width:8%;"><b>No radicado</b></td>';
	$texto.='<td style="text-align:center"><b>Fecha</b></td>';
	$texto.='<td style="text-align:center;width:10%;"><b>Remitente</b></td>';
	$texto.='<td style="text-align:center"><b>Asunto</b></td>';
	$texto.='<td style="text-align:center"><b>Destino</b></td>';
	$texto.='<td style="text-align:center"><b>Direcci&oacute;n</b></td>';
	$texto.='<td style="text-align:center"><b>Tel&eacute;fono</b></td>';
	$texto.='<td style="text-align:center"><b>Ciudad</b></td>';
	$texto.='<td style="text-align:center;width:15%;"><b>Recibido por</b></td>';
	$texto.='</tr>';
	for($i=0;$i<$documentos["numcampos"];$i++){
		$texto.='<tr>';
		$texto.='<td style="text-align:center">'.$documentos[$i]["numero"].'</td>';
		$texto.='<td style="text-align:center;">'.$documentos[$i]["fecha"].'</td>';
		$texto.='<td style="text-align:left;">'.usuario_aprobador_tramitados($documentos[$i]["iddocumento"]).'</td>';
		$texto.='<td style="text-align:left;">'.($documentos[$i]["descripcion"]).'</td>';
		$texto.='<td style="text-align:left;">'.destino_remitente($documentos[$i]["iddocumento"],$documentos[$i]["plantilla"]).'</td>';
		$texto.='<td style="text-align:left;">'.direccion_destino_remitente($documentos[$i]["iddocumento"]).'</td>';
		$texto.='<td style="text-align:center;">'.telefono_destino_remitente($documentos[$i]["iddocumento"]).'</td>';
		$texto.='<td style="text-align:center;">'.ciudad_destino_remitente($documentos[$i]["iddocumento"]).'</td>';
		$texto.='<td style="text-align:center;">&nbsp;</td>';
		$texto.='</tr>';
	}
	$texto.='</table>';
	return($texto);
}
?>
