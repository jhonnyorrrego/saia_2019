<?php include_once("../carta/funciones.php"); ?><?php include_once("funciones.php"); ?><?php include_once("../librerias/funciones_generales.php"); ?><script type="text/javascript" src="../../js/jquery.js"></script><?php include_once("../librerias/header_nuevo.php"); ?><?php include_once("../../class_transferencia.php"); ?><tr><td><table style="border-collapse: collapse; width: 100%;" border="1">
<tbody>
<tr>
<td><strong>Fecha:</strong> <?php mostrar_valor_campo('fecha_orden_compra',301,$_REQUEST['iddoc']);?></td>
<td><strong>Proveedor:</strong> <?php nombre_proveedor_funcion(301,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td><strong>Direcci&oacute;n:</strong> <?php direccion_proveedor_funcion(301,$_REQUEST['iddoc']);?></td>
<td><strong>Telefono:</strong> <?php telefono_proveedor_funcion(301,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td><strong>Origen de Recursos:&nbsp;</strong><?php ver_origen_recursos(301,$_REQUEST['iddoc']);?></td>
<td>&nbsp;</td>
</tr>
<tr>
<td colspan="2"><strong></strong><strong>Descripci&oacute;n de la compra: </strong><?php descripcion_funcion_justificacion(301,$_REQUEST['iddoc']);?><strong></strong></td>
</tr>
<tr>
<td style="text-align: center;" colspan="2"><strong>FAVOR DESPACHAR CONFORME A ESPECIFICACIONES LOS SIGUIENTES PRODUCTOS / SERVICIOS</strong></td>
</tr>
</tbody>
</table>
<p><?php productos_seleccionar(301,$_REQUEST['iddoc']);?></p>
<table style="; width: 100%;" border="0">
<tbody>
<tr>
<td style="width: 30%;"><strong>Lugar de entrega:</strong></td>
<td><?php mostrar_valor_campo('lugar_entrega',301,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td><strong>Fecha de entrega:</strong></td>
<td><?php mostrar_valor_campo('fecha_entrega',301,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td><strong>Observaciones de entrega:</strong></td>
<td><?php mostrar_valor_campo('observaciones',301,$_REQUEST['iddoc']);?></td>
</tr>
</tbody>
</table>
<p><?php mostrar_estado_proceso(301,$_REQUEST['iddoc']);?></p>
<p><?php facturas_vinculadas(301,$_REQUEST['iddoc']);?></p></td></tr><?php include_once("../librerias/footer_nuevo.php"); ?>