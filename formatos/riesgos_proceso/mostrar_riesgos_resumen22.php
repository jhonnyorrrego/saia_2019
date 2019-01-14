<?php
@set_time_limit(0);
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

include_once($ruta_db_superior.'db.php');
include_once($ruta_db_superior."formatos/librerias/funciones_generales.php");
include_once($ruta_db_superior.'formatos/riesgos_proceso/librerias_riesgos.php');

?>
<link rel="stylesheet" type="text/css" href="<?php echo($ruta_db_superior); ?>css/estilos.css"/>
<style type="text/css">

.colar_A{
	background-color: #DAAAA6;
}

.colar_B{
	background-color: green;
}

.colar_E{
	background-color: red;
}

.colar_M{
	background-color: yellow;
}

.titulo_riesgo{
	background-color: #D2D3D5;
}

body, table thead td, table tbody td{
  font-family: Verdana; 
  font-size: 9px; 
} 

.encabezado {
	background-color:#006600; 
	color:white ; 
	padding:10px; 
	text-align: left;  
} 

.encabezado_table td{	 
	vertical-align:middle;
	text-align: center;	 
	font-size: 8px !important;
}

table thead td {
	font-weight:bold;
	cursor:pointer;
	background-color:#006600;
	text-align: center;
	text-transform:Uppercase;
	vertical-align:middle;    
}
</style>
<?php
$datos=explode("-",$_REQUEST["llave"]);
$riesgos=busca_filtro_tabla("","ft_riesgos_proceso","ft_proceso=".$datos[2]." and estado<>'INACTIVO' and tipo_riesgo<>'Corrupcion'","consecutivo",$conn);
$proceso=busca_filtro_tabla("","ft_proceso a","a.idft_proceso=".$datos[2],"",$conn);	
  	
		if($_REQUEST["tipo"] != 5){
			$url = "http://".RUTA_PDF_LOCAL."/formatos/riesgos_proceso/mostrar_riesgos_resumen2.php?llave=".$_REQUEST["llave"]."|tipo=5";
			$url_encabezado = "http://".RUTA_PDF_LOCAL."/reportes/encabezado_reporte.php";
			$ruta = $ruta_db_superior."class_impresion2.php?tipo=5&orientacion=1&url=".$url."&pdf=1&url_encabezado=";
			$tabla = '
  					     <a target="_blank" href="'.$ruta.'">
  						    <img src="'.$ruta_db_superior.'enlaces/imprimir.gif" height="30" width="30" border="0">
  					     </a>
  				     ';
			/*$tabla = '
  					     <a target="_blank" href="'.$ruta_db_superior.'html2ps/public_html/demo/html2ps.php?URL=formatos/riesgos_proceso/mostrar_riesgos_resumen2.php?llave='.$_REQUEST["llave"].'&imprimir_pdf=3&orientacion=1&papel=Legal&font_size=6&filename=mapa_riesgos">
  						    <img src="'.$ruta_db_superior.'enlaces/imprimir.gif" height="30" width="30" border="0">
  					     </a>
  				     ';*/
		}
  	
  	$tabla .= '<table border="1px" style="border-collapse:collapse; width:100%;">';
		if(!@$_REQUEST["tipo"])$tabla.='<thead class="encabezado_table">';
									$tabla.='
									<tr>									
										<td class="riesgo_encabezado titulo_riesgo" colspan="12">MAPA DE RIESGOS DEL PROCESO</td>
									</tr>
									<tr>
										<td class="riesgo_encabezado titulo_riesgo" colspan="12">MAPA DE RIESGOS</td>
									</tr>
									<tr>
										<td colspan="12" class="riesgo_encabezado titulo_riesgo" text-align:left">PROCESO: '.$proceso[0]["nombre"].'</td>
									</tr>
									<tr>
										<td colspan="12" class="riesgo_encabezado titulo_riesgo" text-align:left;">
											OBJETIVO: '.preg_replace("/(<p.*>)(.*)(<\/p>)/","$2", $proceso[0]["objetivo"]).'
										</td>
									</tr>
									<tr height="80px">
										<td class="titulo_riesgo" rowspan="2"><p>RIESGO</p></td>
                    <td class="titulo_riesgo" colspan="2"><p>CALIFICACI&Oacute;N</p></td>
                    <td class="titulo_riesgo" rowspan="2"><p>EVALUACION RIESGO</p></td>
                    <td class="titulo_riesgo" rowspan="2"><p>CONTROLES</p></td>
                    <td class="titulo_riesgo" colspan="2"><p>NUEVA<br>CALIFICACION</p></td>
                    <td class="titulo_riesgo" rowspan="2"><p>NUEVA EVALUACION</p></td>
                    <td class="titulo_riesgo" rowspan="2"><p>OPCIONES<br>MANEJO</p></td>
                    <td class="titulo_riesgo" rowspan="2"><p>ACCIONES</p></td>
                    <td class="titulo_riesgo" rowspan="2"><p>RESPONSABLE DE LA ACCI&Oacute;N</p></td>
                    <td class="titulo_riesgo" rowspan="2"><p>INDICADOR</p></td>											
									</tr>
									<tr height="80px">
										<td class="titulo_riesgo"><p>Probabilidad</p></td>
                    <td class="titulo_riesgo"><p>Impacto</p></td>
                    <td class="titulo_riesgo"><p>Probabilidad</p></td>
                    <td class="titulo_riesgo"><p>Impacto</p></td>
									</tr>';
								if(!@$_REQUEST["tipo"])$tabla.='</thead>';
								$tabla.='<tbody>
								';
								for ($i=0;$i<$riesgos["numcampos"]; $i++){
									if($riesgos[$i]["consecutivo"] == 1){
									}
									$tabla .='
										<tr>
											<td>'.$riesgos[$i]["consecutivo"].' - '.preg_replace("/(<p\b[^>]*>)(.*?)(<\/p>)/","$2",codifica_encabezado(html_entity_decode($riesgos[$i]["riesgo"]))).'</td>
											<td style="text-align: center;">'.probabilidad($riesgos[$i]["probabilidad"]).'</td>';
											$tabla.='<td style="text-align: center;">'.impacto($riesgos[$i]["impacto"])."</td>";
											if($riesgos[$i]["tipo_riesgo"]=="Corrupcion"){
												//$tabla.="No Aplica Metodologia para valorar el impacto, porque es un Riesgo de Corrupcion";
												$tabla.='<td style="text-align: center;">No Aplica</td>';
											}else{
												$tabla .=''.obtener_evaluacion_riesgo($riesgos[$i]["idft_riesgos_proceso"], $riesgos[$i]["probabilidad"], $riesgos[$i]["impacto"]).'';
											}
											$tabla.='<td>'.obtener_controles_riesgo($riesgos[$i]["idft_riesgos_proceso"]).'</td>
											<td style="text-align:center;">'.obtener_nueva_probabilidad($riesgos[$i]["idft_riesgos_proceso"], $riesgos[$i]["probabilidad"]).'</td>';
											
											$tabla .='<td style="text-align:center;">'.obtener_nuevo_impacto($riesgos[$i]["idft_riesgos_proceso"], $riesgos[$i]["impacto"]).'</td>';
											if($riesgos[$i]["tipo_riesgo"]=="Corrupcion"){
												//$tabla.="No Aplica Metodologia para valorar el impacto, porque es un Riesgo de Corrupcion";
												$tabla.='<td style="text-align: center;">No Aplica</td>';
											}else{
												$tabla .=obtener_nueva_evaluacion_riesgo($riesgos[$i]["idft_riesgos_proceso"], $riesgos[$i]["probabilidad"], $riesgos[$i]["impacto"]).'</td>';
											}															
											$tabla .='<td>'.obtener_acciones_riesgo($riesgos[$i]["idft_riesgos_proceso"]).'</td>
											<td>'.obtener_responsables_accion_riesgo($riesgos[$i]["idft_riesgos_proceso"]).'</td>
											<td>'.obtener_indicador_accion_riesgo($riesgos[$i]["idft_riesgos_proceso"]).'</td>
										</tr>';
								}
								
