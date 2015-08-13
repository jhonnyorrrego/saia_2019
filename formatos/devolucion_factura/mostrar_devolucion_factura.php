<?php include_once("../carta/funciones.php"); ?><?php include_once("../estructura_hoja_vida/funciones.php"); ?><?php include_once("../referencias_comerciales/funciones.php"); ?><?php include_once("funciones.php"); ?><?php include_once("../librerias/funciones_generales.php"); ?><script type="text/javascript" src="../../js/jquery.js"></script><?php include_once("../librerias/header_nuevo.php"); ?><?php include_once("../../class_transferencia.php"); ?><tr><td><table style="width: 100%;" border="0" cellspacing="0">
<tbody>
<tr>
<td style="text-align: right;" colspan="2">&nbsp;</td>
</tr>
<tr>
<td style="text-align: center;" colspan="2"><span>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;<?php mostrar_datos_radicaion(243,$_REQUEST['iddoc']);?></span>&nbsp;</td>
</tr>
<tr>
<td colspan="2">Ciuadad, <?php mostrar_fecha(243,$_REQUEST['iddoc']);?><br /><br /><br /><br /><br /></td>
</tr>
<tr>
<td colspan="2"><?php mostrar_valor_campo('datos_proveedor',243,$_REQUEST['iddoc']);?>&nbsp;</td>
</tr>
<tr>
<td colspan="2"><br /><br /><strong>Asunto</strong>: Devoluci&oacute;n de factura</td>
</tr>
<tr>
<td colspan="2"><br /><br /><br /><strong>Nombre del que hace la devoluci&oacute;n: </strong><?php nombre_devolucion(243,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td colspan="2"><strong>N&uacute;mero de la factura:</strong><?php numero_factura_proveedor(243,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td colspan="2"><strong>Forma de envio:</strong>&nbsp;<?php mostrar_valor_campo('forma_envio',243,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td colspan="2">&nbsp;</td>
</tr>
<tr>
<td colspan="2"><br /><br /><strong></strong></td>
</tr>
<tr>
<td colspan="2">&nbsp;</td>
</tr>
<tr>
<td colspan="2">&nbsp;</td>
</tr>
<tr>
<td colspan="2">&nbsp;</td>
</tr>
<tr>
<td colspan="2">&nbsp;</td>
</tr>
<tr>
<td colspan="2"><?php mostrar_valor_campo('observaciones',243,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td colspan="2"><br /><br />Atentamente,</td>
</tr>
<tr>
<td colspan="2" valign="bottom"><?php mostrar_estado_proceso(243,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td colspan="2"><?php mostrar_anexos_devolucion(243,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td colspan="2">&nbsp;</td>
</tr>
<tr>
<td colspan="2"><span style="font-size: 7pt;"><?php mostrar_valor_campo('datos_creador',243,$_REQUEST['iddoc']);?></span></td>
</tr>
<tr>
<td colspan="2">&nbsp;</td>
</tr>
</tbody>
</table>
<p>&nbsp;</p></td></tr><?php include_once("../librerias/footer_nuevo.php"); ?>