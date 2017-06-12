<?php
if(@$_REQUEST["excel"]){
	header('Content-Type: application/vnd.ms-excel');
	header("Content-Disposition: attachment; filename=Mapa de riesgos de corrupcion institucional.xls");
	header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
}
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
set_time_limit(0);

include_once($ruta_db_superior."db.php");
include_once($ruta_db_superior."librerias_saia.php");
include_once($ruta_db_superior."formatos/librerias/funciones_generales.php");
include_once($ruta_db_superior."formatos/mod_autocomisorio/funciones.php");
include_once($ruta_db_superior."formatos/librerias/estilo_formulario.php");
echo(estilo_bootstrap());
?>
<style type="text/css">	
	.label.label-success{
		background-color: #FFFFFF !important; 
		color: #000000 !important;
		font-size: 10px !important;
		font-weight: normal !important;
		white-space: normal !important;
	}
</style>
<?php
if(isset($_REQUEST['idft_proceso'])){
	$riesgos=obtener_riesgos_proceso($_REQUEST['idft_proceso']);
}else{
$riesgos=obtener_riesgos_proceso($proceso[0]['idft_proceso']);
}

if(@$_REQUEST["tipo"] != 5 && !@$proceso[0]['idft_proceso'] && !@$_REQUEST["excel"]){
	$url="mostrar_riesgos_tipo_corrupcion.php?excel=1";
	$tabla = '
   <a target="_blank" href="'.$url.'">
    <img src="'.$ruta_db_superior.'enlaces/imprimir.gif" height="30" width="30" border="0">
   </a>';
}
$idformato_riesgos_proceso=busca_filtro_tabla("idformato","formato","nombre='riesgos_proceso'","",$conn);
$idformato_control_riesgos=busca_filtro_tabla("idformato","formato","nombre='control_riesgos'","",$conn);
$idformato_acciones_riesgo=busca_filtro_tabla("idformato","formato","nombre='acciones_riesgo'","",$conn);

$tabla .='
			<table style="border-collapse: collapse; width:150%; max-width:150%" border="1" cellspacing="15">				
				<tr style="text-align: center;">
					<td colspan="4">IDENTIFICACI&Oacute;N</td>
					<td>AN&Aacute;LISIS</td>
					<td colspan="4" style="width: 200%;">MEDIDAS DE MITIGACI&Oacute;N</td>
					<td></td>
					<td colspan="2">SEGUIMIENTO</td>
				</tr>
				<tr style="text-align: center;">
					<td rowspan="3">PROCESO</td>
					<!--td rowspan="3">OBJETIVO</td-->
					<td rowspan="3">CAUSAS</td>
					<td colspan="2">RIESGO</td>
					<td rowspan="3">PROBABILIDAD DE<br />MATERIALIZACI&Oacute;N</td>
					<td colspan="3">VALORACI&Oacute;N DEL RIESGO</td>
					<td rowspan="3">ADMINISTRACI&Oacute;N DEL <br /> RIESGO</td>
					<td rowspan="3">ACCIONES</td>
					<td rowspan="3">RESPONSABLES</td>
					<td rowspan="3">INDICADOR</td>
				</tr>
				<tr style="text-align: center;">
					<td rowspan="2">No.</td>
					<td rowspan="2">DESCRIPCI&Oacute;N</td>
					<td>CONTROLES</td>
					<td>CRITERIOS</td>
					<td>CUMPLIMIENTO</td>
				</tr>
				<tr style="text-align: center;">
					<td  style="width: 55%;">Descripci&oacute;n</td>					
					<td style="width: 150%;" colspan="2">Criterio de Medici&oacute;n<br/>(Si / No)</td>
				</tr>';
				if($riesgos['numcampos']){
					for($i=0;$i<$riesgos['numcampos'];$i++){						
						$valoracion=obtener_valoracion_riesgo($riesgos[$i]['idft_riesgos_proceso']);
						$acciones=obtener_acciones_riesgo($riesgos[$i]['idft_riesgos_proceso']);
						$seguimiento=obtener_seguimiento_riesgo($riesgos[$i]['idft_riesgos_proceso']);
						
						for($j=0;$j<$acciones['numcampos'];$j++){
							$responsables=obtener_nombre_responsables($acciones[$j]['reponsables']);
						}				
						
				$tabla .='<tr style="text-align: center;">
							<td>'.$riesgos[$i]['nombre_proceso'].'</td>
							<td>'.strip_tags(codifica_encabezado(html_entity_decode($riesgos[$i]['fuente_causa']))).'</td>
							<td>'.$riesgos[$i]['consecutivo'].'</td>
							<td>'.codifica_encabezado(html_entity_decode($riesgos[$i]['riesgo'])).'</td>
							<td>'.mostrar_valor_campo('probabilidad',$idformato_riesgos_proceso[0]['idformato'],$riesgos[$i]['documento_iddocumento'],1).'</td>
							<td style="text-align:left;">';
							for($j=0;$j<$valoracion['numcampos'];$j++){
								$tabla .= ''.strip_tags(html_entity_decode($valoracion[$j]['descripcion_control'])).'';
							}
							$tabla.='</td>
							<td style="text-align:left;" colspan="2">';
							for($j=0;$j<$valoracion['numcampos'];$j++){
								$tabla.='<b>1. Posee una herramienta para ejercer el control?</b>: '.mostrar_valor_campo('herramienta_ejercer',$idformato_control_riesgos[0]['idformato'],$valoracion[$j]['documento_iddocumento'],1).' 
								<b>2. Existen manuales, instructivos o procedimientos para el manejo de la herramienta?</b>: '.mostrar_valor_campo('procedimiento_herramienta',$idformato_control_riesgos[0]['idformato'],$valoracion[$j]['documento_iddocumento'],1).' 
								<b>3. En el tiempo que lleva la herramienta, ha demostrado ser efectiva?</b>: '.mostrar_valor_campo('herramienta_efectiva',$idformato_control_riesgos[0]['idformato'],$valoracion[$j]['documento_iddocumento'],1);
							}
							$tabla.='</td>
							<td style="text-align:left;">';
							for($j=0;$j<$acciones['numcampos'];$j++){
								if($acciones[$j]['opcio_admin_riesgo']!=""){
									$tabla.=mostrar_valor_campo('opcio_admin_riesgo',$idformato_acciones_riesgo[0]['idformato'],$acciones[$j]['documento_iddocumento'],1);
									//$tabla.=$acciones[$j]['opcio_admin_riesgo'];
								}
							}
							$tabla.='</td>
							<td style="text-align:left;">';
							for($j=0;$j<$acciones['numcampos'];$j++){
								if($acciones[$j]['acciones_accion']!=""){
									$tabla.=strip_tags(codifica_encabezado(html_entity_decode($acciones[$j]['acciones_accion'])));
								}
							}
							$tabla.='</td>
							<td style="text-align:left;">';
							for($j=0;$j<$acciones['numcampos'];$j++){
								if($acciones[$j]['reponsables']!=""){
									$tabla.=strip_tags(codifica_encabezado(html_entity_decode($responsables)));
								}								
							}
							$tabla.='</td>
							<td style="text-align:left;">';
							for($j=0;$j<$acciones['numcampos'];$j++){
								if($acciones[$j]['indicador']!=""){
									$tabla.=strip_tags(codifica_encabezado(html_entity_decode($acciones[$j]['indicador'])));
								}
								
							}
							$tabla.='
							</td>
						</tr>';						
					}
				}
