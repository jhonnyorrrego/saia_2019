<?php include_once("../../librerias_saia.php"); ?><?php echo(librerias_jquery('1.7')); ?><?php include_once("../../formatos/librerias/funciones_generales.php"); ?><?php include_once("../../class_transferencia.php"); ?><?php include_once("../carta/../librerias/encabezado_pie_pagina.php"); ?><?php include_once("../librerias/funciones_cliente.php"); ?><?php include_once("../../formatos/librerias/header_nuevo.php"); ?><tr><td><table class="table table-bordered" style="; width: 100%;" border="0">
<tbody>
<tr>
<td class="encabezado" style="background-color: #3f91f2; text-align: center;" colspan="2">RESUMEN DE CALIFICACI&Oacute;N DE LA PQRS</td>
</tr>
<tr>
<td style="background-color: #ffffff;"><strong>Fecha</strong></td>
<td>&nbsp;<?php fecha_aprobacion(342,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td style="background-color: #ffffff;"><strong>Calificaci&oacute;n</strong></td>
<td><?php mostrar_valor_campo('calificacion_pqrsf',342,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td style="background-color: #ffffff;"><strong>Descripci&oacute;n</strong></td>
<td>&nbsp;<?php mostrar_valor_campo('descripcion',342,$_REQUEST['iddoc']);?></td>
</tr>
</tbody>
</table>
<p>&nbsp;</p>
<p><?php mostrar_estado_proceso(342,$_REQUEST['iddoc']);?></p></td></tr><?php include_once("../../formatos/librerias/footer_nuevo.php"); ?>