$tabla .= '			</tbody>
							</table>';
							
echo($tabla);											


function obtener_evaluacion_riesgo($idft_riesgos_proceso, $probabilidad, $impacto){
	global $conn;
	
	$evaluacion=tabla_evaluacion($probabilidad,$impacto);
	$color_celda=color_evaluacion($evaluacion);
	$valoraciones=valoraciones($idft_riesgos_proceso);				
	
	$td = '<td style="text-align:center;" class="'.$color_celda.'">'.texto_evaluacion($evaluacion).'</td>';
	
	return($td);	
}

function obtener_controles_riesgo($idft_riesgos_proceso){
	global $conn;
	
	$controles_riesgo = busca_filtro_tabla("descripcion_control, idft_control_riesgos","ft_control_riesgos a, documento b","a.documento_iddocumento=b.iddocumento and b.estado not in('ELIMINADO', 'ANULADO') and ft_riesgos_proceso=".$idft_riesgos_proceso,"idft_control_riesgos asc",$conn);
		
	for($i=0; $i < $controles_riesgo["numcampos"]; $i++){
		$li .= '<li>'.preg_replace("/(<p.*>)(.*)(<\/p>)/","$2",strip_tags(codifica_encabezado(html_entity_decode($controles_riesgo[$i]["descripcion_control"])))).'</li><br />';
	}

	if($li){
		return('<ol>'.$li.'</ol>');
	}
}

