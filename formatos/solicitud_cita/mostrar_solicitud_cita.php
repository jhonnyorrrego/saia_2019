<?php include_once("../carta/funciones.php"); ?><?php include_once("funciones.php"); ?><?php include_once("../librerias/funciones_generales.php"); ?><script type="text/javascript" src="../../js/jquery.js"></script><?php include_once("../librerias/header_nuevo.php"); ?><?php include_once("../../class_transferencia.php"); ?><tr><td><table style="border-collapse: collapse; width: 100%;" border="1">
<tbody>
<tr>
<td style="width: 100%;" colspan="2"><strong>Nombre del paciente:</strong>&nbsp;<?php mostrar_valor_campo('nombre_paciente',291,$_REQUEST['iddoc']);?>&nbsp;</td>
</tr>
<tr>
<td colspan="2"><strong>Motivo de consulta:</strong>&nbsp;<?php mostrar_valor_campo('motivo_consulta',291,$_REQUEST['iddoc']);?>&nbsp;</td>
</tr>
<tr>
<td colspan="2"><strong>Descripci&oacute;n:&nbsp;</strong><?php mostrar_valor_campo('descripcion_cita',291,$_REQUEST['iddoc']);?>&nbsp;</td>
</tr>
<tr>
<td colspan="2"><strong>Fecha y hora de cita:</strong>&nbsp;<?php mostrar_valor_campo('fecha_hora_cita',291,$_REQUEST['iddoc']);?></td>
</tr>
</tbody>
</table></td></tr><?php include_once("../librerias/footer_nuevo.php"); ?>