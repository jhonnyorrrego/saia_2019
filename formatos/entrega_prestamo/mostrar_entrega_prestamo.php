<?php include_once("../../librerias_saia.php"); ?><?php echo(librerias_jquery('1.7')); ?><?php include_once("../librerias/funciones_generales.php"); ?><?php include_once("../../class_transferencia.php"); ?><?php include_once("../carta/funciones.php"); ?><?php include_once("funciones.php"); ?><?php include_once("../librerias/header_nuevo.php"); ?><tr><td><table style="width: 100%; border-collapse: collapse; font-size: 14px;" border="0" align="center">
<tbody>
<tr>
<td style="text-align: left;">Fecha de Pr&eacute;stamo: <?php mostrar_valor_campo('fecha_entrega',413,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
<tr>
<td style="text-align: left;" colspan="2">Se realiza entrega al solicitante: <?php solicitante_funcion(413,$_REQUEST['iddoc']);?><strong><br /></strong></td>
</tr>
<tr>
<td style="text-align: left;"><?php mostrar_responsable_solicitud(413,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td>&nbsp;</td>
</tr>
</tbody>
</table>
<table style="width: 100%; border-collapse: collapse; font-size: 14px;" border="1" align="center">
<tbody>
<tr>
<td class="encabezado_list" style="text-align: left; width: 30%;"><strong>Nombre de Expediente</strong></td>
<td style="text-align: left; width: 70%;"><?php nombre_expediente(413,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td class="encabezado_list" style="text-align: left; width: 30%;"><strong>N&uacute;mero de Expediente</strong></td>
<td style="text-align: left; width: 70%;"><?php numero_expediente(413,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td class="encabezado_list" style="text-align: left;"><strong><span>N&uacute;mero de caja</span></strong></td>
<td style="text-align: left;"><?php no_caja(413,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td class="encabezado_list" style="text-align: left; width: 30%;"><strong>N&uacute;mero de Folios</strong></td>
<td style="text-align: left; width: 70%;"><?php numero_folios(413,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td class="encabezado_list" style="text-align: left;"><strong>Observaciones</strong></td>
<td style="text-align: left;"><?php mostrar_valor_campo('observaciones',413,$_REQUEST['iddoc']);?></td>
</tr>
</tbody>
</table>
<table style="width: 100%; border-collapse: collapse; font-size: 14px;" border="0" align="center">
<tbody>
<tr>
<td colspan="2">&nbsp;<br />&nbsp;</td>
</tr>
<tr>
<td style="text-align: left;" colspan="2"><?php devolucion_docu(413,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td colspan="2"><br /><br /><?php mostrar_estado_proceso(413,$_REQUEST['iddoc']);?><strong></strong></td>
</tr>
</tbody>
</table></td></tr><?php include_once("../librerias/footer_nuevo.php"); ?>