$tabla .='</table>';

if($riesgos["numcampos"]){
  echo($tabla);
}


function obtener_riesgos_proceso($idft_proceso){
	global $conn;		
	if($idft_proceso){
		$datos = busca_filtro_tabla("A.nombre as nombre_proceso, A.*, B.*","ft_proceso A, ft_riesgos_proceso B","A.idft_proceso=B.ft_proceso AND LOWER(B.tipo_riesgo) LIKE'corrupcion' AND lower(B.estado) not like'inactivo' AND A.idft_proceso=".$idft_proceso,"",$conn);
	}
	else{
		$datos = busca_filtro_tabla("A.nombre as nombre_proceso, A.*, B.*","ft_proceso A, ft_riesgos_proceso B, documento C, documento D","A.idft_proceso=B.ft_proceso AND LOWER(B.tipo_riesgo) LIKE'corrupcion' AND lower(B.estado) not like'inactivo' AND A.documento_iddocumento=C.iddocumento AND C.estado not in('ELIMINADO') AND B.documento_iddocumento=D.iddocumento AND D.estado not in('ELIMINADO')","",$conn);
	}
	return($datos);	
}

function obtener_valoracion_riesgo($idft_riesgos_proceso){
	global $conn;		
	$datos = busca_filtro_tabla("","ft_riesgos_proceso A, ft_control_riesgos B, documento C","A.idft_riesgos_proceso=B.ft_riesgos_proceso AND B.documento_iddocumento=C.iddocumento AND C.estado NOT IN ('ELIMINADO, ANULADO') AND A.idft_riesgos_proceso=".$idft_riesgos_proceso,"",$conn);
	return($datos);	
}

function obtener_acciones_riesgo($idft_riesgos_proceso){
	global $conn;		
	$datos = busca_filtro_tabla("","ft_riesgos_proceso A, ft_acciones_riesgo B, documento C","A.idft_riesgos_proceso=B.ft_riesgos_proceso AND B.documento_iddocumento=C.iddocumento AND C.estado NOT IN ('ELIMINADO, ANULADO') AND A.idft_riesgos_proceso=".$idft_riesgos_proceso,"",$conn);
	return($datos);	
}

function obtener_seguimiento_riesgo($idft_riesgos_proceso){
	global $conn;		
	$datos = busca_filtro_tabla("","ft_riesgos_proceso A, ft_seguimiento_riesgo B, documento C","A.idft_riesgos_proceso=B.ft_riesgos_proceso AND B.documento_iddocumento=C.iddocumento AND C.estado NOT IN ('ELIMINADO, ANULADO') AND A.idft_riesgos_proceso=".$idft_riesgos_proceso,"",$conn);
	return($datos);	
}

function obtener_nombre_responsables($responsables){
	global $conn;
	$nombre_funcionario="";
	$nombres=retornar_seleccionados($responsables);
	foreach($nombres as $nombre){			
		$datos = busca_filtro_tabla("A.nombres,A.apellidos","funcionario A","A.funcionario_codigo=".$nombre,"",$conn);
		$nombre_funcionario=$datos[0]['nombres']." ".$datos[0]['apellidos'];
	}
	return ($nombre_funcionario);
}
