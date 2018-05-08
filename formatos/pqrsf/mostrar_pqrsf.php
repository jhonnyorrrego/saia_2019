<?php include_once("../../librerias_saia.php"); ?>
			<?php echo(librerias_jquery('1.7')); ?><?php include_once("../librerias/funciones_generales.php"); ?>
			<?php include_once("../../class_transferencia.php"); ?>
			<?php include_once("../librerias/encabezado_pie_pagina.php"); ?>
			<?php include_once("funciones.php"); ?>
			<?php include_once("../../pantallas/qr/librerias.php"); ?>
			<?php include_once("../../distribucion/funciones_distribucion.php"); ?>
			<?php include_once("../librerias/header_nuevo.php"); ?>
			<tr><td><p style="text-align: left;"><?php enlace_llenar_datos_radicacion_rapida_pqrsf(305,$_REQUEST['iddoc']);?></p>
<table style="border-collapse: collapse; width: 100%;" border="1">
<tbody>
<tr>
<td style="text-align: left; width: 20%;"><strong>&nbsp;Estado PQRSF</strong></td>
<td style="text-align: left; width: 25%;">&nbsp;<?php mostrar_valor_campo('estado_reporte',305,$_REQUEST['iddoc']);?></td>
<td style="text-align: left; width: 20%;">&nbsp;<strong>Fecha Cambio Estado</strong></td>
<td style="text-align: left; width: 15%;">&nbsp;<?php ver_fecha_reporte(305,$_REQUEST['iddoc']);?></td>
<td style="text-align: center; width: 20%;" rowspan="5"><?php mostrar_codigo_qr(305,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td style="text-align: left;"><strong>&nbsp;Tipo Comentario:</strong></td>
<td style="text-align: left;" colspan="3">&nbsp;<?php mostrar_valor_campo('tipo',305,$_REQUEST['iddoc']);?><strong></strong></td>
</tr>
<tr>
<td style="text-align: left;"><strong>&nbsp;Nombre Completo:</strong></td>
<td>&nbsp;<?php mostrar_valor_campo('nombre',305,$_REQUEST['iddoc']);?></td>
<td>&nbsp;<strong>Documento:</strong></td>
<td>&nbsp;<?php mostrar_valor_campo('documento',305,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td style="text-align: left;"><strong>&nbsp;Email:&nbsp;</strong></td>
<td style="text-align: left;">&nbsp;<?php mostrar_valor_campo('email',305,$_REQUEST['iddoc']);?></td>
<td style="text-align: left;">&nbsp;<strong>Telefono o Celular:</strong></td>
<td style="text-align: left;">&nbsp;<?php mostrar_valor_campo('telefono',305,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td style="text-align: left;"><strong>&nbsp;<strong>Rol en la Insitucion:</strong></strong></td>
<td style="text-align: left;" colspan="3">&nbsp;<?php mostrar_valor_campo('rol_institucion',305,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td style="text-align: left;" colspan="5"><strong>&nbsp;Comentario:</strong>&nbsp;<?php mostrar_valor_campo('comentarios',305,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td colspan="5">&nbsp;<strong>Documento Soporte del Comentario:&nbsp;</strong><?php mostrar_valor_campo('anexos',305,$_REQUEST['iddoc']);?></td>
</tr>
</tbody>
</table>
<p><br /><?php mostrar_datos_hijos(305,$_REQUEST['iddoc']);?></p>
<p><?php mostrar_listado_distribucion_documento(305,$_REQUEST['iddoc']);?></p>
<p><?php mostrar_estado_proceso(305,$_REQUEST['iddoc']);?></p></td></tr><?php include_once("../librerias/footer_nuevo.php"); ?>
			