<?php include_once("../carta/funciones.php"); ?><?php include_once("../radicacion_entrada/funciones.php"); ?><?php include_once("funciones.php"); ?><?php include_once("../librerias/funciones_generales.php"); ?><script type="text/javascript" src="../../js/jquery.js"></script><?php include_once("../librerias/header_nuevo.php"); ?><?php include_once("../../class_transferencia.php"); ?><tr><td><table style="width: 100%; border-collapse: collapse; font-size: 10pt;" border="1">
<tbody>
<tr>
<td><strong>Tipo de documento:</strong></td>
<td><?php mostrar_valor_campo('tipo_documento',302,$_REQUEST['iddoc']);?></td>
<td><strong>Codigo Organizacion:</strong></td>
<td><?php mostrar_codigo_organizacion(302,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td><strong>Fecha de Expedicion:</strong></td>
<td><?php mostrar_valor_campo('fecha_expedicion',302,$_REQUEST['iddoc']);?></td>
<td><strong>Fecha de Vencimiento:</strong></td>
<td><?php mostrar_valor_campo('fecha_vencimiento',302,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td><strong>Proveedor:</strong></td>
<td><?php mostrar_valor_campo('proveedor',302,$_REQUEST['iddoc']);?>&nbsp;&nbsp;</td>
<td><strong>Detalle Factura:</strong></td>
<td><?php mostrar_valor_campo('detalle_factura',302,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td><strong>Numero Factura:</strong></td>
<td><?php mostrar_valor_campo('numero_factura',302,$_REQUEST['iddoc']);?></td>
<td><strong>Valor Factura:</strong></td>
<td><?php ver_valor_factura(302,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td><strong>Responsable OP:</strong></td>
<td><?php ver_responsable_op(302,$_REQUEST['iddoc']);?></td>
<td><strong>Guia:</strong></td>
<td><?php mostrar_valor_campo('guia',302,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td><strong>Empresa Guia:</strong></td>
<td><?php mostrar_valor_campo('empresa_guia',302,$_REQUEST['iddoc']);?></td>
<td><strong>Anexos:</strong></td>
<td><?php ver_adjuntar(302,$_REQUEST['iddoc']);?></td>
</tr>
</tbody>
</table>
<p><?php imagenes_digitalizadas_funcion(302,$_REQUEST['iddoc']);?></p>
<p><?php mostrar_estado_proceso(302,$_REQUEST['iddoc']);?></p>
<p>&nbsp;</p>
<p><?php ordenes_compra_vinculadas(302,$_REQUEST['iddoc']);?></p></td></tr><?php include_once("../librerias/footer_nuevo.php"); ?>