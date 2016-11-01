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
echo(librerias_validar_formulario());
echo(librerias_notificaciones());
echo (librerias_jquery("1.7"));
//------------------------------Adicionar------------------------------------//
function campos_ocultos_entrega($idformato,$iddoc){
	global $conn,$ruta_db_superior;
	$valores=trim($_REQUEST['idft'],',');
	$mensajero=trim($_REQUEST['mensajero'],',');
	$hoy=date("Y-m-d");
	?>
	<script>
		$(document).ready(function (){
			var valores='<?php echo $valores;?>';
			var mensajero='<?php echo $mensajero;?>';
			if(valores=='' || valores==0 || mensajero=='' || mensajero==0){
				alerta("Por favor seleccione documentos y mensajero");
			}else{
				$("input[name=iddestino_radicacion]").val('<?php echo $valores;?>');
				$("input[name=mensajero]").val('<?php echo $mensajero;?>');
				$("input[name=fecha_entrega]").val('<?php echo $hoy;?>');
			}
		});
		$("#formulario_formatos").validate({
				submitHandler: function(form){
					var seguro=confirm("Esta seguro que desea crear la entrega?");
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
function mostrar_seleccionados_entrega($idformato,$iddoc){
	global $conn,$ruta_db_superior,$registros;
	$seleccionado=busca_filtro_tabla("","ft_despacho_ingresados","documento_iddocumento=".$iddoc,"",$conn);
	$documentos=explode(",",$seleccionado[0]['iddestino_radicacion']);
	$docs=array_filter($documentos);
	$texto='';
	$registros=busca_filtro_tabla("d.iddocumento,d.planilla","ft_radicacion_entrada a,ft_destino_radicacion b,ft_item_despacho_ingres c, documento d","b.ft_radicacion_entrada=a.idft_radicacion_entrada AND c.ft_destino_radicacion=b.idft_destino_radicacion AND d.iddocumento=a.documento_iddocumento AND b.documento_iddocumento=".$iddoc,"",$conn);
	
	$texto.=reporte_entradas2($idformato,$iddoc);
	echo($texto);
}
//------------------------------Posterior aprobar------------------------------------//
function generar_pdf_entrega($idformato,$iddoc){
	global $conn,$ruta_db_superior;
	$seleccionado=busca_filtro_tabla("iddestino_radicacion,idft_despacho_ingresados","ft_despacho_ingresados","documento_iddocumento=".$iddoc,"",$conn);
	$iddestino_radicacion=explode(",",$seleccionado[0]['iddestino_radicacion']);
	$cont=count($iddestino_radicacion);
	for($i=0;$i<$cont;$i++){
	    $insert="INSERT INTO ft_item_despacho_ingres(idft_item_despacho_ingres,ft_destino_radicacio,ft_despacho_ingresados) VALUES (NULL, '".$iddestino_radicacion[$i]."', '".$seleccionado[0]['idft_despacho_ingresados']."')";
	    echo($insert);
	    phpmkr_query($insert);
	}
	abrir_url($ruta_db_superior."class_impresion.php?iddoc=".$iddoc,"_self");
	die();
}

function reporte_entradas2($idformato,$iddoc){
	global $conn,$registros,$ruta_db_superior;
	include_once($ruta_db_superior."pantallas/qr/librerias.php");
	$codigo_qr=busca_filtro_tabla("","documento_verificacion","documento_iddocumento=".$iddoc,"", $conn);
	if($codigo_qr['numcampos']){
		$qr='<img src="http://'.RUTA_PDF.'/'.$codigo_qr[0]['ruta_qr'].'" width="80px" height="80px">';	
	}else{
		generar_codigo_qr($idformato,$iddoc);
		$codigo_qr=busca_filtro_tabla("","documento_verificacion","documento_iddocumento=".$iddoc,"", $conn);	
		$qr='<img src="http://'.RUTA_PDF.'/'.$codigo_qr[0]['ruta_qr'].'" width="80px" height="80px">';	
	}
	$documentos2=busca_filtro_tabla("","ft_despacho_ingresados","documento_iddocumento=".$iddoc,"",$conn);
	$funcionario=busca_filtro_tabla("","vfuncionario_dc","dependencia_cargo=".$documentos2[0]['mensajero'],"",$conn);
	$logo=busca_filtro_tabla("valor","configuracion","nombre='logo'","",$conn);
	$texto='<table style="border-collapse:collapse;width:100%" border="1px">';
	$texto.='<tr>';
	$texto.='<td style="text-align:center;" colspan="2" rowspan="2"><br/><br/><img src="'.PROTOCOLO_CONEXION.RUTA_PDF.'/'.$logo[0]['valor'].'" width="125px" heigth="83px"></td>';
	$texto.='<td style="text-align:center" colspan="5" rowspan="2"><br/><br/><br/><br/><br/><b>PLANILLA DE CONTROL DE COMUNICACIONES DE LA DEPENDENCIA </b></td>';
	$texto.='<td style="text-align:left"><br/><br/><br/><br/><b>C&Oacute;DIGO: GDC-FT-003<br/>RADICADO: '.formato_numero($idformato,$iddoc,1).'</b></td>
	<td style="text-align:center" rowspan="3">'.$qr.'</td>
	</tr>';
	$texto.='<tr><td style="text-align:left"><b>VERSI&Oacute;N:</b> 001</td></tr>';
	$texto.='<tr>';
	$texto.='<td colspan="9"><b>MENSAJERO O ENCARGADO: '.$funcionario[0]['nombres'].' '.$funcionario[0]['apellidos'].'</b></td>';
	$texto.='</tr>';
	$texto.='</table>';
	
	$texto.='<br />';
	$texto.='<table style="border-collapse:collapse;width:100%" border="1px">';
	$texto.='<tr style="height:70px">';
	$texto.='<td style="text-align:center"><b>N° RADICADO</b></td>';
	$texto.='<td style="text-align:center"><b>FECHA DE RECIBO(DD/MM/AAAA)</b></td>';
	$texto.='<td style="text-align:center"><b>FOLIOS</b></td>';
	$texto.='<td style="text-align:center"><b>REMITENTE</b></td>';
	$texto.='<td style="text-align:center"><b>ASUNTO</b></td>';
	
	$texto.='<td style="text-align:center"><b>ASIGNADA A (NOMBRE Y FIRMA)</b></td>';
	$texto.='<td style="text-align:center"><b>FECHA DE ASIGNACIÓN</b></td>';
	
	$texto.='<td style="text-align:center"><b>FIRMA DE QUIEN RECIBE</b></td>';	
	$texto.='<td style="text-align:center"><b>FECHA DE RESPUESTA</b></td>';
	$texto.='</tr>';
	
	for($i=0;$i<$registros["numcampos"];$i++){
		if($registros[$i]['plantilla']=='RADICACION_ENTRADA'){
			$documentos=busca_filtro_tabla("r.*,numero,iddocumento,fecha,paginas","ft_radicacion_entrada r,documento A","documento_iddocumento=iddocumento and A.iddocumento=".$registros[$i]['iddocumento'],"",$conn);
			$datos_remitente=busca_filtro_tabla("B.nombre,A.*","datos_ejecutor A, ejecutor B","A.ejecutor_idejecutor=B.idejecutor AND A.iddatos_ejecutor=".$documentos[0]['persona_natural'],"",$conn);
			$datos_destino=busca_filtro_tabla("","vfuncionario_dc","iddependencia_cargo=".$documentos[0]['destino'],"",$conn);
		}else{
			$formato=strtolower($registros[$i]['plantilla']);
			$documentos=busca_filtro_tabla("r.*,numero,iddocumento,A.fecha,paginas,descripcion","ft_".$formato." r,documento A","documento_iddocumento=iddocumento and A.iddocumento=".$registros[$i]['iddocumento'],"",$conn);
			$datos_remitente=busca_filtro_tabla("","vfuncionario_dc","iddependencia_cargo=".$documentos[0]['dependencia'],"",$conn);
		}
		
		$buzon_salida=busca_filtro_tabla("","buzon_salida A","nombre='TRANSFERIDO' and A.archivo_idarchivo=".$documentos[0]["iddocumento"],"fecha asc",$conn);
		$fecha_respuesta=busca_filtro_tabla("","respuesta, documento","estado='APROBADO' and destino=iddocumento and origen=".$documentos[0]["iddocumento"],"",$conn);

		if($fecha_respuesta['numcampos']>0){
			$fecha=date('d-m-Y', strtotime($fecha_respuesta[0]['fecha']));
		}else{
			$fecha='';
		}
		$texto.='<tr>';
		$texto.='<td style="text-align:center">'.$documentos[0]["numero"].'</td>';
		$texto.='<td style="text-align:center;">'.date('d-m-Y', strtotime($documentos[0]["fecha"])).'</td>';
		
		if($registros[$i]['plantilla']=='RADICACION_ENTRADA'){
			$texto.='<td style="text-align:center;">'.$documentos[0]["numero_folios"].'</td>';
			$texto.='<td style="text-align:left;">'.$datos_remitente[0]["nombre"].'</td>';
			$texto.='<td style="text-align:left;">'.$documentos[0]["descripcion"].'</td>';
			$texto.='<td style="text-align:center;">'.$datos_destino[0]['nombres']." ".$datos_destino[0]['apellidos'].'</td>';
		}else{
			$texto.='<td style="text-align:center;">'.$documentos[0]["paginas"].'</td>';
			if($registros[$i]['plantilla']=='PQRSF'){
				$texto.='<td style="text-align:left;">'.$documentos[0]["nombre"].'</td>';
			}else{
				$texto.='<td style="text-align:center;">'.$datos_remitente[0]['nombres']." ".$datos_remitente[0]['apellidos'].'</td>';
			}
			$texto.='<td style="text-align:left;">'.$documentos[0]["descripcion"].'</td>';
			if($registros[$i]['plantilla']=='CORREO_SAIA'){
				$texto.='<td style="text-align:left;">'.$documentos[0]['para'].'</td>';
			}else{
				$texto.='<td style="text-align:center;"></td>';
			}			
		}
		
		if($buzon_salida['numcampos']==0){
			$texto.='<td style="text-align:center;"></td>';
		}else{
			$texto.='<td style="text-align:center;">'.date('d-m-Y', strtotime($buzon_salida[0]['fecha'])).'</td>';
		}
		$texto.='<td style="text-align:left;"></td>';
		$texto.='<td style="text-align:center;">'.$fecha.'</td>';
		$texto.='</tr>';
	}
	$texto.='</table>';
	return($texto);
}
function reporte_salidas2($idformato,$iddoc){
	global $conn,$documentos,$ruta_db_superior;
	
	echo("123");
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
	$texto.='<table style="border-collapse:collapse;width:100%" border="1px">';
	$texto.='<tr style="height:70px">';
	$texto.='<td style="text-align:center;width:8%;"><b>No radicado</b></td>';
	$texto.='<td style="text-align:center"><b>Fecha</b></td>';
	$texto.='<td style="text-align:center;width:10%;"><b>Remitente</b></td>';
	$texto.='<td style="text-align:center"><b>Asunto</b></td>';
	$texto.='<td style="text-align:center"><b>Destino</b></td>';
	$texto.='<td style="text-align:center"><b>Direcci&oacute;n</b></td>';
	$texto.='<td style="text-align:center"><b>Tel&eacute;fono</b></td>';
	$texto.='<td style="text-align:center"><b>Ciudad</b></td>';
	$texto.='<td style="text-align:center"><b>Recibido por...</b></td>';
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
function generar_qr_despacho($idformato,$iddoc){
  global $conn;
  $max_salida=10; // Previene algun posible ciclo infinito limitando a 10 los ../
  $ruta_db_superior=$ruta="";
  while($max_salida>0){
    if(is_file($ruta."db.php")){
      $ruta_db_superior=$ruta; //Preserva la ruta superior encontrada
    }
    $ruta.="../";
    $max_salida--;
  }
  include_once($ruta_db_superior."pantallas/qr/librerias.php");
  generar_codigo_qr($idformato,$iddoc);
}
?>