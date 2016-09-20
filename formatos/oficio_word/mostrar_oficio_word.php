<?php include_once("../carta/funciones.php"); ?><?php include_once("funciones.php"); ?><?php include_once("../librerias/funciones_generales.php"); ?><script type="text/javascript" src="../../js/jquery.js"></script><?php include_once("../librerias/header_nuevo.php"); ?><?php include_once("../../class_transferencia.php"); ?><tr><td><table style="width: 100%;" border="0" cellspacing="0">
<tbody>
<tr>
<td colspan="2">
<p><span style="font-family: arial, helvetica, sans-serif; font-size: medium;"><?php mostrar_estado_proceso(400,$_REQUEST['iddoc']);?></span></p>
</td>
</tr>
</tbody>
</table>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p><?php mostrar_valor_campo('mostrar_mensaje_error_pdf',400,$_REQUEST['iddoc']);?></p></td></tr><?php include_once("../librerias/footer_nuevo.php"); ?>