<?php include_once("../carta/funciones.php"); ?><?php include_once("funciones.php"); ?><?php include_once("../librerias/funciones_generales.php"); ?><script type="text/javascript" src="../../js/jquery.js"></script><?php include_once("../librerias/header_nuevo.php"); ?><?php include_once("../../class_transferencia.php"); ?><tr><td><table style="border-collapse: collapse; width: 100%;" border="1">
<tbody>
<tr>
<td><strong>Nombre del paciente:</strong>&nbsp;<?php mostrar_valor_campo('nombre_paciente_control',292,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td><strong>Estado de la cita:</strong>&nbsp;<?php mostrar_valor_campo('estado_control_cita',292,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td><strong>Descripcion:</strong>&nbsp;<?php mostrar_valor_campo('descripcion_control_cita',292,$_REQUEST['iddoc']);?></td>
</tr>
</tbody>
</table></td></tr><?php include_once("../librerias/footer_nuevo.php"); ?>