<?php include_once("../../librerias_saia.php"); ?><?php echo(librerias_jquery('1.7')); ?><?php include_once("../../formatos/librerias/funciones_generales.php"); ?><?php include_once("../../class_transferencia.php"); ?><?php include_once("../carta/../librerias/encabezado_pie_pagina.php"); ?><?php include_once("funciones.php"); ?><?php include_once("../../formatos/librerias/header_nuevo.php"); ?><tr><td><table class="table table-bordered" style="border-collapse: collapse; width: 100%;" border="1">
<tbody>
<tr>
<td class="encabezado" style="width: 50%;">Fecha Seguimiento:</td>
<td style="width: 50%;"><?php mostrar_valor_campo('fecha_seguimiento',489,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td class="encabezado">Datos de&nbsp;la Formula:</td>
<td>
<p><?php mostrar_variables(489,$_REQUEST['iddoc']);?></p>
</td>
</tr>
<tr>
<td class="encabezado">Linea Base:</td>
<td><?php mostrar_valor_campo('linea_base',489,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td class="encabezado">Meta:</td>
<td><?php mostrar_valor_campo('meta_indicador_actual',489,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td class="encabezado">An&aacute;lisis de datos:</td>
<td><?php mostrar_valor_campo('observaciones',489,$_REQUEST['iddoc']);?></td>
</tr>
</tbody>
</table>
<p><?php mostrar_estado_proceso(489,$_REQUEST['iddoc']);?></p></td></tr><?php include_once("../../formatos/librerias/footer_nuevo.php"); ?>