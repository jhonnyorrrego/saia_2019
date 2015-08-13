<?php include_once("../carta/funciones.php"); ?><?php include_once("funciones.php"); ?><?php include_once("../librerias/funciones_generales.php"); ?><script type="text/javascript" src="../../js/jquery.js"></script><?php include_once("../librerias/header_nuevo.php"); ?><?php include_once("../../class_transferencia.php"); ?><tr><td><table style="border-collapse: collapse; font-size: 10pt; font-family: arial,helvetica,sans-serif; width: 100%; margin-top: 20px;" border="1">
<tbody>
<tr>
<td>
<table style="border-collapse: collapse; font-size: 10pt; font-family: arial,helvetica,sans-serif; width: 100%; margin-top: 20px;" border="1">
<tbody>
<tr>
<td class="encabezado_list" style="text-align: left; width: 10%;">ACTA No.</td>
<td style="text-align: left; width: 20%;"><?php mostrar_valor_campo('numero_acta',309,$_REQUEST['iddoc']);?></td>
<td class="encabezado_list" style="text-align: left; width: 10%;">FECHA</td>
<td><?php ciudad(309,$_REQUEST['iddoc']);?>, <?php mostrar_valor_campo('fecha_reunion',309,$_REQUEST['iddoc']);?> <?php mostrar_valor_campo('hora',309,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td class="encabezado_list" style="text-align: left;">LUGAR</td>
<td colspan="3"><?php ciudad(309,$_REQUEST['iddoc']);?></td>
</tr>
</tbody>
</table>
</td>
</tr>
<tr>
<td>
<table style="border-collapse: collapse; font-size: 10pt; font-family: arial,helvetica,sans-serif; width: 100%; margin-top: 20px;" border="1">
<tbody>
<tr>
<td class="encabezado_list" colspan="2">PERSONAS CITADAS</td>
</tr>
<tr>
<td class="encabezado_list" style="text-align: left; width: 50%;">ASISTENTES</td>
<td class="encabezado_list" style="text-align: left; width: 50%;">AUSENTES</td>
</tr>
<tr>
<td><?php listado_funcionarios_funcion(309,$_REQUEST['iddoc']);?></td>
<td><?php mostrar_valor_campo('ausentes',309,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td class="encabezado_list" style="text-align: left;" colspan="2"><strong>INVITADOS</strong>&nbsp;</td>
</tr>
<tr>
<td colspan="2"><?php mostrar_valor_campo('invitados',309,$_REQUEST['iddoc']);?></td>
</tr>
</tbody>
</table>
</td>
</tr>
<tr>
<td>
<table style="border-collapse: collapse; font-size: 10pt; font-family: arial,helvetica,sans-serif; width: 100%; margin-top: 20px;" border="1">
<tbody>
<tr>
<td class="encabezado_list" style="text-align: left;">OBJETIVO DE LA REUNI&Oacute;N</td>
</tr>
<tr>
<td><?php mostrar_valor_campo('objetivo_reunion',309,$_REQUEST['iddoc']);?></td>
</tr>
</tbody>
</table>
</td>
</tr>
<tr>
<td>
<table style="border-collapse: collapse; font-size: 10pt; font-family: arial,helvetica,sans-serif; width: 100%; margin-top: 20px;" border="1">
<tbody>
<tr>
<td class="encabezado_list" style="text-align: left;">AGENDA</td>
</tr>
<tr>
<td><?php mostrar_valor_campo('ajenda_reunion',309,$_REQUEST['iddoc']);?></td>
</tr>
</tbody>
</table>
</td>
</tr>
<tr>
<td>
<table style="border-collapse: collapse; font-size: 10pt; font-family: arial,helvetica,sans-serif; width: 100%; margin-top: 20px;" border="1">
<tbody>
<tr>
<td class="encabezado_list" style="text-align: left;">DESARROLLO</td>
</tr>
<tr>
<td><?php mostrar_valor_campo('desarrollo_reunion',309,$_REQUEST['iddoc']);?></td>
</tr>
</tbody>
</table>
</td>
</tr>
<tr>
<td>
<table style="border-collapse: collapse; font-size: 10pt; font-family: arial,helvetica,sans-serif; width: 100%; margin-top: 20px;" border="1">
<tbody>
<tr>
<td class="encabezado_list" colspan="3">ACCIONES, TAREAS Y COMPROMISOS</td>
</tr>
<tr>
<td colspan="3"><?php mostrar_valor_campo('tareas',309,$_REQUEST['iddoc']);?></td>
</tr>
</tbody>
</table>
</td>
</tr>
<tr>
<td>
<table style="border-collapse: collapse; font-size: 10pt; font-family: arial,helvetica,sans-serif; width: 100%; margin-top: 20px;" border="1">
<tbody>
<tr>
<td class="encabezado_list" style="text-align: left; width: 40%;">FECHA DE LA PR&Oacute;XIMA REUNI&Oacute;N</td>
<td><?php mostrar_valor_campo('fecha_proxima_reunion',309,$_REQUEST['iddoc']);?></td>
</tr>
</tbody>
</table>
</td>
</tr>
<tr>
<td>
<table style="border-collapse: collapse; font-size: 10pt; font-family: arial,helvetica,sans-serif; width: 100%; margin-top: 20px;" border="1">
<tbody>
<tr>
<td class="encabezado_list" style="text-align: left; width: 15%;">LUGAR</td>
<td><?php mostrar_valor_campo('lugar_proxima_reunion',309,$_REQUEST['iddoc']);?></td>
</tr>
</tbody>
</table>
</td>
</tr>
<tr>
<td><br />FIRMAS:<br /><br /><?php mostrar_listado_asistentes(309,$_REQUEST['iddoc']);?></td>
</tr>
</tbody>
</table></td></tr><?php include_once("../librerias/footer_nuevo.php"); ?>