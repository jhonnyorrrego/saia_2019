<?php include_once("../carta/funciones.php"); ?><?php include_once("funciones.php"); ?><?php include_once("../librerias/funciones_generales.php"); ?><script type="text/javascript" src="../../js/jquery.js"></script><?php include_once("../librerias/header_nuevo.php"); ?><?php include_once("../../class_transferencia.php"); ?><tr><td><p>&nbsp;<?php mostrar_ft_gestion_calid_funcion(390,$_REQUEST['iddoc']);?></p>
<table style="width: 100%;" border="1">
<tbody>
<tr>
<td class="encabezado_list" style="text-align: center;" valign="top"><strong>Datos Plan de mejoramiento</strong></td>
</tr>
<tr>
<td style="text-align: center;"><?php detalles_padre(390,$_REQUEST['iddoc']);?><br /><?php editar_hallazgo(390,$_REQUEST['iddoc']);?></td>
</tr>
</tbody>
</table>
<table style="width: 100%;" border="1">
<tbody>
<tr>
<td class="encabezado" valign="top">Radicado del plan vinculado</td>
<td colspan="2">&nbsp;<?php mostrar_valor_campo('radicado_plan',390,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td class="encabezado" style="text-align: left; border: windowtext 0.5pt solid;" valign="top">Clase de Observaci&oacute;n</td>
<td class="celda_transparente" colspan="2">&nbsp;<?php mostrar_valor_campo('clase_observacion',390,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td class="encabezado" valign="top">Deficiencia</td>
<td class="celda_transparente" colspan="2">&nbsp;<?php mostrar_valor_campo('deficiencia',390,$_REQUEST['iddoc']);?><?php mostrar_correcion(390,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td class="encabezado" valign="top">Causas</td>
<td class="celda_transparente" colspan="2">&nbsp;<?php mostrar_valor_campo('causas',390,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td class="encabezado" valign="top">secretarias Vinculadas</td>
<td class="celda_transparente" colspan="2">&nbsp;<?php mostrar_valor_campo('secretarias',390,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td class="encabezado" valign="top">Procesos Involucrados</td>
<td class="celda_transparente" colspan="2">&nbsp;<?php procesos_vinculados_funcion(390,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td class="encabezado" valign="top">Acci&oacute;n de Mejoramiento</td>
<td class="celda_transparente" colspan="2">&nbsp;<?php mostrar_valor_campo('accion_mejoramiento',390,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td class="encabezado" valign="top">Responsables de Mejoramiento</td>
<td class="celda_transparente" colspan="2">
<p>&nbsp;<?php modificar_responsable_mejoramiento(390,$_REQUEST['iddoc']);?>&nbsp;</p>
<p><?php mostrar_valor_campo('responsables',390,$_REQUEST['iddoc']);?></p>
</td>
</tr>
<tr>
<td class="encabezado" valign="top">Tiempo Programado Para Cumplimiento</td>
<td class="celda_transparente" colspan="2">&nbsp;<?php mostrar_valor_campo('tiempo_cumplimiento',390,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td class="encabezado" valign="top">Mecanismo de Seguimiento Interno</td>
<td class="celda_transparente" colspan="2">&nbsp;<?php mostrar_valor_campo('mecanismo_interno',390,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td class="encabezado" valign="top">Tiempo Programado Para Seguimiento</td>
<td class="celda_transparente" colspan="2">&nbsp;<?php mostrar_valor_campo('tiempo_seguimiento',390,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td class="encabezado" valign="top">Responsable del Seguimiento</td>
<td class="celda_transparente">
<p>&nbsp;<?php modificar_responsable_seguimiento(390,$_REQUEST['iddoc']);?>&nbsp;</p>
<p><?php mostrar_valor_campo('responsable_seguimiento',390,$_REQUEST['iddoc']);?></p>
</td>
</tr>
<tr>
<td class="encabezado" valign="top">Indicador de Acci&oacute;n de Cumplimiento</td>
<td class="celda_transparente" colspan="2">&nbsp;<?php mostrar_valor_campo('indicador_cumplimiento',390,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td class="encabezado" valign="top">Observaciones</td>
<td class="celda_transparente" colspan="2">&nbsp;<?php mostrar_valor_campo('observaciones',390,$_REQUEST['iddoc']);?></td>
</tr>
</tbody>
</table>
<p>&nbsp;</p>
<p><?php mostrar_estado_proceso(390,$_REQUEST['iddoc']);?></p>
<p><?php notificar_responsable_mejoramiento(390,$_REQUEST['iddoc']);?></p>
<p><?php notificar_responsable_cumplimiento(390,$_REQUEST['iddoc']);?></p></td></tr><?php include_once("../librerias/footer_nuevo.php"); ?>