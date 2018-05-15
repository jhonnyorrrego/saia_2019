<?php include_once("../../librerias_saia.php"); ?>
			<?php echo(librerias_jquery('1.7')); ?><?php include_once("../librerias/funciones_generales.php"); ?>
			<?php include_once("../../class_transferencia.php"); ?>
			<?php include_once("../librerias/header_nuevo.php"); ?>
			<tr><td><table style="border-collapse: collapse; font-size: 12px; width: 100%;" border="1">
<tbody>
<tr>
<td style="text-align: left;"><strong>&nbsp;Accion</strong></td>
<td>&nbsp;<?php mostrar_valor_campo('accion_causa',314,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td style="text-align: left;"><strong>&nbsp;Resonsable:&nbsp;</strong></td>
<td style="text-align: left;">&nbsp;<?php mostrar_valor_campo('responsable',314,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td style="text-align: left;"><strong>&nbsp;Fecha Limite:</strong></td>
<td style="text-align: left;">&nbsp;<?php mostrar_valor_campo('fecha_limite',314,$_REQUEST['iddoc']);?></td>
</tr>
</tbody>
</table></td></tr><?php include_once("../librerias/footer_nuevo.php"); ?>
			