function obtener_nueva_probabilidad($idft_riesgos_proceso, $probabilidad){
	global $conn;
	
	$valoraciones=valoraciones($idft_riesgos_proceso);	
	$probabilidad_auto=nuevo_punto_matriz($probabilidad,$valoraciones[0]);
	
	$probabilidad = probabilidad($probabilidad_auto);
	
	return($probabilidad);
}

function obtener_nuevo_impacto($idft_riesgos_proceso, $impacto){
	global $conn;
		
	$valoraciones=valoraciones($idft_riesgos_proceso);					
	$impacto_auto=nuevo_punto_matriz($impacto,$valoraciones[1]);			
				
	$impacto = 	impacto($impacto_auto);		
	
	return($impacto);
}

function obtener_nueva_evaluacion_riesgo($idft_riesgos_proceso, $probabilidad, $impacto){
	global $conn;	
	//echo "<br/>".$probabilidad;
	$probabilidad_auto = obtener_probabilidad_riesgo($idft_riesgos_proceso, $probabilidad);
	$impacto_auto      = obtener_impacto_riesgo($idft_riesgos_proceso, $impacto);									
	//echo $probabilidad_auto;
	$evaluacion=tabla_evaluacion($probabilidad_auto,$impacto_auto);
	//echo $evaluacion;
	$color_celda=color_evaluacion($evaluacion);
	
	$td = '<td style="text-align:center;" class="'.$color_celda.'">'.texto_evaluacion($evaluacion).'</td>';
	$td .= '<td style="text-align:center;">'.texto_evaluacion($evaluacion,2).'</td>';
	
	return($td);	
}

function obtener_acciones_riesgo($idft_riesgos_proceso){
	global $conn;
	
	$control_riesgos = busca_filtro_tabla("descripcion_control, idft_control_riesgos","ft_control_riesgos a, documento b","a.documento_iddocumento=b.iddocumento and b.estado not in('ELIMINADO', 'ANULADO') and ft_riesgos_proceso=".$idft_riesgos_proceso,"",$conn);
	
	for ($i=0; $i < $control_riesgos["numcampos"]; $i++) { 
		$acciones .= acciones($control_riesgos[$i]["idft_control_riesgos"],"acciones_accion");
	}	
	
	return($acciones);
}

function obtener_responsables_accion_riesgo($idft_riesgos_proceso){
	global $conn;
	
	$control_riesgos = busca_filtro_tabla("descripcion_control, idft_control_riesgos","ft_control_riesgos a, documento b","a.documento_iddocumento=b.iddocumento and b.estado not in('ELIMINADO', 'ANULADO') and ft_riesgos_proceso=".$idft_riesgos_proceso,"",$conn);
	
	for ($i=0; $i < $control_riesgos["numcampos"]; $i++) { 
		$acciones .= acciones($control_riesgos[$i]["idft_control_riesgos"],"reponsables");
	}	
	
	return($acciones);
}

function obtener_indicador_accion_riesgo($idft_riesgos_proceso){
	global $conn;
	
	$control_riesgos = busca_filtro_tabla("descripcion_control, idft_control_riesgos","ft_control_riesgos a, documento b","a.documento_iddocumento=b.iddocumento and b.estado not in('ELIMINADO', 'ANULADO') and ft_riesgos_proceso=".$idft_riesgos_proceso,"",$conn);
	
	for ($i=0; $i < $control_riesgos["numcampos"]; $i++) { 
		$acciones .= acciones($control_riesgos[$i]["idft_control_riesgos"],"indicador");
	}	
	
	return($acciones);
}

function acciones($id,$campo){
	global $conn;
	
	$acciones=busca_filtro_tabla($campo.", iddocumento","ft_ft_acciones_riesgo a, documento b","a.documento_iddocumento=b.iddocumento and b.estado not in('ELIMINADO', 'ANULADO') and acciones_control='".$id."'","",$conn);
	
	$texto='';
	for($i=0;$i<$acciones["numcampos"];$i++){
		if($campo!='reponsables'){
			$texto.=codifica_encabezado(html_entity_decode($acciones[$i][$campo]));
		}
		else{
			$texto.=mostrar_valor_campo($campo,174,$acciones[$i]["iddocumento"],1);
		}		
	}
	return $texto;
}
?>
