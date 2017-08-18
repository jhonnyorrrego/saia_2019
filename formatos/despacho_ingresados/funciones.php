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
	$valores=trim($_REQUEST['iddistribucion'],',');
	$vector_mensajero=explode('-',$_REQUEST['mensajero']);
	$mensajero=trim($vector_mensajero[0],',');
	$tipo_mensajero=$vector_mensajero[1];
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
				$("input[name=tipo_mensajero]").val('<?php echo $tipo_mensajero;?>');
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
	
	$items_seleccionados=busca_filtro_tabla("iddestino_radicacion","ft_despacho_ingresados","documento_iddocumento=".$iddoc,"",$conn);
	$cadena_items_seleccionados=$items_seleccionados[0]['iddestino_radicacion'];
	
	$registros=busca_filtro_tabla("b.descripcion,a.tipo_origen,a.estado_recogida,a.numero_distribucion,a.fecha_creacion,a.origen,a.tipo_origen,a.destino,a.tipo_destino","distribucion a,documento b","a.documento_iddocumento=b.iddocumento AND a.iddistribucion in(".$cadena_items_seleccionados.")","",$conn);
	
	$texto.=reporte_entradas2($idformato,$iddoc);
	echo($texto);
}
//------------------------------Posterior aprobar------------------------------------//
function generar_pdf_entrega($idformato,$iddoc){
	global $conn,$ruta_db_superior;
	$seleccionado=busca_filtro_tabla("iddestino_radicacion,idft_despacho_ingresados,serie_idserie","ft_despacho_ingresados","documento_iddocumento=".$iddoc,"",$conn);
	$iddestino_radicacion=explode(",",$seleccionado[0]['iddestino_radicacion']);
	$cont=count($iddestino_radicacion);
	for($i=0;$i<$cont;$i++){
	    $insert="INSERT INTO ft_item_despacho_ingres(idft_item_despacho_ingres,ft_destino_radicacio,ft_despacho_ingresados,serie_idserie) VALUES (NULL, '".$iddestino_radicacion[$i]."', '".$seleccionado[0]['idft_despacho_ingresados']."',".$seleccionado[0]['serie_idserie'].")";
	    phpmkr_query($insert);
	    $update="UPDATE distribucion SET estado_distribucion=2 WHERE iddistribucion=".$iddestino_radicacion[$i];
        phpmkr_query($update);
	    
	}
	abrir_url($ruta_db_superior."class_impresion.php?iddoc=".$iddoc,"_self");
	die();
}

function reporte_entradas2($idformato,$iddoc){
	global $conn,$registros,$ruta_db_superior;
	
	include_once($ruta_db_superior."pantallas/qr/librerias.php");
	include_once($ruta_db_superior."distribucion/funciones_distribucion.php");

	$documentos2=busca_filtro_tabla("","ft_despacho_ingresados","documento_iddocumento=".$iddoc,"",$conn);
	$funcionario=busca_filtro_tabla("","vfuncionario_dc","iddependencia_cargo=".$documentos2[0]['mensajero'],"",$conn);
	
	$logo=busca_filtro_tabla("valor","configuracion","nombre='logo'","",$conn);

	
	$texto.='<br />';
	$texto.='<table class="bpmTopicC" style="border-collapse:collapse;width:100%" border="1px">';
	$texto.='<thead><tr style="height:70px">';
	 $texto.='<td style="text-align:center; width:7%"><b>TRAMITE</b></td>';
    $texto.='<td style="text-align:center; width:3%"><b>TIPO</b></td>';
	$texto.='<td style="text-align:center; width:3%"><b>Rad. Item</b></td>';
	$texto.='<td style="text-align:center; width:5%"><b>FECHA DE RECIBO</b></td>';
	$texto.='<td style="text-align:center; width:10%"><b>ORIGEN</b></td>';
	$texto.='<td style="text-align:center; width:15%"><b>DESTINO</b></td>';
    $texto.='<td style="text-align:center; width:25%"><b>ASUNTO</b></td>';
	$texto.='<td style="text-align:center; width:15%"><b>FIRMA DE QUIEN RECIBE</b></td>';
    $texto.='<td style="text-align:center; width:17%"><b>OBSERVACIONES</b></td>';
	$texto.='</tr></thead>';
	
	for($i=0;$i<$registros["numcampos"];$i++){
		$texto.='<tr>';
        $texto.='<td style="text-align:center; width:7%">'.mostrar_diligencia_distribucion($registros[$i]["tipo_origen"],$registros[$i]["estado_recogida"]).'</td>';
        $texto.='<td style="text-align:center; width:3%">'.mostrar_tipo_radicado_distribucion($registros[$i]["tipo_origen"]).'</td>';
		$texto.='<td style="text-align:center; width:3%">'.$registros[$i]["numero_distribucion"].'</td>';
		$texto.='<td style="text-align:center; width:5%">'.$registros[$i]["fecha_creacion"].'</td>';
		$texto.='<td style="text-align:left; width:10%">'.retornar_origen_destino_distribucion($registros[$i]['tipo_origen'],$registros[$i]['origen']).'<br>'.retornar_ubicacion_origen_destino_distribucion($registros[$i]['tipo_origen'],$registros[$i]['origen']).'</td>';
		$texto.='<td style="text-align:left; width:15%">'.retornar_origen_destino_distribucion($registros[$i]['tipo_destino'],$registros[$i]['destino']).'<br>'.retornar_ubicacion_origen_destino_distribucion($registros[$i]['tipo_destino'],$registros[$i]['destino']).'</td>';
		$texto.='<td style="text-align:left; width:25%">'.$registros[$i]["descripcion"].'</td>';
		$texto.='<td style="text-align:center; width:15%"></td>';
		$texto.='<td style="text-align:left; width:17%"></td>';
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
