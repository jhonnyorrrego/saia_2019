<?php include_once("../../librerias_saia.php"); ?>
			<?php echo(librerias_jquery('1.7')); ?><?php include_once("../librerias/funciones_generales.php"); ?>
			<?php include_once("../../class_transferencia.php"); ?>
			<?php include_once("funciones.php"); ?>
			<?php include_once("../librerias/encabezado_pie_pagina.php"); ?>
			<?php include_once("../librerias/header_nuevo.php"); ?>
			<tr><td><p>&nbsp;<?php mostrar_ft_gestion_calid_funcion(481,$_REQUEST['iddoc']);?></p>
<table style="width: 100%;" border="1">
<tbody>
<tr>
<td class="encabezado_list" style="text-align: center;" valign="top"><strong>Informaci&oacute;n Plan de mejoramiento</strong></td>
</tr>
<tr>
<td style="text-align: center;"><?php detalles_padre(481,$_REQUEST['iddoc']);?><br /><?php editar_hallazgo(481,$_REQUEST['iddoc']);?></td>
</tr>
</tbody>
</table>
<table style="width: 100%;" border="1">
<tbody>
<tr>
<td class="encabezado" valign="top">Radicado del plan vinculado</td>
<td colspan="2">&nbsp;<?php mostrar_valor_campo('radicado_plan',481,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td class="encabezado" valign="top">Clase de Observaci&oacute;n</td>
<td class="celda_transparente" colspan="2">&nbsp;<?php mostrar_valor_campo('clase_observacion',481,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td class="encabezado" valign="top">Hallazgo</td>
<td class="celda_transparente" colspan="2">&nbsp;<?php mostrar_valor_campo('deficiencia',481,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td class="encabezado" valign="top">Causas</td>
<td class="celda_transparente" colspan="2">&nbsp;<?php mostrar_valor_campo('causas',481,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td class="encabezado" valign="top">Area Responsable</td>
<td class="celda_transparente" colspan="2">&nbsp;<?php mostrar_valor_campo('secretarias',481,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td class="encabezado" valign="top">Procesos Involucrados</td>
<td class="celda_transparente" colspan="2">&nbsp;<?php procesos_vinculados_funcion(481,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td class="encabezado" valign="top">Responsables de Mejoramiento</td>
<td class="celda_transparente" colspan="2">
<p>&nbsp;<?php modificar_responsable_mejoramiento(481,$_REQUEST['iddoc']);?> <?php mostrar_valor_campo('responsables',481,$_REQUEST['iddoc']);?></p>
</td>
</tr>
<tr>
<td class="encabezado" valign="top">Tiempo Programado Para Cumplimiento</td>
<td class="celda_transparente" colspan="2">&nbsp;<?php mostrar_valor_campo('tiempo_cumplimiento',481,$_REQUEST['iddoc']);?>&nbsp;<?php mostrar_tiempo_cumplimiento(481,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td class="encabezado" valign="top">Mecanismo de Seguimiento Interno</td>
<td class="celda_transparente" colspan="2">&nbsp;<?php mostrar_valor_campo('mecanismo_interno',481,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td class="encabezado" valign="top">Tiempo Programado Para Seguimiento</td>
<td class="celda_transparente" colspan="2">&nbsp;<?php mostrar_valor_campo('tiempo_seguimiento',481,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td class="encabezado" valign="top">Responsable del Seguimiento</td>
<td class="celda_transparente">
<p>&nbsp;<?php modificar_responsable_seguimiento(481,$_REQUEST['iddoc']);?><?php mostrar_valor_campo('responsable_seguimiento',481,$_REQUEST['iddoc']);?></p>
</td>
</tr>
<tr>
<td class="encabezado" valign="top">Indicador de Acci&oacute;n de Cumplimiento</td>
<td class="celda_transparente" colspan="2">&nbsp;<?php mostrar_valor_campo('indicador_cumplimiento',481,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td class="encabezado" valign="top">Observaciones</td>
<td class="celda_transparente" colspan="2">&nbsp;<?php mostrar_valor_campo('observaciones',481,$_REQUEST['iddoc']);?></td>
</tr>
</tbody>
</table>
<p><?php adicionar_item_accion(481,$_REQUEST['iddoc']);?></p>
<p><?php mostrar_item_accion(481,$_REQUEST['iddoc']);?></p>
<p><?php mostrar_estado_proceso(481,$_REQUEST['iddoc']);?></p></td></tr><?php include_once("../librerias/footer_nuevo.php"); ?>
			