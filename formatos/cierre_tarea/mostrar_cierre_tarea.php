<?php include_once("../carta/funciones.php"); ?><?php include_once("funciones.php"); ?><?php include_once("../correo_saia/funciones.php"); ?><?php include_once("../librerias/funciones_generales.php"); ?><script type="text/javascript" src="../../js/jquery.js"></script><?php include_once("../librerias/header_nuevo.php"); ?><?php include_once("../../class_transferencia.php"); ?><tr><td><table style="border-collapse: collapse; border-width: 1px; width: 100%;" border="1">
<tbody>
<tr>
<td class="encabezado" style="width: 30%;"><span style="font-size: small;">Fecha:</span></td>
<td><span style="font-size: small;">&nbsp;<?php mostrar_valor_campo('fecha',241,$_REQUEST['iddoc']);?></span></td>
</tr>
<tr>
<td class="encabezado"><span style="font-size: small;">Calificaci&oacute;n de la tarea:</span></td>
<td><span style="font-size: small;"><?php mostrar_valor_campo('calificacion_tarea',241,$_REQUEST['iddoc']);?></span></td>
</tr>
<tr>
<td class="encabezado"><span style="font-size: small;">Descripci&oacute;n:</span></td>
<td><span style="font-size: small;"><?php mostrar_valor_campo('descripcion',241,$_REQUEST['iddoc']);?></span></td>
</tr>
</tbody>
</table>
<p><span style="font-size: small;"><?php mostrar_estado_proceso(241,$_REQUEST['iddoc']);?></span></p></td></tr><?php include_once("../librerias/footer_nuevo.php"); ?>