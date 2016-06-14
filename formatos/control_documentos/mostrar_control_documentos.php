<?php include_once("../carta/funciones.php"); ?><?php include_once("../memorando/funciones.php"); ?><?php include_once("../correo_saia/funciones.php"); ?><?php include_once("funciones.php"); ?><?php include_once("../librerias/funciones_generales.php"); ?><script type="text/javascript" src="../../js/jquery.js"></script><?php include_once("../librerias/header_nuevo.php"); ?><?php include_once("../../class_transferencia.php"); ?><tr><td><table style="border-collapse: collapse; width: 100%;" border="1">
<tbody>
<tr>
<td style="text-align: center;" colspan="2"><span style="font-size: small;"><strong>Solicitud No. <?php obtener_numero_solicitud(378,$_REQUEST['iddoc']);?>&nbsp;</strong></span></td>
</tr>
<tr>
<td><strong>Nombre del solicitante:</strong></td>
<td>&nbsp;<?php obtener_nombre_solicitante(378,$_REQUEST['iddoc']);?> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;</td>
</tr>
<tr>
<td><strong>Fecha de la solicitud:</strong></td>
<td>&nbsp;<?php obtener_fecha_solicitud_control_documento(378,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td><strong>Serie documental</strong></td>
<td>&nbsp;<?php mostrar_valor_campo('serie_doc_control',378,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td><strong>Tipo de solicitud:</strong></td>
<td>&nbsp;<?php mostrar_valor_campo('tipo_solicitud',378,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td><strong><strong>Nombre del documento</strong></strong></td>
<td>&nbsp;<?php mostrar_valor_campo('nombre_documento',378,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td><strong>Documento de calidad vinculado:</strong></td>
<td>&nbsp;<?php obtener_documento_calidad(378,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td><strong>Proceso Vinculado:</strong></td>
<td>&nbsp;<?php obtener_proceso_vinculado(378,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td><strong>Pasa de versi&oacute;n:</strong></td>
<td>&nbsp;<?php obtener_version_documento(378,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td class="phpmaker" style="text-align: left;" colspan="2" valign="top"><strong>Justificaci&oacute;n:<br /></strong><?php mostrar_valor_campo('justificacion',378,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td colspan="2"><strong><strong><strong>Propuesta:</strong><br /></strong></strong><?php mostrar_valor_campo('propuesta',378,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td>&nbsp;<strong>Anexos:</strong></td>
<td>&nbsp;<?php mostrar_anexos_memo(378,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td colspan="2">&nbsp;<br /><?php mostrar_estado_proceso(378,$_REQUEST['iddoc']);?>&nbsp;</td>
</tr>
</tbody>
</table>
<p><?php confirmar_control_documentos(378,$_REQUEST['iddoc']);?></p>
<p><?php mostrar_firma_confirmacion_documento(378,$_REQUEST['iddoc']);?></p>
<p><?php aprobar_control_documentos(378,$_REQUEST['iddoc']);?></p></td></tr><?php include_once("../librerias/footer_nuevo.php"); ?>