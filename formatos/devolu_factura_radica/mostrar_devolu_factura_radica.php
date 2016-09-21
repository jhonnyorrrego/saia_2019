<?php include_once("../carta/funciones.php"); ?><?php include_once("../radicacion_facturas/funciones.php"); ?><?php include_once("funciones.php"); ?><?php include_once("../correo_saia/funciones.php"); ?><?php include_once("../librerias/funciones_generales.php"); ?><script type="text/javascript" src="../../js/jquery.js"></script><?php include_once("../librerias/header_nuevo.php"); ?><?php include_once("../../class_transferencia.php"); ?><tr><td><table style="border-collapse: collapse; ; width: 100%;" border="0">
<tbody>
<tr>
<td>Se&ntilde;or(es):<br /><strong><?php mostrar_informacion_proveedor(304,$_REQUEST['iddoc']);?></strong><br /><br /><br /></td>
</tr>
<tr>
<td>A continuaci&oacute;n se colocan las observaciones de la devoluci&oacute;n de la factura<br /><strong><?php mostrar_valor_campo('observaciones',304,$_REQUEST['iddoc']);?></strong><br /><br /></td>
</tr>
<tr>
<td>
<p>La forma de envio ser&aacute; la siguiente:<br /><strong><?php mostrar_valor_campo('forma_envio',304,$_REQUEST['iddoc']);?></strong></p>
</td>
</tr>
<tr>
<td>&nbsp;<br /><strong><?php muestra_anexos_devolucion(304,$_REQUEST['iddoc']);?></strong></td>
</tr>
<tr>
<td><br />Atentamente,<br /><?php mostrar_estado_proceso(304,$_REQUEST['iddoc']);?></td>
</tr>
</tbody>
</table>
<p><br /><br /></p></td></tr><?php include_once("../librerias/footer_nuevo.php"); ?>