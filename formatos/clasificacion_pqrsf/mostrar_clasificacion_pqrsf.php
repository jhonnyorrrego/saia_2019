<?php include_once("../../librerias_saia.php"); ?>
			<?php echo(librerias_jquery('1.7')); ?><?php include_once("../librerias/funciones_generales.php"); ?>
			<?php include_once("../../class_transferencia.php"); ?>
			<?php include_once("../librerias/encabezado_pie_pagina.php"); ?>
			<?php include_once("funciones.php"); ?>
			<?php include_once("../librerias/header_nuevo.php"); ?>
			<tr><td><table style="border-collapse: collapse; font-size: 10pt; width: 100%;" border="1">
<tbody>
<tr>
<td style="text-align: left;"><strong>Clasificacion del Reclamo</strong></td>
<td>&nbsp;<?php mostrar_valor_campo('serie',306,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td style="text-align: left; width: 30%;"><strong>Resonsable:&nbsp;</strong></td>
<td style="text-align: left; width: 70%;">&nbsp;<?php ver_responsable(306,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td style="text-align: left;" colspan="2"><strong>Observaciones:</strong></td>
</tr>
<tr>
<td colspan="2"><?php mostrar_valor_campo('observaciones',306,$_REQUEST['iddoc']);?></td>
</tr>
</tbody>
</table>
<p><?php mostrar_estado_proceso(306,$_REQUEST['iddoc']);?></p></td></tr><?php include_once("../librerias/footer_nuevo.php"); ?>
			