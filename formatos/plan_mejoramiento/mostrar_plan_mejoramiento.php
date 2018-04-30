<?php include_once("../../librerias_saia.php"); ?>
			<?php echo(librerias_jquery('1.7')); ?><?php include_once("../librerias/funciones_generales.php"); ?>
			<?php include_once("../../class_transferencia.php"); ?>
			<?php include_once("funciones.php"); ?>
			<?php include_once("../librerias/encabezado_pie_pagina.php"); ?>
			<?php include_once("../librerias/header_nuevo.php"); ?>
			<tr><td><table class="table table-bordered" style="border-collapse: collapse; width: 100%;" border="1" cellspacing="0">
<tbody>
<tr>
<td class="encabezado" style="text-align: center;" colspan="4"><strong>PLAN DE MEJORAMIENTO&nbsp; <?php mostrar_valor_campo('tipo_plan',480,$_REQUEST['iddoc']);?>&nbsp;<span>No. <?php formato_numero(480,$_REQUEST['iddoc']);?></span></strong></td>
</tr>
<tr>
<td class="encabezado" width="12%">Fecha de Suscripci&oacute;n:</td>
<td align="left" width="35%"><?php mostrar_valor_campo('fecha_suscripcion',480,$_REQUEST['iddoc']);?></td>
<td class="encabezado" width="15%">Tipo de Auditor&iacute;a:</td>
<td width="38%"><?php mostrar_valor_campo('tipo_auditoria',480,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td class="encabezado" width="12%">Objetivo General:</td>
<td width="35%"><?php mostrar_valor_campo('objetivo',480,$_REQUEST['iddoc']);?></td>
<td class="encabezado" width="15%">Descripci&oacute;n:</td>
<td width="38%"><?php mostrar_valor_campo('descripcion_plan',480,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td class="encabezado" width="12%">Objetivos Espec&iacute;ficos:</td>
<td width="35%"><?php mostrar_valor_campo('objetivos_especificos',480,$_REQUEST['iddoc']);?></td>
<td class="encabezado" width="15%">Fecha Recepci&oacute;n Informe Final:</td>
<td align="left" width="38%"><?php mostrar_valor_campo('fecha_informe',480,$_REQUEST['iddoc']);?> <?php mostrar_valor_campo('adjuntos',480,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td class="encabezado" valign="top" width="12%">Observaciones:</td>
<td width="35%"><?php mostrar_valor_campo('observaciones',480,$_REQUEST['iddoc']);?></td>
<td class="encabezado" width="15%">Per&iacute;odo Evaluado:</td>
<td align="left" width="38%"><?php mostrar_valor_campo('periodo_evaluado',480,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td class="encabezado" width="12%">Auditor</td>
<td width="35%"><?php mostrar_valor_campo('auditor',480,$_REQUEST['iddoc']);?></td>
<td class="encabezado" width="15%">Indicador que genera el plan</td>
<td align="left" width="38%">&nbsp;<?php ver_indicador_plan(480,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td class="encabezado" width="12%">Estado del plan</td>
<td width="35%"><?php estado_del_plan(480,$_REQUEST['iddoc']);?></td>
<td class="encabezado" width="15%">&nbsp;</td>
<td align="left" width="38%">&nbsp;</td>
</tr>
</tbody>
</table>
<p><?php mostrar_estado_proceso(480,$_REQUEST['iddoc']);?></p>
<p>&nbsp;</p>
<p><?php mostrar_link_reporte(480,$_REQUEST['iddoc']);?></p>
<p><?php listar_hallazgo_plan_mejoramiento(480,$_REQUEST['iddoc']);?></p></td></tr><?php include_once("../librerias/footer_nuevo.php"); ?>
			