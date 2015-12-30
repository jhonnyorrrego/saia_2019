<?php include_once("../carta/funciones.php"); ?><?php include_once("../carta/../carta/funciones.php"); ?><?php include_once("../librerias/header_nuevo.php"); ?><?php include_once("../../class_transferencia.php"); ?><tr><td><table border="1">
<tbody>
<tr>
<td>Fecha</td>
<td><?php mostrar_valor_campo('fecha_req',332,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td>&nbsp;Solicitud</td>
<td>&nbsp;<?php mostrar_valor_campo('soli_sop',332,$_REQUEST['iddoc']);?></td>
</tr>
</tbody>
</table></td></tr><?php include_once("../librerias/footer_nuevo.php"); ?>