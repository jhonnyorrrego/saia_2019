<?php
include_once("db.php");
include_once("formatos/librerias/estilo_formulario.php");
global $conn;

$iddoc = $_REQUEST["iddoc"];

origenes($iddoc);
destinos($iddoc);

function origenes($iddoc){
	global $conn;
	$origen = busca_filtro_tabla("","respuesta","destino=".$iddoc,"",$conn);
	$tabla .= '';
	$tabla .= '<table style="width:400px;border-collapse:collapse" border="1px">
		<tr class="encabezado_list">
		<td style="width:150px;text-align:center" colspan="3">Origenes</td>
		</tr>';
	if($origen["numcampos"] > 0){
		$tabla .= '
		
		<tr class="encabezado_list">
		<td style="width:150px">N&uacute;mero</td>
		<td style="width:150px">Descripci&oacute;n</td>
		<td style="width:100px"></td>
		</tr>';
		for($i=0;$i<$origen["numcampos"];$i++){
			$d = busca_filtro_tabla("","documento","iddocumento=".$origen[$i]["origen"]." and estado<>'ELIMINADO'","");
			$tabla .= '
			<tr>
			<td colspan="" style="text-align:center">'.$d[0]["numero"].'</td>
			<td colspan="">'.$d[0]["descripcion"].'</td>
			<td colspan="" style="text-align:center">
			<a href="ordenar.php?mostrar_formato=1&key='.$d[0]["iddocumento"].'" target="centro">Ver</a></td>
			</tr>';
		}
		$tabla .= '</table><br>';
	}
	else {
		$tabla .= '<tr><td>No se encontro origenes</tr></table><br>';
	}
	echo $tabla;
}
function destinos($iddoc){
	global $conn;
	$destino = busca_filtro_tabla("","respuesta","origen=".$iddoc,"",$conn);
	$tabla .= '';
	$tabla .= '<table style="width:400px;border-collapse:collapse" border="1px">
	<tr class="encabezado_list">
		<td style="width:150px;text-align:center" colspan="3">Destinos</td>
	</tr>';
	
	if($destino["numcampos"] > 0){
		$tabla .='	
		<tr class="encabezado_list">
		<td style="width:150px">N&uacute;mero</td>
		<td style="width:150px">Descripci&oacute;n</td>
		<td style="width:100px"></td>
		</tr>';
		for($i=0;$i<$destino["numcampos"];$i++){
			$d = busca_filtro_tabla("","documento","iddocumento=".$destino[$i]["destino"]." and estado<>'ELIMINADO'","");
			$tabla .= '
			<tr>
			<td colspan="" style="text-align:center">'.$d[0]["numero"].'</td>
			<td colspan="">'.$d[0]["descripcion"].'</td>
			<td colspan="" style="text-align:center">
			<a href="ordenar.php?mostrar_formato=1&key='.$d[0]["iddocumento"].'" target="centro">Ver</a></td>
			</tr>';
		}
		$tabla .= '</table>';
	}
	else {
		$tabla .= '<tr><td>No se encontro destinos</td></tr></table>';
	}
	echo $tabla;
}

?>