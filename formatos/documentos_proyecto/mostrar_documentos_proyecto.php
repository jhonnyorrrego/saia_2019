<?php include_once("../carta/funciones.php"); ?><?php include_once("funciones.php"); ?><?php include_once("../contrato_registro_cliente/funciones.php"); ?><?php include_once("../correo_saia/funciones.php"); ?><?php include_once("../librerias/funciones_generales.php"); ?><script type="text/javascript" src="../../js/jquery.js"></script><?php include_once("../librerias/header_nuevo.php"); ?><?php include_once("../../class_transferencia.php"); ?><tr><td><table style="border-collapse: collapse; width: 100%;" border="1">
<tbody>
<tr>
<td style="background-color: #57b0de;"><span style="color: #ffffff;">Fecha del documento:</span></td>
<td><?php mostrar_valor_campo('fecha_documento',254,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td style="background-color: #57b0de;"><span style="color: #ffffff;">Tipo de documento:</span></td>
<td><?php mostrar_valor_campo('tipo_documento',254,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td style="background-color: #57b0de;"><span style="color: #ffffff;">Anexos:</span></td>
<td><?php mostrar_anexos_documento(254,$_REQUEST['iddoc']);?>&nbsp;</td>
</tr>
<tr>
<td style="background-color: #57b0de;"><span style="color: #ffffff;">Observaciones:</span></td>
<td><?php mostrar_valor_campo('observaciones',254,$_REQUEST['iddoc']);?></td>
</tr>
</tbody>
</table>
<p><strong><?php mostrar_estado_proceso(254,$_REQUEST['iddoc']);?></strong></p></td></tr><?php include_once("../librerias/footer_nuevo.php"); ?>