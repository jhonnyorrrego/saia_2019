<?php
$max_salida = 10;
$ruta_db_superior = $ruta = "";
while ($max_salida > 0) {
	if (is_file($ruta . "db.php")) {
		$ruta_db_superior = $ruta;
	}
	$ruta .= "../";
	$max_salida--;
}
include_once  ($ruta_db_superior."core/autoload.php");
include_once ($ruta_db_superior . "db.php");
include_once ($ruta_db_superior . "librerias_saia.php");
include_once ($ruta_db_superior . "pantallas/documento/librerias_tramitados.php");

echo(librerias_notificaciones());
echo(librerias_jquery("1.7"));
//------------------------------Adicionar------------------------------------//
function campos_ocultos_entrega($idformato,$iddoc){
	global $conn,$ruta_db_superior;
	$valores=trim($_REQUEST['iddistribucion'],',');
	$vector_mensajero=explode('-',$_REQUEST['mensajero']);
	$mensajero=trim($vector_mensajero[0],',');
	$tipo_mensajero=$vector_mensajero[1];
	$hoy=date("Y-m-d");
	$ventanillas = busca_filtro_tabla("idcf_ventanilla,nombre","cf_ventanilla","estado=1","idcf_ventanilla ASC",$conn);

	$opciones_ventanilla="";
	for ($i=0;$i<$ventanillas['numcampos'];$i++){
        $opciones_ventanilla.="<option value=".$ventanillas[$i]['idcf_ventanilla'].">".$ventanillas[$i]['nombre']."</option>";
    }

	?>
	<script>
		$(document).ready(function (){
			var valores='<?php echo $valores;?>';
			var mensajero='<?php echo $mensajero;?>';
			if(valores=='' || valores==0 || mensajero=='' || mensajero==0){
				alerta("Por favor seleccione documentos y mensajero");
			}else{
				$("input[name=idft_ruta_dist]").val('<?php echo $_REQUEST['idruta_dist'];?>');
				$("input[name=iddestino_radicacion]").val('<?php echo $valores;?>');
				$("input[name=mensajero]").val('<?php echo $mensajero;?>');
				$("input[name=tipo_mensajero]").val('<?php echo $tipo_mensajero;?>');
				$("input[name=fecha_entrega]").val('<?php echo $hoy;?>');
			}
		});
		$("#ventanilla").empty().html("<?php echo($opciones_ventanilla); ?>");
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

function mensajero_entrega_interna($idformato, $iddoc) {
	global $conn;
	$documentos2 = busca_filtro_tabla("", "ft_despacho_ingresados", "documento_iddocumento=" . $iddoc, "", $conn);
	if ($documentos2[0]['tipo_mensajero'] == 'e') {
		$empresa_transportadora = busca_filtro_tabla("nombre", "cf_empresa_trans", "idcf_empresa_trans=" . $documentos2[0]['mensajero'], "", $conn);
		$cadena_nombre = $empresa_transportadora[0]['nombre'];
	} else {
		$funcionario = busca_filtro_tabla("", "vfuncionario_dc", "iddependencia_cargo=" . $documentos2[0]['mensajero'], "", $conn);
		$cadena_nombre = $funcionario[0]['nombres'] . ' ' . $funcionario[0]['apellidos'];
	}
	return (ucwords(strtolower($cadena_nombre)));
}

function ruta_entrega_interna($idformato, $iddoc){
	global $conn;
	$datos=busca_filtro_tabla("idft_ruta_dist", "ft_despacho_ingresados", "documento_iddocumento=" . $iddoc, "", $conn);
	if($datos["numcampos"] && $datos[0]["idft_ruta_dist"]!=""){
		$ruta=busca_filtro_tabla("nombre_ruta","ft_ruta_distribucion","idft_ruta_distribucion in (".$datos[0]["idft_ruta_dist"].")","",$conn);
		if($ruta["numcampos"]){
			$nomb=extrae_campo($ruta,"nombre_ruta");
			return("<br/>".implode(", ", $nomb));
		}
	}
}

function mostrar_seleccionados_entrega($idformato, $iddoc) {
	global $conn, $ruta_db_superior, $registros;
	$texto = '';
	$items_seleccionados = busca_filtro_tabla("idft_despacho_ingresados", "ft_despacho_ingresados", "documento_iddocumento=" . $iddoc, "", $conn);
	$items = busca_filtro_tabla("ft_destino_radicacio", "ft_item_despacho_ingres", "ft_despacho_ingresados=" . $items_seleccionados[0]['idft_despacho_ingresados'], "", $conn);
	$cadena_items_seleccionados = '';
	for ($i = 0; $i < $items['numcampos']; $i++) {
		$cadena_items_seleccionados .= $items[$i]['ft_destino_radicacio'];
		if (($i + 1) != $items['numcampos']) {
			$cadena_items_seleccionados .= ',';
		}
	}

	$registros = busca_filtro_tabla(fecha_db_obtener("a.fecha_creacion", "Y-m-d") . " as fecha_creacion,b.descripcion,a.tipo_origen,a.estado_recogida,a.numero_distribucion,a.origen,a.tipo_origen,a.destino,a.tipo_destino", "distribucion a,documento b", "a.documento_iddocumento=b.iddocumento AND a.iddistribucion in(" . $cadena_items_seleccionados . ")", "", $conn);

	$texto .= reporte_entradas2($idformato, $iddoc);
	echo($texto);
}

//------------------------------Posterior aprobar------------------------------------//
function generar_pdf_entrega($idformato, $iddoc) {
	global $conn, $ruta_db_superior;
	$seleccionado = busca_filtro_tabla("iddestino_radicacion,idft_despacho_ingresados,serie_idserie,ventanilla", "ft_despacho_ingresados", "documento_iddocumento=" . $iddoc, "", $conn);
	$iddestino_radicacion = explode(",", $seleccionado[0]['iddestino_radicacion']);
	$cont = count($iddestino_radicacion);
	for ($i = 0; $i < $cont; $i++) {
        $insert = "INSERT INTO ft_item_despacho_ingres(ft_destino_radicacio,ft_despacho_ingresados,serie_idserie) VALUES ('" . $iddestino_radicacion[$i] . "', '" . $seleccionado[0]['idft_despacho_ingresados'] . "'," . $seleccionado[0]['serie_idserie'] . ")";
        phpmkr_query($insert);
        $busca_item_actual=busca_filtro_tabla("idft_item_despacho_ingres","ft_item_despacho_ingres","ft_destino_radicacio=".$iddestino_radicacion[$i]." and ft_despacho_ingresados=".$seleccionado[0]['idft_despacho_ingresados'],"",$conn);
        $insert = "INSERT INTO dt_recep_despacho(iddistribucion,ft_item_despacho_ingres,idfuncionario) VALUES ('" . $iddestino_radicacion[$i] . "', '" . $busca_item_actual[0]['idft_item_despacho_ingres'] . "'," . SessionController::getValue('idfuncionario') . ")";
        phpmkr_query($insert);

        $distribucion = busca_filtro_tabla("documento_iddocumento","distribucion","iddistribucion=".$iddestino_radicacion[$i],"",$conn);
        $insert = "INSERT INTO dt_ventanilla_doc(documento_iddocumento,idcf_ventanilla,idfuncionario) VALUES ('" . $distribucion[0]['documento_iddocumento'] . "', '" . $seleccionado[$i]['ventanilla'] . "'," . SessionController::getValue('idfuncionario') . ")";
        phpmkr_query($insert);

		$update = "UPDATE distribucion SET estado_distribucion=2 WHERE iddistribucion=" . $iddestino_radicacion[$i];
		phpmkr_query($update);

	}
}

function reporte_entradas2($idformato, $iddoc) {
	global $conn, $registros, $ruta_db_superior;

	include_once ($ruta_db_superior . "distribucion/funciones_distribucion.php");

	$documentos2 = busca_filtro_tabla("", "ft_despacho_ingresados", "documento_iddocumento=" . $iddoc, "", $conn);
	$funcionario = busca_filtro_tabla("", "vfuncionario_dc", "iddependencia_cargo=" . $documentos2[0]['mensajero'], "", $conn);

	$logo = busca_filtro_tabla("valor", "configuracion", "nombre='logo'", "", $conn);

	$texto .= '<br />';
        $texto .= '<label><b>Mensajero: '.$funcionario[0]['nombres'].' '.$funcionario[0]['apellidos'].'</b></label>';
        $texto .= '<br /><br />';
	$texto .= '<table style="border-collapse:collapse;width:100%" border="1">';
	$texto .= '<thead><tr>';
	$texto .= '<td style="text-align:center;"><b>TRAMITE</b></td>';
	$texto .= '<td style="text-align:center;"><b>TIPO</b></td>';
	$texto .= '<td style="text-align:center;"><b>RAD. ITEM</b></td>';
	$texto .= '<td style="text-align:center;"><b>FECHA DE RECIBO</b></td>';
	$texto .= '<td style="text-align:center;"><b>ORIGEN</b></td>';
	$texto .= '<td style="text-align:center;"><b>DESTINO</b></td>';
	$texto .= '<td style="text-align:center;"><b>ASUNTO</b></td>';
	$texto .= '<td style="text-align:center;"><b>FIRMA DE QUIEN RECIBE</b></td>';
	$texto .= '<td style="text-align:center;"><b>OBSERVACIONES</b></td>';
	$texto .= '</tr></thead>';

	for ($i = 0; $i < $registros["numcampos"]; $i++) {
		$texto .= '<tr>';
		$texto .= '<td style="text-align:center;">' . mostrar_diligencia_distribucion($registros[$i]["tipo_origen"], $registros[$i]["estado_recogida"]) . '</td>';
		$texto .= '<td style="text-align:center;">' . mostrar_tipo_radicado_distribucion($registros[$i]["tipo_origen"]) . '</td>';
		$texto .= '<td style="text-align:center;">' . $registros[$i]["numero_distribucion"] . '</td>';
		$texto .= '<td style="text-align:center;">' . $registros[$i]["fecha_creacion"] . '</td>';
		$texto .= '<td style="text-align:left;">' . retornar_origen_destino_distribucion($registros[$i]['tipo_origen'], $registros[$i]['origen']) . '<br>' . retornar_ubicacion_origen_destino_distribucion($registros[$i]['tipo_origen'], $registros[$i]['origen']) . '</td>';
		$texto .= '<td style="text-align:left;">' . retornar_origen_destino_distribucion($registros[$i]['tipo_destino'], $registros[$i]['destino']) . '<br>' . retornar_ubicacion_origen_destino_distribucion($registros[$i]['tipo_destino'], $registros[$i]['destino']) . '</td>';
		$texto .= '<td style="text-align:left;">' . $registros[$i]["descripcion"] . '</td>';
		$texto .= '<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>';
		$texto .= '<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>';
		$texto .= '</tr>';
	}
	$texto .= '</table>';
	return ($texto);
}
?>
