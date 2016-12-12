<?php
@set_time_limit(0);
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // date in the past
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); // always modified
header("Cache-Control: no-store, no-cache, must-revalidate"); // HTTP/1.1 
header("Cache-Control: post-check=0, pre-check=0", true); 
header("Pragma: no-cache");
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

$texto="";

if($_REQUEST["export"]=="excel"){
	header('Content-Type: application/vnd.ms-excel');
	header("Content-Disposition: attachment; filename=documentos_entregados.xls");
	header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
}
else if($_REQUEST["export"]=="pdf"){
  $url=PROTOCOLO_CONEXION.RUTA_PDF."/pantallas/documento/despachar_fisico.php|no_encabezado=1";
	$url_encabezado=PROTOCOLO_CONEXION.RUTA_PDF."/pantallas/documento/despachar_fisico.php";				
	$ruta=$ruta_db_superior."class_impresion.php?orientacion=1&url=".$url."&pdf=1&url_encabezado=";		
  redirecciona($ruta);
  die(); 
}
else{
	$texto.="<p align='right'><a href='despachar_fisico.php?export=excel&docs=".$_REQUEST["docs"]."'><img src='".$ruta_db_superior."enlaces/excel.gif' alt='Excel'></a></p>";
}
include_once($ruta_db_superior."formatos/librerias/estilo_formulario.php");
include_once($ruta_db_superior."pantallas/documento/librerias_tramitados.php");

$documentos=explode(",",@$_REQUEST["docs"]);
$docs=array_filter($documentos);

$documentos=busca_filtro_tabla("","documento A","A.iddocumento in(".implode(",",$docs).")","",$conn);
if($documentos[0]["tipo_radicado"]==1){
	$texto.=reporte_entradas();
	echo($texto);
}
else if($documentos[0]["tipo_radicado"]==2){
	$texto.=reporte_salidas();
	echo($texto);
}

