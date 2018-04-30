<?php include_once("../../librerias_saia.php"); ?>
			<?php echo(librerias_jquery('1.7')); ?><?php include_once("../librerias/funciones_generales.php"); ?>
			<?php include_once("../../class_transferencia.php"); ?>
			<?php include_once("funciones.php"); ?>
			<?php include_once("../librerias/encabezado_pie_pagina.php"); ?>
			<?php include_once("../librerias/header_nuevo.php"); ?>
			<tr><td><table class="table table-bordered" style="width: 100%;" border="1" cellspacing="0">
<tbody>
<tr>
<td>&nbsp;<strong>FECHA</strong></td>
<td><?php mostrar_fecha(412,$_REQUEST['iddoc']);?>&nbsp;</td>
<td><strong>&nbsp;FECHA REQUERIDA PARA PRESTAMO</strong></td>
<td><?php mostrar_valor_campo('fecha_prestamo_rep',412,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td>&nbsp;<strong>SOLICITANTE</strong></td>
<td>&nbsp;<?php ver_creador_prestamo(412,$_REQUEST['iddoc']);?></td>
<td><strong>&nbsp;FECHA DE DEVOLUCI&Oacute;N ESTIMADA</strong></td>
<td>&nbsp;<?php mostrar_valor_campo('fecha_devolucion_rep',412,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td colspan="4">&nbsp;<strong>OBSERVACIONES</strong> <?php mostrar_valor_campo('observaciones',412,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td>&nbsp;<strong>ANEXOS</strong></td>
<td colspan="3"><?php mostrar_valor_campo('anexos',412,$_REQUEST['iddoc']);?></td>
</tr>
</tbody>
</table>
<p><?php mostrar_expedientes_prestamos(412,$_REQUEST['iddoc']);?></p>
<p><?php mostrar_estado_proceso(412,$_REQUEST['iddoc']);?></p></td></tr><?php include_once("../librerias/footer_nuevo.php"); ?>
			