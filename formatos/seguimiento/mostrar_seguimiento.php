<?php include_once("../../librerias_saia.php"); ?>
			<?php echo(librerias_jquery('1.7')); ?><?php include_once("../../class_transferencia.php"); ?>
			<?php include_once("../librerias/encabezado_pie_pagina.php"); ?>
			<?php include_once("../librerias/funciones_generales.php"); ?>
			<?php include_once("../hallazgo/funciones.php"); ?>
			<?php include_once("funciones.php"); ?>
			<?php include_once("../librerias/header_nuevo.php"); ?>
			<tr><td><table style="width: 100%;" border="0">
<tbody>
<tr>
<td class="encabezado_list" style="text-align: center;" valign="top"><strong>Datos Hallazgo</strong></td>
</tr>
<tr>
<td style="text-align: center;"><?php detalles_padre(482,$_REQUEST['iddoc']);?></td>
</tr>
</tbody>
</table>
<table style="width: 100%;" border="1" cellspacing="0">
<tbody>
<tr>
<td class="encabezado" style="width: 20%;" valign="top">Fecha</td>
<td class="celda_transparente" style="width: 80%;" valign="top"><?php mostrar_fecha_seguimiento_plan_mejoramiento(482,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td class="encabezado" valign="top">Porcentaje de Avance</td>
<td class="celda_transparente" valign="top"><?php mostrar_valor_campo('porcentaje',482,$_REQUEST['iddoc']);?> %</td>
</tr>
<tr>
<td class="encabezado" valign="top">Logros alcanzados</td>
<td class="celda_transparente" valign="top"><?php mostrar_valor_campo('logros_alcanzados',482,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td class="encabezado" valign="top">Observaciones</td>
<td class="celda_transparente" valign="top"><?php mostrar_valor_campo('observaciones',482,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td class="encabezado" valign="top">Evidencia documental Adjunta</td>
<td><?php mostrar_valor_campo('evidencia_documental',482,$_REQUEST['iddoc']);?></td>
</tr>
</tbody>
</table>
<p><?php mostrar_estado_proceso(482,$_REQUEST['iddoc']);?></p></td></tr><?php include_once("../librerias/footer_nuevo.php"); ?>
			