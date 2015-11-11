<?php include_once("../carta/funciones.php"); ?><?php include_once("../librerias/funciones_generales.php"); ?><script type="text/javascript" src="../../js/jquery.js"></script><?php include_once("../librerias/header_nuevo.php"); ?><?php include_once("../../class_transferencia.php"); ?><tr><td><table style="width: 100%;" border="1">
<tbody>
<tr>
<td><?php mostrar_valor_campo('lista',329,$_REQUEST['iddoc']);?></td>
<td>&nbsp;</td>
</tr>
<tr>
<td><?php mostrar_valor_campo('radio',329,$_REQUEST['iddoc']);?></td>
<td>&nbsp;</td>
</tr>
<tr>
<td><?php mostrar_valor_campo('remitente',329,$_REQUEST['iddoc']);?></td>
<td>&nbsp;</td>
</tr>
<tr>
<td><?php mostrar_valor_campo('arbol',329,$_REQUEST['iddoc']);?></td>
<td>&nbsp;</td>
</tr>
<tr>
<td><?php mostrar_valor_campo('anexo',329,$_REQUEST['iddoc']);?></td>
<td>&nbsp;</td>
</tr>
</tbody>
</table>
<p><?php mostrar_estado_proceso(329,$_REQUEST['iddoc']);?></p></td></tr><?php include_once("../librerias/footer_nuevo.php"); ?>