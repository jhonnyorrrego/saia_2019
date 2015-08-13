<?php include_once("../carta/funciones.php"); ?><?php include_once("funciones.php"); ?><?php include_once("../librerias/funciones_generales.php"); ?><script type="text/javascript" src="../../js/jquery.js"></script><?php include_once("../librerias/header_nuevo.php"); ?><?php include_once("../../class_transferencia.php"); ?><tr><td><table style="border-collapse: collapse; width: 100%;" border="1">
<tbody>
<tr>
<td style="text-align: left; width: 25%;"><strong>&nbsp;DE:</strong></td>
<td style="width: 75%;"><?php creador_documento(307,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td style="text-align: left;"><strong>&nbsp;PARA:</strong></td>
<td><?php mostrar_valor_campo('para',307,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td style="text-align: left;"><strong>&nbsp;ASUNTO:</strong></td>
<td><?php mostrar_valor_campo('asunto',307,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td style="text-align: left;"><strong>&nbsp;COMENTARIO:</strong></td>
<td><?php ver_comentario(307,$_REQUEST['iddoc']);?></td>
</tr>
</tbody>
</table>
<p><?php mostrar_estado_proceso(307,$_REQUEST['iddoc']);?></p></td></tr><?php include_once("../librerias/footer_nuevo.php"); ?>