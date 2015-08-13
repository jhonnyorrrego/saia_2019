<?php include_once("../carta/funciones.php"); ?><?php include_once("../estructura_hoja_vida/funciones.php"); ?><?php include_once("../referencias_comerciales/funciones.php"); ?><?php include_once("funciones.php"); ?><?php include_once("../librerias/funciones_generales.php"); ?><script type="text/javascript" src="../../js/jquery.js"></script><?php include_once("../librerias/header_nuevo.php"); ?><?php include_once("../../class_transferencia.php"); ?><tr><td><table style="width: 100%; border-collapse: collapse;" border="1" align="center">
<tbody>
<tr>
<td class="encabezado_list" style="width: 30%;"><span style="font-size: small;"><strong>Fecha reporte:</strong></span></td>
<td><span style="font-size: small;">&nbsp;<?php fecha_reporte(230,$_REQUEST['iddoc']);?></span></td>
</tr>
<tr>
<td class="encabezado_list"><span style="font-size: small;"><strong>Estado actual:</strong></span></td>
<td><span style="font-size: small;">&nbsp;<?php mostrar_valor_campo('estado_proceso',230,$_REQUEST['iddoc']);?></span></td>
</tr>
<tr>
<td class="encabezado_list"><span style="font-size: small;"><strong>Categoria:</strong></span></td>
<td><span style="font-size: small;">&nbsp;<?php categoria_soporte(230,$_REQUEST['iddoc']);?></span></td>
</tr>
<tr>
<td class="encabezado_list"><span style="font-size: small;"><strong>Diagnostico:</strong></span></td>
<td><span style="font-size: small;"><?php mostrar_valor_campo('descripcion',230,$_REQUEST['iddoc']);?>&nbsp;</span></td>
</tr>
<tr>
<td class="encabezado_list"><span style="font-size: small;"><strong>Insumos:</strong></span></td>
<td><span style="font-size: small;">&nbsp;<?php mostrar_valor_campo('insumos',230,$_REQUEST['iddoc']);?></span></td>
</tr>
<tr>
<td class="encabezado_list"><span style="font-size: small;"><strong>Observaciones:</strong></span></td>
<td><span style="font-size: small;">&nbsp;<?php mostrar_valor_campo('observaciones',230,$_REQUEST['iddoc']);?></span></td>
</tr>
<tr>
<td class="encabezado_list"><span style="font-size: small;"><strong>&nbsp;Solicitudes Vinculadas:</strong></span></td>
<td><span style="font-size: small;">&nbsp;<?php vinculos_reporte(230,$_REQUEST['iddoc']);?></span></td>
</tr>
</tbody>
</table>
<p><span style="font-size: small;"><?php mostrar_estado_proceso(230,$_REQUEST['iddoc']);?></span></p>
<p>&nbsp;</p>
<p>&nbsp;</p></td></tr><?php include_once("../librerias/footer_nuevo.php"); ?>