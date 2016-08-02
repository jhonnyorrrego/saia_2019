<?php include_once("../carta/funciones.php"); ?><?php include_once("funciones.php"); ?><?php include_once("../correo_saia/funciones.php"); ?><?php include_once("../librerias/funciones_generales.php"); ?><script type="text/javascript" src="../../js/jquery.js"></script><?php include_once("../librerias/header_nuevo.php"); ?><?php include_once("../../class_transferencia.php"); ?><tr><td><table style="border-collapse: collapse; font-size: 10pt; width: 100%;" border="1">
<tbody>
<tr>
<td class="encabezado_list mceSelected" style="text-align: left; width: 30%;"><span style="font-size: x-small;">Fecha</span></td>
<td class="mceSelected" style="width: 70%;"><span style="font-size: x-small;"><?php mostrar_valor_campo('fecha_justificacion_compra',296,$_REQUEST['iddoc']);?></span></td>
</tr>
<tr>
<td class="encabezado_list mceSelected" style="text-align: left;"><span style="font-size: x-small;">Nombre del solicitante</span></td>
<td class="mceSelected"><span style="font-size: x-small;"><?php mostrar_valor_campo('nombre_solicitante',296,$_REQUEST['iddoc']);?></span></td>
</tr>
<tr>
<td class="encabezado_list mceSelected" style="text-align: left;"><span style="font-size: x-small;">Descripci&oacute;n</span></td>
<td class="mceSelected"><span style="font-size: x-small;"><?php mostrar_valor_campo('descripcion_justificacion',296,$_REQUEST['iddoc']);?></span></td>
</tr>
<tr>
<td class="encabezado_list mceSelected" style="text-align: left;"><span style="font-size: x-small;">Justificaci&oacute;n de compra</span></td>
<td class="mceSelected"><span style="font-size: x-small;"><?php mostrar_valor_campo('justificacion_compra',296,$_REQUEST['iddoc']);?></span></td>
</tr>
<tr>
<td class="encabezado_list mceSelected" style="text-align: left;"><span style="font-size: x-small;">Aprobaci&oacute;n</span></td>
<td class="mceSelected"><span style="font-size: x-small;"><?php mostrar_valor_campo('primera_aprobacion',296,$_REQUEST['iddoc']);?></span></td>
</tr>
</tbody>
</table>
<p><br /><?php listar_item_justificacion(296,$_REQUEST['iddoc']);?><br /><?php mostrar_estado_proceso(296,$_REQUEST['iddoc']);?></p></td></tr><?php include_once("../librerias/footer_nuevo.php"); ?>