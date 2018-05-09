<?php include_once("../../librerias_saia.php"); ?>
			<?php echo(librerias_jquery('1.7')); ?><?php include_once("../librerias/funciones_generales.php"); ?>
			<?php include_once("../../class_transferencia.php"); ?>
			<?php include_once("../librerias/encabezado_pie_pagina.php"); ?>
			<?php include_once("funciones.php"); ?>
			<?php include_once("../librerias/header_nuevo.php"); ?>
			<tr><td><p><?php cargar_info_control_documentos(498,$_REQUEST['iddoc']);?></p>
<table class="table table-bordered" style="border-collapse: collapse; width: 100%;" border="1">
<tbody>
<tr>
<td class="encabezado_list" style="text-align: center;" colspan="2"><span style="font-size: small;"><strong>Solicitud No. <?php obtener_numero_solicitud(498,$_REQUEST['iddoc']);?>&nbsp;</strong></span></td>
</tr>
<tr>
<td><strong><strong>Fecha de la solicitud:</strong></strong></td>
<td>&nbsp;<?php obtener_fecha_solicitud_control_documento(498,$_REQUEST['iddoc']);?>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;</td>
</tr>
<tr>
<td><strong>Nombre del solicitante:</strong></td>
<td>&nbsp;<?php obtener_nombre_solicitante(498,$_REQUEST['iddoc']);?>&nbsp;</td>
</tr>
<tr>
<td><strong>Tipo de solicitud:</strong></td>
<td><strong>&nbsp;<?php mostrar_valor_campo('tipo_solicitud',498,$_REQUEST['iddoc']);?></strong>&nbsp;<?php ver_nombre_documento(498,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td><strong>Proceso/subproceso:</strong></td>
<td>&nbsp;<?php mostrar_valor_campo('listado_procesos',498,$_REQUEST['iddoc']);?>&nbsp;<?php ver_datos_control_doc(498,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td style="text-align: left;" colspan="2" valign="top"><strong>Justificaci&oacute;n:</strong><br /><?php mostrar_valor_campo('justificacion',498,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td colspan="2"><strong><strong><strong>Propuesta:</strong><br /></strong></strong><?php mostrar_valor_campo('propuesta',498,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td>&nbsp;<strong>Anexos:</strong></td>
<td><?php mostrar_valor_campo('anexo_formato',498,$_REQUEST['iddoc']);?></td>
</tr>
</tbody>
</table>
<p><?php mostrar_estado_proceso(498,$_REQUEST['iddoc']);?></p>
<p>&nbsp;</p>
<p><?php mostrar_items_control_version(498,$_REQUEST['iddoc']);?></p>
<p><?php confirmar_control_documentos(498,$_REQUEST['iddoc']);?></p>
<p><?php generar_documentos_version(498,$_REQUEST['iddoc']);?></p></td></tr><?php include_once("../librerias/footer_nuevo.php"); ?>
			