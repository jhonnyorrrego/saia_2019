<?php include_once("../carta/funciones.php"); ?><?php include_once("../pqr/funciones.php"); ?><?php include_once("../memorando/funciones.php"); ?><?php include_once("../experiencia_laboral/funciones.php"); ?><?php include_once("../correo_saia/funciones.php"); ?><?php include_once("funciones.php"); ?><?php include_once("../librerias/firmas_documentos.php"); ?><?php include_once("../librerias/funciones_generales.php"); ?><script type="text/javascript" src="../../js/jquery.js"></script><?php include_once("../librerias/header_nuevo.php"); ?><?php include_once("../../class_transferencia.php"); ?><tr><td><table style="border-collapse: collapse; width: 100%;" border="1">
<tbody>
<tr>
<td class="phpmaker" style="text-align: center;" colspan="2" valign="top"><strong><span style="font-size: small;">Solicitud&nbsp; N&deg; <strong><?php numero_solictud_cambio(377,$_REQUEST['iddoc']);?></strong></span></strong></td>
</tr>
<tr>
<td class="phpmaker" style="text-align: left;" valign="top"><strong>Nombre del Solicitante:</strong></td>
<td class="phpmaker" style="text-align: left;" valign="top"><?php nombres_solicitante(377,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td class="phpmaker" style="text-align: left;" valign="top"><strong>Fecha de la silocitud:</strong></td>
<td class="phpmaker" style="text-align: left;" valign="top"><?php fecha_documento(377,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td class="phpmaker" style="text-align: left;" valign="top"><strong>Tipo de Solicitud:</strong></td>
<td class="phpmaker" style="text-align: left;" valign="top"><?php mostrar_valor_campo('tipo_solicitud',377,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td class="phpmaker" style="text-align: left;" valign="top"><strong>Documento de calidad Vinculado:</strong></td>
<td class="phpmaker" style="text-align: left;" valign="top"><?php mostrar_valor_campo('documento_calidad',377,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td class="phpmaker" valign="top"><strong>Proceso Vinculado:</strong></td>
<td class="phpmaker" valign="top"><?php mostrar_procesos_macros(377,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td class="phpmaker" style="text-align: left;" colspan="2" valign="top"><strong>Pasa de Version:&nbsp;</strong><?php mostrar_valor_campo('version_original',377,$_REQUEST['iddoc']);?>&nbsp; a Versi&oacute;n: <?php mostrar_valor_campo('nueva_version',377,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td class="phpmaker" style="text-align: left;" colspan="2" valign="top"><strong>Justificaci&oacute;n:<br /></strong><?php mostrar_valor_campo('justificacion',377,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td class="phpmaker" style="text-align: left;" colspan="2" valign="top"><strong>Propuesta:<br /></strong><?php mostrar_valor_campo('propuesta',377,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td class="phpmaker" style="text-align: left;" valign="top"><strong>Anexos:</strong></td>
<td class="phpmaker" style="text-align: left;" valign="top">&nbsp;<?php mostrar_anexos_memo(377,$_REQUEST['iddoc']);?>&nbsp;</td>
</tr>
<tr>
<td class="phpmaker" style="text-align: left;" colspan="2" valign="top"><br /><?php mostrar_estado_proceso(377,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td class="phpmaker" colspan="2" valign="top"><strong>FIRMA COORDINADOR SGC:</strong><br /><?php firma_coordinador_calidad(377,$_REQUEST['iddoc']);?><br /><?php letrero_aprobacion(377,$_REQUEST['iddoc']);?></td>
</tr>
</tbody>
</table></td></tr><?php include_once("../librerias/footer_nuevo.php"); ?>