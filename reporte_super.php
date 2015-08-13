<?php
if(@$_REQUEST["exportar"]==1){

header('Content-Type: application/vnd.ms-excel');
header("Content-Disposition: attachment; filename=reporte_super.xls");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
}

include_once("db.php");
include_once("formatos/librerias/estilo_formulario.php");
global $conn;
$tabla='';
$tabla = '
<style>
</style>';
$tabla .= '<table style="border-collapse: collapse; border-width: 1px" border=1>';
$tabla .= '	<tr class="encabezado_list">
			<td>Numero</td>
			<td>Fecha</td>
			<td>Descripcion</td>
			<td>Remitente</td>
			<td>Empresa</td>
			</tr>';
			
	$sql=busca_filtro_tabla("a.numero as numero, to_char(a.fecha,'YYYY-MM-DD') as fecha, a.descripcion as descripcion, b.nombre as remitente, c.empresa as empresa","documento a, ejecutor b, datos_ejecutor c","a.tipo_radicado=1 and a.fecha >= to_date('2012-01-01','YYYY-MM-DD') and a.ejecutor=c.iddatos_ejecutor and b.idejecutor=c.ejecutor_idejecutor and a.estado<>'ELIMINADO' and (c.empresa='superintendencia de servicios publicos domiciliarios' or c.empresa='superintendencia de servicio publicos domiciliarios' or c.empresa='superintendencia de serivicios publicos dimiciliarios' or c.empresa='SUPERINTENDENCIA DE SERVICIOS PUBLICOS DOMICILIARIOS' or c.empresa='superintendencia de sociedades' or c.empresa='SUPERINTENDENCIA DE SOCIEDADES' or c.empresa='superintendencia de servicios p&uacute;blicos domiciliarios' or c.empresa='superintendenicia de servicio p&uacute;blicos domiciliarios' or c.empresa='superintendencia de serivicios p&uacute;blicos domiciliarios' or b.nombre='superintendencia de servicios publicos domiciliarios' or b.nombre='superintendencia de servicio publicos domiciliarios' or b.nombre='superintendencia de serivicios publicos dimiciliarios' or b.nombre='SUPERINTENDENCIA DE SERVICIOS PUBLICOS DOMICILIARIOS' or b.nombre='superintendencia de sociedades' or b.nombre='SUPERINTENDENCIA DE SOCIEDADES' or b.nombre='superintendencia de servicios p&uacute;blicos domiciliarios' or b.nombre='superintendenicia de servicio p&uacute;blicos domiciliarios' or b.nombre='superintendencia de serivicios p&uacute;blicos domiciliarios')","a.fecha",$conn);	
	
	for($i=0;$i<=$sql["numcampos"];$i++){
		$clase = '';
		$tabla.= '<tr>';
		$tabla.= '<td>';
		$tabla.= @$sql[$i]["numero"];
		$tabla.= '</td>';
		
		$tabla.= '<td>';
		$tabla.= @$sql[$i]["fecha"];
		$tabla.= '</td>';
		
		$tabla.= '<td>';
		$tabla.= @$sql[$i]["descripcion"];
		$tabla.= '</td>';
		
		$tabla.= '<td>';
		$tabla.= @$sql[$i]["remitente"];
		$tabla.= '</td>';
		
		$tabla.= '<td>';
		$tabla.= @$sql[$i]["empresa"];
		$tabla.= '</td>';
	}
echo $tabla;
?>
<div align="top">
<table align="top">
<tbody>
<tr>
<td>
<a href="reporte_super.php?exportar=1" style="cursor:pointer;">
<img border="0" alt="Exportar a Excel" src="enlaces/excel.gif" align="top">
</a>
</td>
</tr>
</tbody>
</table>
</div>