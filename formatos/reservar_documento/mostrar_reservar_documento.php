<?php include_once("../../librerias_saia.php"); ?>
			<?php echo(librerias_jquery('1.7')); ?><?php include_once("../librerias/funciones_generales.php"); ?>
			<?php include_once("../../class_transferencia.php"); ?>
			<?php include_once("funciones.php"); ?>
			<?php include_once("../librerias/encabezado_pie_pagina.php"); ?>
			<?php include_once("../librerias/header_nuevo.php"); ?>
			<tr><td><table style="border-collapse: collapse; width: 100%;" border="1">
<tbody>
<tr>
<td style="width: 30%;"><strong>Fecha de solicitud</strong></td>
<td style="width: 70%;"><?php mostrar_valor_campo('fecha_solicitud',324,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td><strong>Desde</strong></td>
<td><?php mostrar_valor_campo('desde',324,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td><strong>Hasta</strong></td>
<td><?php mostrar_valor_campo('hasta',324,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td><strong>Solicitar a</strong></td>
<td><?php mostrar_valor_campo('solicitar_a',324,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td colspan="2"><strong>Observaciones</strong></td>
</tr>
<tr>
<td colspan="2"><?php mostrar_valor_campo('observaciones',324,$_REQUEST['iddoc']);?></td>
</tr>
</tbody>
</table>
<p><?php mostrar_estado_proceso(324,$_REQUEST['iddoc']);?></p></td></tr><?php include_once("../librerias/footer_nuevo.php"); ?>
			