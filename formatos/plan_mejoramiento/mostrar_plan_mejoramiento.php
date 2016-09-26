<?php include_once("../carta/funciones.php"); ?><?php include_once("../librerias/funciones_generales.php"); ?><script type="text/javascript" src="../../js/jquery.js"></script><?php include_once("../librerias/header_nuevo.php"); ?><?php include_once("../../class_transferencia.php"); ?><tr><td><p>&nbsp;</p>
<table style="border-collapse: collapse; font-size: 10pt; width: 100%;" border="1" cellspacing="0">
<tbody>
<tr>
<td class="encabezado" style="text-align: center;" colspan="4"><strong>PLAN DE MEJORAMIENTO&nbsp; <?php mostrar_valor_campo('tipo_plan',428,$_REQUEST['iddoc']);?></strong></td>
</tr>
<tr>
<td class="encabezado" style="text-align: left;" colspan="4">No. <?php formato_numero(428,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td class="encabezado">Fecha de Suscripci&oacute;n:</td>
<td align="left"><?php mostrar_valor_campo('fecha_suscripcion',428,$_REQUEST['iddoc']);?></td>
<td class="encabezado">Tipo de Auditor&iacute;a:</td>
<td><?php mostrar_valor_campo('tipo_auditoria',428,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td class="encabezado">Objetivo General:</td>
<td><?php mostrar_valor_campo('objetivo',428,$_REQUEST['iddoc']);?></td>
<td class="encabezado">Descripci&oacute;n:</td>
<td><?php mostrar_valor_campo('descripcion_plan',428,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td class="encabezado">Objetivos Espec&iacute;ficos:</td>
<td><?php mostrar_valor_campo('objetivos_especificos',428,$_REQUEST['iddoc']);?></td>
<td class="encabezado">Fecha Recepci&oacute;n Informe Final:</td>
<td align="left"><?php mostrar_valor_campo('fecha_informe',428,$_REQUEST['iddoc']);?> <?php mostrar_adjuntos(428,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td class="encabezado" valign="top">Observaciones:</td>
<td><?php mostrar_valor_campo('observaciones',428,$_REQUEST['iddoc']);?></td>
<td class="encabezado">Per&iacute;odo Evaluado:</td>
<td align="left"><?php mostrar_valor_campo('periodo_evaluado',428,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td class="encabezado">Auditor</td>
<td><?php mostrar_valor_campo('auditor',428,$_REQUEST['iddoc']);?></td>
<td class="encabezado">Descripci&oacute;n Auditor Otros/Autoevaluaci&oacute;n/Retroalimentaci&oacute;n cliente</td>
<td align="left"><?php mostrar_valor_campo('descripcion_otros',428,$_REQUEST['iddoc']);?></td>
</tr>
</tbody>
</table>
<p><?php mostrar_link_reporte(428,$_REQUEST['iddoc']);?></p>
<p><?php estado_del_plan(428,$_REQUEST['iddoc']);?></p>
<p><?php listar_hallazgo_plan_mejoramiento(428,$_REQUEST['iddoc']);?></p>
<table style="font-size: 6pt; width: 100%;" border="1" cellspacing="0">
<tbody>
<tr>
<td class="encabezado">Elaborado por:</td>
<td><?php elaborado_por(428,$_REQUEST['iddoc']);?></td>
<td class="encabezado">Revisado Por:</td>
<td><?php revisado_por(428,$_REQUEST['iddoc']);?></td>
<td class="encabezado">Aprobado Por:</td>
<td><?php aprobado_por(428,$_REQUEST['iddoc']);?></td>
</tr>
</tbody>
</table>
<p><span style="font-size: x-small;"><span style="font-size: small;"><?php ver_campo_estado(428,$_REQUEST['iddoc']);?></span><br /></span></p></td></tr><?php include_once("../librerias/footer_nuevo.php"); ?>