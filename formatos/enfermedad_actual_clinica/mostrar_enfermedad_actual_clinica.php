<?php include_once("../carta/funciones.php"); ?><?php include_once("../librerias/funciones_generales.php"); ?><script type="text/javascript" src="../../js/jquery.js"></script><?php include_once("../librerias/header_nuevo.php"); ?><?php include_once("../../class_transferencia.php"); ?><tr><td><table style="border-collapse: collapse; ; width: 100%;" border="1">
<tbody>
<tr>
<td class="encabezado_list " style="text-align: left; width: 25%;">Enfermedad Actual (Signos Y S&iacute;ntomas Relacionados Con El Motivo De Consulta</td>
<td><?php mostrar_valor_campo('enfermedad_actual_ortodoncia',286,$_REQUEST['iddoc']);?></td>
</tr>
</tbody>
</table>
<p><?php mostrar_estado_proceso(286,$_REQUEST['iddoc']);?></p></td></tr><?php include_once("../librerias/footer_nuevo.php"); ?>