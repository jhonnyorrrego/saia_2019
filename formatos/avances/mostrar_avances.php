<?php include_once("../carta/funciones.php"); ?><?php include_once("../estructura_hoja_vida/funciones.php"); ?><?php include_once("../referencias_comerciales/funciones.php"); ?><?php include_once("funciones.php"); ?><?php include_once("../librerias/funciones_generales.php"); ?><script type="text/javascript" src="../../js/jquery.js"></script><?php include_once("../librerias/header_nuevo.php"); ?><?php include_once("../../class_transferencia.php"); ?><tr><td><table style="border-collapse: collapse; border-width: 1px; width: 100%;" border="1">
<tbody>
<tr>
<td class="encabezado" style="width: 30%;"><span style="font-size: small;">Fecha:</span></td>
<td><span style="font-size: small;">&nbsp;<?php mostrar_fecha(240,$_REQUEST['iddoc']);?></span></td>
</tr>
<tr>
<td class="encabezado"><span style="font-size: small;">Estado:</span></td>
<td><span style="font-size: small;">&nbsp;<?php mostrar_valor_campo('estado',240,$_REQUEST['iddoc']);?></span></td>
</tr>
<tr>
<td class="encabezado"><span style="font-size: small;">Tarea al que pertenece:</span></td>
<td><span style="font-size: small;"><?php tarea_origen(240,$_REQUEST['iddoc']);?></span></td>
</tr>
<tr>
<td class="encabezado"><span style="font-size: small;">Descripci&oacute;n:</span></td>
<td><span style="font-size: small;"><?php mostrar_valor_campo('descripcion_formato',240,$_REQUEST['iddoc']);?>&nbsp;</span></td>
</tr>
</tbody>
</table>
<p><span style="font-size: small;"><?php mostrar_estado_proceso(240,$_REQUEST['iddoc']);?></span></p>
<p><span style="font-size: small;"><br /></span></p></td></tr><?php include_once("../librerias/footer_nuevo.php"); ?>