function reporte_entradas(){
	global $conn,$documentos;
	$logo=busca_filtro_tabla("valor","configuracion","nombre='logo'","",$conn);
	$texto.='<table style="border-collapse:collapse;width:100%" border="1px">';
	$texto.='<tr style="height:120px">';
	$texto.='<td style="text-align:center;" colspan="2"><img src="'.PROTOCOLO_CONEXION.RUTA_PDF.'/'.$logo[0]['valor'].'" width="190px"></td>';
	$texto.='<td style="text-align:center" colspan="4"><b>CONTROL DE ENTREGA DE DOCUMENTOS RECIBO Y RADICACI&Oacute;N DE CORRESPONDENCIA</b></td>';
	$texto.='<td style="text-align:right" colspan="2"><b>C&Oacute;DIGO:GF-01</b></td>';
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
	$texto.='<td style="text-align:center"><b>Remitente</b></td>';
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
		$texto.='<td style="text-align:left;width:10%">'.remitente_entrada($documentos[$i]["iddocumento"]).'</td>';
		$texto.='<td style="text-align:left;">'.($documentos[$i]["descripcion"]).'</td>';
		$texto.='<td style="text-align:center;">&nbsp;</td>';
		$texto.='<td style="text-align:center;">&nbsp;</td>';
		$texto.='<td style="text-align:center;">&nbsp;</td>';
		$texto.='</tr>';
	}
	$texto.='</table>';
	return($texto);
}
function reporte_salidas(){
	global $conn,$documentos,$ruta_db_superior,$docs;
	$texto='';
	if(!@$_REQUEST["export"]){
		$texto.='<script src="'.$ruta_db_superior.'js/noty/jquery.noty.js" type="text/javascript" charset="utf-8"></script>';
		$texto.='<script src="'.$ruta_db_superior.'js/noty/layouts/topCenter.js" type="text/javascript" charset="utf-8"></script>';
		$texto.='<script src="'.$ruta_db_superior.'js/noty/themes/default.js" type="text/javascript" charset="utf-8"></script>';
		$texto.='<script src="'.$ruta_db_superior.'pantallas/lib/librerias_notificaciones.js" type="text/javascript" charset="utf-8"></script>';
		?>
		<input type="hidden" id="docs" value="<?php echo(implode(",",$docs)); ?>">
		<script src="<?php echo($ruta_db_superior); ?>js/jquery.js"></script>
		<script>
		$(document).ready(function(){
			$("#registrar_despacho").click(function(){
				var mensajero=$("#x_mensajero").val();
				if(mensajero){
					var seguro=confirm("Esta seguro de realizar el despacho?");
					if(seguro){
						var docs=$("#docs").val();
						$.ajax({
							type:'POST',
							url:'<?php echo($ruta_db_superior); ?>pantallas/documento/librerias_tramitados.php',
							data:'docs='+docs+'&mensajero='+mensajero+'&ejecutar_accion=registrar_despacho',
							success:function(html){
								notificacion_saia("Despacho realizado","success","",3500);
							}
						});
					}
				}
				else{
					notificacion_saia("Seleccione un mensajero","warning","",3500);
				}
			});
		});
		</script>
		<?php
		$mensajero=busca_filtro_tabla("funcionario_idfuncionario","dependencia_cargo,cargo","lower(nombre)='mensajero' and dependencia_cargo.estado=1 and cargo_idcargo=idcargo","",$conn);
		$options=array();
		
		for($i=0;$i<$mensajero["numcampos"];$i++){
			$dato_mensajero=busca_filtro_tabla("A.idfuncionario,A.nombres,A.apellidos","funcionario A","A.idfuncionario=".$mensajero[$i]["funcionario_idfuncionario"],"",$conn);
			$options[]="<option value='".$dato_mensajero[0]["idfuncionario"]."'>".ucwords(strtolower($dato_mensajero[0]["nombres"]." ".$dato_mensajero[0]["apellidos"]))."</option>";
		}
		
		$texto.='<span style="font-family:Verdana"><b>Seleccionar el mensajero:</b></span> <select name="x_mensajero" id="x_mensajero"><option value="">Por favor seleccione...</option>'.implode("",$options).'</select><input type="button" id="registrar_despacho" value="Realizar despacho"><br /><br />';
	}
	$logo=busca_filtro_tabla("valor","configuracion","nombre='logo'","",$conn);
	$texto.='<table style="border-collapse:collapse;width:100%" border="1px">';
	$texto.='<tr style="height:120px">';
	$texto.='<td style="text-align:center;" colspan="3"><img src="'.PROTOCOLO_CONEXION.RUTA_PDF.'/'.$logo[0]['valor'].'" width="190px"></td>';
	$texto.='<td style="text-align:center" colspan="8"><b>CONTROL DE ENTREGA DE DOCUMENTOS RECIBO Y RADICACI&Oacute;N DE CORRESPONDENCIA</b></td>';
	$texto.='<td style="text-align:right" colspan="4"><b>C&Oacute;DIGO:GF-01</b></td>';
	$texto.='</tr>';
	$texto.='<tr>';
	$texto.='<td colspan="3"><b>VERSI&Oacute;N:1</b></td>';
	$texto.='<td colspan="4"><b>FECHA DE EMISI&Oacute;N:'.date('d/m/Y').'</b></td>';
	$texto.='<td colspan="4"><b>FECHA ULTIMO CAMBIO:</b></td>';
	$texto.='<td colspan="4"><b>PAGINA:</b></td>';
	$texto.='</tr>';
	$texto.='</table>';
	$texto.='<br />';
	$texto.='<table style="border-collapse:collapse;width:100%" border="1px">';
	$texto.='<tr style="height:70px">';
	$texto.='<td style="text-align:center"><b>No radicado</b></td>';
	$texto.='<td style="text-align:center"><b>Fecha</b></td>';
	$texto.='<td style="text-align:center"><b>Remitente</b></td>';
	$texto.='<td style="text-align:center"><b>Asunto</b></td>';
	$texto.='<td style="text-align:center"><b>Destino</b></td>';
	$texto.='<td style="text-align:center"><b>Direcci&oacute;n</b></td>';
	$texto.='<td style="text-align:center"><b>Tel&eacute;fono</b></td>';
	$texto.='<td style="text-align:center"><b>Ciudad</b></td>';
	/*$texto.='<td style="text-align:center"><b>Acci&oacute;n</b></td>';
	$texto.='<td style="text-align:center"><b>Centro de costos</b></td>';
	$texto.='<td style="text-align:center"><b>Departamento</b></td>';
	$texto.='<td style="text-align:center"><b>L&iacute;nea</b></td>';
	$texto.='<td style="text-align:center"><b>Origen</b></td>';
	$texto.='<td style="text-align:center"><b>Proyecto</b></td>';*/
	$texto.='<td style="text-align:center"><b>Recibido por</b></td>';
	$texto.='</tr>';
	for($i=0;$i<$documentos["numcampos"];$i++){
		$texto.='<tr>';
		$texto.='<td style="text-align:center">'.$documentos[$i]["numero"].'</td>';
		$texto.='<td style="text-align:center;">'.$documentos[$i]["fecha"].'</td>';
		$texto.='<td style="text-align:left;width:10%">'.usuario_aprobador_tramitados($documentos[$i]["iddocumento"]).'</td>';
		$texto.='<td style="text-align:left;">'.($documentos[$i]["descripcion"]).'</td>';
		$texto.='<td style="text-align:left;">'.destino_remitente($documentos[$i]["iddocumento"],$documentos[$i]["plantilla"]).'</td>';
		$texto.='<td style="text-align:left;">'.direccion_destino_remitente($documentos[$i]["iddocumento"]).'</td>';
		$texto.='<td style="text-align:center;">'.telefono_destino_remitente($documentos[$i]["iddocumento"]).'</td>';
		$texto.='<td style="text-align:center;">'.ciudad_destino_remitente($documentos[$i]["iddocumento"]).'</td>';
		/*if($documentos[$i]["plantilla"]=='RADICACION_SALIDA'){
			$texto.='<td style="text-align:center;">'.ucwords(mostrar_campo_salida($documentos[$i]["iddocumento"],'accion_mensajeria')).'</td>';
			$texto.='<td style="text-align:center;">'.ucwords(mostrar_campo_salida($documentos[$i]["iddocumento"],'centro_mensajeria')).'</td>';
			$texto.='<td style="text-align:center;">'.ucwords(mostrar_campo_salida($documentos[$i]["iddocumento"],'departamento_mensaje')).'</td>';
			$texto.='<td style="text-align:center;">'.ucwords(mostrar_campo_salida($documentos[$i]["iddocumento"],'linea_mensajeria')).'</td>';
			$texto.='<td style="text-align:center;">'.ucwords(mostrar_campo_salida($documentos[$i]["iddocumento"],'origen_mensajeria')).'</td>';
			$texto.='<td style="text-align:center;">'.ucwords(mostrar_campo_salida($documentos[$i]["iddocumento"],'proyecto_mensajeria')).'</td>';
		}
		else{
			$texto.='<td style="text-align:center;">&nbsp;</td>';
			$texto.='<td style="text-align:center;">&nbsp;</td>';
			$texto.='<td style="text-align:center;">&nbsp;</td>';
			$texto.='<td style="text-align:center;">&nbsp;</td>';
			$texto.='<td style="text-align:center;">&nbsp;</td>';
			$texto.='<td style="text-align:center;">&nbsp;</td>';
		}*/
		$texto.='<td style="text-align:center;">&nbsp;</td>';
		$texto.='</tr>';
	}
	$texto.='</table>';
	return($texto);
}
?>