<?php
include_once("db.php");
include_once("formatos/librerias/estilo_formulario.php");
include_once("formatos/librerias/funciones_generales.php");
$tabla = '';
$tabla = '
<style>
.celda{
	text-align:center;
}
.fila2{
	background:#F5F5F5;
}
</style>';
$tabla .= '<table style="width:100%;border-collapse:collapse" border="1px">';
$tabla .= '	<tr class="encabezado_list">
			<td>Fecha</td>
			<td>Tipo de permiso</td>
			<td>Nombre</td>
			<td>Fecha cita</td>
			<td>Hora salida</td>
			<td>Hora entrada</td>
			</tr>';
			
$permisos = busca_filtro_tabla(fecha_db_obtener('fecha_cita','Y-m-d')." as fecha_hora,a.*,b.*,c.*","ft_reporte_permisos a,documento b,funcionario c","documento_iddocumento=iddocumento AND b.estado<>'ELIMINADO' AND b.estado<>'ACTIVO' AND funcionario_codigo=ejecutor","",$conn);
$formato = busca_filtro_tabla("","formato","lower(nombre)='".strtolower($permisos[0]["plantilla"])."'","",$conn);

for($i=0;$i<$permisos["numcampos"];$i++){
	$clase = '';
	if($i % 2 == 0){
		$clase = ' class="fila2" ';
	}
	$tabla .= '<tr '.$clase.'>';
	$tabla .= '<td class="celda">';
	$tabla .= $permisos[$i]["fecha_creacion"];
	$tabla .= '</td>';
	$tabla .= '<td class="celda">';
	$tabla .=  mostrar_valor_campo('motivo_permiso',$formato[0]["idformato"],$permisos[$i]["iddocumento"],1);
	$tabla .= '</td>';
	$tabla .= '<td class="celda">';
	$tabla .=  $permisos[$i]["nombres"].' '.$permisos[$i]["apellidos"];
	$tabla .= '</td>';
	$tabla .= '<td class="celda">';
	$tabla .=  $permisos[$i]["fecha_cita"];
	$tabla .= '</td>';
	$tabla .= '<td class="celda">';
	$tabla .=  $permisos[$i]["hora_salida"];
	$tabla .= '</td>';
	$tabla .= '<td class="celda">';
	$tabla .=  $permisos[$i]["hora_entrada"];
	$tabla .= '</td>';
	$tabla .= '<td class="celda">';
	$tabla .=  restar_horas($permisos[$i]["fecha_hora"].' '.$permisos[$i]["hora_salida"],$permisos[$i]["fecha_hora"].' '.$permisos[$i]["hora_entrada"]);
	$tabla .= '</td>';
	$tabla .= '</tr>';
}
echo $tabla;
function restar_horas($fecha1,$fecha2){
	$resta = busca_filtro_tabla(resta_horas($fecha2,$fecha1)." as horas");
	//print_r($resta);
	return $resta[0]["horas"];
}
?>