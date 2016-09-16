<?php include_once("../carta/funciones.php"); ?><?php include_once("funciones.php"); ?><?php include_once("../librerias/funciones_generales.php"); ?><script type="text/javascript" src="../../js/jquery.js"></script><?php include_once("../librerias/header_nuevo.php"); ?><?php include_once("../../class_transferencia.php"); ?><tr><td><table style="width: 100%; border-collapse: collapse; font-size: 9pt; font-family: arial;" border="1">
<tbody>
<tr>
<td style="width: 20%;"><strong>C&oacute;digo de compa&ntilde;ia</strong></td>
<td><?php mostrar_valor_campo('cia',236,$_REQUEST['iddoc']);?></td>
<td><strong>Fecha de Expedici&oacute;n:</strong></td>
<td><?php mostrar_valor_campo('fecha_exp',236,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td><strong>Fecha de Vencimiento:</strong></td>
<td><?php mostrar_valor_campo('fecha_venc',236,$_REQUEST['iddoc']);?></td>
<td><strong>Numero de Factura:</strong></td>
<td><?php mostrar_valor_campo('num_factura',236,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td><strong>Tipo de Documento:</strong></td>
<td><?php mostrar_valor_campo('tipo_doc',236,$_REQUEST['iddoc']);?></td>
<td><strong>Orden de Compra:</strong></td>
<td><?php mostrar_valor_campo('orden_compra',236,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td><strong>Proveedor:</strong></td>
<td>&nbsp;<?php funcion1_proveedor(236,$_REQUEST['iddoc']);?></td>
<td><strong>Caja:</strong></td>
<td><?php mostrar_valor_campo('caja',236,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td><strong>Unidad Documental:</strong></td>
<td><?php mostrar_valor_campo('unidad_documenta',236,$_REQUEST['iddoc']);?></td>
<td><strong>Archivo Ubicaci&oacute;n F&iacute;sica:</strong></td>
<td><?php mostrar_valor_campo('archivo_ubicacion',236,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td><strong>Numero P&aacute;ginas:</strong></td>
<td>&nbsp;</td>
<td><strong>Tipo moneda</strong></td>
<td><?php mostrar_valor_campo('tipo_moneda',236,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td><strong>CAD:</strong></td>
<td>&nbsp;</td>
<td><strong>Valor total de la factura:</strong></td>
<td><?php mostrar_valor_campo('valor_factura',236,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td><strong><strong>Anexos:</strong></strong></td>
<td colspan="3">&nbsp;<?php mostrar_anexos_factura(236,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td><strong><strong>Requiere IR:</strong></strong></td>
<td colspan="3"><?php mostrar_valor_campo('requiere_irecibo',236,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td><strong><strong>Guia</strong></strong></td>
<td><?php mostrar_valor_campo('numero_guia',236,$_REQUEST['iddoc']);?></td>
<td><strong>Empresa</strong></td>
<td><?php mostrar_valor_campo('empresa_guia',236,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td><strong><strong>Fecha</strong></strong></td>
<td>&nbsp;</td>
<td><strong>Observaciones</strong></td>
<td><?php mostrar_valor_campo('observaciones',236,$_REQUEST['iddoc']);?></td>
</tr>
</tbody>
</table>
<p>&nbsp;</p>
<p><?php mostrar_estado_proceso(236,$_REQUEST['iddoc']);?></p>
<p>&nbsp;</p>
<table style="; width: 100%;" border="0">
<tbody>
<tr>
<td>&nbsp;</td>
</tr>
<tr>
<td>&nbsp;</td>
</tr>
</tbody>
</table>
<p><br />&nbsp;</p></td></tr><?php include_once("../librerias/footer_nuevo.php"); ?>