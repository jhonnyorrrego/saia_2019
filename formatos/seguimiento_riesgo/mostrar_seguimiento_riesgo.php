<?php include_once("../carta/funciones.php"); ?><?php include_once("../pqr/funciones.php"); ?><?php include_once("../experiencia_laboral/funciones.php"); ?><?php include_once("funciones.php"); ?><?php include_once("../librerias/funciones_generales.php"); ?><script type="text/javascript" src="../../js/jquery.js"></script><?php include_once("../librerias/header_nuevo.php"); ?><?php include_once("../../class_transferencia.php"); ?><tr><td><p><?php botones_seguimiento_riesgos(397,$_REQUEST['iddoc']);?></p>
<table style="border-collapse: collapse; width: 100%;" border="1" cellspacing="0">
<tbody>
<tr>
<td class="encabezado" valign="top" width="30%">FECHA:</td>
<td><?php mostrar_valor_campo('fecha_seguimiento',397,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td class="encabezado" valign="top">RESPONSABLE:</td>
<td><?php datos_usuario_documento(397,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td class="encabezado" valign="top">LOGRO:</td>
<td><?php mostrar_valor_campo('logro',397,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td class="encabezado">ACCION:</td>
<td><?php traer_nombre_accion(397,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td class="encabezado" style="text-align: center;" colspan="2" valign="top"><strong>OBSERVACIONES:</strong> <br />(limitantes en el cumplimiento de la acci&oacute;n, dificultades)</td>
</tr>
<tr>
<td colspan="2"><?php mostrar_valor_campo('observaciones',397,$_REQUEST['iddoc']);?></td>
</tr>
</tbody>
</table>
<p><?php mostrar_valor_campo('evidencia_documental',397,$_REQUEST['iddoc']);?></p></td></tr><?php include_once("../librerias/footer_nuevo.php"); ?>