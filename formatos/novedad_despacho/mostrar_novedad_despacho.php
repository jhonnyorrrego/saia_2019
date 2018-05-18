<?php include_once("../../librerias_saia.php"); ?>
			<?php echo(librerias_jquery('1.7')); ?><?php include_once("../librerias/funciones_generales.php"); ?>
			<?php include_once("../../class_transferencia.php"); ?>
			<?php include_once("../librerias/encabezado_pie_pagina.php"); ?>
			<?php include_once("funciones.php"); ?>
			<?php include_once("../librerias/header_nuevo.php"); ?>
			<tr><td><table style="border-collapse: collapse; ; width: 100%;" border="1">
<tbody>
<tr>
<td>Fecha de Novedad:</td>
<td><?php mostrar_valor_campo('fecha_novedad',411,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td>Items de Planilla:</td>
<td><?php mostrar_numero_item_novedad(411,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td>Novedad:</td>
<td><?php mostrar_valor_campo('novedad',411,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td>Observaciones:</td>
<td><?php mostrar_valor_campo('observaciones',411,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td>Anexos/Soporte de entrega:</td>
<td><?php mostrar_novedad_despacho_anexo_soporte(411,$_REQUEST['iddoc']);?></td>
</tr>
</tbody>
</table>
<p><?php mostrar_estado_proceso(411,$_REQUEST['iddoc']);?></p></td></tr><?php include_once("../librerias/footer_nuevo.php"); ?>
			