<?php include_once("../../librerias_saia.php"); ?><?php echo(librerias_jquery('1.7')); ?><?php include_once("../../formatos/librerias/funciones_generales.php"); ?><?php include_once("../../class_transferencia.php"); ?><?php include_once("../carta/../librerias/encabezado_pie_pagina.php"); ?><?php include_once("../librerias/encabezado_pie_pagina.php"); ?><?php include_once("../../formatos/librerias/header_nuevo.php"); ?><tr><td><table class="table table-bordered" style="border-collapse: collapse; width: 100%;">
<tbody>
<tr>
<td class="encabezado" width="50%">F&oacute;rmula:</td>
<td width="50%"><?php mostrar_valor_campo('nombre',488,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td class="encabezado">Unidad:</td>
<td><?php mostrar_valor_campo('unidad',488,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td class="encabezado">Periocidad:</td>
<td><?php mostrar_valor_campo('periocidad',488,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td class="encabezado">Naturaleza:</td>
<td><?php mostrar_valor_campo('naturaleza',488,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td class="encabezado">Descripci&oacute;n de Variables de la Formula</td>
<td><?php mostrar_valor_campo('observacion',488,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td class="encabezado" valign="top">Rango en el cual el resultado se considera Satisfactorio</td>
<td><?php mostrar_valor_campo('rango_colores',488,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td class="encabezado" valign="top">La mejora es creciente o decreciente?</td>
<td><?php mostrar_valor_campo('tipo_rango',488,$_REQUEST['iddoc']);?></td>
</tr>
</tbody>
</table>
<p><?php mostrar_estado_proceso(488,$_REQUEST['iddoc']);?></p></td></tr><?php include_once("../../formatos/librerias/footer_nuevo.php"); ?>