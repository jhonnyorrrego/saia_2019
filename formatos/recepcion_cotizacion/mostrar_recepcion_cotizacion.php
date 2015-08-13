<?php include_once("../carta/funciones.php"); ?><?php include_once("funciones.php"); ?><?php include_once("../librerias/funciones_generales.php"); ?><script type="text/javascript" src="../../js/jquery.js"></script><?php include_once("../librerias/header_nuevo.php"); ?><?php include_once("../../class_transferencia.php"); ?><tr><td><table style="width: 100%; border-collapse: collapse;" border="1">
<tbody>
<tr>
<td class="encabezado_list" style="width: 30%; text-align: left;">Dependencia del creador del documento</td>
<td><?php dependencia_creador_funcion(298,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td class="encabezado_list" style="width: 30%; text-align: left;">Fecha de recepci&oacute;n</td>
<td><?php mostrar_valor_campo('fecha_recepcion_cotiza',298,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td class="encabezado_list" style="width: 30%; text-align: left;">Proveedor</td>
<td><?php mostrar_valor_campo('proveedor',298,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td class="encabezado_list" style="width: 30%; text-align: left;">Regimen</td>
<td><?php mostrar_valor_campo('regimen',298,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td class="encabezado_list" style="width: 30%; text-align: left;">Valor IVA (%)</td>
<td><?php mostrar_valor_campo('valor_iva',298,$_REQUEST['iddoc']);?> %</td>
</tr>
<tr>
<td class="encabezado_list" style="width: 30%; text-align: left;">Adjuntos</td>
<td><?php mostrar_valor_campo('adjuntos',298,$_REQUEST['iddoc']);?></td>
</tr>
</tbody>
</table>
<p><br /><?php listar_item_recepcion(298,$_REQUEST['iddoc']);?><br /><?php mostrar_estado_proceso(298,$_REQUEST['iddoc']);?></p></td></tr><?php include_once("../librerias/footer_nuevo.php"); ?>