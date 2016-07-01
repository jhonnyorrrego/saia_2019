<?php include_once("../carta/funciones.php"); ?><?php include_once("../correo_saia/funciones.php"); ?><?php include_once("funciones.php"); ?><?php include_once("../librerias/funciones_generales.php"); ?><script type="text/javascript" src="../../js/jquery.js"></script><?php include_once("../librerias/header_nuevo.php"); ?><?php include_once("../../class_transferencia.php"); ?><tr><td><table style="width: 100%; border-collapse: collapse;" border="1">
<tbody>
<tr>
<td class="encabezado_list" style="text-align: left;">Tipo</td>
<td><?php mostrar_valor_campo('tipo_base_calidad',387,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td class="encabezado_list" style="text-align: left;">Versi&oacute;n</td>
<td><?php mostrar_valor_campo('version_base_calidad',387,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td class="encabezado_list" style="text-align: left;">Descripci&oacute;n</td>
<td><?php mostrar_valor_campo('descripcion_base',387,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td class="encabezado_list" style="text-align: left;">Estado</td>
<td><?php mostrar_valor_campo('estado_base_calidad',387,$_REQUEST['iddoc']);?></td>
</tr>
</tbody>
</table>
<p><?php mostrar_estado_proceso(387,$_REQUEST['iddoc']);?></p></td></tr><?php include_once("../librerias/footer_nuevo.php"); ?>