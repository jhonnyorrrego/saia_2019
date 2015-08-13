<?php include_once("../carta/funciones.php"); ?><?php include_once("../librerias/funciones_generales.php"); ?><script type="text/javascript" src="../../js/jquery.js"></script><?php include_once("../librerias/header_nuevo.php"); ?><?php include_once("../../class_transferencia.php"); ?><tr><td><table style="font-family: arial; border-collapse: collapse; width: 100%;" border="1">
<tbody>
<tr>
<td class="encabezado" valign="top">Descripci&oacute;n</td>
<td><?php mostrar_valor_campo('descripcion',196,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td class="encabezado" valign="top">Anexos</td>
<td><?php mostrar_valor_campo('anexos',196,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td class="encabezado" valign="top">Estado</td>
<td><?php mostrar_valor_campo('estado',196,$_REQUEST['iddoc']);?></td>
</tr>
</tbody>
</table>
<p><?php mostrar_estado_proceso(196,$_REQUEST['iddoc']);?></p></td></tr><?php include_once("../librerias/footer_nuevo.php"); ?>